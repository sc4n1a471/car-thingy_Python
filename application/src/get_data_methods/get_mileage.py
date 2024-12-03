import time

from selenium.common.exceptions import StaleElementReferenceException
from selenium.webdriver.common.by import By
from selenium.webdriver.support import expected_conditions as ec
from selenium.webdriver.support.wait import WebDriverWait

from application.data import settings
from application.data.xpaths import XPATHS


async def get_mileage(car):
    """
    Gets mileage information for the requested car
    :param car: car object
    """

    # WebDriverWait(settings.driver, 5).until(ec.presence_of_element_located((By.XPATH, XPATHS.mileage_tab)))
    settings.driver.find_element(By.XPATH, XPATHS.mileage_tab).click()
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
                    # car.mileage.append(Mileage(tmp[0], int(mileage_num)))
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
