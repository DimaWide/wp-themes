

// js_popup

function js_popup() {
	if (document.querySelector('.js-popup')) {
		let sections = document.querySelectorAll('.js-popup');

		sections.forEach(element => {
			element.querySelector('.data-close').addEventListener('click', function (e) {
				element.classList.remove('active')
			})

			element.querySelector('.data-overlay').addEventListener('click', function (e) {
				element.classList.remove('active')
			})

			element.querySelector('.data-inner-out').addEventListener('click', function (e) {
				if (!e.target.closest('.data-inner')) {
					element.classList.remove('active')
				}
			})
		});
	}

}

export default js_popup;
