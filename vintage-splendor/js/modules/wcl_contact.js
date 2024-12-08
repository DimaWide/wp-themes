

// wcl_contact

function wcl_contact() {
	if (document.querySelector('.wcl-contact')) {
		let section = document.querySelector('.wcl-contact')
		let select = section.querySelector('.data-form .wpcf7 select')
		select.firstChild.setAttribute('disabled', true);

		section.addEventListener('click', function (e) {
			if (!e.target.closest('.data-inner')) {
				document.querySelector('body').classList.remove('overflow-hidden')
				section.classList.remove('active')
			}
		});

		if (section.querySelector('.cf7-wcl-select')) {
			section.querySelector('.cf7-wcl-select').addEventListener('click', function (e) {
				if (section.querySelector('.cf7-wcl-select').classList.contains('active')) {
					section.querySelector('.cf7-wcl-select').classList.remove('active')
				} else {
					section.querySelector('.cf7-wcl-select').classList.add('active')
				}
			})

			section.querySelectorAll('.d1-item span').forEach(element => {
				element.addEventListener('click', function (e) {
					let parent = this.closest('.d1-item')
					let val = parent.getAttribute('data-value');

					section.querySelector('.d1-view').setAttribute('data-value', val);
					section.querySelector('.d1-view-name').innerText = val
					section.querySelector('.wpcf7-select[name="your-reason-contacting"]').value = val

					section.querySelectorAll('.d1-item.active').forEach(element_t2 => {
						element_t2.classList.remove('active')
					});

					if (parent.classList.contains('active')) {
						parent.classList.remove('active')
					} else {
						parent.classList.add('active')
					}
				})
			});
		}
	}
}

export default wcl_contact;
