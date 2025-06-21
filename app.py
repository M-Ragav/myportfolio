from flask import Flask, request, render_template
import smtplib
import os

app = Flask(__name__)

@app.route('/')
def home():
    return render_template('index.html')

@app.route('/contact', methods=['POST'])
def contact():
    name = request.form.get('name')
    email = request.form.get('email')
    message = request.form.get('message')

    try:
        server = smtplib.SMTP('smtp.gmail.com', 587)
        server.starttls()
        server.login(os.getenv('EMAIL_USER'), os.getenv('EMAIL_PASS'))
        server.sendmail(email, os.getenv('EMAIL_USER'), f"{name} <{email}>: {message}")
        server.quit()
        return "OK"
    except Exception as e:
        print(e)
        return "Error: Email failed"

if __name__ == '__main__':
    app.run()
