import time

from selenium.webdriver.common.by import By
from selenium.webdriver.support import expected_conditions as ec
from selenium.webdriver.support.wait import WebDriverWait

from application.data import settings
from application.data.xpaths import XPATHS


async def get_restrictions(car):
    """
    Gets all information on the requested car
    :param car: car object
    """
    WebDriverWait(settings.driver, 5).until(ec.element_to_be_clickable((By.XPATH, XPATHS.restrictions_tab)))
    counter = 0
    while counter < 5:
        try:
            settings.driver.find_element(By.XPATH, XPATHS.restrictions_tab).click()
            break
        except:
            counter += 1
            time.sleep(0.25)
            continue
    if counter == 5:
        await settings.send_data("message", "Restrictions tab not found", 49, "pending")
        return

    await settings.send_data("message", "Searching for restrictions...", 49, "pending")

    counter = 0
    while counter < 5:
        WebDriverWait(settings.driver, 5).until(ec.presence_of_element_located((By.XPATH, XPATHS.restrictions)))
        restrictions = settings.driver.find_element(By.XPATH, XPATHS.restrictions)
        restrictions_rows = restrictions.find_elements(By.TAG_NAME, "tr")

        for row in restrictions_rows:
            try:
                tmp = row.text
                if tmp != "":
                    await settings.send_data("message", "FOUND: Restrictions", 60, "pending")
                    car.restrictions.append(tmp)
                    counter = 5
                else:
                    await settings.send_data(
                        "message",
                        "NOT FOUND: Restrictions, searching again...",
                        -1,
                        "pending",
                    )
                    counter += 1
                    time.sleep(0.25)
                    break
            except:
                continue

    await settings.send_data("restrictions", car.restrictions, 60, "pending", True)
