const ready = (callback) => {
	if (document.readyState != "loading") callback();
	else document.addEventListener("DOMContentLoaded", callback);
}

ready(() => {

	let header = document.querySelector('.wcl-header')

	if (document.querySelector('.wcl-instagram')) {
		let section = document.querySelector('.wcl-instagram')
		window.sbi_custom_js = function () {
			let items = section.querySelectorAll('.sbi_item')
			let items_2 = section.querySelectorAll('.data-item')
			if (items.length) {
				items_2[0].appendChild(items[0]);
				if (items[1]) {
					items_2[2].appendChild(items[1]);
				}
				if (items[2]) {
					items_2[4].appendChild(items[2]);
				}
				if (items[3]) {
					items_2[6].appendChild(items[3]);
				}
				if (items[4]) {
					items_2[8].appendChild(items[4]);
				}
			}
		}
	}


	// wcl-section-16.mod-old-site

	if (document.querySelector('.wcl-section-16.mod-old-site')) {
		let section = document.querySelector('.wcl-section-16.mod-old-site');
		let slider = section.querySelector('.data-list')
		let swiper = new Swiper(slider, {
			slidesPerView: 'auto',
		//	slidesPerView: 3,
			spaceBetween: 20,
			slidesOffsetAfter: 0,
			breakpoints: {
				0: {
					slidesOffsetAfter: 0,
				},
				767: {
					slidesOffsetAfter: 50,
				},
				1300: {
					slidesOffsetAfter: 0,
				},
			}
		});
	}


	// Section 3

	if (document.querySelector('.wcl-section-20')) {
		let section = document.querySelector('.wcl-section-20')
		section.querySelector('.data-b-list').addEventListener('scroll', function (e) {
			if (this.scrollTop > 0) {
				section.querySelector('.data-b-arrow').classList.add('active')
			} else {
				section.querySelector('.data-b-arrow').classList.remove('active')
			}
		})
	}

	// MailChimp
	if (document.querySelector('.wcl-subscribe')) {
		let sections = document.querySelectorAll('.wcl-subscribe')
		sections.forEach(element => {
			element.querySelector('.data-form').addEventListener('submit', function (e) {
				e.preventDefault();
				let form = this;
				let name = form.querySelector('input[name="name"]')
				if (name) {
					name = form.querySelector('input[name="name"]').value
				} else {
					name = '';
				}
				let email = form.querySelector('input[name="email"]').value

				if (form.querySelector('.data-notify')) {
					form.querySelector('.data-notify').remove()
				}
				let data_req = {
					action: 'wcl_subscribe',
					email: email,
					name: name,
				}

				var xhr = new XMLHttpRequest();
				xhr.open('POST', wcl_obj.ajax_url, true);
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
				xhr.onload = function (data) {
					if (xhr.status >= 200 && xhr.status < 400) {
						var data = JSON.parse(xhr.responseText);
						if (data) {
							let tag = '<div class="data-notify">' + data[0] + '</div>';
							form.insertAdjacentHTML('beforeend', tag)
						}
						if (data[1]) {
							form.querySelector('input[name="email"]').value = '';
							if (name) {
								form.querySelector('input[name="name"]').value = '';
							}
						}
					}
				};

				data_req = new URLSearchParams(data_req).toString();
				xhr.send(data_req);
			});
		});
	}


	// Privacy Policy

	if (document.querySelector('.wcl-privacy')) {
		if (window.matchMedia("(min-width: 1200px)").matches) {
			let section = document.querySelector('.wcl-privacy')
			let style = getComputedStyle(section);
			let marginTop = parseInt(style.marginTop);

			let section_top = section.offsetTop - marginTop - 50
			let section_bot = section_top + section.offsetHeight
			let title = section.querySelector('.data-title');

			window.addEventListener('scroll', function (e) {
				var scrolled = window.scrollY
				var init = scrolled - section_top

				if (scrolled >= section_top && scrolled <= section_bot) {
					var init_a = Math.round(init)
					title.style.top = init_a + 'px';
				}
			});
		}
	}

	// Comments

	function setCookie(name, value, days) {
		var expires = "";
		if (days) {
			var date = new Date();
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
			expires = "; expires=" + date.toUTCString();
		}
		document.cookie = name + "=" + (value || "") + expires + "; path=/";
	}

	if (document.querySelector('.wcl-comments')) {
		let section = document.querySelector('.wcl-comments')
		section.querySelector('.data-panel').addEventListener("click", function (e) {
			if (section.classList.contains('active')) {
				setCookie('cmnt_join', true, -1)
				section.classList.toggle('active')
			} else {
				setCookie('cmnt_join', true)
				section.classList.toggle('active')
			}
		});

		let list = section.querySelector('.data-list')
		let height = 0;

		if (list) {
			list.querySelectorAll('.data-list > li').forEach(element => {
				let style = getComputedStyle(element);
				let marginTop = parseInt(style.marginBottom);
				height += element.offsetHeight + marginTop
			});

			if (height > 350) {
				list.parentElement.classList.add('active')
			}
		}
	}

	// Search

	if (document.querySelector('.wcl-search')) {
		let section = document.querySelector('.wcl-search')
		let load_more = section.querySelector('.wcl-load-more')

		if (load_more) {
			load_more.addEventListener("click", function (e) {
				e.preventDefault();
				if (e.target.classList.contains('data-btn')) {
					let self = e.target;
					if (self.getAttribute("disable") == 'disable') {
						return false;
					}
					var search_term = load_more.children[0].getAttribute("data-search");
					var paged = self.getAttribute("data-page");
					var data_req = {
						action: 'search_load_more',
						paged: parseInt(paged) + 1,
						search_term: search_term,
					}
					var xhr = new XMLHttpRequest();
					xhr.open('POST', wcl_obj.ajax_url, true);
					xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
					xhr.onload = function (data) {
						if (xhr.status >= 200 && xhr.status < 400) {
							var data = JSON.parse(xhr.responseText);
							section.querySelector('.data-list').insertAdjacentHTML('beforeend', data.posts);
							section.querySelector('.wcl-load-more .data-container').innerHTML = data.button;
						}
					};
					data_req = new URLSearchParams(data_req).toString();
					xhr.send(data_req);
				}
			});
		}
		if (section.querySelector('.data-list')) {
			section.querySelector('.data-list').addEventListener("click", function (e) {
				if (e.target.closest('.data-item-a-iframe')) {
					e.preventDefault()
					removeVideoFrame();
					var video = e.target.getAttribute('data-video');
					e.target.innerHTML = video;
				}
			});
		}
	}

	// Blog

	if (document.querySelector('.wcl-blog')) {
		let section = document.querySelector('.wcl-blog')
		let load_more = section.querySelector('.wcl-load-more')

		if (load_more) {
			load_more.addEventListener("click", function (e) {
				e.preventDefault();
				if (e.target.classList.contains('data-btn')) {
					let self = e.target;
					if (self.getAttribute("disable") == 'disable') {
						return false;
					}
					let paged = self.getAttribute("data-page");
					let data_req = {
						action: 'blog_load_more',
						paged: parseInt(paged) + 1,
					}
					let xhr = new XMLHttpRequest();
					xhr.open('POST', wcl_obj.ajax_url, true);
					xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
					xhr.onload = function (data) {
						if (xhr.status >= 200 && xhr.status < 400) {
							var data = JSON.parse(xhr.responseText);
							section.querySelector('.data-list').insertAdjacentHTML('beforeend', data.posts);
							section.querySelector('.wcl-load-more .data-container').innerHTML = data.button;
						};
					};
					data_req = new URLSearchParams(data_req).toString();
					xhr.send(data_req);
				}
			});
		}
	}

	// Section 26

	if (document.querySelector('.wcl-section-26')) {
		let section = document.querySelector('.wcl-section-26')
		let slider = section.querySelector('.data-list');
		let swiper = new Swiper(slider, {
			//slidesPerView: 4,
			slidesPerView: 'auto',
			//	spaceBetween: '10%',
		});
	}

	// Section 28

	if (document.querySelector('.wcl-section-28')) {
		if (window.matchMedia("(min-width: 1200px)").matches) {
			let section = document.querySelector('.wcl-section-28')
			let style = getComputedStyle(section);
			let marginTop = parseInt(style.marginTop);

			let section_top = section.offsetTop - marginTop - 50
			let section_bot = section_top + section.offsetHeight
			let title = section.querySelector('.data-title');
			let subtitle = section.querySelector('.data-subtitle');
			let el = section.querySelector('.data-el');


			window.addEventListener('scroll', function (e) {
				var scrolled = window.scrollY
				var init = scrolled - section_top

				if (scrolled >= section_top && scrolled <= section_bot) {
					var init_a = Math.round(init)
					title.style.top = init_a + 'px';
					subtitle.style.top = init_a + 'px';
					el.style.marginTop = init_a + 'px';
				}
			});
		}
	}


	// Section 29

	if (document.querySelector('.wcl-section-29')) {
		let section = document.querySelector('.wcl-section-29')
		if (window.matchMedia("(min-width: 767px)").matches) {
			let slider = section.querySelector('.data-list')
			let swiper = new Swiper(slider, {
				slidesPerView: 'auto',
				spaceBetween: 63,
				speed: 300,
			});
		}
	}

	// Delay Sticky

	function header_sticky(el) {
		let header = document.querySelector('.wcl-header-2')
		var banner_pos = el.offsetTop + el.clientHeight
		window.addEventListener("scroll", e => {
			let scrollPos = window.scrollY;
			if (scrollPos > banner_pos) {
				header.classList.add('sticky-b-active');
			} else {
				header.classList.remove('sticky-b-active');
			}
		});
	}

	if (document.querySelector('.header-sticky-b')) {
		let section = document.querySelector('.wcl-page-content').children[0];
		if (section) {
			if (window.matchMedia("(min-width: 575px)").matches) {
				header_sticky(section)
			}
		}
	}

	// Section 10

	if (document.querySelector('.wcl-section-10')) {
		let section = document.querySelector('.wcl-section-10')
		section.querySelector('.data-a-a-inner-2').addEventListener("click", function (e) {
			removeVideoFrame();
			var iframe = this.querySelector('.data-a-a-iframe')
			iframe.innerHTML = iframe.getAttribute('data-video');
		});
	}

	// Section 8

	if (document.querySelector('.wcl-section-12')) {
		if (window.matchMedia("(min-width: 1200px)").matches) {
			let section = document.querySelector('.wcl-section-12')
			let style = getComputedStyle(section);
			let marginTop = parseInt(style.marginTop);

			let section_top = section.offsetTop - marginTop - 50
			let section_bot = section_top + section.offsetHeight
			let title = section.querySelector('.data-title');
			let titleOffset = title.offsetTop
			let info = section.querySelector('.data-info');

			window.addEventListener('scroll', function (e) {
				var scrolled = window.scrollY
				var init = scrolled - section_top

				if (scrolled >= section_top && scrolled <= section_bot) {
					var init_a = Math.round(init)
					title.style.top = init_a + 'px';
					info.style.marginTop = init_a + 'px';
				}
			});
		}
	}

	// Section 18

	if (document.querySelector('.wcl-section-18')) {
		let section = document.querySelector('.wcl-section-18')
		let block_1 = section.querySelector('.wcl-slider');
		let swiper = new Swiper(section.querySelector('.d3-list'), {
			slidesPerView: 1,
			spaceBetween: 0,
			slidesPerView: 'auto',
			navigation: {
				nextEl: block_1.querySelector('.mod-next'),
				prevEl: block_1.querySelector('.mod-prev'),
			},
		});
		swiper.on('slideChange', function () {
			let parent_b = block_1.parentElement
			let cur_item = parent_b.querySelectorAll('.d3-item')[swiper.activeIndex];
			if (cur_item) {
				let title = cur_item.getAttribute('data-title')
				let link = cur_item.getAttribute('data-link')
				let info = parent_b.querySelector('.data-a-b')
				info.children[0].innerText = title
				info.children[1].querySelector('a').href = link
			}
		});
	}

	// Videos

	if (document.querySelector('.wcl-videos')) {
		let section = document.querySelector('.wcl-videos')
		function load_video(paged_a) {
			let paged = -1;
			let cat = section.querySelector('.d5-nav-1-tax-item.active a')

			if (cat) {
				cat = cat.getAttribute("data-id");
			} else {
				cat = 'all';
			}

			if (paged_a) {
				paged = paged_a;
			}
			let data_req = {
				action: 'video_load_more',
				cat: cat,
				paged: parseInt(paged) + 1,
			}
			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);
					if (paged_a) {
						section.querySelector('.d5-list').insertAdjacentHTML('beforeend', data.posts);
						section.querySelector('.wcl-load-more .data-container').innerHTML = data.button;
					} else {
						section.querySelector('.d5-list').innerHTML = data.posts;
						section.querySelector('.wcl-load-more .data-container').innerHTML = data.button;
					}
					initSlider()
				};
			};
			data_req = new URLSearchParams(data_req).toString();
			xhr.send(data_req);
		}

		let cats = section.querySelectorAll('.d5-nav-1-tax a')
		if (cats) {
			cats.forEach(element => {
				element.addEventListener("click", function (e) {
					e.preventDefault();
					if (this.parentNode.classList.contains('active')) {
						return false;
					}
					let self = this;
					cats.forEach(element => {
						element.parentNode.classList.remove('active');
					});
					self.parentNode.classList.add('active');
					load_video();
				});
			});
		}


		let load_more = section.querySelector('.wcl-load-more')
		if (load_more) {
			load_more.addEventListener("click", function (e) {
				e.preventDefault();
				if (e.target.classList.contains('data-btn')) {
					let self = e.target;
					if (self.getAttribute("disable") == 'disable') {
						return false;
					}
					let paged = self.getAttribute("data-page");
					load_video(paged);
				}
			});
		}

		function initSlider() {
			section.querySelectorAll('.d3-list:not(.swiper-initialized)').forEach(element => {
				let parent = element.closest('.wcl-slider')
				let swiper = new Swiper(element, {
					slidesPerView: 1,
					spaceBetween: 0,
					slidesPerView: 'auto',
					navigation: {
						nextEl: parent.querySelector('.mod-next'),
						prevEl: parent.querySelector('.mod-prev'),
					},
				});
				swiper.on('slideChange', function () {
					let parent_b = parent.parentElement
					let cur_item = parent_b.querySelectorAll('.d3-item')[swiper.activeIndex];
					if (cur_item) {
						let title = cur_item.getAttribute('data-title')
						let link = cur_item.getAttribute('data-link')
						let info = parent_b.querySelector('.d5-item-b-b-info')
						info.children[0].innerText = title
						info.children[1].querySelector('a').href = link
					}
				});
			});
		}
		initSlider();

		section.querySelector('.d5-list').addEventListener("click", function (e) {
			if (e.target.classList.contains('d5-item-a-iframe')) {
				removeVideoFrame();
				var iframe = e.target.getAttribute('data-video');
				e.target.innerHTML = iframe;
			}
		});

		if (window.matchMedia("(min-width: 767px)").matches) {
			section.addEventListener("mouseover", function (e) {
				if (e.target.closest('.d5-item-a')) {
					let self = e.target.closest('.d5-item')
					self.classList.add('active')
				} else {
					if (!e.target.closest('.d5-item')) {
						section.querySelectorAll('.d5-item').forEach(element => {
							element.classList.remove('active')
						});
					}
				}
			});
		}
	}

	// Section 9

	if (document.querySelector('.wcl-section-9')) {
		let section = document.querySelector('.wcl-section-9')
		let gallery = section.querySelector('.data-b');
		let images = gallery.querySelectorAll('.data-b-item')
		let i = 0;

		setInterval(function () {
			i++;
			if (i != images.length) {
				images[i].classList.add('active')
			} else {
				images.forEach(function (element, index) {
					if (index != 0) {
						element.classList.remove('active')
					}
				});
				i = 0;
			}
		}, 800);
	}

	// Section 8

	if (document.querySelector('.wcl-section-8')) {
		if (window.matchMedia("(min-width: 575px)").matches) {
			let section = document.querySelector('.wcl-section-8')
			let section_top = section.offsetTop
			let section_bot = section.offsetTop + section.clientHeight
			let title = section.querySelector('.data-title');
			let titleOffset = title.offsetTop
			window.addEventListener('scroll', function (e) {
				var scrolled = window.scrollY
				var init = scrolled - section_top

				if (scrolled >= section_top && scrolled <= section_bot) {
					var init_a = Math.round(init)
					title.style.top = init_a + 'px';
				}
			});
		}
	}

	// Contact

	if (document.querySelector('.wcl-contact')) {
		let section = document.querySelector('.wcl-contact')
		var select = section.querySelector('.data-b-form .wpcf7 select')
		select.firstChild.setAttribute('disabled', true);
	}

	// Category

	if (document.querySelector('.wcl-category') && document.querySelector('.wcl-category .data-list')) {
		let section = document.querySelector('.wcl-category');
		let load_more = section.querySelector('.wcl-load-more')
		if (section.querySelector('.data-list')) {
			//	return
		}
		let heights = section.querySelector('.data-list').getAttribute('data-heights')
		heights = JSON.parse(heights);
		let item_height = parseInt(heights[0])
		if (window.matchMedia("(max-width: 991px)").matches) {
			item_height = parseInt(heights[1])
		}

		if (load_more) {
			load_more.addEventListener("click", function (e) {
				e.preventDefault();
				if (e.target.classList.contains('data-btn')) {
					let self = e.target;
					if (self.getAttribute("disable") == 'disable') {
						return false;
					}
					var cat = load_more.getAttribute("data-cat");
					var paged = self.getAttribute("data-page");
					var data_req = {
						action: 'category_load_more',
						paged: parseInt(paged) + 1,
						cat: cat,
						item_height: item_height
					}
					var xhr = new XMLHttpRequest();
					xhr.open('POST', wcl_obj.ajax_url, true);
					xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
					xhr.onload = function (data) {
						if (xhr.status >= 200 && xhr.status < 400) {
							var data = JSON.parse(xhr.responseText);
							let col_1 = data.posts[0];
							let col_2 = data.posts[1];
							let col_3 = data.posts[2];

							if (window.matchMedia("(max-width: 767px)").matches) {
								if (col_1) {
									section.querySelector(".col-3").insertAdjacentHTML('beforeend', col_1);
								}
								if (col_2) {
									section.querySelector(".col-3").insertAdjacentHTML('beforeend', col_2);
								}
								if (col_3) {
									section.querySelector(".col-3").insertAdjacentHTML('beforeend', col_3);
								}
							} else {
								if (col_1) {
									section.querySelector(".col-1").insertAdjacentHTML('beforeend', col_1);
								}
								if (col_2) {
									section.querySelector(".col-2").insertAdjacentHTML('afterbegin', col_2);
								}
								if (col_3) {
									section.querySelector(".col-3").insertAdjacentHTML('beforeend', col_3);
								}
								let length = section.querySelector(".col-1").children.length
								let length_2 = section.querySelectorAll(".col-1 .mod-new")
								if (length_2.length > 1) {
									length = length - (length_2.length - 1)
								}
								length = (length - 1) * item_height;

								window.scrollTo({
									top: length,
									behavior: "smooth"
								});

								setTimeout(() => {
									window.scrollTo({
										top: length,
										behavior: "smooth"
									});
								}, 1);

								length_2.forEach(element => {
									element.classList.remove('mod-new')
								});
							}
							section.querySelector('.wcl-load-more .data-container').innerHTML = data.button;
						}
					};
					data_req = new URLSearchParams(data_req).toString();
					xhr.send(data_req);
				}
			});
		}


		let height_1 = section.querySelector('.data-list-out').offsetHeight
		let height_2 = section.querySelector('.data-list').offsetHeight

		if (!window.matchMedia("(max-width: 767px)").matches) {
			window.scrollTo(0, 0);

			window.addEventListener('scroll', function (e) {
				let scroll = window.scrollY
				let height_1 = section.querySelector('.data-list-out').offsetHeight
				// scroll = scroll - 50
				if (scroll > 60) {
					scroll = scroll - 60
					if (scroll + item_height + 10 <= height_1) {
						section.querySelector(".data-list").style.top = scroll + "px";
						section.querySelector(".col-1").style.transform = "translate(0,calc( -" + scroll + "px))"
						section.querySelector(".col-2").style.top = scroll + "px";
						section.querySelector(".col-3").style.transform = "translate(0,calc( -" + scroll + "px))"
					} else {
						let length = section.querySelector(".col-2").children.length
						length = (length - 1) * item_height;
						section.querySelector(".data-list").style.top = length + "px";
						section.querySelector(".col-1").style.transform = "translate(0,calc( -" + length + "px))"
						section.querySelector(".col-2").style.top = length + "px";
						section.querySelector(".col-3").style.transform = "translate(0,calc( -" + length + "px))"
					}
				}
			});
		}
	}

	// Shop outfits

	if (document.querySelector('.mod-shop-outfits')) {
		function reInitSlider() {
			section.querySelectorAll('.d3-list:not(.swiper-initialized)').forEach(element => {
				let parent = element.closest('.wcl-slider')
				let swiper = new Swiper(element, {
					slidesPerView: 1,
					spaceBetween: 0,
					slidesPerView: 'auto',
					navigation: {
						nextEl: parent.querySelector('.mod-next'),
						prevEl: parent.querySelector('.mod-prev'),
					},
				});
			});
		}

		shop_phlur_imgs();

		let section = document.querySelector('.mod-shop-outfits')
		section.querySelectorAll('.wcl-slider').forEach(element => {
			let slider = element.querySelector('.d3-list')
			let swiper = new Swiper(slider, {
				slidesPerView: 1,
				spaceBetween: 0,
				slidesPerView: 'auto',
				navigation: {
					nextEl: element.querySelector('.mod-next'),
					prevEl: element.querySelector('.mod-prev'),
				},
			});
		});

		document.addEventListener('click', function (e) {
			if (e.target.closest('.d2-item-b.has-shop')) {
				e.target.closest('.d2-item-b').classList.add('active')
			} else {
				section.querySelectorAll('.d2-item-b.active').forEach(element => {
					element.classList.remove('active')
				});
			}
		});

		let shop_btn_more = section.querySelector('.wcl-load-more')
		if (shop_btn_more) {
			shop_btn_more.addEventListener("click", function (e) {
				e.preventDefault();
				if (e.target.classList.contains('data-btn')) {
					let self = e.target;
					if (self.getAttribute("disable") == 'disable') {
						return false;
					}
					let cat = section.querySelector('.mod-category .active a')
					if (cat) {
						cat = cat.getAttribute("data-id");
					} else {
						cat = 'all';
					}
					let occasion = section.querySelector('.mod-occasion .active a')
					if (occasion) {
						occasion = occasion.getAttribute("data-id");
					} else {
						occasion = 'all';
					}
					let paged = self.getAttribute("data-page");
					let cycle = self.getAttribute("data-cycle");
					let data_req = {
						action: 'shop_outfit_load',
						cat: cat,
						occasion: occasion,
						cycle: cycle,
						paged: parseInt(paged) + 1
					}
					let xhr = new XMLHttpRequest();
					xhr.open('POST', wcl_obj.ajax_url, true);
					xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
					xhr.onload = function (data) {
						if (xhr.status >= 200 && xhr.status < 400) {
							var data = JSON.parse(xhr.responseText);
							section.querySelector('.d2-list').insertAdjacentHTML('beforeend', data.posts);
							section.querySelector('.wcl-load-more .data-container').innerHTML = data.button;
							reInitSlider()
							shop_phlur_imgs();
						}
					};
					data_req = new URLSearchParams(data_req).toString();
					xhr.send(data_req);
				}
			});
		}

	}

	// Shop things


	function shop_phlur_imgs() {
		let galleries = document.querySelectorAll('.mod-phlur.disable');
		galleries.forEach(element => {
			element.classList.remove('disable')
			let images = element.querySelectorAll('.data-item-imgs img')
			let i = 0;
			setInterval(function () {
				i++;
				if (i != images.length) {
					images[i - 1].classList.remove('active')
					images[i].classList.add('active')
				} else {
					images[i - 1].classList.remove('active')
					images[0].classList.add('active')
					i = 0;
				}
			}, 500);
		});
	}

	if (document.querySelector('.wcl-shop.mod-shop-things')) {
		let section = document.querySelector('.wcl-shop');
		shop_phlur_imgs();
		function load_shop() {
			let cat = section.querySelector('.mod-category .active a')
			if (cat) {
				cat = cat.getAttribute("data-id");
			} else {
				cat = 'all';
			}
			let occasion = section.querySelector('.mod-occasion .active a')
			if (occasion) {
				occasion = occasion.getAttribute("data-id");
			} else {
				occasion = 'all';
			}
			let data_req = {
				action: 'shop_load_more',
				cat: cat,
				occasion: occasion
			}
			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);
					section.querySelector('.data-list').innerHTML = data.posts;
					section.querySelector('.wcl-load-more .data-container').innerHTML = data.button;
					shop_phlur_imgs();
				};
			};
			data_req = new URLSearchParams(data_req).toString();
			xhr.send(data_req);
		}

		let cats = section.querySelectorAll('.data-nav-1-tax-list a')
		if (cats) {
			cats.forEach(element => {
				element.addEventListener("click", function (e) {
					e.preventDefault();
					let self = this;
					cats.forEach(element => {
						if (element.parentNode.classList.contains('active') && self != element) {
							element.parentNode.classList.remove('active')
						}
					});
					self.parentNode.classList.toggle('active');
					load_shop()
				});
			});
		}

		let shop_btn_more = section.querySelector('.wcl-load-more')
		if (shop_btn_more) {
			shop_btn_more.addEventListener("click", function (e) {
				e.preventDefault();
				if (e.target.classList.contains('data-btn')) {
					let self = e.target;
					if (self.getAttribute("disable") == 'disable') {
						return false;
					}
					let cat = section.querySelector('.mod-category .active a')
					if (cat) {
						cat = cat.getAttribute("data-id");
					} else {
						cat = 'all';
					}
					let occasion = section.querySelector('.mod-occasion .active a')
					if (occasion) {
						occasion = occasion.getAttribute("data-id");
					} else {
						occasion = 'all';
					}

					let paged = self.getAttribute("data-page");
					let cycle = self.getAttribute("data-cycle");
					let data_req = {
						action: 'shop_load_more',
						cat: cat,
						occasion: occasion,
						cycle: cycle,
						paged: parseInt(paged) + 1
					}
					let xhr = new XMLHttpRequest();
					xhr.open('POST', wcl_obj.ajax_url, true);
					xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
					xhr.onload = function (data) {
						if (xhr.status >= 200 && xhr.status < 400) {
							var data = JSON.parse(xhr.responseText);
							section.querySelector('.data-list').insertAdjacentHTML('beforeend', data.posts);
							section.querySelector('.wcl-load-more .data-container').innerHTML = data.button;
							shop_phlur_imgs();
						}
					};
					data_req = new URLSearchParams(data_req).toString();
					xhr.send(data_req);
				}
			});
		}

		let view = section.querySelector('.data-nav-1-view')
		view.addEventListener("click", function (e) {
			section.querySelector('.data-nav-1').classList.toggle('active')
			section.querySelector('.data-nav-1-view').classList.toggle('active')
		});

		let taxs = section.querySelectorAll('.data-nav-1-tax')
		taxs.forEach(element => {
			element.querySelector('.data-nav-1-tax-title').addEventListener("click", function (e) {
				taxs.forEach(element => {
					if (element.classList.contains('active') && this.parentNode != element) {
						element.classList.remove('active')
						element.querySelectorAll('li').forEach(element => {
							element.classList.remove('active')
						});
					}
					if (element.classList.contains('active')) {
						element.querySelectorAll('li').forEach(element => {
							element.classList.remove('active')
						});
					}
				});
				load_shop()
				this.parentNode.classList.toggle('active')
			});
		});
	}

	// Section 1

	function removeVideoFrame() {
		var items = document.querySelectorAll('[data-video]');
		items.forEach(element => {
			if (element.querySelector('iframe')) {
				element.querySelector('iframe').remove()
			}
		});
	}

	if (document.querySelector('.wcl-section-1')) {
		let section = document.querySelector('.wcl-section-1')
		section.querySelector('.data-b-title').addEventListener('mouseover', function (e) {
			section.querySelector('.data-b').classList.add('active')
		})

		section.querySelector('.data-b-title').addEventListener('mouseout', function (e) {
			section.querySelector('.data-b').classList.remove('active')
		})

		section.querySelector('.data-a-view-inner').addEventListener("click", function (e) {
			removeVideoFrame();
			var iframe = this.querySelector('.data-a-view-iframe')
			iframe.innerHTML = iframe.getAttribute('data-video');
		});
	}

	// Section 6

	if (document.querySelector('.wcl-section-6')) {
		let section = document.querySelector('.wcl-section-6')
		let slider = section.querySelector('.data-list')
		let swiper = '';
		if (window.matchMedia("(min-width: 768px)").matches) {
			swiper = new Swiper(slider, {
				slidesPerView: 1,
				speed: 600,
				centeredSlides: true,
				spaceBetween: 20,
				slidesPerView: 'auto',
			});

			section.addEventListener('mouseover', function (e) {
				if (e.target.closest('.data-list')) {
					slider.classList.add('active')
				} else {
					swiper.slideTo(0, 600);
					removeVideoFrame();
					slider.classList.remove('active')
				}
			})
		} else {
			slider.querySelector('.data-item').addEventListener('click', function (e) {
				slider.classList.add('active')
				section.classList.add('active')
			});
		}

		let items = section.querySelectorAll('.data-item')
		items.forEach(element => {
			element.addEventListener("click", function (e) {
				removeVideoFrame();
				var iframe = this.querySelector('.data-item-iframe')
				if (iframe) {
					iframe.innerHTML = iframe.getAttribute('data-video');
				}
			});
		});
	}

	// Section 5

	if (document.querySelector('.wcl-section-5')) {
		let section = document.querySelector('.wcl-section-5')
		let slider = section.querySelector('.data-list')
		let swiper = new Swiper(slider, {
			slidesPerView: 3,
			navigation: {
				nextEl: section.querySelector('.data-list-nav-btn.mod-next'),
				prevEl: section.querySelector('.data-list-nav-btn.mod-prev'),
			},
			breakpoints: {
				1200: {
					//spaceBetween: 124,
				},
				768: {
					slidesPerView: 2,
				},
				0: {
					slidesPerView: 'auto',
				}
			}
		});
	}

	// Section 3

	if (document.querySelector('.wcl-section-3')) {
		let section = document.querySelector('.wcl-section-3')
		let nodes = Array.prototype.slice.call(section.querySelectorAll('.data-b-item'));

		if (window.matchMedia("(max-width: 991px)").matches) {
			section.querySelectorAll('.data-b-item').forEach(element => {
				element.addEventListener('click', function (e) {
					let index = gNodes.indexOf(this);
					if (index != 0) {
						section.querySelector('.data-b-list').scrollTo({
							top: 0,
							left: 0,
							behavior: 'smooth'
						});
					}
				});
			});
		}

		let slider = section.querySelector('.wcl-slider');
		let swiper = new Swiper(section.querySelector('.d3-list'), {
			slidesPerView: 1,
			spaceBetween: 0,
			slidesPerView: 'auto',
			navigation: {
				nextEl: slider.querySelector('.mod-next'),
				prevEl: slider.querySelector('.mod-prev'),
			},
		});

		let gallery = section.querySelector('.data-b-list')
		let gItems = gallery.querySelectorAll('.data-b-item')
		let gNodes = Array.prototype.slice.call(gItems);
		gItems.forEach(element => {
			element.addEventListener('click', function (e) {
				let shop = this.getAttribute('data-shop')
				let shopData = JSON.parse(shop);

				let aIndex = gItems[0].querySelector('.data-b-item-index').innerText
				let aTitle = gItems[0].querySelector('.data-b-item-title').innerText
				let aImg = gItems[0].querySelector('.data-b-item-img img').src
				let aShop = gItems[0].getAttribute('data-shop')

				let index = this.querySelector('.data-b-item-index').innerText
				let title = this.querySelector('.data-b-item-title').innerText
				let img = this.querySelector('.data-b-item-img img').src

				let real_index = gNodes.indexOf(this);
				//let shop = this.getAttribute('data-shop')
				//swiper.slideTo(index, 300);
				if (real_index != 0) {
					swiper.removeAllSlides()
					//swiper.destroy(deleteInstance, cleanStyles)
					//swiper.disable()
					shopData.some(function (element, i) {
						//swiper.appendSlide(element.slide)
						slider.querySelector('.d3-list-inner').insertAdjacentHTML('beforeend', element.slide);
						//return i == 1;
					});
					swiper.slideTo(1, 0);
					swiper.slideTo(0, 0);
					swiper.update()
					gItems[0].querySelector('.data-b-item-title').innerText = title
					gItems[0].querySelector('.data-b-item-index').innerText = index
					gItems[0].querySelector('.data-b-item-img img').src = img
					gItems[0].setAttribute('data-shop', shop)

					this.querySelector('.data-b-item-title').innerText = aTitle
					this.querySelector('.data-b-item-index').innerText = aIndex
					this.querySelector('.data-b-item-img img').src = aImg
					this.setAttribute('data-shop', aShop)
				}
			})
		});
		swiper.on('slideChange', function () {
			let cur_item = slider.querySelectorAll('.d3-item')[swiper.activeIndex];
			if (cur_item) {
				let title = cur_item.getAttribute('data-title')
				let link = cur_item.getAttribute('data-link')
				let info = section.querySelector('.data-a-info')
				info.children[0].innerText = title
				info.children[1].querySelector('a').href = link
			}
		});
	}

	// Header 2

	if (document.querySelector('.wcl-header-2')) {
		if (window.matchMedia("(min-width: 992px)").matches) {
			let section = document.querySelector('.wcl-header-2');
			let items = section.querySelectorAll('.data-nav-menu > li')
			items.forEach(element => {
				element.addEventListener("mouseover", function () {
					this.classList.add('active')
					if (this.querySelector('.sub-menu')) {
						let height = this.querySelector('.sub-menu').clientHeight
						section.querySelector('.data-inner').style.paddingBottom = height + 'px'
						this.querySelector('.sub-menu').classList.add('active')
					}
				});
				element.addEventListener("mouseout", function () {
					this.classList.remove('active')
					if (this.querySelector('.sub-menu')) {
						this.querySelector('.sub-menu').classList.remove('active')
						section.querySelector('.data-inner').style.paddingBottom = 0
					}
				});
			});
		}
	}

	// Header 1

	if (document.querySelector('.wcl-header-1')) {
		let section = document.querySelector('.wcl-header-1');
		// Search

	}

	// Header

	if (document.querySelector('.wcl-header')) {
		let section = document.querySelector('.wcl-header');
		let menu_btn = section.querySelector('.data-menu-btn-ico')
		menu_btn.addEventListener("click", function () {
			let nav = section.querySelector('.data-nav')
			if (!menu_btn.classList.contains('active')) {
				menu_btn.classList.add("active");
				nav.classList.add("active");
				document.querySelector('body').classList.add('overflow-hidden')
			} else {
				menu_btn.classList.remove('active');
				nav.classList.remove('active');
				document.querySelector('body').classList.remove('overflow-hidden')
			}
		});

		let search_btn = section.querySelector('.data-search-btn')
		search_btn.addEventListener("click", function () {
			if (!section.classList.contains('active-search')) {
				let nav = section.querySelector(' .data-nav')
				nav.classList.remove('active');
				document.querySelector('body').classList.remove('overflow-hidden')
				menu_btn.classList.remove('active');
				section.classList.add('active', 'active-search');
			} else {
				let search = section.querySelector('.data-search input').value
				if (search.length > 0) {
					window.location = wcl_obj.site_url + 'search/' + search;
				}
			}
		});

		section.querySelector('.data-search input').addEventListener('keydown', function (e) {
			if (e.keyCode == 13) {
				var search = section.querySelector('.data-search input').value
				if (search.length > 0) {
					window.location = wcl_obj.site_url + 'search/' + search;
				}
			}
		});

		section.querySelector('.data-search-close').addEventListener('click', function (e) {
			section.classList.remove('active', 'active-search');
		})

		// Hide 

		document.addEventListener('click', function (e) {
			if (section.classList.contains('active')) {
				if (!e.target.closest('.wcl-header') || e.target.matches('.data-overlay')) {
					section.classList.remove('active', 'active-search');
				}
			}
		});


		if (window.matchMedia("(max-width: 991px)").matches) {
			section.querySelectorAll('.data-nav-menu > li a').forEach(element => {
				element.addEventListener("click", function (e) {
					if (this.parentElement.querySelector('.sub-menu') != null && this.parentElement.querySelector('.sub-menu').attributes.length > 0) {
						e.preventDefault()

						if (e.target.closest('.menu-item-has-children').classList.contains('active')) {
							e.target.closest('.menu-item-has-children').classList.remove('active')
						} else {
							e.target.closest('.menu-item-has-children').classList.add('active')
						}
					}
				});
			});
		}
	}


	// Banner

	if (document.querySelector('.wcl-banner')) {
		let section = document.querySelector('.wcl-banner');
		let slider = section.querySelector('.data-list')
		if (window.matchMedia("(min-width: 576px)").matches) {
			slider = new Swiper(slider, {
				initialSlide: 1,
				speed: 1000,
				centeredSlides: true,
				slidesPerView: 'auto',
				slideToClickedSlide: true,
				allowTouchMove: false,
				on: {
					afterInit: function () {
						setTimeout(() => {
							section.classList.remove('before-init')
						}, 1);
					},
				},
				breakpoints: {
					700: {
					},
					0: {
						allowTouchMove: true,
					}
				}
			});

			let galleries = section.querySelectorAll('.data-item-gallery');
			galleries.forEach(element => {
				let images = element.querySelectorAll('img')
				let i = 0;
				setInterval(function () {
					i++;
					if (i != images.length) {
						images[i - 1].classList.remove('active')
						images[i].classList.add('active')
					} else {
						images[i - 1].classList.remove('active')
						images[0].classList.add('active')
						i = 0;
					}
				}, 500);
			});
		}

	}
});