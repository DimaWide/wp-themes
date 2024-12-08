
// wcl_acf_block_2

function wcl_acf_block_2() {
	// wcl-acf-block-2
	if (document.querySelector('.wcl-acf-block-2')) {
		let sections = document.querySelectorAll('.wcl-acf-block-2')

		// slider
		sections.forEach(section => {
			let swiper = new Swiper(section.querySelector('.data-slider'), {
				slidesPerView: 'auto',
				freeMode: {
					enabled: true,
					momentum: false,
				},
				spaceBetween: 58,
				speed: 1000,
				navigation: {
					nextEl: section.querySelector('.data-slider-arrow'),
					//	prevEl: section.querySelector('.mod-prev'),
				},
				breakpoints: {
					0: {
						spaceBetween: 20,
					},
					767: {
						spaceBetween: 25,
					},
					991: {
						spaceBetween: 58
					},
				}
			});
		});
	}

}

document.addEventListener('DOMContentLoaded', function () {
	wcl_acf_block_2();
});
