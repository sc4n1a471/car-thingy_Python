import os

from selenium import webdriver

counter = 0
wait_time = 13
wait_time_tab_change = 0.5

if os.getenv("RUN_ON_SERVER"):
    # from selenium.webdriver.chrome.options import Options
    # from selenium.webdriver.chrome.service import Service
    # from webdriver_manager.chrome import ChromeDriverManager
    #
    from selenium.webdriver.firefox.options import Options
    from selenium.webdriver.common.keys import Keys
    from selenium.webdriver.firefox.firefox_binary import FirefoxBinary
    options = Options()
    options.add_argument('--no-sandbox')
    options.add_argument('--headless')
    # options.add_argument('--disable-dev-shm-usage')
    # driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()), options=options)

    driver = webdriver.Firefox(options=options, executable_path='/usr/local/bin/geckodriver')
else:
    chromedriver = "/chromedriver"
    option = webdriver.ChromeOptions()
    option.binary_location = '/Applications/Brave Browser.app/Contents/MacOS/Brave Browser'

    # driver = webdriver.Safari()
    driver = webdriver.Chrome(options=option)

credentials_location = "../../credentials.env"