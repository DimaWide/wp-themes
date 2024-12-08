

// wcl_section_14

function wcl_section_14() {
	if (document.querySelector('.wcl-section-14')) {
		let section = document.querySelector('.wcl-section-14');

		if (section.querySelector('.mod-video')) {
			section.querySelector('.data-a').addEventListener('click', function (e) {
				let video = section.querySelector('video')
				if (video.paused) {
					video.play()
					section.querySelector('.data-a').classList.add('active')
				} else {
					video.pause()
					section.querySelector('.data-a').classList.remove('active')
				}
			})
		}

		section.querySelectorAll('.data-c-inner').forEach(element => {
			let height = element.clientHeight
			let desc_height = element.children[0].clientHeight

			if (desc_height > height) {
				element.parentElement.classList.add('scrolled')
			}

			element.addEventListener('mouseover', function (e) {
				let height = this.clientHeight
				let desc_height = this.children[0].clientHeight

				if (desc_height <= height) {
					if (element.parentElement.classList.contains('scrolled')) {
						element.parentElement.classList.remove('scrolled')
					}
				}
			})

			element.addEventListener('scroll', function (e) {
				let height = this.clientHeight
				let desc_height = this.children[0].clientHeight
				if (Math.ceil(height + this.scrollTop) >= desc_height) {
					element.parentElement.classList.remove('scrolled')
				} else {
					element.parentElement.classList.add('scrolled')
				}
			})
		});
	}
}

export default wcl_section_14;
