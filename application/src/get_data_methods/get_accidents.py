from selenium.common.exceptions import StaleElementReferenceException, ElementClickInterceptedException
from selenium.webdriver.common.by import By
from selenium.webdriver.support import expected_conditions as ec
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.remote.webdriver import WebDriver

from application.data import helpers
from application.data.xpaths import XPATHS
from application.models.Car import Car

import time


async def get_accidents(sid: str, selenium: WebDriver, car: Car):
    """Gets the accidents found on accidents_tab

    Args:
        sid (str): ID of client connection
        selenium (WebDriver): Selenium session
        car (Car): Car object
    """
    # Check for loading spinner before searching for Accidents tab
    counter = 0
    while counter < 20:
        try:
            if counter == 10:
                selenium.refresh()
            if selenium.find_element(By.XPATH, XPATHS.loading_spinner).is_displayed():
                await helpers.send_to_client(sid, "message", "Loading spinner found, waiting...", 48, "pending")
                time.sleep(0.5)
                counter += 1
                continue
            else:
                await helpers.send_to_client(sid, "message", "Loading spinner not found, proceeding...", 48, "pending")
                break
        except:
            counter += 1
            time.sleep(0.25)
            continue

    if counter == 10:
        await helpers.send_to_client(sid, "message", "Loading spinner not found after 10s, aborting...", -1, "pending")
        return

    WebDriverWait(selenium, 5).until(ec.element_to_be_clickable((By.XPATH, XPATHS.accidents_tab)))
    counter = 0
    while counter < 5:
        try:
            selenium.find_element(By.XPATH, XPATHS.accidents_tab).click()
            break
        except ElementClickInterceptedException:
            time.sleep(1)
            counter += 1
            continue

    if counter == 5:
        await helpers.send_to_client(sid, "message", "Could not open accidents tab", 80, "pending")
        await helpers.send_to_client(sid, "accidents", car.accidents, 80, "pending")
        return

    await helpers.send_to_client(sid, "message", "Searching for accidents...", 72, "pending")

    counter = 0
    while counter < 5:
        WebDriverWait(selenium, 5).until(ec.presence_of_element_located((By.XPATH, XPATHS.accidents)))
        accidents_tbody = selenium.find_element(By.XPATH, XPATHS.accidents)
        accidents_rows = accidents_tbody.find_elements(By.TAG_NAME, "tr")

        for row in accidents_rows:
            try:
                tmp = row.text.split(" ")
                if tmp != [""]:
                    role = "".join(tmp[1:])
                    await helpers.send_to_client(sid, "message", "FOUND: Accidents", 80, "pending")
                    car.accidents.append(
                        {
                            "licensePlate": car.license_plate,
                            "accidentDate": tmp[0],
                            "role": role,
                        }
                    )
                    counter = 5
                else:
                    await helpers.send_to_client(
                        sid,
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

    await helpers.send_to_client(sid, "accidents", car.accidents, 80, "pending")
