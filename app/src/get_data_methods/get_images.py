import urllib.request

from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.support import expected_conditions as ec

from ...data import settings
from ...data.xpaths import XPATHS
from selenium.webdriver.common.by import By
import time
import os

def get_images(car):

    car_inspections = []

    inspections = settings.driver.find_elements(By.XPATH, XPATHS.get('inspections'))

    for (inspection_data, i) in zip(inspections, range(0, len(inspections))):
        if i != 0:  # the first inspection is open on tab change
            inspection_data.click()
        print(inspection_data.text)
        car_inspections.append({
            'inspection': inspection_data.text
        })
        time.sleep(0.4)

    show_pictures_buttons = settings.driver.find_elements(By.XPATH, XPATHS.get('inspections_show_pictures'))
    show_pictures_buttons.pop(0)

    for (button, i) in zip(show_pictures_buttons, range(0, len(inspections) + 1)):
        images = []
        print(button.text)

        button.click()

        settings.driver.switch_to.default_content()
        dialog_frame = settings.driver.find_element(By.XPATH, XPATHS.get('inspections_pictures_dialog_frame'))
        settings.driver.switch_to.frame(dialog_frame)
        print('Switched iframe to dialog_frame')

        WebDriverWait(settings.driver, 10).until(ec.presence_of_element_located((By.XPATH, XPATHS.get('inspections_pictures'))))
        imgs = settings.driver.find_elements(By.XPATH, XPATHS.get('inspections_pictures'))

        for img in imgs:
            src = img.get_attribute('src')
            if not images.__contains__(src):
                images.append(src)

        car_inspections[i]['images'] = images

        close_dialog_button = settings.driver.find_element(By.XPATH, XPATHS.get('inspections_close_button'))
        close_dialog_button.click()

        settings.driver.switch_to.default_content()
        iframe = settings.driver.find_element(By.XPATH, XPATHS.get('main_frame'))
        settings.driver.switch_to.frame(iframe)
        print("Switched to main iframe")

    car.images = car_inspections
    save_images(car.license_plate, car.images)


def save_images(license_plate, images):

    try:
        os.mkdir('downloaded_images')
    except Exception as exc:
        print(f"Folder creation for downloaded_images failed, error: {exc}")
        return

    license_plate_path = os.path.join('downloaded_images', license_plate)
    try:
        os.mkdir(license_plate_path)
    except Exception as exc:
        print(f"Folder creation for license plate ({license_plate_path}) failed, error: {exc}")
        return

    for image_collection in images:
        inspection_path = os.path.join(license_plate_path, image_collection.get('inspection'))

        try:
            os.mkdir(inspection_path)
        except Exception as exc:
            print(f"Folder creation for inspection ({inspection_path}) failed, error: {exc}")
            continue

        counter = 0
        for image_src in image_collection.get('images'):
            image_path = os.path.join(inspection_path, f'{counter}.jpg')
            urllib.request.urlretrieve(image_src, image_path)
            counter += 1