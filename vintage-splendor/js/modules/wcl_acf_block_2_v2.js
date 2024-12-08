

// wcl_acf_block_2_v2

function wcl_acf_block_2_v2() {
	if (document.querySelector('.wcl-acf-block-2-v2')) {
		let sections = document.querySelectorAll('.wcl-acf-block-2-v2');

		sections.forEach(section => {
			let slider = section.querySelector('.data-b-list')
			let swiper = new Swiper(slider, {
				slidesPerView: 1,
				spaceBetween: 10,
				navigation: {
					nextEl: section.querySelector('.data-b-list-nav-btn.mod-next'),
					prevEl: section.querySelector('.data-b-list-nav-btn.mod-prev'),
				},
			});

			if (section.querySelector('.data-b-btn')) {
				section.querySelector('.data-b-btn').addEventListener('click', function (e) {
					if (section.querySelector('.data-b').classList.contains('active')) {
						section.querySelector('.data-b').classList.remove('active')
					} else {
						section.querySelector('.data-b').classList.add('active')
					}
				})
			}
		});
	}
}

export default wcl_acf_block_2_v2;
