from dataclasses import dataclass, field


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
    restrictions: list[str] = field(default_factory=list)
    mileage: list[dict] = field(default_factory=list)
    accidents: list[dict] = field(default_factory=list)
    has_origin_record = True
    has_restriction_record = True
    has_inspection_record = True
    has_mileage_record = True
    has_accident_record = True
