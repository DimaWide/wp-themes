

// wcl_shop_sc_2

function wcl_shop_sc_2() {
	if (document.querySelector('.wcl-shop-sc-2')) {
		let section = document.querySelector('.wcl-shop-sc-2')

		function shop_page_load_post(paged_new) {
			let paged = -1;
			let tag = document.querySelector('.wcl-shop-sc-1 .data-nav-item.active a').getAttribute('data-id')
			let cycle = '';

			if (paged_new) {
				paged = paged_new
				cycle = section.querySelector('.wcl-t4-load-more button').getAttribute("data-cycle");
			}

			let data_req = {
				action: 'shop_page_load_post',
				paged: parseInt(paged) + 1,
				tag: tag,
				cycle: cycle,
			}

			if (section.querySelector('button')) {
				section.querySelector('button').setAttribute('disabled', 'disabled')
			}

			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);
					if (section.querySelector('button')) {
						section.querySelector('button').removeAttribute('disabled')
					}

					if (paged_new) {
						section.querySelector('.data-list').insertAdjacentHTML('beforeend', data.posts);
					} else {
						section.querySelector('.data-list').innerHTML = data.posts;
					}

					section.querySelector('.wcl-t4-load-more .t4-container').innerHTML = data.button;
				};
			};
			data_req = new URLSearchParams(data_req).toString();
			xhr.send(data_req);
		}

		let load_more = section.querySelector('.wcl-t4-load-more')
		if (load_more) {
			load_more.addEventListener("click", function (e) {
				if (e.target.classList.contains('t4-btn')) {
					let self = e.target;
					e.preventDefault();

					if (self.getAttribute("disable") == 'disable') {
						return false;
					}

					let paged = e.target.getAttribute("data-page");

					shop_page_load_post(paged);
				}
			});
		}


		let cats_sections = document.querySelectorAll('.wcl-shop-sc-1')
		if (cats_sections) {
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

						let curr_section = element.closest('.wcl-shop-sc-1')
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

						if (self.getAttribute('data-id') == 'all') {
							url = wcl_obj.site_url + 'shopping/'
						} else if (self.getAttribute('data-id') == 'instagram') {
							url = wcl_obj.site_url + 'instagram'
						} else {
							url = wcl_obj.site_url + 'shopping/' + self.getAttribute('data-id')
						}

						window.history.pushState(wcl_obj.site_url, document.title, url);

						if (element.getAttribute('data-id') !== 'instagram') {
							section.querySelector('.data-tab-1').classList.add('active')
							section.querySelector('.data-tab-2').classList.remove('active')
						} else {
							section.querySelector('.data-tab-2').classList.add('active')
							section.querySelector('.data-tab-1').classList.remove('active')
							return
						}

						window.scrollTo({
							top: 0,
							behavior: 'smooth'
						});

						shop_page_load_post();
					});
				});
			});
		}
	}
}

export default wcl_shop_sc_2;
