<?php

$order = $args['order'];
?>
<div class="data-item">
    <div class="data-item-b1">
        <div class="data-item-b1-col">
            <div class="data-item-number">
                <a href="<?php echo esc_url($order->get_view_order_url()); ?>">
                    <?php echo esc_html(_x('№ ', 'hash before order number', 'woocommerce') . $order->get_order_number()); ?>
                </a>
            </div>

            <div class="data-item-b1-e1">
                <div class="data-item-count">
                    <?php custom_order_quantity_column_content($order); ?>
                </div>

                <div class="data-item-price">
                    <?php custom_order_total_column_content($order); ?>
                </div>
            </div>
        </div>

        <div class="data-item-b1-col">
            <?php
            $order_date_created = $order->get_date_created();
            $order_date_created = $order_date_created ? $order_date_created->date_i18n('d.m.Y') : '&ndash;';
            ?>
            <div class="data-item-date">
                <?php echo $order_date_created; ?>
            </div>
        </div>
    </div>

    <div class="data-item-info">
        <div class="data-item-b2">
            <div class="data-item-b2-label">
                Статус
            </div>

            <div class="data-item-b2-val">
                <?php echo esc_html(wc_get_order_status_name($order->get_status())); ?>
            </div>
        </div>

        <div class="data-item-b2">
            <div class="data-item-b2-label">
                Спосіб доставки
            </div>

            <div class="data-item-b2-val">
                <?php echo custom_delivery_method_column_content($order); ?>
            </div>
        </div>
    </div>

    <div class="data-item-image">
        <?php
        if ($order) {
            $product_images = get_images_for_products_in_order($order);

            foreach ($product_images as $product_id => $image) {
                echo $image;
            }
        } 
        ?>
    </div>

    <div class="data-item-link">
        <a href="<?php echo esc_url($order->get_view_order_url()); ?>" class="cmp-button mod-big">
            Детальна інформація
        </a>
    </div>
</div>