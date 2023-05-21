import time
import os

from selenium.common import TimeoutException
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.support import expected_conditions as ec

from application.data import settings
from application.data.xpaths import XPATHS as xpaths
from application.models.LoginException import LoginException


def login(retry = False):
    """Logs in with the credentials found as environment variables"""

    username = os.environ["APP_USERNAME"]
    password = os.environ["APP_PASSWORD"]


    if username == 'default' or password == 'default':
        raise LoginException("Credential env variables have default values")

    print("Logging in...")

    if retry:
        if settings.COUNTER > 2:
            raise LoginException("Tried logging out/in too many times...")

        settings.COUNTER += 1
        time.sleep(10)
        settings.driver.get("https://magyarorszag.hu/jszp_szuf")

    try:
        WebDriverWait(settings.driver, 10).until(
            ec.presence_of_element_located((By.XPATH, xpaths.get("login_methods"))))
        print("FOUND: Login methods")
    except TimeoutException as toexc:
        raise TimeoutException("Could not find login page, maybe the page does not load?") from toexc

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
