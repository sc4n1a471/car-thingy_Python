import os.path
import unittest

from application.data import settings
from application.models.Car import Car
from application.src.get_data_methods.get_car_data import get_car_data


class MyTestCase(unittest.TestCase):

    def setUp(self):
        settings.init()
        filename = "Jármű%20Szolgáltatási%20Platform_files/saved_resource(1).html"
        path = os.getcwd()
        path_to_file = os.path.join(path, filename)
        settings.URL = f'file://{path_to_file}'
        settings.driver.get(settings.URL)
        settings.TESTING = True

        self.car = Car()
    def test_get_car_data(self):

        get_car_data(self.car)
        expected = Car(
            license_plate='',
            brand='BMW',
            model='',
            type_code='740 I',
            status='A jármű forgalomban van',
            first_reg='1998.10.15.',
            first_reg_hun='1998.10.15.',
            num_of_owners='5',
            year='1998',
            color='FEKETE',
            engine_size='4398',
            performance=281,
            fuel_type='BENZIN',
            gearbox='Automata',
            restrictions=[''],
            mileage={'': ''},
            accidents={'': ''},
            inspections=None
        )

        self.assertEqual(self.car, expected)  # add assertion here


if __name__ == '__main__':
    unittest.main()
