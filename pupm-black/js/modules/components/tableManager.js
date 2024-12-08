


/* 
TableRowBase
 */
class TableRowBase {
	constructor(data, templateUrl, tableType = 'default') {
		this.data = {
			name: data.name || 'N/A',
			mint: data.mint || 'N/A',
			usd_market_cap: data.usd_market_cap || 'N/A',
			symbol: data.symbol || 'N/A',
			sol_amount: data.sol_amount || 'N/A',
			image_uri: data.image_uri || 'N/A',
			tabletka: data.tabletka || '',
			twitter: data.twitter || '',
			telegram: data.telegram || '',
			website: data.website || '',
			market_cap: data.market_cap || 'N/A',
			holders_count: data.holders_count || 'N/A',
			reply_count: data.reply_count || 'N/A',
			created_timestamp: data.created_timestamp || 'N/A',
			buy_link_1: data.buy_link_1 || '',
			buy_link_2: data.buy_link_2 || '',
			buy_link_3: data.buy_link_3 || '',
			buy_link_4: data.buy_link_4 || '',
			market_cap_usd: data.market_cap_usd || 'N/A',
		};
		this.templateUrl = templateUrl,
			this.tableType = tableType;
	}

	formatValue(value) {
		return value !== 'N/A' ? value : 'N/A';
	}

	// formatUsdMarketCap() {
	// 	const usdMarketCap = parseFloat(this.data.usd_market_cap);
	// 	return !isNaN(usdMarketCap) ? `${Math.round(usdMarketCap)}k` : '';
	// }

	getMarketCapHtmlBigBuys() {
		const marketCap = parseFloat(this.data.usd_market_cap);

		if (!isNaN(marketCap)) {
			// Round the market cap to 2 decimal places
			const roundedNumber = marketCap.toFixed(0);

			// Format the number with commas
			const formattedNumber = parseFloat(roundedNumber).toLocaleString('en-US', { minimumFractionDigits: 0 }).replace(/,/g, ' ');

			// Build the HTML string
			const string = `$${formattedNumber}`;

			// Return the HTML
			return `
					${string}
			`;
		}

		return '';
	}

	formatSolAmount(withSign = false) {
		const solAmount = parseFloat(this.data.sol_amount);
		if (!isNaN(solAmount)) {
			// Divide by 1,000,000,000
			const formattedAmount = (solAmount / 1000000000).toFixed(2);
			return `${withSign ? '+' : ''}${formattedAmount}k`;
		}
		return '';
	}

	formatMint() {
		return this.data.mint.length > 8 ? `${this.data.mint.slice(0, 4)}...${this.data.mint.slice(-4)}` : this.data.mint;
	}

	getTabletkaLink() {
		const mint = this.data.mint;

		if (mint) {
			const link = `https://pump.fun/${mint}`;
			return link;
		}

		return '';
	}

	createSocialLinks() {
		const socialLinks = [
			{
				link: this.getTabletkaLink(),
				image: 'social-tabletka.png',
				key: 'tabletka'
			},
			{
				link: this.data.twitter,
				image: 'social-twitter.png',
				key: 'twitter'
			},
			{
				link: this.data.telegram,
				image: 'social-telegram.png',
				key: 'telegram'
			},
			{
				link: this.data.website,
				image: 'social-website.png',
				key: 'website'
			},
		];

		return socialLinks.map(({ link, image, key }) => {
			const state = link ? 'mod-enabled' : 'mod-disabled';

			return `
				<div class="data-b2-item-social-item mod-${key} ${state}">
					<a href="${link ? link : '#'}" target="_blank" rel="noopener noreferrer">
						<img src="${this.templateUrl}/img/${image}" alt="${key}">
					</a>
				</div>
			`;
		}).join('');
	}

	formatSolAmountBigBuys() {
		const solPrice = parseFloat(wcl_obj.current_sol_price); // Получаем цену SOL из локализованного объекта
		const solAmount = parseFloat(this.data.sol_amount); // Преобразуем solAmount в число
	
		if (!isNaN(solAmount) && !isNaN(solPrice)) {
			const usdValue = (solAmount / 1000000000) * solPrice; // Вычисляем значение в долларах
			const valueDividedByThousand = usdValue;
	
			// Округляем значение до целого числа
			const roundedValue = Math.round(valueDividedByThousand);
			
			// Форматируем значение с запятыми (если необходимо)
			const formattedWithCommas = new Intl.NumberFormat('en-US').format(roundedValue);
			
			// Возвращаем отформатированное значение с суффиксом 'k', если значение больше 0
			return `${formattedWithCommas}k`;
		}
		return null; // Возвращаем null, если есть ошибка
	}
	
