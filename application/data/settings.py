import os
import pickle

from selenium import webdriver

COUNTER = 0
WAIT_TIME = 25
WAIT_TIME_TAB_CHANGE = 0.5
TESTING = False
URL = "https://magyarorszag.hu/jszp_szuf"
COOKIES = "cookies.pkl"


# TODO: don't use init(), use global variables, so don't init the driver every time
#       this way if multiple license plates are requested individually in a row, it would not login every time
def init():
    global driver

    if os.getenv("RUN_ON_SERVER") == 'True':
        from selenium.webdriver.chrome.service import Service
        from selenium.webdriver.common.desired_capabilities import DesiredCapabilities

        grid_ip = os.environ["APP_GRID_IP"]

        if grid_ip == 'default':
            return {
                "error": 'Selenium Grid IP address has the default value',
                "status": 'fail'
            }

        driver = webdriver.Remote(grid_ip, DesiredCapabilities.CHROME)
    else:
        from selenium.webdriver.chrome.service import Service
        chromedriver = "/chromedriver"

        # SETUP YOUR BROWSER CONFIGURATION HERE

        option = webdriver.ChromeOptions()

        try:
            option.binary_location = '/Applications/Brave Browser.app/Contents/MacOS/Brave Browser'
        except:
            print('Brave browser was not found on Mac, set your own browser up in settings.py')

        s = Service(chromedriver)

        driver = webdriver.Chrome(service=s, options=option)
        # driver = webdriver.Safari()
    load_cookies()

def save_cookie():
    with open(COOKIES, 'wb') as filehandler:
        pickle.dump(driver.get_cookies(), filehandler)


def load_cookies():
    """
    Loads cookies before the first GET to magyarorszag.hu as it redirects to .gov.hu
        if no cookies were found for magyarorszag.hu domain and then these domains can't be
        added because of domain mismatch
        https://stackoverflow.com/questions/63220248/how-to-preload-cookies-before-first-request-with-python3-selenium-chrome-webdri
    :return:
    """
    if os.path.exists(COOKIES) and os.path.isfile(COOKIES):
        print("Loading cookies from " + COOKIES)
        cookies = pickle.load(open(COOKIES, "rb"))

        # Enables network tracking so we may use Network.setCookie method
        driver.execute_cdp_cmd('Network.enable', {})

        # Iterate through pickle dict and add all the cookies
        for cookie in cookies:
            # Fix issue Chrome exports 'expiry' key but expects 'expire' on import
            if 'expiry' in cookie:
                cookie['expires'] = cookie['expiry']
                del cookie['expiry']

            # Set the actual cookie
            driver.execute_cdp_cmd('Network.setCookie', cookie)

        # Disable network tracking
        driver.execute_cdp_cmd('Network.disable', {})
        print("Cookies loaded successfully")
        return 1
    print("Cookies were not found")