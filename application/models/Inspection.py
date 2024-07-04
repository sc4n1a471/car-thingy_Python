from dataclasses import dataclass, field


@dataclass
class Inspection:
    name: str
    images: [str] = field(default_factory=list)
