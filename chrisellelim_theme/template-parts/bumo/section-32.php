<?php


$title = get_sub_field('title');
?>
<div class="wcl-section-32">
    <div class="data-container wcl-container">
        <?php if (!empty($title)) : ?>
            <h2 class="data-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <?php if (have_rows('list')) : ?>
            <?php
            $count = 0;
            ?>
            <div class="data-row">
                <?php while (have_rows('list')) : the_row(); ?>
                    <?php
                    $count++;
                    $title   = get_sub_field('title');
                    $link    = get_sub_field('link');
                    $image_1 = get_sub_field('image_1');
                    $image_1 = wp_get_attachment_image($image_1, 'image-d');
                    ?>
                    <?php if ($count == 2) : ?>
                        <div class="data-a mod-b data-col">
                            <div class="data-a-inner">
                                <div class="data-a-a">
                                    <?php if (!empty($image_1)) : ?>
                                        <div class="data-a-img">
                                            <?php echo $image_1; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($title)) : ?>
                                        <h3 class="data-a-title">
                                            <?php echo $title; ?>
                                        </h3>
                                    <?php endif; ?>

                                    <div class="data-a-link">
                                        <?php if (!empty($link)) : ?>
                                            <?php
                                            $link_url    = $link['url'];
                                            $link_title  = $link['title'];
                                            $link_target = $link['target'] ?: '_self';
                                            ?>
                                            <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                                                <?php echo $link_title; ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="data-a-b">
                                    <?php if (!empty($image_1)) : ?>
                                        <div class="data-a-img">
                                            <?php echo $image_1; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($title)) : ?>
                                        <div class="data-a-label">
                                            <?php echo $title; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="data-a data-col">
                            <div class="data-a-inner">
                                <div class="data-a-a">
                                    <?php if (!empty($image_1)) : ?>
                                        <div class="data-a-img">
                                            <?php echo $image_1; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($title)) : ?>
                                        <h3 class="data-a-title">
                                            <?php echo $title; ?>
                                        </h3>
                                    <?php endif; ?>
                                </div>

                                <div class="data-a-b">
                                    <?php if (!empty($image_1)) : ?>
                                        <div class="data-a-img">
                                            <?php echo $image_1; ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="data-a-link">
                                        <?php if (!empty($link)) : ?>
                                            <?php
                                            $link_url    = $link['url'];
                                            $link_title  = $link['title'];
                                            $link_target = $link['target'] ?: '_self';
                                            ?>
                                            <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                                                <?php echo $link_title; ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</div>