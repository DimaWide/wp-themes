

export function init_acf_3_blog() {
    // acf-3-blog
    if (document.querySelector('.acf-3-blog')) {
        let sections = document.querySelectorAll('.acf-3-blog');

        sections.forEach(section => {
            let swiper = new Swiper(section.querySelector('.data-slider'), {
                slidesPerView: 'auto',
                speed: 400,
                spaceBetween: 30,
                breakpoints: {
                    0: {
                        spaceBetween: 20,
                    },
                    767: {
                        spaceBetween: 30,
                    },
                }
            });

            swiper.on('slideChange', function () {
                swiper.el.closest('.data-slider-out').classList.remove('last-slide');
            });

            swiper.on('reachEnd', function () {
                setTimeout(() => {
                    swiper.el.closest('.data-slider-out').classList.add('last-slide');
                }, 1);
            });
        });
    }
}
