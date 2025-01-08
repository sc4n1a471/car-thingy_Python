import asyncio
import time

from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support import expected_conditions as ec
from selenium.webdriver.support.wait import WebDriverWait
from selenium.common.exceptions import TimeoutException

from logging import info

from application.data import settings
from application.data.xpaths import XPATHS
from application.models.Car import Car
from .get_data_methods.get_car_data import get_car_data
from .login import login
from .logout import logout
from ..models.GetDataException import GetDataException
from ..models.LoginException import LoginException
from ..models.NoVehicleManagementException import NoVehicleManagementException
from ..models.UnreleasedLPException import UnreleasedLPException


async def get_data(requested_cars: list[str]):
    cold_start = True
    car_data: [Car] = []  # type: ignore
    for requested_car in requested_cars:
        car = Car()
        car.license_plate = requested_car.upper()

        if not cold_start:
            await settings.send_data(
                "message",
                f"Already logged in, waiting {settings.WAIT_TIME} sec...",
                -1,
                "pending",
            )
            time.sleep(settings.WAIT_TIME)
            settings.driver.get("https://magyarorszag.hu/jszp_szuf")

        try:
            WebDriverWait(settings.driver, 30).until(ec.presence_of_element_located((By.XPATH, XPATHS.request_page)))
            await settings.send_data("message", "FOUND: Jármű Szolgáltatási Platform", 14, "pending")
            settings.save_cookie()
        except Exception as e:
            raise GetDataException(e.args) from e

        await fill_search(requested_car)  # 16%

        try:
            await check_error_modal(car, requested_car)  # +4%
        except UnreleasedLPException as ulp:
            raise UnreleasedLPException from ulp

        settings.driver.switch_to.frame(1)

        WebDriverWait(settings.driver, 180).until(ec.presence_of_element_located((By.XPATH, XPATHS.car_page)))
        await settings.send_data("message", "FOUND: Car loaded", 20, "pending")

        WebDriverWait(settings.driver, 10).until(ec.presence_of_element_located((By.XPATH, XPATHS.brand)))

        await get_car_data(car)

        car_data.append(car)
        cold_start = False
        info("=================")

    return car_data


# MARK: Fill search input
async def fill_search(requested_car, wait=0):
    """
    Fills the search input and clicks search

    :param requested_car: license plate
    :param wait: seconds to wait before clicking search
    """
    settings.driver.switch_to.default_content()
    settings.driver.switch_to.frame(1)

    WebDriverWait(settings.driver, 10).until(ec.presence_of_element_located((By.XPATH, XPATHS.search_input)))
    settings.driver.find_element(By.XPATH, XPATHS.search_input).clear()
    settings.driver.find_element(By.XPATH, XPATHS.search_input).send_keys(requested_car)
    await settings.send_data("message", "FILLED: license plate", 15, "pending")

    await asyncio.sleep(wait)

    settings.driver.find_element(By.XPATH, XPATHS.search_input).send_keys(Keys.ENTER)
    await settings.send_data("message", "Searching for license plate...", 16, "pending")

    settings.driver.switch_to.default_content()


# MARK: Error modal handling
async def check_error_modal(car, requested_car):
    """
    Checks for error dialog after submitting license plate

    :param car: Car object that will be returned
    :param requested_car: Requested license plate
    """
    retries = 0
    counter = 0

    try:
        WebDriverWait(settings.driver, 5).until(ec.presence_of_element_located((By.XPATH, XPATHS.error_modal)))
    except TimeoutException:
        return

    while len(settings.driver.find_elements(By.XPATH, XPATHS.error_modal)) != 0 and counter != 10:
        await settings.send_data("message", "FOUND: ERROR DIALOG", -1, "pending")

        # MARK: No accident record
        if len(settings.driver.find_elements(By.XPATH, XPATHS.no_accident_record)) != 0:
            await settings.send_data(
                "message",
                "No accident record was found for this license plate, trying without that",
                -1,
                "pending",
            )

            car.has_accident_record = False

            settings.driver.find_element(By.XPATH, XPATHS.error_modal_button).click()

            settings.driver.switch_to.default_content()
            settings.driver.switch_to.frame(1)

            settings.driver.find_element(By.XPATH, XPATHS.accident_record_ckeckbox).click()
            await settings.send_data(
                "message",
                "DISABLED: Biztosítás és Kártörténet",
                17,
                "pending",
            )

            await fill_search(requested_car, 30)

        # MARK: No inspection record
        elif len(settings.driver.find_elements(By.XPATH, XPATHS.no_inspection_record)) != 0:
            await settings.send_data(
                "message",
                "No inspection record was found for this license plate, trying without that",
                -1,
                "pending",
            )
            car.has_inspection_record = False
            car.has_mileage_record = False

            settings.driver.find_element(By.XPATH, XPATHS.error_modal_button).click()

            settings.driver.switch_to.default_content()
            settings.driver.switch_to.frame(1)

            settings.driver.find_element(By.XPATH, XPATHS.inspection_record_ckeckbox).click()
            await settings.send_data(
                "message",
                "DISABLED: Műszaki állapotra vonatkozó adatok",
                17,
                "pending",
            )

            await fill_search(requested_car, 30)

        # MARK: No vehicle management record
        elif len(settings.driver.find_elements(By.XPATH, XPATHS.no_vehicle_management_record)) != 0:
            info(
                "No vehicle management record was found for this license plate, "
                "probably none of the license plates are queryable now..."
            )
            raise NoVehicleManagementException()

        # MARK: Unreleased license plate
        elif len(settings.driver.find_elements(By.XPATH, XPATHS.unreleased_license_plate)) != 0:
            settings.driver.find_element(By.XPATH, XPATHS.error_modal_button).click()
            raise UnreleasedLPException()

        # MARK: Try again later
        elif len(settings.driver.find_elements(By.XPATH, XPATHS.try_again_later)) != 0:
            await settings.send_data(
                "message",
                f"Getting throttled, waiting {settings.WAIT_TIME} seconds...",
                -1,
                "pending",
            )

            settings.driver.find_element(By.XPATH, XPATHS.error_modal_button).click()
            time.sleep(1)

            if retries > 1:
                await settings.send_data(
                    "message",
                    "Tried too many times, logging out and back in...",
                    -1,
                    "pending",
                )
                retries = 0

                try:
                    await logout()
                except Exception as e:
                    raise LoginException(f"LOGOUT ERROR: {e}") from e

                try:
                    await login(True)
                except Exception as e:
                    raise LoginException(f"LOGIN ERROR: {e}") from e

                WebDriverWait(settings.driver, 30).until(
                    ec.presence_of_element_located((By.XPATH, '//title[text() = "Jármű Szolgáltatási Platform"]'))
                )
                await settings.send_data(
                    "message",
                    "FOUND: Jármű Szolgáltatási Platform",
                    17,
                    "pending",
                )
                settings.driver.switch_to.frame(1)
                settings.driver.find_element(By.XPATH, '//input[@id="input-rendszam"]').send_keys(Keys.ENTER)
                await settings.send_data(
                    "message",
                    "Searching for license plate again...",
                    18,
                    "pending",
                )
                settings.driver.switch_to.default_content()
                continue

            await fill_search(requested_car, settings.WAIT_TIME)
            retries += 1

        counter += 1

        try:
            WebDriverWait(settings.driver, 5).until(ec.presence_of_element_located((By.XPATH, XPATHS.error_modal)))
        except TimeoutException:
            return

    if counter == 10:
        raise Exception("Some kind of data was not found before searching for license plate")
