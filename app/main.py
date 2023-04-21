from app.src.login import login
from app.models.Car import Car
from app.src.get_data import get_data
from app.data import settings

if __name__ == '__main__':
    settings.init()

    requested_cars = [
        # 'YES880',
        # 'LLU750',
        # 'SUTYI1',
        # 'AAKZ462',
        # 'RRZ538',
        # 'SHB600',
        'KHB860',
        # 'GSM140',
        # 'BMWM888',
        # 'SIG093',
        # 'MMK238',
        # 'DCH560',
        # 'DCA560' - 'Ez nem kerult kiadasra'
        # 'HKL138' - No info
        # 'LPV220',
        # 'CDN426',
    ]
    cars: [Car] = []

    settings.driver.get("https://magyarorszag.hu/jszp_szuf")

    # login()
    try:
        login()
    except Exception as e:
        print(f"LOGIN ERROR: {e}")
        exit(2)

    try:
        cars = get_data(requested_cars)
    except Exception as e:
        print(f"GET_DATA ERROR: {e}")

    settings.driver.close()

    COUNTER = 0

    asd = 0
