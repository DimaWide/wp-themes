

// wcl_instagram

function wcl_instagram() {
	if (document.querySelector('.wcl-instagram')) {
		let section_1 = document.querySelector('.wcl-footer .wcl-instagram')
		let section_2 = document.querySelector('.wcl-section-22.wcl-instagram')


		window.sbi_custom_js = function () {
			if (section_1) {
				if (!section_1.classList.contains('mod-done')) {
					let items = section_1.querySelectorAll('.sbi_item')
					for (let index = 0; index < items.length; index++) {
						if (index == 3) {
							break;
						}

						let item = items[index]
						let tag = '<div class="data-item">' + item.outerHTML + '</div>';
						section_1.querySelector('.data-list').insertAdjacentHTML('beforeend', tag);
					}

					section_1.classList.add('mod-done')
				}
			}

			if (section_2) {
				if (!section_2.classList.contains('mod-done')) {
					let items = section_2.querySelectorAll('.sbi_item')
					for (let index = 0; index < items.length; index++) {
						if (index == 3) {
							break;
						}

						let item = items[index]
						let tag = '<div class="data-item">' + item.outerHTML + '</div>';
						section_2.querySelector('.data-list').insertAdjacentHTML('beforeend', tag);
					}

					section_2.classList.add('mod-done')
				}
			}
		}
	}
}

export default wcl_instagram;
