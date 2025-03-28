import asyncio
import os
import pickle
import json
import logging

from selenium import webdriver
from logging import info
from logging.handlers import TimedRotatingFileHandler

COUNTER = 0
WAIT_TIME = 30
WAIT_TIME_TAB_CHANGE = 0.5
TESTING = False
URL = "https://magyarorszag.hu/jszp_szuf"
COOKIES = "cookies.pkl"
STATUS_COUNTER = 0
AUTHKEY = None
RUN_ON_SERVER = True


async def init(websocket_param):
    global driver
    global websocket
    global AUTHKEY
    global RUN_ON_SERVER
    websocket = websocket_param

    await send_data("message", "Request received", 2, "pending")

    AUTHKEY = websocket_param.request_headers.get("x-api-key")

    RUN_ON_SERVER = RUN_ON_SERVER or RUN_ON_SERVER

    if RUN_ON_SERVER:
        from selenium.webdriver.chrome.service import Service
        from selenium.webdriver import ChromeOptions

        chrome_options = ChromeOptions()

        grid_ip = os.environ["APP_GRID_IP"]

        if grid_ip == "default":
            await send_data("message", "Selenium Grid IP address has the default value", 100, "fail")
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
            await send_data(
                "message",
                "Brave browser was not found on Mac, set your own browser up in settings.py",
                100,
                "fail",
            )
            return

        s = Service(chromedriver)

        driver = webdriver.Chrome(service=s, options=option)
        # driver = webdriver.Safari()

    await send_data("message", "Driver initialized", 3, "pending")

    await load_cookies()


# region: Cookie handling
def save_cookie():
    with open(COOKIES, "wb") as filehandler:
        pickle.dump(driver.get_cookies(), filehandler)


async def load_cookies():
    """
    Loads cookies before the first GET to magyarorszag.hu as it redirects to .gov.hu
        if no cookies were found for magyarorszag.hu domain and then these domains can't be
        added because of domain mismatch
        https://stackoverflow.com/questions/63220248/how-to-preload-cookies-before-first-request-with-python3-selenium-chrome-webdri
    :return:
    """
    if os.path.exists(COOKIES) and os.path.isfile(COOKIES):
        await send_data("message", "Loading cookies...", 3, "pending")
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
        await send_data("message", "Cookies loaded successfully", 5, "pending")
        return 1
    await send_data("message", "Cookies could not be loaded", 5, "pending")


# endregion


# region: Send data
def send(driver, cmd, params={}):
    """
    This is required to send CDP command to remote driver
    https://stackoverflow.com/questions/72121479/cdp-with-remote-webdriver-webdriver-object-has-no-attribute-execute-cdp-cmd
    :param driver:
    :param cmd: Mostly 'Network.<enable/setCookie/disable>'
    :param params: Mostly '{}/cookie/{}'
    :return:
    """
    resource = "/session/%s/chromium/send_command_and_get_result" % driver.session_id
    url = driver.command_executor._url + resource
    body = json.dumps({"cmd": cmd, "params": params})
    response = driver.command_executor._request("POST", url, body)
    return response.get("value")


async def send_data(key, value, percentage, status="pending", is_json=False):
    """Sends json to client

    Args:
        key (string): message/input/restrictions/accidents/mileage
        value (any): The value of the message
        percentage (int): Status percentage
        status (str, optional): pending/waiting/success/fail. Defaults to "pending".
        is_json (bool, optional): Don't know why it's necessary, will remove it later... Defaults to False.
    """
    global websocket
    global STATUS_COUNTER

    if percentage != -1:
        STATUS_COUNTER = percentage

    if status == "success":
        message_object = {"status": status, "percentage": 100, "key": "message"}
    else:
        # What is this is_json boolean doing here? It's literally creating the same message_object...
        if is_json:
            message_object = {
                "status": status,
                "percentage": STATUS_COUNTER,
                "key": key,
                "value": value,
            }
        else:
            message_object = {
                "status": status,
                "percentage": STATUS_COUNTER,
                "key": key,
                "value": value,
            }

    info(message_object)
    await websocket.send(json.dumps(message_object))
    await asyncio.sleep(0)


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


# MARK: Wait for verification code
async def wait_for_input(message: str, percentage: int):
    """Waits for an input from the client

    Args:
        message (str): The message that should be sent to the client before waiting for input, a headsup for the client
        percentage (int): The current percentage

    Returns:
        str: Message received from the client
    """
    global websocket

    await send_data("input", message, percentage, status="waiting")

    received_msg = await websocket.recv()
    return received_msg
