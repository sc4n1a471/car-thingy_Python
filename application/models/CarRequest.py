from dataclasses import dataclass, field


@dataclass
class CarRequest:
    x_api_key: str = ""
    license_plate: str = ""
    percentage: float = 0.0
    status: str = "running"
    selenium_session_id: str = ""
