<?php


$title = get_sub_field('title');
$desc  = get_sub_field('desc');
$link  = get_sub_field('link');
$logo  = get_field('logo', 'option');
$logo  = wp_get_attachment_image_url($logo, 'full');
?>
<div class="wcl-section-2">
    <div class="data-container wcl-container">
        <div class="data-inner">
            <div class="data-a">
                <?php if (!empty($title)) : ?>
                    <h2 class="data-title">
                        <?php echo $title; ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($desc)) : ?>
                    <div class="data-desc">
                        <?php echo $desc; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($link)) : ?>
                    <?php
                    $link_url    = $link['url'];
                    $link_title  = $link['title'];
                    $link_target = $link['target'] ?: '_self';
                    ?>
                    <div class="data-link">
                        <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                            <?php echo $link_title; ?>
                            <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (!empty($logo)) : ?>
                <div class="data-logo">
                    <?php echo file_get_contents($logo, false); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>