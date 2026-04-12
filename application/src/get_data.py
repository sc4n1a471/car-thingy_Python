import asyncio

from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support import expected_conditions as ec
from selenium.common.exceptions import TimeoutException
from selenium.webdriver.remote.webdriver import WebDriver

from logging import info, error, exception

from application.data import helpers, settings
from application.data.xpaths import XPATHS
from application.models.Car import Car
from .get_data_methods.get_car_data import get_car_data
from ..models.GetDataException import GetDataException
from ..models.NoVehicleManagementException import NoVehicleManagementException
from ..models.UnreleasedLPException import UnreleasedLPException


# MARK: Get data function
async def get_data(sid: str, requested_cars: list[str], check_cookies=False) -> list[Car]:
    """Gets the data for the requested license plates, returns a list of Car objects

    Args:
        sid (str): ID of client connection
        requested_cars (list[str]): List of license plates to search for
        check_cookies (bool, optional): Whether to check cookies. Defaults to False.

    Raises:
        GetDataException: If there was an error during getting data, the exception is raised with the original exception as inner exception
        UnreleasedLPException: If the license plate is not released

    Returns:
        list[Car]: List of Car objects
    """
    selenium = helpers.car_requests[sid].selenium_session
    if selenium is None:
        raise GetDataException("Selenium session is None")
    car_data: list[Car] = []
    for requested_car in requested_cars:
        car = Car()
        car.license_plate = requested_car.upper()

        info(f"Check cookies or not: {check_cookies}")
        if check_cookies:
            try:
                counter = 0
                while counter < 5:
                    try:
                        selenium.switch_to.default_content()
                        selenium.switch_to.frame(5)
                        await helpers.async_wait_for(
                            selenium, ec.element_to_be_clickable((By.XPATH, XPATHS.accept_cookies)), timeout=1
                        )
                        break
                    except Exception:
                        counter += 1
                        info(f"Accept cookies button not found, retrying... ({counter}/5)")
                        await asyncio.sleep(1)
                if counter == 5:
                    info("Accept cookies button not found after 5 retries, continuing without accepting cookies")
                else:
                    selenium.find_element(By.XPATH, XPATHS.accept_cookies).click()
                    await helpers.send_to_client(sid, "message", "Accepted cookies", 13, "pending")
                    selenium.switch_to.default_content()
            except Exception as e:
                error(f"Accept cookies button not found or not clickable:")
                exception(e)

        try:
            counter = 0
            while counter < 5:
                try:
                    selenium.switch_to.default_content()
                    selenium.switch_to.frame(1)
                    await helpers.async_wait_for(
                        selenium, ec.element_to_be_clickable((By.XPATH, XPATHS.request_page)), timeout=1
                    )
                    break
                except Exception:
                    counter += 1
                    info(f"Request page not found, retrying... ({counter}/5)")
                    await asyncio.sleep(1)
            if counter == 5:
                raise GetDataException("Request page not found after 5 retries, maybe the page did not load?")
            await helpers.send_to_client(sid, "message", "FOUND: Jármű Szolgáltatási Platform", 14, "pending")
            settings.save_cookie(selenium)
        except Exception as e:
            raise GetDataException(e.args) from e

        try:
            wait_seconds = helpers.get_query_timestemp(helpers.car_requests[sid].x_api_key)
            if wait_seconds is None:
                raise GetDataException("Last query is None")
            await fill_search(sid, selenium, requested_car, wait=wait_seconds)  # 16%
        except Exception as e:
            raise GetDataException(e.args) from e

        try:
            await check_error_modal(sid, selenium, car, requested_car)  # +4%
        except UnreleasedLPException as ulp:
            raise UnreleasedLPException from ulp

        selenium.switch_to.default_content()
        selenium.switch_to.frame(1)

        await helpers.async_wait_for(selenium, ec.element_to_be_clickable((By.XPATH, XPATHS.car_page)), timeout=180)
        await helpers.send_to_client(sid, "message", "FOUND: Car loaded", 20, "pending")

        await helpers.async_wait_for(selenium, ec.element_to_be_clickable((By.XPATH, XPATHS.brand)), timeout=10)

        await get_car_data(sid, car)

        car_data.append(car)
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

    await helpers.async_wait_for(selenium, ec.presence_of_element_located((By.XPATH, XPATHS.search_input)), timeout=10)
    await helpers.async_wait_for(selenium, ec.element_to_be_clickable((By.XPATH, XPATHS.search_input)), timeout=10)
    selenium.find_element(By.XPATH, XPATHS.search_input).clear()
    selenium.find_element(By.XPATH, XPATHS.search_input).send_keys(requested_car)
    await helpers.send_to_client(sid, "message", f"FILLED: license plate, waiting {wait} seconds", 15, "pending")

    await asyncio.sleep(wait)

    helpers.create_query_timestamp(helpers.car_requests[sid].x_api_key, requested_car)
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
        await helpers.async_wait_for(
            selenium, ec.presence_of_element_located((By.XPATH, XPATHS.error_modal)), timeout=5
        )
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
            await helpers.async_wait_for(
                selenium, ec.presence_of_element_located((By.XPATH, XPATHS.error_modal)), timeout=5
            )
        except TimeoutException:
            return

    if counter == 10:
        raise Exception("Some kind of data was not found before searching for license plate")
