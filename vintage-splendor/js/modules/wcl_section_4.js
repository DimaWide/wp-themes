

import { addGradientForDesc } from './common';

// wcl_section_4

function wcl_section_4() {

	if (document.querySelector('.wcl-section-4')) {
		let section = document.querySelector('.wcl-section-4');

		function getNextSiblings(elem, filter) {
			var sibs = [];
			while (elem = elem.nextSibling) {
				if (elem.nodeType === 3) continue; // text node
				if (!filter || filter(elem)) sibs.push(elem);
			}
			return sibs;
		}

		let slider = section.querySelector('.data-list')
		let swiper = new Swiper(slider, {
			slidesPerView: 'auto',
			spaceBetween: 23,
			breakpoints: {
				0: {
					slidesPerView: 'auto',
				},
				1200: {
				},
			}
		});

		let currentSlideIndex = swiper.activeIndex;
		let slideElements = swiper.slides;

		for (let i = 0; i < slideElements.length; i++) {
			let slideElement = slideElements[i];

			if (i > currentSlideIndex + 3) {
				slideElement.classList.add('mod-going-out')
			} else if (i < currentSlideIndex) {
				slideElement.classList.add('mod-going-out')
			} else {
				slideElement.classList.remove('mod-going-out')
			}
		}

		swiper.on('slideChange', function (e) {
			let currentSlideIndex = swiper.activeIndex;
			let slideElements = swiper.slides;

			for (let i = 0; i < slideElements.length; i++) {
				let slideElement = slideElements[i];

				if (i > currentSlideIndex + 3) {
					slideElement.classList.add('mod-going-out')
				} else if (i < currentSlideIndex) {
					slideElement.classList.add('mod-going-out')
				} else {
					slideElement.classList.remove('mod-going-out')
				}
			}
		});

		addGradientForDesc(section)
	}
}

export default wcl_section_4;
