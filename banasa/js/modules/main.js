
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


	/* SCRIPTS GO HERE */




	// mod-section-animate
	if (document.querySelector('.wcl-blog.mod-section-animate')) {
		let section = document.querySelector('.wcl-blog.mod-section-animate')

		if (section.querySelector('.cmp-1-post')) {
			section.querySelectorAll('.cmp-1-post').forEach(element => {
				element.addEventListener('mouseover', function (e) {
					if (!section.classList.contains('first-animated')) {
						section.classList.add('first-animated')
					}
				});
			});

		}
	}

	// mod-section-animate
	if (document.querySelector('.mod-section-animate')) {
		let section = document.querySelector('.mod-section-animate')

		function checkVisibility() {
			const sections = document.querySelectorAll('.mod-section-animate');
			const scrollDirection = getScrollDirection();

			sections.forEach(section => {

				const sectionTop = section.getBoundingClientRect().top;
				const windowHeight = window.innerHeight;
				const sectionHeight = section.offsetHeight;
				const offset = parseFloat(section.getAttribute('data-offset')) || 0;

				if (!section.classList.contains('first-load')) {
					section.classList.add('first-load')
				}

				if (scrollDirection === 'down') {
					if (sectionTop < windowHeight * (0.75 + offset) && sectionTop + sectionHeight > offset) {
						section.classList.add('visible');
					} else {
						//section.classList.remove('visible');
					}

				} else if (scrollDirection === 'up') {
					if (sectionTop < windowHeight * (0.75 + offset) && sectionTop + sectionHeight > (offset + 0)) {
						section.classList.add('visible');
					} else {
						//section.classList.remove('visible');
					}
				}

				// setTimeout(() => {
				// 	if (!section.classList.contains('first-load-2')) {
				// 		section.classList.add('first-load-2')
				// 	}
				// }, 1000);
			});
		}

		function getScrollDirection() {
			if (window.scrollY < window.lastScrollY) {
				window.lastScrollY = window.scrollY;
				return 'up';
			} else {
				window.lastScrollY = window.scrollY;
				return 'down';
			}
		}

		checkVisibility();
		window.addEventListener('scroll', checkVisibility);
	}



	// cmp-2-form
	if (document.querySelector('.cmp-2-form')) {
		let section = document.querySelector('.cmp-2-form')


		if (section.querySelector('.ginput_container_consent ')) {
			if (window.matchMedia("only screen and (max-width: 760px)").matches) {
				var privacyField = section.querySelector('.ginput_container_consent input');
				//	console.log(11)
				if (privacyField) {
					privacyField.removeAttribute('required');

					var fieldWrapper = privacyField.closest('.gfield');
					if (fieldWrapper) {
						//	console.log(fieldWrapper)

						fieldWrapper.classList.remove('gfield_contains_required');
					}
				}
			}
		}
	}



	// wcl-blog
	if (document.querySelector('.wcl-blog')) {
		let section = document.querySelector('.wcl-blog')
		let load_more = section.querySelector('.data-load-more')
		let language = document.querySelector('html').getAttribute('lang')

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
			let category = '';
			let search = section.querySelector('.widget_search  input[name="s"]');

			if (search) {
				search = search.value
			}

			if (section.querySelector('.widget_categories .current-cat a')) {
				category = section.querySelector('.widget_categories .current-cat a')
				var href = category.getAttribute('href')
				var url = new URL(href);
				var pathParts = url.pathname.split('/');
				category = pathParts[pathParts.length - 2];
			}

			if (page_new) {
				page = parseInt(page_new) + 1;
			}

			let data_request = {
				action: 'blog_load_posts',
				search: search,
				category: category,
				page: page,
			}

			if (section.querySelector('.data-list')) {
				section.querySelector('.data-list').classList.add('active')
			}

			load_more.querySelector('button').setAttribute('disabled', 'disabled')
			load_more.querySelector('button').classList.add('active')

			if (language == 'en-US') {
				load_more.querySelector('button').textContent = 'Loading'
			} else {
				load_more.querySelector('button').textContent = 'Cargando'
			}

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
			let language = document.querySelector('html').getAttribute('lang')
			let slug_page = section.getAttribute('data-slug-page')
			let url = wcl_obj.site_url;

			if (language == 'en-US') {
				url += 'en/'
			}

			url += slug_page + '/';

			// category_slug
			if (data.category.length > 0 && data.category != 'all') {
				url = wcl_obj.site_url;

				if (language == 'en-US') {
					url = url + 'en/'
				}

				url += 'category/';
				url += data.category + '/';
			}

			// page
			if (data.page && data.page != 1) {
				url += 'page/' + data.page + '/';
			}

			window.history.pushState(wcl_obj.site_url, document.title, url);
		}
	}





	// wcl-project-symilar
	if (document.querySelector('.wcl-project-symilar')) {
		let sections = document.querySelectorAll('.wcl-project-symilar')

		// slider
		sections.forEach(section => {
			let swiper = new Swiper(section.querySelector('.data-slider'), {
				slidesPerView: 'auto',
				freeMode: {
					enabled: true,
					momentum: false,
				},
				//freeModeMomentum: false,
				spaceBetween: 58,
				speed: 1000,
				navigation: {
					nextEl: section.querySelector('.data-slider-arrow'),
				},
				breakpoints: {
					0: {
						spaceBetween: 20,
					},
					991: {
						spaceBetween: 50,
					},
					1199: {
						spaceBetween: 58
					},
				}
			});
		});
	}



	// wcl-project-hero
	if (document.querySelector('.wcl-project-hero')) {
		let section = document.querySelector('.wcl-project-hero')
		let window_height = window.innerHeight
		let window_width = window.innerWidth
		let swiper;

		const dataContent = section.querySelector('.data-slider-out').getAttribute('data-content');
		const parsedData = JSON.parse(dataContent);

		//console.log(parsedData)

		// function reinitializeSwiper_3() {
		// 	if (swiper) {
		// 		swiper.destroy(true, true);
		// 	}
		// 	initializeSwiper();
		// }

		setTimeout(() => {
			initializeSwiper();
		}, 0);

		window.addEventListener('resize', function () {

			if (parsedData.html) {
				section.querySelector('.data-slider-out').innerHTML = '';
				section.querySelector('.data-slider-out').innerHTML = parsedData.html;
			}
			setTimeout(() => {
				initializeSwiper();
			}, 0);
			//reinitializeSwiper_3();
		});

		function initializeSwiper() {
			window_height = window.innerHeight

			if (section.querySelector('.data-slider-item')) {

				if (window_height < 1040 && window_height >= 500) {
					applyStyles();
					updateMaxHeight();
				} else {
					let itemInnerElements = section.querySelectorAll('.data-slider-item-inner');
					let slides = section.querySelectorAll('.swiper-slide');
					let activeSlide = section.querySelector('.swiper-slide.swiper-slide-active');
					let slider = section.querySelector('.data-slider');
					let itemImgElements = section.querySelectorAll('.data-slider-item-img');
					let prevBtn = document.querySelector('.wcl-project-hero .data-slider-nav-btn.mod-prev');
					let nextBtn = document.querySelector('.wcl-project-hero .data-slider-nav-btn.mod-next');
					let styleElement = document.getElementById('customStyle_slider');

					if (prevBtn) {
						prevBtn.style.width = '';
						prevBtn.style.left = '';
					}

					if (nextBtn) {
						nextBtn.style.width = '';
						nextBtn.style.right = '';
					}

					slides.forEach(slide => {
						slide.style.width = '';
					});


					if (activeSlide) {
						activeSlide.style.width = '';
						activeSlide.style.padding = '';
					}

					if (slider) {
						slider.style.marginTop = '';
						slider.style.width = '';
						slider.style.padding = '';
					}
					itemInnerElements.forEach(itemInner => {
						itemInner.style.height = '';
					});

					slider.style.height = '';

					itemImgElements.forEach(itemImg => {
						itemImg.style.height = '';
					});

					if (styleElement) {
						styleElement.parentNode.removeChild(styleElement);
					}

					console.log(222)
				}

				if (window.matchMedia("(max-width: 575px)").matches) {
					let desiredWidth = window_width - 140; // Calculate the width
					section.querySelector('.data-slider').style.width = `${desiredWidth}px`;
					setSliderItemImgHeight()
				} else if (window.matchMedia("(max-width: 767px)").matches) {
					let desiredWidth = window_width - 250; // Calculate the width
					section.querySelector('.data-slider').style.width = `${desiredWidth}px`;
					setSliderItemImgHeight()
				} else if (window.matchMedia("(max-width: 991px)").matches) {
					let desiredWidth = window_width - 450; // Calculate the width
					section.querySelector('.data-slider').style.width = `${desiredWidth}px`;
					setSliderItemImgHeight()
				}

				reinitializeSwiper();
			}

		}

		function setSliderItemImgHeight() {
			const aspectRatio = 738 / 565;
			const sliderItemImgs = document.querySelectorAll('.data-slider-item');
			sliderItemImgs.forEach(item => {
				const width = section.querySelector('.data-slider').clientWidth;
				const height = Math.round(width / aspectRatio);
				item.querySelector('.data-slider-item-inner').style.height = `${height}px`;
				section.querySelector('.data-slider').style.height = `${height}px`;
			});
		}

		function isFirefox() {
			return typeof InstallTrigger !== 'undefined';
		}

		// reinitializeSwiper
		function reinitializeSwiper() {
			let loop = false
			let initialSlide = '';
			let slidesPerView = 'auto'

			if (section.querySelectorAll('.data-slider-item').length > 1) {
				loop = true
				initialSlide = (section.querySelectorAll('.data-slider-item').length / 2) + 1
			}

			if (isFirefox()) {
				loop = false
			}

			// slider
			swiper = new Swiper(section.querySelector('.data-slider'), {
				slidesPerView: slidesPerView,
				loop: loop,
				initialSlide: initialSlide,
				touchRatio: 0.2, // Adjust sensitivity of swiping
				spaceBetween: 50,
				speed: 900,
				// observer: true,
				// observeParents: true,
				navigation: {
					nextEl: section.querySelector('.mod-next'),
					prevEl: section.querySelector('.mod-prev'),
				},
				on: {
					init: function () {
						setTimeout(() => {
							section.querySelector('.data-slider').classList.add('active');
						}, 1);
					},
					afterInit: function () {
						setTimeout(() => {
							section.classList.add('visible-2');
						}, 1);
					},
				},
				breakpoints: {
					0: {
						spaceBetween: 20,
					},
					575: {
						spaceBetween: 25,
					},
					767: {
						spaceBetween: 80,
					},
					991: {
						spaceBetween: 80,
					},
				}
			});

			swiper.on('slideChange', function () {
				var currentIndex = swiper.realIndex;
				// console.log(currentIndex)
				// console.log(swiper.slides.length)
				if (currentIndex === swiper.slides.length - 3) {
					// Slide to the first slide if the current slide is the last one
					swiper.slideTo(0);
				}
			});
		}

		function getVh(targetPx) {
			const vhContext = (1040 * 0.01) * 1; // 1vh = 1% of 970px
			return Math.round((targetPx / vhContext) * (window.innerHeight * 0.01));
		}

		function applyStyles() {
			if (window.matchMedia("(max-width: 991px)").matches) {
				return
			}

			const itemInnerElements = section.querySelectorAll('.data-slider-item-inner');
			const slides = section.querySelectorAll('.swiper-slide');
			const activeSlide = section.querySelector('.swiper-slide.swiper-slide-active');
			const slider = section.querySelector('.data-slider');
			const itemImgElements = section.querySelectorAll('.data-slider-item-img');
			const prevBtn = document.querySelector('.wcl-project-hero .data-slider-nav-btn.mod-prev');
			const nextBtn = document.querySelector('.wcl-project-hero .data-slider-nav-btn.mod-next');
			let styleElement = document.getElementById('customStyle_slider');

			//window_height = window.innerHeight

			if (styleElement) {
				styleElement.parentNode.removeChild(styleElement);
			}

			if (prevBtn) {
				prevBtn.style.width = `${getVh(110)}px`; // Example style
				prevBtn.style.left = `${90 + ((90 - getVh(90)) * 0.15)}px`; // Example style
			}

			if (nextBtn) {
				nextBtn.style.width = `${getVh(110)}px`; // Example style
				nextBtn.style.right = `${90 + ((90 - getVh(90)) * 0.15)}px`; // Example style
			}

			slides.forEach(slide => {
				slide.style.width = `${getVh(300)}px`;
			});

			if (activeSlide) {
				activeSlide.style.width = `${getVh(938)}px`;
				activeSlide.style.padding = `0 ${getVh(100)}px`;
			}

			if (slider) {
				slider.style.marginTop = `${getVh(90)}px`;
				slider.style.width = `${getVh(1138)}px`;
				slider.style.padding = `0 ${getVh(100)}px`;
			}

			itemInnerElements.forEach(itemInner => {
				itemInner.style.height = `${getVh(565)}px`
			});

			slider.style.height = `${getVh(565)}px`

			itemImgElements.forEach(itemImg => {
				itemImg.style.height = `${getVh(200)}px`;
			});

			const style = document.createElement('style');
			style.id = 'customStyle_slider';

			let index_q = getVh(100);

			let q1 = 33 - getVh(33);
			q1 = q1 * 3.3

			let q2 = 200 - getVh(200)
			q2 = getVh(200) + (q2 * (0.5));

			let q3 = 28

			if (window_height < 600) {
				 q3 = getVh(35) + 3
			}

			style.textContent = `
				.wcl-project-hero .data-slider::before {
					margin-left: ${q2}px; 
				}
				.wcl-project-hero .data-slider::after {
					left: ${getVh(-33) - q1}px; 
					top: -${q3}px; 
					}
				`;
			document.head.appendChild(style);
		}


		function updateMaxHeight() {
			let dataInner = document.querySelectorAll('.data-slider-item-inner');

			if (window.matchMedia("(max-width: 991px)").matches) {
				return
			}

			dataInner.forEach(element => {
				let viewportHeight = window.innerHeight;
				let maxHeight = '';

				if (viewportHeight >= 500) {
					if (window.matchMedia("(max-width: 1199px)").matches) {
						// if (viewportHeight <= 800) {
						// 	maxHeight = viewportHeight - (170 + 50 + 50) - 0;
						// } else {
						// 	maxHeight = viewportHeight - (170 + 50 + 50) - 0;
						// }

						if (viewportHeight <= 800) {
							maxHeight = viewportHeight - 350 - 37;
						} else {
							maxHeight = viewportHeight - 350 - 62;
						}
					} else if (window.matchMedia("(max-width: 1600px)").matches) {
						if (viewportHeight <= 800) {
							maxHeight = viewportHeight - 350 - 37;
						} else {
							maxHeight = viewportHeight - 350 - 62;
						}
					} else {
						if (viewportHeight <= 800) {
							maxHeight = viewportHeight - 350 - 75;
						} else {
							maxHeight = viewportHeight - 350 - 100
						}
					}

					element.style.maxHeight = `${maxHeight}px`;

					section.querySelector('.data-slider').style.maxHeight = `${maxHeight}px`;
				}
			});
		}
	}






	// wcl-header
	if (document.querySelector('.wcl-header')) {
		let section = document.querySelector('.wcl-header')


		// btn-menu
		section.querySelectorAll('.data-btn-menu').forEach(element => {
			element.addEventListener('click', function (e) {
				if (section.querySelector('.data-nav').classList.contains('active')) {
					this.classList.remove('active')
					section.querySelector('.data-nav').classList.remove('active')
					document.querySelector('body, html').classList.remove('overflow-hidden')
				} else {
					this.classList.add('active')
					section.querySelector('.data-nav').classList.add('active')
					document.querySelector('body, html').classList.add('overflow-hidden')
				}
			})
		});


		// data-menu
		if (window.matchMedia("(max-width: 1199px)").matches) {
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
