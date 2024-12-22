<?php

$tables_field = get_field('tables_field', 'option');
$count_fields_new_livestream        = $tables_field['new_livestream'] ?? 4;
$count_fields_new_livestream_mobile = $tables_field['new_livestream_mobile'] ?? 4;

$upcoming_launches = $tables_field['upcoming_launches'] ?? 4;

$add_new_project_link = get_field('add_new_project_link', 'option');
$sound_status         = get_sound_status('live_stream');
$fields_data          = '';

if (is_local_dev_site()) {
    $fields_data = get_option('big_buys_data');
} else {
    $fields_data = getTableData('live_stream', $count_fields_new_livestream);
}

$args = array(
    'post_type'      => 'upcoming_field',
    'posts_per_page' => $upcoming_launches,
    'meta_key'       => 'launch_date',
    'orderby'        => 'meta_value',
    'order'          => 'DESC',
    'meta_type'      => 'DATE',
);

$query_obj  = new WP_Query($args);
$post_count = $query_obj->post_count;

$upcoming_field_count = 0;
?>
<!-- sct-6-tables -->
<div class="sct-6-tables">
    <div class="data-container wcl-container">

        <div class="sct-1-featured-fields mod-upcoming-fields mod-mobile">
            <div class="data-b3">
                <div class="data-b1">
                    <div class="data-title">
                        UPCOMING LAUNCHES
                    </div>
                </div>

                <div class="data-b2-table">
                    <?php if ($query_obj->have_posts()) : ?>
                        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                            <?php
                            $post_id     = get_the_ID();
                            $image       = get_field('image');
                            $name        = get_field('name');
                            $social      = get_field('social');
                            $launch_date = get_field('launch_date');
                            $image       = wp_get_attachment_image($image, 'image-size-1');

                            $social_data = [
                                [
                                    'link'  => $social['pumpfun'] ?? '',
                                    'image' => 'social-tabletka.png',
                                    'key'   => 'tabletka'
                                ],
                                [
                                    'link'  => $social['twitter'] ?? '',
                                    'image' => 'social-twitter.png',
                                    'key'   => 'twitter'
                                ],
                                [
                                    'link'  => $social['telegram'] ?? '',
                                    'image' => 'social-telegram.png',
                                    'key'   => 'telegram'
                                ],
                                [
                                    'link'  => $social['website'] ?? '',
                                    'image' => 'social-website.png',
                                    'key'   => 'website'
                                ],
                            ];

                            $timestamp      = strtotime($launch_date);
                            $formatted_date = (new DateTime())->setTimestamp($timestamp)->format('Y-m-d\TH:i:s');

                            $current_time = time();

                            if ($timestamp <= $current_time) {
                                continue;
                            }

                            $upcoming_field_count++;
                            ?>
                            <div class="data-b2-item" data-launch="<?php echo esc_attr($formatted_date); ?>">
                                <div class="data-b3-row">
                                    <div class="data-b3-col">
                                        <div class="data-b2-item-image">
                                            <?php if (! empty($image)): ?>
                                                <?php echo $image; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="data-b3-col">
                                        <div class="data-b2-item-name">
                                            <?php if (! empty($name)): ?>
                                                <?php echo $name; ?>
                                            <?php endif; ?>
                                        </div>

                                        <?php token_upcoming_launch_date_html($launch_date); ?>
                                    </div>

                                    <div class="data-b3-col">
                                        <div class="data-b2-item-social">
                                            <?php foreach ($social_data as $item): ?>
                                                <?php
                                                $state = !empty($item['link']) ? 'mod-enabled' : 'mod-disabled';
                                                $icon  = $item['image'];
                                                $key   = $item['key'];
                                                ?>
                                                <div class="data-b2-item-social-item mod-<?php echo $key; ?> <?php echo $state; ?>">
                                                    <a href="<?php echo esc_url($item['link']); ?>" target="_blank" rel="noopener noreferrer">
                                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/' . $icon; ?>" alt="img">
                                                    </a>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    <?php endif; ?>

                </div>
            </div>

            <div class="data-link">
                <?php if (! empty($add_new_project_link)): ?>
                    <a href="<?php echo $add_new_project_link; ?>" class="cmp-button" target="_blank" rel="noopener noreferrer">
                        <span>
                            add new project
                        </span>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="sct-1-featured-fields mod-new-livestream live_stream mod-mobile">
            <div class="data-b3">
                <div class="data-b1">
                    <div class="data-b1-col">
                        <div class="data-title">
                            NEW <span>LIVES</span>TREAM
                        </div>

                        <div class="data-b1-icon <?php echo $sound_status; ?>">
                            <?php if ($sound_status == 'mod-enable'): ?>
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/volume-up.svg'; ?>" alt="img">
                            <?php else: ?>
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/volume-off.svg'; ?>" alt="img">
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="data-b1-col">
                        <div class="data-b1-icon-2">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/live-broadcast.png'; ?>" alt="img">
                        </div>
                    </div>
                </div>

                <div class="data-b2-table mod-mobile-table">
                    <?php if (! empty($fields_data)): ?>
                        <?php foreach ($fields_data as $key => $row): ?>
                            <?php
                            if ($key + 1 > $count_fields_new_livestream_mobile) {
                                break;
                            }

                            $dataOptimizer = new Token($row);
                            ?>
                            <div class="data-b2-item">
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
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="data-row">
            <div class="data-col">
                <div class="sct-1-featured-fields mod-upcoming-fields mod-desktop">
                    <div class="data-b1">
                        <div class="data-title">
                            UPCOMING LAUNCHES
                        </div>
                    </div>

                    <div class="data-b2">
                        <table class="data-b2-table <?php echo empty($upcoming_field_count) ? 'mod-empty' : ''; ?> <?php echo 'mod-items-' . $upcoming_field_count; ?> <?php echo ($upcoming_field_count < 4) ? 'mod-less-4' : ''; ?>">
                            <thead>
                                <tr class="data-b2-head-row">
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Social</th>
                                    <th>launch date</th>
                                </tr>
                            </thead>

                            <?php if ($query_obj->have_posts()) : ?>
                                <?php
                                $count = 0;
                                ?>
                                <tbody>
                                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                                        <?php
                                        $count++;
                                        $post_id     = get_the_ID();
                                        $image       = get_field('image');
                                        $name        = get_field('name');
                                        $social      = get_field('social');
                                        $launch_date = get_field('launch_date');
                                        $image       = wp_get_attachment_image($image, 'image-size-1');

                                        $social_data = [
                                            [
                                                'link'  => $social['pumpfun'] ?? '',
                                                'image' => 'social-tabletka.png',
                                                'key'   => 'tabletka'
                                            ],
                                            [
                                                'link'  => $social['twitter'] ?? '',
                                                'image' => 'social-twitter.png',
                                                'key'   => 'twitter'
                                            ],
                                            [
                                                'link'  => $social['telegram'] ?? '',
                                                'image' => 'social-telegram.png',
                                                'key'   => 'telegram'
                                            ],
                                            [
                                                'link'  => $social['website'] ?? '',
                                                'image' => 'social-website.png',
                                                'key'   => 'website'
                                            ],
                                        ];

                                        $launch_date = get_field('launch_date');
                                        $timestamp = strtotime($launch_date);
                                        $formatted_date = (new DateTime())->setTimestamp($timestamp)->format('Y-m-d\TH:i:s');

                                        $current_time = time();

                                        if ($timestamp <= $current_time) {
                                            continue;
                                        }
                                        ?>
                                        <tr class="data-b2-item post-<?php echo $post_id; ?>" data-launch="<?php echo $formatted_date; ?>">
                                            <td>
                                                <div class="data-b2-item-image">
                                                    <?php if (! empty($image)): ?>
                                                        <?php echo $image; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="data-b2-item-name">
                                                    <?php if (! empty($name)): ?>
                                                        <?php echo $name; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="data-b2-item-social">
                                                    <?php foreach ($social_data as $item): ?>
                                                        <?php
                                                        $state = !empty($item['link']) ? 'mod-enabled' : 'mod-disabled';
                                                        $icon  = $item['image'];
                                                        $key   = $item['key'];
                                                        ?>
                                                        <div class="data-b2-item-social-item mod-<?php echo $key; ?> <?php echo $state; ?>">
                                                            <a href="<?php echo esc_url($item['link']); ?>" target="_blank" rel="noopener noreferrer">
                                                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/' . $icon; ?>" alt="img">
                                                            </a>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </td>

                                            <td>
                                                <?php token_upcoming_launch_date_html($launch_date); ?>
                                            </td>
                                        </tr>
                                    <?php endwhile;
                                    wp_reset_postdata(); ?>
                                </tbody>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>

                <div class="data-link mod-desktop">
                    <?php if (! empty($add_new_project_link)): ?>
                        <a href="<?php echo $add_new_project_link; ?>" class="cmp-button" target="_blank" rel="noopener noreferrer">
                            <span>
                                add new project
                            </span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="data-col">
                <div class="sct-1-featured-fields mod-new-livestream live_stream">
                    <div class="data-b1">
                        <div class="data-b1-col">
                            <div class="data-title">
                                NEW <span>LIVE</span>STREAM
                            </div>

                            <div class="data-b1-icon <?php echo $sound_status; ?>">
                                <?php if ($sound_status == 'mod-enable'): ?>
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/volume-up.svg'; ?>" alt="img">
                                <?php else: ?>
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/volume-off.svg'; ?>" alt="img">
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="data-b1-col">
                            <div class="data-b1-icon-2">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/live-broadcast.png'; ?>" alt="img">
                            </div>
                        </div>
                    </div>

                    <div class="data-b2">
                        <table class="data-b2-table mod-desktop-table">
                            <thead>
                                <tr class="data-b2-head-row">
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>$SYMBOL</th>
                                    <th>CA</th>
                                    <th class="data-b2-head-social">Social</th>
                                    <th>Marketcap</th>
                                    <th class="data-b2-head-buy-links">buy links</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if (! empty($fields_data)): ?>
                                    <?php foreach ($fields_data as $key => $row): ?>
                                        <?php
                                        if ($key + 1 > $count_fields_new_livestream) {
                                            break;
                                        }

                                        $dataOptimizer = new Token($row);
                                        ?>
                                        <tr class="data-b2-item">
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
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>