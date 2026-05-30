import shutil
import urllib.request
import asyncio
import os
import requests

from typing import List

from selenium.webdriver.support import expected_conditions as ec
from selenium.webdriver.common.by import By
from selenium.webdriver.remote.webdriver import WebDriver

from application.data import settings, helpers
from application.data.xpaths import XPATHS
from application.models.Car import Car
from application.models.Inspection import Inspection

from logging import info


async def get_images(
    sid: str,
    selenium: WebDriver,
    car: Car,
    skippable_inspection_index: int = 0,
    skippable_inspection_type: str | None = None,
) -> tuple[int, str | None]:
    """Downloads images associated to the inspections.
    If there is an error regarding an empty image dialog, it needs to be re-run with skipping that one inspection

    Args:
        sid (str): ID of client connection
        selenium (WebDriver): Selenium session
        car (Car): Car object
        skippable_inspection_index (int): Index of the inspection to skip, defaults to 0, meaning that no inspection will be skipped
        skippable_inspection_type (str | None): Type of the inspection to skip, defaults to None, meaning that no inspection will be skipped

    Returns:
        tuple[int, str | None]: A tuple containing the index of the inspection that needs to be skipped and its type, or (0, None) if no inspection needs to be skipped
    """

    percentage = 82
    max_percentage = 98

    # MARK: Inspection types
    inspection_types = [
        {
            "name": "technical Inspections",
            "tab_path": XPATHS.inspections_tab,
            "list_path": XPATHS.inspections,
            "show_pictures_path": XPATHS.inspections_show_pictures,
            "no_inspection_data": XPATHS.no_inspection_data,
        },
        {
            "name": "originality Inspections",
            "tab_path": XPATHS.originality_tab,
            "list_path": XPATHS.originalities,
            "show_pictures_path": XPATHS.originality_show_pictures,
            "no_inspection_data": XPATHS.no_originality_data,
        },
    ]

    if skippable_inspection_index != 0:
        selenium.switch_to.default_content()
        iframe = selenium.find_element(By.XPATH, XPATHS.main_frame)
        selenium.switch_to.frame(iframe)

    debug_car_inspections: List[Inspection] = []
    for inspection_type in inspection_types:
        car_inspections: List[Inspection] = []

        await helpers.async_wait_for(
            selenium, ec.element_to_be_clickable((By.XPATH, XPATHS.inspections_tab)), timeout=5
        )
        selenium.find_element(By.XPATH, inspection_type["tab_path"]).click()
        await helpers.send_to_client(
            sid, "message", f"Searching for {inspection_type['name']}...", percentage, "pending"
        )

        if len(selenium.find_elements(By.XPATH, inspection_type["no_inspection_data"])) != 0:
            await helpers.send_to_client(sid, "message", "NOT FOUND: Inspection data", max_percentage, "pending")
            continue

        try:
            await helpers.async_wait_for(
                selenium, ec.presence_of_element_located((By.XPATH, inspection_type["list_path"])), timeout=5
            )
        except:
            await helpers.send_to_client(sid, "message", "NOT FOUND: Inspection data", max_percentage, "pending")
            continue

        inspections = selenium.find_elements(By.XPATH, inspection_type["list_path"])

        for inspection_data, i in zip(inspections, range(0, len(inspections))):
            if i != 0:  # the first inspection is open on tab change
                inspection_data.click()

            counter = 0
            retry = True
            while retry:
                if inspection_data.text != "" or counter == 30:
                    percentage += 1
                    await helpers.send_to_client(sid, "message", f"FOUND: Inspection", percentage, "pending")
                    car_inspections.append(Inspection(inspection_data.text))
                    break
                await helpers.send_to_client(
                    sid,
                    "message",
                    "NOT FOUND: Inspection, searching again...",
                    -1,
                    "pending",
                )
                counter += 1
                await asyncio.sleep(0.1)
            await asyncio.sleep(0.4)

        counter = 0
        while counter < 5:
            # MARK: Opening image panels
            try:
                show_pictures_buttons = selenium.find_elements(By.XPATH, inspection_type["show_pictures_path"])
                show_pictures_buttons.pop(0)
                counter = 6
            except:
                counter += 1
                await asyncio.sleep(0.25)

        if counter == 5:
            return 0, None

        for button, i in zip(show_pictures_buttons, range(0, len(inspections) + 1)):
            if i == skippable_inspection_index and inspection_type["name"] == skippable_inspection_type:
                continue
            images = []

            # MARK: Opening image dialogs
            button.click()

            selenium.switch_to.default_content()
            dialog_frame = selenium.find_element(By.XPATH, XPATHS.inspections_pictures_dialog_frame)
            selenium.switch_to.frame(dialog_frame)

            try:
                await helpers.async_wait_for(
                    selenium, ec.presence_of_element_located((By.XPATH, XPATHS.inspections_no_pictures)), timeout=2
                )
                # await asyncio.sleep(1)
            except:
                try:
                    await helpers.async_wait_for(
                        selenium,
                        ec.presence_of_element_located((By.XPATH, XPATHS.inspections_pictures)),
                        timeout=15,
                    )
                except:
                    raise Exception("Couldn't find the pictures element nor the no pictures element for some reason")

                imgs = selenium.find_elements(By.XPATH, XPATHS.inspections_pictures)

                for img in imgs:
                    src = img.get_attribute("src")
                    if src is not None:
                        replaced_src = src.replace("data:image/jpeg;base64,", "")
                        if not replaced_src in images:
                            images.append(replaced_src)
                            percentage += 0.1
                            await helpers.send_to_client(sid, "message", f"FOUND: Image", percentage, "pending")

                car_inspections[i].images = images

            await helpers.async_wait_for(
                selenium, ec.presence_of_element_located((By.XPATH, XPATHS.inspections_close_button)), timeout=4
            )
            close_dialog_button = selenium.find_element(By.XPATH, XPATHS.inspections_close_button)
            try:
                await helpers.async_wait_for(
                    selenium, ec.element_to_be_clickable((By.XPATH, XPATHS.inspections_close_button)), timeout=5
                )
                close_dialog_button.click()
            except:
                await helpers.send_to_client(
                    sid,
                    "message",
                    f"No images found in this inspection and cannot close dialog, retrying...",
                    82,
                    "pending",
                )
                selenium.refresh()
                return i, inspection_type["name"]

            selenium.switch_to.default_content()
            iframe = selenium.find_element(By.XPATH, XPATHS.main_frame)
            selenium.switch_to.frame(iframe)

        await save_images(sid, car.license_plate, car_inspections)
        debug_car_inspections.extend(car_inspections)

    for inspection in debug_car_inspections:
        info(f"Inspection name: {inspection.name}, number of images: {len(inspection.images)}")

    return 0, None


