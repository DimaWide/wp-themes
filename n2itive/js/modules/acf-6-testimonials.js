

export function init_acf_6_testimonials() {
    // acf-6-testimonials
    if (document.querySelector('.acf-6-testimonials')) {
        let sections = document.querySelectorAll('.acf-6-testimonials')

        sections.forEach(section => {
            let swiper = new Swiper(section.querySelector('.data-slider'), {
                slidesPerView: 2,
                loop: true,
               
                autoplay: {
                    delay: 3000, 
                    disableOnInteraction: false, 
                },
                speed: 400,
                spaceBetween: 98,
                speed: 600,
                autoHeight: true,
                navigation: {
                    nextEl: section.querySelector('.mod-next'),
                    prevEl: section.querySelector('.mod-prev'),
                },
                pagination: {
                    el: section.querySelector('.swiper-pagination'),
                    clickable: true,
                },
                breakpoints: {
                    0: {
                        slidesPerView: 1,
                        spaceBetween: 30,
                    },
                    767: {
                        spaceBetween: 60,
                        slidesPerView: 1,
                    },
                    1200: {
                        slidesPerView: 2,
                        spaceBetween: 98
                    },
                    1600: {
                        spaceBetween: 98
                    },
                }
            });
        });
    }
}


