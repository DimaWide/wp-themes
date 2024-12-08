<div class="wcl-section-8">
    <div class="data-container">
        <?php if (have_rows('list')) : ?>
            <div class="data-list swiper">
                <div class="data-curl"></div>
                <div class="data-list-inner swiper-wrapper">
                    <?php while (have_rows('list')) : the_row(); ?>
                        <?php
                        $image   = get_sub_field('image');
                        $image   = wp_get_attachment_image($image, 'image-size-14');
                        $group   = get_sub_field('group');
                        $date    = $group['month'];
                        $desc    = $group['desc'];
                        
                        if (isset($group['link'])) {
                            $link = $group['link'];
                        }

                        $args = array(
                            'post_type'           => 'post',
                            'posts_per_page'      => 1,
                            'ignore_sticky_posts' => 1,
                            'post_status'         => ['publish'],
                        );

                        $date_from = date("Y-M", strtotime('-0 month', strtotime($date)));
                        $date_to   = date("Y-M", strtotime('+1 month', strtotime($date)));

                        $arr = array(
                            array(
                                'after' => $date_from,
                            ),
                        );
                        $args['date_query'][] = $arr;

                        $arr = array(
                            array(
                                'before' => $date_to,
                            ),
                        );
                        $args['date_query'][] = $arr;

                        $query_obj   = new WP_Query($args);
                        $total_count = $query_obj->found_posts;
                        if (empty($total_count)) {
                            continue;
                        }
                        ?>
                        <div class="data-item swiper-slide">
                            <?php if (!empty($image)) : ?>
                                <div class="data-item-img">
                                    <?php echo $image; ?>
                                </div>
                            <?php endif; ?>

                            <div class="data-item-info">
                                <?php
                                $chapter = date("n", (strtotime($date)));
                                ?>
                                <div class="data-item-chapter">
                                    <span>Chapter</span>
                                    <br>
                                    <?php echo 'N°' . $chapter; ?>
                                </div>

                                <?php if (!empty($date)) : ?>
                                    <h3 class="data-item-month">
                                        <?php
                                        $month_name = date("F", (strtotime($date)));
                                        echo $month_name;
                                        ?>
                                    </h3>
                                <?php endif; ?>

                                <?php if (!empty($desc)) : ?>
                                    <div class="data-item-desc">
                                        <div class="data-item-desc-inner">
                                            <?php echo $desc; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php

                                if (! empty($link)) {

                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>

                                    <div class="data-item-link">
                                        <a href="<?php echo esc_url($link_url); ?>" class="wcl-link" target="<?php echo esc_attr($link_target); ?>">
                                            <?php echo esc_html($link_title); ?>
                                        </a>
                                    </div>

                                <?php
                                }

                                /*if (!empty($date)) : ?>
                                    <?php
                                    $link = date("Y/m", (strtotime($date)));
                                    $link = site_url('/') .  $link;
                                    ?>
                                    <div class="data-item-link">
                                        <a href="<?php echo $link; ?>" class="wcl-link">
                                            View the Chapter
                                        </a>
                                    </div>
                                <?php endif;*/
                                ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <div class="data-list-nav">
                    <div class="data-list-nav-btn mod-prev">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/sc-6-arrow.png'; ?>" alt="img">
                    </div>

                    <div class="data-list-nav-btn mod-next">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/sc-6-arrow.png'; ?>" alt="img">
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>