import asyncio
import websockets

from application.data import settings
from application.request_car import request_car
from logging import info


async def main():
    async with websockets.serve(request_car, host="", port=3001):
        info("Server started")
        await asyncio.Future()


if __name__ == "__main__":
    # settings.setup_logging()
    asyncio.run(main())
