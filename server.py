import json
import asyncio
import websockets

from application.request_car import request_car


class WebSocketServer:

    def __init__(self, host, port, secret):
        self._secret = secret
        self._server = websockets.serve(self._start, host, port)

    def start(self):
        print("Server started")
        asyncio.get_event_loop().run_until_complete(self._server)
        asyncio.get_event_loop().run_forever()

    async def _start(self, websocket, path):
        print(f"Connected from path ={path}")
        while True:
            secret = await websocket.recv()
            return_data = await request_car([secret.lower()], websocket)
            await websocket.send(json.dumps(return_data, default=vars))


if __name__ == "__main__":
    print("Starting server...")
    server = WebSocketServer("", 3001, "")
    server.start()
