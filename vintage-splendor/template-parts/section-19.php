<?php


$link = get_sub_field('link');
?>
<div class="wcl-section-19">
    <div class="data-container wcl-container">
        <?php if (have_rows('list')) : ?>
            <div class="data-list swiper">
                <div class="data-list-inner swiper-wrapper">
                    <?php while (have_rows('list')) : the_row(); ?>
                        <?php
                        $title = get_sub_field('title');
                        $desc  = get_sub_field('desc');
                        ?>
                        <div class="data-item swiper-slide">
                            <div class="data-item-inner">
                                <?php if (!empty($title)) : ?>
                                    <h2 class="data-item-title">
                                        <?php echo $title; ?>
                                    </h2>
                                <?php endif; ?>

                                <?php if (!empty($desc)) : ?>
                                    <div class="data-item-desc">
                                        <div class="data-item-desc-inner">
                                            <?php echo $desc; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($link)) : ?>
            <?php
            $link_url    = $link['url'];
            $link_title  = $link['title'];
            $link_target = $link['target'] ?: '_self';
            ?>
            <div class="data-link">
                <a href="<?php echo $link_url; ?>" class="wcl-link mod-black-to-white" target="<?php echo $link_target; ?>">
                    <?php echo $link_title; ?>
                    <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>