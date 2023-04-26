from flask import Flask, jsonify
import traceback
try:
    from app.request_car import request_car
    print("request_car imported from .request_car")
except Exception as exc:
    import app.request_car
    print("request_car imported from request_car")

app = Flask(__name__)

@app.route("/<license_plate>")
def get_license_plate(license_plate):
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

if __name__ == '__main__':
    get_license_plate("RRZ538")