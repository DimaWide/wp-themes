



const ready = (callback) => {
	if (document.readyState != "loading") callback();
	else document.addEventListener("DOMContentLoaded", callback);
}

ready(() => {



	/*
	* Prevent CF7 form duplication emails
	*/
	let cf7_forms_submit = document.querySelectorAll('.wpcf7-form .wpcf7-submit');

	if (cf7_forms_submit) {
		cf7_forms_submit.forEach((element) => {

			element.addEventListener('click', (e) => {

				let form = element.closest('.wpcf7-form');

				if (form.classList.contains('submitting')) {
					e.preventDefault();
				}
			});
		});
	}





	/* SCRIPTS GO HERE */



	/* 
	sct-10-product
	*/
	// loadImageWithTimeout
	function loadImageWithTimeout(imageElement, placeholderSrc, timeout = 2000) {
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
		img.onload = function () {
			clearTimeout(timer); // Если изображение загрузилось, отменяем таймер
			imageElement.setAttribute('src', originalSrc); // Устанавливаем оригинальное изображение
		};

		img.onerror = function () {
			clearTimeout(timer); // Если ошибка, заменяем на плейсхолдер
			imageElement.setAttribute('src', placeholderSrc);
		};

		// Начинаем загрузку
		img.src = originalSrc;
	}






	/* 
	tooltip
	*/
	if (document.querySelector('.data-tooltip')) {
		let section = document.querySelector('.data-tooltip')
		let items = document.querySelectorAll('.data-tooltip')

		items.forEach(element => {
			// Mouseover event to show the tooltip content
			element.addEventListener('mouseover', function () {
				element.classList.add('active')
			});

			// Mouseout event to hide the tooltip content
			element.addEventListener('mouseout', function () {
				if (element.classList.contains('active')) {
					element.classList.remove('active')
				}
			});
		});
	}







	/* 
	data-b2-item-image
	*/
	if (document.querySelector('.data-b2-item-image')) {
		let section = document.querySelector('.data-b2-item-image')

		// loadImageWithTimeout
		function loadImageWithTimeout(imageElement, placeholderSrc, timeout = 2000) {
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
			img.onload = function () {
				clearTimeout(timer); // Если изображение загрузилось, отменяем таймер
				imageElement.setAttribute('src', originalSrc); // Устанавливаем оригинальное изображение
			};

			img.onerror = function () {
				clearTimeout(timer); // Если ошибка, заменяем на плейсхолдер
				imageElement.setAttribute('src', placeholderSrc);
			};

			// Начинаем загрузку
			img.src = originalSrc;
		}

		// Находим все изображения с классом 'data-b2-item-image'
		const images = document.querySelectorAll('.data-b2-item-image img'); // Измените на нужный селектор, если необходимо
		const placeholder = wcl_obj.template_url + '/img/image-placeholder.png'; // Ссылка на плейсхолдер

		// Применяем функцию ко всем изображениям
		images.forEach(image => {
			loadImageWithTimeout(image, placeholder);
		});
	}






	/* 
	data-b2-item-image
	*/
	if (document.querySelector('.data-b2-item-image')) {
		let section = document.querySelector('.data-b2-item-image')


		// Select all images with the data-b2-item-image attribute
		const images = document.querySelectorAll('.data-b2-item-image img');

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
	}





	/* 
	sct-10-product
	*/
	if (document.querySelector('.sct-10-product')) {
		let section = document.querySelector('.sct-10-product')


		let soundFileUrl = wcl_obj.sound_url_check_paid;
		const audio = new Audio(soundFileUrl);
		audio.volume = 0.7;

		// Function to play audio
		function playAudio() {
			audio.play();
		}

		// Function to stop audio
		function stopAudio() {
			audio.pause();
			audio.currentTime = 0; // Optional: Reset to the beginning
		}

		const defaultValue = true; // Значение по умолчанию
		const dexPaidCookie = getCookie('dex_paid_page_sound');

		const soundStatus = {
			dex_paid_page_sound: dexPaidCookie === 'true' ? true : (dexPaidCookie ? false : defaultValue),
		};

		function toggleSound(tableClass) {
			soundStatus[tableClass] = !soundStatus[tableClass];  // Переключаем статус
			saveSoundStatus(tableClass);  // Сохраняем в куки
			updateIcon(tableClass);  // Обновляем иконки

			if (soundStatus[tableClass] && audio.paused) {
				//playAudio(); // Play audio if it's paused
			} else {
				stopAudio(); // Stop audio if it's currently playing
			}
		}

		function saveSoundStatus(tableClass) {
			setCookie(`${tableClass}`, soundStatus[tableClass].toString(), 7); // Сохраняем на 7 дней
		}

		function updateIcon(tableClass) {
			const icons = section.querySelectorAll(`.data-b1-icon`);
			icons.forEach(icon => {
				if (soundStatus[tableClass]) {
					icon.querySelector('img').src = `${wcl_obj.template_url}/img/volume-up.svg`;
					icon.classList.add('mod-enable');
					icon.classList.remove('mod-disable');
				} else {
					icon.querySelector('img').src = `${wcl_obj.template_url}/img/volume-off.svg`;
					icon.classList.remove('mod-enable');
					icon.classList.add('mod-disable');
				}
			});
		}






		// Show preloader
		const preloader = section.querySelector('.preloader');
		preloader.style.display = 'flex'; // Show preloader

		let mint = section.getAttribute('data-mint')

		if (!mint) {
			return;
		}

		let data_request = {
			action: 'dex_paid_token_load',
			mint: mint,
		}

		let xhr = new XMLHttpRequest();
		xhr.open('POST', wcl_obj.ajax_url, true);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
		xhr.onload = function (data) {
			if (xhr.status >= 200 && xhr.status < 400) {
				var data = JSON.parse(xhr.responseText);
				console.log(data)
				let status_dex_paid = data.status_dex_paid

				setTimeout(() => {
					preloader.style.display = 'none'; // Hide preloader

					if (status_dex_paid) {
						document.querySelector('.sct-10-product.mod-type-1').classList.add('mod-dex_paid-active')
						document.querySelector('.sct-10-product.mod-generate').classList.add('mod-dex_paid-active')
						tsParticles_init()
					} else {
						document.querySelector('.sct-10-product.mod-type-1').classList.add('mod-dex_paid-no-active')
						document.querySelector('.sct-10-product.mod-generate').classList.add('mod-dex_paid-no-active')
					}

					document.querySelector('.sct-10-product.mod-type-1').classList.add('mod-loaded')

					document.querySelector('.sct-10-product.mod-type-1 .data-inner').innerHTML = data.token;
					document.querySelector('.sct-10-product.mod-generate .data-inner').innerHTML = data.token_for_screenshot;

					init_btn_download()

					// Находим все изображения с классом 'data-b2-item-image'
					const images = document.querySelectorAll('.sct-10-product .data-img img'); // Измените на нужный селектор, если необходимо
					const placeholder = wcl_obj.template_url + '/img/image-placeholder.png'; // Ссылка на плейсхолдер

					// Применяем функцию ко всем изображениям
					images.forEach(image => {
						console.log(image)
						loadImageWithTimeout(image, placeholder);
					});

				}, 600);

				if (status_dex_paid && soundStatus.dex_paid_page_sound) {
					setTimeout(() => {
						playAudio()
					}, 500);
				}

				section.querySelectorAll('.data-b1-icon').forEach(icon => {
					icon.addEventListener('click', () => toggleSound('dex_paid_page_sound'));
				});
			};
		};

		data_request = new URLSearchParams(data_request).toString();
		xhr.send(data_request);
	}






	/* 
	js-dex-paid-page
	*/
	if (document.querySelector('.js-dex-paid-page')) {
		let section = document.querySelector('.js-dex-paid-page')

		let soundFileUrl = wcl_obj.sound_url_check_paid;
		const audio = new Audio(soundFileUrl);
		audio.volume = 0.7;

		// Function to play audio
		function playAudio() {
			audio.play();
		}

		// Function to stop audio
		function stopAudio() {
			audio.pause();
			audio.currentTime = 0; // Optional: Reset to the beginning
		}

		const defaultValue = true; // Значение по умолчанию
		const dexPaidCookie = getCookie('dex_paid_page_sound');

		const soundStatus = {
			dex_paid_page_sound: dexPaidCookie === 'true' ? true : (dexPaidCookie ? false : defaultValue),
		};

		function toggleSound(tableClass) {
			soundStatus[tableClass] = !soundStatus[tableClass];  // Переключаем статус
			saveSoundStatus(tableClass);  // Сохраняем в куки
			updateIcon(tableClass);  // Обновляем иконки

			if (soundStatus[tableClass] && audio.paused) {
				//playAudio(); // Play audio if it's paused
			} else {
				stopAudio(); // Stop audio if it's currently playing
			}
		}

		function saveSoundStatus(tableClass) {
			setCookie(`${tableClass}`, soundStatus[tableClass].toString(), 7); // Сохраняем на 7 дней
		}

		function updateIcon(tableClass) {
			const icons = section.querySelectorAll(`.data-b1-icon`);
			icons.forEach(icon => {
				if (soundStatus[tableClass]) {
					icon.querySelector('img').src = `${wcl_obj.template_url}/img/volume-up.svg`;
					icon.classList.add('mod-enable');
					icon.classList.remove('mod-disable');
				} else {
					icon.querySelector('img').src = `${wcl_obj.template_url}/img/volume-off.svg`;
					icon.classList.remove('mod-enable');
					icon.classList.add('mod-disable');
				}
			});
		}


		section.querySelectorAll('.data-b1-icon').forEach(icon => {
			icon.addEventListener('click', () => toggleSound('dex_paid_page_sound'));
		});

		updateIcon('dex_paid_page_sound');
	}









	/* 
	sct-3-form
	*/
	if (document.querySelector('.sct-3-form')) {
		var section = document.querySelector('.sct-3-form');
		var urlParams = new URLSearchParams(window.location.search);
		var url_section = urlParams.get('section');

		section.querySelector('form').addEventListener('submit', function (event) {
			event.preventDefault(); // Prevent the default form submission

			const actionUrl = this.action; // Dynamically get the action attribute

			const mintValue = this.mint.value;

			const fullUrl = actionUrl + '?mint=' + encodeURIComponent(mintValue);

			window.location.href = fullUrl;
		});

		if (url_section === "check-dexscreener-paid-status") {
			if (scrollTo) {
				const element = document.getElementById('check-dexscreener-paid-status');
				if (element) {
					// Получаем позицию элемента и корректируем её с учетом отступа
					const elementPosition = element.getBoundingClientRect().top + window.pageYOffset - 100;

					window.scrollTo({
						top: elementPosition,
						behavior: "smooth"
					});
				}
			}
		}
	}





	/* 
	sct-7-promote
	 */
	if (document.querySelector('.sct-7-promote')) {
		let section = document.querySelector('.sct-7-promote')
		let section_groove = document.querySelector('.sct-8-gooner')


		section.querySelector('form').addEventListener('submit', function (e) {
			e.preventDefault()

			let form = this;

			let mint = form.querySelector('input[name="mint"]').value

			let data_request = {
				action: 'project_load_posts',
				mint: mint,
			}

			// Show preloader
			const preloader = section_groove.querySelector('.preloader');
			preloader.style.display = 'flex'; // Show preloader


			section_groove.querySelector('.data-b1').innerHTML = ''


			if (!section_groove.classList.contains('active')) {
				section_groove.classList.add('active')
			}

			if (section_groove.querySelector('.data-inner')) {
				section_groove.querySelector('.data-inner').classList.add('active')
			}

			form.querySelector('input[type="submit"]').setAttribute('disabled', 'disabled')
			form.querySelector('input[type="submit"]').classList.add('active')

			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);
					//console.log(data)

					form.querySelector('input[type="submit"]').classList.remove('active')
					form.querySelector('input[type="submit"]').removeAttribute('disabled')

					section_groove.querySelector('.data-b1').innerHTML = data.token;
					section_groove.setAttribute('data-mint', data.mint)

					if (section_groove.querySelector('.data-inner').classList.contains('active')) {
						section_groove.querySelector('.data-inner').classList.remove('active')
					}

					preloader.style.display = 'none';
				};
			};

			data_request = new URLSearchParams(data_request).toString();
			xhr.send(data_request);
		})
	}







	/* 
	sct-10-product mod-active
	*/
	function init_btn_download() {
		document.querySelector('.data-btn-download').addEventListener('click', function (e) {
			e.preventDefault()
			html2canvas(document.querySelector('#product-to-img'), {
				useCORS: true, // Разрешить кросс-доменные изображения
				allowTaint: true // Разрешить таинственные изображения
			}).then(function (canvas) {
				const link = document.createElement('a');
				link.href = canvas.toDataURL('image/jpeg');
				link.download = 'pump_black_image.jpg'; // Название сохраняемого файла
				link.click();

			});
		});
	}





	/* 
	sct-8-gooner
	*/
	if (document.querySelector('.sct-8-gooner')) {
		let section = document.querySelector('.sct-8-gooner')

		section.querySelector('.data-link button').addEventListener('click', function () {
			let self = this
			let product = section.querySelector('.data-item.active')
			let notice = section.querySelector('.data-notice'); // Контейнер для отображения заметки


			if (!product) {
				if (!notice) {
					notice = document.createElement('div');
					notice.classList.add('data-notice');
					section.querySelector('.data-inner').appendChild(notice);
				}

				notice.textContent = 'Please select a plan to continue.';
			} else {
				let plan = product.getAttribute('data-plan');

				if (notice) {
					notice.remove()
				}

				let mint = section.getAttribute('data-mint')

				let data_request = {
					action: 'np_create_payment',
					mint: mint,
					plan: plan,
				}

				if (section.querySelector('.data-inner')) {
					section.querySelector('.data-inner').classList.add('active')
				}

				self.setAttribute('disabled', 'disabled')
				self.classList.add('active')

				let xhr = new XMLHttpRequest();
				xhr.open('POST', wcl_obj.ajax_url, true);
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
				xhr.onload = function (data) {
					if (xhr.status >= 200 && xhr.status < 400) {
						var data = JSON.parse(xhr.responseText);

						self.removeAttribute('disabled')
						self.classList.remove('active')

						if (section.querySelector('.data-inner').classList.contains('active')) {
							section.querySelector('.data-inner').classList.remove('active')
						}

						if (data.success) {
							window.location.href = data.data.payment_url;
						} else {
							if (!notice) {
								notice = document.createElement('div');
								notice.classList.add('data-notice');
								section.querySelector('.data-inner').appendChild(notice);
							}

							notice.textContent = data.data.error;
						}
					};
				};

				data_request = new URLSearchParams(data_request).toString();
				xhr.send(data_request);
			}
		});

		section.querySelectorAll('.data-item-inner').forEach(element => {
			element.addEventListener('click', function (e) {
				let self = element.parentElement
				let notice = section.querySelector('.data-notice');

				section.querySelectorAll('.data-item').forEach(element => {
					element.classList.remove('active')
				});

				if (self.classList.contains('active')) {
					self.classList.remove('active')
				} else {
					self.classList.add('active')
				}

				if (notice) {
					notice.remove()
				}
			})
		});
	}





	/* 
	setCookie
	*/
	function setCookie(name, value, days) {
		let expires = "";
		if (days) {
			const date = new Date();
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
			expires = "; expires=" + date.toUTCString();
		}
		document.cookie = name + "=" + (value || "") + expires + "; path=/";
	}

	// Функция для получения куки
	function getCookie(name) {
		const nameEQ = name + "=";
		const ca = document.cookie.split(';');
		for (let i = 0; i < ca.length; i++) {
			let c = ca[i];
			while (c.charAt(0) === ' ') c = c.substring(1, c.length);
			if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
		}
		return null;
	}







	/* 
	wcl-tsparticles
	*/
	function tsParticles_init() {
		if (document.querySelector('.wcl-tsparticles')) {
			let section = document.querySelector('.wcl-tsparticles')

			if (true || document.querySelector('.page-template-dex-paid-page.mod-dex-paid-active') && window.matchMedia("(min-width: 575px)").matches) {
				tsParticles.load('tsparticles', {
					fpsLimit: 60,
					fullScreen: {
						enable: false
					},
					particles: {
						number: {
							value: 0,
						},
						color: {
							value: ["#B68EC1", "#D16B77", "#A23E4E", "#B59BCE", "#B49DCB", "#8A4CC0", "#C41E6D", "#B58BCC", "#D87D8D"]
						},
						shape: {
							type: ["square"]
						},
						opacity: {
							value: 1,
							animation: {
								enable: true,
								minimumValue: 0,
								speed: 1,
								startValue: "max",
								destroy: "min"
							}
						},
						size: {
							value: {
								min: 2,
								max: 13
							},
							random: {
								enable: true,
								minimumValue: 3
							},
						},
						links: {
							enable: false
						},
						line_linked: {
							enable: true,
							distance: 150,
							color: "#ffffff",
							opacity: 0.5,
							width: 1
						},
						life: {
							duration: {
								sync: true,
								value: 3
							},
							count: 1
						},
						move: {
							enable: true,
							gravity: {
								enable: true,
								acceleration: 111
							},
							speed: 15,
							decay: 0.3,
							direction: "top",
							random: false,
							straight: false,
							outModes: {
								default: "destroy",
								top: "none"
							}
						},
						rotate: {
							value: {
								min: 0,
								max: 360
							},
							direction: "random",
							move: true,
							animation: {
								enable: true,
								speed: 60
							}
						},
						tilt: {
							enable: true,
							direction: "random",
							move: true,
							value: {
								min: 0,
								max: 360
							},
							animation: {
								enable: true,
								speed: 60
							}
						},
						roll: {
							enable: true,
							speed: {
								min: 15,
								max: 25
							}
						},
						wobble: {
							distance: 30,
							enable: true,
							move: true,
							speed: {
								min: -15,
								max: 15
							}
						}
					},
					emitters: [
						{
							direction: "top",
							rate: {
								delay: 0.2,
								quantity: 15
							},
							position: {
								x: 0,
								y: 0
							},
							size: {
								width: 28,
								height: 55
							},
							particles: {
								move: {
									angle: {
										offset: -15,
										value: 60
									}
								}
							}
						},
						{
							direction: "bottom",
							rate: {
								delay: 0.2,
								quantity: 2
							},
							position: {
								x: 0,
								y: 0
							},
							size: {
								width: 25,
								height: 25
							},
							particles: {
								size: {
									value: {
										min: 11,
										max: 16
									},
									random: {
										enable: true,
										minimumValue: 11
									}
								},
								// number: {
								// 	//	value: 150 // Увеличено количество частиц для яркости эффекта
								// },
								move: {
									gravity: {
										enable: true,
										acceleration: 100
									},
									speed: 25,
									decay: 0.3,
									direction: "random",
									random: true,
									straight: true,
									outModes: {
										default: "destroy",
										top: "none"
									}
								},
							}
						},
						{
							direction: "bottom",
							rate: {
								delay: 0.15,
								quantity: 15
							},
							position: {
								x: 0,
								y: 0
							},
							size: {
								width: 25,
								height: 88
							},
							particles: {
								move: {
									angle: {
										offset: -15,
										value: 60
									}
								}
							}
						},
						// right
						{
							direction: "top",
							rate: {
								delay: 0.2,
								quantity: 15
							},
							position: {
								x: 100,
								y: 0
							},
							size: {
								width: 25,
								height: 55
							},
							particles: {
								move: {
									angle: {
										offset: -15,
										value: 60
									}
								}
							}
						},
						{
							direction: "none",
							direction: "bottom",
							rate: {
								delay: 0.2,
								quantity: 2
							},
							position: {
								x: 100,
								y: 0
							},
							size: {
								width: 25,
								height: 25
							},
							particles: {
								size: {
									value: {
										min: 11,
										max: 16
									},
									random: {
										enable: true,
										minimumValue: 11
									}
								},
								move: {
									gravity: {
										enable: true,
										acceleration: 100
									},
									speed: 25,
									decay: 0.3,
									direction: "random",
									random: true,
									straight: true,
									outModes: {
										default: "destroy",
										top: "none"
									}
								},
							}
						},
						{
							direction: "bottom",
							rate: {
								delay: 0.15,
								quantity: 15
							},
							position: {
								x: 100,
								y: 0
							},
							size: {
								width: 25,
								height: 88
							},
							particles: {
								move: {
									angle: {
										offset: -15,
										value: 60
									}
								}
							}
						},
					]
				});
			}
		}
	}



});