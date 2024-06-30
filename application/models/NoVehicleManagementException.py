class NoVehicleManagementException(Exception):
    """Exception raised for no vehicle management

    Attributes:
        message -- Message thrown with the exception
    """

    def __init__(self):
        super().__init__("No vehicle management data is available currently...")
