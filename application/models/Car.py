from dataclasses import dataclass, field

from application.models.Accident import Accident
from application.models.Inspection import Inspection
from application.models.Mileage import Mileage


@dataclass
class Car:
    license_plate: str = ""
    brand: str = ""
    model: str = ""
    type_code: str = ""
    status: str = ""
    first_reg: str = ""
    first_reg_hun: str = ""
    num_of_owners: int = 0
    year: int = 0
    color: str = ""
    engine_size: int = 0
    performance: int = 0
    fuel_type: str = ""
    gearbox: str = ""
    restrictions: [str] = field(default_factory=list)
    mileage: [Mileage] = field(default_factory=list)
    accidents: [Accident] = field(default_factory=list)
    inspections: [Inspection] = field(default_factory=list)
    has_origin_record = True
    has_restriction_record = True
    has_inspection_record = True
    has_mileage_record = True
    has_accident_record = True