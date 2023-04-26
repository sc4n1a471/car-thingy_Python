import time
from selenium.webdriver.common.by import By

from application.data import settings
from application.data.xpaths import XPATHS
def get_restrictions(car):
    """Gets all information on the requested car

    Attributes:
        car -- car object
    """
    settings.driver.find_element(By.XPATH, XPATHS.get("restrictions_tab")).click()
    print("CLICKED: Restrictions")
    time.sleep(settings.WAIT_TIME_TAB_CHANGE)
    restrictions = settings.driver.find_element(By.XPATH, XPATHS.get("restrictions"))
    restrictions_rows = restrictions.find_elements(By.TAG_NAME, "tr")
    print("FOUND: Restrictions")
    car.restrictions = []
    for row in restrictions_rows:
        car.restrictions.append(row.text)
