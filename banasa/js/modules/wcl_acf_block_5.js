
// wcl_acf_block_5

function wcl_acf_block_5() {
	// wcl-acf-block-5
	if (document.querySelector('.wcl-acf-block-5')) {
		let section = document.querySelector('.wcl-acf-block-5')

		// video
		if (section.querySelector('.data-video video')) {
			let item = section.querySelector('.data-video')
			let video = section.querySelector('.data-video video')

			item.addEventListener('click', function (e) {
				if (video && !video.paused) {
					video.pause();
					item.classList.add("mod-pause");
				} else {
					video.play();
					item.classList.remove("mod-pause");
				}
			})
		}
	}
}

document.addEventListener('DOMContentLoaded', function () {
	wcl_acf_block_5();
});
