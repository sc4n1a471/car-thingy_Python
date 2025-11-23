FROM python:3.14-slim

WORKDIR /app

COPY ["requirements.txt", "./"]

RUN pip install -r requirements.txt

RUN apt update

COPY . .

EXPOSE 3001

ENTRYPOINT ["python3", "./server.py"]
