

export function init_woocommerce() {

    let updateCartTimeout;

    document.body.addEventListener('click', function (event) {
        if (event.target && event.target.closest('.minus-btn')) {
            var quantityInput = event.target.closest('.data-quantity').querySelector('input');
            if (quantityInput) {
                var currentQuantity = parseInt(quantityInput.value, 10);

                if (currentQuantity > 1) {
                    currentQuantity--;
                    quantityInput.value = currentQuantity;
                    handleCartUpdate(quantityInput);
                }
            }
        }
    });

    document.body.addEventListener('click', function (event) {
        if (event.target && event.target.closest('.plus-btn')) {
            var quantityInput = event.target.closest('.data-quantity').querySelector('input');

            if (quantityInput) {
                var currentQuantity = parseInt(quantityInput.value, 10);

                currentQuantity++;
                quantityInput.value = currentQuantity;

                handleCartUpdate(quantityInput);
            }
        }
    });

    function handleCartUpdate(quantityInput) {
        clearTimeout(updateCartTimeout);

        updateCartTimeout = setTimeout(function () {
            updateCart(quantityInput);
        }, 500);
    }

    function triggerChangeEvent(element) {
        var event = new Event('change', { bubbles: true, cancelable: true });
        element.dispatchEvent(event);
    }

    function updateCart(quantityInput) {
        console.log('Обновляем корзину с количеством:', quantityInput.value);
        var mainQuantity = quantityInput.closest('.product-quantity').querySelector('.qty');
        var quantity = quantityInput.value;
        mainQuantity.value = quantity;
        triggerChangeEvent(mainQuantity);

        const updateCartButton = document.querySelector('[name="update_cart"]');

        if (updateCartButton) {
            updateCartButton.click();
        }
    }


    
    
    if (document.querySelector('.woocommerce-page')) {
        let section = document.querySelector('.woocommerce-page');

        document.addEventListener('change', function (e) {
            if (e.target.matches('input[type="radio"]')) {
                e.target.closest('form').querySelectorAll('input[type="radio"]').forEach(radio => {
                    const label = radio.closest('label');
                    if (radio.checked) {
                        label?.classList.add('active');
                    } else {
                        label?.classList.remove('active');
                    }
                });
            }

            if (e.target.matches('input[type="checkbox"]')) {
                const label = e.target.closest('label');
                if (e.target.checked) {
                    label?.classList.add('active');
                } else {
                    label?.classList.remove('active');
                }
            }
        });


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
        });
    }



    // woocommerce-checkout
    if (document.querySelector('.woocommerce-checkout')) {
        let section = document.querySelector('.woocommerce-checkout')
        let coupon_elem = section.querySelector('.data-coupone input[name="coupon_code"]')
        let coupone_block = section.querySelector('.data-coupone')

        if (section.querySelector('.data-coupone')) {
            const container = section
            container.addEventListener('click', function (event) {
                const target = event.target;

                // Проверяем, что клик произошёл по чекбоксу
                if (target.matches('.promo-checkbox')) {
                    const couponeBlock = container.querySelector('.data-coupone');
                    const couponElem = document.querySelector('.data-coupone input[name="coupon_state"]');

                    if (coupone_block.querySelector('.data-coupone-note')) {
                        coupone_block.querySelector('.data-coupone-note').remove()
                    }

                    if (target.checked) {
                        couponeBlock.classList.add('active');

                        if (couponElem) {
                            couponElem.setAttribute('required', '');
                        }
                    } else {
                        couponeBlock.classList.remove('active');

                        if (couponElem) {
                            couponElem.removeAttribute('required');
                        }
                    }
                }
            });


            section.querySelector('.wcl-cmp-button-2').addEventListener("click", function (e) {
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
    }



    
    // cmp-2-cart
    if (document.querySelector('.cmp-2-cart')) {
        let section = document.querySelector('.cmp-2-cart');

        document.body.addEventListener('click', function (event) {
            if (event.target.closest('.remove-item')) {
                event.preventDefault();

                let item = event.target.closest('.data-item');
                item.classList.add('active');

                const cartItemKey = item.dataset.cartItemKey;
                const cartItemElement = item;

                fetch(wcl_obj.ajax_url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        action: 'custom_remove_cart_item',
                        cart_item_key: cartItemKey,
                    }),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            cartItemElement.remove();

                            const subtotalValueElement = document.querySelector('.data-subtotal .woocommerce-Price-amount.amount bdi');
                            if (subtotalValueElement) {
                                subtotalValueElement.innerHTML = data.data.new_subtotal;
                            }

                            const cartItemCountElement = document.querySelector('.sct-header .data-cart-count');
                            if (cartItemCountElement) {
                                if (data.data.cart_item_count > 0) {
                                    cartItemCountElement.textContent = data.data.cart_item_count;
                                } else {
                                    cartItemCountElement.remove();
                                }
                            }
                        } else {
                            alert('Failed to remove item from cart');
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
            }
        });
    }
}


