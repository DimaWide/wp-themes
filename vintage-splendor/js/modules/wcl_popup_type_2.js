

// wcl_popup_type_2

function wcl_popup_type_2() {

	// js-mod-1
	
	if (document.querySelector('.wcl-popup-type-2.js-mod-1')) {
		let popup = document.querySelector('.wcl-popup-type-2.js-mod-1');
		let popupShown = localStorage.getItem("wclPopupShown");

		if (!document.querySelector('body').classList.contains('logged-in')) {
			if (!popupShown) {
				setTimeout(function () {
					popup.classList.add('active')
					localStorage.setItem("wclPopupShown", true);
				}, 60000);
			}
		}
	}
}

export default wcl_popup_type_2;
