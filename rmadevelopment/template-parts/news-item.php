<?php

$excerpt = get_the_excerpt();

$type_page = isset($args['type_page']) ? $args['type_page'] : 'news';
$type_page_class = 'mod-' . $type_page;

if (!empty($excerpt)) {
    if (mb_strlen($excerpt) > 228) {
        $excerpt = mb_substr($excerpt, 0, 228) . "...";
    }
}

if ($type_page == 'news') {
    $image = get_the_post_thumbnail($post->ID, 'image-size-3');
} else {
    $image = get_the_post_thumbnail($post->ID, 'image-size-1');
}

$image_empty = '';

if (empty($image)) {
    $image_empty = 'mod-empty';
}

$post_date      = get_the_date('Y-m-d H:i:s');
$formatted_date = date_i18n('l, F j, Y | g:ia', strtotime($post_date));
?>
<?php if ($type_page == 'blog'): ?>
    <div class="cmp-4-news mod-blog data-item <?php echo 'post-' . $post->ID; ?>">
        <div class="cmp4-inner">
            <div class="cmp4-info">
                <div class="cmp4-b1">
                    <div class="cmp4-b1-col">
                        <div class="cmp4-date">
                            <?php echo $formatted_date; ?>
                        </div>

                        <h3 class="cmp4-title">
                            <?php echo get_the_title(); ?>
                        </h3>
                    </div>

                    <div class="cmp4-link">
                        <a href="<?php echo get_permalink(); ?>" class="cmp-button">
                            Read more
                        </a>
                    </div>
                </div>

                <?php if (! empty($excerpt)): ?>
                    <div class="cmp4-desc">
                        <?php echo $excerpt; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="cmp4-image <?php echo $image_empty; ?>">
                <?php if (!empty($image)) : ?>
                    <?php echo $image; ?>
                <?php endif; ?>
            </div>

            <div class="cmp4-link mod-type-1">
                <a href="<?php echo get_permalink(); ?>" class="cmp-button">
                    Read more
                </a>
            </div>
        </div>
    </div>
<?php else: ?>
    <?php
    $external_link = get_field('external_link', $post->ID);
    $external_link = ! empty($external_link) ?  $external_link : '#';
    ?>
    <div class="cmp-4-news mod-news data-item <?php echo 'post-' . $post->ID; ?>">
        <div class="cmp4-inner">
            <div class="cmp4-info">
                <div class="cmp4-date">
                    <?php echo $formatted_date; ?>
                </div>

                <h3 class="cmp4-title">
                    <?php echo get_the_title(); ?>
                </h3>

                <?php if (! empty($excerpt)): ?>
                    <div class="cmp4-desc">
                        <?php echo $excerpt; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="cmp4-image <?php echo $image_empty; ?>">
                <?php if (!empty($image)) : ?>
                    <?php echo $image; ?>
                <?php endif; ?>
            </div>

            <div class="cmp4-link">
                <a href="<?php echo $external_link; ?>" class="cmp-button" target="_blank">
                    Read more
                </a>
            </div>
        </div>
    </div>
<?php endif; ?>