# MARK: Save images
async def save_images(sid: str, license_plate: str, inspections: list[Inspection]):
    """Saves the image files into folders

    Args:
        sid (str): ID of client connection
        license_plate (str): License plate of the inspections
        inspections (list[Inspection]): Inspection objects
    """
    if len(inspections) == 0:
        return
    await helpers.send_to_client(sid, "message", "Saving images...", 94, "pending")

    if not os.path.exists("downloaded_images"):
        await helpers.send_to_client(
            sid,
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
        await helpers.send_to_client(
            sid,
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
            await helpers.send_to_client(
                sid,
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
        await upload_inspections(sid, license_plate, inspections, image_paths)
    except Exception as exc:
        await helpers.send_to_client(sid, "message", f"Upload failed with error {exc}", 98, "fail")
        shutil.rmtree(unix_path)


# MARK: Upload images
async def upload_inspections(sid: str, license_plate: str, inspections: list[Inspection], image_paths: List[str]):
    """Uploads the inspection images to the GO server

    Args:
        license_plate (str): License plate of the inspections
        inspections (list[Inspection]): Inspection objects
        image_paths (list[str]): Full paths of the inspection images

    Raises:
        Exception: Raised if the upload fails or the GO_IP environment variable is not set
    """

    url = os.getenv("GO_IP")
    if url is None:
        raise Exception("Environment variable GO_IP is not set")
    payload = []
    for inspection, image_path in zip(inspections, image_paths):
        individual_payload = {
            "licensePlate": license_plate,
            "name": inspection.name,
            "imageLocation": image_path,
        }
        payload.append(individual_payload)

    info(f"Payload: {payload}")
    info(f"AUTHKEY in get_images: {settings.AUTHKEY}")
    req = requests.post(
        url + "/inspections",
        json=payload,
        headers={"Content-Type": "application/json", "x-api-key": settings.AUTHKEY},
    )

    if req.status_code != 200:
        raise Exception(f"Upload failed with status code: {req.status_code} and error: {req.text}")
    else:
        await helpers.send_to_client(sid, "message", f"Upload successful", 98, "pending")
