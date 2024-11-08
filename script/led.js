function updateBulbStatus(commandStatus) {
    const redBulb = document.getElementById('redBulb');
    const blueBulb = document.getElementById('blueBulb');
    const greenBulb = document.getElementById('greenBulb');

    // Reset bulb colors and statuses
    redBulb.style.color = 'gray';
    blueBulb.style.color = 'gray';
    greenBulb.style.color = 'gray';
    document.getElementById('redStatus').innerText = 'OFF';
    document.getElementById('blueStatus').innerText = 'OFF';
    document.getElementById('greenStatus').innerText = 'OFF';

    // Flag to check if the command is valid
    let validCommand = true;

    // Trim and lowercase command status
    const trimmedCommand = commandStatus.toLowerCase().trim();

    // Handle command statuses
    switch (trimmedCommand) {
        case 'red led on':
            redBulb.style.color = 'red';
            document.getElementById('redStatus').innerText = 'ON';
            break;
        case 'red off':
            redBulb.style.color = 'gray';
            document.getElementById('redStatus').innerText = 'OFF';
            break;
        case 'blue led on':
            blueBulb.style.color = 'blue';
            document.getElementById('blueStatus').innerText = 'ON';
            break;
        case 'blue off':
            blueBulb.style.color = 'gray';
            document.getElementById('blueStatus').innerText = 'OFF';
            break;
        case 'green led on':
            greenBulb.style.color = 'green';
            document.getElementById('greenStatus').innerText = 'ON';
            break;
        case 'green off':
            greenBulb.style.color = 'gray';
            document.getElementById('greenStatus').innerText = 'OFF';
            break;
        case 'all on':
            redBulb.style.color = 'red';
            blueBulb.style.color = 'blue';
            greenBulb.style.color = 'green';
            document.getElementById('redStatus').innerText = 'ON';
            document.getElementById('blueStatus').innerText = 'ON';
            document.getElementById('greenStatus').innerText = 'ON';
            break;
        case 'all off':
            redBulb.style.color = 'gray';
            blueBulb.style.color = 'gray';
            greenBulb.style.color = 'gray';
            document.getElementById('redStatus').innerText = 'OFF';
            document.getElementById('blueStatus').innerText = 'OFF';
            document.getElementById('greenStatus').innerText = 'OFF';
            break;
            stopBlinking(redBulb);
            stopBlinking(blueBulb);
            stopBlinking(greenBulb);
            break;
        case 'red blink on':
            redBulb.style.color = 'red';
            document.getElementById('redStatus').innerText = 'BLINKING';
            startBlinking(redBulb);
            break;
        case 'red blink off':
            stopBlinking(redBulb);
            break;
        case 'blue blink on':
            blueBulb.style.color = 'blue';
            document.getElementById('blueStatus').innerText = 'BLINKING';
            startBlinking(blueBulb);
            break;
        case 'blue blink off':
            stopBlinking(blueBulb);
            break;
        case 'green blink on':
            greenBulb.style.color = 'green';
            document.getElementById('greenStatus').innerText = 'BLINKING';
            startBlinking(greenBulb);
            break;
        case 'green blink off':
            stopBlinking(greenBulb);
            break;
        case 'all blink on':
            startBlinking(redBulb);
            startBlinking(blueBulb);
            startBlinking(greenBulb);
            break;
        case 'all blink off':
            stopBlinking(redBulb);
            stopBlinking(blueBulb);
            stopBlinking(greenBulb);
            break;
        default:
            validCommand = false; // Mark command as invalid
            console.error('Invalid command received:', commandStatus); // Log invalid command
            break;
    }

    // Show alert if the command is invalid
    if (!validCommand) {
        alert("This is not a right command");
    }
}

let blinkInterval;

function startBlinking(bulb) {
    bulb.blinking = true; // Flag to indicate that the bulb is blinking
    bulb.dataset.originalColor = bulb.style.color; // Store the original color
    blinkInterval = setInterval(() => {
        bulb.style.color = bulb.style.color === 'gray' ? bulb.dataset.originalColor : 'gray'; // Toggle color
    }, 500);
}

function stopBlinking(bulb) {
    bulb.blinking = false; // Clear the blinking flag
    clearInterval(blinkInterval); // Stop blinking
    bulb.style.color = bulb.dataset.originalColor; // Reset to original color
}

function fetchCommandStatus() {
    fetch('/includes/get_act7.php')
        .then(response => response.json())
        .then(data => {
            const commandStatus = data.command_status;
            document.getElementById('commandStatus').innerText = commandStatus;
            updateBulbStatus(commandStatus); // Update bulb statuses based on command
        })
        .catch(error => console.error('Error fetching command status:', error));
}

// Fetch command status every 5 seconds
setInterval(fetchCommandStatus, 5000);

// Initial command status fetch
fetchCommandStatus();