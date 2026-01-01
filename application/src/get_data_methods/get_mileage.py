import time

from selenium.common.exceptions import StaleElementReferenceException, ElementClickInterceptedException
from selenium.webdriver.common.by import By
from selenium.webdriver.support import expected_conditions as ec
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.remote.webdriver import WebDriver

from application.data import helpers
from application.data.xpaths import XPATHS
from application.models.Car import Car


async def get_mileage(sid: str, selenium: WebDriver, car: Car):
    """Gets mileage information for the requested car

    Args:
        car (Car): Car object
    """

    # Check for loading spinner before searching for Mileage tab
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

    WebDriverWait(selenium, 5).until(ec.element_to_be_clickable((By.XPATH, XPATHS.mileage_tab)))

    counter = 0
    while counter < 5:
        try:  # .click() is still intercepted even though the element is clickable...
            selenium.find_element(By.XPATH, XPATHS.mileage_tab).click()
            await helpers.send_to_client(sid, "message", "Clicked on Mileage tab", 62, "pending")
            break
        except ElementClickInterceptedException:
            counter += 1
            time.sleep(0.25)
            continue

    await helpers.send_to_client(sid, "message", "Searching for mileage data...", 62, "pending")

    counter = 0
    while counter < 5:
        WebDriverWait(selenium, 5).until(ec.presence_of_element_located((By.XPATH, XPATHS.mileage)))
        mileage_tbody = selenium.find_element(By.XPATH, XPATHS.mileage)
        mileage_rows = mileage_tbody.find_elements(By.TAG_NAME, "tr")

        for row in mileage_rows:
            try:
                tmp = row.text.split(" ")
                if tmp != [""]:
                    await helpers.send_to_client(sid, "message", "FOUND: Mileage data", 70, "pending")
                    mileage_num = "".join(tmp[1:])
                    car.mileage.append(
                        {
                            "licensePlate": car.license_plate,
                            "date": tmp[0],
                            "mileage": int(mileage_num),
                        }
                    )
                    counter = 5
                else:
                    await helpers.send_to_client(
                        sid,
                        "message",
                        "NOT FOUND: Mileage data, searching again...",
                        70,
                        "pending",
                    )
                    counter += 1
                    time.sleep(0.25)
                    break
            except StaleElementReferenceException:
                continue

    await helpers.send_to_client(sid, "mileage", car.mileage, 70, "pending")
