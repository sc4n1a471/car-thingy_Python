import time
from dataclasses import dataclass

from prodict import Prodict
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.support import expected_conditions as ec
import os
from dotenv import load_dotenv

@dataclass
class Car:
    brand: str = "",
    model: str = "",
    type_code: str = "",
    status: str = "",
    first_reg: str = "",
    first_reg_hun: str = "",
    num_of_owners: int = 0,
    year: int = 0,
    color: str = "",
    engine_size: int = 0,
    performance: int = 0,
    fuel_type: str = "",
    gearbox: str = "",
    restrictions: [str] = None,
    mileage: dict = None
    accidents: dict = None

XPATHS = Prodict.from_dict({
    'brand': '//*[contains(@id, "Gyartmany") and string-length(text())]',
    'model': '//*[contains(@id, "Kerleiras") and string-length(text())]',
    'type_code': '//*[contains(@id, "Tipus") and string-length(text())]',
    'status': '//*[contains(@id, "ForgalmiAllapot") and string-length(text())]',
    'first_reg': '//*[contains(@id, "ElsoForgHelyezes") and string-length(text())]',
    'first_reg_hun': '//*[contains(@id, "ElsoMoForgHelyezes") and string-length(text())]',
    'num_of_owners': '//*[contains(@id, "OsszesTulaj") and string-length(text())]',
    'year': '//*[contains(@id, "GyartasiEv") and string-length(text())]',
    'engine_size': '//*[contains(@id, "Hengerurtartalom") and string-length(text())]',
    'performance': '//*[contains(@id, "text-Teljesitmeny") and contains(text(), " kW")]',
    'fuel_type': '//*[contains(@id, "Uzemanyag") and string-length(text())]',
    'gearbox': '//*[contains(@id, "Sebessegvalto") and string-length(text())]',
    'color': '//*[contains(@id, "Szin") and string-length(text())]',

    'restrictions_tab': '//*[@id="tabitem-ForgtartasForgkorlat"]',
    'restrictions': '//*[@id="datatable-Forgkorlat"]/tbody',

    'mileage_tab': '//*[@id="tabitem-FutasTeljesitmeny"]',
    'mileage': '//*[@id="datatable-FutasTeljesitmeny_RogzitettOraAllasok"]/tbody',

    'accidents_tab': '//*[@id="tabitem-BiztositasKartortenet"]',
    'accidents': '//*[@id="datatable-Karesemeny"]/tbody',

    'error_modal': '//h4[contains(text(), "Hiba")]',
    'error_modal_button': '//*[@id="snap-dialog-ok-button"]',

    'logout_button': '//*[@id="kijelentkezes"]'
})

COUNTER = 0
WAIT_TIME = 13

def login(retry = False):
    global COUNTER

    print("Logging in...")

    if retry:
        if COUNTER > 2:
            raise Exception("Tried logging out/in too many times...")

        COUNTER += 1
        time.sleep(10)
        driver.get("https://magyarorszag.hu/jszp_szuf")

    WebDriverWait(driver, 30).until(
        ec.presence_of_element_located((By.XPATH, '//form[@id="urn:eksz.gov.hu:1.0:azonositas:kau:1:uk:uidpwd"]')))
    print("FOUND: Login methods")

    driver.find_element(By.XPATH, '//form[@id="urn:eksz.gov.hu:1.0:azonositas:kau:1:uk:uidpwd"]').click()
    print("CLICKED: Ugyfelkapus azonositas")

    WebDriverWait(driver, 30).until(ec.presence_of_element_located((By.XPATH, '//input[@id="fldUser"]')))
    print("FOUND: username input field")

    username = os.getenv("USERNAME")
    driver.find_element(By.XPATH, '//input[@id="fldUser"]').send_keys(username)
    print("FILLED: username")

    password = os.getenv("PASSWORD")
    driver.find_element(By.XPATH, '//input[@id="fldPass"]').send_keys(password)
    print("FILLED: password filled")

    time.sleep(1)

    driver.find_element(By.XPATH, '//button[@name="submit"]').send_keys(Keys.ENTER)
    print("CLICKED: login")

