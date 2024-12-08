

// wcl_section_21

function wcl_section_21() {
	if (document.querySelector('.wcl-section-21')) {
		let section = document.querySelector('.wcl-section-21');

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
	}

}

export default wcl_section_21;
