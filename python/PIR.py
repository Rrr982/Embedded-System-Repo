import RPi.GPIO as GPIO
import time
import os
import cv2
import mysql.connector
from mysql.connector import Error
import smtplib
from email.mime.text import MIMEText

# Suppress warnings
GPIO.setwarnings(False)

# GPIO setup
GPIO.setmode(GPIO.BCM)
PIR_PIN = 27  # GPIO27 for PIR sensor
BUZZER_PIN = 17  # GPIO17 for Buzzer
GPIO.setup(PIR_PIN, GPIO.IN)
GPIO.setup(BUZZER_PIN, GPIO.OUT)

# Email configuration
EMAIL_ADDRESS = 'akamekill253@gmail.com'  # Replace with your actual email address
EMAIL_PASSWORD = 'akdr mleh qyfm qpcp'  # Replace with your generated app password

# MySQL database connection details
db_config = {
    'host': 'localhost',
    'database': 'DHT22',
    'user': 'admin',  # Replace with your MySQL username
    'password': 'password'  # Replace with your MySQL password
}

# Ensure the output directory exists
output_directory = "/var/www/html/python/image"
os.makedirs(output_directory, exist_ok=True)

def connect_to_db():
    """Connect to the MySQL database."""
    try:
        connection = mysql.connector.connect(**db_config)
        if connection.is_connected():
            print("Successfully connected to the database")
            return connection
    except Error as e:
        print(f"Error while connecting to MySQL: {e}")
    return None

def insert_motion_data(movement):
    """Insert motion detection data into the database."""
    connection = connect_to_db()
    if connection is None:
        return

    try:
        cursor = connection.cursor()
        query = "INSERT INTO pir_motion (movement) VALUES (%s)"
        cursor.execute(query, (movement,))
        connection.commit()
        print("Motion data inserted successfully")
    except Error as e:
        print(f"Error while inserting motion data: {e}")
    finally:
        if connection and connection.is_connected():
            cursor.close()
            connection.close()

def send_email_alert():
    """Send an email alert."""
    subject = "Motion Detected!"
    body = "Alert: Motion has been detected by the PIR sensor."
    
    msg = MIMEText(body)
    msg['Subject'] = subject
    msg['From'] = EMAIL_ADDRESS
    msg['To'] = EMAIL_ADDRESS  # Send to your own email

    try:
        with smtplib.SMTP('smtp.gmail.com', 587) as server:
            server.starttls()
            server.login(EMAIL_ADDRESS, EMAIL_PASSWORD)
            server.send_message(msg)
            print("Email alert sent!")
    except Exception as e:
        print(f"Failed to send email: {e}")

# Start the video feed
cap = cv2.VideoCapture(0)

if not cap.isOpened():
    print("Error: Could not open video.")
    GPIO.cleanup()
    exit()

try:
    print("PIR Module Test (CTRL+C to exit)")
    time.sleep(2)

    while True:
        ret, frame = cap.read()
        if not ret:
            print("Error: Could not read frame.")
            break

        cv2.imshow("Video Feed", frame)

        pir_value = GPIO.input(PIR_PIN)
        print(f"PIR Sensor Value: {pir_value}")

        if pir_value:
            print("Motion Detected!")
            insert_motion_data(1.0)  # Log motion detection as 1.0
            send_email_alert()  # Send email alert
            GPIO.output(BUZZER_PIN, GPIO.HIGH)
            time.sleep(1)
            GPIO.output(BUZZER_PIN, GPIO.LOW)

            # Capture a screenshot from the video feed and save it
            image_path = f"{output_directory}/motion_capture.jpg"
            cv2.imwrite(image_path, frame)
            print(f"Image captured: {image_path}")

            # Increase the delay to prevent rapid triggering
            time.sleep(10)  # Delay for 10 seconds before the next detection
        else:
            insert_motion_data(0.0)  # Log no motion detection as 0.0

        if cv2.waitKey(1) & 0xFF == ord('q'):
            break

except KeyboardInterrupt:
    print("Exiting...")

finally:
    cap.release()
    cv2.destroyAllWindows()
    GPIO.cleanup()