def logout():
    print("Logging out...")
    time.sleep(1)
    driver.switch_to.default_content()
    driver.switch_to.frame(2)
    driver.find_element(By.XPATH, XPATHS.get('logout_button')).click()

def get_data(requested_cars: [Car]):
    cold_start = True
    car_data: [Car] = []
    for requested_car in requested_cars:
        car = Car()
        counter = 0
        print(f"Requesting {requested_car}...")

        if not cold_start:
            print(f"Already logged in, waiting {WAIT_TIME}+{WAIT_TIME} sec...")
            time.sleep(WAIT_TIME)
            driver.get("https://magyarorszag.hu/jszp_szuf")
            time.sleep(WAIT_TIME)

        WebDriverWait(driver, 30).until(
            ec.presence_of_element_located((By.XPATH, '//title[text() = "Jármű Szolgáltatási Platform"]')))
        print("FOUND: Jármű Szolgáltatási Platform")

        driver.switch_to.frame(1)

        driver.find_element(By.XPATH, '//input[@id="input-rendszam"]').send_keys(requested_car)
        print("FILLED: license plate")

        driver.find_element(By.XPATH, '//input[@id="input-rendszam"]').send_keys(Keys.ENTER)
        print("Searching for license plate")

        driver.switch_to.default_content()
        time.sleep(3)
        print(len(driver.find_elements(By.XPATH, XPATHS.get("error_modal"))))
        while len(driver.find_elements(By.XPATH, XPATHS.get("error_modal"))) != 0:

            print("Getting throttled...")
            driver.find_element(By.XPATH, XPATHS.get("error_modal_button")).click()
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

                WebDriverWait(driver, 30).until(
                    ec.presence_of_element_located((By.XPATH, '//title[text() = "Jármű Szolgáltatási Platform"]')))
                print("FOUND: Jármű Szolgáltatási Platform")
                driver.switch_to.frame(1)
                driver.find_element(By.XPATH, '//input[@id="input-rendszam"]').send_keys(Keys.ENTER)
                print("Searching for license plate again...")
                driver.switch_to.default_content()
                continue

            driver.switch_to.frame(1)
            driver.find_element(By.XPATH, '//input[@id="input-rendszam"]').send_keys(Keys.ENTER)
            print("Searching for license plate again...")
            driver.switch_to.default_content()
            time.sleep(20)
            counter += 1


        driver.switch_to.frame(1)

        WebDriverWait(driver, 180).until(ec.presence_of_element_located((By.XPATH, '//h1[@id="header-jarmu_adatai"]')))
        print("Car loaded")

        WebDriverWait(driver, 10).until(ec.presence_of_element_located((By.XPATH, XPATHS.get("brand"))))

        car.brand = driver.find_element(By.XPATH, XPATHS.get("brand")).text
        print(f"FOUND: Brand {car.brand}")

        car.model = driver.find_element(By.XPATH, XPATHS.get("model")).text
        print(f"FOUND: Model {car.model}")

        car.type_code = driver.find_element(By.XPATH, XPATHS.get("type_code")).text
        print(f"FOUND: Type_code {car.type_code}")

        car.status = driver.find_element(By.XPATH, XPATHS.get("status")).text
        print(f"FOUND: Status {car.status}")

        driver.switch_to.default_content()
        iframe = driver.find_element(By.XPATH, '//*[@id="main"]/iframe')
        driver.switch_to.frame(iframe)
        print("Switched to selected iframe")

        WebDriverWait(driver, 10).until(ec.presence_of_element_located((By.XPATH, XPATHS.get("first_reg"))))
        car.first_reg = driver.find_elements(By.XPATH, XPATHS.get("first_reg"))[0].text
        print(f"FOUND: First_reg {car.first_reg}")

        car.first_reg_hun = driver.find_elements(By.XPATH, XPATHS.get("first_reg_hun"))[0].text
        print(f"FOUND: First_reg_hun {car.first_reg_hun}")

        car.num_of_owners = driver.find_elements(By.XPATH, XPATHS.get("num_of_owners"))[0].text
        print(f"FOUND: Num_of_owners {car.num_of_owners}")

        car.year = driver.find_elements(By.XPATH, XPATHS.get("year"))[0].text
        print(f"FOUND: Year {car.year}")

        car.fuel_type = driver.find_elements(By.XPATH, XPATHS.get("fuel_type"))[0].text
        print(f"FOUND: Fuel_type {car.fuel_type}")

        if not car.fuel_type == "ELEKTROMOS":
            car.engine_size = driver.find_elements(By.XPATH, XPATHS.get("engine_size"))[0].text
            print(f"FOUND: Engine_size {car.engine_size}")
            car.engine_size = car.engine_size.replace(" ", "").replace("cm³", "")

        if car.brand == '' and car.model == '' and car.status == '' and car.type_code == '' and car.first_reg == '' and car.first_reg_hun == '' and car.num_of_owners == '':
            raise Exception("All found data is empty")

        car.performance = driver.find_elements(By.XPATH, XPATHS.get("performance"))[0].text
        print(f"FOUND: Performance {car.performance}")
        car.performance = car.performance.replace(" kW", "")
        car.performance = int(int(car.performance) * 1.34)  # convert kW to HP

        car.gearbox = driver.find_elements(By.XPATH, XPATHS.get("gearbox"))[0].text
        print(f"FOUND: Gearbox {car.gearbox}")
        tmp = car.gearbox.split(" ")
        car.gearbox = tmp[2]

        car.color = driver.find_elements(By.XPATH, XPATHS.get("color"))[0].text
        print(f"FOUND: Color {car.color}")
        tmp = car.color.split(" ")
        car.color = tmp[1]

        time.sleep(1)
        driver.find_element(By.XPATH, XPATHS.get("restrictions_tab")).click()
        print(f"CLICKED: Restrictions")
        time.sleep(1)
        restrictions = driver.find_element(By.XPATH, XPATHS.get("restrictions"))
        restrictions_rows = restrictions.find_elements(By.TAG_NAME, "tr")
        print(f"FOUND: Restrictions ({len(restrictions_rows)})")
        car.restrictions = []
        for row in restrictions_rows:
            car.restrictions.append(row.text)

        driver.find_element(By.XPATH, XPATHS.get("mileage_tab")).click()
        print(f"CLICKED: Mileage")
        time.sleep(1)
        mileage_tbody = driver.find_element(By.XPATH, XPATHS.get("mileage"))
        mileage_rows = mileage_tbody.find_elements(By.TAG_NAME, "tr")
        print(f"FOUND: Mileage data ({len(mileage_rows)})")
        car.mileage = {}
        for row in mileage_rows:
            tmp = row.text.split(" ")
            mileage_num = ''.join(tmp[1:])
            car.mileage[tmp[0]] = mileage_num

        driver.find_element(By.XPATH, XPATHS.get("accidents_tab")).click()
        print(f"CLICKED: Accidents")
        time.sleep(1)
        accidents_tbody = driver.find_element(By.XPATH, XPATHS.get("accidents"))
        accidents_rows = accidents_tbody.find_elements(By.TAG_NAME, "tr")
        print(f"FOUND: Accidents ({len(accidents_rows)})")
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

if __name__ == '__main__':
    requested_cars = [
        # 'YES880',
        'LLU750',
        # 'SUTYI1',
        'AAKZ462'
    ]
    cars: [Car] = []

    load_dotenv(dotenv_path="he.env")

    chromedriver = "/chromedriver"

    option = webdriver.ChromeOptions()
    option.binary_location = '/Applications/Brave Browser.app/Contents/MacOS/Brave Browser'

    # driver = webdriver.Safari()
    driver = webdriver.Chrome(options=option)

    driver.get("https://magyarorszag.hu/jszp_szuf")

    try:
        login()
    except Exception as e:
        print(f"LOGIN ERROR: {e}")

    try:
        cars = get_data(requested_cars)
    except Exception as e:
        print(f"GET_DATA ERROR: {e}")

    driver.close()

    COUNTER = 0

    asd = 0
