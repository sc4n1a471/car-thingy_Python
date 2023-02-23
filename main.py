import time
import pickle
from selenium.webdriver.chrome.service import Service
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import os
from dotenv import load_dotenv
# from requests import Session

if __name__ == '__main__':
    load_dotenv()

    # s = Session()

    chromedriver = "/chromedriver"

    option = webdriver.ChromeOptions()
    option.binary_location = '/Applications/Brave Browser.app/Contents/MacOS/Brave Browser'

    # driver = webdriver.Safari()
    driver = webdriver.Chrome(options=option)

    # try:
    driver.get("https://magyarorszag.hu/jszp_szuf")
    # cookies = pickle.load(open("cookies.pkl", "rb"))
    # for cookie in cookies:
    #     driver.add_cookie(cookie)

    # time.sleep(7)
    WebDriverWait(driver, 30).until(EC.presence_of_element_located((By.XPATH, '//form[@id="urn:eksz.gov.hu:1.0:azonositas:kau:1:uk:uidpwd"]')))
    print("FOUND: Login methods")

    driver.find_element(By.XPATH, '//form[@id="urn:eksz.gov.hu:1.0:azonositas:kau:1:uk:uidpwd"]').click()
    print("CLICKED: Ugyfelkapus azonositas")
    # form = WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.ID, "urn:eksz.gov.hu:1.0:azonositas:kau:1:uk:uidpwd")))

    # time.sleep(10)
    WebDriverWait(driver, 30).until(EC.presence_of_element_located((By.XPATH, '//input[@id="fldUser"]')))
    print("FOUND: username input field")

    # driver.find_element(By.XPATH, '//label[text() = "Felhasználónév"]').click()
    driver.find_element(By.XPATH, '//input[@id="fldUser"]').send_keys(os.getenv("USERNAME"))
    print("FILLED: username")

    driver.find_element(By.XPATH, '//input[@id="fldPass"]').send_keys(os.getenv("PASSWORD"))
    print("FILLED: password filled")

    time.sleep(1)

    driver.find_element(By.XPATH, '//button[@name="submit"]').send_keys(Keys.ENTER)
    print("CLICKED: login")

    WebDriverWait(driver, 30).until(EC.presence_of_element_located((By.XPATH, '//title[text() = "Jármű Szolgáltatási Platform"]')))
    print("FOUND: Jármű Szolgáltatási Platform")

    driver.switch_to.frame(1)

    driver.find_element(By.XPATH, '//input[@id="input-rendszam"]').send_keys("AACQ435")
    print("FILLED: license plate")

    driver.find_element(By.XPATH, '//input[@id="input-rendszam"]').send_keys(Keys.ENTER)
    print("Searching for license plate")

    WebDriverWait(driver, 120).until(EC.presence_of_element_located((By.XPATH, '//title[contains(text() = "FORGALMI RENDSZ"])')))

    driver.close()

    asd = 0
