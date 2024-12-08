<?php


$cat = get_queried_object();

$cats = get_terms([
    'taxonomy'   => 'category',
    'hide_empty' => true,
    'include'    => CATS_EXCLUSIVE,
]);

$logo = get_field('logo', 'option');
$logo = wp_get_attachment_image($logo, 'full');
?>
<div class="wcl-cat-explore">
    <div class="data-container wcl-container">
        <h2 class="data-title">
            Explore also...
        </h2>

        <div class="data-row">
            <?php if (!empty($cats)) : ?>
                <?php foreach ($cats as $key => $term) : ?>
                    <?php
                    if ($cat->term_id === $term->term_id) {
                        continue;
                    }

                    $name  = get_field('name', 'term_' . $term->term_id);
                    $image = get_field('image', 'term_' . $term->term_id);
                    $image = wp_get_attachment_image($image, 'image-size-9');

                    $tag_start = '<a href="' . get_term_link((int)$term->term_id) . '" class="data-item-inner">';
                    $tag_end   = '</a>';

                    $access_to_read = 'mod-have-access';

                    $is_exclusive       = true;
                    $is_exclusive_class = '';
                    $popup_class        = '';

                    if ($is_exclusive) {
                        $is_exclusive_class = 'mod-is-exclusive';
                    }

                    if (!wcl_is_subscriber() && $is_exclusive) {
                        $access_to_read = 'mod-not-have-access';
                        $tag_start      = '<div class="data-item-inner">';
                        $tag_end        = '</div>';
                        $popup_class    = 'js-popup-1';
                        $logo           = get_field('logo_private', 'option');
                    } else {
                        $access_to_read = 'mod-have-access';
                        $logo           = get_field('logo', 'option');
                    }

                    $logo  = wp_get_attachment_image($logo, 'full');
                    ?>
                    <div class="data-col">
                        <div class="data-item <?php echo $access_to_read . ' ' . $is_exclusive_class . ' ' . $popup_class; ?>" data-id="<?php echo $term->slug; ?>">
                            <?php echo $tag_start; ?>

                            <?php if (!empty($image)) : ?>
                                <div class="data-item-img">
                                    <?php echo $image; ?>
                                </div>
                            <?php endif; ?>

                            <div class="data-item-content">
                                <div class="data-item-label">
                                    SC Exclusive
                                </div>

                                <h3 class="data-item-title">
                                    <?php if (!empty($name)) : ?>
                                        <?php echo $name; ?>
                                    <?php else : ?>
                                        <?php echo $term->name; ?>
                                    <?php endif; ?>
                                </h3>

                                <div class="data-item-link">
                                    <div class="wcl-link-underline">
                                        Read
                                    </div>
                                </div>
                            </div>

                            <?php if (!empty($logo)) : ?>
                                <div class="data-item-logo">
                                    <?php echo $logo; ?>
                                </div>
                            <?php endif; ?>

                            <?php echo $tag_end; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>