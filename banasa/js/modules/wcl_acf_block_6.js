
// wcl_acf_block_6

function wcl_acf_block_6() {

	// wcl-acf-block-6
	if (document.querySelector('.wcl-acf-block-6')) {
		let section = document.querySelector('.wcl-acf-block-6')

		check_overflow_text('.wcl-acf-block-6 .data-item-desc');

		window.addEventListener('resize', () => {
			check_overflow_text('.wcl-acf-block-6 .data-item-desc');
		});
	}


	// wcl-acf-block-6 / posts
	if (document.querySelector('.wcl-acf-block-6')) {
		let section = document.querySelector('.wcl-acf-block-6')
		let load_more = section.querySelector('.data-load-more')
		let cats = section.querySelectorAll('.data-cats a')
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
					projects_listing_load_posts(page);
				}
			});
		}


		// cats
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

					if (this.classList.contains('active')) {
						if (section.querySelector('.data-load-more-btn').getAttribute("data-page") != '1') {
							projects_listing_load_posts();
							return;
						}

						return;
					}

					section.querySelectorAll('.data-cats a.active').forEach(element_2 => {
						if (element_2 != this) {
							element_2.classList.remove('active');
						}
					});

					if (self.classList.contains('active')) {
						self.classList.remove('active');
					} else {
						self.classList.add('active');
					}

					projects_listing_load_posts();
				});
			});
		}


		// projects_listing_load_posts
		function projects_listing_load_posts(page_new) {
			let page = 1;
			let category = '';

			if (section.querySelector('.data-cats a.active')) {
				category = section.querySelector('.data-cats a.active').getAttribute('data-slug')
			}

			if (page_new) {
				page = parseInt(page_new) + 1;
			}

			let data_request = {
				action: 'projects_listing_load_posts',
				page: page,
				category: category,
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

					check_overflow_text('.wcl-acf-block-6 .data-item-desc');
				};
			};

			data_request = new URLSearchParams(data_request).toString();
			xhr.send(data_request);
		}


		// generate_url
		function generate_url(data) {
			let language = document.querySelector('html').getAttribute('lang')
			let slug_page = section.getAttribute('data-slug-page')
			let slug_category = section.getAttribute('data-slug-category')
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

				console.log(slug_category)

				url += slug_category + '/';
				url += data.category + '/';
			}

			// page
			if (data.page && data.page != 1) {
				url += 'page/' + data.page + '/';
			}


			window.history.pushState(wcl_obj.site_url, document.title, url);
		}
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
}

document.addEventListener('DOMContentLoaded', function () {
	wcl_acf_block_6();
});
