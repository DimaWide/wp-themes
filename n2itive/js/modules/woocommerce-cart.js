

export function init_woocommerce_cart() {
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

                            const updateCartButton = document.querySelector('[name="update_cart"]');

                            console.log(updateCartButton)

                            if (updateCartButton) {
                                updateCartButton.click();

                                jQuery(function ($) {
                                    $(document.body).trigger('wc_update_cart');
                                });
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