	formatMarketCap() {
		let marketCap = parseFloat(this.data.usd_market_cap);
		if (this.tableType == 'DexPaid') {
			marketCap = parseFloat(this.data.market_cap_usd);
		}

		if (!isNaN(marketCap)) {
			return `$${marketCap.toFixed(0).replace(/\d(?=(?:\d{3})+(?!\d))/g, '$&,').replace(/,/g, ' ')}` + 'k';
		}
		return '';
	}

	formatHoldersCount() {
		return this.formatValue(this.data.holders_count);
	}

	formatReplyCount() {
		return this.formatValue(this.data.reply_count);
	}

	formatCreatedTimestamp() {
		const timestampInMs = this.data.created_timestamp; // Предполагается, что метка времени в миллисекундах
		const timestampInSeconds = timestampInMs / 1000; // Преобразуем в секунды

		const currentTimeInSeconds = Math.floor(Date.now() / 1000); // Текущее время в секундах
		const differenceInSeconds = currentTimeInSeconds - timestampInSeconds; // Разница во времени

		// Если разница меньше 60 секунд, возвращаем "<1 min ago"
		if (differenceInSeconds < 60) {
			return "<1 min ago";
		}

		const hours = Math.floor(differenceInSeconds / 3600); // Вычисляем часы
		const minutes = Math.floor((differenceInSeconds % 3600) / 60); // Вычисляем минуты

		// Форматируем результат
		let formatted = '';
		if (hours > 0) {
			formatted += `${hours} h `;
		}
		if (minutes > 0) {
			formatted += `${minutes} min `;
		}

		return formatted.trim() + ' ago';
	}



	// Method to generate HTML for buy links
	createBuyLinks() {
		const buyLinksData = [
			{ link: 'https://bullx.io/terminal?chainId=1399811149&address=' + this.data.mint + '&r=K0AUT6R77CH', image: 'buy-links-1.png' },
			{ link: 'https://t.me/paris_trojanbot?start=r-coinshill_up-' + this.data.mint, image: 'buy-links-2.png' },
			{ link: 'https://photon-sol.tinyastro.io/en/r/@pumpblack/' + this.data.mint, image: 'buy-links-3.png' },
			{ link: 'https://gmgn.ai/sol/token/SHQbIEUlt_' + this.data.mint, image: 'buy-links-4.png' }
		];

		return buyLinksData.map(item => {
			const state = item.link ? 'mod-enabled' : 'mod-disabled';
			return `
				<div class="data-b2-item-buy-links-item ${state}">
					<a href="${item.link}" target="_blank">
						<img src="${this.templateUrl}/img/${item.image}" alt="img">
					</a>
				</div>
			`;
		}).join('');
	}
}

class BigBuysRow extends TableRowBase {
	createMobileView() {
		return `
		<div class="data-b3-row">
			<div class="data-b3-col">
				<div class="data-b2-item-image">
					${this.data.image_uri !== 'N/A' ? `<img src="${this.data.image_uri}" alt="img">` : 'No image available'}
				</div>
			</div>
			<div class="data-b3-col">
				<div class="data-b2-item-name">
					${this.formatValue(this.data.name)}
				</div>
				<div class="data-b2-item-sol mod-flex-center">
					<img src="${this.templateUrl}/img/solana-sol-logo.svg" alt="img">
					${this.formatSolAmount()}
				</div>
				<div class="data-b2-item-marketcap">
					${this.getMarketCapHtmlBigBuys()}
				</div>
			</div>
			<div class="data-b3-col">
				<div class="data-b2-item-holders mod-flex-center">
					<img src="${this.templateUrl}/img/profile.svg" alt="img">
					${this.formatHoldersCount()}
				</div>
				<div class="data-b2-item-launch mod-flex-center">
					<img src="${this.templateUrl}/img/chat.svg" alt="img">
					${this.formatReplyCount()}
				</div>
				<div class="data-b2-item-launch">
					${this.formatCreatedTimestamp()}
				</div>
			</div>
		</div>
		<div class="data-b3-row">
			<div class="data-b3-col">
				<div class="data-b2-item-social">
					${this.createSocialLinks()}
				</div>
			</div>
			<div class="data-b3-col">
				<div class="data-b2-item-buy-links">
					${this.createBuyLinks()}
				</div>
			</div>
		</div>
		`;
	}

