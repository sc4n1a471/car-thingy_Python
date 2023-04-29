FROM --platform=linux/amd64 python:3.10-buster
ENV RUN_ON_SERVER=true

WORKDIR /app

COPY ["requirements.txt", "./"]

RUN pip install -r requirements.txt

RUN apt update

# RUN curl -sS -o - https://dl-ssl.google.com/linux/linux_signing_key.pub | apt-key add
# RUN bash -c "echo 'deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main' >> /etc/apt/sources.list.d/google-chrome.list"
# RUN apt -y update
# RUN apt install -y google-chrome-stable

# RUN apt install -y unzip

# RUN wget https://chromedriver.storage.googleapis.com/113.0.5672.24/chromedriver_linux64.zip
# RUN unzip chromedriver_linux64.zip
# RUN mv chromedriver /usr/bin/chromedriver
# RUN chown root:root /usr/bin/chromedriver
# RUN chmod +x /usr/bin/chromedriver

COPY . .

EXPOSE 5000

CMD ["flask", "--app", "server.py", "run", "--host=0.0.0.0"]
