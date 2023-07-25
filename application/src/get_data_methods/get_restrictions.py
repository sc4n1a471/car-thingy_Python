import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support import expected_conditions as ec
from selenium.webdriver.support.wait import WebDriverWait

from application.data import settings
from application.data.xpaths import XPATHS
def get_restrictions(car):
    """Gets all information on the requested car

    Attributes:
        car -- car object
    """
    # WebDriverWait(settings.driver, 5).until(ec.presence_of_element_located((By.XPATH, XPATHS.get("restrictions_tab"))))
    settings.driver.find_element(By.XPATH, XPATHS.get("restrictions_tab")).click()
    print("CLICKED: Restrictions")

    WebDriverWait(settings.driver, 1).until(ec.presence_of_element_located((By.XPATH, XPATHS.get("restrictions"))))
    restrictions = settings.driver.find_element(By.XPATH, XPATHS.get("restrictions"))
    restrictions_rows = restrictions.find_elements(By.TAG_NAME, "tr")
    for row in restrictions_rows:
        if row.text != "":
            print("FOUND: Restrictions")
            car.restrictions.append(row.text)
        else:
            print("NOT FOUND: Restrictions")
