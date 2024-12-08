const socket = new WebSocket('ws://195.35.56.191:8080');

socket.onopen = () => console.log('Connected to WebSocket server');

socket.onmessage = (event) => {
    // Check if the data is a Blob
    if (event.data instanceof Blob) {
        const reader = new FileReader();

        reader.onload = () => {
            try {
                // Parse the result as JSON once the Blob is converted to text
                const jsonData = JSON.parse(reader.result);


                // Логирование полученного JSON
                console.log('Message from server (parsed):', jsonData);

                // Получаем сохраненные данные из localStorage
                let existingData = localStorage.getItem('savedObjects');

                // Если данные существуют, преобразуем их обратно в массив
                let objectArray = existingData ? JSON.parse(existingData) : [];

                // Добавляем новый объект (полный) в массив
                objectArray.push(jsonData);

                // Ограничиваем массив до 30 объектов
                if (objectArray.length > 30) {
                    objectArray.shift(); // Удаляем первый элемент, если превышено 30 объектов
                }

                // Сохраняем обновленный массив обратно в localStorage
                localStorage.setItem('savedObjects', JSON.stringify(objectArray));


                // Log the parsed JSON object
                console.log('Message from server (parsed):', jsonData);

                // Access specific fields from the JSON
                const mint = jsonData.mint;
                const name = jsonData.name;
                const symbol = jsonData.symbol;

                // Append the new data to the existing content
                const existingContent = document.getElementById('real-time-data').innerHTML;
                document.getElementById('real-time-data').innerHTML = `${existingContent} <br> Mint: ${mint}, Name: ${name}, Symbol: ${symbol}`;
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
