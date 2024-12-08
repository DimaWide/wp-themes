<?php

if (display_preview_image($block)) {
    return;
}

$title   = get_field('title');
$content = get_field('content');
?>
<!-- Acf Block #10 – Personal relationships with clients -->
<div class="wcl-acf-block-10">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <div class="data-block">
                    <div class="data-block-img">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf-10-img.svg'; ?>" alt="img">
                    </div>

                    <?php if (!empty($title)) : ?>
                        <h2 class="data-title">
                            <?php echo $title; ?>
                        </h2>
                    <?php endif; ?>
                </div>
            </div>

            <div class="data-col">
                <?php if (!empty($content)) : ?>
                    <div class="data-content">
                        <?php echo $content; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>