

// wcl_header

function wcl_header() {
	if (document.querySelector('.wcl-header')) {
		let sections = document.querySelectorAll('.wcl-header');


		sections.forEach(section => {
			section.querySelectorAll('.mod-about-menu-item > a').forEach(element => {
				element.addEventListener('click', function (e) {
					e.preventDefault()
				})
			});
	

			if (window.matchMedia("(max-width: 1025px)").matches) {
				section.querySelector('.wcl-t1-search input').addEventListener('focusout', function (e) {
					section.classList.remove('mod-search-active')
				})

				section.querySelector('.wcl-t1-search .t1-inner').addEventListener('click', function (e) {
					this.querySelector('input').focus();
					section.classList.add('mod-search-active')
				})

				section.querySelector('.wcl-t1-search .t1-inner-b').addEventListener('submit', function (e) {
					if (this.querySelector('input').value == '') {
						e.preventDefault()
					}
				})
			}

			section.querySelector('.wcl-t3-btn-menu').addEventListener('click', function (e) {
				if (this.classList.contains('active')) {
					this.closest('.wcl-header').classList.remove('active')
					document.querySelector('.wcl-header-nav').classList.remove('active')
					this.classList.remove('active')
					document.querySelector('body').classList.remove('overflow-hidden')

				} else {
					if (this.closest('.wcl-header-t-2')) {
						window.scrollTo(0, 0);
					}

					if (document.querySelector('.woocommerce-MyAccount-navigation.active')) {
						document.querySelector('.woocommerce-MyAccount-navigation.active').classList.remove('active')
					}

					this.closest('.wcl-header').classList.add('active')
					document.querySelector('.wcl-header-nav').classList.add('active')
					this.classList.add('active')
					document.querySelector('body').classList.add('overflow-hidden')
				}
			})
		});
	}
}

export default wcl_header;
