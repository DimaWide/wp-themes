const ready = (callback) => {
	if (document.readyState != "loading") callback();
	else document.addEventListener("DOMContentLoaded", callback);
}

ready(() => {


	/*
	* Prevent CF7 form duplication emails
	*/
	let cf7_forms_submit = document.querySelectorAll('.wpcf7-form .wpcf7-submit');

	if (cf7_forms_submit) {
		cf7_forms_submit.forEach((element) => {

			element.addEventListener('click', (e) => {

				let form = element.closest('.wpcf7-form');

				if (form.classList.contains('submitting')) {
					e.preventDefault();
				}

			});

		});
	}







	/* SCRIPTS GO HERE */


	// wcl-add-product-popup
	if (document.querySelector('.wcl-single-product') && document.querySelector('.wcl-add-product-popup')) {
		let section = document.querySelector('.wcl-add-product-popup')
		let section_prod = document.querySelector('.wcl-single-product')

		// section.querySelector('input[name="phone"]').addEventListener('input', function (event) {
		// 	var phoneNumber = this.value;
		// });

		section_prod.querySelector('.single_add_to_cart_button').addEventListener('click', function (e) {
			e.preventDefault();
			let self = this

			var productId = section_prod.getAttribute('data-id');

			if (!self.classList.contains('mod-blinking')) {
				self.classList.add('mod-blinking')
			}

			var data = {
				action: 'add_to_cart_2',
				product_id: productId
			};

			var xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			xhr.onreadystatechange = function () {
				if (xhr.readyState === 4 && xhr.status === 200) {
					var response = JSON.parse(xhr.responseText);

					self.classList.remove('mod-blinking')
					section.querySelector('.data-text').innerHTML = response.message

					document.querySelector('.mod-add-product-popup').classList.add('active')
					document.querySelector('body').classList.add('overflow-hidden');
					document.querySelector('html').classList.add('overflow-hidden');


					if (!document.querySelector('.wcl-header .data-cart-count span')) {
						let tag = '<div class="data-cart-count"><span>' + response.cart_count + '</span></div>';
						let parentElement = document.querySelector('.wcl-header .data-cart-icon');
						parentElement.insertAdjacentHTML('beforeend', tag);
					} else {
						document.querySelector('.wcl-header .data-cart-count span').textContent = response.cart_count
					}

					document.querySelector('.wcl-header .data-cart-label').textContent = response.pluralized
					document.querySelector('.wcl-header .data-cart-state').textContent = response.cart_total
				}
			};

			data = new URLSearchParams(data).toString();
			xhr.send(data);
		})
	}



	// wcl-get-call
	if (document.querySelector('.wcl-get-call')) {
		let section = document.querySelector('.wcl-get-call')

		// section.querySelector('input[name="phone"]').addEventListener('input', function (event) {
		// 	var phoneNumber = this.value;
		// });


		// form
		if (section.querySelector('.cmp6-form')) {
			section.querySelector('.cmp6-form').addEventListener("submit", function (e) {
				e.preventDefault();

				let name = section.querySelector('[name="name"]').value
				let phone = section.querySelector('[name="phone"]').value
				let phone_valid = section.querySelector('.cmp-7-phone').classList.contains('valid') ? true : false;

				let data_request = {
					action: 'get_call',
					name: name,
					phone: phone,
					phone_valid: phone_valid,
				};

				if (section.querySelector('.cmp6-form .cmp6-form-note')) {
					section.querySelector('.cmp6-form .cmp6-form-note').remove()
				}

				section.querySelectorAll('.cmp6-form .cmp6-field-note').forEach(element => {
					element.remove()
				});

				section.querySelector('input[type="submit"]').setAttribute('disabled', 'disabled')

				let xhr = new XMLHttpRequest();
				xhr.open('POST', wcl_obj.ajax_url, true);
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
				xhr.onload = function (data) {
					if (xhr.status >= 200 && xhr.status < 400) {
						var data = JSON.parse(xhr.responseText);

						if (data.errors) {
							Object.entries(data.errors).forEach(([key, errorMessage]) => {
								let field = section.querySelector(`[name='${key}']`);
								if (key == 'phone') {
									let tag = '<div class="cmp6-field-note mod-error">' + errorMessage + '</div>';
									section.querySelector('.cmp-7-phone').insertAdjacentHTML('beforeend', tag);
								} else if (field) {
									let tag = '<div class="cmp6-field-note mod-error">' + errorMessage + '</div>';
									field.insertAdjacentHTML('afterend', tag);
								}
							});
						}

						if (data.errors_form) {
							let tag = '<div class="cmp6-form-note mod-error">' + data.errors_form + '</div>';
							section.querySelector('.cmp6-form').insertAdjacentHTML('beforeend', tag);
						}

						if (data.message && data.success) {
							let tag = '<div class="cmp6-form-note mod-success">' + data.message + '</div>';
							section.querySelector('.cmp6-form').insertAdjacentHTML('beforeend', tag);

							section.querySelector('.cmp6-form').reset()

							// setTimeout(() => {
							// 	window.location.href = wcl_obj.site_url + 'my-account/edit-account';
							// }, 180);
						}


						section.querySelectorAll('.mask-char').forEach(element => {
							element.style.visibility = 'unset';
						});

						section.querySelector('input[type="submit"]').removeAttribute('disabled')
					};
				};

				data_request = new URLSearchParams(data_request).toString();
				xhr.send(data_request);
			});
		}
	}




	// aws-search-btn
	if (document.querySelector('.aws-search-btn')) {
		let section = document.querySelector('.aws-search-btn')

		var searchBtn = document.querySelector('.aws-search-btn.aws-form-btn');
		var searchInput = document.querySelector('.aws-search-form input[type="search"]'); // или используйте правильный селектор для вашего поля ввода

		if (searchBtn && searchInput) {
			searchBtn.addEventListener('click', function () {
				if (searchInput.value.trim() === '') {
					searchInput.focus();
				}
			});
		}
	}


	// woocommerce-breadcrumb
	if (document.querySelector('.woocommerce-breadcrumb')) {
		let section = document.querySelector('.woocommerce-breadcrumb')

		// breadcrumb
		const breadcrumb = section.querySelector('.woocommerce-breadcrumb-inner');

		if (breadcrumb) {
			if (breadcrumb.scrollWidth > breadcrumb.clientWidth) {
				breadcrumb.parentElement.classList.add('mod-overflow')
			}

			function isScrolledToEndRight(element) {
				let val = Math.round(element.scrollLeft + element.clientWidth) + 4
				return element.scrollWidth <= val;
			}

			breadcrumb.onscroll = function () {
				if (isScrolledToEndRight(breadcrumb)) {
					breadcrumb.parentElement.classList.add('mod-scroll-end')
				} else {
					breadcrumb.parentElement.classList.remove('mod-scroll-end')
				}
			};
		}

	}

	// wcl-other-poduct-cat
	if (document.querySelector('.wcl-other-poduct-cat')) {
		let section = document.querySelector('.wcl-other-poduct-cat')
		let loop = true

		if (window.matchMedia("(min-width: 1200px)").matches) {
			if (section.querySelector('.data-item')) {
				if (section.querySelectorAll('.data-slider').length < 6) {
					loop = false
				}
			}
		}

		if (section.querySelector('.data-slider')) {
			let swiper = new Swiper(section.querySelector('.data-slider'), {
				slidesPerView: 5,
				//	autoHeight: true, //enable auto height
				loop: loop,
				spaceBetween: 30,
				speed: 600,
				navigation: {
					nextEl: section.querySelector('.mod-next'),
					prevEl: section.querySelector('.mod-prev'),
				},
				breakpoints: {
					0: {
						slidesPerView: 2,
					},
					700: {
						slidesPerView: 3,
					},
					991: {
						slidesPerView: 4,
					},
					1200: {
						slidesPerView: 5,
					},
				}
			});
		}
	}

	// Cart Total Update / woocommerce-checkout
	if (document.querySelector('.woocommerce-checkout')) {
		let section = document.querySelector('.woocommerce-checkout')
		var paymentMethodsDropdown = document.getElementById('payment_methods_dropdown');
		var styleElement = document.getElementById('myStyle');

		// var billingAddressField = document.getElementById('billing_address_1_field');
		// if (billingAddressField) {
		// 	billingAddressField.style.display = 'none';
		// }

		document.addEventListener('click', function (e) {
			if (e.target.matches('.woocommerce-checkout #payment #place_order')) {
				if (!document.querySelector('.cmp-7-phone.valid') && section.classList.contains('first-submit')) {
					document.querySelector('.cmp-7-phone').classList.add('not-valid-2');
				} else {
					document.querySelector('.cmp-7-phone').classList.remove('not-valid-2');
				}
			}
		})

		if (paymentMethodsDropdown) {
			function updatePaymentMethod(selectedMethod) {
				var paymentMethods = document.getElementsByName('payment_method');
				for (var i = 0; i < paymentMethods.length; i++) {
					if (paymentMethods[i].value === selectedMethod) {
						paymentMethods[i].checked = true;
					}
				}
			}

			jQuery(document.body).on('updated_checkout', function () {
				var selectedMethod = paymentMethodsDropdown.value;
				updatePaymentMethod(selectedMethod);

				if (!document.querySelector('.cmp-7-phone.valid') && section.classList.contains('first-submit')) {
					document.querySelector('.cmp-7-phone').classList.add('not-valid-2');
				} else {
					document.querySelector('.cmp-7-phone').classList.remove('not-valid-2');
				}

				section.classList.add('first-submit')


				// Проверяем, существует ли элемент
				if (styleElement) {
					// Удаляем элемент
					styleElement.remove();
				}
			});

			paymentMethodsDropdown.addEventListener('change', function () {
				var selectedMethod = this.value;

				var xhr = new XMLHttpRequest();
				xhr.open('POST', wcl_obj.ajax_url, true);
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

				xhr.onreadystatechange = function () {
					if (xhr.readyState === 4 && xhr.status === 200) {
						var response = JSON.parse(xhr.responseText);
						if (response.success) {
							console.log('Payment method updated successfully');
							var event = new CustomEvent('update_checkout');
							document.body.dispatchEvent(event);
						} else {
							console.log('Failed to update payment method');
						}
					}
				};

				var data = 'action=update_payment_method&payment_method=' + encodeURIComponent(selectedMethod);
				xhr.send(data);
			});
		}
	}




	// Cart Total Update / woocommerce-checkout
	if (document.querySelector('.woocommerce-checkout')) {
		let section = document.querySelector('.woocommerce-checkout')

		function updateShippingMethodClass() {
			const shippingMethods = document.querySelectorAll('.woocommerce ul#shipping_method li');

			shippingMethods.forEach(function (method) {
				const radioInput = method.querySelector('input[type="radio"]');
			});
		}


		jQuery(document.body).on('updated_checkout', function (event, fragments, cart_hash) {
			updateShippingMethodClass();
		});

		function updatePaymentMethod(selectedMethod) {
			var paymentMethods = document.getElementsByName('shipping_method[0]');
			for (var i = 0; i < paymentMethods.length; i++) {
				if (paymentMethods[i].value === selectedMethod) {
					paymentMethods[i].checked = true;
				}
			}
		}

		jQuery(function ($) {
			jQuery(document.body).on('updated_checkout', function () {
				var selectedMethod = $('#shipping-method-select').val();
			});

			// Обработчик изменения выбранного способа доставки
			$('#shipping-method-select').change(function () {
				var shippingMethod = $(this).val();
				console.log(shippingMethod)
				updatePaymentMethod(shippingMethod);
				updateShippingMethodClass();
				jQuery(document.body).trigger('update_checkout');
			});
		});


		// Coupone
		document.addEventListener('click', function (e) {
			if (!e.target.closest('.data-coupone')) {
				if (document.querySelector('.data-coupone-note')) {
					document.querySelector('.data-coupone-note').remove()
				}
			}
		})

		if (section.querySelector('.data-coupone')) {
			document.querySelectorAll('.data-coupone').forEach(element => {
				element.querySelector('.data-coupone [name="apply_coupon"]').addEventListener("click", function (e) {
					e.preventDefault();

					let coupon_code = element.querySelector('[name="coupon_code"]').value

					let data_request = {
						action: 'order_coupone_apply',
						coupon_code: coupon_code,
					}

					if (element.querySelector('.data-coupone-note')) {
						element.querySelector('.data-coupone-note').remove()
					}

					let xhr = new XMLHttpRequest();
					xhr.open('POST', wcl_obj.ajax_url, true);
					xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
					xhr.onload = function (data) {
						if (xhr.status >= 200 && xhr.status < 400) {
							var data = JSON.parse(xhr.responseText);

							if (data.message) {
								let class_ = '';

								if (data.success) {
									class_ = 'mod-success'
								} else {
									class_ = 'mod-error'
								}

								let tag = '<div class="data-coupone-note ' + class_ + '">' + data.message + '</div>';
								element.querySelector('.data-coupone-inner').insertAdjacentHTML('afterend', tag);

								if (!document.querySelector('.cart-discount-2')) {
									if (data.success) {
										document.querySelector('.woocommerce-checkout .woocommerce-checkout').classList.add('mod-coupon')
										var $subtotalRow = jQuery('.woocommerce-checkout-review-order-table .cart-subtotal').last();
										$subtotalRow.after(data.new_row_html);
									}
								}
							}
						};
					};

					data_request = new URLSearchParams(data_request).toString();
					xhr.send(data_request);
				});
			});
		}
	}





	// Cart Total Update / woocommerce-cart
	if (document.querySelector('.woocommerce-cart')) {
		let section = document.querySelector('.woocommerce-cart')

		// if (section.querySelector('.cart_item .remove')) {
		// 	var removeButtons = section.querySelectorAll('.cart_item .remove');
		// 	console.log(removeButtons)

		// 	removeButtons.forEach(function (button) {
		// 		button.addEventListener('click', function (event) {
		// 			event.preventDefault();
		// 			console.log(123)
		// 			//jQuery(document.body).trigger('update_cart');
		// 			jQuery( "[name='update_cart']" ).trigger( "click" );
		// 			return

		// 			var productId = button.getAttribute('data-product_id');
		// 			var cartItemKey = button.getAttribute('data-cart_item_key');
		// 			var nonce = wcl_obj.nonce;

		// 			var data = new FormData();
		// 			data.append('action', 'remove_cart_item');
		// 			data.append('product_id', productId);
		// 			data.append('cart_item_key', cartItemKey);
		// 			data.append('nonce', nonce);

		// 			var xhr = new XMLHttpRequest();
		// 			xhr.open('POST', wcl_obj.ajax_url, true);
		// 			xhr.onload = function () {
		// 				if (xhr.status === 200) {
		// 					var response = JSON.parse(xhr.responseText);
		// 					console.log(response)
		// 					if (response.success) {
		// 						//location.reload(); // Reload the page to update the cart
		// 						if (!document.querySelector('.wcl-header .data-cart-count span')) {
		// 							let tag = '<div class="data-cart-count"><span>' + response.cart_count + '</span></div>';
		// 							let parentElement = document.querySelector('.wcl-header .data-cart-icon');
		// 							parentElement.insertAdjacentHTML('beforeend', tag);
		// 						} else {
		// 							document.querySelector('.wcl-header .data-cart-count span').textContent = response.cart_count
		// 						}

		// 						document.querySelector('.wcl-header .data-cart-label').textContent = response.pluralized
		// 						document.querySelector('.wcl-header .data-cart-state').textContent = response.cart_total

		// 					} else {
		// 						alert('Error removing item.');
		// 					}

		// 					jQuery(document.body).trigger('update_cart');
		// 				}

		// 			};
		// 			xhr.send(data);
		// 		});
		// 	});
		// }

		// data-counter-field input
		if (section.querySelector('.woocommerce-cart .data-counter-field input')) {
			section.querySelectorAll('.woocommerce-cart .data-counter-field input').forEach(element => {
				element.addEventListener('input', function (e) {
					var value = e.target.value;
					if (value > 9999) {
						e.target.value = 9999;
					} else if (value < 0) {
						e.target.value = 0;
					}
				})
			});

			jQuery(document).ready(function ($) {
				$('.quantity .qty').attr({
					'type': 'number',
					'pattern': '[0-9]*',
					'inputmode': 'numeric'
				});
			});
		}



		// update_total_cart
		jQuery(document.body).on('updated_cart_totals', function (event, fragments, cart_hash) {
			update_total_cart();
			//console.log(123)
		});

		function update_total_cart() {
			var xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			xhr.onreadystatechange = function () {
				if (xhr.readyState === 4 && xhr.status === 200) {
					var response = JSON.parse(xhr.responseText);

					if (response.success) {
						if (!document.querySelector('.wcl-header .data-cart-count span')) {
							let tag = '<div class="data-cart-count"><span>' + response.cart_count + '</span></div>';
							let parentElement = document.querySelector('.wcl-header .data-cart-icon');
							parentElement.insertAdjacentHTML('beforeend', tag);
						} else {
							document.querySelector('.wcl-header .data-cart-count span').textContent = response.cart_count
						}

						document.querySelector('.wcl-header .data-cart-label').textContent = response.pluralized
						document.querySelector('.wcl-header .data-cart-state').textContent = response.cart_total
					}
				}
			};

			var data = {
				action: 'update_total_cart',
			};

			data = new URLSearchParams(data).toString();
			xhr.send(data);
		}
	}




	// wcl-review-form
	if (document.querySelector('.wcl-review-form')) {
		let section = document.querySelector('.wcl-review-form')

		const textarea = document.querySelector('.wcl-review-form [name="description"]');
		const maxLength = 300;

		textarea.addEventListener('input', () => {
			const currentLength = textarea.value.length;

			if (currentLength > maxLength) {
				textarea.value = textarea.value.substring(0, maxLength);
			}
		});

		// form
		if (section.querySelector('.cmp6-form')) {
			section.querySelector('.cmp6-form').addEventListener("submit", function (e) {
				e.preventDefault();

				const name = document.querySelector('[name="name"]');
				const description = document.querySelector('[name="description"]');
				const avatar = document.querySelector('[name="avatar"]');
				const rating = document.querySelector('[name="rating"]');

				let formData = new FormData();
				formData.append('action', 'review_upload');
				formData.append('name', name.value);
				formData.append('description', description.value);
				formData.append('avatar', avatar.files[0]);
				formData.append('rating', rating.value);

				if (section.querySelector('.cmp6-form .cmp6-form-note')) {
					section.querySelector('.cmp6-form .cmp6-form-note').remove()
				}

				section.querySelector('input[type="submit"]').setAttribute('disabled', 'disabled')

				let xhr = new XMLHttpRequest();
				xhr.open('POST', wcl_obj.ajax_url, true);
				xhr.onload = function (data) {
					if (xhr.status >= 200 && xhr.status < 400) {
						let data = JSON.parse(xhr.responseText);

						if (data.message) {
							let message = data.message;

							let tag = '<div class="cmp6-form-note">' + message + '</div>';

							section.querySelector('.cmp6-form').insertAdjacentHTML('beforeend', tag);

							if (data.success) {
								section.querySelector('.cmp6-form-note').classList.add('mod-success')
							} else {
								section.querySelector('.cmp6-form-note').classList.add('mod-error')
							}

							// Clear
							document.querySelectorAll(".data-rating-item.active").forEach(element => {
								element.classList.remove('active')
							});

							if (section.querySelector('.data-avatar-preview-img img')) {
								section.querySelector('.data-avatar-preview-img img').remove()
							}

							if (data.success) {
								name.value = '';
								description.value = '';
								avatar.value = '';
								rating.value = '';
							}

							document.querySelector('.js-review-form .data-inner-out').scrollTop = document.querySelector('.js-review-form .data-inner-out').scrollHeight;
						}

						section.querySelector('input[type="submit"]').removeAttribute('disabled')
					};
				};

				xhr.send(formData);
			});
		}




		// rating
		const ratingItems = document.querySelectorAll(".data-rating-item");

		ratingItems.forEach(function (item) {
			item.addEventListener("click", function () {
				const value = this.getAttribute("data-value");
				document.querySelector('[name="rating"]').value = value;

				ratingItems.forEach(function (i) {
					if (i.getAttribute("data-value") <= value) {
						i.classList.add("active");
					} else {
						i.classList.remove("active");
					}
				});
			});
		});



		// avatar
		document.querySelector('.data-avatar input').addEventListener('change', function (event) {
			var file = event.target.files[0];
			var reader = new FileReader();

			reader.onload = function (event) {
				var imgElement = document.createElement('img');
				imgElement.src = event.target.result;
				document.querySelector('.data-avatar-preview-img').innerHTML = '';
				document.querySelector('.data-avatar-preview-img').appendChild(imgElement);
			};

			reader.readAsDataURL(file);
		});

	}





	// wcl-wishlist-add
	if (document.querySelector('.wcl-body-inner')) {
		let section = document.querySelector('.wcl-body-inner')

		document.addEventListener('click', function (e) {
			if (!e.target.closest('.cmp3-wishlist-btn')) {
				if (document.querySelector('.cmp3-wishlist-btn-notify.active')) {
					let notify = document.querySelector('.cmp3-wishlist-btn-notify.active')

					if (notify.classList.contains('active')) {
						notify.classList.remove('active');
					}
				}
			}
		})

		function wishlist_notify(self) {
			let timeoutId;

			let item = self.closest('.cmp-3-product ')

			let notify = item.querySelector('.cmp3-wishlist-btn-notify')
			notify.textContent = 'Додано в Обране'
			notify.classList.add('active');

			if (notify.classList.contains('active')) {
				timeoutId = setTimeout(function () {
					notify.classList.remove('active');
				}, 2000);
			}
		}

		if (window.matchMedia("(min-width: 1024px)").matches) {
			document.addEventListener('mouseover', function (event) {
				if (event.target.closest('.cmp3-wishlist-btn')) {
					let target = event.target.closest('.cmp3-wishlist-btn')

					if (!target.classList.contains('mod-added')) {
						let notify = target.querySelector('.cmp3-wishlist-btn-notify')
						notify.textContent = 'В обране';
						notify.classList.add('active');
					}
				}
			});
		}

		document.addEventListener('mouseout', function (event) {
			if (event.target.closest('.cmp3-wishlist-btn')) {
				let target = event.target.closest('.cmp3-wishlist-btn')
				let notify = target.querySelector('.cmp3-wishlist-btn-notify')

				if (!target.classList.contains('mod-added')) {
					notify.classList.remove('active');
				}
			}
		});

		function getWishlist() {
			const cookies = document.cookie.split(';').reduce((cookies, item) => {
				const [name, value] = item.split('=');
				cookies[name.trim()] = value;
				return cookies;
			}, {});
			return cookies.wishlist ? JSON.parse(decodeURIComponent(cookies.wishlist)) : [];
		}

		function saveWishlist(wishlist) {
			const wishlistString = encodeURIComponent(JSON.stringify(wishlist));
			document.cookie = `wishlist=${wishlistString};path=/;max-age=31536000`; // 1 year
		}

		document.addEventListener('click', function (e) {
			let self = e.target.closest('.cmp3-wishlist-btn')

			if (!document.querySelector('body.logged-in')) {
				if (self) {
					e.preventDefault()

					if (self.classList.contains('disable')) {
						return
					}
					let product_id = self.closest('.cmp-3-product').getAttribute('data-id')

					if (self.classList.contains('active')) {
						self.classList.remove('active')
					} else {
						self.classList.add('active')
					}

					self.classList.add('disable')

					let wishlist = getWishlist();

					if (wishlist.includes(product_id)) {
						// Если продукт уже в списке, удалить его
						wishlist = wishlist.filter(id => id !== product_id);
						//	console.log(`Product ${product_id} removed from wishlist`);

						if (self.classList.contains('mod-added')) {
							self.classList.remove('mod-added')
							self.querySelector('.cmp3-wishlist-btn-notify').classList.remove('active')
							document.querySelector('.wcl-header .data-wish-list').classList.remove('active')
						}
					} else {
						// Если продукта нет в списке, добавить его
						wishlist.push(product_id);
						//console.log(`Product ${product_id} added to wishlist`);

						wishlist_notify(self)
						self.classList.add('mod-added')
						document.querySelector('.wcl-header .data-wish-list').classList.add('active')
					}

					//console.log(wishlist);

					saveWishlist(wishlist);

					wish_list_count_set(wishlist);

					self.classList.remove('disable')
				}
			} else {
				if (self) {
					e.preventDefault()

					if (self.classList.contains('disable')) {
						return
					}

					let product_id = self.closest('.cmp-3-product').getAttribute('data-id')

					let data_request = {
						action: 'wishlist_add_product',
						product_id: product_id,
					}

					if (self.classList.contains('active')) {
						self.classList.remove('active')
					} else {
						self.classList.add('active')
					}

					self.classList.add('disable')

					let xhr = new XMLHttpRequest();
					xhr.open('POST', wcl_obj.ajax_url, true);
					xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
					xhr.onload = function (data) {
						if (xhr.status >= 200 && xhr.status < 400) {
							var data = JSON.parse(xhr.responseText);

							self.classList.remove('disable')

							if (data.state == 'added') {
								wishlist_notify(self)
								self.classList.add('mod-added')
							} else {
								if (self.classList.contains('mod-added')) {
									self.classList.remove('mod-added')
									self.querySelector('.cmp3-wishlist-btn-notify').classList.remove('active')
								}
							}

							wish_list_count_set(data)
						};
					};

					data_request = new URLSearchParams(data_request).toString();
					xhr.send(data_request);
				}
			}
		})

		function wish_list_count_set(data = '') {
			if (document.querySelector('body.logged-in')) {
				if (data.count && data.count > 0) {
					document.querySelector('.wcl-header .data-wish-list-count').textContent = data.count
					document.querySelector('.wcl-header .data-wish-list').classList.add('is-fill')
					document.querySelector('.wcl-header .data-wish-list').classList.remove('is-99-more', 'is-10-more');

					if (data.count > 99) {
						document.querySelector('.wcl-header .data-wish-list').classList.add('is-99-more');
					} else if (data.count > 9) {
						document.querySelector('.wcl-header .data-wish-list').classList.add('is-10-more');
					}
				} else {
					document.querySelector('.wcl-header .data-wish-list').classList.remove('is-fill')
				}
			} else {
				let wishlist = getWishlist();
				if (wishlist && wishlist.length > 0) {
					document.querySelector('.wcl-header .data-wish-list-count').textContent = wishlist.length
					document.querySelector('.wcl-header .data-wish-list').classList.add('is-fill')
					document.querySelector('.wcl-header .data-wish-list').classList.remove('is-99-more', 'is-10-more');

					if (wishlist.length > 99) {
						document.querySelector('.wcl-header .data-wish-list').classList.add('is-99-more');
					} else if (wishlist.length > 9) {
						document.querySelector('.wcl-header .data-wish-list').classList.add('is-10-more');
					}
				} else {
					document.querySelector('.wcl-header .data-wish-list').classList.remove('is-fill')
				}
			}
		}


		if (document.querySelector('.wcl-single-product')) {
			document.addEventListener('click', function (e) {
				let self = e.target.closest('.data-add-to-wishlist')

				if (self) {
					e.preventDefault()

					let product_id = self.closest('.wcl-single-product').getAttribute('data-id')

					if (!document.querySelector('body.logged-in')) {

						let wishlist = getWishlist();

						if (wishlist.includes(product_id)) {
							wishlist = wishlist.filter(id => id !== product_id);
							console.log(`Product ${product_id} removed from wishlist`);

							self.querySelector('.data-add-to-wishlist-btn').classList.remove('active')

						} else {
							wishlist.push(product_id);
							console.log(`Product ${product_id} added to wishlist`);

							self.querySelector('.data-add-to-wishlist-btn').classList.add('active')
						}

						saveWishlist(wishlist);

						wish_list_count_set()
					} else {

						let data_request = {
							action: 'wishlist_add_product',
							product_id: product_id,
						}

						if (self.querySelector('.data-add-to-wishlist-btn').classList.contains('active')) {
							self.querySelector('.data-add-to-wishlist-btn').classList.remove('active')
						} else {
							self.querySelector('.data-add-to-wishlist-btn').classList.add('active')
						}

						let xhr = new XMLHttpRequest();
						xhr.open('POST', wcl_obj.ajax_url, true);
						xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
						xhr.onload = function (data) {
							if (xhr.status >= 200 && xhr.status < 400) {
								var data = JSON.parse(xhr.responseText);

								wish_list_count_set(data)
							};
						};

						data_request = new URLSearchParams(data_request).toString();
						xhr.send(data_request);
					}
				}
			})
		}
	}



	// wcl-wish-list
	if (document.querySelector('.wcl-wish-list')) {
		let section = document.querySelector('.wcl-wish-list')
		let load_more = section.querySelector('.data-load-more')

		// load_more
		if (load_more) {
			load_more.addEventListener("click", function (e) {
				e.preventDefault();
				if (e.target.classList.contains('cmp-button')) {
					if (e.target.getAttribute("disable") == 'disable') {
						return false;
					}

					let self = e.target
					let page = e.target.getAttribute("data-page");

					self.classList.add('mod-blinking')
					wishlist_load_product(page);
				}
			});
		}

		// wishlist_load_product
		function wishlist_load_product(page_new) {
			let page = 1;

			if (page_new) {
				page = parseInt(page_new) + 1;
			}

			let data_request = {
				action: 'wishlist_load_product',
				page: page,
			}

			load_more.querySelector('button').setAttribute('disabled', 'disabled')

			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);

					load_more.querySelector('button').classList.remove('mod-blinking')
					load_more.querySelector('button').removeAttribute('disabled')

					if (page_new) {
						section.querySelector('.data-list').insertAdjacentHTML('beforeend', data.posts);
						section.querySelector('.data-load-more .data-load-more-container').innerHTML = data.button;
					}
				};
			};

			data_request = new URLSearchParams(data_request).toString();
			xhr.send(data_request);
		}
	}

	// wcl-shop
	// filter-btn
	if (document.querySelector('.wcl-shop ')) {
		let section = document.querySelector('.wcl-shop')

		section.querySelector('.data-filter-btn').addEventListener('click', function (e) {
			if (section.querySelector('.data-filter-out').classList.contains('active')) {
				section.querySelector('.data-filter-out').classList.remove('active')
				document.querySelector('body').classList.remove('overflow-hidden')
			} else {
				section.querySelector('.data-filter-out').classList.add('active')
				document.querySelector('body').classList.add('overflow-hidden')
			}
		})

		section.querySelectorAll('.js-close').forEach(element => {
			element.addEventListener('click', function (e) {
				if (section.querySelector('.data-filter-out').classList.contains('active')) {
					section.querySelector('.data-filter-out').classList.remove('active')
					document.querySelector('body').classList.remove('overflow-hidden')
				} else {
					section.querySelector('.data-filter-out').classList.add('active')
					document.querySelector('body').classList.add('overflow-hidden')
				}
			})
		});

		section.querySelector('.data-filter-nav-btn.js-apply').addEventListener('click', function (e) {
			if (section.querySelector('.data-filter-out').classList.contains('active')) {
				section.querySelector('.data-filter-out').classList.remove('active')
				document.querySelector('body').classList.remove('overflow-hidden')
			} else {
				section.querySelector('.data-filter-out').classList.add('active')
				document.querySelector('body').classList.add('overflow-hidden')
			}
		})
	}


	// wcl-change-password
	if (document.querySelector('.wcl-change-password')) {
		let section = document.querySelector('.wcl-change-password')


		document.querySelectorAll('.data-toggle-password').forEach(toggleBtn => {
			toggleBtn.addEventListener('click', () => {
				const input = toggleBtn.previousElementSibling;


				if (!toggleBtn.classList.contains('active')) {
					toggleBtn.classList.add('active')
				} else {
					toggleBtn.classList.remove('active')
				}

				if (input.type === "password") {
					input.type = "text";
				} else {
					input.type = "password";
				}
			});
		});


		// form
		if (section.querySelector('.cmp6-form')) {
			section.querySelector('.cmp6-form').addEventListener("submit", function (e) {
				e.preventDefault();

				let current_password = section.querySelector('[name="current_password"]').value
				let new_password = section.querySelector('[name="new_password"]').value
				let confirm_password = section.querySelector('[name="confirm_password"]').value

				let data_request = {
					action: 'user_change_password',
					current_password: current_password,
					new_password: new_password,
					confirm_password: confirm_password,
				};

				if (section.querySelector('.cmp6-form .cmp6-form-note')) {
					section.querySelector('.cmp6-form .cmp6-form-note').remove()
				}

				section.querySelector('input[type="submit"]').setAttribute('disabled', 'disabled')

				let xhr = new XMLHttpRequest();
				xhr.open('POST', wcl_obj.ajax_url, true);
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
				xhr.onload = function (data) {
					if (xhr.status >= 200 && xhr.status < 400) {
						var data = JSON.parse(xhr.responseText);

						if (data.message || data.success) {
							let message = data.message;

							if (data.success) {
								message = "Пароль успішно змінено.";
							}

							let tag = '<div class="cmp6-form-note">' + message + '</div>';
							section.querySelector('.cmp6-form').insertAdjacentHTML('beforeend', tag);

							if (data.success === true) {
								section.querySelector('.cmp6-form-note').classList.add('mod-success')
							}

							if (data.success === false) {
								section.querySelector('.cmp6-form-note').classList.add('mod-error')
							}

							if (data.success) {
								setTimeout(() => {
									window.location.href = wcl_obj.site_url + 'my-account/';
								}, 1000);
							}
						}

						section.querySelector('input[type="submit"]').removeAttribute('disabled')
					};
				};

				data_request = new URLSearchParams(data_request).toString();
				xhr.send(data_request);
			});
		}
	}




	// js-popup-open

	if (document.querySelector('.js-popup-open')) {
		if (document.querySelector('.wcl-popup')) {
			let items = document.querySelectorAll('.js-popup-open')

			items.forEach(element => {
				element.addEventListener('click', function (e) {
					e.preventDefault()

					let target_popup_id = this.getAttribute('data-target');
					target_popup = document.querySelector('[data-id="' + target_popup_id + '"]');

					if (target_popup) {
						if (document.querySelector('.wcl-header').querySelector('.data-nav').classList.contains('active')) {
							document.querySelector('.wcl-header').querySelector('.hamburger.active').classList.remove('active')
							document.querySelector('.wcl-header').classList.remove('active')
							document.querySelector('.wcl-header').querySelector('.data-nav').classList.remove('active')
						}

						target_popup.classList.add('active')

						document.querySelector('body').classList.add('overflow-hidden');
						document.querySelector('html').classList.add('overflow-hidden');
					}
				})
			});
		}
	}




	// wcl-popup
	if (document.querySelector('.wcl-popup')) {
		let items = document.querySelectorAll('.wcl-popup')

		items.forEach(element => {
			element.querySelectorAll('.js-close').forEach(close => {
				close.addEventListener('click', function (e) {
					element.classList.remove('active')
					document.querySelector('body').classList.remove('overflow-hidden');
					document.querySelector('html').classList.remove('overflow-hidden');
				})
			});

			element.querySelector('.data-overlay').addEventListener('click', function (e) {
				element.classList.remove('active')
				document.querySelector('body').classList.remove('overflow-hidden');
				document.querySelector('html').classList.remove('overflow-hidden');
			})

			element.querySelector('.data-inner-out').addEventListener('click', function (e) {
				if (!e.target.closest('.data-inner')) {
					element.classList.remove('active')
					document.querySelector('body').classList.remove('overflow-hidden');
					document.querySelector('html').classList.remove('overflow-hidden');
				}
			})
		});
	}



	// cmp-6-form
	if (document.querySelector('.cmp-6-form')) {
		let section = document.querySelector('.cmp-6-form')
		let inputs = section.querySelectorAll('.cmp6-form-field input');

		// inputs
		inputs.forEach(function (input) {
			input.addEventListener('input', function () {
				if (this.value.trim() === '') {
					this.classList.remove('active');
				} else {
					this.classList.add('active');
				}
			});
		});


		// dateInput
		let dateInput = section.querySelector('[name="date_of_birth"]')

		if (dateInput) {
			var maxDate = new Date(dateInput.max);

			// Event listener for blur event
			dateInput.addEventListener("blur", function () {
				if (dateInput.value) {
					var dateValue = new Date(dateInput.value);

					if (dateValue > maxDate) {
						alert("Дата перевищує максимально дозволену дату " + formatDate(maxDate) + ". Скидання до максимальної дати.");
						dateValue = maxDate;
					}
				} else {
					dateInput.type = "text";
				}
			});

			// Event listener for focus event
			dateInput.addEventListener("focus", function () {
				if (!dateInput.value) {
					var dateValue = parseDate(dateInput.value);
					console.log(dateValue)
					dateInput.type = "date";
					dateInput.value = dateValue;
				}
			});

			// Helper function to format date to text in dd . mm . yyyy
			function formatDate(date) {
				var day = ("0" + date.getDate()).slice(-2);
				var month = ("0" + (date.getMonth() + 1)).slice(-2);
				var year = date.getFullYear();
				return `${day}.${month}.${year}`;
			}

			// Helper function to parse formatted date back to yyyy-mm-dd
			function parseDate(dateString) {
				var parts = dateString.split(".");
				var day = parts[0];
				var month = parts[1];
				var year = parts[2];
				return `${year}-${month}-${day}`;
			}
		}
	}


	// wcl-contact-info-edit
	if (document.querySelector('.wcl-contact-info-edit')) {
		let section = document.querySelector('.wcl-contact-info-edit')

		// form
		if (section.querySelector('.cmp6-form')) {
			section.querySelector('.cmp6-form').addEventListener("submit", function (e) {
				e.preventDefault();

				let first_name = section.querySelector('[name="first_name"]').value
				let last_name = section.querySelector('[name="last_name"]').value
				let email = section.querySelector('[name="email"]').value
				let phone = section.querySelector('[name="phone"]').value
				let date_of_birth = section.querySelector('[name="date_of_birth"]').value
				let phone_code_country = section.querySelector('.cmp7-country-code').textContent
				let phone_valid = section.querySelector('.cmp-7-phone').classList.contains('valid') ? true : false;

				let data_request = {
					action: 'user_edit_contact_info',
					first_name: first_name,
					last_name: last_name,
					email: email,
					phone: phone,
					phone_code_country: phone_code_country,
					phone_valid: phone_valid,
					date_of_birth: date_of_birth,
				};

				if (section.querySelector('.cmp6-form .cmp6-form-note')) {
					section.querySelector('.cmp6-form .cmp6-form-note').remove()
				}

				section.querySelectorAll('.cmp6-form .cmp6-field-note').forEach(element => {
					element.remove()
				});

				section.querySelector('input[type="submit"]').setAttribute('disabled', 'disabled')

				let xhr = new XMLHttpRequest();
				xhr.open('POST', wcl_obj.ajax_url, true);
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
				xhr.onload = function (data) {
					if (xhr.status >= 200 && xhr.status < 400) {
						var data = JSON.parse(xhr.responseText);

						if (data.errors) {
							Object.entries(data.errors).forEach(([key, errorMessage]) => {
								let field = section.querySelector(`[name='${key}']`);

								if (field) {
									if (key == 'accept_terms') {
										let tag = '<div class="cmp6-form-note mod-error">' + errorMessage + '</div>';
										section.querySelector('.cmp6-form').insertAdjacentHTML('beforeend', tag);
									} else if (key == 'phone') {
										let tag = '<div class="cmp6-field-note mod-error">' + errorMessage + '</div>';
										section.querySelector('.cmp-7-phone').insertAdjacentHTML('beforeend', tag);
									} else {
										let tag = '<div class="tmp3-field-note mod-error">' + errorMessage + '</div>';
										field.insertAdjacentHTML('afterend', tag);
									}
								}
							});
						}

						if (data.errors_form) {
							let tag = '<div class="cmp6-form-note mod-error">' + data.errors_form + '</div>';
							section.querySelector('.cmp6-form').insertAdjacentHTML('beforeend', tag);
						}

						if (data.message && data.success) {
							let tag = '<div class="cmp6-form-note mod-success">' + data.message + '</div>';
							section.querySelector('.cmp6-form').insertAdjacentHTML('beforeend', tag);

							setTimeout(() => {
								window.location.href = wcl_obj.site_url + 'my-account/edit-account';
							}, 180);
						}

						section.querySelector('input[type="submit"]').removeAttribute('disabled')
					};
				};

				data_request = new URLSearchParams(data_request).toString();
				xhr.send(data_request);
			});
		}
	}








	// cmp-7-phone
	if (document.querySelector('.cmp-7-phone')) {
		let items = document.querySelectorAll('.cmp-7-phone')

		// Установка атрибута maxlength
		// setTimeout(() => {
		// 	section.querySelector('input[name="phone"]').setAttribute('maxlength', '20');
		// }, 10);


		// if (document.querySelector('.woocommerce-checkout')) {
		// 	document.querySelector('.woocommerce-checkout input[name="billing_phone"]').addEventListener('focusout', function () {
		// 		if (!document.querySelector('.cmp-7-phone.valid') && document.querySelector('.cmp-7-phone.mod-typed')) {
		// 			document.querySelector('.cmp-7-phone').classList.add('not-valid-2');
		// 		} else {
		// 			document.querySelector('.cmp-7-phone').classList.remove('not-valid-2');
		// 		}
		// 	});
		// }

		items.forEach(function (element) {
			let section = element.closest('.cmp-7-phone');
			var phoneInput = section.querySelector('.cmp7-phone')
			var phoneMask = '(099) 000 00 00';
			var phoneMaskDef = '(000) 000 00 00';
			var maskHtml = '';

			for (var i = 0; i < phoneMask.length; i++) {
				maskHtml += '<div class="mask-char" data-id="mask-char-' + i + '">' + phoneMask[i] + '</div>';
			}

			section.querySelector('.cmp7-mask-text').innerHTML = maskHtml;

			jQuery(phoneInput).mask(phoneMaskDef, {
				translation: {
					'0': {
						pattern: /[0-9]/,
						optional: false
					}
				},
				placeholder: ""
			});

			let maskChars = section.querySelectorAll('.mask-char');

			if (phoneInput.value != '') {
				maskChars.forEach(element => {
					element.style.visibility = 'hidden';
				});
			}

			phoneInput.addEventListener('input', function () {
				var value = this.value.replace(/\D/g, '');
				var valueIndex = 0;
				let maskChars = section.querySelectorAll('.mask-char');

				section.classList.add('mod-typed')

				// Update visibility of mask characters as user inputs
				for (var i = 0; i < phoneMask.length; i++) {
					var maskCharElement = section.querySelector('[data-id="mask-char-' + i + '"]');
					if ((phoneMask[i] === '0' || phoneMask[i] === '9') && value[valueIndex]) {
						maskCharElement.style.visibility = 'hidden';
						valueIndex++;
					} else {
						maskCharElement.style.visibility = 'visible';
					}
				}

				for (let i = 0; i < this.value.length; i++) {
					if (phoneMask[i] === '(' || phoneMask[i] === ')' || phoneMask[i] === ' ') {
						if (maskChars[i].style.visibility !== 'hidden') {
							maskChars[i].style.visibility = 'hidden';
						}
					}
				}

				// Validation logic to check if the input matches the mask
				var formattedValue = this.value.replace(/\D/g, '');
				var isValid = formattedValue.length === phoneMask.replace(/\D/g, '').length;
				let billingPhoneValidField = section.querySelector('[name="billing_phone_valid"]');

				if (isValid && validateUkrainianPhoneNumber(value)) {
					phoneInput.classList.remove('not-valid');
					phoneInput.classList.add('valid');

					section.classList.remove('not-valid');
					section.classList.add('valid');

					section.classList.remove('not-valid-2');

					if (section.classList.contains('mod-wc')) {
						billingPhoneValidField.value = 'true';
					}
				} else {
					phoneInput.classList.remove('valid');

					console.log(formattedValue.length)

					if (formattedValue.length == 10) {
						phoneInput.classList.add('not-valid');
					}

					section.classList.remove('valid');

					if (formattedValue.length == 10) {
						section.classList.add('not-valid');
						//section.classList.add('not-valid-2');
					}

					if (section.classList.contains('mod-wc')) {
						billingPhoneValidField.value = 'false';
					}
				}
			});
		});

		function validateUkrainianPhoneNumber(phoneNumber) {
			// Регулярное выражение для проверки украинского номера телефона
			const phoneRegex = /^(?:\+38)?0\d{9}$/;

			// Проверка формата номера телефона
			if (!phoneRegex.test(phoneNumber)) {
				return false;
			}

			// Список допустимых префиксов операторов мобильной связи в Украине
			const validPrefixes = [
				'039', '050', '063', '066', '067', '068', '091', '092', '093', '094', '095', '096', '097', '098', '099'
			];

			// Удаляем префикс страны, если он есть
			const cleanedNumber = phoneNumber.replace(/^\+38/, '');
			const prefix = cleanedNumber.substring(0, 3);

			// Проверка наличия префикса в списке допустимых
			return validPrefixes.includes(prefix);
		}

	}


	// wcl-registration
	if (document.querySelector('.wcl-registration')) {
		let section = document.querySelector('.wcl-registration')

		// form
		if (section.querySelector('.cmp6-form')) {
			section.querySelector('.cmp6-form').addEventListener("submit", function (e) {
				e.preventDefault();

				let first_name = section.querySelector('[name="first_name"]').value
				let last_name = section.querySelector('[name="last_name"]').value
				let email = section.querySelector('[name="email"]').value
				let phone = section.querySelector('[name="phone"]').value
				let password = section.querySelector('[name="password"]').value
				let date_of_birth = section.querySelector('[name="date_of_birth"]').value
				let accept_terms = section.querySelector('[name="accept_terms"]:checked')
				accept_terms = accept_terms ? accept_terms.value : '';

				let phone_code_country = section.querySelector('.cmp7-country-code').textContent
				let phone_valid = section.querySelector('.cmp-7-phone').classList.contains('valid') ? true : false;

				let data_request = {
					action: 'registration_user',
					first_name: first_name,
					last_name: last_name,
					email: email,
					phone: phone,
					phone_code_country: phone_code_country,
					phone_valid: phone_valid,
					password: password,
					date_of_birth: date_of_birth,
					accept_terms: accept_terms
				};

				if (section.querySelector('.cmp6-form .cmp6-form-note')) {
					section.querySelector('.cmp6-form .cmp6-form-note').remove()
				}

				section.querySelectorAll('.cmp6-form .cmp6-field-note').forEach(element => {
					element.remove()
				});

				section.querySelector('input[type="submit"]').setAttribute('disabled', 'disabled')

				let xhr = new XMLHttpRequest();
				xhr.open('POST', wcl_obj.ajax_url, true);
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
				xhr.onload = function (data) {
					if (xhr.status >= 200 && xhr.status < 400) {
						var data = JSON.parse(xhr.responseText);

						if (data.errors) {
							Object.entries(data.errors).forEach(([key, errorMessage]) => {
								let field = section.querySelector(`[name='${key}']`);

								if (field) {
									if (key == 'accept_terms') {
										let tag = '<div class="cmp6-form-note mod-error">' + errorMessage + '</div>';
										section.querySelector('.cmp6-form').insertAdjacentHTML('beforeend', tag);
									} else if (key == 'phone') {
										let tag = '<div class="cmp6-field-note mod-error">' + errorMessage + '</div>';
										section.querySelector('.cmp-7-phone').insertAdjacentHTML('beforeend', tag);
									} else {
										let tag = '<div class="cmp6-field-note mod-error">' + errorMessage + '</div>';
										field.insertAdjacentHTML('afterend', tag);
									}
								}
							});
						}

						if (data.errors_form) {
							let tag = '<div class="cmp6-form-note mod-error">' + data.errors_form + '</div>';
							section.querySelector('.cmp6-form').insertAdjacentHTML('beforeend', tag);
						}

						if (data.message && data.success) {
							let tag = '<div class="cmp6-form-note mod-success">' + data.message + '</div>';
							section.querySelector('.cmp6-form').insertAdjacentHTML('beforeend', tag);

							setTimeout(() => {
								window.location.href = wcl_obj.site_url + 'my-account/';
							}, 1000);
						}

						section.querySelector('input[type="submit"]').removeAttribute('disabled')
					};
				};

				data_request = new URLSearchParams(data_request).toString();
				xhr.send(data_request);
			});
		}
	}


	// wcl-blog 

	if (document.querySelector('.wcl-blog')) {

		document.querySelectorAll('.wcl-blog').forEach(element => {
			let section = element
			let page_items = section.getAttribute('data-page-items');
			let load_more = section.querySelector('.data-load-more')
			let pagination = section.querySelector('.data-pagination')

			// load_more
			if (load_more) {
				load_more.addEventListener("click", function (e) {
					e.preventDefault();
					if (e.target.classList.contains('cmp-button')) {
						let self = e.target

						if (e.target.getAttribute("disable") == 'disable') {
							return false;
						}

						let page = e.target.getAttribute("data-page");
						self.classList.add('mod-blinking')
						blog_page_load_post(page, 'load-more', section);
					}
				});
			}

			// pagination
			if (pagination) {
				pagination.addEventListener("click", function (e) {
					let self = e.target.closest('a')
					if (self) {
						e.preventDefault();

						if (e.target.classList.contains('mod-current')) {
							return false;
						}

						let page = self.getAttribute("data-page");
						self.classList.add('mod-blinking')
						blog_page_load_post(page, '', section);
					}
				});
			}
		});

		// blog_page_load_post
		function blog_page_load_post(page_new, target = '', section) {
			let page = 1;
			let page_items = section.getAttribute('data-page-items');
			let load_more = section.querySelector('.data-load-more')
			let pagination = section.querySelector('.data-pagination')

			if (page_new) {
				if (target == 'load-more') {
					page = parseInt(page_new) + 1;
				} else {
					page = page_new
				}
			}

			let data_request = {
				action: 'blog_page_load_post',
				page: page,
				page_items: page_items,
			}

			load_more.querySelector('button').setAttribute('disabled', 'disabled')

			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);

					if (target == 'load-more') {
						section.querySelector('.data-list').insertAdjacentHTML('beforeend', data.posts);
					} else {
						section.querySelector('.data-list').innerHTML = data.posts;
					}

					section.querySelector('.data-pagination-inner').innerHTML = data.pagination;

					if (data.count_pages && data.count_pages > 1) {
						section.querySelector('.data-nav').classList.add('active')
					} else {
						section.querySelector('.data-nav').classList.remove('active')
					}

					section.querySelectorAll('.mod-blinking').forEach(element => {
						element.classList.remove('mod-blinking')
					});

					if (data.has_more) {
						load_more.querySelector('button').removeAttribute('disabled')
						load_more.querySelector('button').setAttribute('data-page', page)
					}

					// Scroll To
					if (target != 'load-more') {
						let absoluteOffset = document.querySelector('.wcl-page ').offsetTop;
						let value = 15;

						if (window.matchMedia("(max-width: 991px)").matches) {
							value = 8;
						}

						window.scrollTo({
							top: 0, // absoluteOffset - value,
							behavior: 'smooth'
						});

						// Update Page Num
						const breadcrumb = document.querySelector('.woocommerce-breadcrumb');
						const lastSpan = breadcrumb.querySelector('span:last-child');

						if (lastSpan && lastSpan.innerText.includes('Сторінка')) {
							lastSpan.innerText = 'Сторінка ' + page;
						}
					}

					// buildURL
					buildURL(section);
				};
			};
			data_request = new URLSearchParams(data_request).toString();
			xhr.send(data_request);
		}


		// buildURL
		function buildURL(section) {
			let url = wcl_obj.site_url;
			let currentPage = section.querySelector('.data-pagination .mod-current'); // Найдем текущую страницу
			let page = currentPage ? currentPage.getAttribute('data-page') : 1; // Номер текущей страницы
			let blog_slug = document.querySelector('.wcl-blog').getAttribute('data-blog-slug');
			url = url + blog_slug + '/'

			if (page !== '1' && section.querySelector('.data-pagination .mod-current')) {
				url += 'page/' + page + '/';
			}

			window.history.pushState(wcl_obj.site_url, document.title, url);
		}
	}





	// wcl-single-product

	if (document.querySelector('.wcl-single-product')) {
		let section = document.querySelector('.wcl-single-product')

		document.addEventListener('click', function (e) {
			if (e.target.classList.contains('mfp-img')) {
				const img = e.target;
				let isZoomed = img.getAttribute('data-zoomed') === 'true';

				if (!isZoomed) {
					const rect = img.getBoundingClientRect();
					const offsetX = e.clientX - rect.left;
					const offsetY = e.clientY - rect.top;

					img.style.transformOrigin = `${offsetX}px ${offsetY}px`;
					img.style.transform = 'scale(2)';
					img.style.cursor = 'zoom-out';
					img.setAttribute('data-zoomed', 'true');
				} else {
					img.style.transform = 'scale(1)';
					img.style.transformOrigin = 'center center';
					img.style.cursor = 'zoom-in';
					img.setAttribute('data-zoomed', 'false');
				}
			}
		});

		// desc
		if (section.querySelector('.data-desc')) {
			section.querySelectorAll('.data-desc-btn').forEach(element => {
				element.addEventListener('click', function () {
					if (element.closest('.data-desc').classList.contains('active')) {
						element.closest('.data-desc').classList.remove('active')
					} else {
						element.closest('.data-desc').classList.add('active')
					}
				})
			});
		}

		// attrs
		if (section.querySelector('.data-attrs-btn')) {
			section.querySelector('.data-attrs-btn').addEventListener('click', function () {
				if (section.querySelector('.data-attrs').classList.contains('active')) {
					section.querySelector('.data-attrs').classList.remove('active')
				} else {
					section.querySelector('.data-attrs').classList.add('active')
				}
			})
		}

		// slider
		if (section.querySelector('.data-slider')) {
			let loop = true;

			if (section.querySelectorAll('.data-slider-item').length < 2) {
				loop = false
			}

			let swiper = new Swiper(section.querySelector('.data-slider'), {
				slidesPerView: 1,
				autoHeight: true,
				loop: false,
				spaceBetween: 10,
				speed: 400,
			});

			// Initialize Magnific Popup for zoom functionality
			jQuery('.data-slider').magnificPopup({
				delegate: 'a.gallery-item',
				type: 'image',
				image: {
					titleSrc: function () {
						return '';
					}
				},
				gallery: {
					enabled: false
				},
				zoom: {
					enabled: true,
					duration: 300, // продолжительность анимации зума
					easing: 'ease-in-out', // функция сглаживания
				},
				callbacks: {
					open: function () {
						// Add custom class to mfp-wrap when popup is opened
						jQuery('.mfp-wrap').addClass('mod-zoom');
					}
				}
			});

			let swiper_2 = '';

			if (section.querySelector('.data-slider-2')) {
				let loop = true;

				if (section.querySelectorAll('.data-slider .data-item').length <= 5) {
					loop = false
				}

				swiper_2 = new Swiper(section.querySelector('.data-slider-2'), {
					slidesPerView: 5,
					loop: false,
					spaceBetween: 20,
					speed: 400,
					navigation: {
						nextEl: section.querySelector('.mod-next'),
						prevEl: section.querySelector('.mod-prev'),
					},
					// thumbs: {
					// 	swiper: swiper,
					// },
					breakpoints: {
						0: {
							spaceBetween: 10,
						},
						991: {
							spaceBetween: 20
						},
					}
				});

				// Initialize Magnific Popup for zoom functionality
				jQuery('.data-slider-2').magnificPopup({
					delegate: 'a.gallery-item',
					type: 'image',
					gallery: {
						enabled: true
					},
					image: {
						titleSrc: function () {
							return '';
						}
					},
					zoom: {
						enabled: true,
						duration: 300, // Duration of the animation
						easing: 'ease-in-out', // Easing function
					}
				});
			}

			if (swiper) {
				swiper.on('slideChange', function () {
					let activeIndex = swiper.activeIndex;
					swiper_2.slideTo(activeIndex);
				});
			}

			if (swiper_2) {
				swiper_2.on('slideChange', function () {
					let activeIndex = swiper_2.activeIndex;
					swiper.slideTo(activeIndex);
				});
			}
		}


	}


	// cmp3-cart
	// if (document.querySelector('.wcl-body-inner')) {
	// 	let section = document.querySelector('.wcl-body-inner')

	// 	return

	// 	document.addEventListener('click', function (e) {
	// 		if (e.target.closest('.cmp3-cart')) {
	// 			e.preventDefault()

	// 			let self = e.target.closest('.cmp3-cart')

	// 			if (self.classList.contains('added')) {
	// 				window.location.href = wcl_obj.site_url + 'cart/';
	// 				return;
	// 			}

	// 			if (!self.classList.contains('mod-blinking')) {
	// 				self.classList.add('active')
	// 				self.classList.add('mod-blinking')
	// 				var productId = self.getAttribute('data-product-id');
	// 				addToCart(productId, self);
	// 			}
	// 		}
	// 	})

	// 	function addToCart(productId, self) {
	// 		var xhr = new XMLHttpRequest();
	// 		xhr.open('POST', wcl_obj.ajax_url, true);
	// 		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	// 		xhr.onreadystatechange = function () {
	// 			if (xhr.readyState === 4 && xhr.status === 200) {
	// 				var response = JSON.parse(xhr.responseText);

	// 				if (response.success) {
	// 					self.classList.add('added')

	// 					if (!document.querySelector('.wcl-header .data-cart-count span')) {
	// 						let tag = '<div class="data-cart-count"><span>' + response.cart_count + '</span></div>';
	// 						let parentElement = document.querySelector('.wcl-header .data-cart-icon');
	// 						parentElement.insertAdjacentHTML('beforeend', tag);
	// 					} else {
	// 						document.querySelector('.wcl-header .data-cart-count span').textContent = response.cart_count
	// 					}

	// 					document.querySelector('.wcl-header .data-cart-state').textContent = response.pluralized
	// 				} else {
	// 					console.error('Failed to add product to cart');
	// 				}

	// 				self.classList.remove('mod-blinking')
	// 			}
	// 		};

	// 		var data = {
	// 			action: 'add_to_cart',
	// 			product_id: productId
	// 		};

	// 		data = new URLSearchParams(data).toString();
	// 		xhr.send(data);
	// 	}
	// }




	// wcl-shop .data-filter

	if (document.querySelector('.wcl-shop .data-filter')) {
		let section = document.querySelector('.wcl-shop .data-filter')

		section.querySelectorAll('.data-filter-item.active').forEach(element => {
			let item = element
			let maxHeight = 0;

			let height = item.querySelector('.data-filter-item-body > *').offsetHeight;
			var computedStyle = window.getComputedStyle(item.querySelector('.data-filter-item-body > *'));
			var marginTop = computedStyle.getPropertyValue('margin-top');
			let paddingBottom = computedStyle.getPropertyValue('padding-bottom');
			maxHeight = height + parseFloat(marginTop) + parseFloat(paddingBottom)
			item.querySelector('.data-filter-item-body').style.maxHeight = maxHeight + "px";
		});

		section.querySelectorAll('.data-filter-item').forEach(element => {
			element.querySelector('.data-filter-item-title').addEventListener('click', function (e) {
				let item = this.parentElement
				let maxHeight = 0;

				let height = item.querySelector('.data-filter-item-body > *').offsetHeight;
				var computedStyle = window.getComputedStyle(item.querySelector('.data-filter-item-body > *'));
				var marginTop = computedStyle.getPropertyValue('margin-top');
				maxHeight = height + parseFloat(marginTop)

				if (this.parentElement.classList.contains('active')) {
					this.parentElement.classList.remove('active')
					this.parentElement.classList.add('mod-hiding')
					item.querySelector('.data-filter-item-body').style.maxHeight = null;
				} else {
					this.parentElement.classList.add('active')
					this.parentElement.classList.remove('mod-hiding')
					item.querySelector('.data-filter-item-body').style.maxHeight = maxHeight + "px";
				}
			})
		});
	}





	// cmp-price-range
	if (document.querySelector('.cmp-price-range')) {
		let section = document.querySelector('.cmp-price-range')

		let minValue = section.querySelector(".data-price .input-min");
		let maxValue = section.querySelector(".data-price .input-max");

		const rangeFill = section.querySelector(".data-slider-fill");

		const minRange = section.querySelector(".data-range-input .min-price").min;
		const maxRange = section.querySelector(".data-range-input .max-price").max;

		function formatPrice(price) {
			var formattedPrice = parseFloat(price).toFixed(2);
			formattedPrice = formattedPrice.replace(/\B(?=(\d{3})+(?!\d))/g, " ");
			formattedPrice += ' ₴';
			return formattedPrice;
		}

		// Function to validate range and update the fill color on slider
		function validateRange() {
			let minPrice = parseInt(inputElements[0].value);
			let maxPrice = parseInt(inputElements[1].value);

			// Swap the values if minPrice is greater than maxPrice
			if (minPrice > maxPrice) {
				let tempValue = maxPrice;
				maxPrice = minPrice;
				minPrice = tempValue;
			}

			section.setAttribute("data-min", minPrice);
			section.setAttribute("data-max", maxPrice);

			// Calculate the percentage position for min and max values
			const minPercentage = ((minPrice - 0) / maxRange) * 100;
			const maxPercentage = ((maxPrice - 0) / maxRange) * 100;

			// Set the position and width of the fill color element to represent the selected range
			rangeFill.style.left = minPercentage + "%";
			rangeFill.style.width = maxPercentage - minPercentage + "%";

			minValue.value = formatPrice(minPrice);
			maxValue.value = formatPrice(maxPrice)
		}

		// Get references to the input elements
		const inputElements = section.querySelectorAll(".data-range-input input");

		// Add an event listener to each input element
		inputElements.forEach((element) => {
			element.addEventListener("input", validateRange);
		});

		// Initial call to validateRange
		validateRange();
	}





	if (document.querySelector('.wcl-shop')) {
		let section = document.querySelector('.wcl-shop')
		let load_more = section.querySelector('.data-load-more')
		var orderbySelect = section.querySelector('.data-orderby select')
		let filters = section.querySelectorAll('.data-filter input:not([name="categories"])');
		let pagination = section.querySelector('.data-pagination')

		// orderbySelect
		if (orderbySelect) {
			orderbySelect.addEventListener('change', function () {
				loadProducts();
			});
		}

		// Event listener for filter button
		section.querySelector('.js-apply').addEventListener('click', function (e) {
			loadProducts()
		});

		// filter events
		if (window.innerWidth < 991) {
			filters.forEach(filter => {
				filter.removeEventListener('change', function () {
					loadProducts()
				});
			});
		} else {
			filters.forEach(filter => {
				filter.addEventListener('change', function () {
					loadProducts()
				});
			});
		}

		// categories
		if (section.querySelector('.data-fields-categories a')) {
			section.querySelectorAll('.data-fields-categories a').forEach(element => {
				element.addEventListener('click', function (e) {
					e.preventDefault()


					if (window.innerWidth >= 991) {
						cat_event(this)
						loadProducts();
					} else {
						section.querySelectorAll('.data-fields-categories a.active').forEach(element_2 => {
							if (this != element_2 && element_2.classList.contains('active')) {
								element_2.classList.remove('active')
							}
						});

						if (this.classList.contains('active')) {
							this.classList.remove('active')

							section.setAttribute('data-cat-removed', this.getAttribute('data-slug'))

							// if (section.querySelector('.data-fields-categories a.active')) {
							// 	cat_event_2(section.querySelector('.data-fields-categories a.active'))
							// }

						} else {
							this.classList.add('active')

							section.setAttribute('data-cat-removed', '')
							section.setAttribute('data-cat-current', this.getAttribute('data-slug'))

							// if (section.querySelector('.data-fields-categories a.active')) {
							// 	cat_event_2(section.querySelector('.data-fields-categories a.active'))
							// }
						}
					}
				})
			});
		}


		// cat_event 2
		function cat_event_2(self) {
			let titleElement = document.querySelector('.wcl-shop .cmp-title');
			let breadcrumb = document.querySelector('.woocommerce-breadcrumb-inner');
			let lastSpan = breadcrumb.querySelector('span:last-child');
			let linkText = self.textContent.trim();

			section.querySelectorAll('.data-fields-categories a.active').forEach(element_2 => {
				if (self != element_2 && element_2.classList.contains('active')) {
					element_2.classList.remove('active')
				}
			});

			if (self.classList.contains('active')) {

				if (titleElement) {
					titleElement.textContent = linkText;
				}

				if (lastSpan) {
					if (lastSpan.innerText.includes('Всі товари')) {
						var newSpan = document.createElement('span');
						newSpan.className = 'data-delimiter';
						newSpan.innerHTML = '<img src="' + wcl_obj.template_url + '/img/arrow-breadcrumb.svg" alt="img">';
						breadcrumb.appendChild(newSpan);

						var newSpan = document.createElement('span');
						newSpan.innerText = linkText
						breadcrumb.appendChild(newSpan);

						var spans = breadcrumb.querySelectorAll('span');

						spans.forEach(function (span) {
							if (span.innerText.includes('Всі товари')) {
								// Создаем новый <a> элемент
								var newLink = document.createElement('a');
								newLink.href = wcl_obj.site_url + 'shop/';
								newLink.innerText = 'Всі товари';

								// Заменяем <span> на <a>
								span.textContent = ''
								span.appendChild(newLink);
							}
						});
					} else {
						lastSpan.innerText = linkText;
					}
				}
			} else {
				if (titleElement) {
					titleElement.textContent = 'Каталог';
				}

				if (lastSpan) {
					if (lastSpan.innerText.includes('Всі товари')) {
					} else {
						lastSpan.remove()
						breadcrumb.querySelector('.data-delimiter:last-child').remove();

						if (breadcrumb.querySelector('a.mod-all-product')) {
							var anchorElement = breadcrumb.querySelector('a.mod-all-product');

							if (anchorElement) {
								// Step 2: Create a new span element
								var spanElement = document.createElement('span');

								// Step 3: Copy the necessary attributes and content
								spanElement.className = anchorElement.className;
								spanElement.innerHTML = anchorElement.innerHTML;

								// Step 4: Replace the anchor tag with the span element
								anchorElement.parentNode.replaceChild(spanElement, anchorElement);
							}
						}

						var spans = breadcrumb.querySelectorAll('span');

						spans.forEach(function (span) {
							if (span.innerText.includes('Всі товари')) {
								span.innerHTML = 'Всі товари'
							}
						});

					}
				}
			}
		}

		// cat_event
		function cat_event(self) {
			let titleElement = document.querySelector('.wcl-shop .cmp-title');
			let breadcrumb = document.querySelector('.woocommerce-breadcrumb-inner');
			let lastSpan = breadcrumb.querySelector('span:last-child');
			let linkText = self.textContent.trim();

			section.querySelectorAll('.data-fields-categories a.active').forEach(element_2 => {
				if (self != element_2 && element_2.classList.contains('active')) {
					element_2.classList.remove('active')
				}
			});

			if (self.classList.contains('active')) {
				self.classList.remove('active')

				if (titleElement) {
					titleElement.textContent = 'Каталог';
				}

				if (lastSpan) {
					if (lastSpan.innerText.includes('Всі товари')) {
					} else {
						lastSpan.remove()
						breadcrumb.querySelector('.data-delimiter:last-child').remove();

						if (breadcrumb.querySelector('a.mod-all-product')) {
							var anchorElement = breadcrumb.querySelector('a.mod-all-product');

							if (anchorElement) {
								// Step 2: Create a new span element
								var spanElement = document.createElement('span');

								// Step 3: Copy the necessary attributes and content
								spanElement.className = anchorElement.className;
								spanElement.innerHTML = anchorElement.innerHTML;

								// Step 4: Replace the anchor tag with the span element
								anchorElement.parentNode.replaceChild(spanElement, anchorElement);
							}
						}

						var spans = breadcrumb.querySelectorAll('span');

						spans.forEach(function (span) {
							if (span.innerText.includes('Всі товари')) {
								span.innerHTML = 'Всі товари'
							}
						});

					}
				}
			} else {
				self.classList.add('active')

				if (titleElement) {
					titleElement.textContent = linkText;
				}

				if (lastSpan) {
					if (lastSpan.innerText.includes('Всі товари')) {
						var newSpan = document.createElement('span');
						newSpan.className = 'data-delimiter';
						newSpan.innerHTML = '<img src="' + wcl_obj.template_url + '/img/arrow-breadcrumb.svg" alt="img">';
						breadcrumb.appendChild(newSpan);

						var newSpan = document.createElement('span');
						newSpan.innerText = linkText
						breadcrumb.appendChild(newSpan);

						var spans = breadcrumb.querySelectorAll('span');

						spans.forEach(function (span) {
							if (span.innerText.includes('Всі товари')) {
								// Создаем новый <a> элемент
								var newLink = document.createElement('a');
								newLink.href = wcl_obj.site_url + 'shop/';
								newLink.innerText = 'Всі товари';

								// Заменяем <span> на <a>
								span.textContent = ''
								span.appendChild(newLink);
							}
						});
					} else {
						lastSpan.innerText = linkText;
					}
				}
			}
		}


		// load_more
		if (load_more) {
			load_more.addEventListener("click", function (e) {
				e.preventDefault();

				if (e.target.closest('.data-load-more-btn')) {
					if (e.target.getAttribute("disable") == 'disable') {
						return false;
					}

					let self = e.target.closest('.data-load-more-btn')

					self.classList.add('mod-blinking')
					let page = self.getAttribute("data-page");
					loadProducts(page, 'load-more');
				}
			});
		}

		// pagination
		if (pagination) {
			pagination.addEventListener("click", function (e) {
				let self = e.target.closest('a')
				if (self) {
					e.preventDefault();

					if (e.target.classList.contains('mod-current')) {
						return false;
					}

					let page = self.getAttribute("data-page");
					self.classList.add('mod-blinking')
					loadProducts(page);
				}
			});
		}

		// Функция для получения значений фильтров
		function getFilterValues(section, filterName) {
			let filterValues = [];
			const checkboxInputs = section.querySelectorAll(`input[name="${filterName}"]:checked`);
			checkboxInputs.forEach(input => {
				if (input.value) {
					filterValues.push(input.value);
				}
			});
			return JSON.stringify({ [filterName]: filterValues });
		}

		// loadProducts
		function loadProducts(page_next = false, target = '') {
			let page = 1;
			let category_slug = '';
			let discounted_products = '';
			let min_price = '';
			let max_price = '';
			let sort_by = 'date';
			let search_query = '';

			// // categories

			if (window.innerWidth < 991) {
				if (section.querySelector('.data-fields-categories a.active')) {
					cat_event_2(section.querySelector('.data-fields-categories a.active'))
				} else {

					let link = section.querySelector('.data-fields-categories a[data-slug="' + section.getAttribute('data-cat-removed') + '"]');

					if (link) {
						cat_event_2(link)
					}
				}
			}

			// search_query
			if (section.hasAttribute('data-search-query')) {
				search_query = section.getAttribute('data-search-query');
			}

			// orderbySelect
			if (orderbySelect) {
				sort_by = orderbySelect.value;
			}

			// price
			if (section.querySelector('.data-filter .data-price-range')) {
				min_price = section.querySelector('.data-price-range').getAttribute('data-min');
				max_price = section.querySelector('.data-price-range').getAttribute('data-max');
			}

			// discounted_products
			if (section.querySelector('.data-filter input[name="discounted_products"]:checked')) {
				discounted_products = section.querySelector('.data-filter input[name="discounted_products"]:checked').value;
			}

			// Массив с наименованиями фильтров
			const filters = ['brand', 'marka', 'priznachennya', 'rozmir_v_mm', 'dovzhina', 'tovshchina', 'kraina_virobnik'];

			// Объект для хранения значений фильтров
			const filterValues = {};

			// Итерация по массиву фильтров для получения их значений
			filters.forEach(filter => {
				if (section.querySelector(`.data-filter input[name="${filter}"]:checked`)) {
					filterValues[filter] = getFilterValues(section, filter);
				}
			});

			// categories
			if (section.querySelector('.data-fields-categories a.active')) {
				category_slug = section.querySelector('.data-fields-categories a.active').getAttribute('data-slug');
			}

			// page_next
			if (page_next) {
				if (target == 'load-more') {
					page = parseInt(page_next) + 1;
				} else {
					page = page_next
				}
			}

			let data_request = {
				action: 'filter_products_by_category',
				sort_by: sort_by,
				min_price: min_price,
				max_price: max_price,
				discounted_products: discounted_products,
				brand: filterValues.brand ? filterValues.brand : '',
				marka: filterValues.marka ? filterValues.marka : '',
				priznachennya: filterValues.priznachennya ? filterValues.priznachennya : '',
				rozmir_v_mm: filterValues.rozmir_v_mm ? filterValues.rozmir_v_mm : '',
				dovzhina: filterValues.dovzhina ? filterValues.dovzhina : '',
				tovshchina: filterValues.tovshchina ? filterValues.tovshchina : '',
				kraina_virobnik: filterValues.kraina_virobnik ? filterValues.kraina_virobnik : '',
				category_slug: category_slug,
				search_query: search_query,
				page: page,
			}

			//	console.log(data_request)

			let data_request_new = data_request

			if (section.querySelector('.data-list-out')) {
				section.querySelector('.data-list-out').classList.add('active')
			}

			load_more.querySelector('button').setAttribute('disabled', 'disabled')

			generate_url(data_request_new);

			// Проверяем, есть ли параметры в строке
			const queryString = window.location.search;

			if (queryString || page != 1 || category_slug) {
				section.querySelector('.data-reset-btn').classList.add('active')
			} else {
				section.querySelector('.data-reset-btn').classList.remove('active')
			}

			var xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);

					load_more.querySelector('button').classList.remove('mod-blinking')
					load_more.querySelector('button').setAttribute('disabled', false)

					if (page_next && target == 'load-more') {
						section.querySelector('.data-list').insertAdjacentHTML('beforeend', data.posts);
						section.querySelector('.data-load-more .data-load-more-container').innerHTML = data.button;
					} else {
						section.querySelector('.data-list').innerHTML = data.posts;
						section.querySelector('.data-load-more .data-load-more-container').innerHTML = data.button;

						// scrollTo
						let absoluteOffset = document.querySelector('.wcl-shop ').offsetTop;
						let value = 15;

						if (window.matchMedia("(max-width: 991px)").matches) {
							value = 8;
						}

						window.scrollTo({
							top: 0, // absoluteOffset - value
							behavior: 'smooth'
						});
					}

					section.querySelector('.data-pagination-inner').innerHTML = data.pagination;

					if (section.querySelector('.data-list-out').classList.contains('active')) {
						section.querySelector('.data-list-out').classList.remove('active')
					}

					handleResize();
				};
			};

			data_request = new URLSearchParams(data_request).toString();
			xhr.send(data_request);
		}


		// reset-btn
		section.querySelector('.data-reset-btn').addEventListener('click', function name(params) {
			var orderbySelect = section.querySelector('.data-orderby select');
			orderbySelect.selectedIndex = 0;
			let filters = section.querySelectorAll('.data-filter input:not([name="categories"])');

			filters.forEach(function (filter) {
				if (filter.type === 'checkbox' || filter.type === 'radio') {
					filter.checked = false;
				}
			});



			let rangeInputs = section.querySelectorAll('.data-range-input input[type="range"]');

			rangeInputs.forEach(function (rangeInput) {
				let minValue = section.querySelector(".data-price .input-min");
				let maxValue = section.querySelector(".data-price .input-max");

				if (rangeInput.classList.contains('min-price')) {
					rangeInput.value = rangeInput.min;
					section.querySelector('.data-price-range').setAttribute('data-min', rangeInput.min);
					minValue.value = formatPrice(rangeInput.min);
				} else if (rangeInput.classList.contains('max-price')) {
					rangeInput.value = rangeInput.max;
					section.querySelector('.data-price-range').setAttribute('data-max', rangeInput.max);
					maxValue.value = formatPrice(rangeInput.max)
				}
			});

			// search_query
			if (section.hasAttribute('data-search-query') && section.getAttribute('data-search-query')) {
				section.setAttribute('data-search-query', '');
				if (section.querySelector('.woocommerce-breadcrumb span:last-child')) {
					section.querySelector('.woocommerce-breadcrumb span:last-child').remove()
				}
				if (section.querySelector('.woocommerce-breadcrumb span:last-child')) {
					section.querySelector('.woocommerce-breadcrumb span:last-child').remove()
				}
			}

			if (section.querySelector('.data-fields-categories-item a.active')) {
				if (section.querySelector('.woocommerce-breadcrumb span:last-child')) {
					section.querySelector('.woocommerce-breadcrumb span:last-child').remove()
				}
				if (section.querySelector('.woocommerce-breadcrumb span:last-child')) {
					section.querySelector('.woocommerce-breadcrumb span:last-child').remove()
				}
			}

			section.querySelectorAll('.data-fields-categories a.active').forEach(element => {
				element.classList.remove('active')
			});

			var dataSliderFill = document.querySelector('.cmp-price-range .data-slider-fill');

			if (dataSliderFill) {
				dataSliderFill.style.left = '0';
				dataSliderFill.style.width = '100%';
			}

			loadProducts();
		})


		// generate_url
		function generate_url(data) {
			let url = wcl_obj.site_url + 'shop/';
			let params = '';

			// category_slug
			if (data.category_slug.length > 0) {
				url = wcl_obj.site_url + 'product-category/';
				url += data.category_slug + '/';
			}

			if (data.page && data.page != 1) {
				url += 'page/' + data.page + '/';
			}

			// search_query
			if (data.search_query.length > 0) {
				params += 's=' + data.search_query + '&';
			}

			// Prices
			let min_price_range = section.querySelector('.data-range-input input').min
			let max_price_range = section.querySelector('.data-range-input input').max

			if (parseInt(data.min_price) > parseInt(min_price_range) || parseInt(data.max_price) < parseInt(max_price_range)) {
				// min_price
				if (data.min_price.length > 0) {
					params += 'min_price=' + data.min_price + '&';
				}

				// max_price
				if (data.max_price.length > 0) {
					params += 'max_price=' + data.max_price + '&';
				}
			}

			// discounted_products
			if (data.discounted_products.length > 0) {
				params += 'discounted_products=' + 'yes' + '&';
			}

			// attributes
			var attributes = [
				{ name: 'brand' },
				{ name: 'marka' },
				{ name: 'priznachennya' },
				{ name: 'rozmir_v_mm' },
				{ name: 'dovzhina' },
				{ name: 'tovshchina' },
				{ name: 'kraina_virobnik' },
			];

			attributes.forEach(function (attribute) {
				if (data[attribute.name] && data[attribute.name] !== undefined) {
					params += attribute.name + '=' + JSON.parse(data[attribute.name])[attribute.name].join(',') + '&';
				}
			});

			// sort_by
			if (data.sort_by.length > 0) {
				if (data.sort_by != 'date') {
					params += 'sort_by=' + data.sort_by + '&';
				}
			}

			// params
			if (params) {
				params = '?' + params;
			}

			params = params.endsWith('&') ? params.slice(0, -1) : params;
			url = url + params

			window.history.pushState(wcl_obj.site_url, document.title, url);
		}

	}



	// js-post-item
	function truncateText(element) {
		var containerHeight = element.clientHeight;

		if (!element.children[0]) {
			return
		}

		var style = window.getComputedStyle(element.children[0]);
		var height = style.getPropertyValue('height');
		var textHeight = parseFloat(height)

		if (textHeight > containerHeight) {
			while (textHeight > containerHeight) {
				let text = element.textContent
				text = text.replace(/\W*\s(\S)*$/, '...');

				if (text.trim().length > 20) {
					element.textContent = element.textContent.replace(/\W*\s(\S)*$/, '...');
					textHeight = element.scrollHeight;
				} else {
					break;
				}
			}
		}
	}


	function handleResize() {
		let items = document.querySelectorAll('.js-post-item')

		items.forEach(element => {
			if (element.querySelector('.js-post-item-title')) {
				truncateText(element.querySelector('.js-post-item-title'))
			}
		});
	}


	if (document.querySelector('.js-post-item')) {
		handleResize();
	}



	// wcl-acf-block-1

	if (document.querySelector('.wcl-acf-block-1')) {
		let sections = document.querySelectorAll('.wcl-acf-block-1')

		// slider
		sections.forEach(section => {
			let swiper = new Swiper(section.querySelector('.data-slider'), {
				slidesPerView: 1,
				loop: true,
				spaceBetween: 10,
				speed: 600,
				navigation: {
					nextEl: section.querySelector('.mod-next'),
					prevEl: section.querySelector('.mod-prev'),
				},
			});
		});
	}




	// wcl-acf-block-3

	if (document.querySelector('.wcl-acf-block-3')) {
		let sections = document.querySelectorAll('.wcl-acf-block-3')

		// slider
		sections.forEach(section => {
			let swiper = new Swiper(section.querySelector('.data-slider'), {
				slidesPerView: 3,
				loop: true,
				spaceBetween: 30,
				speed: 600,
				navigation: {
					nextEl: section.querySelector('.mod-next'),
					prevEl: section.querySelector('.mod-prev'),
				},
				breakpoints: {
					0: {
						slidesPerView: 1,
						spaceBetween: 20,
						autoHeight: true,
					},
					660: {
						slidesPerView: 2,
						spaceBetween: 30,
						autoHeight: false,
					},
					1300: {
						slidesPerView: 3,
					},
				}
			});
		});
	}



	// wcl-header

	if (document.querySelector('.wcl-header')) {
		let section = document.querySelector('.wcl-header')

		function setHeight() {
			const vh = window.innerHeight * 0.01;
			document.documentElement.style.setProperty('--vh', `${vh}px`);
			document.querySelector('.wcl-header .data-nav').style.height = `calc(var(--vh, 1vh) * 100 - 69px)`;
		}

		// Initial height set
		setHeight();

		// Adjust the height on resize
		window.addEventListener('resize', setHeight);

		// btn-menu
		section.querySelector('.data-btn-menu').addEventListener('click', function (e) {
			if (this.classList.contains('active')) {
				this.classList.remove('active')
				this.closest('.wcl-header').classList.remove('active')
				section.querySelector('.data-nav').classList.remove('active')
				document.querySelector('body').classList.remove('overflow-hidden')

				if (document.querySelector('body').classList.contains('admin-bar')) {
					document.querySelector('html').classList.remove('html-no-margin')

					if (document.querySelector('#wpadminbar')) {
						document.querySelector('#wpadminbar').style.display = 'block';
					}
				}
			} else {
				this.classList.add('active')
				this.closest('.wcl-header').classList.add('active')
				section.querySelector('.data-nav').classList.add('active')
				document.querySelector('body').classList.add('overflow-hidden')

				if (document.querySelector('body').classList.contains('admin-bar')) {
					document.querySelector('html').classList.add('html-no-margin')

					if (document.querySelector('#wpadminbar')) {
						document.querySelector('#wpadminbar').style.display = 'none';
					}
				}
			}
		})
	}
});