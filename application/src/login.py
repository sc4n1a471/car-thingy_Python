import asyncio
import os

from logging import exception, warning

from selenium.common import TimeoutException
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support import expected_conditions as ec
from selenium.webdriver.remote.webdriver import WebDriver

from application.data import settings
from application.data.xpaths import XPATHS
from application.models.LoginException import LoginException
from application.data import helpers


async def login(sid: str, selenium: WebDriver, retry=False) -> bool:
    """
    Logs in with the credentials found as environment variables
    Also checks if user is already logged in
    If the cookies are invalid, it requests the 2FA code from the client

    Args:
        selenium (WebDriver): Selenium WebDriver instance
        retry (bool, optional): Retry login. Defaults to False.

    Raises:
        LoginException: Throws LoginException if the login failed for some reason
        TimeoutException: Throws TimeoutException if the login page is not found within the specified time.
    """

    if helpers.car_requests[sid].status == "running":
        await asyncio.sleep(1)
        try:
            selenium.switch_to.default_content()
            selenium.switch_to.frame(1)
            if len(selenium.find_elements(By.XPATH, XPATHS.request_page)) != 0:
                await helpers.send_to_client(sid, "message", "Already logged in", 13, "pending")
                return False
        except Exception as exc:
            warning("Could not verify if already logged in, maybe the page did not load?")
            exception(exc)
            pass

        username = os.environ["APP_USERNAME"]
        password = os.environ["APP_PASSWORD"]

        if username == "default" or password == "default":
            raise LoginException("Credential env variables have default values")

        await helpers.send_to_client(sid, "message", "Waiting for login page...", 6, "pending")

        # MARK: Retry login
        if retry:
            if settings.COUNTER > 2:
                raise LoginException("Tried logging out/in too many times...")

            settings.COUNTER += 1
            await asyncio.sleep(10)
            selenium.get("https://magyarorszag.hu/jszp_szuf")

        try:
            await helpers.async_wait_for(
                selenium, ec.element_to_be_clickable((By.XPATH, XPATHS.login_methods)), timeout=10
            )
            await helpers.send_to_client(sid, "message", "FOUND: Login methods", 7, "pending")
            selenium.find_element(By.XPATH, XPATHS.login_methods).click()  # Open dropdown
        except TimeoutException as toexc:
            raise TimeoutException("Could not find login page, maybe the page does not load?") from toexc

        # MARK: Filling inputs
        await asyncio.sleep(0.5)
        selenium.find_element(By.XPATH, XPATHS.login_method).click()
        await helpers.send_to_client(sid, "message", "CLICKED: Ugyfelkapu+ azonositas", 8, "pending")

        await helpers.async_wait_for(
            selenium, ec.element_to_be_clickable((By.XPATH, XPATHS.username_field)), timeout=10
        )
        await helpers.send_to_client(sid, "message", "FOUND: username input field", 9, "pending")

        selenium.find_element(By.XPATH, XPATHS.username_field).send_keys(username)
        await helpers.send_to_client(sid, "message", "FILLED: username", 10, "pending")

        selenium.find_element(By.XPATH, XPATHS.password_field).send_keys(password)
        await helpers.send_to_client(sid, "message", "FILLED: password", 11, "pending")

        await asyncio.sleep(0.1)

        selenium.find_element(By.XPATH, XPATHS.login_button).send_keys(Keys.ENTER)
        await helpers.send_to_client(sid, "message", "CLICKED: login", 12, "pending")

        # MARK: 2FA
        await helpers.async_wait_for(
            selenium, ec.element_to_be_clickable((By.XPATH, XPATHS.verification_code_field)), timeout=10
        )
        await helpers.send_to_client(sid, "message", "Pls gimme 2FA verification code", 13, "waiting")
        helpers.car_requests[sid].status = "waiting"
        return True

    await helpers.send_to_client(sid, "message", "Skipped username/password part of login", 13.5, "pending")
    await helpers.async_wait_for(
        selenium, ec.element_to_be_clickable((By.XPATH, XPATHS.verification_code_field)), timeout=1
    )
    selenium.find_element(By.XPATH, XPATHS.verification_code_field).send_keys(helpers.car_requests[sid].login_code)
    await asyncio.sleep(0.1)

    selenium.find_element(By.XPATH, XPATHS.login_button).send_keys(Keys.ENTER)
    await helpers.send_to_client(sid, "message", "CLICKED: login", 14, "pending")
    helpers.car_requests[sid].status = "running"
    return False
