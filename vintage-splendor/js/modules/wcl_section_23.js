

// wcl_section_23

function wcl_section_23() {
	if (document.querySelector('.wcl-section-23')) {
		let section = document.querySelector('.wcl-section-23')

		section.querySelector('.data-btn').addEventListener('click', function (e) {
			window.scrollTo({
				top: 0,
				behavior: 'smooth'
			});
		})
	}

	if (document.querySelector('.wcl-section-23')) {
		let section = document.querySelector('.wcl-section-23');
		let slider = section.querySelector('.data-list')
		let swiper = null;

		function swiper_init(params) {
			swiper = new Swiper(slider, {
				slidesPerView: 'auto',
				speed: 400,
				spaceBetween: 24,
			});
		}

		if (window.matchMedia("(max-width: 1270px)").matches) {
			swiper_init();
		}

		window.addEventListener('resize', function (event) {
			if (window.matchMedia("(max-width: 1270px)").matches) {
				if (swiper === null) {
					swiper_init();
				}
			} else {
				if (swiper !== null) {
					swiper.destroy();
					swiper = null;
				}
			}
		}, true)
	}
}

export default wcl_section_23;
