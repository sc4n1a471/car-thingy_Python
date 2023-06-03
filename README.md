# NodeJS-Thingy_Python
[![Build, Publish, Redeploy](https://github.com/sc4n1a471/NodeJS-Thingy_Python/actions/workflows/docker.yml/badge.svg)](https://github.com/sc4n1a471/NodeJS-Thingy_Python/actions/workflows/docker.yml)

Ez lenni repository for NodeJS_Thingy_Python

---

Ez a program egy API szerver mögött álló Selenium webscraper. Rendszámlekérdezést hajt végre az Ügyfélkapu rendszerén 
keresztül és számos információt lekérdez a rendszámról.
Egy GET kéréssel elküldjük neki a lekérdezni kívánt rendszámot, majd az bejelentkezik a megadott
azonosítási adatokkal az Ügyfélkapu rendszerébe, rákeres a rendszámra és olyan adatokat visszaad, mint:
- Nyilvántrtás információk
- Autó specifikációi
- Óraállás
- Bejelentett balesetek
- Korlátozások
- Műszaki vizsgálatokhoz tartozó képek base64 formátumban, illetve lokális mentéssel

---

## FIGYELEM
Az alkalmazás csak személyes használatra szánt projekt, egyetemi projektmunka és tanulás céljából készült! Felelősséget nem vállalok más felhasználási céljáért!

---

## Setup ##
- If you want to download the images, create a folder in the root directory with the name `downloaded_images`
- If you don't want to, don't create the folder
### Docker ###
- Deploy [Selenium image](https://hub.docker.com/r/selenium/standalone-chrome)
- Modify the docker-compose.yml file to your needs:
```
    environment:
      APP_USERNAME: default
      APP_PASSWORD: default
      APP_GRID_IP: 'http://<selenium_docker_ip>:<port>/wd/hub'
      RUN_ON_SERVER: True
```
- Run the image with this command: `docker compose up -d`
### Local without Docker ###
- Install python dependencies with `pip install -r requirements.txt`
- Add these variables as environment variables:
```
APP_GRID_IP=http://<selenium_docker_ip>:<port>/wd/hub
APP_USERNAME=<username>
APP_PASSWORD=<password>
```
- Set up your own browser driver in settings.py
- Run API server by running server.py or with the following command: `flask --app server run --host=0.0.0.0 -p 3001`

---

## API Endpoints: ##
| GET_BY_ID               | 
|-------------------------|
| /:license_plate         | 

---

## Response example ##

```json
{
  "status": "success",
  "error": "message if failed",
  "message": [
    {
      "license_plate": "AAAA111",
      "...": "<other_data>"
    }
  ]
}
```

---

## Code test results: ##
- `prospector -i venv`
```
Messages
========

application/data/settings.py
  Line: 36
    pylint: import-outside-toplevel / Import outside toplevel (selenium.webdriver.chrome.service.Service) (col 8)
  Line: 45
    pylint: bare-except / No exception type(s) specified (col 8)

application/src/get_data_methods/get_car_data.py
  Line: 17
    mccabe: MC0001 / get_car_data is too complex (23)
  Line: 77
    pylint: too-many-boolean-expressions / Too many boolean expressions in if statement (7/5) (col 11)

application/src/get_data_methods/get_images.py
  Line: 60
    pycodestyle: E713 / test for membership should be 'not in' (col 20)

pylint_django
  Line: 1
    pylint: django-not-available / Django is not available on the PYTHONPATH



Check Information
=================
         Started: 2023-04-29 13:02:30.336506
        Finished: 2023-04-29 13:02:36.245727
      Time Taken: 5.91 seconds
       Formatter: grouped
        Profiles: default, no_doc_warnings, no_test_warnings, strictness_medium, strictness_high, strictness_veryhigh, no_member_warnings
      Strictness: None
      Libraries Used: django, flask
       Tools Run: dodgy, mccabe, profile-validator, pycodestyle, pyflakes, pylint
  Messages Found: 6
  ```

- `pylint application`
```
************* Module application.request_car
application/request_car.py:1:0: C0114: Missing module docstring (missing-module-docstring)
application/request_car.py:55:11: W0718: Catching too general exception Exception (broad-exception-caught)
************* Module application.models.LoginException
application/models/LoginException.py:1:0: C0114: Missing module docstring (missing-module-docstring)
application/models/LoginException.py:1:0: C0103: Module name "LoginException" doesn't conform to snake_case naming style (invalid-name)
************* Module application.models.Car
application/models/Car.py:27:0: C0304: Final newline missing (missing-final-newline)
application/models/Car.py:1:0: C0114: Missing module docstring (missing-module-docstring)
application/models/Car.py:1:0: C0103: Module name "Car" doesn't conform to snake_case naming style (invalid-name)
application/models/Car.py:4:0: C0115: Missing class docstring (missing-class-docstring)
application/models/Car.py:4:0: R0902: Too many instance attributes (18/7) (too-many-instance-attributes)
************* Module application.models.GetDataException
application/models/GetDataException.py:1:0: C0114: Missing module docstring (missing-module-docstring)
application/models/GetDataException.py:1:0: C0103: Module name "GetDataException" doesn't conform to snake_case naming style (invalid-name)
************* Module application.models.UnreleasedLPException
application/models/UnreleasedLPException.py:1:0: C0114: Missing module docstring (missing-module-docstring)
application/models/UnreleasedLPException.py:1:0: C0103: Module name "UnreleasedLPException" doesn't conform to snake_case naming style (invalid-name)
************* Module application.data.xpaths
application/data/xpaths.py:15:0: C0301: Line too long (117/100) (line-too-long)
application/data/xpaths.py:48:0: C0301: Line too long (106/100) (line-too-long)
application/data/xpaths.py:49:0: C0301: Line too long (102/100) (line-too-long)
application/data/xpaths.py:1:0: C0114: Missing module docstring (missing-module-docstring)
************* Module application.data.settings
application/data/settings.py:13:0: C0301: Line too long (110/100) (line-too-long)
application/data/settings.py:34:0: C0301: Line too long (106/100) (line-too-long)
application/data/settings.py:12:1: W0511: TODO: don't use init(), use global variables, so don't init the driver every time (fixme)
application/data/settings.py:32:9: W0511: TODO: Figure out why f.ing chrome crashes in the docker container (fixme)
application/data/settings.py:1:0: C0114: Missing module docstring (missing-module-docstring)
application/data/settings.py:14:0: C0116: Missing function or method docstring (missing-function-docstring)
application/data/settings.py:15:4: W0601: Global variable 'driver' undefined at the module level (global-variable-undefined)
application/data/settings.py:36:8: C0415: Import outside toplevel (selenium.webdriver.chrome.service.Service) (import-outside-toplevel)
application/data/settings.py:45:8: W0702: No exception type(s) specified (bare-except)
application/data/settings.py:48:8: C0103: Variable name "s" doesn't conform to snake_case naming style (invalid-name)
************* Module application.src.logout
application/src/logout.py:1:0: C0114: Missing module docstring (missing-module-docstring)
************* Module application.src.get_data
application/src/get_data.py:34:0: C0301: Line too long (107/100) (line-too-long)
application/src/get_data.py:111:0: C0301: Line too long (103/100) (line-too-long)
application/src/get_data.py:136:0: C0301: Line too long (115/100) (line-too-long)
application/src/get_data.py:139:0: C0301: Line too long (109/100) (line-too-long)
application/src/get_data.py:1:0: C0114: Missing module docstring (missing-module-docstring)
application/src/get_data.py:18:0: C0116: Missing function or method docstring (missing-function-docstring)
application/src/get_data.py:127:16: C0103: Variable name "e" doesn't conform to snake_case naming style (invalid-name)
application/src/get_data.py:132:16: C0103: Variable name "e" doesn't conform to snake_case naming style (invalid-name)
************* Module application.src.login
application/src/login.py:44:0: C0301: Line too long (118/100) (line-too-long)
application/src/login.py:1:0: C0114: Missing module docstring (missing-module-docstring)
************* Module application.src.get_data_methods.get_accidents
application/src/get_data_methods/get_accidents.py:1:0: C0114: Missing module docstring (missing-module-docstring)
************* Module application.src.get_data_methods.get_car_data
application/src/get_data_methods/get_car_data.py:60:0: C0301: Line too long (104/100) (line-too-long)
application/src/get_data_methods/get_car_data.py:63:0: C0301: Line too long (104/100) (line-too-long)
application/src/get_data_methods/get_car_data.py:73:0: C0301: Line too long (104/100) (line-too-long)
application/src/get_data_methods/get_car_data.py:1:0: C0114: Missing module docstring (missing-module-docstring)
application/src/get_data_methods/get_car_data.py:77:11: R0916: Too many boolean expressions in if statement (7/5) (too-many-boolean-expressions)
application/src/get_data_methods/get_car_data.py:17:0: R0912: Too many branches (16/12) (too-many-branches)
application/src/get_data_methods/get_car_data.py:17:0: R0915: Too many statements (76/50) (too-many-statements)
************* Module application.src.get_data_methods.get_mileage
application/src/get_data_methods/get_mileage.py:1:0: C0114: Missing module docstring (missing-module-docstring)
************* Module application.src.get_data_methods.get_restrictions
application/src/get_data_methods/get_restrictions.py:1:0: C0114: Missing module docstring (missing-module-docstring)
************* Module application.src.get_data_methods.get_images
application/src/get_data_methods/get_images.py:1:0: C0114: Missing module docstring (missing-module-docstring)
application/src/get_data_methods/get_images.py:87:15: W0718: Catching too general exception Exception (broad-exception-caught)
application/src/get_data_methods/get_images.py:94:11: W0718: Catching too general exception Exception (broad-exception-caught)
application/src/get_data_methods/get_images.py:103:15: W0718: Catching too general exception Exception (broad-exception-caught)

-----------------------------------
Your code has been rated at 8.83/10
```
