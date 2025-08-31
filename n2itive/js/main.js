
import { check_state_configurator, setCookie, getCookie } from './modules/helpers.js';
import { init_acf_1_configurator } from './modules/acf-1-configurator';
import { init_acf_3_blog } from './modules/acf-3-blog.js';
import { init_acf_4_faq } from './modules/acf-4-faq.js';
import { init_acf_5_gallery } from './modules/acf-5-gallery.js';
import { init_acf_6_testimonials } from './modules/acf-6-testimonials';
import { init_popup } from './modules/popup';
import { init_single_product } from './modules/single-product.js';
import { init_woocommerce_cart } from './modules/woocommerce-cart.js';
import { init_woocommerce } from './modules/woocommerce.js';
import { init_acf_10_faq } from './modules/acf-10-faq.js';
import { init_acf_11_instalation } from './modules/acf-11-instalation.js';
import { init_acf_12_blog } from './modules/acf-12-blog.js';
import { sidebar_scroll } from './modules/helpers.js';

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

    window.teslaModels = JSON.parse(document.querySelector('.tesla-models').getAttribute('data-tesla-models'));

    window.state_configurator = false;

    window.state_1 = true;
    window.state_2 = false;
    window.state_3 = false;

    window.mainSlider;
    window.thumbnailSlider;

    check_state_configurator()
    init_acf_1_configurator()
    init_acf_4_faq()
    init_acf_5_gallery()
    init_acf_6_testimonials()
    init_acf_3_blog()
    init_popup()
    init_single_product()
    init_woocommerce_cart()
    init_woocommerce()
    init_acf_10_faq()
    init_acf_11_instalation()
    init_acf_12_blog()





    // Fixed on Scroll
    if (document.querySelector('.single-post .data-sidebar')) {
        let section = document.querySelector('.single-post .sct-single')
        let sidebar = document.querySelector('.single-post .data-sidebar')

        if (window.matchMedia("(min-width: 1199px)").matches) {
            sidebar_scroll(sidebar, section, true, '', section.querySelector('.data-content'));
        }
    }





    // single-product div.product .woocommerce-tabsacf-10-faq
    if (document.querySelector('.single-product div.product .woocommerce-tabs')) {
        const section = document.querySelector('.single-product div.product .woocommerce-tabs');
        const tabs = document.querySelector(".woocommerce div.product .woocommerce-tabs ul.tabs");

        if (!tabs) return;

        function updateClasses() {
            const isAtStart = tabs.scrollLeft === 0;
            const isAtEnd = tabs.scrollLeft + tabs.clientWidth >= tabs.scrollWidth - 1;

            tabs.parentElement.classList.toggle("mod-left", isAtStart);
            tabs.parentElement.classList.toggle("mod-right", isAtEnd);
        }

        updateClasses();
        tabs.addEventListener("scroll", updateClasses);
    }





    // acf-11-instalation-2
    if (document.querySelector('.acf-11-instalation-2')) {
        const section = document.querySelector('.acf-11-instalation-2');
        const tabs = section.querySelector(".data-cats");

        if (!tabs) return;

        function updateClasses() {
            const isAtStart = tabs.scrollLeft === 0;
            const isAtEnd = tabs.scrollLeft + tabs.clientWidth >= tabs.scrollWidth - 1;

            tabs.parentElement.classList.toggle("mod-left", isAtStart);
            tabs.parentElement.classList.toggle("mod-right", isAtEnd);
        }

        updateClasses();
        tabs.addEventListener("scroll", updateClasses);
    }




    // acf-10-faq
    if (document.querySelector('.acf-10-faq')) {
        const section = document.querySelector('.acf-10-faq');
        const tabs = section.querySelector(".data-cats");

        if (!tabs) return;

        function updateClasses() {
            const isAtStart = tabs.scrollLeft === 0;
            const isAtEnd = tabs.scrollLeft + tabs.clientWidth >= tabs.scrollWidth - 1;

            tabs.parentElement.classList.toggle("mod-left", isAtStart);
            tabs.parentElement.classList.toggle("mod-right", isAtEnd);
        }

        updateClasses();
        tabs.addEventListener("scroll", updateClasses);
    }





    // Fixed on Scroll
    if (document.querySelector('.data-btn-menu')) {

        document.querySelectorAll('.data-btn-menu').forEach(element => {
            element.addEventListener('click', function (e) {
                if (document.querySelector('.sct-header').classList.contains('active')) {
                    //   this.classList.remove('active')
                    document.querySelector('.sct-header').classList.remove('active')
                    document.querySelector('body, html').classList.remove('overflow-hidden')
                } else {
                    //   this.classList.add('active')
                    document.querySelector('.sct-header').classList.add('active')
                    document.querySelector('body, html').classList.add('overflow-hidden')
                }
            })
        });
    }

});



