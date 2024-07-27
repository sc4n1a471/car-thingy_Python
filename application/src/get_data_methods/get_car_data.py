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
    """
    Gets all information on the requested car

    :param car: car object
    """

    # MARK: Get specs
    WebDriverWait(settings.driver, 5).until(ec.presence_of_element_located((By.XPATH, XPATHS.brand)))
    car.brand = settings.driver.find_element(By.XPATH, XPATHS.brand).text
    await settings.send_data("brand", car.brand, 25, "pending")

    try:
        car.model = settings.driver.find_element(By.XPATH, XPATHS.model).text
        await settings.send_data("model", car.model, 27, "pending")
    except NoSuchElementException:
        await settings.send_data("message", "NOT FOUND: Model", 27, "pending")

    try:
        car.type_code = settings.driver.find_element(By.XPATH, XPATHS.type_code).text
        await settings.send_data("type_code", car.type_code, 29, "pending")
    except NoSuchElementException:
        await settings.send_data("message", "NOT FOUND: Type_code", 29, "pending")

    try:
        car.status = settings.driver.find_element(By.XPATH, XPATHS.status).text
        await settings.send_data("status", car.status, 31, "pending")
    except NoSuchElementException:
        await settings.send_data("message", "NOT FOUND: Status", 29, "pending")

    if not settings.TESTING:
        settings.driver.switch_to.default_content()
        iframe = settings.driver.find_element(By.XPATH, XPATHS.main_frame)
        settings.driver.switch_to.frame(iframe)

    if len(settings.driver.find_elements(By.XPATH, XPATHS.no_official_data)) != 0:
        await settings.send_data("message", "NOT FOUND: Official records", 47, "pending")
    else:
        WebDriverWait(settings.driver, 10).until(ec.presence_of_element_located((By.XPATH, XPATHS.first_reg)))
        car.first_reg = settings.driver.find_elements(By.XPATH, XPATHS.first_reg)[0].text
        await settings.send_data("first_reg", car.first_reg, 31, "pending")

        car.first_reg_hun = settings.driver.find_elements(By.XPATH, XPATHS.first_reg_hun)[0].text
        await settings.send_data("first_reg_hun", car.first_reg_hun, 33, "pending")

        car.num_of_owners = int(settings.driver.find_elements(By.XPATH, XPATHS.num_of_owners)[0].text)
        await settings.send_data("num_of_owners", car.num_of_owners, 35, "pending")

        car.year = int(settings.driver.find_elements(By.XPATH, XPATHS.year)[0].text)
        await settings.send_data("year", car.year, 37, "pending")

        car.fuel_type = settings.driver.find_elements(By.XPATH, XPATHS.fuel_type)[0].text
        await settings.send_data("fuel_type", car.fuel_type, 39, "pending")

        if not car.fuel_type.lower() == "elektromos":
            car.engine_size = settings.driver.find_elements(By.XPATH, XPATHS.engine_size)[0].text
            car.engine_size = int(car.engine_size.replace(" ", "").replace("cm³", ""))
            await settings.send_data("engine_size", car.engine_size, 41, "pending")

        if (
            car.brand == ""
            and car.model == ""
            and car.status == ""
            and car.type_code == ""
            and car.first_reg == ""
            and car.first_reg_hun == ""
            and car.num_of_owners == ""
        ):
            raise GetDataException("All found data is empty")

        car.performance = settings.driver.find_elements(By.XPATH, XPATHS.performance)[0].text
        car.performance = car.performance.replace(" kW", "")
        car.performance = int(int(car.performance) * 1.34)  # convert kW to HP
        await settings.send_data("performance", car.performance, 43, "pending")

        car.gearbox = settings.driver.find_elements(By.XPATH, XPATHS.gearbox)[0].text
        tmp = car.gearbox.split(" ")
        car.gearbox = tmp[2]
        await settings.send_data("gearbox", car.gearbox, 45, "pending")

        car.color = settings.driver.find_elements(By.XPATH, XPATHS.color)[0].text
        tmp = car.color.split(" ")
        car.color = tmp[1]
        await settings.send_data("color", car.color, 47, "pending")

    # 47%

    # MARK: Get restrictions
    if car.has_restriction_record:
        try:
            await get_restrictions(car)  # 60%
        except Exception as exc:
            raise GetDataException(f"GET_RESTRICTIONS_ERROR: {traceback.format_exc()}") from exc

    # MARK: Get mileage
    if car.has_mileage_record:
        try:
            await get_mileage(car)  # 70%
        except Exception as exc:
            raise GetDataException(f"GET_MILEAGE_ERROR: {traceback.format_exc()}") from exc

    # MARK: Get accidents
    if car.has_accident_record:
        try:
            await get_accidents(car)  # 80%
        except Exception as exc:
            raise GetDataException(f"GET_ACCIDENTS_ERROR: {traceback.format_exc()}") from exc

    # MARK: Get images
    if car.has_inspection_record and not settings.TESTING:
        try:
            await get_images(car)  # 98%
        except Exception as exc:
            raise GetDataException(f"GET_IMAGES_ERROR: {traceback.format_exc()}") from exc
