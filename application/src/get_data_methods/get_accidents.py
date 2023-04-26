from selenium.webdriver.common.by import By

from application.data import settings
from application.data.xpaths import XPATHS
def get_accidents(car):
    accidents_tbody = settings.driver.find_element(By.XPATH, XPATHS.get("accidents"))
    accidents_rows = accidents_tbody.find_elements(By.TAG_NAME, "tr")
    print(f"FOUND: Accidents")
    car.accidents = {}
    for row in accidents_rows:
        tmp = row.text.split(" ")
        accident_text = ''.join(tmp[1:])
        car.accidents[tmp[0]] = accident_text