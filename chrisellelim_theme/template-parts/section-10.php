<?php


$item_1 = get_sub_field('item_1');
$item_2 = get_sub_field('item_2');
$item_3 = get_sub_field('item_3');
?>
<div class="wcl-section-10">
    <div class="data-container wcl-container">
        <?php
        $image        = $item_1['col_1']['image'];
        $youtube_link = $item_1['col_1']['youtube_link'];
        $title        = $item_1['col_2']['title'];
        $desc         = $item_1['col_2']['desc'];
        $link         = $item_1['col_2']['link'];
        $image        = wp_get_attachment_image($image, 'image-b');
        $iframe       = '';
        if (!empty($youtube_link)) {
            parse_str(parse_url($youtube_link, PHP_URL_QUERY), $my_array_of_vars);
            $iframe = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $my_array_of_vars['v'] .
                '?autoplay=1&controls=1&showinfo=0" title="YouTube video player" frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        }
        ?>
        <div class="data-a data-row">
            <div class="data-a-a data-col data-col-1">
                <div class="data-a-a-inner">
                    <div class="data-a-a-inner-2">
                        <?php if (!empty($image)) : ?>
                            <div class="data-a-a-img">
                                <?php echo $image; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($iframe)) : ?>
                            <div class="data-a-a-iframe" data-video="<?php echo esc_attr($iframe); ?>"></div>
                        <?php endif; ?>

                        <div class="data-a-a-play">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/play.svg'; ?>" alt="img">
                        </div>
                    </div>
                </div>
            </div>

            <div class="data-a-b data-col data-col-2">
                <?php if (!empty($title)) : ?>
                    <h2 class="data-title">
                        <?php echo $title; ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($desc)) : ?>
                    <div class="data-desc">
                        <?php echo wpautop($desc); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($link)) : ?>
                    <?php
                    $link_url    = $link['url'];
                    $link_title  = $link['title'];
                    $link_target = $link['target'] ?: '_self';
                    ?>
                    <a href="<?php echo $link_url; ?>" class="data-link wcl-link" target="<?php echo $link_target; ?>">
                        <?php echo $link_title; ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <?php
        $image   = $item_2['col_2']['image'];
        $image_2 = $item_2['col_2']['image_2'];
        $title   = $item_2['col_1']['title'];
        $desc    = $item_2['col_1']['desc'];
        $link    = $item_2['col_1']['link'];
        $image   = wp_get_attachment_image($image, 'image-m');
        $image_2 = wp_get_attachment_image($image_2, 'image-m');
        ?>
        <div class="data-b data-row">
            <div class="data-b-b data-col data-col-1">
                <div class="data-b-b-inner">
                    <div class="data-b-b-img">
                        <div class="data-b-b-img-1">
                            <?php if (!empty($image)) : ?>
                                <?php echo $image; ?>
                            <?php endif; ?>
                        </div>
                        <div class="data-b-b-img-2">
                            <?php if (!empty($image_2)) : ?>
                                <?php echo $image_2; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="data-b-a data-col data-col-2">
                <?php if (!empty($title)) : ?>
                    <h2 class="data-title">
                        <?php echo $title; ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($desc)) : ?>
                    <div class="data-desc">
                        <?php echo wpautop($desc); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($link)) : ?>
                    <?php
                    $link_url    = $link['url'];
                    $link_title  = $link['title'];
                    $link_target = $link['target'] ?: '_self';
                    ?>
                    <a href="<?php echo $link_url; ?>" class="data-link wcl-link" target="<?php echo $link_target; ?>">
                        <?php echo $link_title; ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <?php
        $image = $item_3['col_1']['image'];
        $title = $item_3['col_2']['title'];
        $desc  = $item_3['col_2']['desc'];
        $link  = $item_3['col_2']['link'];
        $image = wp_get_attachment_image($image, 'image-w');
        ?>
        <div class="data-c data-row">
            <div class="data-c-a data-col data-col-1">
                <div class="data-c-a-inner">
                    <div class="data-c-a-img">
                        <?php if (!empty($image)) : ?>
                            <?php echo $image; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="data-c-b data-col data-col-2">
                <?php if (!empty($title)) : ?>
                    <h2 class="data-title">
                        <?php echo $title; ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($desc)) : ?>
                    <div class="data-desc">
                        <?php echo wpautop($desc); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($link)) : ?>
                    <?php
                    $link_url    = $link['url'];
                    $link_title  = $link['title'];
                    $link_target = $link['target'] ?: '_self';
                    ?>
                    <a href="<?php echo $link_url; ?>" class="data-link wcl-link" target="<?php echo $link_target; ?>">
                        <?php echo $link_title; ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="wcl-block-1">
    <div class="data-container wcl-container">
        <a href="<?php echo site_url('/') . 'contact'; ?>" class="data-link">
            <span>Any Enquiry?</span>
            &nbsp;
            <span>Get in touch.</span>
        </a>
    </div>
</div>