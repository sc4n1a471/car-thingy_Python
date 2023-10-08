import traceback

from selenium.common import NoSuchElementException
from selenium.webdriver.common.by import By
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.support import expected_conditions as ec

from application.data import settings
from application.data.xpaths import XPATHS
from ..get_data_methods.get_accidents import get_accidents
from ..get_data_methods.get_images import get_images
from ..get_data_methods.get_mileage import get_mileage
from ..get_data_methods.get_restrictions import get_restrictions
from ...models.GetDataException import GetDataException


async def get_car_data(car):
    """Gets all information on the requested car

    Attributes:
        car -- car object
    """
    WebDriverWait(settings.driver, 5).until(
        ec.presence_of_element_located((By.XPATH, XPATHS.get("brand"))))
    car.brand = settings.driver.find_element(By.XPATH, XPATHS.get("brand")).text
    await settings.send_message(f"FOUND: Brand {car.brand}")

    try:
        car.model = settings.driver.find_element(By.XPATH, XPATHS.get("model")).text
        await settings.send_message(f"FOUND: Model {car.model}")
    except NoSuchElementException:
        await settings.send_message("NOT FOUND: Model")

    try:
        car.type_code = settings.driver.find_element(By.XPATH, XPATHS.get("type_code")).text
        await settings.send_message(f"FOUND: Type_code {car.type_code}")
    except NoSuchElementException:
        await settings.send_message("NOT FOUND: Type_code")

    try:
        car.status = settings.driver.find_element(By.XPATH, XPATHS.get("status")).text
        await settings.send_message(f"FOUND: Status {car.status}")
    except NoSuchElementException:
        await settings.send_message("NOT FOUND: Status")

    if not settings.TESTING:
        settings.driver.switch_to.default_content()
        iframe = settings.driver.find_element(By.XPATH, XPATHS.get("main_frame"))
        settings.driver.switch_to.frame(iframe)
        await settings.send_message("Switched to selected iframe")

    if len(settings.driver.find_elements(By.XPATH, XPATHS.get('no_official_data'))) != 0:
        await settings.send_message("NOT FOUND: Official records")
    else:
        WebDriverWait(settings.driver, 10).until(
            ec.presence_of_element_located((By.XPATH, XPATHS.get("first_reg"))))
        car.first_reg = settings.driver.find_elements(By.XPATH, XPATHS.get("first_reg"))[0].text
        await settings.send_message(f"FOUND: First_reg {car.first_reg}")

        car.first_reg_hun = settings.driver.find_elements(By.XPATH, XPATHS.get("first_reg_hun"))[0].text
        await settings.send_message(f"FOUND: First_reg_hun {car.first_reg_hun}")

        car.num_of_owners = int(settings.driver.find_elements(By.XPATH, XPATHS.get("num_of_owners"))[0].text)
        await settings.send_message(f"FOUND: Num_of_owners {car.num_of_owners}")

        car.year = int(settings.driver.find_elements(By.XPATH, XPATHS.get("year"))[0].text)
        await settings.send_message(f"FOUND: Year {car.year}")

        car.fuel_type = settings.driver.find_elements(By.XPATH, XPATHS.get("fuel_type"))[0].text
        await settings.send_message(f"FOUND: Fuel_type {car.fuel_type}")

        if not car.fuel_type.lower() == "elektromos":
            car.engine_size = settings.driver.find_elements(By.XPATH, XPATHS.get("engine_size"))[0].text
            await settings.send_message(f"FOUND: Engine_size {car.engine_size}")
            car.engine_size = int(car.engine_size.replace(" ", "").replace("cm³", ""))

        if car.brand == '' and \
                car.model == '' and \
                car.status == '' and \
                car.type_code == '' and \
                car.first_reg == '' and \
                car.first_reg_hun == '' and \
                car.num_of_owners == '':
            raise GetDataException("All found data is empty")

        car.performance = settings.driver.find_elements(By.XPATH, XPATHS.get("performance"))[0].text
        await settings.send_message(f"FOUND: Performance {car.performance}")
        car.performance = car.performance.replace(" kW", "")
        car.performance = int(int(car.performance) * 1.34)  # convert kW to HP

        car.gearbox = settings.driver.find_elements(By.XPATH, XPATHS.get("gearbox"))[0].text
        await settings.send_message(f"FOUND: Gearbox {car.gearbox}")
        tmp = car.gearbox.split(" ")
        car.gearbox = tmp[2]

        car.color = settings.driver.find_elements(By.XPATH, XPATHS.get("color"))[0].text
        await settings.send_message(f"FOUND: Color {car.color}")
        tmp = car.color.split(" ")
        car.color = tmp[1]

    if car.has_restriction_record:
        try:
            await get_restrictions(car)
        except Exception as exc:
            raise GetDataException(f'GET_RESTRICTIONS_ERROR: {traceback.format_exc()}') from exc

    if car.has_mileage_record:
        try:
            await get_mileage(car)
        except Exception as exc:
            raise GetDataException(f'GET_MILEAGE_ERROR: {traceback.format_exc()}') from exc

    if car.has_accident_record:
        try:
            await get_accidents(car)
        except Exception as exc:
            raise GetDataException(f'GET_ACCIDENTS_ERROR: {traceback.format_exc()}') from exc

    if car.has_inspection_record and not settings.TESTING:
        try:
            await get_images(car)
        except Exception as exc:
            raise GetDataException(f'GET_IMAGES_ERROR: {traceback.format_exc()}') from exc
