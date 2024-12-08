

// single_product

function single_product() {
	if (document.querySelector('.single-product')) {
		let section = document.querySelector('.single-product');

		if (window.matchMedia("(max-width: 991px)").matches) {
			window.addEventListener('scroll', function () {
				let scrollPosition = window.pageYOffset || document.documentElement.scrollTop

				if (scrollPosition > 0) {
					document.querySelector('.wcl-header').classList.add('mod-scrolled')
				} else {
					document.querySelector('.wcl-header').classList.remove('mod-scrolled')
				}
			});
		}
	}
}

export default single_product;
