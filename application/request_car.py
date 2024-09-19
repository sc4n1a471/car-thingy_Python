import asyncio
import time
import traceback
import os
import requests

from selenium.common import TimeoutException, WebDriverException
from .models.GetDataException import GetDataException
from .models.LoginException import LoginException
from .models.UnreleasedLPException import UnreleasedLPException
from .src.login import login
from .models.Car import Car
from .src.get_data import get_data
from .data import settings
from tests.test_response import RES
from logging import exception


def check_auth(auth_key):
    go_ip = os.getenv("GO_IP")
    if go_ip is None:
        raise ValueError("Environment variable GO_IP is not set")
    req = requests.get(go_ip + "/auth", headers={"x-api-key": auth_key})
    if req.status_code != 200:
        raise ValueError("Invalid API key")


async def request_car(websocket_param):
    """
    Opens page and does the rest of the query

    :param license_plates: Requested license plate
    """

    try:
        async for license_plate in websocket_param:
            authKey = websocket_param.request_headers.get("x-api-key")
            check_auth(authKey)

            license_plate = license_plate.lower().strip().replace(" ", "")
            license_plates = [license_plate]
            await asyncio.sleep(0)

            # MARK: LP validation
            if len(license_plates[0]) < 6 or len(license_plates[0]) > 7:
                await settings.send_data(
                    "message",
                    "License plate is not valid, should be 6 or 7 characters",
                    100,
                    "fail",
                )
                return

            try:
                await settings.init(websocket_param)  # MARK: Init settings
            except WebDriverException as wde:
                await settings.send_data(
                    "message",
                    f"Settings init failed with the following error: {wde.msg}",
                    100,
                    "fail",
                )
                return

            # MARK: Test mode
            if license_plates[0].lower() == "test111" or license_plates[0].lower() == "test112":
                settings.driver.quit()

                counter = 5.5

                for key, value in RES.items():
                    time.sleep(0.05)
                    await settings.send_data(key, value, counter)
                    counter += 100 / 17

                if license_plates[0].lower() == "test112":
                    await settings.send_data("message", "This is a test error message", 100, "fail")
                else:
                    await settings.send_data("message", None, 100, "success")
                return

            settings.driver.get(settings.URL)

            try:
                await login()  # MARK: Login - 13 %
            except LoginException as exc:
                exception(exc)
                settings.driver.quit()
                await settings.send_data("message", f"Login failed: {exc.message}", 100, "fail")
                return
            except TimeoutException as toexc:
                settings.driver.quit()
                await settings.send_data("message", f"Login failed: {toexc.msg}", 100, "fail")
                return

            try:
                await get_data(license_plates)  # MARK: Get data
            except UnreleasedLPException as ulp:
                exception(ulp)
                settings.driver.quit()
                await settings.send_data("message", f"GET_DATA ERROR: {ulp.args[0]}", 100, "fail")
                return
            except GetDataException as exc:
                exception(exc)
                settings.driver.quit()
                await settings.send_data("message", f"GET_DATA ERROR: {traceback.format_exc()}", 100, "fail")
                return
            except Exception as exc:
                exception(exc)
                settings.driver.quit()
                await settings.send_data("message", f"GET_DATA ERROR: {traceback.format_exc()}", 100, "fail")
                return

            settings.driver.quit()

            await settings.send_data("message", None, 100, "success")
            return
    except Exception as exc:
        exception(exc)
        return
