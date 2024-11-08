from flask import Flask, request, jsonify, send_from_directory
from gtts import gTTS
import os
from flask_cors import CORS

# Initialize the Flask app
app = Flask(__name__)

# Enable CORS for the app
CORS(app)

# Define the path where the MP3 files will be saved
MP3_FOLDER = '/var/www/html/python/app_tts/'

# Ensure the directory exists
if not os.path.exists(MP3_FOLDER):
    os.makedirs(MP3_FOLDER)

@app.route('/', methods=['POST'])
def synthesize():
    # Get the 'text' from the JSON payload in the request
    text = request.json.get('text')
    if not text:
        return jsonify({'error': 'No text provided'}), 400

    # Generate the speech using gTTS
    tts = gTTS(text=text, lang='en', slow=False)
    mp3_file_path = os.path.join(MP3_FOLDER, 'speech.mp3')

    # Save the MP3 file
    tts.save(mp3_file_path)

    # Serve the MP3 file
    return send_from_directory(MP3_FOLDER, 'speech.mp3', as_attachment=True)

# Run the Flask app
if __name__ == '__main__':
    # Allow connections from any IP (0.0.0.0)
    app.run(host='0.0.0.0', port=5000)
