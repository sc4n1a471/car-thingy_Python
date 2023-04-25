import time

from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support import expected_conditions as ec
from selenium.webdriver.support.wait import WebDriverWait

from ..data import settings
from ..data.xpaths import XPATHS
from ..models.Car import Car
from .get_data_methods.get_car_data import get_car_data
from .login import login
from .logout import logout


def get_data(requested_cars: [Car]):
    cold_start = True
    car_data: [Car] = []
    for requested_car in requested_cars:
        car = Car()
        car.license_plate = requested_car

        counter = 0
        print(f"Requesting {requested_car}...")

        if not cold_start:
            print(f"Already logged in, waiting {settings.wait_time}+{settings.wait_time} sec...")
            time.sleep(settings.wait_time)
            settings.driver.get("https://magyarorszag.hu/jszp_szuf")
            time.sleep(settings.wait_time)

        WebDriverWait(settings.driver, 30).until(
            ec.presence_of_element_located((By.XPATH, '//title[text() = "Jármű Szolgáltatási Platform"]')))
        print("FOUND: Jármű Szolgáltatási Platform")

        settings.driver.switch_to.frame(1)

        settings.driver.find_element(By.XPATH, '//input[@id="input-rendszam"]').send_keys(requested_car)
        print("FILLED: license plate")

        settings.driver.find_element(By.XPATH, '//input[@id="input-rendszam"]').send_keys(Keys.ENTER)
        print("Searching for license plate")

        settings.driver.switch_to.default_content()
        time.sleep(3)
        # print(len(settings.driver.find_elements(By.XPATH, XPATHS.get("error_modal"))))
        while len(settings.driver.find_elements(By.XPATH, XPATHS.get("error_modal"))) != 0:

            print("Getting throttled...")
            settings.driver.find_element(By.XPATH, XPATHS.get("error_modal_button")).click()
            time.sleep(1)

            if counter > 1:
                print("Tried too many times, logging out and back in...")
                counter = 0

                try:
                    logout()
                except Exception as e:
                    raise Exception(f"LOGOUT ERROR: {e}")

                try:
                    login(True)
                except Exception as e:
                    raise Exception(f"LOGIN ERROR: {e}")

                WebDriverWait(settings.driver, 30).until(
                    ec.presence_of_element_located((By.XPATH, '//title[text() = "Jármű Szolgáltatási Platform"]')))
                print("FOUND: Jármű Szolgáltatási Platform")
                settings.driver.switch_to.frame(1)
                settings.driver.find_element(By.XPATH, '//input[@id="input-rendszam"]').send_keys(Keys.ENTER)
                print("Searching for license plate again...")
                settings.driver.switch_to.default_content()
                continue

            settings.driver.switch_to.frame(1)
            settings.driver.find_element(By.XPATH, '//input[@id="input-rendszam"]').send_keys(Keys.ENTER)
            print("Searching for license plate again...")
            settings.driver.switch_to.default_content()
            time.sleep(20)
            counter += 1


        settings.driver.switch_to.frame(1)

        WebDriverWait(settings.driver, 180).until(ec.presence_of_element_located((By.XPATH, '//h1[@id="header-jarmu_adatai"]')))
        print("Car loaded")

        WebDriverWait(settings.driver, 10).until(ec.presence_of_element_located((By.XPATH, XPATHS.get("brand"))))

        get_car_data(car)

        car_data.append(car)
        cold_start = False
        print(f"Changed cold_start to {cold_start}")
        print("=================")

    return car_data