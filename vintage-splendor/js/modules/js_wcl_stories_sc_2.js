

// js_wcl_stories_sc_2

function js_wcl_stories_sc_2() {

	if (document.querySelector('.wcl-stories-sc-2.js-wcl-stories-sc-2')) {
		let section = document.querySelector('.wcl-stories-sc-2')

		function stories_page_load_post(paged_new) {
			let paged = -1;
			let tag = '';
			let cat = '';
			let section_name = '';
			let search = '';
			//let curr_tag_url = 

			if (document.querySelector('.wcl-stories-sc-1 .data-nav-item.active a')) {
				tag = document.querySelector('.wcl-stories-sc-1 .data-nav-item.active a').getAttribute('data-id')
			}

			if (section.hasAttribute('data-search')) {
				search = section.getAttribute('data-search')
			}

			if (section.hasAttribute('data-cat')) {
				cat = section.getAttribute('data-cat')
			}

			if (section.hasAttribute('data-section-name')) {
				section_name = section.getAttribute('data-section-name')
			}

			if (paged_new) {
				paged = paged_new
			}

			let data_req = {
				action: 'stories_page_load_post',
				paged: parseInt(paged) + 1,
				tag: tag,
				cat: cat,
				section_name: section_name,
				search: search,
			}

			section.querySelector('button').setAttribute('disabled', 'disabled')
			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);
					section.querySelector('button').removeAttribute('disabled')

					if (paged_new) {
						section.querySelector('.data-list').insertAdjacentHTML('beforeend', data.posts);
					} else {
						section.querySelector('.data-list').innerHTML = data.posts;
					}

					section.querySelector('.wcl-t4-load-more .t4-container').innerHTML = data.button;

					if (section.classList.contains('mod-odd')) {
						section.classList.remove('mod-odd')
					}

					if (data.count_posts === 0) {
						section.classList.add('mod-empty-posts')
					} else {
						if (data.count_posts % 2 !== 0) {
							section.classList.add('mod-odd')
						}

						if (section.classList.contains('mod-empty-posts')) {
							section.classList.remove('mod-empty-posts')
						}
					}

					if (data.count_posts) {
						if (data.count_posts % 2 !== 0) {
							section.querySelector('.wcl-t4-load-more').classList.add('mod-offset-clear')
						} else {
							if (section.querySelector('.wcl-t4-load-more').classList.contains('mod-offset-clear')) {
								section.querySelector('.wcl-t4-load-more').classList.remove('mod-offset-clear')
							}
						}
					}
				};
			};
			data_req = new URLSearchParams(data_req).toString();
			xhr.send(data_req);
		}

		let load_more = section.querySelector('.wcl-t4-load-more')
		if (load_more) {
			load_more.addEventListener("click", function (e) {
				e.preventDefault();
				if (e.target.classList.contains('t4-btn')) {
					let self = e.target;

					if (self.getAttribute("disable") == 'disable') {
						return false;
					}

					let paged = e.target.getAttribute("data-page");

					stories_page_load_post(paged);
				}
			});
		}

		let cats_sections = document.querySelectorAll('.wcl-stories-sc-1')
		if (cats_sections && true) {
			cats_sections.forEach(cats_section => {
				cats_section.querySelectorAll('.data-nav-item a').forEach(element => {
					element.addEventListener("click", function (e) {
						e.preventDefault();

						if (this.parentNode.classList.contains('active')) {
							window.scrollTo({
								top: 0,
								behavior: 'smooth'
							});

							return false;
						}

						let self = this;

						let curr_section = element.closest('.wcl-stories-sc-1')
						let second_section = Array.from(cats_sections).filter(function (item) {
							return item !== curr_section;
						});

						// Class active
						curr_section.querySelectorAll('.data-nav-item a').forEach(element_2 => {
							element_2.parentNode.classList.remove('active');
						});

						let nodes = Array.prototype.slice.call(curr_section.querySelectorAll('.data-nav-item'));
						let active_index = nodes.indexOf(self.parentNode);

						self.parentNode.classList.add('active');

						second_section[0].querySelectorAll('.data-nav-item a').forEach(element_2 => {
							element_2.parentNode.classList.remove('active');
						});

						second_section[0].querySelectorAll('.data-nav-item')[active_index].classList.add('active');

						// url
						let url = '';

						if (document.querySelector('.wcl-exclusive-cat')) {
							let cat_link = section.getAttribute('data-cat-link')
							if (self.getAttribute('data-id') == 'all') {
								url = cat_link
							} else {
								url = cat_link + self.getAttribute('data-id')
							}
						} else {
							if (self.getAttribute('data-id') == 'all') {
								url = wcl_obj.site_url + 'stories/'
							} else {
								url = wcl_obj.site_url + 'stories/' + self.getAttribute('data-id')
							}
						}

						window.history.pushState(wcl_obj.site_url, document.title, url);

						stories_page_load_post();

						window.scrollTo({
							top: 0,
							behavior: 'smooth'
						});
					});
				});
			});
		}
	}
}

export default js_wcl_stories_sc_2;