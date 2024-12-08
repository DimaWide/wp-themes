<?php

$content               = get_field('content');
$link                  = get_field('link');
$collapse_margin       = get_field('collapse_margin');
$collapse_margin_class = '';

if (!empty($collapse_margin)) {
    $collapse_margin_class = 'mod-collapse-margin';
}

$style           = get_field('style');
$style_class     = !empty($style) ? $style : 'default';
$style_class     = 'mod-' . $style_class;
?>
<!-- wcl-acf-block-1 - Text Content -->
<?php if (!empty($content)) : ?>
    <div class="wcl-acf-block-1 wcl-single-content <?php echo $style_class . ' ' . $collapse_margin_class; ?>">
        <div class="data-container">
            <?php echo $content; ?>

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
    </div>
<?php endif; ?>