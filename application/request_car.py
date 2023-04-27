import traceback

from .models.GetDataException import GetDataException
from .models.LoginException import LoginException
from .models.UnreleasedLicensePlate import UnreleasedLicensePlate
from .src.login import login
from .models.Car import Car
from .src.get_data import get_data
from .data import settings

def request_car(license_plates):
    """Opens page and does the rest of the query

    Attributes:
        license_plates -- Requested license plate
    """

    if len(license_plates[0]) < 6 or len(license_plates[0]) > 7:
        return {
            "message": 'License plate is not valid, should be 6 or 7 characters',
            "status": 'fail'
        }

    cars: [Car] = []

    settings.init()
    settings.driver.get("https://magyarorszag.hu/jszp_szuf")

    try:
        login()
    except LoginException as exc:
        print(f"LOGIN ERROR: {traceback.format_exc()}")
        settings.driver.close()
        return {
            "status": 'fail',
            "message": exc
        }

    try:
        cars = get_data(license_plates)
    except UnreleasedLicensePlate as ulp:
        print(f"GET_DATA ERROR: {ulp}")
        settings.driver.close()
        return {
            "status": 'fail',
            "message": ulp.args[0]
        }
    except GetDataException as exc:
        print(f"GET_DATA ERROR: {traceback.format_exc()}")
        settings.driver.close()
        return {
            "status": 'fail',
            "message": exc
        }
    except Exception as exc:
        print(f"GET_DATA ERROR: {traceback.format_exc()}")
        settings.driver.close()
        return {
            "status": 'fail',
            "message": exc
        }

    settings.driver.close()

    return {
        "message": cars,
        "status": 'success'
    }
