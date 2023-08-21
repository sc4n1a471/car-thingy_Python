from selenium.common.exceptions import StaleElementReferenceException
from selenium.webdriver.common.by import By
from selenium.webdriver.support import expected_conditions as ec
from selenium.webdriver.support.wait import WebDriverWait

from application.data import settings
from application.data.xpaths import XPATHS
from application.models.Accident import Accident


def get_accidents(car):
    """
    Gets the accidents found on accidents_tab
    :param car: car object
    """
    # WebDriverWait(settings.driver, 5).until(ec.presence_of_element_located((By.XPATH, XPATHS.get("accidents_tab"))))
    settings.driver.find_element(By.XPATH, XPATHS.get("accidents_tab")).click()
    print("CLICKED: Accidents")

    WebDriverWait(settings.driver, 1).until(ec.presence_of_element_located((By.XPATH, XPATHS.get("accidents"))))
    accidents_tbody = settings.driver.find_element(By.XPATH, XPATHS.get("accidents"))
    accidents_rows = accidents_tbody.find_elements(By.TAG_NAME, "tr")

    for row in accidents_rows:
        try:
            tmp = row.text.split(" ")
            role = ''.join(tmp[1:])
            if role != '':
                print("FOUND: Accidents")
                car.accidents.append(Accident(tmp[0], role))
            else:
                print("NOT FOUND: Accidents")
        except StaleElementReferenceException:
            continue