import time

from selenium.webdriver.common.by import By
from selenium.webdriver.support import expected_conditions as ec
from selenium.webdriver.support.wait import WebDriverWait

from application.data import settings
from application.data.xpaths import XPATHS
from application.models.Mileage import Mileage


def get_mileage(car):
    """Gets mileage information for the requested car

        Attributes:
            car -- car object
    """

    # WebDriverWait(settings.driver, 5).until(ec.presence_of_element_located((By.XPATH, XPATHS.get("mileage_tab"))))
    settings.driver.find_element(By.XPATH, XPATHS.get("mileage_tab")).click()
    print("CLICKED: Mileage")

    counter = 0
    while counter < 5:
        WebDriverWait(settings.driver, 5).until(ec.presence_of_element_located((By.XPATH, XPATHS.get("mileage"))))
        mileage_tbody = settings.driver.find_element(By.XPATH, XPATHS.get("mileage"))
        mileage_rows = mileage_tbody.find_elements(By.TAG_NAME, "tr")

        for row in mileage_rows:
            tmp = row.text.split(" ")
            if tmp != ['']:
                print("FOUND: Mileage data")
                mileage_num = ''.join(tmp[1:])
                car.mileage.append(Mileage(tmp[0], int(mileage_num)))
                counter = 5
            else:
                print("NOT FOUND: Mileage data, searching again...")
                counter += 1
                time.sleep(0.25)
                break
