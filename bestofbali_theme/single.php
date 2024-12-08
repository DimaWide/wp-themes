<?php

$hide_place_address = get_field('hide_place_address');
$hide_place_address = ! empty($hide_place_address) ? $hide_place_address : false;

$class              = '';

if ($hide_place_address === false) {
    $class = 'mod-default';
}

get_header();
?>

<div class="wcl-destination wcl-page page-template-destination <?php echo $class; ?>">
    <div class="m4-container wcl-container">
        <div class="m4-row">
            <div class="m4-col">
                <div class="m4-content">
                    <?php the_content(); ?>
                </div>
            </div>

            <div class="m4-col">
                <?php get_template_part('template-parts/sidebar'); ?>
            </div>
        </div>

        <?php get_template_part('template-parts/share-media'); ?>

        <?php if ($hide_place_address != true) : ?>
            <?php get_template_part('template-parts/section-3'); ?>
        <?php endif; ?>

        <?php get_template_part('template-parts/best-restaurants'); ?>

        <div class="wcl-dst-block-1 mod-style-1">
            <?php
            $banner = get_field('banner', 'option');
            $shortcode_ads_1 = $banner['shortcode_ads_1'];
            ?>
            <?php if (!empty($shortcode_ads_1)) : ?>
                <?php echo do_shortcode($shortcode_ads_1) ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php

get_footer();

?>