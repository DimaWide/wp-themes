

import { addGradientForDesc } from './common';

// wcl_section_11

function wcl_section_11() {
	if (document.querySelector('.wcl-section-11')) {
		let section = document.querySelector('.wcl-section-11');
		let slider = section.querySelector('.data-list')
		let swiper = '';

		if (section.classList.contains('mod-two')) {
			swiper = new Swiper(slider, {
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
		} else {
			if (window.matchMedia("(max-width: 575px)").matches) {
				swiper = new Swiper(slider, {
					slidesPerView: 'auto',
					spaceBetween: 24,
				});
			}
		}

		window.addEventListener('resize', function (event) {
			if (window.matchMedia("(max-width: 575px)").matches) {
				section.querySelectorAll('.data-item').forEach(element => {
					element.classList.remove('mod-clear-margin')
				});
			} else {
				if (swiper) {
					swiper.destroy();
					swiper = null;
				}

				section.querySelectorAll('.data-item').forEach(element => {
					element.classList.add('mod-clear-margin')
				});
			}
		}, true);

		addGradientForDesc(section)
	}
}

export default wcl_section_11;
