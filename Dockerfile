FROM --platform=linux/amd64 python:3.10-buster
ENV RUN_ON_SERVER=true

WORKDIR /app

COPY ["requirements.txt", "./"]

RUN pip install -r requirements.txt

RUN apt update

RUN apt install software-properties-common -y
RUN add-apt-repository ppa:mozillateam/ppa
RUN apt install firefox-esr -y -f


RUN wget https://github.com/mozilla/geckodriver/releases/download/v0.33.0/geckodriver-v0.33.0-linux64.tar.gz
RUN tar -xvf geckodriver-v0.33.0-linux64.tar.gz
RUN mv geckodriver /usr/local/bin/
RUN cd /usr/local/bin/ && chmod +x geckodriver

COPY . .

EXPOSE 5000

# RUN flask --app server.py --debug run --host=0.0.0.0
# RUN python3 server.py
CMD ["flask", "--app", "server.py", "run", "--host=0.0.0.0"]