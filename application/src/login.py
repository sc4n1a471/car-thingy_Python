import asyncio
import time
import os

from selenium.common import TimeoutException
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.support import expected_conditions as ec

from application.data import settings
from application.data.xpaths import XPATHS
from application.models.LoginException import LoginException


async def login(retry=False):
    """
    Logs in with the credentials found as environment variables
    Also checks if user is already logged in
    """

    await asyncio.sleep(2)
    if len(settings.driver.find_elements(By.XPATH, XPATHS.request_page)) != 0:
        await settings.send_data("message", "Already logged in", 13, "pending")
        return

    username = os.environ["APP_USERNAME"]
    password = os.environ["APP_PASSWORD"]

    if username == "default" or password == "default":
        raise LoginException("Credential env variables have default values")

    await settings.send_data("message", "Logging in...", 6, "pending")

    if retry:
        if settings.COUNTER > 2:
            raise LoginException("Tried logging out/in too many times...")

        settings.COUNTER += 1
        time.sleep(10)
        settings.driver.get("https://magyarorszag.hu/jszp_szuf")

    try:
        WebDriverWait(settings.driver, 10).until(ec.presence_of_element_located((By.XPATH, XPATHS.login_methods)))
        await settings.send_data("message", "FOUND: Login methods", 7, "pending")
    except TimeoutException as toexc:
        raise TimeoutException("Could not find login page, maybe the page does not load?") from toexc

    time.sleep(0.5)
    settings.driver.find_element(By.XPATH, XPATHS.login_method).click()
    await settings.send_data("message", "CLICKED: Ugyfelkapus azonositas", 8, "pending")

    WebDriverWait(settings.driver, 10).until(ec.presence_of_element_located((By.XPATH, XPATHS.username_field)))
    await settings.send_data("message", "FOUND: username input field", 9, "pending")

    settings.driver.find_element(By.XPATH, XPATHS.username_field).send_keys(username)
    await settings.send_data("message", "FILLED: username", 10, "pending")

    settings.driver.find_element(By.XPATH, XPATHS.password_field).send_keys(password)
    await settings.send_data("message", "FILLED: password", 11, "pending")

    time.sleep(0.5)

    settings.driver.find_element(By.XPATH, XPATHS.login_button).send_keys(Keys.ENTER)
    await settings.send_data("message", "CLICKED: login", 12, "pending")
