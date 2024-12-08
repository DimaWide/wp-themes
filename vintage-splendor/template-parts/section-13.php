<?php


$title       = get_sub_field('title');
$desc        = get_sub_field('desc');
$desc_mobile = get_sub_field('desc_mobile');
?>
<div class="wcl-section-13">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <?php if (!empty($title)) : ?>
                    <h1 class="data-title">
                        <?php echo $title; ?><span>.</span>
                    </h1>
                <?php endif; ?>

                <div class="data-text">
                    Scroll to discover more
                </div>
            </div>

            <div class="data-col">
                <?php if (!empty($desc)) : ?>
                    <div class="data-desc">
                        <?php echo $desc; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($desc_mobile)) : ?>
                    <div class="data-desc mod-mobile">
                        <?php echo $desc_mobile; ?>
                    </div>
                <?php endif; ?>

                <div class="data-link">
                    <a href="#" class="wcl-link">
                        Learn more
                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>