jQuery(document.body).on('added_to_cart', function (event, fragments, cart_hash, button) {
    var cartCount = fragments['div.widget_shopping_cart_content'].split('<span class=\"quantity\">');
    var TotalCount = 0;

    for (let index = 1; index < cartCount.length; index++) {
        var item = cartCount[index];
        var ItemCount = item.split(' &times;')[0];
        TotalCount += parseInt(ItemCount);
    }

    var $cart = jQuery('.sct-header .data-cart');
    var $cartCount = $cart.find('.data-cart-count');

    if ($cartCount.length === 0) {
        jQuery('<span class="data-cart-count">' + TotalCount + '</span>')
            .appendTo($cart.find('.data-cart-inner'));
    } else {
        $cartCount.text(TotalCount);
    }
});


jQuery(document.body).on('added_to_cart', function (event, fragments, cart_hash, button) {
    jQuery.ajax({
        url: wcl_obj.ajax_url,
        type: 'POST',
        data: {
            action: 'update_cart_popup',
            cart_hash: cart_hash,
        },
        success: function (response) {
            if (response.success) {
                jQuery('.cmp-2-cart.custom-popup').html(response.data.cart_html);
                var totalCount = response.data.cart_count;
                jQuery('.sct-header .data-cart-count').text(totalCount);
            }
        },
        error: function () {
            console.log('Error updating the cart');
        }
    });
});


jQuery(document).ready(function ($) {
    $(document.body).on('updated_cart_totals', function () {
        var totalQuantity = 0;

        $('.woocommerce .quantity .qty').each(function () {
            totalQuantity += parseInt($(this).val(), 10);
        });

        if (totalQuantity > 0) {
            $('.sct-cart .js-b1-title').text('You Have ' + totalQuantity + ' Items In Your Cart');
        } else {
            $('.sct-cart .js-b1-title').text('Your Cart is Empty');
        }

        const cartItemCountElement = $('.sct-header .data-cart-count');
        if (cartItemCountElement.length > 0) {
            if (totalQuantity > 0) {
                cartItemCountElement.text(totalQuantity);
            } else {
                cartItemCountElement.remove();
            }
        }
    });
});



jQuery(document).ready(function ($) {
    function checkEmptyCart() {
        var cartItems = $('.woocommerce-cart-form__cart-item.cart_item');

        if (cartItems.length === 0) {
            var cartIcon = $('.sct-header .data-cart-count');
            if (cartIcon.length > 0) {
                cartIcon.remove();
            }
        }
    }

    $(document.body).on('updated_cart_totals removed_from_cart', function () {
        checkEmptyCart();

        var checkInterval = setInterval(function () {
            checkEmptyCart();
        }, 100);
    });


    // Отлавливаем завершение обновления корзины
    $(document.body).on('updated_wc_div', function () {
        jQuery.ajax({
            url: wcl_obj.ajax_url,
            type: 'POST',
            data: {
                action: 'update_cart_popup',
            },
            success: function (response) {
                if (response.success) {
                    jQuery('.cmp-2-cart.custom-popup').html(response.data.cart_html);
                    var totalCount = response.data.cart_count;
                    jQuery('.sct-header .data-cart-count').text(totalCount);
                }
            },
            error: function () {
                console.log('Error updating the cart');
            }
        });
    });
});


