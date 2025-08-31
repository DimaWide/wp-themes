


import { sidebar_scroll, getOffsetTop } from './helpers.js';

export function init_acf_12_blog() {
  // acf-12-blog
  if (document.querySelector('.acf-12-blog')) {
    let section = document.querySelector('.acf-12-blog')
    let load_more = section.querySelector('.data-load-more')
    let sidebar = section.querySelector('.cmp-6-sidebar')

    if (window.matchMedia("(min-width: 1199px)").matches) {
        sidebar_scroll(sidebar, section, scroll, '', section.querySelector('.data-list-out'));
    }

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
                blog_page_load_posts(page);
            }
        });
    }


    // blog_page_load_posts
    function blog_page_load_posts(page_new) {
        let page = 1;
        let category = '';

        if (page_new) {
            page = parseInt(page_new) + 1;
        }

        category = section.getAttribute('data-cat')

        let data_request = {
            action: 'blog_page_load_posts',
            page: page,
            category: category,
        }

        if (section.querySelector('.data-list')) {
            section.querySelector('.data-list').classList.add('active')
        }

        load_more.querySelector('button').setAttribute('disabled', 'disabled')
        load_more.querySelector('button').classList.add('active')

        load_more.querySelector('button').textContent = 'Loading'

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

                let offset_top = getOffsetTop(section.querySelector('.data-col:nth-child(2)'));

                if (window.matchMedia("(min-width: 1199px)").matches) {
                    sidebar_scroll(sidebar, section, scroll, offset_top, section.querySelector('.data-list-out'));
                }
            };
        };

        data_request = new URLSearchParams(data_request).toString();
        xhr.send(data_request);
    }
}

}


