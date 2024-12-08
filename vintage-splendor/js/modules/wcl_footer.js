

// wcl_footer

function wcl_footer() {
	if (document.querySelector('.wcl-footer')) {
		let section = document.querySelector('.wcl-footer')

		let slider = section.querySelector('.data-b')
		let swiper = new Swiper(slider, {
			slidesPerView: 'auto',
			spaceBetween: 30,
			freeMode: {
				enabled: true,
				momentum: false,
			},
		});
	}

}

export default wcl_footer;
