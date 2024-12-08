


import { addGradientForDesc } from './common';

// wcl_section_19

function wcl_section_19() {
	if (document.querySelector('.wcl-section-19')) {
		let section = document.querySelector('.wcl-section-19');
		let slider = section.querySelector('.data-list')
		let swiper = new Swiper(slider, {
			slidesPerView: 4,
			speed: 400,
			spaceBetween: 22,
			breakpoints: {
				0: {
					slidesPerView: 'auto',
				},
				1290: {
					slidesPerView: 4,
				},
			}
		});
		
		addGradientForDesc(section)
	}
}

export default wcl_section_19;
