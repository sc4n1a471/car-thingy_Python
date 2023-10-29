from dataclasses import dataclass
import json


@dataclass
class Mileage:
    mileage_date: str
    mileage: int

    def toJSON(self):
        return json.dumps(self, default=lambda o: o.__dict__, sort_keys=True, indent=4)
