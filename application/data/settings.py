import os
import pickle
import logging

from selenium import webdriver
from selenium.webdriver.remote.webdriver import WebDriver
from logging import info
from logging.handlers import TimedRotatingFileHandler
from .helpers import send_to_client, send

COUNTER = 0
WAIT_TIME = 30
WAIT_TIME_TAB_CHANGE = 0.5
TESTING = False
URL = "https://magyarorszag.hu/jszp_szuf"
COOKIES = "cookies.pkl"
STATUS_COUNTER = 0
AUTHKEY = None
RUN_ON_SERVER = True


async def init(sid: str, x_api_key: str) -> WebDriver | None:
    """Checks API key, initializes the driver and returns it

    Args:
        sid (str): ID of the client connection
        x_api_key (str): API key

    Returns:
        WebDriver | None: Selenium WebDriver instance
    """
    global AUTHKEY
    global RUN_ON_SERVER

    await send_to_client(sid, "message", "Request received", 2, "pending")

    AUTHKEY = x_api_key

    RUN_ON_SERVER = RUN_ON_SERVER or RUN_ON_SERVER

    if RUN_ON_SERVER:
        from selenium.webdriver.chrome.service import Service
        from selenium.webdriver import ChromeOptions

        chrome_options = ChromeOptions()

        grid_ip = os.environ["APP_GRID_IP"]

        if grid_ip == "default":
            await send_to_client(sid, "message", "Selenium Grid IP address has the default value", 100, "fail")
            return None

        driver = webdriver.Remote(grid_ip, options=chrome_options)
    else:
        from selenium.webdriver.chrome.service import Service

        chromedriver = "/chromedriver"

        # SETUP YOUR BROWSER CONFIGURATION HERE

        option = webdriver.ChromeOptions()

        try:
            option.binary_location = "/Applications/Brave Browser.app/Contents/MacOS/Brave Browser"
        except:
            await send_to_client(
                sid,
                "message",
                "Brave browser was not found on Mac, set your own browser up in settings.py",
                100,
                "fail",
            )
            return None

        s = Service(chromedriver)

        driver = webdriver.Chrome(service=s, options=option)
        # driver = webdriver.Safari()

    await send_to_client(sid, "message", "Driver initialized", 3, "pending")

    await load_cookies(sid, driver)
    return driver


# region: Cookie handling
def save_cookie(driver: WebDriver):
    with open(COOKIES, "wb") as filehandler:
        pickle.dump(driver.get_cookies(), filehandler)


async def load_cookies(sid: str, driver: WebDriver):
    """
    Loads cookies before the first GET to magyarorszag.hu as it redirects to .gov.hu

    If no cookies were found for magyarorszag.hu domain and then these domains can't be
    added because of domain mismatch
    https://stackoverflow.com/questions/63220248/how-to-preload-cookies-before-first-request-with-python3-selenium-chrome-webdri
    """
    if os.path.exists(COOKIES) and os.path.isfile(COOKIES):
        await send_to_client(sid, "message", "Loading cookies...", 3, "pending")
        cookies = pickle.load(open(COOKIES, "rb"))

        # Enables network tracking so we may use Network.setCookie method
        if RUN_ON_SERVER:
            send(driver, "Network.enable", {})
        else:
            driver.execute_cdp_cmd("Network.enable", {})  # type: ignore

        # Iterate through pickle dict and add all the cookies
        for cookie in cookies:
            # Fix issue Chrome exports 'expiry' key but expects 'expire' on import
            if "expiry" in cookie:
                cookie["expires"] = cookie["expiry"]
                del cookie["expiry"]

            # Set the actual cookie
            if RUN_ON_SERVER:
                send(driver, "Network.setCookie", cookie)
            else:
                driver.execute_cdp_cmd("Network.setCookie", cookie)  # type: ignore

        # Disable network tracking
        if RUN_ON_SERVER:
            send(driver, "Network.disable", {})
        else:
            driver.execute_cdp_cmd("Network.disable", {})  # type: ignore
        await send_to_client(sid, "message", "Cookies loaded successfully", 5, "pending")
        return 1
    await send_to_client(sid, "message", "Cookies could not be loaded", 5, "pending")


# endregion


# MARK: Logging
def setup_logging():
    log_file = os.path.join("logs", "python-dev.log")

    time_rotating_handler = TimedRotatingFileHandler(
        log_file, when="midnight", interval=1, backupCount=30, encoding="utf-8"
    )

    logging.basicConfig(
        level=logging.INFO,
        format="%(asctime)s | %(levelname)s | %(message)s",
        datefmt="%Y.%m.%d %H:%M:%S",
        handlers=[logging.StreamHandler(), time_rotating_handler],
    )
    # https://stackoverflow.com/questions/13733552/logger-configuration-to-log-to-file-and-print-to-stdout
    # Log to file and console
    info("Logging initialized")
