from selenium.webdriver.common.by import By

import app.data.settings as settings
import app.data.xpaths as xpaths
def get_accidents(car):
    accidents_tbody = settings.driver.find_element(By.XPATH, xpaths.XPATHS.get("accidents"))
    accidents_rows = accidents_tbody.find_elements(By.TAG_NAME, "tr")
    print(f"FOUND: Accidents")
    car.accidents = {}
    for row in accidents_rows:
        tmp = row.text.split(" ")
        accident_text = ''.join(tmp[1:])
        car.accidents[tmp[0]] = accident_text