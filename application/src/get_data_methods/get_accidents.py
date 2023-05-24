import time

from selenium.webdriver.common.by import By

from application.data import settings
from application.data.xpaths import XPATHS
from application.models.Accident import Accident


def get_accidents(car):
    """Gets the accidents found on accidents_tab

    Attributes:
        car -- car object
    """
    settings.driver.find_element(By.XPATH, XPATHS.get("accidents_tab")).click()
    print("CLICKED: Accidents")
    time.sleep(settings.WAIT_TIME_TAB_CHANGE)
    accidents_tbody = settings.driver.find_element(By.XPATH, XPATHS.get("accidents"))
    accidents_rows = accidents_tbody.find_elements(By.TAG_NAME, "tr")
    print("FOUND: Accidents")

    for row in accidents_rows:
        tmp = row.text.split(" ")
        accident_text = ''.join(tmp[1:])
        car.accidents.append(Accident(tmp[0], accident_text))
