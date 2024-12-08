<?php

$class_block = '';

if (!empty($args)) {
    $class_block = $args['classNameBlock'];
}

$image = get_field('image');
$image = wp_get_attachment_image($image, 'image-size-6');
$group = get_field('group');
?>
<!-- Acf Block #12 – The architect of elegance -->
<div class="wcl-acf-block-12 <?php echo $class_block; ?>" itemscope itemtype="https://schema.org/Article">
    <div class="data-container wcl-container">
        <?php if (!empty($image)) : ?>
            <div class="data-image" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                <?php echo str_replace('<img ', '<img itemprop="url" ', $image); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($group)) : ?>
            <?php
            $tagline     = $group['tagline'];
            $title       = $group['title'];
            $description = $group['description'];
            $link        = $group['link'];
            ?>
            <div class="data-info">
                <div class="data-info-inner">
                    <?php if (!empty($tagline)) : ?>
                        <div class="wcl-cmp-tagline data-tagline" itemprop="alternativeHeadline">
                            <?php echo $tagline; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($title)) : ?>
                        <h2 class="wcl-cmp-title data-title" itemprop="headline">
                            <?php echo $title; ?>
                        </h2>
                    <?php endif; ?>

                    <?php if (!empty($description)) : ?>
                        <div class="wcl-cmp-desc data-desc" itemprop="description">
                            <?php echo $description; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($link)) : ?>
                        <?php
                        $link_url    = $link['url'];
                        $link_title  = $link['title'];
                        $link_target = $link['target'] ?: '_self';
                        ?>
                        <div class="data-link">
                            <a href="<?php echo $link_url; ?>" class="wcl-cmp-button" target="<?php echo $link_target; ?>" itemprop="url">
                                <?php echo $link_title; ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>