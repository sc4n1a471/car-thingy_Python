import traceback

from .models.GetDataException import GetDataException
from .models.LoginException import LoginException
from .src.login import login
from .models.Car import Car
from .src.get_data import get_data
from .data import settings

def request_car(license_plates):
    """Opens page and does the rest of the query

    Attributes:
        license_plates -- Requested license plate
    """
    cars: [Car] = []

    settings.driver.get("https://magyarorszag.hu/jszp_szuf")

    try:
        login()
    except Exception as exc:
        print(f"LOGIN ERROR: {traceback.format_exc()}")
        settings.driver.close()
        settings.driver.quit()
        raise LoginException(f"LOGIN ERROR: {traceback.format_exc()}") from exc

    try:
        cars = get_data(license_plates)
    except Exception as exc:
        print(f"GET_DATA ERROR: {traceback.format_exc()}")
        settings.driver.close()
        settings.driver.quit()
        raise GetDataException(f"GET_DATA ERROR: {traceback.format_exc()}") from exc

    settings.driver.close()
    settings.driver.quit()

    return cars
