variable "container_name" {
  description = "Name of the container"
  type = string
}
variable "container_version" {
  description = "Version of the Docker image"
  type        = string
  default     = "latest-dev"
}

variable "env" {
  description = "Environment to deploy (prod or dev)"
  type        = string
  default     = "dev"
}

variable "run_on_server" {
  description = "True if the app runs on a server with selenium grid"
  type        = bool
  sensitive = false
}

variable "app_username" {
  description = "Gov username"
  type        = string
  sensitive   = true
}

variable "app_password" {
  description = "Gov password"
  type        = string
  sensitive = true
}

variable "app_grid_ip" {
  description = "IP of Selenium Grid"
  type        = string
  sensitive = true        
}

variable "go_ip" {
  description = "IP of car-thingy_go"
  type        = string
  sensitive = true
}

variable "graylog_host" {
  description = "The Graylog host with ip and port: <ip>:<port>"
  type        = string
}