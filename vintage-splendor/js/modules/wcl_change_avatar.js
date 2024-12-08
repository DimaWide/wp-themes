

// wcl_change_avatar

function wcl_change_avatar() {
	if (document.querySelector('.wcl-change-avatar')) {
		let section = document.querySelector('.wcl-change-avatar');

		function wclEncodeImgtoBase64(element) {
			let avatar = form.querySelector('.data-img img');
			let img = element.files[0];
			let reader = new FileReader();
			reader.readAsDataURL(img);
			reader.onload = function () {
				avatar.src = reader.result;
			}
		}

		let form = section.querySelector('.wcl-change-avatar form')

		form.querySelector('input').addEventListener('change', function (event) {
			if (this.files[0].size > 2000000) {
				alert('Image size exceeds 2MB');
				return;
			}
			let file = this.files[0];
			let fileType = file["type"];
			let validImageTypes = ["image/gif", "image/jpeg", "image/png"];
			if (!validImageTypes.includes(fileType)) {
				alert('The image must be in valid formats (gif, jpg, png)');
				return;
			}
			wclEncodeImgtoBase64(this)
		})

		form.addEventListener('submit', function (e) {
			e.preventDefault();
			let form = this;
			let user_avatar = section.querySelector('.wcl-change-avatar input[name="user_avatar"]').files[0]

			var fd = new FormData();
			fd.append("action", "wcl_change_user_avatar");
			fd.append("user_avatar", user_avatar);

			if (form.querySelector('.data-notify')) {
				form.querySelector('.data-notify').remove()
			}

			var xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			section.querySelector('button[type="submit"]').setAttribute('disabled', 'disabled')
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);

					section.querySelector('button[type="submit"]').removeAttribute('disabled')

					if (data.submit) {
						let tag = '<div class="data-notify">' + data.submit + '</div>'
						form.insertAdjacentHTML('beforeend', tag)
						section.querySelector('.wcl-change-avatar input[name="user_avatar"]').value = ''
					}
				}
			};
			xhr.send(fd);
		});

		section.querySelector('button[name="cancel"]').addEventListener('click', function (e) {
			e.preventDefault()
			let user_avatar = section.querySelector('.wcl-change-avatar .data-img').getAttribute('data-val')
			section.querySelector('.wcl-change-avatar .data-img img').src = user_avatar
			section.querySelector('.wcl-change-avatar input[name="user_avatar"]').value = ''
		});
	}
}

export default wcl_change_avatar;
