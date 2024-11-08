function fetchData() {
    fetch('/includes/get_history.php') // Update with your PHP script path for act6
        .then(response => response.text()) // Fetch as text for debugging
        .then(data => {
            console.log('Raw Data:', data);  // Log the raw response

            try {
                const jsonData = JSON.parse(data); // Try parsing it
                console.log('Parsed Data:', jsonData); // Log the parsed data

                // Check if data is an array and has elements before updating the table
                if (Array.isArray(jsonData) && jsonData.length > 0) {
                    const tbody = document.getElementById('sensorDataBody');
                    tbody.innerHTML = ''; // Clear existing rows
                    
                    // Populate the table with each row of data
                    jsonData.forEach((item, index) => {
                        const row = `<tr>
                                        <td class="border border-gray-300 p-2">${index + 1}</td>
                                        <td class="border border-gray-300 p-2">${item.latitude}</td>
                                        <td class="border border-gray-300 p-2">${item.longitude}</td>
                                        <td class="border border-gray-300 p-2">${item.date}</td>
                                     </tr>`;
                        tbody.innerHTML += row;
                    });
                } else {
                    console.error("No valid data received from server");
                }
            } catch (error) {
                console.error('Error parsing JSON:', error);
            }
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Fetch data every 5 seconds
setInterval(fetchData, 1000);
x
// Initial data fetch
fetchData();
