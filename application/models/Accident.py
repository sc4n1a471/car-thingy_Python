from dataclasses import dataclass


@dataclass
class Accident:
    licensePlate: str
    accidentDate: str
    role: str
