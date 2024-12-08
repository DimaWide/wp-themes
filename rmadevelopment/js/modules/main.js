
// main

function main() {


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




	// wcl-acf-block-12

	function sidebar_scroll(sidebar, sidebar_top, section) {
		// Get the width of the second column
		const secondColumn = document.querySelector('.wcl-acf-block-12 .data-col:nth-child(2)');
		const columnWidth = secondColumn.offsetWidth; // Get the width of the second column

		// if (secondColumn && sidebar) {
		// 	sidebar.style.width = `${columnWidth}px`; // Set the sidebar width to match the column width
		// }

		let content = section.querySelector('.data-content')
		let sidebar_bot = content.offsetTop + content.clientHeight + 36
		sidebar_bot = sidebar_bot - sidebar.clientHeight
		let sidebar_bot_2 = content.clientHeight - sidebar.clientHeight

		if (sidebar_bot_2 < 0) {
			sidebar_bot_2 = 0
		}

		let scrolled = window.scrollY

		if (scrolled >= sidebar_top && scrolled <= sidebar_bot - 115) {
			sidebar.classList.add('active')
			sidebar.classList.remove('active-2')
			sidebar.style.top = '115px'
			sidebar.style.width = `${columnWidth}px`;
		} else {
			if (scrolled >= sidebar_top) {
				sidebar.classList.remove('active')
				sidebar.classList.add('active-2')
				sidebar.style.top = sidebar_bot_2 + 'px'
				sidebar.style.width = `${columnWidth}px`;
			} else {
				sidebar.classList.remove('active')
				sidebar.style.top = '0'
				sidebar.style.width = ``;
			}
		}

	}

	if (document.querySelector('.wcl-acf-block-12')) {
		let section = document.querySelector('.wcl-acf-block-12')

		// Fixed on Scroll
		if (section.querySelector('.cmp-3-sidebar')) {
			if (window.matchMedia("(min-width: 991px)").matches) {
				let sidebar = section.querySelector('.cmp-3-sidebar')
				let sidebar_top = sidebar.offsetTop + 1 - 115

				sidebar_scroll(sidebar, sidebar_top, section);

				window.addEventListener('scroll', function (e) {
					sidebar_scroll(sidebar, sidebar_top, section);
				});
			}
		}
	}



	// sct-2-content

	if (document.querySelector('.sct-2-content')) {
		let section = document.querySelector('.sct-2-content')

		if (window.matchMedia("(min-width: 991px)").matches) {
			var links = document.querySelectorAll(".data-table-contents a");
			var isUpdating = false;
			var activeLinkId = null;

			function updateActiveElement() {
				if (!isUpdating) {
					isUpdating = true;

					var scrollPosition = window.scrollY || window.pageYOffset;

					var activeLink = null;

					Array.from(links).forEach(function (link) {
						var targetId = link.getAttribute("href").substring(1);
						var targetElement = document.getElementById(targetId);

						if (targetElement) {
							var offset = targetElement.offsetTop - 30 - 95;

							if (scrollPosition >= offset) {
								activeLink = link;
							}
						}
					});

					if (activeLink && activeLink.getAttribute("href") !== "#" + activeLinkId) {
						Array.from(links).forEach(function (link) {
							link.classList.remove("active");
						});

						activeLink.classList.add("active");
						activeLinkId = activeLink.getAttribute("href").substring(1);
					}

					isUpdating = false;
				}
			}

			window.addEventListener("scroll", updateActiveElement);

			updateActiveElement();
		}

		// Fixed on Scroll
		if (section.querySelector('.data-sidebar')) {
			if (window.matchMedia("(min-width: 991px)").matches) {
				let sidebar = section.querySelector('.data-sidebar')

				let sidebar_top = sidebar.offsetTop + 1 - 115
				let content = section.querySelector('.data-content')
				let sidebar_bot = content.offsetTop + content.clientHeight
				sidebar_bot = sidebar_bot - sidebar.clientHeight
				let sidebar_bot_2 = content.clientHeight - sidebar.clientHeight

				if (sidebar_bot_2 < 0) {
					sidebar_bot_2 = 0
				}

				let scrolled = window.scrollY

				if (scrolled >= sidebar_top && scrolled <= sidebar_bot) {
					sidebar.classList.add('active')
					sidebar.classList.remove('active-2')
					sidebar.style.top = 115
				} else {
					if (scrolled >= sidebar_top) {
						sidebar.classList.remove('active')
						sidebar.classList.add('active-2')
						sidebar.style.top = sidebar_bot_2 + 'px'
					} else {
						sidebar.classList.remove('active')
					}
				}

				window.addEventListener('scroll', function (e) {
					sidebar_bot = content.offsetTop + content.clientHeight
					sidebar_bot = sidebar_bot - sidebar.clientHeight
					sidebar_bot_2 = content.clientHeight - sidebar.clientHeight

					if (sidebar_bot_2 < 0) {
						sidebar_bot_2 = 0
					}

					let scrolled = window.scrollY


					if (scrolled >= sidebar_top && scrolled <= sidebar_bot - 115) {
						sidebar.classList.add('active')
						sidebar.classList.remove('active-2')
						sidebar.style.top = '115px'
						console.log(3)
					} else {
						if (scrolled >= sidebar_top) {
							sidebar.classList.remove('active')
							sidebar.classList.add('active-2')
							sidebar.style.top = sidebar_bot_2 + 'px'
							console.log(1)
						} else {
							sidebar.classList.remove('active')
							sidebar.style.top = '0'
							console.log(2)
						}
					}
				});
			}
		}

		// Anchor Link
		if (section.querySelector('.data-table-contents a')) {
			section.querySelectorAll('.data-table-contents a[href^="#"]').forEach(anchor => {
				anchor.addEventListener('click', function (e) {
					e.preventDefault();

					const targetId = this.getAttribute('href').substring(1);
					const targetElement = document.getElementById(targetId);

					if (targetElement) {
						window.scrollTo({
							top: targetElement.offsetTop - 20 - 95,
							behavior: 'smooth'
						});
					}
				});
			});
		}
	}


	// wcl-acf-block-14
	if (document.querySelector('.wcl-acf-block-14')) {
		let section = document.querySelector('.wcl-acf-block-14')
		var selectElement = section.querySelector('select');

		if (selectElement.options.length > 0) {
			selectElement.options[0].disabled = true;
			selectElement.selectedIndex = 0;
		}

		// function checkInitialSelectState() {
		// 	const selects = section.querySelectorAll('select');

		// 	selects.forEach(function (select) {
		// 		if (select.value == 'Inquiry Type' && select.selectedIndex == 0) {
		// 			select.parentElement.parentElement.classList.remove('focused');
		// 		} else {
		// 			select.parentElement.parentElement.classList.add('focused');
		// 		}
		// 	});
		// }

		// checkInitialSelectState()


		// Focus

		const fields = section.querySelectorAll('input, textarea, select');

		function addFocusClass(event) {
			if (event.target.tagName != 'SELECT') {
				event.target.parentElement.parentElement.classList.add('focused');
			}
		}

		function removeFocusClass(event) {
			const field = event.target;

			if (field.value.trim() === '') {
				event.target.parentElement.parentElement.classList.remove('focused');
			}
		}

		fields.forEach(field => {
			field.addEventListener('focus', addFocusClass);
			field.addEventListener('blur', removeFocusClass);


			// if (field.tagName === 'SELECT') {
			// 	field.addEventListener('change', function (event) {
			// 		event.target.parentElement.parentElement.classList.add('focused');
			// 	});
			// }
		});

		document.addEventListener('wpcf7mailsent', function (event) {
			if (section.querySelector('.wpcf7-form').classList.contains('sent')) {
				fields.forEach(field => {
					field.parentElement.parentElement.classList.remove('focused');
				});
			}
		});
	}


	// wcl-acf-block-11
	if (document.querySelector('.wcl-acf-block-11')) {
		let section = document.querySelector('.wcl-acf-block-11')
		let load_more = section.querySelector('.data-load-more')

		// load_more
		if (load_more) {
			load_more.addEventListener("click", function (e) {
				e.preventDefault();
				if (e.target.classList.contains('data-load-more-btn')) {
					if (e.target.getAttribute("disable") == 'disable') {
						return false;
					}

					let self = e.target
					let page = e.target.getAttribute("data-page");

					self.classList.add('mod-active')
					project_load_posts(page);
				}
			});
		}


		// project_load_posts
		function project_load_posts(page_new) {
			let page = 1;

			if (page_new) {
				page = parseInt(page_new) + 1;
			}

			let data_request = {
				action: 'project_load_posts',
				page: page,
			}

			if (section.querySelector('.data-list')) {
				section.querySelector('.data-list').classList.add('active')
			}

			load_more.querySelector('button').setAttribute('disabled', 'disabled')
			load_more.querySelector('button').classList.add('active')

			load_more.querySelector('button').textContent = 'Loading'

			generate_url(data_request);

			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);

					load_more.querySelector('button').classList.remove('active')
					load_more.querySelector('button').removeAttribute('disabled')

					if (page_new) {
						section.querySelector('.data-list').insertAdjacentHTML('beforeend', data.posts);
						section.querySelector('.data-load-more').innerHTML = data.button;
					} else {
						section.querySelector('.data-list').innerHTML = data.posts;
						section.querySelector('.data-load-more').innerHTML = data.button;
					}

					if (section.querySelector('.data-list').classList.contains('active')) {
						section.querySelector('.data-list').classList.remove('active')
					}
				};
			};

			data_request = new URLSearchParams(data_request).toString();
			xhr.send(data_request);
		}


		// generate_url
		function generate_url(data) {
			let slug_page = section.getAttribute('data-slug-page')
			let url = wcl_obj.site_url;

			url += slug_page + '/';

			if (data.page && data.page != 1) {
				url += 'page/' + data.page + '/';
			}

			window.history.pushState(wcl_obj.site_url, document.title, url);
		}
	}



	// wcl-acf-block-13
	if (document.querySelector('.wcl-acf-block-13')) {
		let section = document.querySelector('.wcl-acf-block-13')
		let load_more = section.querySelector('.data-load-more')

		// load_more
		if (load_more) {
			load_more.addEventListener("click", function (e) {
				e.preventDefault();
				if (e.target.classList.contains('data-load-more-btn')) {
					if (e.target.getAttribute("disable") == 'disable') {
						return false;
					}

					let self = e.target
					let page = e.target.getAttribute("data-page");

					self.classList.add('mod-active')
					blog_load_posts(page);
				}
			});
		}


		// blog_load_posts
		function blog_load_posts(page_new) {
			let page = 1;

			if (page_new) {
				page = parseInt(page_new) + 1;
			}

			let data_request = {
				action: 'blog_load_posts',
				page: page,
			}

			if (section.querySelector('.data-list')) {
				section.querySelector('.data-list').classList.add('active')
			}

			load_more.querySelector('button').setAttribute('disabled', 'disabled')
			load_more.querySelector('button').classList.add('active')

			load_more.querySelector('button').textContent = 'Loading'

			generate_url(data_request);

			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);

					load_more.querySelector('button').classList.remove('active')
					load_more.querySelector('button').removeAttribute('disabled')

					if (page_new) {
						section.querySelector('.data-list').insertAdjacentHTML('beforeend', data.posts);
						section.querySelector('.data-load-more').innerHTML = data.button;
					} else {
						section.querySelector('.data-list').innerHTML = data.posts;
						section.querySelector('.data-load-more').innerHTML = data.button;
					}

					if (section.querySelector('.data-list').classList.contains('active')) {
						section.querySelector('.data-list').classList.remove('active')
					}
				};
			};

			data_request = new URLSearchParams(data_request).toString();
			xhr.send(data_request);
		}


		// generate_url
		function generate_url(data) {
			let slug_page = section.getAttribute('data-slug-page')
			let url = wcl_obj.site_url;

			url += slug_page + '/';

			if (data.page && data.page != 1) {
				url += 'page/' + data.page + '/';
			}

			window.history.pushState(wcl_obj.site_url, document.title, url);
		}
	}




	// wcl-acf-block-12
	if (document.querySelector('.wcl-acf-block-12')) {
		let section = document.querySelector('.wcl-acf-block-12')
		let load_more = section.querySelector('.data-load-more')

		// load_more
		if (load_more) {
			load_more.addEventListener("click", function (e) {
				e.preventDefault();
				if (e.target.classList.contains('data-load-more-btn')) {
					if (e.target.getAttribute("disable") == 'disable') {
						return false;
					}

					let self = e.target
					let page = e.target.getAttribute("data-page");

					self.classList.add('mod-active')
					news_load_posts(page);
				}
			});
		}


		// news_load_posts
		function news_load_posts(page_new) {
			let page = 1;

			if (page_new) {
				page = parseInt(page_new) + 1;
			}

			let data_request = {
				action: 'news_load_posts',
				page: page,
			}

			if (section.querySelector('.data-list')) {
				section.querySelector('.data-list').classList.add('active')
			}

			load_more.querySelector('button').setAttribute('disabled', 'disabled')
			load_more.querySelector('button').classList.add('active')

			load_more.querySelector('button').textContent = 'Loading'

			generate_url(data_request);

			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);

					load_more.querySelector('button').classList.remove('active')
					load_more.querySelector('button').removeAttribute('disabled')

					if (page_new) {
						section.querySelector('.data-list').insertAdjacentHTML('beforeend', data.posts);
						section.querySelector('.data-load-more').innerHTML = data.button;
					} else {
						section.querySelector('.data-list').innerHTML = data.posts;
						section.querySelector('.data-load-more').innerHTML = data.button;
					}

					if (section.querySelector('.data-list').classList.contains('active')) {
						section.querySelector('.data-list').classList.remove('active')
					}

					// Fixed on Scroll
					if (section.querySelector('.cmp-3-sidebar')) {
						if (window.matchMedia("(min-width: 991px)").matches) {
							let sidebar = section.querySelector('.cmp-3-sidebar')
							let sidebar_top = sidebar.offsetTop + 1

							sidebar_scroll(sidebar, sidebar_top, section);
						}
					}
				};
			};

			data_request = new URLSearchParams(data_request).toString();
			xhr.send(data_request);
		}


		// generate_url
		function generate_url(data) {
			let slug_page = section.getAttribute('data-slug-page')
			let url = wcl_obj.site_url;

			url += slug_page + '/';

			if (data.page && data.page != 1) {
				url += 'page/' + data.page + '/';
			}

			window.history.pushState(wcl_obj.site_url, document.title, url);
		}
	}


	// wcl-acf-block-8
	if (document.querySelector('.wcl-acf-block-8')) {
		let sections = document.querySelectorAll('.wcl-acf-block-8')

		function initSliders() {
			sections.forEach(section => {
				let swiper = new Swiper(section.querySelector('.data-slider'), {
					slidesPerView: 'auto',
					spaceBetween: 45,
					freeMode: {
						enabled: true,
						momentum: false,
					},
					speed: 600,
					breakpoints: {
						0: {
							spaceBetween: 25,
						},
						575: {
							spaceBetween: 25,
						},
						1199: {
							spaceBetween: 45,
						},
					}
				});

				swiper.on('reachEnd', function () {
					swiper.el.classList.add('last-slide');
				});

				swiper.on('fromEdge', function () {
					swiper.el.classList.remove('last-slide');
				});

				section.swiperInstance = swiper;
			});
		}

		function destroySliders() {
			sections.forEach(section => {
				if (section.swiperInstance) {
					section.swiperInstance.destroy(true, true);
					section.swiperInstance = null;
				}
			});
		}

		function handleResize() {
			if (window.matchMedia("(max-width: 575px)").matches) {
				destroySliders();
				initSliders();
			} else {
				destroySliders();
			}
		}

		handleResize();

		window.addEventListener('resize', handleResize);
	}



	// wcl-acf-block-8
	if (document.querySelector('.wcl-acf-block-8')) {
		let section = document.querySelector('.wcl-acf-block-8')

		window.addEventListener('resize', () => {
			if (document.querySelector('.cmp-2-team-popup.active')) {
				check_overflow_text('.cmp-2-team-popup .cmp2-desc');
			}
		});

		section.querySelectorAll('.data-item-link').forEach(element => {
			element.addEventListener('click', function (e) {
				let item = element.closest('.data-item')
				var popup = document.querySelector('.cmp-2-team-popup');
				var data = JSON.parse(item.getAttribute('data-info'));


				popup.querySelector('.cmp2-img').innerHTML = data.photo;
				popup.querySelector('.cmp2-img-2').innerHTML = data.photo;
				popup.querySelector('.cmp2-name').innerHTML = data.name;
				popup.querySelector('.cmp2-specialization').innerHTML = data.specialization;
				popup.querySelector('.cmp2-desc-inner').innerHTML = data.description;

				popup.style.display = 'block'; // Example for showing the popup

				if (document.querySelector('.wcl-header').querySelector('.data-nav').classList.contains('active')) {
					document.querySelector('.wcl-header').classList.remove('active')
					document.querySelector('.wcl-header').querySelector('.data-nav').classList.remove('active')
				}

				popup.classList.add('active')

				document.querySelector('.cmp-1-popup').classList.add('active')
				document.querySelector('body').classList.add('overflow-hidden');
				document.querySelector('html').classList.add('overflow-hidden');
				document.querySelector('body').classList.add('mod-overflow-help')

				check_overflow_text('.cmp-2-team-popup .cmp2-desc');
			})
		});
	}


	// check_overflow_text
	function check_overflow_text(selector) {
		if (document.querySelector(selector)) {
			document.querySelectorAll(selector).forEach(element => {
				let height = element.clientHeight
				let data_height = element.children[0].clientHeight

				if (data_height > height) {
					element.classList.add('mask')
				}

				element.addEventListener('mouseover', function (e) {
					let height = this.clientHeight
					let data_height = this.children[0].clientHeight

					if (data_height <= height) {
						if (this.classList.contains('mask')) {
							this.classList.remove('mask')
						}
					}
				})

				element.addEventListener('scroll', function (e) {
					let height = this.clientHeight
					let data_height = this.children[0].clientHeight
					if (Math.ceil(height + this.scrollTop) >= data_height) {
						this.classList.remove('mask')
					} else {
						this.classList.add('mask')
					}
				})
			});
		}
	}


	// cmp-1-popup
	if (document.querySelector('.cmp-1-popup')) {
		let items = document.querySelectorAll('.cmp-1-popup')

		items.forEach(element => {
			element.querySelectorAll('.js-close').forEach(close => {
				close.addEventListener('click', function (e) {
					element.classList.remove('active')
					document.querySelector('body').classList.remove('overflow-hidden');
					document.querySelector('body').classList.remove('mod-overflow-help');
					document.querySelector('html').classList.remove('overflow-hidden');
				})
			});

			element.querySelector('.cmp1-overlay').addEventListener('click', function (e) {
				element.classList.remove('active')
				document.querySelector('body').classList.remove('overflow-hidden');
				document.querySelector('body').classList.remove('mod-overflow-help');
				document.querySelector('html').classList.remove('overflow-hidden');
			})

			element.querySelector('.cmp1-inner-out').addEventListener('click', function (e) {
				if (!e.target.closest('.cmp1-inner')) {
					element.classList.remove('active')
					document.querySelector('body').classList.remove('overflow-hidden');
					document.querySelector('body').classList.remove('mod-overflow-help');
					document.querySelector('html').classList.remove('overflow-hidden');
				}
			})
		});
	}




	// line-container
	if (document.querySelector('.line-container')) {
		let section = document.querySelector('.line-container')

		function updateLineSizes() {
			const lineContainers = document.querySelectorAll('.line-container');
			lineContainers.forEach(container => {
				const line = container.querySelector('.line');
				const orientation = container.getAttribute('data-orientation');
				const maxLength = parseInt(container.getAttribute('data-length'), 10);
				let type_dir = container.getAttribute('data-type');
				let offset = parseInt(container.getAttribute('data-offset'), 10);

				if (!offset) {
					offset = 55;
				}

				const scrollCoefficient = parseFloat(container.getAttribute('data-scroll-coefficient'));
				const containerTop = line.getBoundingClientRect().top + window.scrollY;

				// Вычисляем смещение и текущую прокрутку
				const scrollPosition = window.scrollY;
				let offsetPosition = '';

				if (type_dir == 'top') {
					offsetPosition = scrollPosition - containerTop + offset;
				} else {
					offsetPosition = scrollPosition - containerTop + window.innerHeight - offset;
				}

				if (offsetPosition > 0) {
					const scaledPosition = offsetPosition * scrollCoefficient;

					if (orientation === 'horizontal') {
						const lineWidth = Math.min(scaledPosition, maxLength);
						line.style.width = lineWidth + 'px';
					} else if (orientation === 'vertical') {
						const lineHeight = Math.min(scaledPosition, maxLength);
						line.style.height = lineHeight + 'px';
					}
				} else {
					// Если линия не видна, сбросить размер
					if (orientation === 'horizontal') {
						line.style.width = '0px';
					} else if (orientation === 'vertical') {
						line.style.height = '0px';
					}
				}
			});
		}

		window.addEventListener('scroll', updateLineSizes);
		window.addEventListener('resize', updateLineSizes);
		window.addEventListener('load', updateLineSizes);

	}



	// wcl-acf-block-5
	if (document.querySelector('.wcl-acf-block-5')) {
		let sections = document.querySelectorAll('.wcl-acf-block-5')

		sections.forEach(section => {
			let swiper = new Swiper(section.querySelector('.data-slider'), {
				slidesPerView: 'auto',
				loop: true,
				freeMode: {
					enabled: true,
					momentum: false,
				},
				speed: 5000,
				spaceBetween: 45,
				breakpoints: {
					0: {
						spaceBetween: 20,
					},
					767: {
						spaceBetween: 30,
					},
					1199: {
						spaceBetween: 45,
					},
				}
			});

			let autoplayInterval;
			const autoplaySpeed = 0.8;    // Speed of the auto-scroll in pixels per interval
			const autoplayIntervalTime = 16; // Interval time in milliseconds (16ms for ~60fps)
			let isAutoplayStarted = false;
			let isMouseOverSlider = false;

			// Function to start custom autoplay
			function startAutoplay() {
				if (!isAutoplayStarted && !isMouseOverSlider) {
					isAutoplayStarted = true;

					autoplayInterval = setInterval(() => {
						// Calculate the new translate value
						const newTranslate = swiper.translate - autoplaySpeed;

						// Set the new translate value to move slides
						swiper.setTranslate(newTranslate);

						// Check if we need to loop back to the start
						if (swiper.isEnd) {
							//swiper.loopFix(); // Fixes the loop by ensuring continuous scrolling
							//swiper.slideToLoop(0); // Smoothly transitions to the first slide
							swiper.setTranslate(0);  // Jump back to the start when reaching the end
						}
					}, autoplayIntervalTime);

				}
			}

			// Function to stop custom autoplay
			function stopAutoplay() {
				clearInterval(autoplayInterval);

				if (isAutoplayStarted) {
					isAutoplayStarted = false;
				}
			}

			// Start autoplay when the page loads
			if (isSliderInView(section.querySelector('.data-slider'), 0)) { // 200px offset, adjust as needed
				startAutoplay();
			} else {
				stopAutoplay();
			}
			// Optional: Pause autoplay on mouse hover and resume when mouse leaves
			const sliderContainer = section.querySelector('.data-slider');

			sliderContainer.addEventListener('mouseenter', () => {
				isMouseOverSlider = true;
				stopAutoplay(); // Stop autoplay when the mouse is over the slider
			});

			sliderContainer.addEventListener('mouseleave', () => {
				isMouseOverSlider = false;
				handleScroll(); // Check visibility and potentially start autoplay again
			});


			// Function to check if the slider is within the viewport
			function isSliderInView(slider, offset = 0) {
				const rect = slider.getBoundingClientRect();
				const viewHeight = window.innerHeight || document.documentElement.clientHeight;
				return (
					rect.top + offset < viewHeight &&
					rect.bottom > offset
				);
			}

			// Function to handle scroll event
			function handleScroll() {
				const slider = section.querySelector('.data-slider');

				if (isSliderInView(slider, 0)) { // 200px offset, adjust as needed
					startAutoplay();
				} else {
					stopAutoplay();
				}
			}

			// Handle scroll event
			window.addEventListener('scroll', handleScroll);
		});
	}





	// wcl-acf-block-3
	if (document.querySelector('.wcl-acf-block-3')) {
		let sections = document.querySelectorAll('.wcl-acf-block-3')

		// slider
		sections.forEach(section => {
			let swiper = new Swiper(section.querySelector('.data-slider'), {
				slidesPerView: 'auto',
				spaceBetween: 45,
				freeMode: {
					enabled: true,
					momentum: false,
				},
				speed: 600,
				breakpoints: {
					0: {
						spaceBetween: 25,
					},
					767: {
						spaceBetween: 30,
					},
					1199: {
						spaceBetween: 45,
					},
				}
			});

			swiper.on('reachEnd', function () {
				swiper.el.classList.add('last-slide');
			});

			swiper.on('fromEdge', function () {
				swiper.el.classList.remove('last-slide');
			});
		});
	}



	// wcl-acf-block-1

	if (document.querySelector('.wcl-acf-block-1')) {
		let section = document.querySelector('.wcl-acf-block-1');
		let video = section.querySelector('video');

		if (video) {
			// Получаем координаты секции относительно верхней части страницы
			let sectionTop = section.getBoundingClientRect().top + window.scrollY;
			let sectionBottom = section.getBoundingClientRect().bottom + window.scrollY;

			// Получаем координаты текущей прокрутки и высоту окна
			let scrollTop = window.scrollY;
			let windowHeight = window.innerHeight;

			// Проверяем, попадает ли секция (и видео в ней) в видимую область
			if (scrollTop + windowHeight > sectionTop && scrollTop < sectionBottom) {
				video.play();
			} else {
				video.pause();
			}

			window.addEventListener('scroll', function () {
				// Получаем координаты секции относительно верхней части страницы
				sectionTop = section.getBoundingClientRect().top + window.scrollY;
				sectionBottom = section.getBoundingClientRect().bottom + window.scrollY;

				// Получаем координаты текущей прокрутки и высоту окна
				scrollTop = window.scrollY;
				windowHeight = window.innerHeight;

				// Проверяем, попадает ли секция (и видео в ней) в видимую область
				if (scrollTop + windowHeight > sectionTop && scrollTop < sectionBottom) {
					video.play();
				} else {
					video.pause();
				}
			});
		}
	}




	// wcl-acf-block-7

	if (document.querySelector('.wcl-acf-block-7')) {
		let section = document.querySelector('.wcl-acf-block-7');
		let video = section.querySelector('video');

		if (video) {
			// Получаем координаты секции относительно верхней части страницы
			let sectionTop = section.getBoundingClientRect().top + window.scrollY;
			let sectionBottom = section.getBoundingClientRect().bottom + window.scrollY;

			// Получаем координаты текущей прокрутки и высоту окна
			let scrollTop = window.scrollY;
			let windowHeight = window.innerHeight;

			// Проверяем, попадает ли секция (и видео в ней) в видимую область
			if (scrollTop + windowHeight > sectionTop && scrollTop < sectionBottom) {
				video.play();
			} else {
				video.pause();
			}

			window.addEventListener('scroll', function () {
				// Получаем координаты секции относительно верхней части страницы
				sectionTop = section.getBoundingClientRect().top + window.scrollY;
				sectionBottom = section.getBoundingClientRect().bottom + window.scrollY;

				// Получаем координаты текущей прокрутки и высоту окна
				scrollTop = window.scrollY;
				windowHeight = window.innerHeight;

				// Проверяем, попадает ли секция (и видео в ней) в видимую область
				if (scrollTop + windowHeight > sectionTop && scrollTop < sectionBottom) {
					video.play();
				} else {
					video.pause();
				}
			});
		}
	}


	// wcl-footer
	if (document.querySelector('.wcl-footer')) {
		let section = document.querySelector('.wcl-footer')

		section.querySelectorAll('.data-menu  li.menu-item-has-children > a').forEach(element => {
			element.addEventListener('click', function (e) {
				e.preventDefault()

				if (element) {
					element.addEventListener('click', function (e) {
						if (element.getAttribute('href') == '#') {
							e.preventDefault()
						}
					})
				}
			})
		});

		if (window.matchMedia("(max-width: 1300px)").matches) {
			section.querySelectorAll('.data-menu  li.menu-item-has-children > a').forEach(element => {
				element.addEventListener('click', function (e) {
					e.preventDefault()

					section.querySelectorAll('.data-menu li.active').forEach(element2 => {
						if (this.parentElement != element2) {
							element2.classList.remove('active')
						}
					});

					if (this.parentElement.classList.contains('active')) {
						this.parentElement.classList.remove('active')
					} else {
						this.parentElement.classList.add('active')
					}
				})
			});
		}
	}




	// wcl-header
	if (document.querySelector('.wcl-header')) {
		let section = document.querySelector('.wcl-header')

		window.addEventListener('scroll', function () {
			if (window.scrollY > 0) {
				section.classList.add('mod-scroll');
			} else {
				section.classList.remove('mod-scroll');
			}
		});

		section.querySelectorAll('.data-menu  li.menu-item-has-children > a').forEach(element => {
			element.addEventListener('click', function (e) {
				e.preventDefault()

				if (element) {
					element.addEventListener('click', function (e) {
						if (element.getAttribute('href') == '#') {
							e.preventDefault()
						}
					})
				}
			})
		});


		// btn-menu
		section.querySelectorAll('.data-btn-menu').forEach(element => {
			element.addEventListener('click', function (e) {

				if (section.querySelector('.data-nav').classList.contains('active')) {
					this.classList.remove('active')
					section.querySelector('.data-nav').classList.remove('active')
					section.classList.remove('active-nav')
					document.querySelector('body, html').classList.remove('overflow-hidden')
				} else {
					this.classList.add('active')
					section.querySelector('.data-nav').classList.add('active')
					section.classList.add('active-nav')
					document.querySelector('body, html').classList.add('overflow-hidden')
				}
			})
		});


		// data-menu
		if (window.matchMedia("(max-width: 1300px)").matches) {
			section.querySelectorAll('.data-menu > li.menu-item-has-children > a').forEach(element => {
				element.addEventListener('click', function (e) {
					e.preventDefault()

					section.querySelectorAll('.data-menu li.active').forEach(element2 => {
						if (this.parentElement != element2) {
							element2.classList.remove('active')
						}
					});

					if (this.parentElement.classList.contains('active')) {
						this.parentElement.classList.remove('active')
					} else {
						this.parentElement.classList.add('active')
					}
				})
			});


		}
	}

}


document.addEventListener('DOMContentLoaded', function () {
	main();
});
