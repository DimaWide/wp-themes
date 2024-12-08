

// wcl_related_posts

function wcl_related_posts() {
	if (document.querySelector('.wcl-related-posts')) {
		let section = document.querySelector('.wcl-related-posts')
		let slider = section.querySelector('.data-list')

		if (window.matchMedia("(min-width: 575px)").matches) {
			let swiper = new Swiper(slider, {
				slidesPerView: 2,
				speed: 400,
				spaceBetween: 46,
				breakpoints: {
					0: {
						slidesPerView: 'auto',
						spaceBetween: 24,
					},
					1025: {
					},
				}
			});
		}
	}
}

export default wcl_related_posts;
