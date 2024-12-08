const ready = (callback) => {
	if (document.readyState != "loading") callback();
	else document.addEventListener("DOMContentLoaded", callback);
}

ready(() => {

	/* SCRIPTS GO HERE */


	function isNumeric(str) {
		if (typeof str != "string") return false // we only process strings!  
		return !isNaN(str) && // use type coercion to parse the _entirety_ of the string (`parseFloat` alone does not do this)...
			!isNaN(parseFloat(str)) // ...and ensure strings of whitespace fail
	}

	function input_phone_mask(form) {
		let input = form.querySelector('input[name="phone"]')
		if (input) {
			let maskOptions = {
				mask: '+(37) - 00 - 000 - 00'
			};
			let mask = IMask(input, maskOptions);
		}
	}

	function check_phone_num(form) {
		let input = form.querySelector('input[name="phone"][required]')
		if (input) {
			let val = input.value
			let digits = val.replace(/[^0-9]/g, '').length;
			//	console.log(digits)
			if (digits < 9) {
				let notify_b = '<div class="data-field-notify mod-b">Number must have 9 digits</div>';
				if (!input.parentElement.querySelector('.data-field-notify.mod-b')) {
					input.parentElement.insertAdjacentHTML('beforeend', notify_b)
					input.classList.add('error')
				}
			} else {
				if (input.parentElement.querySelector('.data-field-notify.mod-b')) {
					input.parentElement.querySelector('.data-field-notify.mod-b').remove()
					input.classList.remove('error')
				}
			}
		}
	}

	function clean_form(form) {
		form.querySelectorAll('input, textarea, select').forEach(element => {
			if (element.getAttribute('type') == 'file') {
				form.querySelector('.data-field-1-info').classList.remove('active')
			} else if (element.getAttribute('type') == 'checkbox') {
				element.checked = false;
			} else if (element.nodeName == 'SELECT') {
				element.value = '';
				element.selectedIndex = 0
			} else {
				element.value = '';
			}
		});
	}

	// wcl-form

	if (document.querySelector('.wcl-form')) {
		let section = document.querySelector('.wcl-form');
		let form = section.querySelector('.data-form')
		let phone_input = form.querySelector('input[name="phone"]')

		input_phone_mask(form);

		if (phone_input) {
			phone_input.addEventListener('input', function (e) {
				let val = this.value
				if (val.length > 20) {
					check_phone_num(form)
				}
			})
		}

		grecaptcha.ready(function () {
			grecaptcha.execute(section.querySelector('input[name="site_key"]').value, {
				action: 'validate_captcha'
			})
				.then(function (token) {
					document.getElementById('g-recaptcha-response').value = token;
				});
		});
	}

	// wcl-form.mod-c

	if (document.querySelector('.wcl-form.mod-c')) {

		let section = document.querySelector('.wcl-form.mod-c');
		let form = section.querySelector('.data-form')

		form.addEventListener('submit', function name(e) {
			e.preventDefault();
			let field_email = form.querySelector('input[name="email"]').value
			let field_message = form.querySelector('textarea[name="message"]').value
			let field_recaptha = form.querySelector('input[name="g-recaptcha-response"]').value

			let fd = new FormData();
			fd.append("action", "form_c_handle");
			fd.append("field_email", field_email);
			fd.append("field_message", field_message);
			fd.append("field_recaptha", field_recaptha);

			if (form.querySelector('.data-notify')) {
				form.querySelector('.data-notify').remove()
			}
			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, false);
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					let data = JSON.parse(xhr.responseText);
					if (data.success) {
						clean_form(form);
					}
					if (data.note) {
						let notify = '<div class="data-notify"> ' + data.note + '</div>'
						form.insertAdjacentHTML('beforeend', notify)
					}
				}
			};
			xhr.send(fd);
		})
	}


	// wcl-form.mod-b

	if (document.querySelector('.wcl-form.mod-b')) {
		let section = document.querySelector('.wcl-form.mod-b');
		let form = section.querySelector('.data-form')

		form.querySelectorAll('input[type="checkbox"]').forEach(element => {
			element.addEventListener('change', function (e) {
				//console.log(element)
				let slug = element.parentElement.getAttribute('data-slug')
				if (element.checked) {
					form.querySelector('.' + slug).classList.remove('hidden')
					form.querySelector('.' + slug).querySelector('input').setAttribute('required', true)
				} else {
					form.querySelector('.' + slug).classList.add('hidden')
					form.querySelector('.' + slug).querySelector('input').removeAttribute('required')
					if (form.querySelector('.' + slug).querySelector('.data-field-notify')) {
						form.querySelector('.' + slug).querySelector('.data-field-notify').remove()
					}
				}
			});
		});


		form.addEventListener('submit', function name(e) {
			e.preventDefault();

			check_phone_num(form)

			if (form.querySelector('.data-field-notify')) {
				let notify = '<div class="data-notify">Сheck if the data entered is correct</div>'
				if (!form.querySelector('.data-notify')) {
					form.insertAdjacentHTML('beforeend', notify)
				}
				return
			}

			let field_name = form.querySelector('input[name="name"]').value
			let field_company_url = form.querySelector('input[name="company_url"]').value
			let field_phone = form.querySelector('input[name="phone"]').value
			let field_telegram_name = form.querySelector('input[name="telegram_name"]').value
			let field_email = form.querySelector('input[name="email"]').value
			let field_message = form.querySelector('textarea[name="message"]').value
			let field_recaptha = form.querySelector('input[name="g-recaptcha-response"]').value
			let field_way_contact = [];

			form.querySelectorAll('input[name="way_contact"]:checked').forEach(element => {
				field_way_contact.push(element.value);
			});
			field_way_contact = field_way_contact.join(", ");

			let fd = new FormData();
			fd.append("action", "form_b_handle");
			fd.append("field_name", field_name);
			fd.append("field_company_url", field_company_url);
			fd.append("field_way_contact", field_way_contact);
			fd.append("field_phone", field_phone);
			fd.append("field_telegram_name", field_telegram_name);
			fd.append("field_email", field_email);
			fd.append("field_message", field_message);
			fd.append("field_recaptha", field_recaptha)

			if (form.querySelector('.data-notify')) {
				form.querySelector('.data-notify').remove()
			}
			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, false);
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					let data = JSON.parse(xhr.responseText);
					if (data.success) {
						clean_form(form);
					}
					if (data.note) {
						let notify = '<div class="data-notify"> ' + data.note + '</div>'
						form.insertAdjacentHTML('beforeend', notify)
					}
				}
			};
			xhr.send(fd);
		})
	}


	// wcl-form.mod-a

	if (document.querySelector('.wcl-form.mod-a')) {
		let section = document.querySelector('.wcl-form.mod-a');
		let form = section.querySelector('.data-form')

		form.querySelector('.data-field-1-close').addEventListener('click', function (e) {
			form.querySelector('input[name="file"]').value = "";
			form.querySelector('.data-field-1-info').classList.remove('active')
		});

		form.querySelector('select').addEventListener('change', function (e) {
			this.classList.add('active')
		})

		form.querySelector('input[name="file"]').addEventListener('change', function (event) {
			let file = this.files[0];
			let fileType = file["type"];
			if (fileType != 'application/pdf') {
				alert('The file must be in valid formats');
				return;
			}
			let name = file['name'].slice(0, -4);
			name = name + '. PDF';
			//console.log(name)
			form.querySelector('.data-field-1-info').classList.add('active')
			form.querySelector('.data-field-1-name').textContent = name
		})

		form.addEventListener('submit', function name(e) {
			e.preventDefault();

			check_phone_num(form)

			if (form.querySelector('.data-field-notify')) {
				let notify = '<div class="data-notify">Сheck if the data entered is correct</div>'
				if (!form.querySelector('.data-notify')) {
					form.insertAdjacentHTML('beforeend', notify)
				}
				return
			}

			let field_name = form.querySelector('input[name="name"]').value
			let field_email = form.querySelector('input[name="email"]').value
			let field_phone = form.querySelector('input[name="phone"]').value
			let field_type_job = form.querySelector('select[name="type_job"]').value
			let field_link = form.querySelector('input[name="link"]').value
			let field_file = form.querySelector('input[name="file"]').files[0]
			let field_message = form.querySelector('textarea[name="message"]').value
			let field_recaptha = form.querySelector('input[name="g-recaptcha-response"]').value


			let fd = new FormData();
			fd.append("action", "form_a_handle");
			fd.append("field_name", field_name);
			fd.append("field_email", field_email);
			fd.append("field_phone", field_phone);
			fd.append("field_type_job", field_type_job);
			fd.append("field_link", field_link);
			fd.append("field_file", field_file);
			fd.append("field_message", field_message);
			fd.append("field_recaptha", field_recaptha);

			if (form.querySelector('.data-notify')) {
				form.querySelector('.data-notify').remove()
			}
			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, false);
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					let data = JSON.parse(xhr.responseText);
					//console.log(data)
					if (data.success) {
						clean_form(form);
					}
					if (data.note) {
						let notify = '<div class="data-notify"> ' + data.note + '</div>'
						form.insertAdjacentHTML('beforeend', notify)
					}
				}
			};
			xhr.send(fd);
		})
	}


	// Header

	if (document.querySelector('.wcl-header')) {
		let section = document.querySelector('.wcl-header');

		let menu_btns = section.querySelectorAll('.data-menu-btn')
		menu_btns.forEach(element => {
			element.querySelector('.data-menu-btn-ico').addEventListener("click", function () {
				let nav = section.querySelector('.data-nav')
				if (this.parentElement.classList.contains('mod-to-open')) {
					nav.classList.add("active");
					document.querySelector('body').classList.add('overflow-hidden')
				} else {
					nav.classList.remove('active');
					document.querySelector('body').classList.remove('overflow-hidden')
				}
			});
		});
	}

});