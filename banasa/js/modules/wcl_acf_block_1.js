
// wcl_acf_block_1

function wcl_acf_block_1() {
	// wcl-acf-block-1
	if (document.querySelector('.wcl-acf-block-1')) {
		let section = document.querySelector('.wcl-acf-block-1')

		document.addEventListener('click', function (e) {
			if (e.target.closest('.data-item.swiper-slide')) {
				if (section.querySelector('.mod-next').classList.contains('moved')) {
					section.querySelector('.mod-next').classList.remove('moved')
				}
			}

			if (e.target.closest('.data-video')) {
				let element = e.target.closest('.data-video')
				let video = element.querySelector('video')

				if (!section.classList.contains('first-load-2')) {
					section.classList.add('first-load-2')
				}

				if (video && !video.paused) {
					video.pause();
					element.classList.remove("mod-play");
					element.classList.add("mod-pause");
				} else {
					video.play();
					element.classList.add("mod-play");
					element.classList.remove("mod-pause");
				}
			}
		})


		// slider
		var nextButton = section.querySelector('.mod-next');

		let swiper = new Swiper(section.querySelector('.data-slider'), {
			slidesPerView: 1,
			spaceBetween: 53,
			loop: true,
			speed: 600,
			navigation: {
				nextEl: section.querySelector('.mod-next'),
				prevEl: section.querySelector('.mod-prev'),
			},
			on: {
				touchStart: function () {
					nextButton.classList.add('moved');
				},
				slideChangeTransitionStart: function () {
					nextButton.classList.add('moved');
				},
				slideChangeTransitionEnd: function () {
					nextButton.classList.remove('moved');
				},

				slideChange: function () {
					section.querySelectorAll('.data-video').forEach(element => {
						if (element.querySelector('video')) {
							let video = section.querySelector('video')

							if (video && !video.paused) {
								video.pause();
								element.classList.add("mod-pause");
							}
						}
					});
				},
				transitionEnd: function () {
					nextButton.classList.remove('moved');
				},
			},
		});
	}
}

document.addEventListener('DOMContentLoaded', function () {
	wcl_acf_block_1();
});
