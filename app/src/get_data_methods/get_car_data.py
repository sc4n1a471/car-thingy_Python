from selenium.webdriver.common.by import By
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.support import expected_conditions as ec
import time

import app.data.settings as settings
import app.data.xpaths as xpaths
from app.src.get_data_methods.get_accidents import get_accidents
from app.src.get_data_methods.get_images import get_images
from app.src.get_data_methods.get_mileage import get_mileage
from app.src.get_data_methods.get_restrictions import get_restrictions


def get_car_data(car):
    car.brand = settings.driver.find_element(By.XPATH, xpaths.XPATHS.get("brand")).text
    print(f"FOUND: Brand {car.brand}")

    car.model = settings.driver.find_element(By.XPATH, xpaths.XPATHS.get("model")).text
    print(f"FOUND: Model {car.model}")

    car.type_code = settings.driver.find_element(By.XPATH, xpaths.XPATHS.get("type_code")).text
    print(f"FOUND: Type_code {car.type_code}")

    car.status = settings.driver.find_element(By.XPATH, xpaths.XPATHS.get("status")).text
    print(f"FOUND: Status {car.status}")

    settings.driver.switch_to.default_content()
    iframe = settings.driver.find_element(By.XPATH, '//*[@id="main"]/iframe')
    settings.driver.switch_to.frame(iframe)
    print("Switched to selected iframe")

    WebDriverWait(settings.driver, 10).until(ec.presence_of_element_located((By.XPATH, xpaths.XPATHS.get("first_reg"))))
    car.first_reg = settings.driver.find_elements(By.XPATH, xpaths.XPATHS.get("first_reg"))[0].text
    print(f"FOUND: First_reg {car.first_reg}")

    car.first_reg_hun = settings.driver.find_elements(By.XPATH, xpaths.XPATHS.get("first_reg_hun"))[0].text
    print(f"FOUND: First_reg_hun {car.first_reg_hun}")

    car.num_of_owners = settings.driver.find_elements(By.XPATH, xpaths.XPATHS.get("num_of_owners"))[0].text
    print(f"FOUND: Num_of_owners {car.num_of_owners}")

    car.year = settings.driver.find_elements(By.XPATH, xpaths.XPATHS.get("year"))[0].text
    print(f"FOUND: Year {car.year}")

    car.fuel_type = settings.driver.find_elements(By.XPATH, xpaths.XPATHS.get("fuel_type"))[0].text
    print(f"FOUND: Fuel_type {car.fuel_type}")

    if not car.fuel_type == "ELEKTROMOS":
        car.engine_size = settings.driver.find_elements(By.XPATH, xpaths.XPATHS.get("engine_size"))[0].text
        print(f"FOUND: Engine_size {car.engine_size}")
        car.engine_size = car.engine_size.replace(" ", "").replace("cm³", "")

    if car.brand == '' and car.model == '' and car.status == '' and car.type_code == '' and car.first_reg == '' and car.first_reg_hun == '' and car.num_of_owners == '':
        raise Exception("All found data is empty")

    car.performance = settings.driver.find_elements(By.XPATH, xpaths.XPATHS.get("performance"))[0].text
    print(f"FOUND: Performance {car.performance}")
    car.performance = car.performance.replace(" kW", "")
    car.performance = int(int(car.performance) * 1.34)  # convert kW to HP

    car.gearbox = settings.driver.find_elements(By.XPATH, xpaths.XPATHS.get("gearbox"))[0].text
    print(f"FOUND: Gearbox {car.gearbox}")
    tmp = car.gearbox.split(" ")
    car.gearbox = tmp[2]

    car.color = settings.driver.find_elements(By.XPATH, xpaths.XPATHS.get("color"))[0].text
    print(f"FOUND: Color {car.color}")
    tmp = car.color.split(" ")
    car.color = tmp[1]

    time.sleep(settings.wait_time_tab_change)
    try:
        get_restrictions(car)
    except Exception as exc:
        raise Exception(f'GET_RESTRICTIONS_ERROR: {exc}')

    settings.driver.find_element(By.XPATH, xpaths.XPATHS.get("mileage_tab")).click()
    print(f"CLICKED: Mileage")
    time.sleep(settings.wait_time_tab_change)
    try:
        get_mileage(car)
    except Exception as exc:
        raise Exception(f'GET_MILEAGE_ERROR: {exc}')

    settings.driver.find_element(By.XPATH, xpaths.XPATHS.get("accidents_tab")).click()
    print(f"CLICKED: Accidents")
    time.sleep(settings.wait_time_tab_change)
    try:
        get_accidents(car)
    except Exception as exc:
        raise Exception(f'GET_ACCIDENTS_ERROR: {exc}')

    settings.driver.find_element(By.XPATH, xpaths.XPATHS.get("condition_inspections_tab")).click()
    print(f"CLICKED: Condition Inspections")
    time.sleep(settings.wait_time_tab_change)
    try:
        get_images(car)
    except Exception as exc:
        raise Exception(f'GET_IMAGES_ERROR: {exc}')

    asd = 0