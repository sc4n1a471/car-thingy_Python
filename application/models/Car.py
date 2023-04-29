from dataclasses import dataclass

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
    restrictions: [str] = None
    mileage: dict = None
    accidents: dict = None
    inspections: [dict] = None
    has_origin_record = True
    has_restriction_record = True
    has_inspection_record = True
    has_mileage_record = True
    has_accident_record = True