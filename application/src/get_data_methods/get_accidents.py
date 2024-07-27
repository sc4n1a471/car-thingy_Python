from selenium.common.exceptions import StaleElementReferenceException
from selenium.webdriver.common.by import By
from selenium.webdriver.support import expected_conditions as ec
from selenium.webdriver.support.wait import WebDriverWait

from application.data import settings
from application.data.xpaths import XPATHS
from application.models.Accident import Accident

import time


async def get_accidents(car):
    """
    Gets the accidents found on accidents_tab
    :param car: car object
    """
    # WebDriverWait(settings.driver, 5).until(ec.presence_of_element_located((By.XPATH, XPATHS.accidents_tab)))
    settings.driver.find_element(By.XPATH, XPATHS.accidents_tab).click()
    await settings.send_data("message", "Searching for accidents...", 72, "pending")

    counter = 0
    while counter < 5:
        WebDriverWait(settings.driver, 5).until(ec.presence_of_element_located((By.XPATH, XPATHS.accidents)))
        accidents_tbody = settings.driver.find_element(By.XPATH, XPATHS.accidents)
        accidents_rows = accidents_tbody.find_elements(By.TAG_NAME, "tr")

        for row in accidents_rows:
            try:
                tmp = row.text.split(" ")
                if tmp != [""]:
                    role = "".join(tmp[1:])
                    await settings.send_data("message", "FOUND: Accidents", 80, "pending")
                    car.accidents.append(
                        {
                            "licensePlate": car.license_plate,
                            "accidentDate": tmp[0],
                            "role": role,
                        }
                    )
                    counter = 5
                else:
                    await settings.send_data(
                        "message",
                        "NOT FOUND: Accidents, searching again...",
                        -1,
                        "pending",
                    )
                    counter += 1
                    time.sleep(0.25)
                    break
            except StaleElementReferenceException:
                continue

    await settings.send_data("accidents", car.accidents, 80, "pending", True)
