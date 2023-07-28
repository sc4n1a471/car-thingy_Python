import time

from selenium.webdriver.common.by import By
from selenium.webdriver.support import expected_conditions as ec
from selenium.webdriver.support.wait import WebDriverWait

from application.data import settings
from application.data.xpaths import XPATHS
from application.models.Mileage import Mileage


async def get_mileage(car):
    """Gets mileage information for the requested car

        Attributes:
            car -- car object
    """

    # WebDriverWait(settings.driver, 5).until(ec.presence_of_element_located((By.XPATH, XPATHS.get("mileage_tab"))))
    settings.driver.find_element(By.XPATH, XPATHS.get("mileage_tab")).click()
    await settings.send_message("CLICKED: Mileage")

    WebDriverWait(settings.driver, 1).until(ec.presence_of_element_located((By.XPATH, XPATHS.get("mileage"))))
    mileage_tbody = settings.driver.find_element(By.XPATH, XPATHS.get("mileage"))

    WebDriverWait(settings.driver, 1).until(ec.presence_of_element_located((By.TAG_NAME, "tr")))
    mileage_rows = mileage_tbody.find_elements(By.TAG_NAME, "tr")

    for row in mileage_rows:
        tmp = row.text.split(" ")
        if tmp != ['']:
            await settings.send_message("FOUND: Mileage data")
            mileage_num = ''.join(tmp[1:])
            car.mileage.append(Mileage(tmp[0], int(mileage_num)))
        else:
            await settings.send_message("NOT FOUND: Mileage data")
