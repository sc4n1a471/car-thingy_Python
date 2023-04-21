import time

from selenium.webdriver.common.by import By
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.support import expected_conditions as ec
from selenium.webdriver.common.keys import Keys

from app.data.xpaths import XPATHS
from app.src.login import login
from app.src.logout import logout
from app.models.Car import Car
from app.data import settings


def get_data(requested_cars: [Car]):
    cold_start = True
    car_data: [Car] = []
    for requested_car in requested_cars:
        car = Car()
        counter = 0
        print(f"Requesting {requested_car}...")

        if not cold_start:
            print(f"Already logged in, waiting {settings.wait_time}+{settings.wait_time} sec...")
            time.sleep(settings.wait_time)
            settings.driver.get("https://magyarorszag.hu/jszp_szuf")
            time.sleep(settings.wait_time)

        WebDriverWait(settings.driver, 30).until(
            ec.presence_of_element_located((By.XPATH, '//title[text() = "Jármű Szolgáltatási Platform"]')))
        print("FOUND: Jármű Szolgáltatási Platform")

        settings.driver.switch_to.frame(1)

        settings.driver.find_element(By.XPATH, '//input[@id="input-rendszam"]').send_keys(requested_car)
        print("FILLED: license plate")

        settings.driver.find_element(By.XPATH, '//input[@id="input-rendszam"]').send_keys(Keys.ENTER)
        print("Searching for license plate")

        settings.driver.switch_to.default_content()
        time.sleep(3)
        print(len(settings.driver.find_elements(By.XPATH, XPATHS.get("error_modal"))))
        while len(settings.driver.find_elements(By.XPATH, XPATHS.get("error_modal"))) != 0:

            print("Getting throttled...")
            settings.driver.find_element(By.XPATH, XPATHS.get("error_modal_button")).click()
            time.sleep(1)

            if counter > 1:
                print("Tried too many times, logging out and back in...")
                counter = 0

                try:
                    logout()
                except Exception as e:
                    raise Exception(f"LOGOUT ERROR: {e}")

                try:
                    login(True)
                except Exception as e:
                    print(f"LOGIN ERROR: {e}")

                WebDriverWait(settings.driver, 30).until(
                    ec.presence_of_element_located((By.XPATH, '//title[text() = "Jármű Szolgáltatási Platform"]')))
                print("FOUND: Jármű Szolgáltatási Platform")
                settings.driver.switch_to.frame(1)
                settings.driver.find_element(By.XPATH, '//input[@id="input-rendszam"]').send_keys(Keys.ENTER)
                print("Searching for license plate again...")
                settings.driver.switch_to.default_content()
                continue

            settings.driver.switch_to.frame(1)
            settings.driver.find_element(By.XPATH, '//input[@id="input-rendszam"]').send_keys(Keys.ENTER)
            print("Searching for license plate again...")
            settings.driver.switch_to.default_content()
            time.sleep(20)
            counter += 1


        settings.driver.switch_to.frame(1)

        WebDriverWait(settings.driver, 180).until(ec.presence_of_element_located((By.XPATH, '//h1[@id="header-jarmu_adatai"]')))
        print("Car loaded")

        WebDriverWait(settings.driver, 10).until(ec.presence_of_element_located((By.XPATH, XPATHS.get("brand"))))

        car.brand = settings.driver.find_element(By.XPATH, XPATHS.get("brand")).text
        print(f"FOUND: Brand {car.brand}")

        car.model = settings.driver.find_element(By.XPATH, XPATHS.get("model")).text
        print(f"FOUND: Model {car.model}")

        car.type_code = settings.driver.find_element(By.XPATH, XPATHS.get("type_code")).text
        print(f"FOUND: Type_code {car.type_code}")

        car.status = settings.driver.find_element(By.XPATH, XPATHS.get("status")).text
        print(f"FOUND: Status {car.status}")

        settings.driver.switch_to.default_content()
        iframe = settings.driver.find_element(By.XPATH, '//*[@id="main"]/iframe')
        settings.driver.switch_to.frame(iframe)
        print("Switched to selected iframe")

        WebDriverWait(settings.driver, 10).until(ec.presence_of_element_located((By.XPATH, XPATHS.get("first_reg"))))
        car.first_reg = settings.driver.find_elements(By.XPATH, XPATHS.get("first_reg"))[0].text
        print(f"FOUND: First_reg {car.first_reg}")

        car.first_reg_hun = settings.driver.find_elements(By.XPATH, XPATHS.get("first_reg_hun"))[0].text
        print(f"FOUND: First_reg_hun {car.first_reg_hun}")

        car.num_of_owners = settings.driver.find_elements(By.XPATH, XPATHS.get("num_of_owners"))[0].text
        print(f"FOUND: Num_of_owners {car.num_of_owners}")

        car.year = settings.driver.find_elements(By.XPATH, XPATHS.get("year"))[0].text
        print(f"FOUND: Year {car.year}")

        car.fuel_type = settings.driver.find_elements(By.XPATH, XPATHS.get("fuel_type"))[0].text
        print(f"FOUND: Fuel_type {car.fuel_type}")

        if not car.fuel_type == "ELEKTROMOS":
            car.engine_size = settings.driver.find_elements(By.XPATH, XPATHS.get("engine_size"))[0].text
            print(f"FOUND: Engine_size {car.engine_size}")
            car.engine_size = car.engine_size.replace(" ", "").replace("cm³", "")

        if car.brand == '' and car.model == '' and car.status == '' and car.type_code == '' and car.first_reg == '' and car.first_reg_hun == '' and car.num_of_owners == '':
            raise Exception("All found data is empty")

        car.performance = settings.driver.find_elements(By.XPATH, XPATHS.get("performance"))[0].text
        print(f"FOUND: Performance {car.performance}")
        car.performance = car.performance.replace(" kW", "")
        car.performance = int(int(car.performance) * 1.34)  # convert kW to HP

        car.gearbox = settings.driver.find_elements(By.XPATH, XPATHS.get("gearbox"))[0].text
        print(f"FOUND: Gearbox {car.gearbox}")
        tmp = car.gearbox.split(" ")
        car.gearbox = tmp[2]

        car.color = settings.driver.find_elements(By.XPATH, XPATHS.get("color"))[0].text
        print(f"FOUND: Color {car.color}")
        tmp = car.color.split(" ")
        car.color = tmp[1]

        time.sleep(1)
        settings.driver.find_element(By.XPATH, XPATHS.get("restrictions_tab")).click()
        print(f"CLICKED: Restrictions")
        time.sleep(1)
        restrictions = settings.driver.find_element(By.XPATH, XPATHS.get("restrictions"))
        restrictions_rows = restrictions.find_elements(By.TAG_NAME, "tr")
        print(f"FOUND: Restrictions")
        car.restrictions = []
        for row in restrictions_rows:
            car.restrictions.append(row.text)

        settings.driver.find_element(By.XPATH, XPATHS.get("mileage_tab")).click()
        print(f"CLICKED: Mileage")
        time.sleep(1)
        mileage_tbody = settings.driver.find_element(By.XPATH, XPATHS.get("mileage"))
        mileage_rows = mileage_tbody.find_elements(By.TAG_NAME, "tr")
        print(f"FOUND: Mileage data")
        car.mileage = {}
        for row in mileage_rows:
            tmp = row.text.split(" ")
            mileage_num = ''.join(tmp[1:])
            car.mileage[tmp[0]] = mileage_num

        settings.driver.find_element(By.XPATH, XPATHS.get("accidents_tab")).click()
        print(f"CLICKED: Accidents")
        time.sleep(1)
        accidents_tbody = settings.driver.find_element(By.XPATH, XPATHS.get("accidents"))
        accidents_rows = accidents_tbody.find_elements(By.TAG_NAME, "tr")
        print(f"FOUND: Accidents")
        car.accidents = {}
        for row in accidents_rows:
            tmp = row.text.split(" ")
            accident_text = ''.join(tmp[1:])
            car.accidents[tmp[0]] = accident_text

        car_data.append(car)
        cold_start = False
        print(f"Changed cold_start to {cold_start}")
        print("=================")

    return car_data