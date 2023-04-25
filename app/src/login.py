import time

from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.support import expected_conditions as ec
import os
from dotenv import load_dotenv, find_dotenv

from ..data import settings


def login(retry = False):
    settings.credentials_location = find_dotenv('credentials.env')
    load_dotenv(dotenv_path=settings.credentials_location)
    print("Logging in...")

    if retry:
        if settings.counter > 2:
            raise Exception("Tried logging out/in too many times...")

        settings.counter += 1
        time.sleep(10)
        settings.driver.get("https://magyarorszag.hu/jszp_szuf")

    WebDriverWait(settings.driver, 10).until(
        ec.presence_of_element_located((By.XPATH, '//form[@id="urn:eksz.gov.hu:1.0:azonositas:kau:1:uk:uidpwd"]')))
    print("FOUND: Login methods")

    time.sleep(1)
    settings.driver.find_element(By.XPATH, '//form[@id="urn:eksz.gov.hu:1.0:azonositas:kau:1:uk:uidpwd"]').click()
    print("CLICKED: Ugyfelkapus azonositas")

    WebDriverWait(settings.driver, 10).until(ec.presence_of_element_located((By.XPATH, '//input[@id="fldUser"]')))
    print("FOUND: username input field")

    username = os.getenv("USERNAME")
    settings.driver.find_element(By.XPATH, '//input[@id="fldUser"]').send_keys(username)
    print("FILLED: username")

    password = os.getenv("PASSWORD")
    settings.driver.find_element(By.XPATH, '//input[@id="fldPass"]').send_keys(password)
    print("FILLED: password filled")

    time.sleep(1)

    settings.driver.find_element(By.XPATH, '//button[@name="submit"]').send_keys(Keys.ENTER)
    print("CLICKED: login")