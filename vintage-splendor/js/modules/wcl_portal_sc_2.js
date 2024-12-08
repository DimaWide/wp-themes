

// wcl_portal_sc_2

function wcl_portal_sc_2() {
	if (document.querySelector('.wcl-portal-sc-2')) {
		let section = document.querySelector('.wcl-portal-sc-2')

		let cats = document.querySelectorAll('.data-nav-cats a')
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

					portal_page_load_post();
				});
			});
		}

		function portal_page_load_post(paged_new) {
			let paged = -1;
			let cat = '';
			let nav_val = section.querySelector('.data-nav-item.active').getAttribute('data-id')

			if (nav_val == 'category') {
				cat = section.querySelector('.data-nav-cats-item.active a').getAttribute('data-id')
			}

			let data_req = {
				action: 'portal_page_load_post',
				nav_val: nav_val,
				cat: cat,
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
				};
			};
			data_req = new URLSearchParams(data_req).toString();
			xhr.send(data_req);
		}


		let nav_items = section.querySelectorAll('.data-nav-item')

		if (nav_items.length > 0) {
			let active = section.querySelector('.data-nav-item.active')
			let index = Array.prototype.slice.call(section.querySelectorAll('.data-nav-item')).indexOf(active);
			let offset = active.offsetLeft
			let width = active.offsetWidth

			section.querySelector('.data-nav-line').style.left = offset + 'px';
			section.querySelector('.data-nav-line').style.width = width + 'px';

			nav_items.forEach(element => {
				element.addEventListener("click", function (e) {
					e.preventDefault();
					if (this.classList.contains('active')) {
						return false;
					}
					let self = this;
					let index = Array.prototype.slice.call(section.querySelectorAll('.data-nav-item')).indexOf(this);

					let offset = self.offsetLeft
					let width = self.offsetWidth

					nav_items.forEach(element => {
						element.classList.remove('active');
					});

					self.classList.add('active');
					section.querySelector('.data-nav-line').style.left = offset + 'px';
					section.querySelector('.data-nav-line').style.width = width + 'px';

					portal_page_load_post();
				});
			});
		}
	}
}

export default wcl_portal_sc_2;
