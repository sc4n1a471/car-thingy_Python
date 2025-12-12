import socketio
import uvicorn
import asyncio
import logging

from application.models.CarRequest import CarRequest
from application.request_car import request_car
from application.data import helpers, settings
from logging import info
from fastapi import FastAPI

# region: Server init
settings.setup_logging()
logger = logging.getLogger(__name__)
# Create a Socket.IO server instance, * allowing connections from any origin, NOT PRODUCTION READY
helpers.sio = socketio.AsyncServer(cors_allowed_origins="*", async_mode="asgi", logger=True)

app = FastAPI()

# Wrap the FastAPI app with the Socket.IO ASGI app
socket_app = socketio.ASGIApp(helpers.sio, other_asgi_app=app)
# endregion

info("Server started")


# region: Socket.IO event handlers
# MARK: Connect
@helpers.sio.event
async def connect(sid, environ):
    logging.info(f"Client connected: {sid}")
    await helpers.sio.emit("server_message", "Welcome!", to=sid)
    new_car_request: CarRequest = CarRequest(environ.get("HTTP_X_API_KEY"), "", 0.0)
    helpers.car_requests[sid] = new_car_request


# MARK: Disconnect
@helpers.sio.event
async def disconnect(sid, reason):
    global processes
    logging.info(f"the client disconnected: {sid}, reason: {reason}")
    try:
        del helpers.car_requests[sid]
    except KeyError:
        logging.error("CarRequest was not found when disconnected??? How is this possible?")

    if reason == helpers.sio.reason.CLIENT_DISCONNECT:
        logging.info("the client disconnected")
    elif reason == helpers.sio.reason.SERVER_DISCONNECT:
        logging.info("the server disconnected the client")
    else:
        logging.info(f"disconnect reason: {reason}")


# MARK: Request license plate
@helpers.sio.event
async def request_license_plate(sid, license_plate):
    logging.info(f"requested car: {license_plate} by {sid}")
    await helpers.send_to_client(
        sid, "message", f"Request received, querying license plate {license_plate}", 1, "pending"
    )
    helpers.car_requests[sid].license_plate = license_plate
    asyncio.create_task(request_car(sid))


# MARK: Input 2FA event
@helpers.sio.event
async def input_2fa(sid, data):
    if sid not in helpers.car_requests:
        logging.error(f"Input received from unknown sid: {sid}")
        return

    if helpers.car_requests[sid].status != "waiting":
        logging.error(f"Input received from sid: {sid} but not waiting for input")
        return

    helpers.car_requests[sid].login_code = data
    logging.info(f"Input received from sid: {sid}")
    await helpers.send_to_client(sid, "message", "2FA code received, continuing...", 15, "pending")
    asyncio.create_task(request_car(sid))


# MARK: Stop request
@helpers.sio.event
async def stop_request(sid):
    logging.info(f"Request to stop script received from sid: {sid}")
    if sid not in helpers.car_requests:
        logging.error(f"Stop request received from unknown sid: {sid}")
        return
    selenium = helpers.car_requests[sid].selenium_session
    if selenium is None:
        logging.error(f"Stop request received from sid: {sid} but selenium session is None")
        return
    selenium.quit()


# endregion


# region: FastAPI endpoints
# MARK: Root endpoint
@app.get("/")
async def root():
    return {"status": "FastAPI + Socket.IO running"}


# endregion

# MARK: Run the server
if __name__ == "__main__":
    uvicorn.run(socket_app, host="0.0.0.0", port=8000)
