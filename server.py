import asyncio
import websockets

from application.request_car import request_car


async def main():
    async with websockets.serve(request_car, "localhost", 3001):
        await asyncio.Future()


if __name__ == "__main__":
    asyncio.run(main())
