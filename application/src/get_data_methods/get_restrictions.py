import time

from selenium.common.exceptions import StaleElementReferenceException
from selenium.webdriver.common.by import By
from selenium.webdriver.support import expected_conditions as ec
from selenium.webdriver.support.wait import WebDriverWait

from application.data import settings
from application.data.xpaths import XPATHS
def get_restrictions(car):
    """
    Gets all information on the requested car
    :param car: car object
    """
    # WebDriverWait(settings.driver, 5).until(ec.presence_of_element_located((By.XPATH, XPATHS.get("restrictions_tab"))))
    settings.driver.find_element(By.XPATH, XPATHS.get("restrictions_tab")).click()
    print("CLICKED: Restrictions")

    counter = 0
    while counter < 5:
        WebDriverWait(settings.driver, 5).until(ec.presence_of_element_located((By.XPATH, XPATHS.get("restrictions"))))
        restrictions = settings.driver.find_element(By.XPATH, XPATHS.get("restrictions"))
        restrictions_rows = restrictions.find_elements(By.TAG_NAME, "tr")

        for row in restrictions_rows:
            try:
                tmp = row.text
                if tmp != '':
                    print("FOUND: Restrictions")
                    car.restrictions.append(tmp)
                    counter = 5
                else:
                    print("NOT FOUND: Restrictions, searching again...")
                    counter += 1
                    time.sleep(0.25)
                    break
            except:
                continue