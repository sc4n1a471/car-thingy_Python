import time

from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support import expected_conditions as ec
from selenium.webdriver.support.wait import WebDriverWait

from application.data import settings
from application.data.xpaths import XPATHS
from application.models.Car import Car
from .get_data_methods.get_car_data import get_car_data
from .login import login
from .logout import logout
from ..models import GetDataException
from ..models.LoginException import LoginException
from ..models.UnreleasedLPException import UnreleasedLPException


def get_data(requested_cars: [Car]):
    cold_start = True
    car_data: [Car] = []
    for requested_car in requested_cars:
        car = Car()
        car.license_plate = requested_car.upper()

        print(f"{requested_car} is on the way...")

        if not cold_start:
            print(f"Already logged in, waiting {settings.WAIT_TIME}+{settings.WAIT_TIME} sec...")
            time.sleep(settings.WAIT_TIME)
            settings.driver.get("https://magyarorszag.hu/jszp_szuf")
            time.sleep(settings.WAIT_TIME)

        try:
            WebDriverWait(settings.driver, 30).until(
                ec.presence_of_element_located((By.XPATH, '//title[text() = "Jármű Szolgáltatási Platform"]')))
            print("FOUND: Jármű Szolgáltatási Platform")
        except Exception as e:
            raise GetDataException from e

        fill_search(requested_car)

        time.sleep(3)

        try:
            check_error_modal(car, requested_car)
        except UnreleasedLPException as ulp:
            raise UnreleasedLPException from ulp

        settings.driver.switch_to.frame(1)

        WebDriverWait(settings.driver, 180)\
            .until(ec.presence_of_element_located((By.XPATH, '//h1[@id="header-jarmu_adatai"]')))
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

    while len(settings.driver.find_elements(By.XPATH, XPATHS.get("error_modal"))) != 0:
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

        elif len(settings.driver.find_elements(By.XPATH, XPATHS.get("unreleased_license_plate"))) != 0:
            print("This license plate was not released, no car was found")
            settings.driver.find_element(By.XPATH, XPATHS.get("error_modal_button")).click()
            raise UnreleasedLPException()

        elif len(settings.driver.find_elements(By.XPATH, XPATHS.get("try_again_later"))) != 0:
            print("Getting throttled...")
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

            fill_search(requested_car, 30)
            retries += 1