jQuery(document.body).on('checkout_error', function () {
    jQuery('html, body').stop();
});

jQuery(document).ajaxComplete(function () {
    if (jQuery('body').hasClass('woocommerce-cart')) {
        jQuery('html, body').stop();
    }
});


jQuery(document).on('click', '.woocommerce .remove', function (e) {
    e.preventDefault();
    var parentItem = jQuery(e.target).closest('.woocommerce-cart-form__cart-item ');
    console.log(parentItem)
    parentItem.find('a.remove')[0].click();
});


jQuery(document).ready(function ($) {
    // Проверяем, есть ли элементы в списке отзывов
    if ($('.commentlist .review').length === 0) {
        // Если нет отзывов, убираем margin у контейнера с отзывами
        $('#reviews').css('margin', '0');
    }
});



document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('.generate-pdf')) {
        document.querySelectorAll('.generate-pdf').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                // Установка шрифта и стиля
                doc.setFont('helvetica', 'bold').setFontSize(24);

                // Извлечение текста
                const titleText = document.querySelector('.acf-11-instalation .data-b2-title')?.textContent.trim() || '';

                // Опции страницы
                const pageWidth = doc.internal.pageSize.width;
                const margin = 20;

                // Вывод текста в центр страницы
                doc.text(titleText, pageWidth / 2, 20, {
                    align: 'center',
                    maxWidth: pageWidth - 2 * margin,
                });

                let startY = 30;
                const table = document.querySelector('.data-b2-table');

                doc.autoTable({
                    html: table,
                    startY: startY,
                    styles: {
                        fontSize: 14,
                        cellPadding: 6,
                        lineHeight: 1.55,
                        textColor: [255, 255, 255],
                        fillColor: [0, 0, 0],
                    },
                    headStyles: {
                        fillColor: [233, 168, 38],
                        textColor: [0, 0, 0],
                        fontStyle: 'bold',
                        fontSize: 18,
                        lineWidth: 0.15,
                        lineColor: [255, 255, 255],
                    },
                    bodyStyles: {
                        fillColor: [0, 0, 0],
                        textColor: [255, 255, 255],
                        fontSize: 14,
                    },
                    alternateRowStyles: {
                        fillColor: [40, 40, 40],
                    },
                    columnStyles: {
                        0: { cellWidth: 'auto' },
                        1: { cellWidth: 'auto' },
                    },
                    didDrawCell: function (data) {
                        if (data.row.index === data.table.body.length - 1) {
                            doc.setLineWidth(0);
                        }
                    },
                });

                doc.save('table_specs.pdf');
            });
        });
    }
});





jQuery(document).ready(function ($) {
    const submitButton = $('.woocommerce #review_form #respond .form-submit input');
    const fileInput = $('#cr_review_image');
    let uploadCheckInterval;

    function checkUploadStatus() {
        const allImages = $('.cr-upload-images-containers ');
        const uploadedImages = allImages.filter('.cr-upload-ok');

        // console.log(uploadedImages)

        if (allImages.length > 0 && allImages.length === uploadedImages.length) {
            submitButton.prop('disabled', false);
        } else {
            submitButton.prop('disabled', true);
        }

        if (document.querySelector('.cr-upload-images-status-error')) {
            submitButton.prop('disabled', false);
        }
    }

    fileInput.on('change', function () {
        uploadCheckInterval = setInterval(checkUploadStatus, 1000);
        submitButton.prop('disabled', true);
    });

    $('#review_form').on('submit', function (e) {
        const allImages = $('.cr-upload-images-containers .cr-upload-images-container');
        const uploadedImages = allImages.filter('.cr-upload-ok');

        if (allImages.length > 0 && allImages.length !== uploadedImages.length) {
            e.preventDefault();
            alert('Please wait until all images have finished loading before submitting the form..');
        }
    });
});


