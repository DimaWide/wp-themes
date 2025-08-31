


export function init_single_product() {

    let offset_top = 0;

    if (document.querySelector('body.single-product')) {
        // sct-single-product-info
        if (document.querySelector('.sct-single-product-info')) {
            const thumbSliderEl = document.querySelector('.thumb-slider'); // Единственный thumb-slider

            const thumbSlider = new Swiper(thumbSliderEl, {
                loop: false,
                slidesPerView: 5,
                spaceBetween: 15,
            });

            document.querySelectorAll('.sct-single-product-info .main-slider').forEach(mainSliderEl => {
                const mainSlider = new Swiper(mainSliderEl, {
                    loop: false,
                    navigation: {
                        nextEl: mainSliderEl.querySelector('.mod-next'),
                        prevEl: mainSliderEl.querySelector('.mod-prev'),
                    },
                });

                if (mainSliderEl.classList.contains('mod-one')) {
                    // Только mod-one управляет thumb-slider
                    mainSlider.on('slideChange', function () {
                        thumbSlider.slideTo(mainSlider.activeIndex);
                    });

                    // Клик по thumb-slider двигает только main-slider.mod-one
                    thumbSliderEl.querySelectorAll('.swiper-slide').forEach((thumb, index) => {
                        thumb.addEventListener('click', function () {
                            mainSlider.slideTo(index);
                        });
                    });

                    // Функция смены изображения по variation_id
                    function showVariationImage(variation_id) {
                        if (window.matchMedia("(min-width: 1199px)").matches) {
                            const targetSlide = mainSliderEl.querySelector(`.swiper-slide[data-variation-id="${variation_id}"]`);
                            if (targetSlide) {
                                const index = Array.from(targetSlide.parentElement.children).indexOf(targetSlide);
                                mainSlider.slideTo(index);
                            }
                        } else{
                            const targetSlide = document.querySelector(`.main-slider.mod-two .swiper-slide[data-variation-id="${variation_id}"]`);
                            if (targetSlide) {
                                const index = Array.from(targetSlide.parentElement.children).indexOf(targetSlide);
                                document.querySelector(`.main-slider.mod-two`).swiper.slideTo(index);
                            }
                        }
                    }

                    jQuery('form.variations_form').on('found_variation', function (event, variation) {
                        if (variation && variation.variation_id) {
                            showVariationImage(variation.variation_id);
                        }
                    });

                    jQuery('form.variations_form').on('reset_data', function () {
                        showVariationImage(0);
                    });
                }
            });
        }

    }


    if (document.querySelector('body.single-product')) {
        document.addEventListener('DOMContentLoaded', function () {
            var customResetButton = document.getElementById('custom-reset-button');

            if (customResetButton) {
                customResetButton.addEventListener('click', function () {
                    var resetButton = document.querySelector('.reset_variations');

                    if (resetButton) {
                        resetButton.click();
                    }
                });
            }
        });

        jQuery(document).ready(function ($) {
            var quantityValue = $('#quantity-value');
            var woocommerceQuantityInput = $('.woocommerce .quantity .qty');
            var addToCartButton = $('.single_add_to_cart_button');
            var currentQuantity = parseInt(quantityValue.text(), 10);

            $('.minus-btn').click(function () {
                if (currentQuantity > 1) {
                    currentQuantity--;
                    quantityValue.text(currentQuantity);
                    woocommerceQuantityInput.val(currentQuantity);
                }
            });

            $('.plus-btn').click(function () {
                currentQuantity++;
                quantityValue.text(currentQuantity);
                woocommerceQuantityInput.val(currentQuantity);
            });

            $('.data-add-to-cart .cmp-button.mod-red').click(function (e) {
                e.preventDefault();
                addToCartButton.trigger('click');
            });
        });
    }



    if (document.querySelector('body.single-product')) {

        jQuery(document).ready(function ($) {
            $('.data-variation-item').on('click', function () {
                if ($(this).hasClass('unavailable')) {
                    return;
                }
                document.querySelector('.variations_form').classList.add('active')

                const variationId = $(this).data('variation-id');
                const variationName = $(this).data('variation-name');

                $('input.variation_id').val(variationId).trigger('change');

                const select = $('#finish');

                const options = select.find('option');
                options.each(function () {
                    if ($(this).text() === variationName) {
                        select.val($(this).val()).trigger('change');
                    }
                });

                $('.data-variation-item').removeClass('selected');

                $(this).addClass('selected');

                setTimeout(() => {
                    offset_top = getOffsetTop(document.querySelector('.single-product .woocommerce-tabs .data-col:first-child'));
                }, 250);
            });
        });
    }


    // getOffsetTop
    function getOffsetTop(element) {
        let offsetTop = 0;
        while (element) {
            offsetTop += element.offsetTop;
            element = element.offsetParent;
        }
        return offsetTop;
    }


    // wcl-acf-block-12
    function sidebar_scroll(sidebar, section, scroll = false, sidebar_offset = '', content_item = '') {
        offset_top = getOffsetTop(sidebar);

        if (sidebar_offset) {
            offset_top = sidebar_offset
        }

        console.log(offset_top)

        let sidebar_top = offset_top

        let content = '';

        if (content_item == '') {
            content = section.querySelector('.data-tabs')
        } else {
            content = content_item
        }

        let sidebar_bot = offset_top + content.clientHeight
        sidebar_bot = sidebar_bot - sidebar.clientHeight
        let sidebar_bot_2 = content.clientHeight - sidebar.clientHeight

        if (sidebar_bot_2 < 0) {
            sidebar_bot_2 = 0
        }

        let scrolled = window.scrollY

        console.log(scrolled)

        if (scrolled >= sidebar_top - 15 && scrolled <= sidebar_bot - 15) {
            sidebar.classList.add('active')
            sidebar.classList.remove('active-2')
            sidebar.style.top = '15px'
        } else {
            if (scrolled >= sidebar_top - 15) {
                sidebar.classList.remove('active')
                sidebar.classList.add('active-2')
                sidebar.style.top = sidebar_bot_2 + 'px'
            } else {
                sidebar.classList.remove('active')
                sidebar.style.top = '0'
            }
        }

        if (scroll) {

            window.addEventListener('scroll', function (e) {
                //   offset_top = getoffset_top(sidebar);

                sidebar_top = offset_top
                sidebar_bot = offset_top + content.clientHeight
                sidebar_bot = sidebar_bot - sidebar.clientHeight
                sidebar_bot_2 = content.clientHeight - sidebar.clientHeight

                if (sidebar_bot_2 < 0) {
                    sidebar_bot_2 = 0
                }

                let scrolled = window.scrollY

                if (scrolled >= sidebar_top - 15 && scrolled <= sidebar_bot - 15) {
                    sidebar.classList.add('active')
                    sidebar.classList.remove('active-2')
                    sidebar.style.top = '15px'
                } else {
                    if (scrolled >= sidebar_top - 15) {
                        sidebar.classList.remove('active')
                        sidebar.classList.add('active-2')
                        sidebar.style.top = sidebar_bot_2 + 'px'
                    } else {
                        sidebar.classList.remove('active')
                        sidebar.style.top = '0'
                    }
                }
            });
        }
    }


    // Fixed on Scroll
    if (document.querySelector('.single-product .woocommerce-tabs .data-sidebar')) {
        let sidebar = document.querySelector('.single-product .woocommerce-tabs .data-sidebar')
        let section = document.querySelector('.single-product div.product .woocommerce-tabs')

        if (window.matchMedia("(min-width: 1200px)").matches) {
            sidebar_scroll(sidebar, section, true, '', section.querySelector('.data-col:nth-child(2)'));
        }

        document.querySelectorAll('.single-product div.product .woocommerce-tabs ul.tabs li').forEach(element => {
            element.addEventListener('click', function (e) {
                setTimeout(() => {
                    let offset_top = getOffsetTop(section.querySelector('.data-col:nth-child(1)'));

                    if (window.matchMedia("(min-width: 1200px)").matches) {
                        sidebar_scroll(sidebar, section, false, offset_top, section.querySelector('.data-col:nth-child(2)'));
                    }
                }, 1);
            })
        });
    }
}


