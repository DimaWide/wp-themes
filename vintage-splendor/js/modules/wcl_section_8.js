

// wcl_section_8

function wcl_section_8() {

	if (document.querySelector('.wcl-section-8')) {
		let sections = document.querySelectorAll('.wcl-section-8');

		sections.forEach(section => {
			let slider = section.querySelector('.data-list')
			let swiper = null;

			section.querySelectorAll('.data-item-2.mod-not-have-access .data-item-2-link').forEach(element => {
				element.addEventListener('click', function (e) {
					e.preventDefault()
					document.querySelector('.wcl-popup-type-1').classList.add('active')
				})
			});

			function swiper_init() {
				slider = section.querySelector('.data-list')
				swiper = new Swiper(slider, {
					slidesPerView: 'auto',
					spaceBetween: 23,
				});
			}

			if (section.classList.contains('mod-arrange-column')) {
				if (!window.matchMedia("(max-width: 575px)").matches) {
					swiper_init()
				}
			} else {
				swiper_init()
			}

			window.addEventListener('resize', function (event) {
				if (section.classList.contains('mod-arrange-column') && window.matchMedia("(max-width: 575px)").matches) {
					if (swiper !== null) {
						swiper.destroy();
						swiper = null;
					}
				} else {
					if (swiper === null) {
						swiper_init();
					}
				}
			}, true)
		});
	}
}

export default wcl_section_8;
