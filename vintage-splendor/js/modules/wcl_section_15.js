

// wcl_section_15

function wcl_section_15() {
	if (document.querySelector('.wcl-section-15')) {
		let section = document.querySelector('.wcl-section-15');
		let slider = section.querySelector('.data-list')
		let swiper = new Swiper(slider, {
			slidesPerView: 'auto',
			slidesOffsetAfter: 33,
			spaceBetween: 109,
			breakpoints: {
				0: {
					spaceBetween: 79,
					slidesOffsetAfter: 0,
				},
				1000: {
					spaceBetween: 109,
					slidesOffsetAfter: 33,
				},
			}
		});
	}
}

export default wcl_section_15;
