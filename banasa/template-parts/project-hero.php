<?php



$client               = get_field('client');
$project              = get_field('project');
$location             = get_field('location');
$year_of_construction = get_field('year_of_construction');

$gallery = get_field('gallery');

if (empty($gallery)) {
    $gallery[] = get_post_thumbnail_id();
}
?>
<div class="wcl-project-hero mod-section-animate">
    <?php project_breadcrumb(); ?>

    <div class="data-container">
        <div class="data-head">
            <div class="data-head-container tmp-container">
                <h1 class="data-title">
                    <?php if (!empty($client)) : ?>
                        <?php echo rtrim((string)$client, '.') . '.'; ?>
                    <?php endif; ?>

                    <?php if (!empty($location)) : ?>
                        <strong class="data-location"><?php echo rtrim((string)$location, '.') . '.'; ?></strong>
                    <?php endif; ?>
                </h1>
            </div>
        </div>

        <?php if (!empty($gallery)) : ?>
            <?php
            $gallery = array_reverse($gallery);
            ob_start(); // Start output buffering
            ?>
            <div class="data-slider swiper">
                <div class="data-slider-inner swiper-wrapper">
                    <?php
                    $total_slides = 30; // Total number of slides
                    $total_images = count((array)$gallery); // Total number of images

                    if ($total_images === 0) {
                        echo 'No images found.';
                    } else {
                        $prev_index = -1; // Previous image index
                        $current_index = 0; // Current image index

                        for ($slide = 0; $slide < $total_slides; $slide++) {
                            $current_index = $slide % $total_images;
                            if ($current_index === $prev_index) {
                                $current_index = ($current_index + 1) % $total_images;
                            }

                            $img_id = $gallery[$current_index];
                            $image = wp_get_attachment_image($img_id, 'image-size-4');

                            if (!empty($image)) :
                    ?>
                                <div class="data-slider-item swiper-slide">
                                    <div class="data-slider-item-inner">
                                        <div class="data-slider-item-img">
                                            <?php echo $image; ?>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            endif;
                            $prev_index = $current_index;
                        }
                    }
                    ?>
                </div>

                <div class="data-slider-nav">
                    <div class="data-slider-nav-btn mod-prev">
                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/arrow-right-2.svg', false); ?>
                    </div>

                    <div class="data-slider-nav-btn mod-next">
                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/arrow-right-2.svg', false); ?>
                    </div>
                </div>
            </div>
            <?php
            $html_content = ob_get_clean(); // Get buffer content and clean the buffer
            ?>
        <?php endif; ?>

        <?php if (!empty($gallery)) : ?>
            <div class="data-slider-out" data-content="<?php echo htmlspecialchars(json_encode(['html' => $html_content]), ENT_QUOTES, 'UTF-8'); ?>">
                <?php echo $html_content; ?>
            </div>
        <?php endif; ?>

        <?php

        if (function_exists('icl_t')) {
            $fields = array(
                'client'               => icl_t('banasa', 'client', 'Cliente'),
                'project'              => icl_t('banasa', 'project', 'Proyecto'),
                'location'             => icl_t('banasa', 'location', 'Localización'),
                'year_of_construction' => icl_t('banasa', 'year_of_construction', 'Año de Construcción'),
            );
        } else {
            $fields = array(
                'client'               => 'Cliente',
                'project'              => 'Proyecto',
                'location'             => 'Localización',
                'year_of_construction' => 'Año de Construcción'
            );
        }



        $data = array();

        foreach ($fields as $field_key => $field_label) {
            $field_value = get_field($field_key);
            if (!empty($field_value)) {
                $data[$field_label] = $field_value;
            }
        }
        ?>
        <?php if (!empty($data)) : ?>
            <div class="data-info">
                <div class="data-info-container">
                    <?php foreach ($data as $label => $value) : ?>
                        <div class="data-info-item">
                            <div class="data-info-item-label">
                                <?php echo $label; ?>:
                            </div>

                            <div class="data-info-item-value">
                                <?php echo $value; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>