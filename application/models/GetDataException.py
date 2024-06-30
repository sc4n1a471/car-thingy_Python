class GetDataException(Exception):
    """Exception raised for car data errors

    Attributes:
        message -- Message thrown with the exception
    """

    def __init__(self, message):
        self.message = message
        super().__init__(self.message)