	createDesktopView() {
		return `
			<td><div class="data-b2-item-image">${this.data.image_uri !== 'N/A' ? `<img src="${this.data.image_uri}" alt="img">` : 'No image available'}</div></td>
			<td><div class="data-b2-item-name">${this.formatValue(this.data.name)}</div></td>
			<td><div class="data-b2-item-name">${this.formatValue(this.data.symbol)}</div></td>
			<td><div class="data-b2-item-usd mod-flex-center"><img src="${this.templateUrl}/img/dollar-money-sign.svg" alt="img">${this.formatSolAmountBigBuys()}</div></td>
			<td><div class="data-b2-item-sol mod-flex-center"><img src="${this.templateUrl}/img/solana-sol-logo.svg" alt="img">${this.formatSolAmount()}</div></td>
			<td>
				<div class="data-b2-item-ca">
					<div class="data-b2-item-ca-field" data-mint="${this.data.mint}">${this.formatMint()}</div>
					<div class="data-b2-item-ca-btn">
						<img src="${this.templateUrl}/img/copy.svg" alt="img">
						<div class="data-b2-item-ca-copy-notify">Copied</div>
					</div>
				</div>
			</td>
			<td><div class="data-b2-item-social">${this.createSocialLinks()}</div></td>
			<td><div class="data-b2-item-marketcap">${this.getMarketCapHtmlBigBuys()}</div></td>
			<td><div class="data-b2-item-holders mod-flex-center"><img src="${this.templateUrl}/img/profile.svg" alt="img">${this.formatHoldersCount()}</div></td>
			<td><div class="data-b2-item-launch mod-flex-center"><img src="${this.templateUrl}/img/chat.svg" alt="img">${this.formatReplyCount()}</div></td>
			<td><div class="data-b2-item-launch">${this.formatCreatedTimestamp()}</div></td>
			<td>
			  <div class="data-b2-item-buy-links">
				${this.createBuyLinks()}
			</div>
		</td>
		`;
	}
}

class DexPaidRow extends TableRowBase {
	createMobileView() {
		return `
		<div class="data-b3-row">
			<div class="data-b3-col">
				<div class="data-b2-item-image">
					${this.data.image_uri !== 'N/A' ? `<img src="${this.data.image_uri}" alt="img">` : 'No image available'}
				</div>
			</div>
			<div class="data-b3-col">
				<div class="data-b2-item-name">
					${this.formatValue(this.data.name)}
				</div>
				
				<div class="data-b2-item-name">${this.formatValue(this.data.symbol)}</div>

				<div class="data-b2-item-marketcap">
					${this.formatMarketCap()}
				</div>
			</div>
			
			<div class="data-b3-col">
				 <div class="data-b2-item-ca">
					<div class="data-b2-item-ca-field" data-mint="${this.data.mint}">${this.formatMint()}</div>
					<div class="data-b2-item-ca-btn">
						<img src="${this.templateUrl}/img/copy.svg" alt="img">
						<div class="data-b2-item-ca-copy-notify">Copied</div>
					</div>
				</div>
			</div>
		</div>
		<div class="data-b3-row">
			<div class="data-b3-col">
				<div class="data-b2-item-social">
					${this.createSocialLinks()}
				</div>
			</div>
			<div class="data-b3-col">
				<div class="data-b2-item-buy-links">
					${this.createBuyLinks()}
				</div>
			</div>
		</div>
		`;
	}

	createDesktopView() {
		return `
			<td><div class="data-b2-item-image">${this.data.image_uri !== 'N/A' ? `<img src="${this.data.image_uri}" alt="img">` : 'No image available'}</div></td>
			<td><div class="data-b2-item-name">${this.formatValue(this.data.name)}</div></td>
			<td><div class="data-b2-item-name">${this.formatValue(this.data.symbol)}</div></td>
			<td>
				<div class="data-b2-item-ca">
					<div class="data-b2-item-ca-field" data-mint="${this.data.mint}">${this.formatMint()}</div>
					<div class="data-b2-item-ca-btn">
						<img src="${this.templateUrl}/img/copy.svg" alt="img">
						<div class="data-b2-item-ca-copy-notify">Copied</div>
					</div>
				</div>
			</td>
			<td><div class="data-b2-item-social">${this.createSocialLinks()}</div></td>
			<td><div class="data-b2-item-marketcap">${this.formatMarketCap()}</div></td>
			<td>
			  <div class="data-b2-item-buy-links">
				${this.createBuyLinks()}
			</div>
			</td>
		`;
	}
}

