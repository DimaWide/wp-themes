

// wcl_section_7

function wcl_section_7() {
	if (document.querySelector('.wcl-section-7')) {
		let section = document.querySelector('.wcl-section-7');

		section.querySelectorAll('.data-item.mod-not-have-access .data-item-inner').forEach(element => {
			element.addEventListener('click', function (e) {
				document.querySelector('.wcl-popup-type-1').classList.add('active')
			})
		});
	}
}

export default wcl_section_7;
