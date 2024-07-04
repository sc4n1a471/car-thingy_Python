import shutil
import urllib.request
import time
import os

import requests
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.support import expected_conditions as ec
from selenium.webdriver.common.by import By

from application.data import settings
from application.data.xpaths import XPATHS
from application.models.Inspection import Inspection


async def get_images(car):
    """
    Downloads images associated to the inspections
    :param car: car object
    """

    percentage = 82
    max_percentage = 98

    # WebDriverWait(settings.driver, 5).until(ec.presence_of_element_located((By.XPATH, XPATHS.get("inspections_tab"))))
    settings.driver.find_element(By.XPATH, XPATHS.get("inspections_tab")).click()
    await settings.send_data("message", "Searching for inspection data...", percentage, "pending")

    if len(settings.driver.find_elements(By.XPATH, XPATHS.get("no_inspection_data"))) != 0:
        await settings.send_data("message", "NOT FOUND: Inspection data", max_percentage, "pending")
    else:
        car_inspections: [Inspection] = []

        WebDriverWait(settings.driver, 3).until(ec.presence_of_element_located((By.XPATH, XPATHS.get("inspections"))))

        inspections = settings.driver.find_elements(By.XPATH, XPATHS.get("inspections"))
        for inspection_data, i in zip(inspections, range(0, len(inspections))):
            if i != 0:  # the first inspection is open on tab change
                inspection_data.click()

            counter = 0
            retry = True
            while retry:
                if inspection_data.text != "" or counter == 30:
                    percentage += 1
                    await settings.send_data("message", f"FOUND: Inspection", percentage, "pending")
                    car_inspections.append(Inspection(inspection_data.text))
                    break
                await settings.send_data(
                    "message",
                    "NOT FOUND: Inspection, searching again...",
                    -1,
                    "pending",
                )
                counter += 1
                time.sleep(0.1)
            time.sleep(0.4)

        counter = 0
        while counter < 5:
            try:
                show_pictures_buttons = settings.driver.find_elements(By.XPATH, XPATHS.get("inspections_show_pictures"))
                show_pictures_buttons.pop(0)
                counter = 6
            except:
                counter += 1
                time.sleep(0.25)

        if counter == 5:
            return

        for button, i in zip(show_pictures_buttons, range(0, len(inspections) + 1)):
            images = []

            button.click()

            settings.driver.switch_to.default_content()
            dialog_frame = settings.driver.find_element(By.XPATH, XPATHS.get("inspections_pictures_dialog_frame"))
            settings.driver.switch_to.frame(dialog_frame)

            try:
                WebDriverWait(settings.driver, 2).until(
                    ec.presence_of_element_located((By.XPATH, XPATHS.get("inspections_no_pictures")))
                )
                # time.sleep(1)
            except:
                WebDriverWait(settings.driver, 7).until(
                    ec.presence_of_element_located((By.XPATH, XPATHS.get("inspections_pictures")))
                )

                imgs = settings.driver.find_elements(By.XPATH, XPATHS.get("inspections_pictures"))

                for img in imgs:
                    src = img.get_attribute("src")
                    replaced_src = src.replace("data:image/jpeg;base64,", "")
                    if not replaced_src in images:
                        images.append(replaced_src)
                        percentage += 0.25
                        await settings.send_data("message", f"FOUND: Image", percentage, "pending")

                car_inspections[i].images = images

            WebDriverWait(settings.driver, 4).until(
                ec.presence_of_element_located((By.XPATH, XPATHS.get("inspections_close_button")))
            )
            close_dialog_button = settings.driver.find_element(By.XPATH, XPATHS.get("inspections_close_button"))
            close_dialog_button.click()

            settings.driver.switch_to.default_content()
            iframe = settings.driver.find_element(By.XPATH, XPATHS.get("main_frame"))
            settings.driver.switch_to.frame(iframe)

        await save_images(car.license_plate, car_inspections)


async def save_images(license_plate, inspections):
    """Saves the image files into folders"""
    await settings.send_data("message", "Saving images...", 94, "pending")

    if not os.path.exists("downloaded_images"):
        await settings.send_data(
            "message",
            "downloaded_images folder does not exist, not saving images...",
            96,
            "pending",
        )
        # try:
        #     os.mkdir('downloaded_images')
        # except Exception as exc:
        #     print(f"Folder creation for downloaded_images failed, error: {exc}")
        #     return
        return

    license_plate_path = os.path.join("downloaded_images", license_plate)
    try:
        os.mkdir(license_plate_path)
    except Exception as exc:
        await settings.send_data(
            "message",
            f"Folder for license plate ({license_plate_path}) already exists",
            96,
            "pending",
        )

    image_paths = []

    for inspection in inspections:
        unix_path = (
            os.path.join(license_plate_path, inspection.name).replace(" ", "_").replace(".", "-").replace(",", "")
        )[:-1]

        docker_path = (
            os.path.join(license_plate_path, inspection.name).replace(" ", "_").replace(".", "-").replace(",", "")
        )[:-1] + "/"
        # og path:          downloaded_images/RRZ538/MŰSZAKI VIZSGÁLAT, 2019.08.23.
        # unix path:        downloaded_images/RRZ538/MŰSZAKI_VIZSGÁLAT_2019-08-23
        # docker path:      downloaded_images/RRZ538/MŰSZAKI_VIZSGÁLAT_2019-08-23/

        image_paths.append(docker_path)

        try:
            os.mkdir(unix_path)
        except Exception as exc:
            await settings.send_data(
                "message",
                f"Folder for inspection ({unix_path}) already exists",
                96,
                "pending",
            )

        counter = 0
        for image_src in inspection.images:
            if image_src is None:
                continue

            image_path = os.path.join(unix_path, f"{counter}.jpeg")
            urllib.request.urlretrieve("data:image/jpeg;base64," + image_src, image_path)

            counter += 1

    try:
        await upload_inspections(license_plate, inspections, image_paths)
    except Exception as exc:
        await settings.send_data("message", f"Upload failed with error {exc}", 98, "fail")
        shutil.rmtree(unix_path)


async def upload_inspections(license_plate, inspections, image_paths):
    """
    Uploads the inspection images to the GO server

    :param license_plate: License plate of the inspections
    :param inspections: Inspection objects
    :param image_paths: Full paths of the inspection images
    """

    url = os.getenv("GO_IP")
    payload = []
    for inspection, image_path in zip(inspections, image_paths):
        individual_payload = {
            "licensePlate": license_plate,
            "name": inspection.name,
            "imageLocation": image_path,
        }
        payload.append(individual_payload)

    print(f"Payload: {payload}")
    req = requests.post(url, json=payload, headers={"Content-Type": "application/json"})

    if req.status_code != 200:
        raise Exception(f"Upload failed with status code: {req.status_code} and error: {req.text}")
    else:
        await settings.send_data("message", f"Upload successful", 98, "pending")
