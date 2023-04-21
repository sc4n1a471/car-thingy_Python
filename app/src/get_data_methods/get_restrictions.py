from selenium.webdriver.common.by import By
import time

import app.data.settings as settings
import app.data.xpaths as xpaths
def get_restrictions(car):
    settings.driver.find_element(By.XPATH, xpaths.XPATHS.get("restrictions_tab")).click()
    print(f"CLICKED: Restrictions")
    time.sleep(1)
    restrictions = settings.driver.find_element(By.XPATH, xpaths.XPATHS.get("restrictions"))
    restrictions_rows = restrictions.find_elements(By.TAG_NAME, "tr")
    print(f"FOUND: Restrictions")
    car.restrictions = []
    for row in restrictions_rows:
        car.restrictions.append(row.text)