class UnreleasedLPException(Exception):
    """Exception raised for license plate that was not released

        Attributes:
            message -- Message thrown with the exception
    """

    def __init__(self):
        super().__init__("This license plate was not released, no car was found")
