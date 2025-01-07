from dataclasses import dataclass, field


@dataclass
class Inspection:
    name: str
    images: list[str] = field(default_factory=list)
