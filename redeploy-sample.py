#!/usr/bin/env python3

import sys
import json
import docker


def parse_payload():
    payload = sys.argv[1]
    payload_parsed = json.loads(payload)
    version = payload_parsed["version"]
    env = payload_parsed["env"]
    print(f"Getting {version}...")
    return version, env


def main():
    version, env = parse_payload()

    if version == "":
        print("Version is empty, getting latest version...")
        version = "latest"

    if env == "prod":
        print("Redeploying production container...")
        name = "car-thingy_python_prod"
        volumes = {
            "downloaded_images_prod": {"bind": "/app/downloaded_images", "mode": "rw"},
            "logs": {"bind": "/app/logs", "mode": "rw"},
        }
        environment = [
            "RUN_ON_SERVER=True/False",
            "APP_USERNAME=<APP_USERNAME>",
            "APP_PASSWORD=<APP_PASSWORD>",
            "APP_GRID_IP=<APP_GRID_IP>",
            "GO_IP=<GO_IP>",
        ]
        ports = {"3001/tcp": "<PORT_AS_INT>"}
    else:
        print("Redeploying development container...")
        name = "car-thingy_python_dev"
        volumes = {
            "downloaded_images_dev": {"bind": "/app/downloaded_images", "mode": "rw"},
            "logs": {"bind": "/app/logs", "mode": "rw"},
        }
        environment = [
            "RUN_ON_SERVER=True/False",
            "APP_USERNAME=<APP_USERNAME>",
            "APP_PASSWORD=<APP_PASSWORD>",
            "APP_GRID_IP=<APP_GRID_IP>",
            "GO_IP=<GO_IP>",
        ]
        ports = {"3001/tcp": "<PORT_AS_INT>"}

    client = docker.from_env()
    try:
        container = client.containers.get(name)
        container.stop()
        print("Stopped current version")
    except:
        pass
    client.containers.prune()
    print("Removed current version")

    client.containers.run(
        f"sc4n1a471/car-thingy_python:{version}",
        detach=True,
        volumes=volumes,
        environment=environment,
        ports=ports,
        name=name,
        network='car-thingy',
        restart_policy={"Name": "on-failure", "MaximumRetryCount": 5}
    )
    print(f"Version {version} was deployed successfully")


if __name__ == "__main__":
    main()
