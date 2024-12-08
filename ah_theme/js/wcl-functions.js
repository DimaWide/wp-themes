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




	// wcl-single-content

	if (document.querySelector('.wcl-single-content')) {
		let section = document.querySelector('.wcl-single-content')

		// Highlighted Tables Item
		if (window.matchMedia("(min-width: 991px)").matches) {
			var links = document.querySelectorAll(".data-table-contents a");
			var isUpdating = false;
			var activeLinkId = null;

			function updateActiveElement() {
				if (!isUpdating) {
					isUpdating = true;

					var scrollPosition = window.scrollY || window.pageYOffset;

					// Проверьте, какая ссылка находится в зоне видимости
					var activeLink = null;

					Array.from(links).forEach(function (link) {
						var targetId = link.getAttribute("href").substring(1);
						var targetElement = document.getElementById(targetId);

						if (targetElement) {
							var offset = targetElement.offsetTop - 30;
							var height = targetElement.offsetHeight;

							if (scrollPosition >= offset) {
								activeLink = link;
							}
						}
					});

					// Удалите класс "active" только если активная ссылка изменилась
					if (activeLink && activeLink.getAttribute("href") !== "#" + activeLinkId) {
						// Удалите класс "active" со всех ссылок
						Array.from(links).forEach(function (link) {
							link.classList.remove("active");
						});

						// Добавьте класс "active" к текущей активной ссылке
						activeLink.classList.add("active");
						activeLinkId = activeLink.getAttribute("href").substring(1);
					}


					isUpdating = false;
				}
			}

			// Добавьте обработчик события прокрутки
			window.addEventListener("scroll", updateActiveElement);

			// Вызовите функцию updateActiveElement для установки начального активного элемента
			updateActiveElement();
		}


		// Fixed on Scroll

		if (section.querySelector('.data-sidebar')) {
			if (window.matchMedia("(min-width: 991px)").matches) {
				let sidebar = section.querySelector('.data-sidebar')

				let sidebar_top = sidebar.offsetTop + 1
				let content = section.querySelector('.data-content')
				let sidebar_bot = content.offsetTop + content.clientHeight
				sidebar_bot = sidebar_bot - sidebar.clientHeight
				let sidebar_bot_2 = content.clientHeight - sidebar.clientHeight

				let scrolled = window.scrollY
				let init = scrolled - sidebar_top

				if (scrolled >= sidebar_top && scrolled <= sidebar_bot) {
					sidebar.classList.add('active')
					sidebar.classList.remove('active-2')
					sidebar.style.top = 0
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

					let scrolled = window.scrollY
					let init = scrolled - sidebar_top


					if (scrolled >= sidebar_top && scrolled <= sidebar_bot) {
						sidebar.classList.add('active')
						sidebar.classList.remove('active-2')
						sidebar.style.top = 0
					} else {
						if (scrolled >= sidebar_top) {
							sidebar.classList.remove('active')
							sidebar.classList.add('active-2')
							sidebar.style.top = sidebar_bot_2 + 'px'
						} else {
							sidebar.classList.remove('active')
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
							top: targetElement.offsetTop - 15,
							behavior: 'smooth'
						});
					}
				});
			});
		}


		// Function to copy post permalink to clipboard
		function copyToClipboard(text) {
			var dummy = document.createElement("textarea");
			document.body.appendChild(dummy);
			dummy.value = text;
			dummy.select();
			document.execCommand("copy");
			document.body.removeChild(dummy);
		}

		let timeoutId;

		section.querySelector('.data-meta-item.mod-copy-link').addEventListener('click', function (e) {
			copyToClipboard(section.getAttribute('data-permalink'));

			let notify = section.querySelector('.data-meta-copy-notify')

			if (section.querySelector('.data-meta-copy-notify').classList.contains('active')) {
				section.querySelector('.data-meta-copy-notify').classList.remove('active');

				setTimeout(function () {
					notify.classList.add('active');
				}, 150);
			} else {
				section.querySelector('.data-meta-copy-notify').classList.add('active');
			}

			// Clear the previous timeout
			if (timeoutId) {
				clearTimeout(timeoutId);
			}

			// If the notify is now active, set a new timeout to hide it after a certain duration (adjust as needed)
			if (notify.classList.contains('active')) {
				timeoutId = setTimeout(function () {
					notify.classList.remove('active');
				}, 2000);

			}
		});


		document.addEventListener('click', function (event) {
			let notify = document.querySelector('.data-meta-copy')

			if (!notify.contains(event.target)) {
				document.querySelector('.data-meta-copy-notify').classList.remove('active');
			}
		});
	}





	// wcl-newsletter

	if (document.querySelector('.wcl-newsletter')) {
		let sections = document.querySelectorAll('.wcl-newsletter')

		sections.forEach(element => {
			element.querySelector('input[name="newsletter-subscriber[]"]').setAttribute('checked', 'checked')
		});
	}



	// js-post-item

	function truncateText(element) {
		var containerHeight = element.clientHeight;
		var textHeight = element.scrollHeight;

		if (textHeight > containerHeight) {
			// Обрезаем текст
			while (textHeight > containerHeight) {
				element.textContent = element.textContent.replace(/\W*\s(\S)*$/, '...');
				textHeight = element.scrollHeight;
			}
		}
	}

	function handleResize() {
		let items = document.querySelectorAll('.js-post-item')

		items.forEach(element => {
			if (element.querySelector('.js-post-item-title')) {
				truncateText(element.querySelector('.js-post-item-title'))
			}

			if (element.querySelector('.js-post-item-desc')) {
				truncateText(element.querySelector('.js-post-item-desc'))
			}
		});
	}


	if (document.querySelector('.js-post-item')) {
		handleResize();
	}


	// wcl-acf-block-6

	if (document.querySelector('.wcl-acf-block-6')) {
		let section = document.querySelector('.wcl-acf-block-6')

		section.querySelector('.data-nav-view').addEventListener('click', function (e) {
			if (section.querySelector('.data-nav').classList.contains('active')) {
				section.querySelector('.data-nav').classList.remove('active')
				section.querySelector('.data-nav-view').classList.remove('active')
			} else {
				section.querySelector('.data-nav').classList.add('active')
				section.querySelector('.data-nav-view').classList.add('active')
			}
		})



		// buildURL

		function buildURL() {
			var activeCategories = []; // Массив для хранения активных категорий

			// Получение всех элементов с классом data-cats-item 
			var categoryItems = document.querySelectorAll('.data-cats-item ');

			// Перебор элементов для определения активных категорий
			categoryItems.forEach(function (item) {
				if (item.classList.contains('active')) {
					var categorySlug = item.querySelector('a').getAttribute('data-id'); // Получение слага категории
					activeCategories.push(categorySlug); // Добавление слага в массив активных категорий
				}
			});

			var currentPage = document.querySelector('.data-pagination .mod-current'); // Найдем текущую страницу
			var page = currentPage ? currentPage.getAttribute('data-page') : 1; // Номер текущей страницы

			// Формирование URL с активными категориями и номером страницы
			var url = wcl_obj.site_url + wcl_obj.blog_url + '/';

			if (activeCategories.length == 1) {
				url = wcl_obj.site_url + 'category/' + activeCategories + '/';
			} else if (activeCategories.length > 1) {
				url += activeCategories.join(',') + '/';
			}

			if (page !== '1' && document.querySelector('.data-pagination .mod-current')) {
				url += 'page/' + page + '/';
			}

			window.history.pushState(wcl_obj.site_url, document.title, url);
		}



		// blog_page_load_post

		function blog_page_load_post(page_new) {
			let page = 1;
			let cats = '';

			section.querySelectorAll('.data-cats .data-cats-item.active').forEach((element, index) => {
				let id = element.querySelector('a').getAttribute('data-id')

				if (index !== 0) {
					cats += ',';
				}
				cats += id;
			});

			if (page_new) {
				page = page_new;
			}


			let data_req = {
				action: 'blog_page_load_post',
				page: parseInt(page),
				cats: cats,
			}

			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);

					section.querySelector('.data-list').innerHTML = data.posts;
					section.querySelector('.data-pagination-inner').innerHTML = data.pagination;

					if (data.count_pages && data.count_pages > 1) {
						section.querySelector('.data-pagination').classList.add('active')
					} else {
						section.querySelector('.data-pagination').classList.remove('active')
					}

					if (data.first_post) {
						if (document.querySelector('.wcl-acf-block-5')) {
							document.querySelector('.wcl-acf-block-5 .data-container').innerHTML = data.first_post;
						}
					}

					handleResize();

					buildURL();
				};
			};
			data_req = new URLSearchParams(data_req).toString();
			xhr.send(data_req);
		}


		// pagination

		let pagination = section.querySelector('.data-pagination')

		if (pagination) {
			pagination.addEventListener("click", function (e) {
				let self = e.target.closest('a')
				if (self) {
					e.preventDefault();

					if (e.target.classList.contains('mod-current')) {
						return false;
					}

					let page = self.getAttribute("data-page");
					blog_page_load_post(page);
				}
			});
		}


		// cats

		let cats = section.querySelectorAll('.data-cats a')


		if (cats) {
			if (window.matchMedia("(min-width: 991px)").matches) {
				cats.forEach(element => {
					let categoryWidth = element.getBoundingClientRect().width;

					element.style.width = categoryWidth + 'px';
				});
			}

			cats.forEach(element => {
				element.addEventListener("click", function (e) {
					e.preventDefault();

					let self = this;

					if (self.parentNode.classList.contains('active')) {
						self.parentNode.classList.remove('active');
					} else {
						self.parentNode.classList.add('active');
					}

					blog_page_load_post();

					if (window.matchMedia("(max-width: 991px)").matches) {
						let all_cats_text = '';

						section.querySelectorAll('.data-cats .active a').forEach((element, index) => {
							if (index !== 0) {
								all_cats_text += ' / ';
							}
							all_cats_text += element.textContent.trim();;
						});

						if (all_cats_text) {
							section.querySelector('.data-nav-view-inner').textContent = all_cats_text
						} else {
							section.querySelector('.data-nav-view-inner').textContent = 'Select a category'
						}
					}
				});
			});
		}
	}





	// wcl-header

	if (document.querySelector('.wcl-header')) {
		let section = document.querySelector('.wcl-header')


		section.querySelector('.data-btn-menu').addEventListener('click', function (e) {
			if (this.classList.contains('active')) {
				this.classList.remove('active')
				this.closest('.wcl-header').classList.remove('active')
				section.querySelector('.data-nav').classList.remove('active')
				document.querySelector('body, html').classList.remove('overflow-hidden')
			} else {
				this.classList.add('active')
				this.closest('.wcl-header').classList.add('active')
				section.querySelector('.data-nav').classList.add('active')
				document.querySelector('body, html').classList.add('overflow-hidden')
			}
		})



		// Menu

		section.addEventListener('mouseover', function (e) {
			if (e.target.nextElementSibling && e.target.nextElementSibling.classList.contains('sub-menu')) {
				if (section.querySelector('.data-menu li.mod-mega-menu.active')) {
					section.querySelector('.data-menu li.mod-mega-menu.active').classList.remove('active')
				}
			}
		})

		if (section.querySelector('.menu-item-has-children')) {
			section.querySelectorAll('.menu-item-has-children').forEach(element => {
				element.addEventListener('click', function (e) {
					if (e.target.getAttribute("href") == '#') {
						e.preventDefault()
					}

					if (window.matchMedia("(max-width: 767px)").matches) {
						if (!e.target.closest('.sub-menu')) {
							e.preventDefault()
						}
					}

					if (this.classList.contains('active')) {
						this.classList.remove('active')
					} else {
						this.classList.add('active')
					}
				})
			});
		}

		if (window.matchMedia("(min-width: 767px)").matches) {
			section.querySelectorAll('.data-menu li.mod-mega-menu').forEach(element => {
				element.addEventListener('mouseover', function (e) {
					section.querySelectorAll('.data-menu li.mod-mega-menu.active').forEach(element_2 => {
						element_2.classList.remove('active')
					});

					element.classList.add('active')
				})
			});

			section.addEventListener('mouseleave', function (e) {
				if (section.querySelector('.data-menu li.mod-mega-menu.active')) {
					section.querySelector('.data-menu li.mod-mega-menu.active').classList.remove('active')
				}
			})


			section.addEventListener('click', function (e) {
				if (!e.target.closest('.wcl-mega-menu')) {
					if (section.querySelector('.data-menu li.mod-mega-menu.active')) {
						section.querySelector('.data-menu li.mod-mega-menu.active').classList.remove('active')
					}
				}
			})


		}
	}





	// js-cats-post

	if (document.querySelector('.js-cats-post')) {
		let section = document.querySelector('.js-cats-post')

		function adjustCategories(container) {
			var categories = container.querySelectorAll('.js-cats-post > div');
			var containerWidth = container.offsetWidth;
			var columnGap = 8; // Отступ между категориями
			var totalWidth = 0;

			categories.forEach(function (category, index) {
				var categoryWidth = category.offsetWidth;

				// Учитываем ширину категории и отступ между категориями
				totalWidth += categoryWidth + (index > 0 ? columnGap : 0);

				// Если ширина превышает контейнер, скрываем категории
				if (totalWidth > containerWidth) {
					category.style.display = 'none';
				} else {
					category.style.display = 'block';
				}
			});
		}

		var containers = document.querySelectorAll('.data-item-cats, .m1-item-cats');

		containers.forEach(function (container) {
			// Вызываем функцию при загрузке страницы и изменении размера окна
			window.addEventListener('resize', function () {
				// Сначала сбрасываем видимость всех категорий
				container.querySelectorAll('.category').forEach(function (category) {
					category.style.display = 'block';
				});

				// Затем вызываем функцию настройки категорий
				adjustCategories(container);
			});

			// Вызываем функцию для первичной настройки при загрузке страницы
			adjustCategories(container);
		});
	}




	// wcl-acf-block-2

	if (document.querySelector('.wcl-acf-block-2')) {
		let section = document.querySelectorAll('.wcl-acf-block-2')

		section.forEach(element => {
			let swiper = new Swiper(element.querySelector('.data-list'), {
				slidesPerView: 'auto',
				loop: true,
				spaceBetween: 20,
				navigation: {
					nextEl: element.querySelector('.mod-next'),
					prevEl: element.querySelector('.mod-prev'),
				},
				breakpoints: {
					0: {
						spaceBetween: 24,
					},
					576: {
						spaceBetween: 20,
					},
				}
			});
		});
	}


});