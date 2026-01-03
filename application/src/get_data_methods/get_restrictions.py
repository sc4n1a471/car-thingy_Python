import time

from selenium.webdriver.common.by import By
from selenium.webdriver.support import expected_conditions as ec
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.remote.webdriver import WebDriver

from application.data import helpers
from application.data.xpaths import XPATHS
from application.models.Car import Car


async def get_restrictions(sid: str, selenium: WebDriver, car: Car):
    """Gets all information on the requested car

    Args:
        car (Car): Car object
    """
    # Check for loading spinner before searching for Restrictions tab
    counter = 0
    while counter < 20:
        try:
            if counter == 10:
                await helpers.send_to_client(
                    sid, "message", "Loading spinner is still present after 10 tries, refreshing...", 48, "pending"
                )
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

    WebDriverWait(selenium, 10).until(ec.element_to_be_clickable((By.XPATH, XPATHS.restrictions_tab)))
    counter = 0
    while counter < 5:
        try:
            selenium.find_element(By.XPATH, XPATHS.restrictions_tab).click()
            break
        except:
            counter += 1
            time.sleep(0.25)
            continue
    if counter == 5:
        await helpers.send_to_client(sid, "message", "Restrictions tab not found", 49, "pending")
        return

    await helpers.send_to_client(sid, "message", "Searching for restrictions...", 49, "pending")

    counter = 0
    while counter < 5:
        WebDriverWait(selenium, 5).until(ec.presence_of_element_located((By.XPATH, XPATHS.restrictions)))
        restrictions = selenium.find_element(By.XPATH, XPATHS.restrictions)
        restrictions_rows = restrictions.find_elements(By.TAG_NAME, "tr")

        for row in restrictions_rows:
            try:
                tmp = row.text
                if tmp != "":
                    await helpers.send_to_client(sid, "message", "FOUND: Restrictions", 60, "pending")
                    car.restrictions.append(tmp)
                    counter = 5
                else:
                    await helpers.send_to_client(
                        sid,
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

    await helpers.send_to_client(sid, "restrictions", car.restrictions, 60, "pending")
