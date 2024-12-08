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



	// wcl-contact
	
	if (document.querySelector('.wcl-contact')) {
		let section = document.querySelector('.wcl-contact')

		document.addEventListener('wpcf7submit', function (event) {
			if ('163' == event.detail.contactFormId || '26664' == event.detail.contactFormId) {
				section.querySelectorAll('.wpcf7-form-control-wrap').forEach(element => {
					if (element.parentElement.classList.contains('focus')) {
						element.parentElement.classList.remove('focus')
					}
				});
			}
		}, false);
	}


	// wcl-comments

	if (document.querySelector('.wcl-comments')) {
		let section = document.querySelectorAll('.wcl-comments')

		section.forEach(element => {
			let section = element

			section.querySelectorAll('input, textarea').forEach(element => {
				element.addEventListener('focus', function (e) {
					this.parentElement.classList.add('focus')
				})

				element.addEventListener('change', function (e) {
					this.parentElement.classList.add('focus')
				})

				element.addEventListener('focusout', function (e) {
					if (this.value == '') {
						this.parentElement.classList.remove('focus')
					}
				})
			});
		});
	}

	// wcl-section-15

	if (document.querySelector('.wcl-section-15')) {
		let section = document.querySelector('.wcl-section-15')
		let swiper = new Swiper(section.querySelector('.data-list'), {
			slidesPerView: 1,
			spaceBetween: 5,
			loop: true,
			speed: 600,
			effect: 'fade',
			autoplay: {
				delay: 4000,
				disableOnInteraction: false,
			},
		});

	}

	// wcl-contact

	if (document.querySelector('.wcl-contact')) {
		let section = document.querySelectorAll('.wcl-contact')

		section.forEach(element => {
			let section = element

			section.querySelectorAll('input, textarea').forEach(element => {
				element.addEventListener('focus', function (e) {
					this.closest('p').classList.add('focus')
				})

				element.addEventListener('change', function (e) {
					this.closest('p').classList.add('focus')
				})

				element.addEventListener('focusout', function (e) {
					if (this.value == '') {
						this.closest('p').classList.remove('focus')
					}
				})
			});
		});
	}

	// wcl-flodesk

	if (document.querySelector('.wcl-flodesk')) {
		let section = document.querySelectorAll('.wcl-flodesk')

		section.forEach(element => {
			let section = element

			section.querySelectorAll('input').forEach(element => {
				element.addEventListener('focus', function (e) {
					this.parentElement.classList.add('focus')
				})

				element.addEventListener('change', function (e) {
					this.parentElement.classList.add('focus')
				})

				element.addEventListener('focusout', function (e) {
					if (this.value == '') {
						this.parentElement.classList.remove('focus')
					}
				})
			});
		});
	}

	// wcl-posts-by-month

	if (document.querySelector('.wcl-posts-by-month')) {
		let section = document.querySelector('.wcl-posts-by-month')

		function posts_by_month_load_post(paged_new) {
			let paged = -1;
			let category = section.querySelector('.d6-item.active a')
			let post_date = section.getAttribute('data-post-date')

			if (category) {
				category = category.getAttribute("data-id");
			} else {
				category = 'all';
			}

			if (paged_new) {
				paged = paged_new
			}

			let data_req = {
				action: 'posts_by_month_load_post',
				paged: parseInt(paged) + 1,
				post_date: post_date,
				category: category,
			}
			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);
					if (paged_new) {
						section.querySelector('.data-list').insertAdjacentHTML('beforeend', data.posts);
					} else {
						section.querySelector('.data-list').innerHTML = data.posts;
					}
					section.querySelector('.wcl-load-more .d2-container').innerHTML = data.button;
				};
			};
			data_req = new URLSearchParams(data_req).toString();
			xhr.send(data_req);
		}

		let load_more = section.querySelector('.wcl-load-more')
		if (load_more) {
			load_more.addEventListener("click", function (e) {
				e.preventDefault();
				if (e.target.classList.contains('d2-btn')) {
					let self = e.target;
					if (self.getAttribute("disable") == 'disable') {
						return false;
					}
					let paged = e.target.getAttribute("data-page");
					posts_by_month_load_post(paged);
				}
			});
		}

		let cats = section.querySelectorAll('.d6-item a')
		if (cats) {
			cats.forEach(element => {
				element.addEventListener("click", function (e) {
					e.preventDefault();
					if (this.parentNode.classList.contains('active')) {
						return false;
					}

					let self = this;

					if (section.querySelector('.d6-item.active')) {
						section.querySelector('.d6-item.active').classList.remove('active');
					}

					if (self.getAttribute('data-id') == 'all') {
						section.querySelector('.data-label-a span').textContent = 'All'
					} else {
						section.querySelector('.data-label-a span').textContent = self.textContent
					}

					self.parentNode.classList.add('active');
					posts_by_month_load_post();
				});
			});
		}

		if (section.querySelector('.wcl-nav')) {
			if (window.matchMedia("(max-width: 575px)").matches) {
				let slider = section.querySelector('.d6-list')
				let swiper = new Swiper(slider, {
					slidesPerView: 'auto',
					spaceBetween: 43,
				});
			}
		}
	}

	// wcl-search

	if (document.querySelector('.wcl-search')) {
		let section = document.querySelector('.wcl-search')

		function search_page_load_post(paged_new, post_type_clear) {
			let paged = -1;
			let post_type = section.querySelector('.d6-item.active a').getAttribute('data-id')
			let search = section.getAttribute("data-search").trim();

			if (paged_new) {
				paged = paged_new
			}

			if (post_type_clear) {
				section.querySelector('.data-form input[name="post-type"]').value = post_type_clear
			}

			let data_req = {
				action: 'search_page_load_post',
				paged: parseInt(paged) + 1,
				post_type: post_type,
				search: search,
			}
			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);
					if (paged_new) {
						section.querySelector('.data-list').insertAdjacentHTML('beforeend', data.posts);
					} else {
						section.querySelector('.data-list').innerHTML = data.posts;
					}
					section.querySelector('.wcl-load-more .d2-container').innerHTML = data.button;
				};
			};
			data_req = new URLSearchParams(data_req).toString();
			xhr.send(data_req);
		}

		let load_more = section.querySelector('.wcl-load-more')
		if (load_more) {
			load_more.addEventListener("click", function (e) {
				e.preventDefault();
				if (e.target.classList.contains('d2-btn')) {
					let self = e.target;
					if (self.getAttribute("disable") == 'disable') {
						return false;
					}
					let paged = e.target.getAttribute("data-page");
					search_page_load_post(paged);
				}
			});
		}

		let cats = section.querySelectorAll('.d6-item a')
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

					let nodes = Array.prototype.slice.call(section.querySelectorAll('.d6-item'));
					let index = nodes.indexOf(this.parentNode);
					let types = section.getAttribute('data-post-types')
					types = JSON.parse(types);
					section.setAttribute('data-post-type', types[index].slug)

					let url = '';
					let post_type = section.querySelector('.d6-item.active a').getAttribute('data-id')
					url = new URL(window.location.href);
					url = url.href.replace(/post-type=[A-Za-z]+/, 'post-type=' + types[index].name.toLowerCase())
					window.history.pushState(wcl_obj.site_url, document.title, url);

					search_page_load_post(false, types[index].name.toLowerCase());
				});
			});
		}
	}

	// wcl-posts-landing

	if (document.querySelector('.wcl-posts-landing')) {
		let section = document.querySelector('.wcl-posts-landing')

		function initSlider() {
			section.querySelectorAll('.data-list:not(.swiper-initialized)').forEach(element => {
				let count = 3;
				if (window.matchMedia("(max-width: 575px)").matches) {
					count = 1
				} else if (window.matchMedia("(max-width: 767)").matches) {
					count = 2
				}
				if (element.querySelectorAll('.data-item').length > count) {
					let parent = element.closest('.data-a-item')
					let swiper = new Swiper(element, {
						slidesPerView: 3,
						spaceBetween: 80,
						autoHeight: true,
						navigation: {
							nextEl: parent.querySelector('.data-list-nav-btn.mod-next'),
							prevEl: parent.querySelector('.data-list-nav-btn.mod-prev'),
						},
						breakpoints: {
							0: {
								loop: true,
								slidesPerView: 'auto',
								centeredSlides: true,
								spaceBetween: 20,
							},
							576: {
								spaceBetween: 20,
								slidesPerView: 2,
							},
							767: {
								spaceBetween: 20,
								slidesPerView: 3,
							},
							991: {
								slidesPerView: 3,
								spaceBetween: 40,
							},
							1199: {
								slidesPerView: 3,
								spaceBetween: 80,
							},
						}
					});

					swiper.on('slideChange', function (e) {
						parent.querySelectorAll('.data-list-dots-item ').forEach(function (element_2, index) {
							let dot_index = element_2.getAttribute('data-index')
							if (swiper.activeIndex >= dot_index) {
								parent.querySelectorAll('.data-list-dots-item.active').forEach(element_3 => {
									element_3.classList.remove('active')
								});
								element_2.classList.add('active')
							}
						});
					});

					parent.querySelectorAll('.data-list-dots-item').forEach(element => {
						element.addEventListener('click', function (e) {
							let section = this.closest('.data-a-item')
							let index = this.getAttribute('data-index')
							section.querySelector('.data-list').swiper.slideTo(index, 700);
						})
					});
				}
			});
		}

		function posts_landing_page_load_post(event = '') {
			let paged = -1;
			let post_date = '';
			let category = section.querySelector('.d6-item.active a')

			if (category) {
				category = category.getAttribute("data-id");
			} else {
				category = 'all';
			}

			if (event == 'load-more') {
				post_date = section.querySelector('.wcl-load-more button').getAttribute('data-post-date')
			}

			let data_req = {
				action: 'posts_landing_page_load_post',
				paged: parseInt(paged) + 1,
				post_date: post_date,
				category: category,
			}
			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);
					if (event == 'load-more') {
						section.querySelector('.data-a .data-a-container').insertAdjacentHTML('beforeend', data.posts);
					} else {
						section.querySelector('.data-a .data-a-container').innerHTML = data.posts;
					}
					section.querySelector('.wcl-load-more .d2-container').innerHTML = data.button;
					initSlider();
				};
			};
			data_req = new URLSearchParams(data_req).toString();
			xhr.send(data_req);
		}

		let load_more = section.querySelector('.wcl-load-more')
		if (load_more) {
			load_more.addEventListener("click", function (e) {
				e.preventDefault();
				if (e.target.classList.contains('d2-btn')) {
					let self = e.target;
					if (self.getAttribute("disable") == 'disable') {
						return false;
					}
					posts_landing_page_load_post('load-more');
				}
			});
		}

		let cats = section.querySelectorAll('.d6-item a')
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

					if (self.getAttribute('data-id') == 'all') {
						section.querySelector('.data-title span').textContent = 'All'
					} else {
						section.querySelector('.data-title span').textContent = self.textContent
					}
					self.parentNode.classList.add('active');
					posts_landing_page_load_post();
				});
			});
		}

		if (section.querySelector('.wcl-nav')) {
			if (window.matchMedia("(max-width: 575px)").matches) {
				let slider = section.querySelector('.d6-list')
				let swiper = new Swiper(slider, {
					slidesPerView: 'auto',
					spaceBetween: 43,
				});
			}
		}

		section.querySelectorAll('.data-a-item').forEach(element => {
			let count = 3;
			if (window.matchMedia("(max-width: 575px)").matches) {
				count = 1
			} else if (window.matchMedia("(max-width: 767)").matches) {
				count = 2
			}
			if (element.querySelectorAll('.data-item').length > count) {
				let slider = element.querySelector('.data-list')
				let swiper = new Swiper(slider, {
					slidesPerView: 3,
					spaceBetween: 80,
					autoHeight: true,
					navigation: {
						nextEl: element.querySelector('.data-list-nav-btn.mod-next'),
						prevEl: element.querySelector('.data-list-nav-btn.mod-prev'),
					},
					breakpoints: {
						0: {
							loop: true,
							slidesPerView: 'auto',
							centeredSlides: true,
							spaceBetween: 20,
						},
						576: {
							spaceBetween: 20,
							slidesPerView: 2,
						},
						767: {
							spaceBetween: 20,
							slidesPerView: 3,
						},
						991: {
							slidesPerView: 3,
							spaceBetween: 40,
						},
						1199: {
							slidesPerView: 3,
							spaceBetween: 80,
						},
					}
				});

				swiper.on('slideChange', function (e) {
					element.querySelectorAll('.data-list-dots-item ').forEach(function (element_2, index) {
						let dot_index = element_2.getAttribute('data-index')
						if (swiper.activeIndex >= dot_index) {
							element.querySelectorAll('.data-list-dots-item.active').forEach(element_3 => {
								element_3.classList.remove('active')
							});
							element_2.classList.add('active')
						}
					});
				});
			}
		});

		section.querySelectorAll('.data-list-dots-item').forEach(element => {
			element.addEventListener('click', function (e) {
				let section = this.closest('.data-a-item')
				let index = this.getAttribute('data-index')
				section.querySelector('.data-list').swiper.slideTo(index, 700);
			})
		});
	}

	// wcl-category-sc-3

	if (document.querySelector('.wcl-category-sc-3')) {
		let section = document.querySelector('.wcl-category-sc-3')

		function category_page_load_post(paged_new) {
			let paged = -1;
			let category = section.querySelector('.d6-item.active a')
			let last_date = '';

			if (category) {
				category = category.getAttribute("data-id");
			} else {
				category = 'all';
			}

			if (paged_new) {
				last_date = section.querySelector('.wcl-load-more button').getAttribute("data-last-date");
				paged = paged_new;
			}

			let data_req = {
				action: 'category_page_load_post',
				category: category,
				last_date: last_date,
				paged: parseInt(paged) + 1,
			}

			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);
					if (paged_new) {
						if (data.posts_prev && data.posts_prev.posts.trim().length > 0) {
							section.querySelector('.data-a-item[data-id="' + data.posts_prev.date + '"] .data-list').insertAdjacentHTML('beforeend', data.posts_prev.posts);
						}
						if (data.posts) {
							section.querySelector('.data-a .data-a-container').insertAdjacentHTML('beforeend', data.posts);
						}
					} else {
						section.querySelector('.data-a .data-a-container').innerHTML = data.posts;
						document.querySelector('.wcl-category-sc-2 .data-row').innerHTML = data.first_post;
					}

					section.querySelector('.wcl-load-more .d2-container').innerHTML = data.button;
				};
			};
			data_req = new URLSearchParams(data_req).toString();
			xhr.send(data_req);
		}

		let load_more = section.querySelector('.wcl-load-more')
		if (load_more) {
			load_more.addEventListener("click", function (e) {
				e.preventDefault();
				if (e.target.classList.contains('d2-btn')) {
					let self = e.target;
					if (self.getAttribute("disable") == 'disable') {
						return false;
					}
					let paged = self.getAttribute("data-page");
					category_page_load_post(paged);
				}
			});
		}

		let term_key = section.getAttribute('data-term-key')

		if (section.querySelector('.wcl-nav')) {
			if (window.matchMedia("(max-width: 575px)").matches) {
				let slider = section.querySelector('.d6-list')
				let swiper = new Swiper(slider, {
					slidesPerView: 'auto',
					spaceBetween: 43,
					initialSlide: term_key,
				});
			}
		}

		let cats = section.querySelectorAll('.d6-item a')
		if (cats) {
			cats.forEach(element => {
				element.addEventListener("click", function (e) {
					e.preventDefault();
					if (this.parentNode.classList.contains('active')) {
						return false;
					}

					let self = this;

					if (section.querySelector('.d6-item.active')) {
						section.querySelector('.d6-item.active').classList.remove('active');
					}

					let url = '';
					let cat_slug = self.getAttribute('data-id')
					url = new URL(window.location.href);

					if (self.getAttribute('data-id') == 'all') {
						url = url.origin + '/category-landing';
					} else {
						url = url.origin + '/category/' + cat_slug;
					}

					window.history.pushState(wcl_obj.site_url, document.title, url);

					if (self.getAttribute('data-id') == 'all') {
						section.querySelector('.data-label-a span').textContent = 'All'
						document.querySelector('.wcl-category-sc-1 .data-title').textContent = 'All Posts'
					} else {
						section.querySelector('.data-label-a span').textContent = self.textContent
						document.querySelector('.wcl-category-sc-1 .data-title').textContent = self.textContent
					}

					self.parentNode.classList.add('active');
					category_page_load_post()
				});
			});
		}
	}

	// wcl-related-post

	if (document.querySelector('.wcl-related-post')) {
		let section = document.querySelector('.wcl-related-post')

		if (window.matchMedia("(min-width: 1199px)").matches) {
			section.querySelectorAll('.data-item').forEach(element => {
				element.addEventListener('mouseover', function (e) {
					section.querySelectorAll('.data-item.active').forEach(element_2 => {
						element_2.classList.remove('active')
					});

					this.classList.add('active')
				})
			});
		}


		if (window.matchMedia("(max-width: 1199px)").matches) {
			let swiper = new Swiper(section.querySelector('.data-list'), {
				slidesPerView: 3,
				spaceBetween: 0,
				breakpoints: {
					0: {
						slidesPerView: 'auto',
						centeredSlides: true,
						loop: true,
					},
					767: {
						slidesPerView: 3,
					},
					1199: {
						slidesPerView: 3,
					},
				}
			});
		}
	}

	// wcl-acf-block-3

	if (document.querySelector('.wcl-acf-block-3')) {
		let section = document.querySelector('.wcl-acf-block-3')

		document.querySelectorAll('.wcl-acf-block-3').forEach(element => {
			let swiper = new Swiper(element.querySelector('.data-list'), {
				slidesPerView: 4,
				spaceBetween: 30,
				speed: 750,
				navigation: {
					nextEl: element.querySelector('.data-list-nav-btn.mod-next'),
					prevEl: element.querySelector('.data-list-nav-btn.mod-prev'),
				},
				breakpoints: {
					0: {
						slidesPerView: 'auto',
						centeredSlides: true,
						loop: true,
					},
					767: {
						slidesPerView: 3,
					},
					1199: {
						slidesPerView: 4,
					},
				}
			});
		});
	}

	// wcl-outfits-p

	if (document.querySelector('.wcl-outfits-p')) {
		let section = document.querySelector('.wcl-outfits-p')

		function initSlider() {

			section.querySelectorAll('.data-list:not(.swiper-initialized)').forEach(element => {
				let count = 3;
				if (window.matchMedia("(max-width: 575px)").matches) {
					count = 1
				} else if (window.matchMedia("(max-width: 767)").matches) {
					count = 2
				}
				if (element.querySelectorAll('.data-item').length > count) {
					let parent = element.closest('.data-a-item')
					let swiper = new Swiper(element, {
						slidesPerView: 3,
						spaceBetween: 80,
						navigation: {
							nextEl: parent.querySelector('.data-list-nav-btn.mod-next'),
							prevEl: parent.querySelector('.data-list-nav-btn.mod-prev'),
						},
						breakpoints: {
							0: {
								loop: true,
								slidesPerView: 'auto',
								centeredSlides: true,
								spaceBetween: 20,
							},
							576: {
								spaceBetween: 20,
								slidesPerView: 2,
							},
							767: {
								spaceBetween: 20,
								slidesPerView: 3,
							},
							991: {
								slidesPerView: 3,
								spaceBetween: 40,
							},
							1199: {
								slidesPerView: 3,
								spaceBetween: 80,
							},
						}
					});

					swiper.on('slideChange', function (e) {
						parent.querySelectorAll('.data-list-dots-item ').forEach(function (element_2, index) {
							let dot_index = element_2.getAttribute('data-index')
							if (swiper.activeIndex >= dot_index) {
								parent.querySelectorAll('.data-list-dots-item.active').forEach(element_3 => {
									element_3.classList.remove('active')
								});
								element_2.classList.add('active')
							}
						});
					});

					parent.querySelectorAll('.data-list-dots-item').forEach(element => {
						element.addEventListener('click', function (e) {
							let section = this.closest('.data-a-item')
							let index = this.getAttribute('data-index')
							section.querySelector('.data-list').swiper.slideTo(index, 700);
						})
					});
				}
			});
		}

		function outfit_load_post(event) {
			let paged = -1;
			let post_date = '';

			if (event == 'load-more') {
				post_date = section.querySelector('.wcl-load-more button').getAttribute('data-post-date')
			}

			let data_req = {
				action: 'outfit_load_post',
				paged: parseInt(paged) + 1,
				post_date: post_date
			}
			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);
					if (event == 'load-more') {
						section.querySelector('.data-a .data-a-container').insertAdjacentHTML('beforeend', data.posts);
					} else {
						section.querySelector('.data-a .data-a-container').innerHTML = data.posts;
					}
					section.querySelector('.wcl-load-more .d2-container').innerHTML = data.button;
					initSlider();
				};
			};
			data_req = new URLSearchParams(data_req).toString();
			xhr.send(data_req);
		}

		let load_more = section.querySelector('.wcl-load-more')
		if (load_more) {
			load_more.addEventListener("click", function (e) {
				e.preventDefault();
				if (e.target.classList.contains('d2-btn')) {
					let self = e.target;
					if (self.getAttribute("disable") == 'disable') {
						return false;
					}
					let paged = self.getAttribute("data-page");
					outfit_load_post('load-more');
				}
			});
		}

		section.querySelectorAll('.data-a-item').forEach(element => {
			let count = 3;
			if (window.matchMedia("(max-width: 575px)").matches) {
				count = 1
			} else if (window.matchMedia("(max-width: 767)").matches) {
				count = 2
			}
			if (element.querySelectorAll('.data-item').length > count) {
				let slider = element.querySelector('.data-list')
				let swiper = new Swiper(slider, {
					slidesPerView: 3,
					spaceBetween: 80,
					navigation: {
						nextEl: element.querySelector('.data-list-nav-btn.mod-next'),
						prevEl: element.querySelector('.data-list-nav-btn.mod-prev'),
					},
					breakpoints: {
						0: {
							loop: true,
							slidesPerView: 'auto',
							centeredSlides: true,
							spaceBetween: 20,
						},
						576: {
							spaceBetween: 20,
							slidesPerView: 2,
						},
						767: {
							spaceBetween: 20,
							slidesPerView: 3,
						},
						991: {
							slidesPerView: 3,
							spaceBetween: 40,
						},
						1199: {
							slidesPerView: 3,
							spaceBetween: 80,
						},
					}
				});

				swiper.on('slideChange', function (e) {
					element.querySelectorAll('.data-list-dots-item ').forEach(function (element_2, index) {
						let dot_index = element_2.getAttribute('data-index')
						if (swiper.activeIndex >= dot_index) {
							element.querySelectorAll('.data-list-dots-item.active').forEach(element_3 => {
								element_3.classList.remove('active')
							});
							element_2.classList.add('active')
						}
					});
				});
			}
		});

		section.querySelectorAll('.data-list-dots-item').forEach(element => {
			element.addEventListener('click', function (e) {
				let section = this.closest('.data-a-item')
				let index = this.getAttribute('data-index')
				section.querySelector('.data-list').swiper.slideTo(index, 700);
			})
		});
	}

	// wcl-outfit-p

	if (document.querySelector('.wcl-outfit-p')) {
		let section = document.querySelector('.wcl-outfit-p')
		let images = section.querySelector('.data-gallery').getAttribute('data-images')
		images = JSON.parse(images);

		function gallery_next_img() {
			let gallery = section.querySelector('.data-gallery')
			let active = gallery.querySelector('img.active')
			let nodes = Array.prototype.slice.call(gallery.querySelectorAll('img'));
			let active_index = nodes.indexOf(active);
			let images = gallery.getAttribute('data-images')
			let items_image = gallery.querySelectorAll('img')
			images = JSON.parse(images);
			let index = parseInt(gallery.getAttribute('data-index'))
			if (index == 3) {
				index = 0
			}
			index = index + 1

			gallery.setAttribute('data-index', index)

			let active_index_offset = -1;
			if (!items_image[active_index - 1]) {
				active_index_offset = 1;
			}

			items_image[active_index + active_index_offset].classList.remove('next')
			items_image[active_index + active_index_offset].classList.add('active')
			items_image[active_index].classList.remove('active')
			items_image[active_index].classList.add('next')

			setTimeout(() => {
				if (images.length > 2) {
					if (index == 3) {
						index = 0
					}
					gallery.querySelector('img.next').src = images[index]
				}
			}, 0);
		}

		if (section.querySelector('.data-gallery-nav-btn')) {
			section.querySelector('.data-gallery-nav-btn.mod-next').addEventListener('click', function (e) {
				gallery_next_img();
			})
		}


		if (section.querySelector('.mod-more-one .data-gallery-out')) {
			section.querySelector('.mod-more-one .data-gallery-out').addEventListener('click', function (e) {
				if (!e.target.closest('.data-gallery-nav')) {
					gallery_next_img();
				}
			})
		}

		if (section.querySelector('.data-gallery-nav-btn')) {
			section.querySelector('.data-gallery-nav-btn.mod-prev').addEventListener('click', function (e) {
				let gallery = section.querySelector('.data-gallery')
				let active = gallery.querySelector('img.active')
				let nodes = Array.prototype.slice.call(gallery.querySelectorAll('img'));
				let active_index = nodes.indexOf(active);
				let images = gallery.getAttribute('data-images')
				let items_image = gallery.querySelectorAll('img')
				images = JSON.parse(images);
				let index = parseInt(gallery.getAttribute('data-index'))
				index = index - 1

				if (index == 0) {
					index = 3
				}

				gallery.setAttribute('data-index', index)

				let active_index_offset = -1;
				if (!items_image[active_index - 1]) {
					active_index_offset = 1;
				}

				items_image[active_index + active_index_offset].classList.remove('next')
				items_image[active_index + active_index_offset].classList.add('active')
				items_image[active_index].classList.remove('active')
				items_image[active_index].classList.add('next')

				setTimeout(() => {
					if (images.length > 2) {
						gallery.querySelector('img.active').src = images[index - 1]
					}
				}, 0);
			})
		}
	}

	// wcl-video-sc-2

	if (document.querySelector('.wcl-video-sc-2')) {
		let section = document.querySelector('.wcl-video-sc-2')

		function initSlider() {
			let slider = section.querySelector('.data-product:not(.swiper-initialized)');
			let swiper = new Swiper(slider, {
				slidesPerView: 1,
				spaceBetween: 10,
				navigation: {
					nextEl: slider.querySelector('.data-product-nav-btn.mod-next'),
					prevEl: slider.querySelector('.data-product-nav-btn.mod-prev'),
				},
			});
		}

		function get_last_item(index_out, self) {
			let section = self.closest('.data-a-item')
			let index_new = Math.ceil(index_out / 3) * 3

			if (window.matchMedia("(max-width: 575px)").matches) {
				index_new = index_out
			} else if (window.matchMedia("(max-width: 991px)").matches) {
				index_new = Math.ceil(index_out / 2) * 2
			}

			let item = section.querySelectorAll('.data-item')[index_new - 1]

			if (!item) {
				item = section.querySelectorAll('.data-item')[section.querySelectorAll('.data-item').length - 1];
			}
			return item;
		}

		function set_video(index, self) {
			let post_id = self.parentElement.getAttribute('data-post-id')
			let last_item = get_last_item(index + 1, self)
			let iframe = self.querySelector('.data-item-iframe')
			let product = self.querySelector('.data-product-a')
			let product_class = '';
			if (product) {
				product_class = 'mod-product'
			}
			let info = '<div class="data-b ' + product_class + '" data-id="' + post_id + '">';

			if (iframe) {
				iframe = iframe.getAttribute('data-video');
				let tag = '<div class="data-item-video">' +
					'<div class="data-item-video-inner">' + iframe + '</div>' +
					'</div>';

				info += '<div class="data-b-col">' + tag + '</div>';
			}

			if (product) {
				let tag = product.getAttribute('data-product');
				info += '<div class="data-b-col">' + tag + '</div>';
			}

			info += '</div>';

			if (iframe || product) {
				last_item.insertAdjacentHTML('afterEnd', info);
				if (product) {
					initSlider();
				}
				setTimeout(() => {
					section.querySelector('.data-b').classList.add('active')
				}, 1);
			}
		}

		section.querySelector('.data-a').addEventListener("click", function (e) {
			if (e.target.closest('.data-item-inner')) {
				e.preventDefault()
				let section_new = e.target.closest('.data-a-item')
				let self = e.target.closest('.data-item-inner')
				if (section.querySelector('.data-item.active-video')) {
					section.querySelector('.data-item.active-video').classList.remove('active-video')
				}
				self.parentElement.classList.add('active-video')

				let post_id = self.parentElement.getAttribute('data-post-id')
				let nodes = Array.prototype.slice.call(section_new.querySelectorAll('.data-item'));
				let index = nodes.indexOf(self.parentElement);
				if (section.querySelector('.data-b')) {
					if (section.querySelector('.data-b').getAttribute('data-id') == post_id) {
						section.querySelector('.data-b').remove()
						self.parentElement.classList.remove('active-video')
					} else {
						section.querySelector('.data-b').remove()
						set_video(index, self)
					}
				} else {
					set_video(index, self)
				}
			}
		});

		if (window.location.hash && section.querySelector(window.location.hash)) {
			let item = section.querySelector(window.location.hash)
			item.classList.add('active-video')
			let section_new = item.closest('.data-a-item')
			let self = item.querySelector('.data-item-inner')
			let post_id = self.parentElement.getAttribute('data-post-id')
			let nodes = Array.prototype.slice.call(section_new.querySelectorAll('.data-item'));
			let index = nodes.indexOf(self.parentElement);
			set_video(index, self)
		}

		function video_page_load_post(paged_new) {
			let paged = -1;
			let category = section.querySelector('.d6-item.active a')
			let last_date = '';

			if (category) {
				category = category.getAttribute("data-id");
			} else {
				category = 'all';
			}

			if (paged_new) {
				last_date = section.querySelector('.wcl-load-more button').getAttribute("data-last-date");
				paged = paged_new;
			}
			let data_req = {
				action: 'video_page_load_post',
				category: category,
				last_date: last_date,
				paged: parseInt(paged) + 1,
			}
			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);
					if (paged_new) {
						if (data.posts_prev && data.posts_prev.posts.trim().length > 0) {
							section.querySelector('.data-a-item[data-id="' + data.posts_prev.date + '"] .data-list').insertAdjacentHTML('beforeend', data.posts_prev.posts);
						}
						if (data.posts) {
							section.querySelector('.data-a .data-a-container').insertAdjacentHTML('beforeend', data.posts);
						}
					} else {
						section.querySelector('.data-a .data-a-container').innerHTML = data.posts;
					}

					section.querySelector('.wcl-load-more .d2-container').innerHTML = data.button;
				};
			};
			data_req = new URLSearchParams(data_req).toString();
			xhr.send(data_req);
		}

		let cats = section.querySelectorAll('.d6-item a')
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
					section.querySelector('.data-label-a span').textContent = self.querySelector('span:first-child').textContent
					self.parentNode.classList.add('active');
					video_page_load_post();
				});
			});
		}

		if (section.querySelector('.wcl-nav')) {
			if (window.matchMedia("(max-width: 575px)").matches) {
				let slider = section.querySelector('.d6-list')
				let swiper = new Swiper(slider, {
					slidesPerView: 'auto',
					spaceBetween: 43,
				});
			}
		}

		let load_more = section.querySelector('.wcl-load-more')
		if (load_more) {
			load_more.addEventListener("click", function (e) {
				e.preventDefault();
				if (e.target.classList.contains('d2-btn')) {
					let self = e.target;
					if (self.getAttribute("disable") == 'disable') {
						return false;
					}
					let paged = self.getAttribute("data-page");
					video_page_load_post(paged);
				}
			});
		}
	}

	// wcl-collection-sc-3

	if (document.querySelector('.wcl-collection-sc-3')) {
		let section = document.querySelector('.wcl-collection-sc-3')

		function collection_load_post(paged_new) {
			let paged = -1;
			let collection = section.getAttribute('data-collection');

			if (paged_new) {
				paged = paged_new;
			}

			let data_req = {
				action: 'collection_load_post',
				collection: collection,
				paged: parseInt(paged) + 1,
			}
			section.querySelector('.data-list').classList.add('active')
			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);
					section.querySelector('.data-list').classList.remove('active')
					if (paged_new) {
						section.querySelector('.data-list').insertAdjacentHTML('beforeend', data.posts);
						section.querySelector('.wcl-load-more .d2-container').innerHTML = data.button;
					}
				};
			};
			data_req = new URLSearchParams(data_req).toString();
			xhr.send(data_req);
		}

		// wcl-load-more
		let load_more = section.querySelector('.wcl-load-more')
		if (load_more) {
			load_more.addEventListener("click", function (e) {
				e.preventDefault();
				if (e.target.classList.contains('d2-btn')) {
					if (e.target.getAttribute("disable") == 'disable') {
						return false;
					}
					let paged = e.target.getAttribute("data-page");
					collection_load_post(paged);
				}
			});
		}

	}

	// wcl-shop-posts

	if (document.querySelector('.wcl-shop-posts')) {
		let section = document.querySelector('.wcl-shop-posts')

		section.querySelector('.data-close').addEventListener('click', function (e) {
			section.classList.remove('active')
			section.querySelector('.wcl-shop-posts .data-container').innerHTML = '';
		})

		section.addEventListener('click', function (e) {
			if (!e.target.closest('.wcl-shop-posts .data-item') && !e.target.closest('.data-list-nav-btn')) {
				section.classList.remove('active')
				section.querySelector('.wcl-shop-posts .data-container').innerHTML = '';
			}
		})
	}

	// js-shop

	if (document.querySelector('.js-shop')) {
		let section = document.querySelector('.js-shop')
		let section_two = document.querySelector('.wcl-shop-posts')
		function shop_page_slider_init() {
			section_two.classList.add('nav-active')
			let slider = section_two.querySelector('.data-list');
			let swiper = new Swiper(slider, {
				slidesPerView: 3,
				spaceBetween: 15,
				navigation: {
					nextEl: slider.parentElement.querySelector('.data-list-nav-btn.mod-next'),
					prevEl: slider.parentElement.querySelector('.data-list-nav-btn.mod-prev'),
				},
				breakpoints: {
					0: {
						loop: true,
						slidesPerView: 'auto',
						centeredSlides: true,
						spaceBetween: 15,
					},
					576: {
						slidesPerView: 2,
					},
					991: {
						slidesPerView: 3,
					},
				}
			});
		}


		let selector = '.d4-binding'
		if (document.querySelector('body').classList.contains('single-cd-outfit')) {
			selector = '.data-item-binding'
		}

		section.querySelector('.data-list').addEventListener('click', function (e) {
			if (e.target.closest(selector)) {
				e.preventDefault()
				let item = e.target.closest('.data-item')
				let posts = item.getAttribute('data-related-posts')

				let data_req = {
					action: 'shop_page_load_related_posts',
					posts: posts,
				}
				let xhr = new XMLHttpRequest();
				xhr.open('POST', wcl_obj.ajax_url, true);
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

				section_two.classList.add('active')

				xhr.onload = function (data) {
					if (xhr.status >= 200 && xhr.status < 400) {
						var data = JSON.parse(xhr.responseText);
						section_two.querySelector('.data-container').innerHTML = data.posts;
						section_two.classList.remove('nav-active')

						if (window.matchMedia("(max-width: 575px)").matches) {
							if (section_two.querySelectorAll('.data-item').length > 1) {
								shop_page_slider_init()
							}
						} else if (window.matchMedia("(max-width: 991px)").matches) {
							if (section_two.querySelectorAll('.data-item').length > 2) {
								shop_page_slider_init()
							}
						} else {
							if (section_two.querySelectorAll('.data-item').length > 3) {
								shop_page_slider_init()
							}
						}
					};
				};
				data_req = new URLSearchParams(data_req).toString();
				xhr.send(data_req);
			}
		})
	}

	// wcl-shop

	if (document.querySelector('.wcl-shop')) {
		let section = document.querySelector('.wcl-shop')

		function shop_load_post(paged_new) {
			let paged = -1;
			let category = '';
			let category_inputs = section.querySelectorAll('.wcl-field-checkbox input[name="cd-product-category"]');
			for (var i = 0, n = category_inputs.length; i < n; i++) {
				if (category_inputs[i].checked) {
					category += "," + category_inputs[i].value;
				}
			}
			if (category) {
				category = category.substring(1);
			}

			if (paged_new) {
				paged = paged_new;
			}

			let data_req = {
				action: 'shop_load_post',
				category: category,
				paged: parseInt(paged) + 1,
			}
			section.querySelector('.data-list').classList.add('active')
			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);
					section.querySelector('.data-list').classList.remove('active')
					if (paged_new) {
						section.querySelector('.data-list').insertAdjacentHTML('beforeend', data.posts);
						section.querySelector('.wcl-load-more .d2-container').innerHTML = data.button;
					} else {
						section.querySelector('.data-list').innerHTML = data.posts;
						section.querySelector('.wcl-load-more .d2-container').innerHTML = data.button;
					}
				};
			};
			data_req = new URLSearchParams(data_req).toString();
			xhr.send(data_req);
		}

		// wcl-load-more
		let load_more = section.querySelector('.wcl-load-more')
		if (load_more) {
			load_more.addEventListener("click", function (e) {
				e.preventDefault();
				if (e.target.classList.contains('d2-btn')) {
					if (e.target.getAttribute("disable") == 'disable') {
						return false;
					}
					let paged = e.target.getAttribute("data-page");
					shop_load_post(paged);
				}
			});
		}

		section.querySelectorAll('.wcl-field-checkbox input').forEach(element => {
			element.addEventListener('change', function (e) {
				section.querySelectorAll('.wcl-field-checkbox input').forEach(element_t2 => {
					element_t2.removeAttribute('checked');
				});

				this.setAttribute('checked', 'checked');
				shop_load_post();
			})
		});

		if (section.querySelectorAll('.data-nav-item')) {
			section.querySelectorAll('.data-nav-item').forEach(element => {
				element.querySelector('.data-nav-item-a').addEventListener('click', function (e) {
					if (this.closest('.data-nav-item').classList.contains('active')) {
						this.closest('.data-nav-item').classList.remove('active')
					} else {
						this.closest('.data-nav-item').classList.add('active')
					}
				})
			});
		}

	}

	// wcl-section-11

	if (document.querySelector('.wcl-section-11')) {
		let section = document.querySelector('.wcl-section-11')

		section.querySelectorAll('.data-item-question').forEach(element => {
			element.addEventListener('click', function (e) {
				if (this.parentElement.classList.contains('active')) {
					this.parentElement.classList.remove('active')
				} else {
					this.parentElement.classList.add('active')
				}

				section.querySelectorAll('.data-item.active').forEach(element => {
					if (this.parentElement != element) {
						element.classList.remove('active')
					}
				});
			})
		});
	}

	// wcl-section-8

	if (document.querySelector('.wcl-section-8')) {
		let section = document.querySelector('.wcl-section-8')
		let slider = section.querySelector('.data-list')
		let swiper = new Swiper(slider, {
			slidesPerView: 1,
			spaceBetween: 10,
			autoHeight: true,
			effect: 'fade',
			speed: 300,
			navigation: {
				nextEl: section.querySelector('.data-list-nav-btn.mod-next'),
				prevEl: section.querySelector('.data-list-nav-btn.mod-prev'),
			},
		});

		section.querySelector('.data-list').addEventListener('click', function (e) {
			if (!e.target.closest('.data-list-nav-btn') && !e.target.matches('.wcl-link')) {
				swiper.slideNext();
			}
		})

		swiper.on('slideChange', function (e) {
			if (swiper.isEnd) {
				section.classList.add('last-slide')
			} else {
				section.classList.remove('last-slide')
			}
		});

		section.querySelectorAll('.data-item-desc').forEach(element => {
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

	// wcl-section-2

	if (document.querySelector('.wcl-section-2')) {
		let section = document.querySelector('.wcl-section-2')
		section.querySelectorAll('.data-item').forEach(element => {
			let slider = element.querySelector('.data-item-b')
			if (slider) {
				let swiper = new Swiper(slider, {
					slidesPerView: 1,
					spaceBetween: 10,
					navigation: {
						nextEl: slider.querySelector('.data-item-b-nav-btn.mod-next'),
						prevEl: slider.querySelector('.data-item-b-nav-btn.mod-prev'),
					},
				});
			}
		});
	}

	// wcl-section-6

	if (document.querySelector('.wcl-section-6')) {
		let section = document.querySelector('.wcl-section-6')
		let swiper = new Swiper(section.querySelector('.data-list'), {
			slidesPerView: 'auto',
			centeredSlides: true,
			spaceBetween: 10,
			loop: true,
			autoHeight: true,
			slideToClickedSlide: true,
			speed: 600,
			navigation: {
				nextEl: section.querySelector('.data-list-nav-btn.mod-next'),
				prevEl: section.querySelector('.data-list-nav-btn.mod-prev'),
			},
			breakpoints: {
				0: {
					spaceBetween: 4,
				},
				768: {
					spaceBetween: 10,
				},
			}
		});

		section.querySelectorAll('.data-item-inner').forEach(element => {
			element.addEventListener('click', function (e) {
				let main_index = section.querySelector('.data-list').getAttribute('data-index')
				if (swiper.activeIndex != main_index) {
					e.preventDefault()
				}
				section.querySelector('.data-list').setAttribute('data-index', swiper.activeIndex)
			})
		});

		swiper.on('slideChange', function () {
			setTimeout(() => {
				section.querySelector('.data-list').setAttribute('data-index', swiper.activeIndex)
			}, 10);
		});
	}

	// wcl-section-9

	if (document.querySelector('.wcl-section-9')) {
		let section = document.querySelector('.wcl-section-9');

		let swiper = new Swiper(section.querySelector('.data-list'), {
			slidesPerView: 1,
			loop: true,
			speed: 600,
			effect: 'fade',
			autoplay: {
				delay: 4000,
				disableOnInteraction: false,
			},
		});

		section.querySelectorAll('.data-text').forEach(element => {
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

	// wcl-section-5

	if (document.querySelector('.wcl-section-5')) {
		let section = document.querySelector('.wcl-section-5');

		section.querySelectorAll('.data-item-a-desc').forEach(element => {
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

		if (window.matchMedia("(min-width: 1199px)").matches) {
			section.querySelectorAll('.data-item').forEach(element => {
				element.addEventListener('click', function (e) {
					let nodes = Array.prototype.slice.call(section.querySelectorAll('.data-item'));
					let index = nodes.indexOf(this);
					if (index == 2) {
						section.querySelectorAll('.data-item')[1].classList.add('moved')
					}

					if (!this.classList.contains('active')) {
						section.querySelectorAll('.data-item').forEach(element => {
							let index = nodes.indexOf(element);
							element.classList.remove('active')
							if (index == 1) {
								if (section.classList.contains('mod-two')) {
									element.style.left = 'calc(100% - 83px)';

								} else {
									element.style.left = 'calc(100% - 146px)';
								}
							}
							if (index == 2) {
								element.style.left = 'calc(100% - 83px)';
							}
						});
						this.classList.add('active')
					}

					if (index == 0) {
						section.querySelectorAll('.data-item').forEach(element => {
							element.classList.remove('moved')
						});
					} else {
						if (index == 1) {
							section.querySelectorAll('.data-item').forEach(element => {
								if (element != this) {
									element.classList.remove('moved')
								}
							});
						}
						if (!this.classList.contains('moved')) {
							this.classList.add('moved')
						} else {
							if (!this.classList.contains('active')) {
								this.classList.remove('moved')
							}
						}
					}

					let offset = index * 55;
					if (index == 2) {
						this.style.left = offset + 'px';
						section.querySelectorAll('.data-item')[1].style.left = '55' + 'px';
					} else {
						this.style.left = offset + 'px';
					}
				})
			});
		} else {
			let nodes = Array.prototype.slice.call(section.querySelectorAll('.data-nav-item'));
			section.querySelectorAll('.data-nav-item').forEach(element => {
				element.addEventListener('click', function (e) {
					let index = nodes.indexOf(this);

					section.querySelectorAll('.data-nav-item.active').forEach(element_two => {
						if (element_two != this) {
							element_two.classList.remove('active')
							section.querySelector('.data-item.active').classList.remove('active')
						}
					});

					if (this.classList.contains('active')) {
						this.classList.remove('active')
						section.querySelectorAll('.data-item')[index].classList.remove('active')
					} else {
						this.classList.add('active')
						section.querySelectorAll('.data-item')[index].classList.add('active')
					}
				})
			});
		}
	}

	// wcl-section-4

	if (document.querySelector('.wcl-section-4')) {
		let section = document.querySelector('.wcl-section-4');
		let slider = section.querySelector('.data-list')
		let swiper = new Swiper(slider, {
			slidesPerView: 5,
			speed: 500,
			breakpoints: {
				0: {
					loop: true,
					slidesPerView: 'auto',
					centeredSlides: true,
					spaceBetween: 15,
				},
				375: {
					spaceBetween: 30,
					loop: true,
					slidesPerView: 'auto',
					centeredSlides: true,
				},
				575: {
					slidesPerView: 3,
				},
				768: {
					slidesPerView: 4,
				},
				991: {
					slidesPerView: 5,
				},
			}
		});
	}

	// wcl-header-search

	if (document.querySelector('.wcl-header-search')) {
		let section = document.querySelector('.wcl-header-search');
		section.addEventListener('click', function (e) {
			if (!e.target.closest('.data-inner')) {
				document.querySelector('body').classList.remove('overflow-hidden')
				section.classList.remove('active')
			}
		});

		section.querySelector('.data-filter-view').addEventListener('click', function (e) {
			if (section.querySelector('.data-filter').classList.contains('active')) {
				section.querySelector('.data-filter').classList.remove('active')
			} else {
				section.querySelector('.data-filter').classList.add('active')
			}
		})

		section.querySelectorAll('.data-filter-item').forEach(element => {
			element.addEventListener('click', function (e) {
				let val_main = section.querySelector('.data-filter-view').getAttribute('data-val');
				let val = this.getAttribute('data-val');
				this.setAttribute('data-val', val_main);
				section.querySelector('.data-filter-view').setAttribute('data-val', val);
				section.querySelector('input[name="post-type"]').value = val
				this.querySelector('span').innerText = 'By ' + val_main
				section.querySelector('.data-filter-view span').innerText = 'By ' + val

				if (section.querySelector('.data-filter').classList.contains('active')) {
					section.querySelector('.data-filter').classList.remove('active')
				} else {
					section.querySelector('.data-filter').classList.add('active')
				}
			})
		});

		section.querySelector('button[type="reset"]').addEventListener('click', function (e) {
			section.querySelector('input[name="s"]').value = '';
			document.querySelector('body').classList.remove('overflow-hidden')
			section.classList.remove('active')
		})
	}

	// wcl-header

	if (document.querySelector('.wcl-header')) {
		let section = document.querySelector('.wcl-header');
		section.querySelector('.data-a').addEventListener('click', function (e) {
			if (document.querySelector('.wcl-header-menu').classList.contains('active')) {
				document.querySelector('body').classList.remove('overflow-hidden')
				this.querySelector('.data-a-item:nth-child(2)').classList.remove('active')
				this.querySelector('.data-a-item:nth-child(1)').classList.add('active')
				document.querySelector('.wcl-header-menu').classList.remove('active')
			} else {
				document.querySelector('body').classList.add('overflow-hidden')
				this.querySelector('.data-a-item:nth-child(1)').classList.remove('active')
				this.querySelector('.data-a-item:nth-child(2)').classList.add('active')
				document.querySelector('.wcl-header-menu').classList.add('active')
			}
		});

		if (section.querySelector('.mod-search')) {
			section.querySelector('.mod-search').addEventListener('click', function (e) {
				e.preventDefault()
				if (document.querySelector('.wcl-header-search').classList.contains('active')) {
					document.querySelector('body').classList.remove('overflow-hidden')
					document.querySelector('.wcl-header-search').classList.remove('active')
				} else {
					document.querySelector('body').classList.add('overflow-hidden')
					document.querySelector('.wcl-header-search').classList.add('active')
				}
			})
		}

		if (window.matchMedia("(max-width: 767px)").matches) {
			section.querySelector('.data-search').addEventListener('click', function (e) {
				if (document.querySelector('.wcl-header-search').classList.contains('active')) {
					document.querySelector('body').classList.remove('overflow-hidden')
					document.querySelector('.wcl-header-search').classList.remove('active')
				} else {
					document.querySelector('body').classList.add('overflow-hidden')
					document.querySelector('.wcl-header-search').classList.add('active')
				}
			})
		}
	}

	// wcl-instagram

	if (document.querySelector('.wcl-instagram')) {
		let section = document.querySelector('.wcl-instagram')

		window.sbi_custom_js = function () {
			let items = section.querySelectorAll('.sbi_item')
			let items_2 = section.querySelectorAll('.data-item')

			for (let index = 0; index < items.length; index++) {
				let item = items[index]
				let tag = '<div class="data-item swiper-slide">' + item.outerHTML + '</div>';
				section.querySelector('.data-list-inner').insertAdjacentHTML('beforeend', tag);
			}

			let slider = section.querySelector('.data-list')
			let swiper = new Swiper(slider, {
				slidesPerView: 3,
				slidesPerView: 'auto',
				centeredSlides: true,
				spaceBetween: 18,
				loop: true,
			});
		}
	}
});