class LiveStreamRow extends TableRowBase {
	createMobileView() {
		if (parseFloat(this.data.market_cap) < 6000) {
			return '';
		}

		return `
		<div class="data-b3-row">
			<div class="data-b3-col">
				<div class="data-b2-item-image">
					${this.data.image_uri !== 'N/A' ? `<img src="${this.data.image_uri}" alt="img">` : 'No image available'}
				</div>
			</div>
			<div class="data-b3-col">
				<div class="data-b2-item-name">
					${this.formatValue(this.data.name)}
				</div>
				
				<div class="data-b2-item-name">${this.formatValue(this.data.symbol)}</div>

				<div class="data-b2-item-marketcap">
					${this.formatMarketCap()}
				</div>
			</div>
			
			<div class="data-b3-col">
				 <div class="data-b2-item-ca">
					<div class="data-b2-item-ca-field" data-mint="${this.data.mint}">${this.formatMint()}</div>
					<div class="data-b2-item-ca-btn">
						<img src="${this.templateUrl}/img/copy.svg" alt="img">
						<div class="data-b2-item-ca-copy-notify">Copied</div>
					</div>
				</div>
			</div>
		</div>
		<div class="data-b3-row">
			<div class="data-b3-col">
				<div class="data-b2-item-social">
					${this.createSocialLinks()}
				</div>
			</div>
			<div class="data-b3-col">
				<div class="data-b2-item-buy-links">
					${this.createBuyLinks()}
				</div>
			</div>
		</div>
		`;
	}

	createDesktopView() {
		if (parseFloat(this.data.market_cap) < 6000) {
			return '';
		}

		return `
			<td><div class="data-b2-item-image">${this.data.image_uri !== 'N/A' ? `<img src="${this.data.image_uri}" alt="img">` : 'No image available'}</div></td>
			<td><div class="data-b2-item-name">${this.formatValue(this.data.name)}</div></td>
			<td><div class="data-b2-item-name">${this.formatValue(this.data.symbol)}</div></td>
			<td>
				<div class="data-b2-item-ca">
					<div class="data-b2-item-ca-field" data-mint="${this.data.mint}">${this.formatMint()}</div>
					<div class="data-b2-item-ca-btn">
						<img src="${this.templateUrl}/img/copy.svg" alt="img">
						<div class="data-b2-item-ca-copy-notify">Copied</div>
					</div>
				</div>
			</td>
			<td><div class="data-b2-item-social">${this.createSocialLinks()}</div></td>
			<td><div class="data-b2-item-marketcap">${this.formatMarketCap()}</div></td>
			<td>
			  <div class="data-b2-item-buy-links">
				${this.createBuyLinks()}
			</div>
			</td>
		`;
	}
}

/* 
TableManager
 */
class TableManager {
	constructor(tableType, templateUrl, rowType) {
		this.tableType = tableType
		this.isMobile = this.checkIfMobile(); // Determine if the device is mobile
		this.tableSelector = this.getTableSelector(tableType); // Get correct table selector
		this.table = document.querySelector(this.tableSelector); // Set the table based on the selector
		this.templateUrl = templateUrl;
		this.maxRows = this.getMaxRows(tableType); // Set maxRows dynamically
		this.rowType = rowType; // Тип строки (например, BigBuysRow, DexPaidRow)

		this.isPaused = false; // Переменная для отслеживания паузы
		this.buffer = []; // Буфер для хранения данных во время паузы
		this.maxBufferSize = 10; // Максимальный размер буфера
	}

	// Method to check if the device is mobile
	checkIfMobile() {
		return window.innerWidth <= 1025; // Adjust the width as per your requirement
	}

	// Method to get the correct table selector based on table type and device type
	getTableSelector(tableType) {
		const selectors = {
			BigBuys: {
				desktop: '.sct-1-featured-fields.mod-big-buys .data-b2-table.mod-desktop-table tbody',
				mobile: '.sct-1-featured-fields.mod-big-buys .mod-mobile-table'
			},
			DexPaid: {
				desktop: '.sct-1-featured-fields.mod-dex-paid .data-b2-table.mod-desktop-table tbody',
				mobile: '.sct-1-featured-fields.mod-dex-paid .mod-mobile-table'
			},
			LiveStream: {
				desktop: '.sct-1-featured-fields.mod-new-livestream .data-b2-table.mod-desktop-table tbody',
				mobile: '.sct-1-featured-fields.mod-new-livestream .mod-mobile-table'
			}
		};

		//console.log(selectors)

		// Return the appropriate selector based on the device type
		return this.isMobile ? selectors[tableType].mobile : selectors[tableType].desktop;
	}

