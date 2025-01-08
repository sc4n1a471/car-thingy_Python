import time

from selenium.common.exceptions import StaleElementReferenceException, ElementClickInterceptedException
from selenium.webdriver.common.by import By
from selenium.webdriver.support import expected_conditions as ec
from selenium.webdriver.support.wait import WebDriverWait

from application.data import settings
from application.data.xpaths import XPATHS
from application.models.Car import Car


async def get_mileage(car: Car):
    """Gets mileage information for the requested car

    Args:
        car (Car): Car object
    """

    WebDriverWait(settings.driver, 5).until(ec.element_to_be_clickable((By.XPATH, XPATHS.mileage_tab)))

    counter = 0
    while counter < 5:
        try:  # .click() is still intercepted even though the element is clickable...
            settings.driver.find_element(By.XPATH, XPATHS.mileage_tab).click()
            await settings.send_data("message", "Clicked on Mileage tab", 62, "pending")
            break
        except ElementClickInterceptedException:
            counter += 1
            time.sleep(0.25)
            continue

    await settings.send_data("message", "Searching for mileage data...", 62, "pending")

    counter = 0
    while counter < 5:
        WebDriverWait(settings.driver, 5).until(ec.presence_of_element_located((By.XPATH, XPATHS.mileage)))
        mileage_tbody = settings.driver.find_element(By.XPATH, XPATHS.mileage)
        mileage_rows = mileage_tbody.find_elements(By.TAG_NAME, "tr")

        for row in mileage_rows:
            try:
                tmp = row.text.split(" ")
                if tmp != [""]:
                    await settings.send_data("message", "FOUND: Mileage data", 70, "pending")
                    mileage_num = "".join(tmp[1:])
                    car.mileage.append(
                        {
                            "licensePlate": car.license_plate,
                            "date": tmp[0],
                            "mileage": int(mileage_num),
                        }
                    )
                    counter = 5
                else:
                    await settings.send_data(
                        "message",
                        "NOT FOUND: Mileage data, searching again...",
                        70,
                        "pending",
                    )
                    counter += 1
                    time.sleep(0.25)
                    break
            except StaleElementReferenceException:
                continue

    await settings.send_data("mileage", car.mileage, 70, "pending", True)
