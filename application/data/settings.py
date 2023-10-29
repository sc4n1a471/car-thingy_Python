import os
import pickle
import json

from selenium import webdriver

COUNTER = 0
WAIT_TIME = 30
WAIT_TIME_TAB_CHANGE = 0.5
TESTING = False
URL = "https://magyarorszag.hu/jszp_szuf"
COOKIES = "cookies.pkl"
STATUS_COUNTER = 0


# TODO: don't use init(), use global variables, so don't init the driver every time
#       this way if multiple license plates are requested individually in a row, it would not login every time
async def init(websocket_param):
    global driver
    global websocket
    websocket = websocket_param

    if os.getenv("RUN_ON_SERVER") == "True":
        from selenium.webdriver.chrome.service import Service
        from selenium.webdriver.common.desired_capabilities import DesiredCapabilities

        grid_ip = os.environ["APP_GRID_IP"]

        if grid_ip == "default":
            await send_data(
                "message", "Selenium Grid IP address has the default value", 100, "fail"
            )
            return

        driver = webdriver.Remote(grid_ip, DesiredCapabilities.CHROME)
    else:
        from selenium.webdriver.chrome.service import Service

        chromedriver = "/chromedriver"

        # SETUP YOUR BROWSER CONFIGURATION HERE

        option = webdriver.ChromeOptions()

        try:
            option.binary_location = (
                "/Applications/Brave Browser.app/Contents/MacOS/Brave Browser"
            )
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
    await load_cookies()


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
        if os.getenv("RUN_ON_SERVER") == "True":
            send(driver, "Network.enable", {})
        else:
            driver.execute_cdp_cmd("Network.enable", {})

        # Iterate through pickle dict and add all the cookies
        for cookie in cookies:
            # Fix issue Chrome exports 'expiry' key but expects 'expire' on import
            if "expiry" in cookie:
                cookie["expires"] = cookie["expiry"]
                del cookie["expiry"]

            # Set the actual cookie
            if os.getenv("RUN_ON_SERVER") == "True":
                send(driver, "Network.setCookie", cookie)
            else:
                driver.execute_cdp_cmd("Network.setCookie", cookie)

        # Disable network tracking
        if os.getenv("RUN_ON_SERVER") == "True":
            send(driver, "Network.disable", {})
        else:
            driver.execute_cdp_cmd("Network.disable", {})
        await send_data("message", "Cookies loaded successfully", 5, "pending")
        return 1
    await send_data("message", "Cookies could not be loaded", 5, "pending")


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


async def send_message(message):
    global websocket
    message_object = {
        "status": "pending",
        "percentage": 0.0,
        "key": "message",
        "message": message,
    }
    print(message_object)
    await websocket.send(json.dumps(message_object))


async def send_data(key, value, percentage, status="pending", is_json=False):
    global websocket
    global STATUS_COUNTER

    if percentage != -1:
        STATUS_COUNTER = percentage

    if status == "success":
        message_object = {"status": status, "percentage": 100, "key": "message"}
    else:
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

    print(message_object)
    await websocket.send(json.dumps(message_object))
