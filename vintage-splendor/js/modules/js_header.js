

// js_header
function js_header() {


	if (document.querySelector('.js-header')) {

		let section = document.querySelector('.js-header');
		function header_sticky(el) {
			let banner_position = el.offsetTop + el.clientHeight

			window.addEventListener("scroll", e => {
				let scrollPos = window.scrollY;
				if (scrollPos > banner_position) {
					section.classList.add('mod-sticky-offset-active');
				} else {
					if (!document.querySelector('.wcl-header-nav.active')) {
						section.classList.remove('mod-sticky-offset-active');
					}
				}
			});
		}

		// mobile

		document.querySelectorAll('.wcl-header-nav .data-menu a').forEach(element => {
			element.addEventListener('click', function (e) {
				if (this.getAttribute('href') == '#') {
					e.preventDefault()
				}
			})
		});

		document.querySelectorAll('.wcl-header-nav .data-menu > li.menu-item-has-children > a').forEach(element => {
			element.addEventListener('click', function (e) {
				e.preventDefault()
				if (this.parentElement.classList.contains('active')) {
					this.parentElement.querySelector('.sub-menu').classList.remove('active')
					this.parentElement.classList.remove('active')
				} else {
					this.parentElement.querySelector('.sub-menu').classList.add('active')
					this.parentElement.classList.add('active')
				}
			})
		});

		// mobile end

		if (document.querySelector('.js-header.mod-sticky-offset')) {
			let banner = document.querySelector('.wcl-section-1');

			if (banner) {
				header_sticky(banner)
			}
		}

		section.querySelectorAll('.data-menu li.menu-item-has-children').forEach(element => {
			element.addEventListener('mouseover', function (e) {
				section.querySelectorAll('.sub-menu').forEach(element => {
					element.classList.remove('active')
				});

				element.querySelector('.sub-menu').classList.add('active')
			})
		});
		
		section.addEventListener('click', function (e) {
			if (!e.target.closest('.menu-item-has-children')) {
				if (section.querySelector('.sub-menu.active')) {
					section.querySelector('.sub-menu.active').classList.remove('active')
				}
			}
		})

		section.addEventListener('mouseleave', function (e) {
				if (section.querySelector('.sub-menu.active')) {
					section.querySelector('.sub-menu.active').classList.remove('active')
				}
		})
	}
}

export default js_header;
