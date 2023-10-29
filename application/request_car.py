import time
import traceback

from selenium.common import TimeoutException, WebDriverException
from .models.GetDataException import GetDataException
from .models.LoginException import LoginException
from .models.UnreleasedLPException import UnreleasedLPException
from .src.login import login
from .models.Car import Car
from .src.get_data import get_data
from .data import settings
from tests.test_response import RES


async def request_car(license_plates, websocket_param):
    """
    Opens page and does the rest of the query

    :param license_plates: Requested license plate
    """

    if len(license_plates[0]) < 6 or len(license_plates[0]) > 7:
        await settings.send_data(
            "message",
            "License plate is not valid, should be 6 or 7 characters",
            100,
            "fail",
        )
        return

    cars: [Car] = []

    try:
        await settings.init(websocket_param)
    except WebDriverException as wde:
        await settings.send_data(
            "message",
            f"Settings init failed with the following error: {wde.msg}",
            100,
            "fail",
        )
        return

    if license_plates[0].lower() == "test111":
        settings.driver.quit()

        num_of_keys = 17
        counter = 0

        # iterate through RES.get("data")[0] and its keys, values and send them one by one
        for key, value in RES.get("data")[0].items():
            time.sleep(0.25)
            await settings.send_data(key, value, counter)
            counter += 1
        await settings.send_data("message", None, 17, "success")
        return

    settings.driver.get(settings.URL)

    try:
        await login()  # 13 %
    except LoginException as exc:
        print(f"LOGIN ERROR: {traceback.format_exc()}")
        settings.driver.quit()
        await settings.send_data("message", f"Login failed: {exc.message}", 100, "fail")
        return
    except TimeoutException as toexc:
        settings.driver.quit()
        await settings.send_data("message", f"Login failed: {toexc.msg}", 100, "fail")
        return

    try:
        cars = await get_data(license_plates)
    except UnreleasedLPException as ulp:
        print(f"GET_DATA ERROR: {ulp}")
        settings.driver.quit()
        await settings.send_data(
            "message", f"GET_DATA ERROR: {ulp.args[0]}", 100, "fail"
        )
        return
    except GetDataException as exc:
        print(f"GET_DATA ERROR: {traceback.format_exc()}")
        settings.driver.quit()
        await settings.send_data(
            "message", f"GET_DATA ERROR: {traceback.format_exc()}", 100, "fail"
        )
        return
    except Exception as exc:
        print(f"GET_DATA ERROR: {traceback.format_exc()}")
        settings.driver.quit()
        await settings.send_data(
            "message", f"GET_DATA ERROR: {traceback.format_exc()}", 100, "fail"
        )
        return

    settings.driver.quit()

    await settings.send_data("message", None, 100, "success")
    return
