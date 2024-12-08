import { BigBuysRow, DexPaidRow, LiveStreamRow, TableManager } from './components/tableManager';
import { initializeCopyButtons } from './components/copyToClipboard';
import { toggleSound, updateIcon, checkAndPlaySoundForTable } from './components/sound';


document.addEventListener('DOMContentLoaded', function () {

	const tableManagerBigBuys = new TableManager('BigBuys', wcl_obj.template_url, BigBuysRow);
	const tableManagerDexPaid = new TableManager('DexPaid', wcl_obj.template_url, DexPaidRow);
	const tableManagerLiveStream = new TableManager('LiveStream', wcl_obj.template_url, LiveStreamRow);





	/* 
	socket
	*/
	// true
	// false
	if (false) {
		createWebSocketWithProxy();
	} else {
		/* 
		Emulate Socket
		*/
		if (document.querySelector('.home') || document.querySelector('.page-template-dex-paid-page')) {
			createProcessor(0, 1000);
		}
	}






	/* 
	createWebSocketWithProxy
	*/
	function createWebSocketWithProxy() {
		const socket = new WebSocket('wss://site55.online:8080');

		socket.onopen = function () {
			console.log('WebSocket connection opened with proxy');
		};

		socket.onmessage = function (event) {
			console.log('Received message:', event.data);

			// Check if the data is a Blob
			if (event.data instanceof Blob) {
				const reader = new FileReader();

				reader.onload = () => {
					try {
						// Parse the result as JSON once the Blob is converted to text
						const jsonData = JSON.parse(reader.result);

						// Логирование полученного JSON
						console.log('Message from server (parsed):', jsonData);

						// Generate row
						addRowAndPlaySound(jsonData)

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

		socket.onerror = function (error) {
			console.error('WebSocket error:', error);
		};

		socket.onclose = function () {
			console.log('WebSocket connection closed');
		};
	}








	/* 
	sct-1-featured-fields mod-big-buys
	 */
	if (document.querySelector('.sct-1-featured-fields.mod-big-buys')) {
		let section = document.querySelector('.sct-1-featured-fields.mod-big-buys')

		section.querySelectorAll('.data-b1-icon').forEach(element => {
			element.addEventListener('click', function (e) {
				tableManagerBigBuys.togglePause();

				section.querySelectorAll('.data-b1-icon').forEach(icon => {
					if (icon.classList.contains('mod-pause')) {
						icon.querySelector('img').src = `${wcl_obj.template_url}/img/play.svg`;
						icon.classList.add('mod-play');
						icon.classList.remove('mod-pause');

					} else {
						icon.querySelector('img').src = `${wcl_obj.template_url}/img/pause.svg`;
						icon.classList.remove('mod-play');
						icon.classList.add('mod-pause');
					}
				});
			})
		});
	}






	/* 
	Sound for fields
	 */
	document.querySelectorAll('.dex_paid .data-b1-icon').forEach(icon => {
		icon.addEventListener('click', () => toggleSound('dex_paid'));
	});

	document.querySelectorAll('.live_stream .data-b1-icon').forEach(icon => {
		icon.addEventListener('click', () => toggleSound('live_stream'));
	});

	document.querySelectorAll('.big_buys .data-b1-icon').forEach(icon => {
		icon.addEventListener('click', () => toggleSound('big_buys'));
	});

	updateIcon('dex_paid');
	updateIcon('live_stream');
	updateIcon('big_buys');






	/* 
	initializeCopyButtons
	*/
	initializeCopyButtons();





	/* 
	addRowAndPlaySound
	*/
	function addRowAndPlaySound(obj) {
		if (obj.token_type === 'big_buys') {
			tableManagerBigBuys.addRow(obj.token);
			checkAndPlaySoundForTable('big_buys');
		} else if (obj.token_type === 'dex_paid') {
			tableManagerDexPaid.addRow(obj.token);
			checkAndPlaySoundForTable('dex_paid');
		} else if (obj.token_type === 'live_stream') {
			tableManagerLiveStream.addRow(obj.token);
			checkAndPlaySoundForTable('live_stream');
		}
	}





	/* 
	createProcessor
	*/
	function createProcessor(initialIndex, intervalTime) {
		let index = initialIndex;

		function processNextObject() {
			//const savedData = localStorage.getItem('savedObjects');
			const savedData = wcl_obj.tokenFields;

			if (savedData) {
				// const objectArray = JSON.parse(savedData);
				const objectArray = savedData;

				if (index < objectArray.length) {
					const obj = objectArray[index];

					addRowAndPlaySound(obj);

					index++;

					if (index >= objectArray.length) {
						index = 0;
					}
				} else {
					// console.log('Нет объектов для обработки.');
				}
			} else {
				// console.log('Нет данных в localStorage.');
			}
		}

		setInterval(processNextObject, intervalTime);
	}







	/* 
	sct-1-featured-fields mod-upcoming-fields
	*/
	if (document.querySelector('.sct-1-featured-fields.mod-upcoming-fields')) {
		let section = document.querySelector('.sct-1-featured-fields.mod-upcoming-fields.mod-desktop');
	
		const dateString = serverTimeUTC;
	
		// Split the date and time components
		const [datePart, timePart] = dateString.split(' ');
		const [year, month, day] = datePart.split('-').map(Number);
		const [hours, minutes, seconds] = timePart.split(':').map(Number);
	
		const dateObject = new Date(year, month - 1, day, hours, minutes, seconds); // month is 0-based
	
		const incrementDateByOneSecond = () => {
			dateObject.setSeconds(dateObject.getSeconds() + 1); // Add one second to the current time
		};
	
		const intervalId = setInterval(incrementDateByOneSecond, 1000); // Update the dateObject every second
	
		// Функция для обновления таймера
		function updateCountdown(item) {
			// Получаем дату запуска из атрибута data-launch
			const launchDate = new Date(item.getAttribute('data-launch')).getTime(); // время запуска события в миллисекундах
			const daysElem = item.querySelector('.days');
			const hoursElem = item.querySelector('.hours');
			const minutesElem = item.querySelector('.minutes');

			console.log(launchDate)
	
			// Обновление таймера каждую секунду
			const countdownInterval = setInterval(function () {
				// Текущее время
				const now = dateObject.getTime(); // берем текущее время из dateObject, который обновляется каждую секунду
				const distance = launchDate - now; // разница между временем запуска и текущим временем
	
				if (distance > 0) {
					// Рассчитываем оставшиеся дни, часы и минуты
					const days = Math.floor(distance / (1000 * 60 * 60 * 24));
					const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
					const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	
					// Обновляем DOM элементы
					daysElem.textContent = days;
					hoursElem.textContent = hours;
					minutesElem.textContent = minutes;
				} else {
					// Если время истекло, остановить таймер
					clearInterval(countdownInterval);
					daysElem.textContent = 0;
					hoursElem.textContent = 0;
					minutesElem.textContent = 0;
				}
			}, 1000); // Обновляем каждую секунду
		}
	
		// Находим все элементы с классом 'data-b2-item' и запускаем таймер для каждого
		let countdownItems = section.querySelectorAll('.data-b2-item');
	
		// Если экран меньше 1025px, выбираем элементы для мобильной версии
		if (window.matchMedia("(max-width: 1025px)").matches) {
			countdownItems = document.querySelector('.sct-1-featured-fields.mod-upcoming-fields.mod-mobile').querySelectorAll('.data-b2-item');
		}
	
		// Запускаем функцию для каждого элемента таймера
		countdownItems.forEach(item => updateCountdown(item));
	}
	
});
