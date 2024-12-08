

// wcl_section_10

function wcl_section_10() {
	if (document.querySelector('.wcl-section-10')) {
		let sections = document.querySelectorAll('.wcl-section-10');

		sections.forEach(section => {
			let slider = section.querySelector('.data-list')
			let swiper = new Swiper(slider, {
				slidesPerView: 'auto',
				spaceBetween: 10,
				breakpoints: {
					0: {
					},
					375: {
					},
				}
			});
		});
	}
}

export default wcl_section_10;
