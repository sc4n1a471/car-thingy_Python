from dataclasses import dataclass, field
from selenium.webdriver.remote.webdriver import WebDriver


@dataclass
class CarRequest:
    x_api_key: str = ""
    license_plate: str = ""
    percentage: float = 0.0
    status: str = "running"  # running/waiting
    selenium_session: WebDriver | None = None
    login_code: str = ""

    def set_status(self, new_status: str):
        """Sets new status for request

        Args:
            new_status (str): New status [running / waiting]

        Raises:
            ValueError: If invalid new status is provided
        """
        if new_status in ["running", "waiting"]:
            self.status = new_status
        else:
            raise ValueError("Invalid status value")
