import asyncio
import time
import traceback

from selenium.common import TimeoutException, WebDriverException
from logging import exception

from .models.GetDataException import GetDataException
from .models.LoginException import LoginException
from .models.UnreleasedLPException import UnreleasedLPException
from .src.login import login
from .src.get_data import get_data
from .data import settings, helpers
from tests.test_response import RES


# MARK: Request car
async def request_car(car_requests: dict, sid: str):
    """Opens page and does the rest of the query

    Args:
        car_requests (dict): Dictionary of CarRequests
        sid (str): ID of client
    """

    try:
        helpers.check_auth(car_requests[sid].x_api_key)

        license_plate = car_requests[sid].requested_car.lower().strip().replace(" ", "")
        license_plates = [license_plate]
        await asyncio.sleep(0)

        # MARK: LP validation
        if len(license_plates[0]) < 6 or len(license_plates[0]) > 7:
            await helpers.send_to_client(
                sid,
                "message",
                "License plate is not valid, should be 6 or 7 characters",
                100,
                "fail",
            )
            return

        try:
            await settings.init(sid, car_requests[sid].x_api_key)  # MARK: Init settings
        except WebDriverException as wde:
            await helpers.send_to_client(
                sid,
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
                await helpers.send_to_client(sid, key, value, counter)
                counter += 100 / 17

            if license_plates[0].lower() == "test112":
                await helpers.send_to_client(sid, "message", "This is a test error message", 100, "fail")
            else:
                await helpers.send_to_client(sid, "message", None, 100, "success")
            return

        settings.driver.get(settings.URL)

        try:
            await login()  # MARK: Login - 13 %
        except LoginException as exc:
            exception(exc)
            settings.driver.quit()
            await helpers.send_to_client(sid, "message", f"Login failed: {exc.message}", 100, "fail")
            return
        except TimeoutException as toexc:
            exception(toexc)
            settings.driver.quit()
            await helpers.send_to_client(sid, "message", f"Login failed: Selenium timeout on login page", 100, "fail")
            return

        try:
            await get_data(license_plates)  # MARK: Get data
        except UnreleasedLPException as ulp:
            exception(ulp)
            settings.driver.quit()
            await helpers.send_to_client(sid, "message", f"GET_DATA ERROR: {ulp.args[0]}", 100, "fail")
            return
        except GetDataException as exc:
            exception(exc)
            settings.driver.quit()
            await helpers.send_to_client(sid, "message", f"GET_DATA ERROR: {traceback.format_exc()}", 100, "fail")
            return
        except Exception as exc:
            exception(exc)
            settings.driver.quit()
            await helpers.send_to_client(sid, "message", f"GET_DATA ERROR: {traceback.format_exc()}", 100, "fail")
            return

        settings.driver.quit()

        await helpers.send_to_client(sid, "message", None, 100, "success")
        return
    except Exception as exc:
        exception(exc)
        return
