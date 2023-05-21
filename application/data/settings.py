import os

from dotenv import load_dotenv, find_dotenv
from selenium import webdriver

COUNTER = 0
WAIT_TIME = 13
WAIT_TIME_TAB_CHANGE = 0.5
TESTING = False
URL = "https://magyarorszag.hu/jszp_szuf"


# TODO: don't use init(), use global variables, so don't init the driver every time
#       this way if multiple license plates are requested individually in a row, it would not login every time
def init():
    global driver

    if os.getenv("RUN_ON_SERVER"):
        from selenium.webdriver.chrome.service import Service
        from selenium.webdriver.common.desired_capabilities import DesiredCapabilities

        CREDENTIALS_LOCATION = find_dotenv('credentials.env')
        load_dotenv(dotenv_path=CREDENTIALS_LOCATION)

        grid_ip = os.getenv("GRID")

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


CREDENTIALS_LOCATION = "../../credentials.env"
