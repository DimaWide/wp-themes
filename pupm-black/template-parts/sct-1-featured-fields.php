<?php if (is_front_page()): ?>
    <?php
    $result = get_active_banners_with_html();
    ?>
    <?php if ($result['has_active_banners']): ?>
        <div class="cmp-banner">
            <div class="data-container wcl-container">
                <?php foreach ($result['active_banners'] as $banner_html): ?>
                    <?php echo $banner_html;  ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php
$tables_field = get_field('tables_field', 'option');
$count_fields = $tables_field['featured_fields'] ?? 5;

$page_name    = isset($args['page']) ? $args['page'] : '';
$token_data   = '';
$token_cache  = [];

$np_payment_status = get_transient('np_payment_status_' . get_current_user_id());

$args = array(
    'post_type'      => 'featured_field',
    'posts_per_page' => $count_fields,
);

$args['meta_query'][] = array(
    'key'     => 'featured_status',
    'value'   => 'active',
    'type'    => 'LIKE',
);

$query_obj   = new WP_Query($args);
$post_count  = $query_obj->post_count;

if (empty($post_count) && empty($np_payment_status)) {
    return;
}
?>

<!-- sct-1-featured-fields mod-mod-featured-fields -->
<div class="sct-1-featured-fields mod-featured-fields">
    <div class="data-container wcl-container">
        <div class="data-b3 mod-mobile">
            <div class="data-b1">
                <div class="data-title">
                    FEATURED PROJECTS
                </div>

                <?php if (! empty($np_payment_status)): ?>
                    <div class="data-tooltip">
                        <div class="data-tooltip-icon">
                            <span class="tooltip-icon">i</span>
                        </div>

                        <div class="data-tooltip-modal">
                            Your token will be added to the list of favorite projects after successful completion of the payment
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-b2-table">
                <?php if ($query_obj->have_posts()) : ?>
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <?php
                        $token_data = '';
                        $mint_value = '';

                        $order_id = get_field('order_id');
                        $order    = np_get_orders_by_order_id($order_id);

                        $package = $order['package'];

                        if (!empty($order_id)) {
                            if (isset($token_cache[$order_id])) {
                                $token_data = $token_cache[$order_id];
                            } else {
                                $token_data = get_token_data_by_order_id($order_id);
                                $token_cache[$order_id] = $token_data;
                            }
                        }

                        if (empty($token_data)) {
                            continue;
                        }

                        $mint_value      = $token_data['token_mint_value'];
                        $token_details   = $token_data['token_details'];
                        $dex_paid_status = $token_data['dex_paid_status'];

                        $dataOptimizer = new Token(unserialize($token_details));
                        ?>
                        <div class="data-b2-item" data-package="<?php echo $package; ?>">
                            <div class="data-b3-row">
                                <div class="data-b3-col">
                                    <div class="data-b2-item-image">
                                        <?php if (checkImageUrl($dataOptimizer->get('image_uri'))): ?>
                                            <img src="<?php echo $dataOptimizer->get('image_uri'); ?>" alt="img">
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="data-b3-col">
                                    <div class="data-b2-item-name">
                                        <?php echo esc_html($dataOptimizer->get('name')); ?>
                                    </div>

                                    <div class="data-b2-item-name">
                                        <?php echo $dataOptimizer->get('symbol'); ?>
                                    </div>

                                    <div class="data-b2-item-marketcap">
                                        <?php echo $dataOptimizer->formatMarketCap(); ?>
                                    </div>
                                </div>

                                <div class="data-b3-col">
                                    <?php echo $dataOptimizer->getCaHtml(); ?>

                                    <div class="data-b2-item-dex-paid">
                                        <?php if (! empty($dex_paid_status) && $dex_paid_status == true): ?>
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/check-circle.svg'; ?>" alt="img">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="data-b3-row">
                                <div class="data-b3-col">
                                    <?php echo $dataOptimizer->getSocialLinksHtml(); ?>
                                </div>

                                <div class="data-b3-col">
                                    <?php echo $dataOptimizer->getBuyLinksHtml(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="data-circles mod-1">
            <div class="data-circles-item"></div>
            <div class="data-circles-item"></div>
            <div class="data-circles-item"></div>
        </div>

        <div class="data-circles mod-2">
            <div class="data-circles-item"></div>
            <div class="data-circles-item"></div>
            <div class="data-circles-item"></div>
        </div>

        <div class="data-b1 mod-desktop">
            <div class="data-title">
                FEATURED PROJECTS
            </div>

            <?php if (! empty($np_payment_status)): ?>
                <div class="data-tooltip">
                    <div class="data-tooltip-icon">
                        <span class="tooltip-icon">i</span> <!-- Tooltip icon -->
                    </div>

                    <div class="data-tooltip-modal">
                        Your token will be added to the list of favorite projects after successful completion of the payment

                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="data-b2 mod-desktop">
            <table class="data-b2-table">
                <thead>
                    <tr class="data-b2-head-row">
                        <th>Image</th>
                        <th>Name</th>
                        <th>$SYMBOL</th>
                        <th>CA</th>
                        <th>Social</th>
                        <th>Marketcap</th>
                        <th>buy links</th>
                        <th>DEX PAID</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($query_obj->have_posts()) : ?>
                        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                            <?php
                            $token_data = '';
                            $mint_value = '';
                            $activation_date = get_post_meta($post->ID, 'featured_activation_date', true);

                            $order_id = get_field('order_id');
                            $order    = np_get_orders_by_order_id($order_id);

                            $package = $order['package'];

                            if (!empty($order_id)) {
                                if (isset($token_cache[$order_id])) {
                                    $token_data = $token_cache[$order_id];
                                } else {
                                    $token_data = get_token_data_by_order_id($order_id);
                                    $token_cache[$order_id] = $token_data;
                                }
                            }

                            if (empty($token_data)) {
                                continue;
                            }

                            $mint_value      = $token_data['token_mint_value'];
                            $token_details   = $token_data['token_details'];
                            $dex_paid_status = $token_data['dex_paid_status'];

                            $dataOptimizer = new Token(unserialize($token_details));
                            ?>
                            <tr class="data-b2-item" data-package="<?php echo $package; ?>" data-activation-date="<?php echo $activation_date; ?>">
                                <td>
                                    <div class="data-b2-item-image">
                                        <?php if (checkImageUrl($dataOptimizer->get('image_uri'))): ?>
                                            <img src="<?php echo $dataOptimizer->get('image_uri'); ?>" alt="img">
                                        <?php endif; ?>
                                    </div>
                                </td>

                                <td>
                                    <div class="data-b2-item-name">
                                        <?php echo $dataOptimizer->get('name'); ?>
                                    </div>
                                </td>

                                <td>
                                    <div class="data-b2-item-name">
                                        <?php echo $dataOptimizer->get('symbol'); ?>
                                    </div>
                                </td>

                                <td>
                                    <?php echo $dataOptimizer->getCaHtml(); ?>
                                </td>

                                <td>
                                    <div class="data-b2-item-social">
                                        <?php echo $dataOptimizer->getSocialLinksHtml(); ?>
                                    </div>
                                </td>

                                <td>
                                    <div class="data-b2-item-marketcap">
                                        <?php echo $dataOptimizer->formatMarketCap(); ?>
                                    </div>
                                </td>

                                <td>
                                    <div class="data-b2-item-buy-links">
                                        <?php echo $dataOptimizer->getBuyLinksHtml(); ?>
                                    </div>
                                </td>

                                <td>
                                    <div class="data-b2-item-dex-paid">
                                        <?php if (! empty($dex_paid_status) && $dex_paid_status == true): ?>
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/check-circle.svg'; ?>" alt="img">
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="data-link">
            <a href="<?php echo site_url('') . '/order'; ?>" class="cmp-button">
                <span>
                    your project here
                </span>
            </a>
        </div>
    </div>
</div>