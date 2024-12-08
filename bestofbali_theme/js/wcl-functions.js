



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





	// wcl-acf-block-13

	if (document.querySelector('.wcl-acf-block-13')) {
		let sections = document.querySelectorAll('.wcl-acf-block-13');

		sections.forEach(element => {
			let loop = true

			if (window.matchMedia("(min-width: 1000px)").matches) {
				if (element.classList.contains('mod-default')) {
					if (items.length <= 1) {
						loop = false
					}
				}
			}

			let slider = element.querySelector('.data-list')
			let swiper = new Swiper(slider, {
				slidesPerView: 1,
				spaceBetween: 0,
				loop: loop,
				navigation: {
					nextEl: element.querySelector('.data-list-nav-btn.mod-next'),
					prevEl: element.querySelector('.data-list-nav-btn.mod-prev'),
				},
				pagination: {
					el: element.querySelector('.data-list-pagination'),
					clickable: true,
					dynamicBullets: true,
					dynamicMainBullets: 1,
				},
			});
		});
	}




	/* 
	wcl-acf-block-13
	*/
	if (document.querySelector('.wcl-acf-block-13')) {
		let sections = document.querySelectorAll('.wcl-acf-block-13');

		sections.forEach(element => {
			let trigger = element.querySelector('.wcl-block-3.js-trigger');
			let target = element.querySelector('.wcl-block-3.js-target');

			if (trigger) {
				trigger.querySelector('.q3-head').addEventListener('click', function () {
					if (target) {
						let state = false;

						if (this.classList.contains('active')) {
							this.classList.remove('active')
							state = false;
						} else {
							this.classList.add('active')
							state = true;
						}

						let item = target.querySelector('.q3-rating-out .q3-rating-list')
						let maxHeight = 0;

						let height = item.offsetHeight;
						maxHeight = height + 30

						if (state) {
							target.querySelector('.q3-rating-out').style.maxHeight = maxHeight + "px";
							target.querySelector('.q3-rating').style.maxHeight = maxHeight + "px";
						} else {
							target.querySelector('.q3-rating-out').style.maxHeight = null;
							target.querySelector('.q3-rating').style.maxHeight = null;
						}

						target.querySelector('.q3-rating-out').classList.toggle('active')

					}
				});
			}
		});
	}


	// wcl-acf-block-6

	if (document.querySelector('.wcl-acf-block-6')) {
		let sections = document.querySelectorAll('.wcl-acf-block-6');

		sections.forEach(element => {
			if (element.classList.contains('mod-slider')) {
				let slider = element.querySelector('.data-list')
				let swiper = new Swiper(slider, {
					slidesPerView: 3,
					spaceBetween: 10,
					loop: true,
					navigation: {
						nextEl: element.querySelector('.data-list-nav-btn.mod-next'),
						prevEl: element.querySelector('.data-list-nav-btn.mod-prev'),
					},
					pagination: {
						el: element.querySelector('.data-list-pagination'),
						clickable: true,
						dynamicBullets: true,
						dynamicMainBullets: 1,
					},
					breakpoints: {
						0: {
							slidesPerView: 1,
						},
						575: {
							slidesPerView: 2,
						},
						767: {
							slidesPerView: 3,
						},
					}
				});
			}
		});
	}



	// wcl-acf-block-3

	if (document.querySelector('.wcl-acf-block-3')) {
		let sections = document.querySelectorAll('.wcl-acf-block-3');

		sections.forEach(element => {
			if (element.classList.contains('mod-slider')) {
				let loop = true

				if (window.matchMedia("(min-width: 1000px)").matches) {
					if (element.classList.contains('mod-default')) {
						if (items.length <= 1) {
							loop = false
						}
					}
				}

				let slider = element.querySelector('.data-list')
				let swiper = new Swiper(slider, {
					slidesPerView: 1,
					spaceBetween: 0,
					loop: loop,
					navigation: {
						nextEl: element.querySelector('.data-list-nav-btn.mod-next'),
						prevEl: element.querySelector('.data-list-nav-btn.mod-prev'),
					},
					pagination: {
						el: element.querySelector('.data-list-pagination'),
						clickable: true,
						dynamicBullets: true,
						dynamicMainBullets: 1,
					},
					breakpoints: {
						0: {
							spaceBetween: 10,
						},
						575: {
							spaceBetween: 0,
						},
					}
				});
			}
		});
	}




	// wcl-search-page

	if (document.querySelector('.wcl-search-page')) {
		let section = document.querySelector('.wcl-search-page')
		let btn_load_more = section.querySelector('.wcl-load-more')

		// load_post

		function load_post(paged_new) {
			let paged = -1;

			let search = section.getAttribute('data-search-query');

			if (!search) {
				search = '';
			}

			let category = section.getAttribute('data-cat-query');

			if (!category) {
				category = '';
			}

			if (paged_new) {
				paged = paged_new;
			}

			let data_req = {
				action: 'search_load_post',
				search: search,
				category: category,
				paged: parseInt(paged) + 1,
			}

			section.querySelector('.data-list').classList.add('active')
			btn_load_more.setAttribute('disabled', 'disabled')

			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);

					if (paged_new) {
						section.querySelector('.data-list').insertAdjacentHTML('beforeend', data.posts);
						section.querySelector('.wcl-load-more .m5-container').innerHTML = data.button;
					} else {
						section.querySelector('.data-list').innerHTML = data.posts;
						section.querySelector('.wcl-load-more .m5-container').innerHTML = data.button;
					}
				};
			};
			data_req = new URLSearchParams(data_req).toString();
			xhr.send(data_req);
		}

		// btn_load_more

		if (btn_load_more) {
			btn_load_more.addEventListener("click", function (e) {
				e.preventDefault();
				if (e.target.classList.contains('m5-btn')) {
					if (e.target.getAttribute("disable") == 'disable') {
						return false;
					}

					let paged = e.target.getAttribute("data-page");
					load_post(paged);
				}
			});
		}
	}




	// wcl-acf-block-7.mod-slider

	if (document.querySelector('.wcl-acf-block-7.mod-slider')) {
		let sections = document.querySelectorAll('.wcl-acf-block-7.mod-slider');


		function swiper_init(element) {
			let items = element.querySelectorAll('.data-item')
			let init = true
			let loop = true
			let slidesPerView = 4
			let spaceBetween = 10


			if (window.matchMedia("(max-width: 1200px)").matches) {
				slidesPerView = 3
			}

			if (window.matchMedia("(max-width: 991px)").matches) {
				slidesPerView = 2
			}

			if (window.matchMedia("(max-width: 575px)").matches) {
				slidesPerView = 1
				spaceBetween = 12
			}

			if (document.querySelector('.wcl-destination')) {
				slidesPerView = 3
			}

			if (window.matchMedia("(max-width: 1200px)").matches) {
				if (items.length > slidesPerView) {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.add('active')
					}
				} else {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.remove('active')
						loop = false
					}
				}
			}
			if (window.matchMedia("(max-width: 767px)").matches) {
				if (items.length > slidesPerView) {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.add('active')
					}
				} else {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.remove('active')
						loop = false
					}
				}
			}
			if (window.matchMedia("(max-width: 575px)").matches) {
				if (items.length > slidesPerView) {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.add('active')
					}
				} else {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.remove('active')
						loop = false
					}
				}
			}

			if (window.matchMedia("(min-width: 1200px)").matches) {
				if (items.length > slidesPerView) {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.add('active')
					}
				} else {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.remove('active')
						loop = false
					}
				}
			}

			if (init) {
				let slider = element.querySelector('.data-list')
				let swiper = new Swiper(slider, {
					slidesPerView: slidesPerView,
					spaceBetween: spaceBetween,
					loop: loop,
					navigation: {
						nextEl: element.querySelector('.data-list-nav-btn.mod-next'),
						prevEl: element.querySelector('.data-list-nav-btn.mod-prev'),
					},
					pagination: {
						el: element.querySelector('.data-list-pagination'),
						clickable: true,
						dynamicBullets: true,
						dynamicMainBullets: 1,
					},
					breakpoints: {
						0: {
							slidesPerView: 'auto',
							spaceBetween: spaceBetween,
						},
						575: {
							slidesPerView: slidesPerView,
							spaceBetween: spaceBetween,
						},
						767: {
							slidesPerView: slidesPerView,
						},
						1200: {
							slidesPerView: slidesPerView,
						},
					}
				});
			}
		}

		window.addEventListener('resize', function () {
			sections.forEach(element => {
				if (element.querySelector('.data-list')) {
					if (element.querySelector('.data-list').swiper) {
						element.querySelector('.data-list').swiper.destroy();
					}
					swiper_init(element);
				}

			});
		});

		sections.forEach(element => {
			if (element.querySelector('.data-list')) {
				swiper_init(element);
			}
		});
	}




	// wcl-acf-block-2.mod-slider

	if (document.querySelector('.wcl-acf-block-2.mod-slider')) {
		let sections = document.querySelectorAll('.wcl-acf-block-2.mod-slider');

		function swiper_init(element) {
			let items = element.querySelectorAll('.data-item')
			let init = true
			let loop = true
			let slidesPerView = 3
			let spaceBetween = 10

			if (element.classList.contains('mod-4-item')) {
				slidesPerView = 4
				spaceBetween = 10
			}

			if (window.matchMedia("(max-width: 1199px)").matches) {
				slidesPerView = 2
			}

			if (window.matchMedia("(max-width: 767px)").matches) {
				slidesPerView = 2
			}

			if (window.matchMedia("(max-width: 575px)").matches) {
				slidesPerView = 1
				spaceBetween = 12

				if (element.classList.contains('mod-destination')) {
					init = false
				}
			}

			if (element.classList.contains('mod-destination')) {
				init = false
			}

			if (window.matchMedia("(min-width: 767px)").matches && document.querySelector('.wcl-destination')) {
				slidesPerView = 2
			}

			if (window.matchMedia("(max-width: 1200px)").matches) {
				if (items.length > slidesPerView) {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.add('active')
					}
				} else {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.remove('active')
						loop = false
					}
				}
			}
			if (window.matchMedia("(max-width: 1025px)").matches) {
				if (items.length > slidesPerView) {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.add('active')
					}
				} else {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.remove('active')
						loop = false
					}
				}
			}
			if (window.matchMedia("(max-width: 767px)").matches) {
				if (items.length > slidesPerView) {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.add('active')
					}
				} else {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.remove('active')
						loop = false
					}
				}
			}

			if (window.matchMedia("(max-width: 575px)").matches) {
				if (items.length > slidesPerView) {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.add('active')
					}
				} else {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.remove('active')
						loop = false
					}
				}
			}

			if (window.matchMedia("(min-width: 1200px)").matches) {
				if (items.length > slidesPerView) {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.add('active')
					}
				} else {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.remove('active')
						loop = false
					}
				}
			}

			if (init) {
				let slider = element.querySelector('.data-list')
				let swiper = new Swiper(slider, {
					slidesPerView: slidesPerView,
					spaceBetween: spaceBetween,
					loop: loop,
					navigation: {
						nextEl: element.querySelector('.data-list-nav-btn.mod-next'),
						prevEl: element.querySelector('.data-list-nav-btn.mod-prev'),
					},
					pagination: {
						el: element.querySelector('.data-list-pagination'),
						clickable: true,
						dynamicBullets: true,
						dynamicMainBullets: 1,
					},
					breakpoints: {
						0: {
							slidesPerView: slidesPerView,
							spaceBetween: spaceBetween,
						},
						575: {
							slidesPerView: slidesPerView,
							spaceBetween: spaceBetween,
						},
						767: {
							slidesPerView: slidesPerView,
						},
						1025: {
							slidesPerView: slidesPerView,
						},
						1199: {
							slidesPerView: slidesPerView,
						},
					}
				});
			}
		}

		window.addEventListener('resize', function () {
			sections.forEach(element => {
				if (element.querySelector('.data-list').swiper) {
					element.querySelector('.data-list').swiper.destroy();
				}
				swiper_init(element);
			});
		});

		sections.forEach(element => {
			swiper_init(element);
		});
	}





	// wcl-acf-block-5.mod-slider

	if (document.querySelector('.wcl-acf-block-5.mod-slider')) {
		let sections = document.querySelectorAll('.wcl-acf-block-5.mod-slider');


		function swiper_init(element) {
			let items = element.querySelectorAll('.data-item')
			let init = true
			let loop = true
			let slidesPerView = 4
			let spaceBetween = 10


			if (window.matchMedia("(max-width: 1200px)").matches) {
				slidesPerView = 3
			}
			if (window.matchMedia("(max-width: 767px)").matches) {
				slidesPerView = 2
			}
			if (window.matchMedia("(max-width: 575px)").matches) {
				slidesPerView = 1
				spaceBetween = 12
			}

			if (document.querySelector('.wcl-destination')) {
				slidesPerView = 3
			}

			if (window.matchMedia("(max-width: 1200px)").matches) {
				if (items.length > slidesPerView) {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.add('active')
					}
				} else {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.remove('active')
						loop = false
					}
				}
			}
			if (window.matchMedia("(max-width: 767px)").matches) {
				if (items.length > slidesPerView) {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.add('active')
					}
				} else {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.remove('active')
						loop = false
					}
				}
			}
			if (window.matchMedia("(max-width: 575px)").matches) {
				if (items.length > slidesPerView) {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.add('active')
					}
				} else {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.remove('active')
						loop = false
					}
				}
			}

			if (window.matchMedia("(min-width: 1200px)").matches) {
				if (items.length > slidesPerView) {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.add('active')
					}
				} else {
					if (element.querySelector('.data-list-pagination-out')) {
						element.querySelector('.data-list-pagination-out').classList.remove('active')
						loop = false
					}
				}
			}

			if (init) {
				let slider = element.querySelector('.data-list')
				let swiper = new Swiper(slider, {
					slidesPerView: slidesPerView,
					spaceBetween: spaceBetween,
					loop: loop,
					navigation: {
						nextEl: element.querySelector('.data-list-nav-btn.mod-next'),
						prevEl: element.querySelector('.data-list-nav-btn.mod-prev'),
					},
					pagination: {
						el: element.querySelector('.data-list-pagination'),
						clickable: true,
						dynamicBullets: true,
						dynamicMainBullets: 1,
					},
					breakpoints: {
						0: {
							slidesPerView: 'auto',
							spaceBetween: spaceBetween,
						},
						575: {
							slidesPerView: slidesPerView,
							spaceBetween: spaceBetween,
						},
						767: {
							slidesPerView: slidesPerView,
						},
						1200: {
							slidesPerView: slidesPerView,
						},
					}
				});
			}
		}

		window.addEventListener('resize', function () {
			sections.forEach(element => {
				if (element.querySelector('.data-list')) {
					if (element.querySelector('.data-list').swiper) {
						element.querySelector('.data-list').swiper.destroy();
					}
					swiper_init(element);
				}

			});
		});

		sections.forEach(element => {
			if (element.querySelector('.data-list')) {
				swiper_init(element);
			}
		});
	}




	// wcl-destination

	if (document.querySelector('.wcl-destination')) {
		let section = document.querySelector('.wcl-destination')

		// Fixed on Scroll

		let sidebar = section.querySelector('.m4-sidebar')
		let banner = section.querySelector('.m4-b2-img')
		let banner_top = banner.parentElement.offsetTop + section.offsetTop
		let content = section.querySelector('.m4-col')
		let banner_bot = content.offsetTop + content.clientHeight + section.offsetTop
		banner_bot = banner_bot - banner.clientHeight

		function update_banner_position() {

			let scrolled = window.scrollY
			banner_top = banner.parentElement.offsetTop + section.offsetTop
			banner_bot = content.offsetTop + content.clientHeight + section.offsetTop
			banner_bot = banner_bot - banner.clientHeight

			if (document.querySelector('body').classList.contains('admin-bar')) {

				if (scrolled + 81 - 32 >= banner_top && scrolled + 81 - 32 <= banner_bot) {
					banner.classList.add('active')
					banner.classList.remove('active-2')
					banner.style.top = 81 + 'px'
				} else {
					if (scrolled >= banner_top) {
						banner.classList.remove('active')
						banner.classList.add('active-2')

					} else {
						banner.classList.remove('active')
						banner.style.top = 0 + 'px'
					}
				}
			} else {
				if (scrolled + 81 >= banner_top && scrolled + 81 <= banner_bot) {
					banner.classList.add('active')
					banner.classList.remove('active-2')
					banner.style.top = 81 + 'px'
				} else {
					if (scrolled >= banner_top) {
						banner.classList.remove('active')
						banner.classList.add('active-2')
					} else {
						banner.classList.remove('active')
						banner.style.top = 0 + 'px'
					}
				}
			}
		}



		if (section.querySelector('.wcl-destination .m4-b2-img')) {
			if (window.matchMedia("(min-width: 1200px)").matches) {

				update_banner_position();

				window.addEventListener('scroll', function (e) {
					update_banner_position();
				});

				window.addEventListener('resize', update_banner_position);
			}
		}



		if (section.querySelector('.wcl-acf-block-9')) {
			section.querySelectorAll('.wcl-acf-block-9').forEach(element => {
				if (element.querySelector('.data-head-rating')) {
					element.querySelector('.data-head-rating').addEventListener('click', function () {
						let state = false;

						if (this.classList.contains('active')) {
							this.classList.remove('active')
							state = false;
						} else {
							this.classList.add('active')
							state = true;
						}

						let item = element.querySelector('.data-rating-out .data-rating-list')
						let maxHeight = 0;
						let height = item.offsetHeight;
						maxHeight = height + 30

						if (state) {
							element.querySelector('.data-rating-out').style.maxHeight = maxHeight + "px";
							element.querySelector('.data-rating').style.maxHeight = maxHeight + "px";
						} else {
							element.querySelector('.data-rating-out').style.maxHeight = null;
							element.querySelector('.data-rating').style.maxHeight = null;
						}

						element.querySelector('.data-rating-out').classList.toggle('active')
					});
				}
			});
		}
	}



	// wcl-search

	if (document.querySelector('.wcl-search')) {
		let section = document.querySelector('.wcl-search')

		// Search Scrolled
		let scrollPosition = window.scrollY;

		if (scrollPosition > 0) {
			section.classList.add("scrolled");
		} else {
			section.classList.remove("scrolled");
		}

		window.addEventListener("scroll", function (e) {
			var scrollPosition = window.scrollY;

			if (scrollPosition > 0) {
				section.classList.add("scrolled");
			} else {
				section.classList.remove("scrolled");
			}
		});

		document.querySelector('.wcl-header .data-search').addEventListener('click', function (e) {
			if (section.classList.contains('active')) {
				section.classList.remove('active')
			} else {
				section.classList.add('active')
			}
		})

		section.querySelector('.data-close').addEventListener('click', function (e) {
			if (section.classList.contains('active')) {
				section.classList.remove('active')
			}
		})

		document.addEventListener('click', function (e) {
			if (e.target.closest('.wcl-search') == null && e.target.closest('.toggle-search') == null) {
				section.classList.remove('active')
			}
		})
	}


	// wcl-newsletter

	if (document.querySelector('.wcl-newsletter')) {
		let section = document.querySelector('.wcl-newsletter')

		section.querySelector('.data-form').addEventListener('submit', function (e) {
			e.preventDefault();
			let form = this;
			let email = form.querySelector('input[name="email"]').value

			let data_req = {
				action: 'wcl_subscribe',
				email: email,
			}

			if (form.querySelector('.data-form-note')) {
				form.querySelector('.data-form-note').remove()
			}

			form.querySelector('button').setAttribute('disabled', 'disabled')

			var xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);

					form.querySelector('button').removeAttribute('disabled')

					if (data['message']) {
						let tag = '<div class="data-form-note">' + data['message'] + '</div>';
						form.insertAdjacentHTML('beforeend', tag)
					}
				}
			};

			data_req = new URLSearchParams(data_req).toString();
			xhr.send(data_req);
		});
	}



	// wcl-header

	if (document.querySelector('.wcl-header')) {
		let section = document.querySelector('.wcl-header');

		// Header Scrolled
		let scrollPosition = window.scrollY;

		if (scrollPosition > 0) {
			section.classList.add("scrolled");
		} else {
			section.classList.remove("scrolled");
		}

		window.addEventListener("scroll", function (e) {
			var scrollPosition = window.scrollY;

			if (scrollPosition > 0) {
				section.classList.add("scrolled");
			} else {
				section.classList.remove("scrolled");
			}
		});

		section.querySelector('.data-btn-menu').addEventListener('click', function (e) {
			if (this.classList.contains('active')) {
				this.classList.remove('active')
				this.closest('.wcl-header').classList.remove('active')
				section.querySelector('.data-nav').classList.remove('active')
				document.querySelector('body').classList.remove('overflow-hidden')

			} else {
				this.classList.add('active')
				this.closest('.wcl-header').classList.add('active')
				section.querySelector('.data-nav').classList.add('active')
				document.querySelector('body').classList.add('overflow-hidden')
			}
		})


		section.querySelectorAll('.data-menu a').forEach(element => {
			element.addEventListener('click', function (e) {
				if (this.getAttribute('href') == '#') {
					e.preventDefault()
				}
			})
		});

		section.querySelectorAll('.data-menu > li.menu-item-has-children > a').forEach(element => {
			element.addEventListener('click', function (e) {
				e.preventDefault()

				section.querySelectorAll('li.active').forEach(element2 => {
					if (this.parentElement != element2) {
						element2.classList.remove('active')
						element2.querySelector('.sub-menu').style.maxHeight = null
					}
				});

				let sub_menu = this.parentElement.querySelector('.sub-menu')
				let maxHeight = 0;

				this.parentElement.querySelectorAll('li').forEach((listItem, index) => {
					let listItemStyles = window.getComputedStyle(listItem);

					let height = listItem.offsetHeight;
					let marginBottom = parseFloat(listItemStyles.marginBottom);
					maxHeight += height + marginBottom
				});

				if (this.parentElement.classList.contains('active')) {
					this.parentElement.classList.remove('active')
				} else {
					this.parentElement.classList.add('active')
				}

				if (sub_menu.style.maxHeight) {
					sub_menu.style.maxHeight = null;
				} else {
					sub_menu.style.maxHeight = maxHeight + "px";
				}
			})
		});
	}


});