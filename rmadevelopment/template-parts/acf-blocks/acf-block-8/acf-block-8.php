<?php

if (display_preview_image($block)) {
    return;
}

$title    = get_field('title');
$subtitle = get_field('subtitle');
$team     = get_field('team');
?>
<!-- Acf Block #8 – Our Team -->
<div class="wcl-acf-block-8">
    <div class="data-container wcl-container">
        <?php if (is_front_page()): ?>
            <div class="data-lines-3 mod-home">
                <div class="line-container" data-length="340" data-orientation="horizontal" data-offset="0" data-scroll-coefficient="1.2">
                    <div class="line"></div>
                </div>

                <div class="line-container" data-length="500" data-orientation="vertical" data-offset="0" data-scroll-coefficient="1">
                    <div class="line"></div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($title)) : ?>
            <h2 class="data-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <?php if (!empty($subtitle)) : ?>
            <div class="data-subtitle">
                <?php echo $subtitle; ?>
            </div>
        <?php endif; ?>

        <?php if (have_rows('team')) : ?>
            <?php
            $count = 0;
            ?>
            <div class="data-slider-out">
                <div class="data-lines-2 mod-home">
                    <div class="line-container" data-length="560" data-orientation="horizontal" data-offset="0" data-scroll-coefficient="1">
                        <div class="line"></div>
                    </div>

                    <div class="line-container" data-length="500" data-orientation="vertical" data-offset="0" data-scroll-coefficient="1">
                        <div class="line"></div>
                    </div>

                    <div class="line-container" data-length="500" data-orientation="vertical" data-offset="0" data-scroll-coefficient="1">
                        <div class="line"></div>
                    </div>

                    <div class="line-container" data-length="560" data-orientation="horizontal" data-offset="0" data-scroll-coefficient="1">
                        <div class="line"></div>
                    </div>
                </div>

                <div class="data-slider swiper">
                    <div class="data-slider-inner swiper-wrapper">
                        <?php while (have_rows('team')) : the_row(); ?>
                            <?php
                            $count++;
                            $photo          = get_sub_field('photo');
                            $photo          = wp_get_attachment_image($photo, 'image-size-2');
                            $name           = get_sub_field('name');
                            $specialization = get_sub_field('specialization');
                            $description    = get_sub_field('description');

                            $words      = explode(' ', $name);
                            $first_name = $words[0];

                            $args =  array(
                                'photo'          => $photo,
                                'name'           => $name,
                                'specialization' => $specialization,
                                'description'    => $description,
                            );

                            $json_data = json_encode($args);
                            ?>
                            <div class="data-item swiper-slide" data-info='<?php echo esc_attr($json_data); ?>'>
                                <div class="data-item-inner">
                                    <div class="data-item-img">
                                        <?php if (!empty($photo)) : ?>
                                            <?php echo $photo; ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="data-item-info">
                                        <?php if (!empty($name)) : ?>
                                            <div class="data-item-name">
                                                <?php echo $name; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($specialization)) : ?>
                                            <div class="data-item-specialization">
                                                <?php echo $specialization; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (! empty($first_name) && ! empty($description)): ?>
                                            <div class="data-item-link js-popup-open" data-target="team-popup">
                                                About <?php echo $first_name; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <?php if ($count == 5): ?>
                                        <?php if (wcl_is_page('the_company')): ?>
                                            <div class="data-lines mod-the_company">
                                                <div class="line-container" data-length="50" data-orientation="horizontal" data-offset="0" data-scroll-coefficient="1.2">
                                                    <div class="line"></div>
                                                </div>

                                                <div class="line-container" data-length="400" data-orientation="vertical" data-offset="0" data-scroll-coefficient="1">
                                                    <div class="line"></div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>

                <?php if (is_front_page()): ?>
                    <div class="data-lines mod-home">
                        <div class="line-container" data-length="600" data-orientation="horizontal" data-offset="0" data-scroll-coefficient="1.2">
                            <div class="line"></div>
                        </div>

                        <div class="line-container" data-length="400" data-orientation="vertical" data-offset="0" data-scroll-coefficient="1">
                            <div class="line"></div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php get_template_part('template-parts/team-popup'); ?>