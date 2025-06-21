# app.py
from flask import Flask, request
import smtplib
import os

app = Flask(__name__)

@app.route('/contact', methods=['POST'])
def contact():
    name = request.form['name']
    email = request.form['email']
    message = request.form['message']

    server = smtplib.SMTP('smtp.gmail.com', 587)
    server.starttls()
    server.login(os.getenv("EMAIL_USER"), os.getenv("EMAIL_PASS"))
    server.sendmail(email, os.getenv("EMAIL_USER"), f"{name}: {message}")
    server.quit()
    
    return "OK"
