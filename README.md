# car-thingy_Python

Ez lenni repository for car-thingy_Python

---

This server-side application is part of the car-thingy system. It's a Python application that sends/receives messages through the Websocket protocol. It accepts a license plate, logs in to JSZP with the given credentials, requests the 2FA code from the client, searches for the license plate and sends the following information back to the client:
- Basic registration info of the car
- Basic specs of the car
- Odometer
- Accidents
- Restrictions
- Images taken on inspections (saves to local folder and uploads the image paths to [car_thingy_GO](https://github.com/sc4n1a471/elrek-system_GO))

---

## ATTENTION
This project is for personal and educational use only, I take no responsibility for any possible usecase.

---

## Setup ##
- If you want to download/store the images, create a folder in the root directory with the name `downloaded_images`
- If you don't want to, don't create the folder
- Deploy [Selenium image](https://hub.docker.com/r/selenium/standalone-chrome)
### Terraform ###
- `terraform init`
- Deploy the container using the following line after modifying it with your variables
```bash
terraform apply \
    -var="container_name=car-thingy_python" \
    -var="container_version=latest" \                
    -var="env=prod" \
    -var="run_on_server=true" \                                    # If false, the selenium browser will run on the local machine
    -var="app_username=<Ügyfélkapu username>" \
    -var="app_password=<Ügyfélkapu passwd>" \
    -var="app_grid_ip=<http://<selenium grid IP>:4444/wd/hub>" \
    -var="go_ip=<http:/<car-thingy_GO IP>:3000>" \
    -var="graylog_host=<Graylog host>" \                            # Optional
    -auto-approve
```
### Docker ###
- Deploy the container using the following line after modifying with your variables
```bash
docker run \
  --mount source=downloaded_images,target=/app/downloaded_images \
  --mount source=logs,target=/app/logs \
  -e "RUN_ON_SERVER=True" \ # If false, the selenium browser will run on the local machine
  -e "APP_USERNAME=<Ügyfélkapu username>" \
  -e "APP_PASSWORD=<Ügyfélkapu passwd>" \
  -e "APP_GRID_IP=http://<selenium grid IP>:4444/wd/hub" \
  -e "GO_IP=http:/<car-thingy_GO IP>:3000" \
  -p <external port>:3001 \
  --restart unless-stopped \
  --name=car-thingy_Python \
  sc4n1a471/car-thingy_python:latest
```

## Usage ##
- Connect to the `ws://IP:PORT` using plain websocket
- Set the `x-api-key` header of the request to your API key
- Send a message containing the license plate
- When it requests your 2FA key, send it as plain text
- It will send messages in this format:

### In progress
```json
{
    "status": "pending",
    "percentage": 25,
    "key": "brand",
    "value": "BENTLEY"
}
```

### Success
```json
{
    "status": "success",
    "percentage": 100,
    "key": "message"
}
```

### Error:
```json
{
    "status": "fail",
    "percentage": 100,
    "key": "message",
    "value": "error msg"
}
```

### 2FA request:
```json
{
    "status": "waiting",
    "percentage": 100,
    "key": "input",
    "value": "msg"
}
```
