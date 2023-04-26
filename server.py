import traceback
from flask import Flask, jsonify
from application.request_car import request_car

app = Flask(__name__)

@app.route("/<license_plate>")
def get_license_plate(license_plate):
    """Returns the requested car details

    Attributes:
        license_plates -- Requested license plate
    """
    with app.app_context():
        if len(license_plate) < 6 or len(license_plate) > 7:
            message = 'License plate is not valid, should be 6 or 7 characters'
            status = 'fail'
        else:
            try:
                message = request_car([license_plate])
                status = 'success'
            except Exception as exc:
                status = 'fail'
                message = str(traceback.format_exc())

        return jsonify({
            'status:': status,
            'message': message
        })

# if __name__ == '__main__':
#     get_license_plate("AAA111")
