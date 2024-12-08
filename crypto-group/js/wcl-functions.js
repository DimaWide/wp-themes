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




	// woocommerce-checkout
	if (document.querySelector('.woocommerce-checkout')) {
		let section = document.querySelector('.woocommerce-checkout')
		let coupon_elem = section.querySelector('.data-coupone input[name="coupon_code"]')
		let coupone_block = section.querySelector('.data-coupone')

		jQuery(function ($) {
			// Перехватываем событие изменения формы оформления заказа
			$(document.body).on('updated_checkout', function () {
				// Обновляем область с общей суммой заказа
				var order_total = $('.woocommerce-checkout-review-order-table tfoot tr.order-total span.amount').first().text();
				console.log($('.woocommerce-checkout-review-order-table tfoot tr.order-total span.amount'))
				console.log(order_total)
				$('.data-b2-total-value').text(order_total);

				// var totalAmount = $('.order-total .woocommerce-Price-amount').text();
				// $('.data-b2-total-value').text( totalAmount);
			});
		});

		if (section.querySelector('.data-coupone')) {
			coupone_block.querySelector('.data-coupone-btn').addEventListener('click', function (e) {
				if (!coupone_block.classList.contains('active')) {
					coupone_block.classList.add('active');
				} else {
					coupone_block.classList.remove('active');
				}

				if (coupon_elem.hasAttribute('required')) {
					coupon_elem.removeAttribute('required');
				} else {
					coupon_elem.setAttribute('required', '');
				}
			})

			section.querySelector('.data-coupone form').addEventListener("submit", function (e) {
				e.preventDefault();

				let coupon_code = coupone_block.querySelector('[name="coupon_code"]').value

				let data_request = {
					action: 'order_coupone_apply',
					coupon_code: coupon_code,
				}

				if (coupone_block.querySelector('.data-coupone-note')) {
					coupone_block.querySelector('.data-coupone-note').remove()
				}

				let xhr = new XMLHttpRequest();
				xhr.open('POST', wcl_obj.ajax_url, true);
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
				xhr.onload = function (data) {
					if (xhr.status >= 200 && xhr.status < 400) {
						var data = JSON.parse(xhr.responseText);
						console.log(data)
						jQuery(document.body).trigger('update_checkout');

						if (data.message) {
							let class_ = '';

							if (data.success) {
								class_ = 'mod-success'
							} else {
								class_ = 'mod-error'
							}

							let tag = '<div class="data-coupone-note ' + class_ + '">' + data.message + '</div>';
							coupone_block.querySelector('.data-coupone-inner').insertAdjacentHTML('beforeend', tag);

							if (data.success) {
								document.querySelector('.woocommerce-checkout .woocommerce-checkout').classList.add('mod-coupon')
								var $subtotalRow = jQuery('.woocommerce-checkout-review-order-table .cart-subtotal').last();
								$subtotalRow.after(data.new_row_html);
							}
						}
					};
				};

				data_request = new URLSearchParams(data_request).toString();
				xhr.send(data_request);
			});
		}

		// Coupone
		document.addEventListener('click', function (e) {
			if (!e.target.closest('.data-coupone-inner')) {
				if (document.querySelector('.data-coupone.active')) {
					document.querySelector('.data-coupone').classList.remove('active');
				}
			}
		})
	}



	// wcl-video-hero
	if (document.querySelector('.wcl-video-hero')) {
		let section = document.querySelector('.wcl-video-hero')
		let video = section.querySelector('video')

		// Attach event listeners to each timecode link
		section.querySelectorAll('.data-timecodes-item').forEach(link => {
			link.addEventListener('click', function (event) {
				event.preventDefault();
				const timecode = this.getAttribute('data-timecode');
				seekTo(convertTimecodeToSeconds(timecode));

				video.play();
				section.querySelector('.data-video').classList.add("mod-play");
			});
		});


		document.addEventListener('click', function (e) {
			if (e.target.closest('.data-video')) {
				let element = e.target.closest('.data-video')
				let video = element.querySelector('video')

				video.setAttribute('controls', '');

				if (video && !element.classList.contains('mod-pause')) {
					video.removeAttribute('controls');
					video.pause();
					element.classList.remove("mod-play");
					element.classList.add("mod-pause")
				} else {
					video.play();
					element.classList.remove("mod-pause");
					element.classList.add("mod-play");
				}
			}
		})

		// Function to convert timecode (MM:SS) to seconds
		function convertTimecodeToSeconds(timecode) {
			const parts = timecode.split(':');
			const minutes = parseInt(parts[0], 10);
			const seconds = parseInt(parts[1], 10);
			return minutes * 60 + seconds;
		}

		// Seek to specific time in the video
		function seekTo(seconds) {
			video.currentTime = seconds;
			video.play();
		}
	}



	// wcl-acf-block-12 / posts
	if (document.querySelector('.wcl-acf-block-12')) {
		let section = document.querySelector('.wcl-acf-block-12')
		let load_more = section.querySelector('.data-load-more')
		let cats = section.querySelectorAll('.data-cats a')

		// load_more
		if (load_more) {
			load_more.addEventListener("click", function (e) {
				e.preventDefault();
				if (e.target.classList.contains('data-load-more-btn')) {
					if (e.target.getAttribute("disable") == 'disable') {
						return false;
					}

					let self = e.target
					let page = e.target.getAttribute("data-page");

					self.classList.add('mod-active')
					videos_listing_load_posts(page);
				}
			});
		}


		// cats
		if (cats) {
			if (window.matchMedia("(min-width: 991px)").matches) {
				cats.forEach(element => {
					let categoryWidth = element.getBoundingClientRect().width;

					element.style.width = categoryWidth + 'px';
				});
			}

			cats.forEach(element => {
				element.addEventListener("click", function (e) {
					e.preventDefault();
					let self = this;

					section.querySelectorAll('.data-cats a.active').forEach(element_2 => {
						if (element_2 != this) {
							element_2.classList.remove('active');
						}
					});

					if (self.classList.contains('active')) {
						self.classList.remove('active');
					} else {
						self.classList.add('active');
					}

					videos_listing_load_posts();
				});
			});
		}


		// videos_listing_load_posts
		function videos_listing_load_posts(page_new) {
			let page = 1;
			let category = '';

			if (section.querySelector('.data-cats a.active')) {
				category = section.querySelector('.data-cats a.active').getAttribute('data-slug')
			}

			if (page_new) {
				page = parseInt(page_new) + 1;
			}

			let data_request = {
				action: 'videos_listing_load_posts',
				page: page,
				category: category,
			}

			if (section.querySelector('.data-list')) {
				section.querySelector('.data-list').classList.add('active')
			}

			load_more.querySelector('button').setAttribute('disabled', 'disabled')
			load_more.querySelector('button').classList.add('active')

			load_more.querySelector('button').textContent = 'Įkeliama'

			generate_url(data_request);

			let xhr = new XMLHttpRequest();
			xhr.open('POST', wcl_obj.ajax_url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.onload = function (data) {
				if (xhr.status >= 200 && xhr.status < 400) {
					var data = JSON.parse(xhr.responseText);

					load_more.querySelector('button').classList.remove('active')
					load_more.querySelector('button').removeAttribute('disabled')

					if (page_new) {
						section.querySelector('.data-list').insertAdjacentHTML('beforeend', data.posts);
						section.querySelector('.data-load-more').innerHTML = data.button;
					} else {
						section.querySelector('.data-list').innerHTML = data.posts;
						section.querySelector('.data-load-more').innerHTML = data.button;
					}

					if (section.querySelector('.data-list').classList.contains('active')) {
						section.querySelector('.data-list').classList.remove('active')
					}

					//check_overflow_text('.wcl-acf-block-12 .data-item-desc');
				};
			};

			data_request = new URLSearchParams(data_request).toString();
			xhr.send(data_request);
		}


		// generate_url
		function generate_url(data) {
			let slug_page = section.getAttribute('data-slug-page')
			let slug_category = section.getAttribute('data-slug-category')
			let url = wcl_obj.site_url;

			url += slug_page + '/';

			// category_slug
			if (data.category.length > 0 && data.category != 'all') {
				url = wcl_obj.site_url;

				url += slug_category + '/';
				url += data.category + '/';
			}

			// page
			if (data.page && data.page != 1) {
				url += 'page/' + data.page + '/';
			}

			window.history.pushState(wcl_obj.site_url, document.title, url);
		}
	}



	// wcl-login-popup
	if (document.querySelector('.wcl-login-popup')) {
		let section = document.querySelector('.wcl-login-popup')

		section.querySelectorAll('.cmp3-toggle-password').forEach(toggleBtn => {
			toggleBtn.addEventListener('click', () => {
				const input = toggleBtn.parentElement.querySelector('input');

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
		if (section.querySelector('.cmp3-form')) {
			section.querySelector('.cmp3-form').addEventListener("submit", function (e) {
				e.preventDefault()

				let email = section.querySelector('[name="email"]').value
				let password = section.querySelector('[name="password"]').value

				let data_request = {
					action: 'login_user',
					email: email,
					password: password,
				};

				if (section.querySelector('.cmp3-form .cmp3-note')) {
					section.querySelector('.cmp3-form .cmp3-note').remove()
				}

				section.querySelectorAll('.cmp3-form .cmp3-field-note').forEach(element => {
					element.remove()
				});

				section.querySelectorAll('input.mod-error').forEach(element => {
					element.classList.remove('mod-error')
				});

				section.querySelector('button[type="submit"]').setAttribute('disabled', 'disabled')

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
									let tag = '<div class="cmp3-field-note mod-error">' + errorMessage + '</div>';
									field.insertAdjacentHTML('afterend', tag);
									field.classList.add('mod-error')
								}
							});
						}

						if (data.note_form && data.status == 'error') {
							let tag = '<div class="cmp3-note mod-error">' + data.message + '</div>';
							section.querySelector('.cmp3-form').insertAdjacentHTML('beforeend', tag);
						}

						if (data.note_form && data.status == 'success') {
							let tag = '<div class="cmp3-note mod-success">' + data.message + '</div>';
							section.querySelector('.cmp3-form').insertAdjacentHTML('beforeend', tag);

							setTimeout(() => {
								window.location.href = wcl_obj.site_url + 'my-account/';
							}, 1000);
						}

						section.querySelector('button[type="submit"]').removeAttribute('disabled')
					};
				};

				data_request = new URLSearchParams(data_request).toString();
				xhr.send(data_request);
			});
		}
	}



	// wcl-lost-password
	if (document.querySelector('.wcl-lost-password ')) {
		let section = document.querySelector('.wcl-lost-password')


		section.querySelectorAll('.cmp3-toggle-password').forEach(toggleBtn => {
			toggleBtn.addEventListener('click', () => {
				const input = toggleBtn.parentElement.querySelector('input');

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
	}



	// wcl-registration-popup
	if (document.querySelector('.wcl-registration-popup ')) {
		let section = document.querySelector('.wcl-registration-popup')

		section.querySelectorAll('.cmp3-toggle-password').forEach(toggleBtn => {
			toggleBtn.addEventListener('click', () => {
				const input = toggleBtn.parentElement.querySelector('input');

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
		if (section.querySelector('.cmp3-form')) {
			section.querySelector('.cmp3-form').addEventListener("submit", function (e) {
				e.preventDefault()

				let first_name = section.querySelector('[name="first_name"]').value
				let last_name = section.querySelector('[name="last_name"]').value
				let email = section.querySelector('[name="email"]').value
				let password = section.querySelector('[name="password"]').value
				let confirm_password = section.querySelector('[name="confirm_password"]').value

				let data_request = {
					action: 'registration_user',
					first_name: first_name,
					last_name: last_name,
					email: email,
					password: password,
					confirm_password: confirm_password,
				};

				if (section.querySelector('.cmp3-form .cmp3-note')) {
					section.querySelector('.cmp3-form .cmp3-note').remove()
				}

				section.querySelectorAll('.cmp3-form .cmp3-field-note').forEach(element => {
					element.remove()
				});

				section.querySelectorAll('input.mod-error').forEach(element => {
					element.classList.remove('mod-error')
				});

				section.querySelector('button[type="submit"]').setAttribute('disabled', 'disabled')

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
									let tag = '<div class="cmp3-field-note mod-error">' + errorMessage + '</div>';
									field.insertAdjacentHTML('afterend', tag);
									field.classList.add('mod-error')
								}
							});
						}

						if (data.errors_form) {
							let tag = '<div class="cmp3-note mod-error">' + data.errors_form + '</div>';
							section.querySelector('.cmp3-form').insertAdjacentHTML('beforeend', tag);
						}

						if (data.message && data.success) {
							let tag = '<div class="cmp3-note mod-success">' + data.message + '</div>';
							section.querySelector('.cmp3-form').insertAdjacentHTML('beforeend', tag);

							setTimeout(() => {
								window.location.href = wcl_obj.site_url + 'my-account/';
								window.location.href = wcl_obj.site_url;
							}, 1000);
						}

						section.querySelector('button[type="submit"]').removeAttribute('disabled')
					};
				};

				data_request = new URLSearchParams(data_request).toString();
				xhr.send(data_request);
			});
		}
	}

	// js-popup-2-open

	if (document.querySelector('.js-popup-2-open')) {
		if (document.querySelector('.cmp-4-popup')) {
			let items = document.querySelectorAll('.js-popup-2-open')

			items.forEach(element => {
				element.addEventListener('click', function (e) {
					e.preventDefault()

					if (document.querySelector('.cmp-4-popup.active')) {
						document.querySelector('.cmp-4-popup.active').classList.remove('active')

						document.querySelectorAll('.cmp-4-popup').forEach(element => {
							element.classList.add('mod-transit')
						});

						setTimeout(() => {
							document.querySelectorAll('.cmp-4-popup.mod-transit').forEach(element => {
								element.classList.remove('mod-transit')
							});
						}, 1);
					}

					let target_popup_id = this.getAttribute('data-target');

					if (element.classList.contains('mod-registration-popup')) {
						target_popup_id = 'registration-popup'
					}


					if (element.classList.contains('mod-login-popup')) {
						target_popup_id = 'login-popup'
					}

					target_popup = document.querySelector('[data-id="' + target_popup_id + '"]');

					if (target_popup) {
						if (document.querySelector('.wcl-header').querySelector('.data-nav').classList.contains('active')) {
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


	// cmp-4-popup
	if (document.querySelector('.cmp-4-popup')) {
		let items = document.querySelectorAll('.cmp-4-popup')

		items.forEach(element => {
			element.querySelectorAll('.js-close').forEach(close => {
				close.addEventListener('click', function (e) {
					element.classList.remove('active')
					document.querySelector('body').classList.remove('overflow-hidden');
					document.querySelector('html').classList.remove('overflow-hidden');
				})
			});

			element.querySelector('.cmp4-overlay').addEventListener('click', function (e) {
				element.classList.remove('active')
				document.querySelector('body').classList.remove('overflow-hidden');
				document.querySelector('html').classList.remove('overflow-hidden');
			})

			element.querySelector('.cmp4-inner-out').addEventListener('click', function (e) {
				if (!e.target.closest('.cmp4-inner')) {
					element.classList.remove('active')
					document.querySelector('body').classList.remove('overflow-hidden');
					document.querySelector('html').classList.remove('overflow-hidden');
				}
			})
		});
	}


	// wcl-popup

	if (document.querySelector('.wcl-popup')) {
		let section = document.querySelector('.wcl-popup')

		if (document.querySelector('.js-popup-open')) {
			document.querySelectorAll('.js-popup-open').forEach(element => {
				element.addEventListener('click', function (e) {
					e.preventDefault()

					section.classList.add('active')
					document.querySelector('body, html').classList.add('overflow-hidden')

					if (document.querySelector('.wcl-header .data-nav.active')) {
						document.querySelector('.wcl-header .data-nav.active').classList.remove('active')
					}
				});
			});
		}

		section.querySelector('.data-close').addEventListener('click', function (e) {
			section.classList.remove('active')
			document.querySelector('body, html').classList.remove('overflow-hidden')
		})

		section.querySelector('.data-overlay').addEventListener('click', function (e) {
			section.classList.remove('active')
			document.querySelector('body, html').classList.remove('overflow-hidden')
		})

		section.querySelector('.data-inner-out').addEventListener('click', function (e) {
			if (!e.target.closest('.data-inner')) {
				section.classList.remove('active')
				document.querySelector('body, html').classList.remove('overflow-hidden')
			}
		})
	}



	// wcl-header

	if (document.querySelector('.wcl-header')) {
		let section = document.querySelector('.wcl-header')

		var anchorLinks = section.querySelectorAll('.data-menu li.anchor a');

		anchorLinks.forEach(function (anchorLink) {
			anchorLink.addEventListener('click', function (e) {
				e.preventDefault();
				if (!this.closest('.js-popup-2-open')) {
					const urlObject = new URL(this.getAttribute('href'));
					const fragmentIdentifier = urlObject.hash.substring(1); // Remove the leading '#'

					let targetId = this.getAttribute('href').substr(2);
					let targetSection = document.getElementById(fragmentIdentifier);

					if (!document.body.classList.contains('home')) {
						window.location.href = wcl_obj.site_url
					} else {
						if (targetSection) {
							let offset = -46;

							let targetPosition = targetSection.offsetTop + offset;

							window.scrollTo({
								top: targetPosition,
								behavior: 'smooth'
							});
						}
					}
				}
			});
		});
	}




	// wcl-acf-block-3

	if (document.querySelector('.wcl-acf-block-3')) {
		let section = document.querySelector('.wcl-acf-block-3')

		var grid = document.querySelector('.data-grid');
		var msnry;

		// init Isotope after all images have loaded
		msnry = new Masonry(grid, {
			itemSelector: '.data-grid-item',
			columnWidth: '.data-grid-item',
			percentPosition: true
		});

		// Recalculate layout on window resize
		window.addEventListener('resize', function () {
			msnry.layout();
		});
	}


	// wcl-bar-two

	if (document.querySelector('.wcl-bar-two')) {
		let section = document.querySelector('.wcl-bar-two')
		if (document.querySelector('.wcl-acf-block-1')) {
			window.addEventListener('scroll', function () {
				let scrollPosition = window.scrollY;
				let firstSectionHeight = document.querySelector('.wcl-acf-block-1').offsetHeight;

				if (scrollPosition >= firstSectionHeight + 100) {
					section.classList.add('active');
				} else {
					section.classList.remove('active');
				}
			});
		}

	}





	// wcl-acf-block-2

	if (document.querySelector('.wcl-acf-block-2')) {
		let sections = document.querySelectorAll('.wcl-acf-block-2')

		sections.forEach(section => {

			// video play
			if (section.querySelector('.data-video')) {
				let video = section.querySelector('.data-video video')

				section.querySelector('.data-video').addEventListener('click', function (e) {
					if (video && !video.paused) {
						video.pause();
						section.querySelector('.data-video').classList.add("mod-pause");
					} else {
						video.play();
						section.querySelector('.data-video').classList.remove("mod-pause");
					}
				})
			}
		});
	}







	// wcl-header

	if (document.querySelector('.wcl-header')) {
		let section = document.querySelector('.wcl-header')


		// btn-menu

		section.querySelectorAll('.data-btn-menu').forEach(element => {
			element.addEventListener('click', function (e) {
				if (section.querySelector('.data-nav').classList.contains('active')) {
					section.querySelector('.data-nav').classList.remove('active')
					document.querySelector('body, html').classList.remove('overflow-hidden')
				} else {
					section.querySelector('.data-nav').classList.add('active')
					document.querySelector('body, html').classList.add('overflow-hidden')
				}
			})
		});




		if (section.querySelector('.menu-item-has-children')) {
			section.querySelectorAll('.menu-item-has-children').forEach(element => {
				element.addEventListener('mouseover', function (e) {
					if (!this.classList.contains('active')) {
						this.classList.add('active')
					}
				})

				element.addEventListener('mouseleave', function (e) {
					if (this.classList.contains('active')) {
						this.classList.remove('active')
					}
				})
			});

			section.querySelectorAll('.data-menu a').forEach(element => {
				element.addEventListener('click', function (e) {
					if (e.target.getAttribute("href") == '#') {
						e.preventDefault()
					}
				})
			});



			// mod-mega-menu

			section.querySelectorAll('.data-menu li.mod-mega-menu').forEach(element => {
				element.addEventListener('mouseover', function (e) {
					section.querySelectorAll('.data-menu li.mod-mega-menu.active').forEach(element_2 => {
						element_2.classList.remove('active')
					});

					element.classList.add('active')
				})

				element.addEventListener('mouseleave', function (e) {
					if (section.querySelector('.data-menu li.mod-mega-menu.active')) {
						section.querySelector('.data-menu li.mod-mega-menu.active').classList.remove('active')
					}
				})
			});
		}
	}




	// wcl-acf-block-10

	if (document.querySelector('.wcl-acf-block-10')) {
		let sections = document.querySelectorAll('.wcl-acf-block-10')

		sections.forEach(section => {
			section.querySelectorAll('.data-item-question').forEach(question => {
				question.addEventListener('click', function (e) {
					let item = this.parentElement
					let maxHeight = 0;

					let height = item.querySelector('.data-item-answer-text').offsetHeight;
					maxHeight = height

					if (this.parentElement.classList.contains('active')) {
						this.parentElement.classList.remove('active')
						item.querySelector('.data-item-answer').style.maxHeight = null;
					} else {
						this.parentElement.classList.add('active')
						item.querySelector('.data-item-answer').style.maxHeight = maxHeight + "px";
					}
				})
			});
		});
	}


});