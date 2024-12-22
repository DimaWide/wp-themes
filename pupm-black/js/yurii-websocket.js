/*
const socket = new WebSocket('ws://195.35.56.191:8080');

socket.onopen = () => console.log('Connected to WebSocket server');

socket.onmessage = (event) => {
    console.log('message');
    // Check if the data is a Blob
    if (event.data instanceof Blob) {
        const reader = new FileReader();

        reader.onload = () => {
            try {
                
                // Parse the result as JSON once the Blob is converted to text
                const jsonData = JSON.parse(reader.result);

                // Log the parsed JSON object
                // console.log('yurii test');
                console.log('Message from server (parsed):', jsonData);

                // Access specific fields from the JSON
                const mint = jsonData.mint;
                const name = jsonData.name;
                const symbol = jsonData.symbol;

                // Append the new data to the existing content
                // const existingContent = document.getElementById('real-time-data').innerHTML;
                // document.getElementById('real-time-data').innerHTML = `${existingContent} <br> Mint: ${mint}, Name: ${name}, Symbol: ${symbol}`;

            } catch (error) {
                console.error('Error parsing message as JSON:', error);
            }
        };

        // Read the Blob as text
        reader.readAsText(event.data);
    } else {
        console.log('Received non-Blob message:', event.data);
    }
};

socket.onerror = (error) => console.error('WebSocket Error:', error);

socket.onclose = () => console.log('Disconnected from WebSocket server');
*/


// Use 'wss://' for secure WebSocket connection
const socket = new WebSocket('wss://site55.online:8080');

socket.onopen = () => {
    // console.log('Connected to Secure WebSocket server');
}

socket.onmessage = (event) => {
   // console.log('Message arrived');
    
    // Check if the data is a Blob
    if (event.data instanceof Blob) {
        const reader = new FileReader();

        reader.onload = () => {
            try {
                // Parse the result as JSON once the Blob is converted to text
                const jsonData = JSON.parse(reader.result);

                // Log the parsed JSON object
                //console.log('Message from server (parsed):', jsonData);

                // Access specific fields from the JSON
                const mint = jsonData.mint;
                const name = jsonData.name;
                const symbol = jsonData.symbol;

                // Optionally, append the new data to the existing content
                // const existingContent = document.getElementById('real-time-data').innerHTML;
                // document.getElementById('real-time-data').innerHTML = `${existingContent} <br> Mint: ${mint}, Name: ${name}, Symbol: ${symbol}`;

            } catch (error) {
                console.error('Error parsing message as JSON:', error);
            }
        };

        // Read the Blob as text
        reader.readAsText(event.data);
    } else {
        //console.log('Received non-Blob message:', event.data);
    }
};

socket.onerror = (error) => console.error('WebSocket Error:', error);

socket.onclose = () => {
   //console.log('Disconnected from WebSocket server');
}
 
