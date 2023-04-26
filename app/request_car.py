try:
    from .src.login import login
except ImportError as exc:
    import src.login

try:
    from .models.Car import Car
except ImportError as exc:
    import models.Car

try:
    from .src.get_data import get_data
except ImportError as exc:
    import src.get_data

try:
    from .data import settings
except ImportError as exc:
    import data.settings

import traceback

def request_car(license_plates):
    cars: [Car] = []

    settings.driver.get("https://magyarorszag.hu/jszp_szuf")

    try:
        login()
    except Exception as exc:
        print(f"LOGIN ERROR: {traceback.format_exc()}")
        raise Exception(f"LOGIN ERROR: {traceback.format_exc()}")

    try:
        cars = get_data(license_plates)
    except Exception as e:
        print(f"GET_DATA ERROR: {traceback.format_exc()}")
        raise Exception(f"GET_DATA ERROR: {traceback.format_exc()}")

    settings.driver.close()

    return cars

# if __name__ == '__main__':
#     # nyeh()
#
#     requested_cars = [
#         # 'YES880',
#         # 'LLU750',
#         # 'SUTYI1',
#         # 'AAKZ462',
#         'RRZ538',
#         # 'SHB600',
#         # 'KHB860',
#         # 'GSM140',
#         # 'BMWM888',
#         # 'SIG093',
#         # 'MMK238',
#         # 'DCH560',
#         # 'DCA560' - 'Ez nem kerult kiadasra'
#         # 'HKL138' - No info
#         # 'LPV220',
#         # 'CDN426',
#     ]
#     cars: [Car] = []
#
#     settings.driver.get("https://magyarorszag.hu/jszp_szuf")
#
#     try:
#         login()
#     except Exception as e:
#         print(f"LOGIN ERROR: {e}")
#         exit(2)
#
#     try:
#         cars = get_data(requested_cars)
#     except Exception as e:
#         print(f"GET_DATA ERROR: {e}")
#
#     settings.driver.close()
#
#     COUNTER = 0
#
#     asd = 0
