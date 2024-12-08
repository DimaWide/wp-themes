<?php



$group  = get_sub_field('group');
$title  = $group['title'];
$desc   = $group['desc'];
$link_1 = $group['link_1'];
$link_2 = $group['link_2'];
$image  = get_sub_field('image');
$image  = wp_get_attachment_image($image, 'image-size-10');
?>
<div class="wcl-section-18">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <div class="data-a">
                    <div class="data-a-a">
                        <?php if (!empty($title)) : ?>
                            <h1 class="data-title">
                                <?php echo $title; ?>
                            </h1>
                        <?php endif; ?>

                        <?php if (!empty($desc)) : ?>
                            <div class="data-desc">
                                <?php echo $desc; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="data-links">
                        <?php if (!empty($link_1)) : ?>
                            <?php
                            $link_url    = $link_1['url'];
                            $link_title  = $link_1['title'];
                            $link_target = $link_1['target'] ?: '_self';
                            ?>
                            <div class="data-links-item">
                                <a href="<?php echo $link_url; ?>" class="wcl-link mod-black-to-white" target="<?php echo $link_target; ?>">
                                    <?php echo $link_title; ?>
                                    <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($link_2)) : ?>
                            <?php
                            $link_url    = $link_2['url'];
                            $link_title  = $link_2['title'];
                            $link_target = $link_2['target'] ?: '_self';
                            ?>
                            <div class="data-links-item">
                                <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                                    <span> <?php echo $link_title; ?></span>
                                    <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="data-note">
                        Scroll to discover more
                    </div>
                </div>
            </div>

            <div class="data-col">
                <div class="data-b">
                    <?php if (!empty($image)) : ?>
                        <div class="data-img">
                            <?php echo $image; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>