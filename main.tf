terraform {
  required_providers {
    docker = {
      source  = "kreuzwerker/docker"
      version = "~> 3.0.0"
    }
  }
}

locals {
  container_name = var.container_name
  port_mapping   = var.env == "prod" ? "3000:3000" : "3001:3000"
}

resource "docker_image" "car-thingy_python" {
  name = "sc4n1a471/car-thingy_python:${var.container_version}"
}

resource "docker_container" "car-thingy_python" {
  name  = local.container_name
  image = docker_image.car-thingy_python.name

  volumes {
    host_path      = var.env == "prod" ? "/media/car-thingy/prod" : "/media/car-thingy/dev"
    container_path = "/app/logs"
  }

  volumes {
    host_path      = var.env == "prod" ? "/media/car-thingy/prod" : "/media/car-thingy/dev"
    container_path = "/app/downloaded_images"
  }

  env = [
    "RUN_ON_SERVER=${var.run_on_server}",
    "APP_USERNAME=${var.app_username}",
    "APP_PASSWORD=${var.app_password}",
    "APP_GRID_IP=${var.app_grid_ip}",
    "GO_IP=${var.go_ip}",
  ]

  ports {
    internal = 3001
    external = var.env == "prod" ? 3005 : (var.env == "dev" ? 3006 : null)
  }

  restart = "on-failure"
  max_retry_count = 5
}