	// Method to get maxRows based on table type and device type
	getMaxRows(tableType) {
		const maxRowsConfig = wcl_obj.tablesMaxRows; // Используем переданные данные
console.log( this.isMobile ? maxRowsConfig[tableType].mobile : maxRowsConfig[tableType].desktop)
		// const maxRowsConfig = {
		// 	BigBuys: {
		// 		desktop: 10,
		// 		mobile: 7
		// 	},
		// 	DexPaid: {
		// 		desktop: 5,
		// 		mobile: 4
		// 	},
		// 	LiveStream: {
		// 		desktop: 4,
		// 		mobile: 4
		// 	}
		// };

		// Return maxRows based on the table type and device type
		return this.isMobile ? maxRowsConfig[tableType].mobile : maxRowsConfig[tableType].desktop;
	}


	// Метод для паузы и возобновления добавления строк
	togglePause() {
		this.isPaused = !this.isPaused;
		// console.log(this.isPaused )
		if (!this.isPaused && this.buffer.length > 0) {
			// Если пауза отключена и есть данные в буфере, добавляем их в таблицу
			this.buffer.forEach(token => this.addRow(token));
			this.buffer = []; // Очищаем буфер после добавления
		}
	}


	 loadImageWithTimeout(imageElement, placeholderSrc, timeout = 2000) {
		const originalSrc = imageElement.getAttribute('src');
		
		// Создаем новый объект изображения
		const img = new Image();
		
		// Таймер для отслеживания загрузки
		const timer = setTimeout(() => {
			// Если изображение не загрузилось за 2 секунды, заменяем его на плейсхолдер
			imageElement.setAttribute('src', placeholderSrc);
			img.src = ''; // Остановить загрузку
		}, timeout);
	
		// Попытка загрузить изображение
		img.onload = function() {
			clearTimeout(timer); // Если изображение загрузилось, отменяем таймер
			imageElement.setAttribute('src', originalSrc); // Устанавливаем оригинальное изображение
		};
	
		img.onerror = function() {
			clearTimeout(timer); // Если ошибка, заменяем на плейсхолдер
			imageElement.setAttribute('src', placeholderSrc);
		};
	
		// Начинаем загрузку
		img.src = originalSrc; 
	}
	


	addRow(data) {
		if (this.isPaused) {
			// Если пауза активна, добавляем данные в буфер
			if (this.buffer.length < this.maxBufferSize) {
				this.buffer.push(data);
			}
		} else {
			if (!this.table) {
				return
			}

			const rowGenerator = new this.rowType(data, this.templateUrl, this.tableType);
			let row = '';

			if (this.isMobile) {
				row = rowGenerator.createMobileView();
			} else {
				row = rowGenerator.createDesktopView();
			}

			if (!row) {
				return;
			}

			// Создание элемента строки и добавление класса
			let newRowElement = '';

			if (this.isMobile) {
				newRowElement = document.createElement('div');
				newRowElement.innerHTML = row;
				newRowElement.classList.add('data-b2-item', 'new-row');
			} else {
				newRowElement = document.createElement('tr');
				newRowElement.innerHTML = row;
				newRowElement.classList.add('data-b2-item', 'new-row');
			}

			// Теперь проверяем все изображения внутри newRowElement
			const images = newRowElement.querySelectorAll('.data-b2-item-image img');

			images.forEach(img => {
				fetch(img.src)
					.then(response => {
						if (response.ok) {
							img.parentElement.classList.add('loaded');
						} else {
							img.parentElement.classList.add('not-loaded');
							img.src = wcl_obj.template_url + '/img/image-placeholder.png';
						}
					})
					.catch(error => {
						img.parentElement.classList.add('not-loaded');
						img.src = wcl_obj.template_url + '/img/image-placeholder.png';
					});
			});

			const placeholder = wcl_obj.template_url + '/img/image-placeholder.png'; // Ссылка на плейсхолдер

			// Применяем функцию ко всем изображениям
			images.forEach(image => {
				this.loadImageWithTimeout(image, placeholder);
			});

			// Удаление последней строки, если достигли максимального количества строк
			if (this.isMobile) {
				if (this.table.children.length >= this.maxRows) {
					this.table.removeChild(this.table.lastElementChild);
				}
			} else {
				if (this.table.rows.length >= this.maxRows) {
					this.table.deleteRow(-1);
				}
			}

			this.table.insertBefore(newRowElement, this.table.firstChild);

			// Убираем класс анимации после окончания анимации
			setTimeout(() => {
				newRowElement.classList.remove('new-row');
			}, 1000); // Время анимации
		}
	}

	updateTable(dataArray) {
		this.table.innerHTML = '';
		dataArray.forEach(data => this.addRow(data));
	}
}


// Экспортируем классы для использования в других модулях
export { TableRowBase, BigBuysRow, DexPaidRow, LiveStreamRow, TableManager };