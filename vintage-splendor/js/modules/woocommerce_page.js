

// woocommerce_page

function woocommerce_page() {

	if (document.querySelector('.woocommerce-page')) {
		let section = document.querySelector('.woocommerce-page');

		section.querySelectorAll('input[type="checkbox"], input[type="radio"]').forEach(element => {
			if (element.matches('input[type="radio"]')) {
				element.closest('form').querySelectorAll('input[type="radio"]').forEach(element_2 => {
					if (element_2.checked) {
						if (element_2.closest('label')) {
							element_2.closest('label').classList.add('active')
						}
					} else {
						if (element_2.closest('label')) {
							element_2.closest('label').classList.remove('active')
						}
					}
				});
			} else {
				if (element.checked) {
					if (element.closest('label')) {
						element.closest('label').classList.add('active')
					}
				} else {
					if (element.closest('label')) {
						element.closest('label').classList.remove('active')
					}
				}
			}

			element.addEventListener('change', function (e) {
				if (e.target.matches('input[type="radio"]')) {
					e.target.closest('form').querySelectorAll('input[type="radio"]').forEach(element_2 => {
						if (element_2.checked) {
							if (element_2.closest('label')) {
								element_2.closest('label').classList.add('active')
							}
						} else {
							if (element_2.closest('label')) {
								element_2.closest('label').classList.remove('active')
							}
						}
					});
				} else {
					if (element.checked) {
						if (e.target.closest('label')) {
							e.target.closest('label').classList.add('active')
						}
					} else {
						if (e.target.closest('label')) {
							e.target.closest('label').classList.remove('active')
						}
					}
				}
			})
		});
	}
}

export default woocommerce_page;
