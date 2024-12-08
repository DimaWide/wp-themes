

import { setCookie } from './common';

// wcl_comments

function wcl_comments() {
	if (document.querySelector('.wcl-comments')) {
		let section = document.querySelector('.wcl-comments');

		if (document.querySelector('.wcl-single-end .data-b2-btn')) {
			document.querySelector('.wcl-single-end .data-b2-btn').addEventListener('click', function (e) {
				if (section.classList.contains('active')) {
					this.classList.remove('active')
					section.classList.remove('active')
					setCookie('cooment_state', true, -1)
				} else {
					this.classList.add('active')
					section.classList.add('active')
					setCookie('cooment_state', true)
				}
			})
		}

		section.addEventListener('click', function (e) {
			if (section.classList.contains('active-comments')) {
				if (e.target.closest('#cancel-comment-reply-link')) {
					e.preventDefault()
					section.querySelector('.comment-reply-title-2').remove()
					section.querySelector('input[name="comment_parent"]').setAttribute('value', 0)
				}
			}
		})

		if (section.querySelector('.data-reply a')) {
			section.querySelectorAll('.data-reply a').forEach(element => {
				element.addEventListener('click', function (e) {
					e.preventDefault()

					let url = this.getAttribute('href')
					url = new URL(url);

					let id = url.searchParams.get("replytocom");

					let name = section.querySelector('.swiper-slide-active .data-item-author').textContent

					let currentURL = window.location.href;
					 currentURL = currentURL.split('?')[0];

					let tag_title = '<h3 class="comment-reply-title-2">' +
						'Leave a Reply to <a href="#comment-' + id + '">' + name.trim() + '</a> ' +
						'<small><a rel="nofollow" id="cancel-comment-reply-link" href="'+ currentURL + '"> ' +
						'Cancel reply</a></small></h3>';

					section.classList.add('active-comments')

					section.querySelector('input[name="comment_parent"]').setAttribute('value', id)

					if (section.querySelector('.comment-reply-title-2')) {
						section.querySelector('.comment-reply-title-2').remove()
					}
					section.querySelector('.comment-form').insertAdjacentHTML('beforebegin', tag_title);

					window.scrollTo({
						top: section.offsetTop - 140,
						behavior: 'smooth'
					});
				})
			});
		}


		let slider = section.querySelector('.data-list')
		let swiper = new Swiper(slider, {
			slidesPerView: 1,
			effect: 'fade',
			spaceBetween: 10,
			on: {
				init: function () {
					let current = section.querySelectorAll('.data-list-item')[this.activeIndex]
					let link = current.querySelector('.data-item-reply a')
					section.querySelector('.data-reply a').setAttribute('href', link.getAttribute('href'))
				},
			},
			navigation: {
				nextEl: section.querySelector('.data-list-nav-btn.mod-next'),
				prevEl: section.querySelector('.data-list-nav-btn.mod-prev'),
			},
		});

		swiper.on('slideChange', function (e) {
			let current = section.querySelectorAll('.data-list-item')[swiper.activeIndex]
			let link = current.querySelector('.data-item-reply a')
			section.querySelector('.data-reply a').setAttribute('href', link.getAttribute('href'))
		});

		section.querySelectorAll('.data-list-item').forEach(element => {
			let height = element.clientHeight
			let desc_height = element.children[0].clientHeight

			if (desc_height > height) {
				element.classList.add('mask')
			}

			element.addEventListener('mouseover', function (e) {
				let height = this.clientHeight
				let desc_height = this.children[0].clientHeight

				if (desc_height <= height) {
					if (this.classList.contains('mask')) {
						this.classList.remove('mask')
					}
				}
			})

			element.addEventListener('scroll', function (e) {
				let height = this.clientHeight
				let desc_height = this.children[0].clientHeight
				if (Math.ceil(height + this.scrollTop) >= desc_height) {
					this.classList.remove('mask')
				} else {
					this.classList.add('mask')
				}
			})
		});

	}

}

export default wcl_comments;
