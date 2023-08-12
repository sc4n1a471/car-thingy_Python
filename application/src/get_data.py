import time

from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support import expected_conditions as ec
from selenium.webdriver.support.wait import WebDriverWait
from selenium.common.exceptions import TimeoutException

from application.data import settings
from application.data.xpaths import XPATHS
from application.models.Car import Car
from .get_data_methods.get_car_data import get_car_data
from .login import login
from .logout import logout
from ..models import GetDataException
from ..models.LoginException import LoginException
from ..models.NoVehicleManagementException import NoVehicleManagementException
from ..models.UnreleasedLPException import UnreleasedLPException


def get_data(requested_cars: [Car]):
    cold_start = True
    car_data: [Car] = []
    for requested_car in requested_cars:
        car = Car()
        car.license_plate = requested_car.upper()

        print(f"{requested_car} is on the way...")

        if not cold_start:
            print(f"Already logged in, waiting {settings.WAIT_TIME} sec...")
            time.sleep(settings.WAIT_TIME)
            settings.driver.get("https://magyarorszag.hu/jszp_szuf")

        try:
            WebDriverWait(settings.driver, 30).until(
                ec.presence_of_element_located((By.XPATH, XPATHS.get("request_page"))))
            print("FOUND: Jármű Szolgáltatási Platform")
            settings.save_cookie()
        except Exception as e:
            raise GetDataException from e

        fill_search(requested_car)

        try:
            check_error_modal(car, requested_car)
        except UnreleasedLPException as ulp:
            raise UnreleasedLPException from ulp

        settings.driver.switch_to.frame(1)

        WebDriverWait(settings.driver, 180)\
            .until(ec.presence_of_element_located((By.XPATH, XPATHS.get("car_page"))))
        print("Car loaded")

        WebDriverWait(settings.driver, 10)\
            .until(ec.presence_of_element_located((By.XPATH, XPATHS.get("brand"))))

        get_car_data(car)

        car_data.append(car)
        cold_start = False
        print(f"Changed cold_start to {cold_start}")
        print("=================")

    return car_data

def fill_search(requested_car, wait = 0):
    """Fills the search input and clicks search

    Attributes:
        requested_car -- license plate
        wait -- seconds to wait before clicking search
    """
    settings.driver.switch_to.default_content()
    settings.driver.switch_to.frame(1)

    WebDriverWait(settings.driver, 10) \
        .until(ec.presence_of_element_located((By.XPATH, XPATHS.get("search_input"))))
    settings.driver.find_element(By.XPATH, XPATHS.get("search_input")).clear()
    settings.driver.find_element(By.XPATH, XPATHS.get("search_input")).send_keys(requested_car)
    print("FILLED: license plate")

    time.sleep(wait)

    settings.driver.find_element(By.XPATH, XPATHS.get("search_input")).send_keys(Keys.ENTER)
    print("Searching for license plate...")

    settings.driver.switch_to.default_content()

def check_error_modal(car, requested_car):
    """Checks for error dialog after submitting license plate

    Attributes:
        car -- Car object that will be returned
        requested_car -- Requested license plate
    """
    retries = 0
    counter = 0

    try:
        WebDriverWait(settings.driver, 5).until(ec.presence_of_element_located((By.XPATH, XPATHS.get("error_modal"))))
    except TimeoutException:
        return

    while len(settings.driver.find_elements(By.XPATH, XPATHS.get("error_modal"))) != 0 and counter != 10:
        print("FOUND: ERROR DIALOG")

        if len(settings.driver.find_elements(By.XPATH, XPATHS.get("no_accident_record"))) != 0:
            print("No accident record was found for this license plate, trying without that")
            car.has_accident_record = False

            settings.driver.find_element(By.XPATH, XPATHS.get("error_modal_button")).click()

            settings.driver.switch_to.default_content()
            settings.driver.switch_to.frame(1)

            settings.driver.find_element(By.XPATH, XPATHS.get("accident_record_ckeckbox")).click()
            print("CLICKED: Disabled Biztosítás és Kártörténet")

            fill_search(requested_car, 30)

        elif len(settings.driver.find_elements(By.XPATH, XPATHS.get("no_inspection_record"))) != 0:
            print("No inspection record was found for this license plate, trying without that")
            car.has_inspection_record = False
            car.has_mileage_record = False

            settings.driver.find_element(By.XPATH, XPATHS.get("error_modal_button")).click()

            settings.driver.switch_to.default_content()
            settings.driver.switch_to.frame(1)

            settings.driver.find_element(By.XPATH, XPATHS.get("inspection_record_ckeckbox")).click()
            print("CLICKED: Disabled Műszaki állapotra vonatkozó adatok")

            fill_search(requested_car, 30)

        elif len(settings.driver.find_elements(By.XPATH, XPATHS.get("no_vehicle_management_record"))) != 0:
            print("No vehicle management record was found for this license plate, "
                  "probably none of the license plates are queryable now...")
            raise NoVehicleManagementException()

        elif len(settings.driver.find_elements(By.XPATH, XPATHS.get("unreleased_license_plate"))) != 0:
            print("This license plate was not released, no car was found")
            settings.driver.find_element(By.XPATH, XPATHS.get("error_modal_button")).click()
            raise UnreleasedLPException()

        elif len(settings.driver.find_elements(By.XPATH, XPATHS.get("try_again_later"))) != 0:
            print(f"Getting throttled, waiting {settings.WAIT_TIME} seconds...")
            settings.driver.find_element(By.XPATH, XPATHS.get("error_modal_button")).click()
            time.sleep(1)

            if retries > 1:
                print("Tried too many times, logging out and back in...")
                retries = 0

                try:
                    logout()
                except Exception as e:
                    raise LoginException(f"LOGOUT ERROR: {e}") from e

                try:
                    login(True)
                except Exception as e:
                    raise LoginException(f"LOGIN ERROR: {e}") from e

                WebDriverWait(settings.driver, 30).until(
                    ec.presence_of_element_located((By.XPATH, '//title[text() = "Jármű Szolgáltatási Platform"]')))
                print("FOUND: Jármű Szolgáltatási Platform")
                settings.driver.switch_to.frame(1)
                settings.driver.find_element(By.XPATH, '//input[@id="input-rendszam"]').send_keys(Keys.ENTER)
                print("Searching for license plate again...")
                settings.driver.switch_to.default_content()
                continue

            fill_search(requested_car, settings.WAIT_TIME)
            retries += 1

        counter += 1

    if counter == 10:
        raise Exception("Some kind of data was not found before searching for license plate")