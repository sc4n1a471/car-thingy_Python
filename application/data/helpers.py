import logging
import json
import os
import requests
from socketio import AsyncServer

sio: AsyncServer
car_requests = {}
# {
#     "<sid>": CarRequest(),
#     "<sid>": CarRequest(),
# }


# MARK: Send to client
async def send_to_client(sid: str, key: str, value: str | int | None, percentage: int | float, status="pending"):
    """Sends json to client

    Args:
        sid (str): ID of client
        key (str): message/input/restrictions/accidents/mileage
        value (str | int | None): The value of the message
        percentage (int): Status percentage
        status (str, optional): pending/waiting/success/fail. Defaults to "pending".
    """
    logging.info(f"Sending to {sid}: {key} {value}, {percentage}, {status}")

    if percentage != -1:
        car_requests[sid].percentage = percentage

    if status == "success":
        message_object = {"status": status, "percentage": 100, "key": "message"}
    else:
        message_object = {
            "status": status,
            "percentage": percentage,
            "key": key,
            "value": value,
        }
    logging.info(message_object)
    await sio.emit("car_response", json.dumps(message_object), to=sid)


# MARK: Send data
def send(driver, cmd, params={}):
    """
    This is required to send CDP command to remote driver
    https://stackoverflow.com/questions/72121479/cdp-with-remote-webdriver-webdriver-object-has-no-attribute-execute-cdp-cmd
    :param driver:
    :param cmd: Mostly 'Network.<enable/setCookie/disable>'
    :param params: Mostly '{}/cookie/{}'
    :return:
    """
    resource = "/session/%s/chromium/send_command_and_get_result" % driver.session_id
    url = driver.command_executor._url + resource
    body = json.dumps({"cmd": cmd, "params": params})
    response = driver.command_executor._request("POST", url, body)
    return response.get("value")


# MARK: Check API Key
def check_auth(auth_key):
    go_ip = os.getenv("GO_IP")
    if go_ip is None:
        raise ValueError("Environment variable GO_IP is not set")
    req = requests.get(go_ip + "/auth", headers={"x-api-key": auth_key})
    if req.status_code != 200:
        raise ValueError("Invalid API key")
