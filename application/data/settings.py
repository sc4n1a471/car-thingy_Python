import os
import pickle
import logging

from selenium import webdriver
from logging import info
from logging.handlers import TimedRotatingFileHandler
from .helpers import send_to_client, send
from warnings import deprecated

COUNTER = 0
WAIT_TIME = 30
WAIT_TIME_TAB_CHANGE = 0.5
TESTING = False
URL = "https://magyarorszag.hu/jszp_szuf"
COOKIES = "cookies.pkl"
STATUS_COUNTER = 0
AUTHKEY = None
RUN_ON_SERVER = True


async def init(sid: str, x_api_key: str):
    global driver
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
            return

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
            return

        s = Service(chromedriver)

        driver = webdriver.Chrome(service=s, options=option)
        # driver = webdriver.Safari()

    await send_to_client(sid, "message", "Driver initialized", 3, "pending")

    await load_cookies(sid)


# region: Cookie handling
def save_cookie():
    with open(COOKIES, "wb") as filehandler:
        pickle.dump(driver.get_cookies(), filehandler)


async def load_cookies(sid: str):
    """
    Loads cookies before the first GET to magyarorszag.hu as it redirects to .gov.hu
        if no cookies were found for magyarorszag.hu domain and then these domains can't be
        added because of domain mismatch
        https://stackoverflow.com/questions/63220248/how-to-preload-cookies-before-first-request-with-python3-selenium-chrome-webdri
    :return:
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


# TODO: Replace wait_for_input with an input Socket.IO event
# MARK: Wait for verification code
@deprecated("Will be removed in the final build, use input event instead")
async def wait_for_input(message: str, percentage: int):
    """
    Waits for an input from the client

    Args:
        message (str): The message that should be sent to the client before waiting for input, a headsup for the client
        percentage (int): The current percentage

    Returns:
        str: Message received from the client
    """
    global websocket

    # await send_to_client("input", message, percentage, status="waiting")

    # received_msg = await websocket.recv()
    # return received_msg
    return None
