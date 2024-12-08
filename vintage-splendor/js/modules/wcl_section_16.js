
import { addGradientForDesc } from './common';

// wcl_section_16

function wcl_section_16() {
	if (document.querySelector('.wcl-section-16')) {
		let section = document.querySelector('.wcl-section-16');
		let slider = section.querySelector('.data-list')
		let swiper = new Swiper(slider, {
			slidesPerView: 2,
			speed: 400,
			spaceBetween: 46,
			breakpoints: {
				0: {
					slidesPerView: 'auto',
					spaceBetween: 24,
				},
				767: {
					slidesPerView: 2,
					spaceBetween: 24,
				},
				1025: {
					spaceBetween: 46,
				},
			}
		});

		addGradientForDesc(section)
	}
}

export default wcl_section_16;
