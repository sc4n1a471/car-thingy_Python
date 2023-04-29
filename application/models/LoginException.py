class LoginException(Exception):
    """Exception raised for login errors

    Attributes:
        message -- Message thrown with the exception
    """
    def __init__(self, message):
        self.message = message
        super().__init__(self.message)
