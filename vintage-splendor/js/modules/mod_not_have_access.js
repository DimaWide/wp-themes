

// mod_not_have_access

function mod_not_have_access() {
	if (document.querySelector('.mod-not-have-access.mod-is-exclusive')) {
		let items = document.querySelectorAll('.mod-not-have-access.mod-is-exclusive');

		document.addEventListener('click', function (e) {
			let item = e.target.closest('.mod-not-have-access.mod-is-exclusive')

			if (item) {
				if (!e.target.closest('a')) {
					if (item.classList.contains('js-popup-2')) {
						document.querySelector('.wcl-popup-type-2').classList.add('active')
					} else if (item.classList.contains('js-popup-1')) {
						document.querySelector('.wcl-popup-type-1').classList.add('active')
					}
				}
			} else {
				if (e.target.closest('.js-popup-1')) {
					document.querySelector('.wcl-popup-type-1').classList.add('active')
				}
			}
		})
	}
}

export default mod_not_have_access;
