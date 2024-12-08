<?php


?>
<div class="wcl-banner before-init">
    <div class="data-inner">
        <?php if (have_rows('list')) : ?>
            <div class="swiper data-list">
                <div class="swiper-wrapper data-list-inner">
                    <?php while (have_rows('list')) : the_row(); ?>
                        <?php
                        $post_id     = get_sub_field('post');
                        $use_gallery = get_sub_field('use_gallery');
                        $gallery     = get_field('banner_gallery', $post_id);
                        $title       = get_field('banner_title', $post_id);
                        $desc       = get_field('banner_desc', $post_id);
                        $thumbnail   = get_the_post_thumbnail($post_id, 'image-a');
                        $counter     = 0;
                        ?>
                        <div class="data-item swiper-slide <?php echo 'post-' . $post_id; ?>">
                            <div class="data-item-inner">
                                <div class="data-item-view">
                                    <div class="data-item-nav">
                                        <div class="data-item-nav-item wcl-link">
                                            previous
                                        </div>
                                        <div class="data-item-nav-item wcl-link">
                                            next
                                        </div>
                                    </div>
                                    <?php if (!empty($gallery) && $use_gallery) : ?>
                                        <div class="data-item-gallery">
                                            <?php foreach ($gallery as $gallery_id) : ?>
                                                <?php
                                                $counter++;
                                                $active = '';
                                                $image = wp_get_attachment_image_url($gallery_id, 'image-a');
                                                if ($counter == 1) {
                                                    $active = 'active';
                                                }
                                                ?>
                                                <?php if (!empty($image)) : ?>
                                                    <img src="<?php echo $image; ?>" class="<?php echo $active; ?>" alt="img">
                                                <?php endif; ?>
                                            <?php endforeach ?>
                                        </div>
                                    <?php else : ?>
                                        <?php if (!empty($thumbnail)) : ?>
                                            <div class="data-item-img">
                                                <?php echo $thumbnail; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>

                                <?php if (!empty($title)) : ?>
                                    <div class="data-item-title">
                                        <h3 class="data-item-title-item">
                                            <?php echo $title; ?>
                                        </h3>
                                        <div class="data-item-title-item">
                                            <?php echo $title; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="data-item-a">
                                    <?php if (!empty($desc)) : ?>
                                        <div class="data-item-desc">
                                            <?php echo $desc; ?>
                                        </div>
                                    <?php endif; ?>

                                    <a href="<?php echo get_permalink($post_id); ?>" class="data-item-link wcl-link">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>