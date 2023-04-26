import os

from selenium import webdriver

COUNTER = 0
WAIT_TIME = 13
WAIT_TIME_TAB_CHANGE = 0.5

if os.getenv("RUN_ON_SERVER"):
    from selenium.webdriver.chrome.options import Options
    from selenium.webdriver.chrome.service import Service
    from webdriver_manager.chrome import ChromeDriverManager

    # options = Options()
    # options.add_argument('--no-sandbox')
    # options.add_argument('--headless')
    # options.add_argument('--disable-dev-shm-usage')
    #
    # from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
    #
    # driver = webdriver.Remote('http://10.11.12.169:4444/wd/hub', DesiredCapabilities.CHROME)

    # TODO: Figure out why f.ing chrome crashes in the docker container
    # Running the selenium container and connecting to that one does not work either...
    # chromedriver is running flawlessly on an brand new Ubuntu vm but crashes in the docker container
else:
    from selenium.webdriver.chrome.service import Service
    chromedriver = "/chromedriver"

    option = webdriver.ChromeOptions()

    option.binary_location = '/Applications/Brave Browser.app/Contents/MacOS/Brave Browser'

    s = Service(chromedriver)

    driver = webdriver.Chrome(service=s, options=option)
    # driver = webdriver.Safari()


CREDENTIALS_LOCATION = "../../credentials.env"