

// woocommerce_account

function woocommerce_account() {

	if (document.querySelector('.woocommerce-account')) {
		let section = document.querySelector('.woocommerce-account');

		if (section.querySelector('.data-b5-link')) {
			section.querySelector('.data-b5-link').addEventListener('click', function (e) {
				window.scrollTo({
					top: 0,
					behavior: 'smooth'
				});
			})
		}
	}


	// woocommerce-view-order

	if (document.querySelector('.woocommerce-view-order')) {
		let section = document.querySelector('.woocommerce-view-order');

		section.querySelector('.data-b7-btn-item').addEventListener('click', function (e) {
			if (section.querySelector('.data-b7').classList.contains('collapsed')) {
				section.querySelector('.data-b7').classList.remove('collapsed')
				this.classList.remove('active')
			} else{
				section.querySelector('.data-b7').classList.add('collapsed')
				this.classList.add('active')
			}
		})
	}

}

export default woocommerce_account;
