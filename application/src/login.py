import time
import os

from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.support import expected_conditions as ec
from dotenv import load_dotenv, find_dotenv

from application.data import settings
from application.data.xpaths import XPATHS as xpaths


def login(retry = False):
    """Logs in with the credentials found in credentials.env"""
    settings.CREDENTIALS_LOCATION = find_dotenv('credentials.env')
    load_dotenv(dotenv_path=settings.CREDENTIALS_LOCATION)

    username = os.getenv("USERNAME")
    password = os.getenv("PASSWORD")

    if username is None or password is None:
        raise Exception("No credentials were found")

    print("Logging in...")

    if retry:
        if settings.COUNTER > 2:
            raise Exception("Tried logging out/in too many times...")

        settings.COUNTER += 1
        time.sleep(10)
        settings.driver.get("https://magyarorszag.hu/jszp_szuf")

    WebDriverWait(settings.driver, 10).until(
        ec.presence_of_element_located((By.XPATH, xpaths.get("login_methods"))))
    print("FOUND: Login methods")

    time.sleep(0.5)
    settings.driver.find_element(By.XPATH, xpaths.get('login_method')).click()
    print("CLICKED: Ugyfelkapus azonositas")

    WebDriverWait(settings.driver, 10).until(ec.presence_of_element_located((By.XPATH, xpaths.get('username_field'))))
    print("FOUND: username input field")

    settings.driver.find_element(By.XPATH, xpaths.get('username_field')).send_keys(username)
    print("FILLED: username")

    settings.driver.find_element(By.XPATH, xpaths.get('password_field')).send_keys(password)
    print("FILLED: password filled")

    time.sleep(0.5)

    settings.driver.find_element(By.XPATH, xpaths.get('login_button')).send_keys(Keys.ENTER)
    print("CLICKED: login")
