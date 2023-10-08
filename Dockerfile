FROM python:3.11.3-slim-buster

WORKDIR /app

COPY ["requirements.txt", "./"]

RUN pip install -r requirements.txt

RUN apt update

COPY . .

EXPOSE 3001

CMD ["python", "server.py"]
