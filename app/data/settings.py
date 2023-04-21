from selenium import webdriver

counter = 0
wait_time = 13

chromedriver = "/chromedriver"
option = webdriver.ChromeOptions()
option.binary_location = '/Applications/Brave Browser.app/Contents/MacOS/Brave Browser'

# driver = webdriver.Safari()
driver = webdriver.Chrome(options=option)

credentials_location = "../../credentials.env"