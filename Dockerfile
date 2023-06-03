FROM --platform=linux/amd64 python:3.11.3-slim-buster

WORKDIR /app

COPY ["requirements.txt", "./"]

RUN pip install -r requirements.txt

RUN apt update

COPY . .

EXPOSE 5000

CMD ["flask", "--app", "server.py", "run", "--host=0.0.0.0"]
