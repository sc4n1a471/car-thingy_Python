import asyncio
import time

from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support import expected_conditions as ec
from selenium.webdriver.support.wait import WebDriverWait
from selenium.common.exceptions import TimeoutException
from selenium.webdriver.remote.webdriver import WebDriver

from logging import info

from application.data import helpers, settings
from application.data.xpaths import XPATHS
from application.models.Car import Car
from .get_data_methods.get_car_data import get_car_data
from ..models.GetDataException import GetDataException
from ..models.NoVehicleManagementException import NoVehicleManagementException
from ..models.UnreleasedLPException import UnreleasedLPException


async def get_data(sid: str, requested_cars: list[str]):
    selenium = helpers.car_requests[sid].selenium_session
    if selenium is None:
        raise GetDataException("Selenium session is None")
    cold_start = True
    car_data: list[Car] = []
    for requested_car in requested_cars:
        car = Car()
        car.license_plate = requested_car.upper()

        if not cold_start:
            await helpers.send_to_client(
                sid,
                "message",
                f"Already logged in, waiting {settings.WAIT_TIME} sec...",
                -1,
                "pending",
            )
            time.sleep(settings.WAIT_TIME)
            selenium.get("https://magyarorszag.hu/jszp_szuf")

        try:
            WebDriverWait(selenium, 30).until(ec.presence_of_element_located((By.XPATH, XPATHS.request_page)))
            await helpers.send_to_client(sid, "message", "FOUND: Jármű Szolgáltatási Platform", 14, "pending")
            settings.save_cookie(selenium)
        except Exception as e:
            raise GetDataException(e.args) from e

        await fill_search(sid, selenium, requested_car)  # 16%

        try:
            await check_error_modal(sid, selenium, car, requested_car)  # +4%
        except UnreleasedLPException as ulp:
            raise UnreleasedLPException from ulp

        selenium.switch_to.frame(1)

        WebDriverWait(selenium, 180).until(ec.presence_of_element_located((By.XPATH, XPATHS.car_page)))
        await helpers.send_to_client(sid, "message", "FOUND: Car loaded", 20, "pending")

        WebDriverWait(selenium, 10).until(ec.presence_of_element_located((By.XPATH, XPATHS.brand)))

        await get_car_data(sid, car)

        car_data.append(car)
        cold_start = False
        info("=================")

    return car_data


# MARK: Fill search input
async def fill_search(sid: str, selenium: WebDriver, requested_car: str, wait=0):
    """Fills the search input and clicks search

    Args:
        sid (str): ID of client connection
        selenium (WebDriver): Selenium WebDriver instance
        requested_car (str): license plate
        wait (int): seconds to wait before clicking search
    """

    selenium.switch_to.default_content()
    selenium.switch_to.frame(1)

    WebDriverWait(selenium, 10).until(ec.presence_of_element_located((By.XPATH, XPATHS.search_input)))
    selenium.find_element(By.XPATH, XPATHS.search_input).clear()
    selenium.find_element(By.XPATH, XPATHS.search_input).send_keys(requested_car)
    await helpers.send_to_client(sid, "message", "FILLED: license plate", 15, "pending")

    await asyncio.sleep(wait)

    selenium.find_element(By.XPATH, XPATHS.search_input).send_keys(Keys.ENTER)
    await helpers.send_to_client(sid, "message", "Searching for license plate...", 16, "pending")

    selenium.switch_to.default_content()


# MARK: Error modal handling
async def check_error_modal(sid: str, selenium: WebDriver, car: Car, requested_car: str):
    """Checks for error dialog after submitting license plate

    Args:
        sid: ID of client connection
        selenium: Selenium WebDriver instance
        car: Car object that will be returned
        requested_car: Requested license plate
    """

    retries = 0
    counter = 0

    try:
        WebDriverWait(selenium, 5).until(ec.presence_of_element_located((By.XPATH, XPATHS.error_modal)))
    except TimeoutException:
        return

    while len(selenium.find_elements(By.XPATH, XPATHS.error_modal)) != 0 and counter != 10:
        await helpers.send_to_client(sid, "message", "FOUND: ERROR DIALOG", -1, "pending")

        # MARK: No accident record
        if len(selenium.find_elements(By.XPATH, XPATHS.no_accident_record)) != 0:
            await helpers.send_to_client(
                sid,
                "message",
                "No accident record was found for this license plate, trying without that",
                -1,
                "pending",
            )

            car.has_accident_record = False

            selenium.find_element(By.XPATH, XPATHS.error_modal_button).click()

            selenium.switch_to.default_content()
            selenium.switch_to.frame(1)

            selenium.find_element(By.XPATH, XPATHS.accident_record_ckeckbox).click()
            await helpers.send_to_client(
                sid,
                "message",
                "DISABLED: Biztosítás és Kártörténet",
                17,
                "pending",
            )

            await fill_search(sid, selenium, requested_car, settings.WAIT_TIME)

        # MARK: No inspection record
        elif len(selenium.find_elements(By.XPATH, XPATHS.no_inspection_record)) != 0:
            await helpers.send_to_client(
                sid,
                "message",
                "No inspection record was found for this license plate, trying without that",
                -1,
                "pending",
            )
            car.has_inspection_record = False
            car.has_mileage_record = False

            selenium.find_element(By.XPATH, XPATHS.error_modal_button).click()

            selenium.switch_to.default_content()
            selenium.switch_to.frame(1)

            selenium.find_element(By.XPATH, XPATHS.inspection_record_ckeckbox).click()
            await helpers.send_to_client(
                sid,
                "message",
                "DISABLED: Műszaki állapotra vonatkozó adatok",
                17,
                "pending",
            )

            await fill_search(sid, selenium, requested_car, settings.WAIT_TIME)

        # MARK: No vehicle management record
        elif len(selenium.find_elements(By.XPATH, XPATHS.no_vehicle_management_record)) != 0:
            info(
                "No vehicle management record was found for this license plate, "
                "probably none of the license plates are queryable now..."
            )
            raise NoVehicleManagementException()

        # MARK: Unreleased license plate
        elif len(selenium.find_elements(By.XPATH, XPATHS.unreleased_license_plate)) != 0:
            selenium.find_element(By.XPATH, XPATHS.error_modal_button).click()
            raise UnreleasedLPException()

        # MARK: Try again later
        elif len(selenium.find_elements(By.XPATH, XPATHS.try_again_later)) != 0:
            await helpers.send_to_client(
                sid,
                "message",
                f"Getting throttled, waiting {settings.WAIT_TIME} seconds...",
                -1,
                "pending",
            )

            selenium.find_element(By.XPATH, XPATHS.error_modal_button).click()
            await asyncio.sleep(0.5)

            await fill_search(sid, selenium, requested_car, settings.WAIT_TIME)
            retries += 1

        counter += 1

        try:
            WebDriverWait(selenium, 5).until(ec.presence_of_element_located((By.XPATH, XPATHS.error_modal)))
        except TimeoutException:
            return

    if counter == 10:
        raise Exception("Some kind of data was not found before searching for license plate")
