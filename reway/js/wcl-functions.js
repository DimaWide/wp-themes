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





	// wpcf7

	if (document.querySelector('.wpcf7')) {
		let phoneInputs = document.querySelectorAll('input[type="tel"]');

		phoneInputs.forEach(element => {
			element.addEventListener("input", function (event) {
				var inputValue = event.target.value;
				var validCharacters = /^[+\d()-\s]*$/;

				if (!validCharacters.test(inputValue)) {
					event.target.value = inputValue.slice(0, -1);
				}
			});
		});
	}






	// wcl-header .data-lang

	if (document.querySelector('.wcl-header .data-lang')) {
		let section = document.querySelector('.wcl-header .data-lang')

		document.addEventListener('click', function (e) {
			if (!e.target.closest('.wcl-header .data-lang')) {
				section.querySelector('.wcl-cmp-4-lang').classList.remove('active')
			}
		})

		section.addEventListener('click', function (e) {
			if (!e.target.closest('.cmp4-item')) {
				if (section.querySelector('.wcl-cmp-4-lang').classList.contains('active')) {
					section.querySelector('.wcl-cmp-4-lang').classList.remove('active')
				} else {
					section.querySelector('.wcl-cmp-4-lang').classList.add('active')
				}
			}
		})

		section.querySelectorAll('.cmp4-item').forEach(element => {
			element.addEventListener('click', function (e) {
				e.preventDefault()

				section.querySelectorAll('.cmp4-item').forEach(element => {
					if (element != this) {
						element.classList.remove('active')
					}
				});

				this.classList.add('active')
				section.querySelector('.cmp4-selected').textContent = this.textContent

				if (section.querySelector('.wcl-cmp-4-lang').classList.contains('active')) {
					section.querySelector('.wcl-cmp-4-lang').classList.remove('active')
				} else {
					section.querySelector('.wcl-cmp-4-lang').classList.add('active')
				}

				window.location.href = this.querySelector('a').getAttribute('href');
			})
		});

	}



	// wcl-acf-block-11

	if (document.querySelector('.wcl-acf-block-11')) {
		let sections = document.querySelectorAll('.wcl-acf-block-11')

		// slider
		sections.forEach(section => {
			let swiper = new Swiper(section.querySelector('.data-slider'), {
				slidesPerView: 'auto',
				spaceBetween: 29,
				speed: 500,
				breakpoints: {
					0: {
						spaceBetween: 19,
					},
					776: {
						spaceBetween: 29
					},
				}
			});
		});
	}



	// wcl-acf-block-10

	if (document.querySelector('.wcl-acf-block-10')) {
		let sections = document.querySelectorAll('.wcl-acf-block-10')

		sections.forEach(section => {

			// video play
			if (section.querySelector('.data-video')) {
				let video = section.querySelector('.data-video video')

				section.querySelector('.data-video').addEventListener('click', function (e) {
					if (video && !video.paused) {
						video.pause();
						section.querySelector('.data-video').classList.add("mod-pause");
					} else {
						video.play();
						section.querySelector('.data-video').classList.remove("mod-pause");
					}
				})
			}
		});
	}





	// wcl-acf-block-1

	if (document.querySelector('.wcl-acf-block-1')) {
		let sections = document.querySelectorAll('.wcl-acf-block-1')

		sections.forEach(section => {

			// video play
			if (section.querySelector('.data-video')) {
				let video = section.querySelector('.data-video video')

				video.addEventListener("play", function () {
					video.classList.add("active");
					section.querySelector('.data-video-btn').classList.add('active')
				});

				video.addEventListener("pause", function () {
					video.classList.remove("active");
					section.querySelector('.data-video-btn').classList.remove('active')
				});

				section.querySelector('.data-video-btn').addEventListener('click', function (e) {
					if (video && !video.paused) {
						video.pause();
					} else {
						video.play();
					}
				})
			}


			// slider
			if (section.querySelector('.data-slider .data-slider-item')) {
				let swiper = new Swiper(section.querySelector('.data-slider'), {
					slidesPerView: 1,
					spaceBetween: 0,
					speed: 500,
					on: {
						slideChange: function (swiper) {
							let activeIndex = swiper.activeIndex;
							let navItems = section.querySelectorAll('.data-slider-nav-item');

							navItems.forEach(function (item) {
								item.classList.remove('active');
							});

							navItems[activeIndex].classList.add('active');

							section.querySelector('.data-slider-nav-label').textContent = navItems[activeIndex].textContent;
						}
					}
				});

				if (section.querySelector('.data-slider-nav .data-slider-nav-item')) {
					var navItems = section.querySelectorAll('.data-slider-nav-item');

					navItems.forEach(function (navItem) {
						navItem.addEventListener('click', function () {
							let index = Array.prototype.slice.call(navItems).indexOf(navItem) + 1;
							swiper.slideTo(index);

							let text = this.textContent;
							section.querySelector('.data-slider-nav-label').textContent = text;

							navItems.forEach(element => {
								element.classList.remove('active')
							});

							this.classList.add('active')
						});
					});
				}
			}

			// arrow
			if (section.querySelector('.data-arrow')) {
				section.querySelector('.data-arrow').addEventListener('click', function (e) {
					let currentSection = this.closest('.wcl-acf-block-1');

					let nextSection = currentSection.nextElementSibling;
					if (nextSection) {
						let nextSectionOffset = '';

						if (window.matchMedia("(min-width: 1199px)").matches) {
							nextSectionOffset = nextSection.offsetTop - 90;
						} else if (window.matchMedia("(min-width: 776px)").matches) {
							nextSectionOffset = nextSection.offsetTop - 90;
						} else {
							nextSectionOffset = nextSection.offsetTop - 40;
						}

						window.scrollTo({
							top: nextSectionOffset,
							behavior: 'smooth'
						});
					}
				})
			}
		});
	}




	// wcl-acf-block-8

	if (document.querySelector('.wcl-acf-block-8')) {
		let sections = document.querySelectorAll('.wcl-acf-block-8')

		// slider
		sections.forEach(section => {
			let swiper = new Swiper(section.querySelector('.data-slider'), {
				slidesPerView: 1,
				loop: true,
				spaceBetween: 28,
				speed: 600,
				navigation: {
					nextEl: section.querySelector('.mod-next'),
					prevEl: section.querySelector('.mod-prev'),
				},
				breakpoints: {
					0: {
						spaceBetween: 19,
					},
					776: {
						spaceBetween: 28
					},
				}
			});
		});
	}





	// wcl-header

	if (document.querySelector('.wcl-header')) {
		let section = document.querySelector('.wcl-header')

		section.querySelectorAll('.hamburger').forEach(element => {
			element.addEventListener('click', function (e) {
				if (section.querySelector('.data-nav').classList.contains('active')) {
					this.classList.remove('active')
					section.classList.remove('active')
					section.querySelector('.data-nav').classList.remove('active')
					document.querySelector('body, html').classList.remove('overflow-hidden')
				} else {
					this.classList.add('active')
					section.classList.add('active')
					section.querySelector('.data-nav').classList.add('active')
					document.querySelector('body, html').classList.add('overflow-hidden')
				}
			})

		});
	}




	// js-popup-open

	if (document.querySelector('.js-popup-open')) {
		if (document.querySelector('.wcl-popup')) {
			let items = document.querySelectorAll('.js-popup-open')

			items.forEach(element => {
				element.addEventListener('click', function (e) {
					e.preventDefault()

					let target_popup_id = this.getAttribute('data-target');
					target_popup = document.querySelector('[data-id="' + target_popup_id + '"]');

					if (!document.querySelector('body').classList.contains('mod-popup-make-a-reservation')) {
						if (target_popup) {
							if (document.querySelector('.wcl-header').querySelector('.data-nav').classList.contains('active')) {
								document.querySelector('.wcl-header').querySelector('.hamburger.active').classList.remove('active')
								document.querySelector('.wcl-header').classList.remove('active')
								document.querySelector('.wcl-header').querySelector('.data-nav').classList.remove('active')
							}

							target_popup.classList.add('active')

							document.querySelector('body, html').classList.add('overflow-hidden')

							if (target_popup_id == 'make-a-reservation') {
								document.querySelector('body').classList.add('mod-popup-make-a-reservation')
							}
						}
					}
				})
			});
		}
	}


	// wcl-popup

	if (document.querySelector('.wcl-popup')) {
		let section = document.querySelector('.wcl-popup')

		document.querySelectorAll('.wcl-popup').forEach(element => {
			element.querySelector('.data-close').addEventListener('click', function (e) {
				element.classList.remove('active')
				document.querySelector('body, html').classList.remove('overflow-hidden')
				document.querySelector('body').classList.remove('mod-popup-make-a-reservation')
			})

			element.querySelector('.data-overlay').addEventListener('click', function (e) {
				element.classList.remove('active')
				document.querySelector('body, html').classList.remove('overflow-hidden')
				document.querySelector('body').classList.remove('mod-popup-make-a-reservation')
			})

			element.querySelector('.data-inner-out').addEventListener('click', function (e) {
				if (!e.target.closest('.data-inner')) {
					element.classList.remove('active')
					document.querySelector('body, html').classList.remove('overflow-hidden')
					document.querySelector('body').classList.remove('mod-popup-make-a-reservation')
				}
			})
		});
	}



	// wcl-acf-block-2

	if (document.querySelector('.wcl-acf-block-2')) {
		let sections = document.querySelectorAll('.wcl-acf-block-2')

		// Anchor
		sections.forEach(section => {
			section.querySelectorAll('.data-item').forEach(element => {
				element.addEventListener('click', function (event) {
					let targetId = this.getAttribute('data-target');
					let targetElement = document.querySelector('[data-id="' + targetId + '"]');

					if (targetElement) {
						let computedStyle = window.getComputedStyle(targetElement);
						let marginTop = computedStyle.getPropertyValue('margin-top').replace(/\D/g, '');

						window.scrollTo({
							top: targetElement.offsetTop - marginTop,
							behavior: 'smooth'
						});
					}
				})
			});
		});
	}

});