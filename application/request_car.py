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
    """Opens page and does the rest of the query

    Attributes:
        license_plates -- Requested license plate
    """

    if len(license_plates[0]) < 6 or len(license_plates[0]) > 7:
        return {
            "error": 'License plate is not valid, should be 6 or 7 characters',
            "status": 'fail'
        }

    cars: [Car] = []

    try:
        await settings.init(websocket_param)
    except WebDriverException as wde:
        return {
            "error": f'Settings init failed with the following error: {wde.msg}',
            "status": 'fail'
        }

    if license_plates[0].lower() == "test111":
        settings.driver.quit()
        time.sleep(1)
        await settings.send_message("Test car is on the way...")
        time.sleep(1)
        return RES

    settings.driver.get(settings.URL)

    try:
        await login()
    except LoginException as exc:
        print(f"LOGIN ERROR: {traceback.format_exc()}")
        settings.driver.quit()
        return {
            "status": 'fail',
            "error": exc.message
        }
    except TimeoutException as toexc:
        settings.driver.quit()
        return {
            "status": 'fail',
            "error": toexc.msg
        }

    try:
        cars = await get_data(license_plates)
    except UnreleasedLPException as ulp:
        print(f"GET_DATA ERROR: {ulp}")
        settings.driver.quit()
        return {
            "status": 'fail',
            "error": ulp.args[0]
        }
    except GetDataException as exc:
        print(f"GET_DATA ERROR: {traceback.format_exc()}")
        settings.driver.quit()
        return {
            "status": 'fail',
            "error": exc.message
        }
    except Exception as exc:
        print(f"GET_DATA ERROR: {traceback.format_exc()}")
        settings.driver.quit()
        return {
            "status": 'fail',
            "error": exc.args
        }

    settings.driver.quit()

    return {
        "data": cars,
        "status": 'success'
    }
