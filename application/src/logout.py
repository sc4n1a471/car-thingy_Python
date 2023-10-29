import time

from selenium.webdriver.common.by import By

from application.data import settings
from application.data.xpaths import XPATHS


async def logout():
    """Logs the user out by clicking logout"""
    await settings.send_data(
        "message",
        "Logging out...",
        -1,
        "pending",
    )
    time.sleep(1)
    settings.driver.switch_to.default_content()
    settings.driver.switch_to.frame(2)
    settings.driver.find_element(By.XPATH, XPATHS.get("logout_button")).click()
