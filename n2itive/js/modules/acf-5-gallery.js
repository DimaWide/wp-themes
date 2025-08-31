

export function init_acf_5_gallery() {
    // acf-5-gallery
    if (document.querySelector('.acf-5-gallery')) {
        let sections = document.querySelectorAll('.acf-5-gallery');

        Fancybox.bind("[data-fancybox='gallery']", {
            infinite: false,
            Toolbar: {
                display: ["zoom", "download", "close"],
            },
        });

        sections.forEach(section => {
            let swiper = new Swiper(section.querySelector('.data-slider'), {
                slidesPerView: 'auto',
                loop: true,
                speed: 400,
                spaceBetween: 30,
                centeredSlides: true,
                initialSlide: 1,
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
                        spaceBetween: 20,
                    },
                    767: {
                        spaceBetween: 30,
                    },
                }
            });
        });
    }

}


