<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Text-to-Speech</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }

        textarea {
            width: 300px;
            height: 100px;
            margin-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        #message {
            margin-top: 20px;
            color: green;
        }
    </style>
</head>

<body>
    <h1>Text-to-Speech</h1>
    <textarea id="text" placeholder="Enter text to speak..."></textarea><br>
    <button onclick="speakText()">Speak</button>

    <div id="message"></div>

    <script>
        async function speakText() {
            const text = document.getElementById('text').value;
            const messageDiv = document.getElementById('message');

            if (!text) {
                messageDiv.style.color = 'red';
                messageDiv.textContent = 'Please enter some text!';
                return;
            }

            try {
                // Replace localhost with the IP address of the Raspberry Pi
                const response = await fetch('http://192.168.0.110:5000/', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ text: text })
                });

                if (response.ok) {
                    // Directly play the MP3 file
                    const audioUrl = await response.blob().then(blob => URL.createObjectURL(blob));
                    const audio = new Audio(audioUrl);
                    audio.play();
                    messageDiv.style.color = 'green';
                    messageDiv.textContent = 'Speaking...';
                } else {
                    throw new Error('Failed to generate speech');
                }
            } catch (error) {
                messageDiv.style.color = 'red';
                messageDiv.textContent = `Error: ${error.message}`;
            }
        }


    </script>
</body>

</html>