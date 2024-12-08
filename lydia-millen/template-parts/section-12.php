<?php

?>
<div class="wcl-section-12">
    <div class="data-container wcl-container">
        <?php if (have_rows('list')) : ?>
            <div class="data-list">
                <?php while (have_rows('list')) : the_row(); ?>
                    <?php
                    $image    = get_sub_field('image');
                    $image    = wp_get_attachment_image($image, 'image-size-2');
                    $title    = get_sub_field('title');
                    $link     = get_sub_field('link');
                    $category = get_sub_field('category');
                    $category = get_term_by('id', $category, 'category');
                    ?>
                    <div class="data-item">
                        <div class="data-item-inner">
                            <?php if (!empty($image)) : ?>
                                <div class="data-item-img">
                                    <?php echo $image; ?>
                                </div>
                            <?php endif; ?>

                            <div class="data-item-info">
                                <?php if (!empty($title)) : ?>
                                    <h3 class="data-item-title">
                                        <?php echo $title; ?>
                                    </h3>
                                <?php endif; ?>

                                <?php if (!empty($link)) : ?>
                                    <?php
                                    $link_url    = $link['url'];
                                    $link_title  = $link['title'];
                                    $link_target = $link['target'] ?: '_self';
                                    if (empty($link_url) || $link_url == '#' && ! empty( $category)) {
                                        $link_url = get_term_link($category);
                                    }
                                    ?>
                                    <div class="data-item-link">
                                        <a href="<?php echo $link_url; ?>" class="wcl-link mod-light" target="<?php echo $link_target; ?>">
                                            <?php echo $link_title; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</div>