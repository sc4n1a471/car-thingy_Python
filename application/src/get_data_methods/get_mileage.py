import time

from selenium.webdriver.common.by import By

from application.data import settings
from application.data.xpaths import XPATHS
def get_mileage(car):
    """Gets mileage information for the requested car

        Attributes:
            car -- car object
    """
    settings.driver.find_element(By.XPATH, XPATHS.get("mileage_tab")).click()
    print("CLICKED: Mileage")
    time.sleep(settings.WAIT_TIME_TAB_CHANGE)
    mileage_tbody = settings.driver.find_element(By.XPATH, XPATHS.get("mileage"))
    mileage_rows = mileage_tbody.find_elements(By.TAG_NAME, "tr")
    print("FOUND: Mileage data")
    car.mileage = {}
    for row in mileage_rows:
        tmp = row.text.split(" ")
        mileage_num = ''.join(tmp[1:])
        car.mileage[tmp[0]] = int(mileage_num)
