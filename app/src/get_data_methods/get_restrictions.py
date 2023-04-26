from selenium.webdriver.common.by import By
import time

from app.data import settings
from app.data.xpaths import XPATHS
def get_restrictions(car):
    settings.driver.find_element(By.XPATH, XPATHS.get("restrictions_tab")).click()
    print(f"CLICKED: Restrictions")
    time.sleep(1)
    restrictions = settings.driver.find_element(By.XPATH, XPATHS.get("restrictions"))
    restrictions_rows = restrictions.find_elements(By.TAG_NAME, "tr")
    print(f"FOUND: Restrictions")
    car.restrictions = []
    for row in restrictions_rows:
        car.restrictions.append(row.text)