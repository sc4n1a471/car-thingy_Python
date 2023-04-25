from selenium.webdriver.common.by import By

from ...data import settings
from ...data.xpaths import XPATHS
def get_mileage(car):
    mileage_tbody = settings.driver.find_element(By.XPATH, XPATHS.get("mileage"))
    mileage_rows = mileage_tbody.find_elements(By.TAG_NAME, "tr")
    print(f"FOUND: Mileage data")
    car.mileage = {}
    for row in mileage_rows:
        tmp = row.text.split(" ")
        mileage_num = ''.join(tmp[1:])
        car.mileage[tmp[0]] = mileage_num