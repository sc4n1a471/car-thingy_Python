import asyncio
import time
import traceback

from selenium.common import TimeoutException, WebDriverException
from logging import info, exception

from .models.GetDataException import GetDataException
from .models.LoginException import LoginException
from .models.UnreleasedLPException import UnreleasedLPException
from .src.login import login
from .src.get_data import get_data
from .data import settings, helpers
from tests.test_response import RES


# MARK: Request car
async def request_car(sid: str):
    """Opens page and does the rest of the query

    Args:
        car_requests (dict): Dictionary of CarRequests
        sid (str): ID of client
    """

    try:
        helpers.check_auth(helpers.car_requests[sid].x_api_key)

        license_plate = helpers.car_requests[sid].license_plate.lower().strip().replace(" ", "")
        license_plates = [license_plate]

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

        if helpers.car_requests[sid].status == "running":
            try:
                helpers.car_requests[sid].selenium_session = await settings.init(
                    sid, helpers.car_requests[sid].x_api_key
                )  # MARK: Init settings
            except WebDriverException as wde:
                await helpers.send_to_client(
                    sid,
                    "message",
                    f"Settings init failed with the following error: {wde.msg}",
                    100,
                    "fail",
                )
                return

        selenium = helpers.car_requests[sid].selenium_session
        if selenium is None:
            await helpers.send_to_client(sid, "message", "Selenium session is None", 100, "fail")
            return

        # region: Test mode
        if helpers.car_requests[sid].status == "running":
            if (
                license_plates[0].lower() == "test111"
                or license_plates[0].lower() == "test112"
                or license_plates[0].lower() == "test113"
            ):
                selenium.quit()

                counter = 5.5

                for key, value in RES.items():
                    time.sleep(0.05)
                    await helpers.send_to_client(sid, key, value, counter)
                    counter += 100 / 17

                if license_plates[0].lower() == "test111":
                    await helpers.send_to_client(sid, "message", None, 100, "success")
                if license_plates[0].lower() == "test112":
                    await helpers.send_to_client(sid, "message", "This is a test error message", 100, "fail")
                if license_plates[0].lower() == "test113":
                    helpers.car_requests[sid].set_status("waiting")
                    await helpers.send_to_client(sid, "message", "Waiting for 2FA code input...", 50, "waiting")
                    return
                return
        if license_plates[0].lower() == "test113":
            info(f"Got 2FA code: {helpers.car_requests[sid].login_code} for sid: {sid}")
            helpers.car_requests[sid].status = "running"
            await helpers.send_to_client(sid, "message", None, 100, "success")
            return
        # endregion

        if helpers.car_requests[sid].status == "running":
            selenium.get(settings.URL)

        try:
            wait_for_login_code = await login(sid, selenium)  # MARK: Login - 13 %
            if wait_for_login_code:
                return
        except LoginException as exc:
            exception(exc)
            try:
                selenium.quit()
            except:
                pass
            await helpers.send_to_client(sid, "message", f"Login failed: {exc.message}", 100, "fail")
            return
        except TimeoutException as toexc:
            exception(toexc)
            selenium.quit()
            await helpers.send_to_client(sid, "message", f"Login failed: Selenium timeout on login page", 100, "fail")
            return

        try:
            await get_data(sid, license_plates)  # MARK: Get data
        except UnreleasedLPException as ulp:
            exception(ulp)
            selenium.quit()
            await helpers.send_to_client(sid, "message", f"GET_DATA ERROR: {ulp.args[0]}", 100, "fail")
            return
        except GetDataException as exc:
            exception(exc)
            selenium.quit()
            await helpers.send_to_client(sid, "message", f"GET_DATA ERROR: {traceback.format_exc()}", 100, "fail")
            return
        except Exception as exc:
            exception(exc)
            selenium.quit()
            await helpers.send_to_client(sid, "message", f"GET_DATA ERROR: {traceback.format_exc()}", 100, "fail")
            return

        selenium.quit()
        await helpers.send_to_client(sid, "message", None, 100, "success")
        return
    except Exception as exc:
        exception(exc)
        return
