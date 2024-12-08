

// wcl_shop_sc_1

function wcl_shop_sc_1() {
	if (document.querySelector('.wcl-shop-sc-1')) {
		let sections = document.querySelectorAll('.wcl-shop-sc-1')
		let swiper_1 = '';
		let swiper_2 = '';

		sections.forEach(function (section, index) {
			let width = section.querySelector('.data-nav-inner').offsetWidth
			let width_t2 = 0;
			let nodes = section.querySelectorAll('.data-nav-item')
			let tag_key = section.getAttribute('data-tag-key')

			if (!tag_key) {
				tag_key = 0;
			}

			section.querySelectorAll('.data-nav-item').forEach(element => {
				let item_width = element.clientWidth
				let index = Array.prototype.slice.call(nodes).indexOf(element);
				if (section.querySelectorAll('.data-nav-item').length == index + 1) {
					width_t2 += item_width
				} else {
					width_t2 += item_width
				}
			});

			if (width_t2 > section.querySelector('.data-nav').offsetWidth) {
				let slider = section.querySelector('.data-nav')
				let swiper = new Swiper(slider, {
					slidesPerView: 'auto',
					speed: 400,
					spaceBetween: 22,
					initialSlide: tag_key,
				});
			}

			if (index === 0) {
				swiper_1 = section.querySelector('.data-nav').swiper
			} else {
				swiper_2 = section.querySelector('.data-nav').swiper
			}
		});

		if (window.matchMedia("(min-width: 1025px)").matches) {
			if (swiper_1 && swiper_2) {
				swiper_1.controller.control = swiper_2;
				swiper_2.controller.control = swiper_1;
			}
		}

		window.addEventListener("scroll", e => {
			let scrollPos = window.scrollY;
			let offset = 124;

			if (scrollPos > offset) {
				document.querySelector('.wcl-shop-sc-1.mod-sticky').classList.add('active')
			} else {
				if (document.querySelector('.wcl-shop-sc-1.mod-sticky').classList.contains('active')) {
					document.querySelector('.wcl-shop-sc-1.mod-sticky').classList.remove('active')
				}
			}
		});
	}
}

export default wcl_shop_sc_1;
