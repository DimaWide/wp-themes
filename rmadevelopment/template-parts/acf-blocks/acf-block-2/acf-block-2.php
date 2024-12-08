<?php

if (display_preview_image($block)) {
    return;
}

$group_1 = get_field('group_1');
$group_2 = get_field('group_2');
?>
<!-- Acf Block #2 – Development -->
<div class="wcl-acf-block-2">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <div class="data-info">
                    <?php if (! empty($group_1)): ?>
                        <?php
                        $title       = $group_1['title'];
                        $description = $group_1['description'];
                        $link        = $group_1['link'];
                        ?>
                        <?php if (!empty($title)) : ?>
                            <h2 class="data-title">
                                <?php echo $title; ?>
                            </h2>
                        <?php endif; ?>

                        <?php if (!empty($description)) : ?>
                            <div class="data-desc">
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
                                <a href="<?php echo $link_url; ?>" class="cmp-button" target="<?php echo $link_target; ?>">
                                    <?php echo $link_title; ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="data-col">
                <?php if (!empty($group_1['title'])) : ?>
                    <div class="data-title mod-mobile wcl-h2">
                        <?php echo $group_1['title']; ?>
                    </div>
                <?php endif; ?>

                <?php if (! empty($group_2)): ?>
                    <?php
                    $image = $group_2['image'];
                    $image = wp_get_attachment_image($image, 'image-size-1');
                    ?>
                    <?php if (!empty($image)) : ?>
                        <div class="data-img">
                            <?php echo $image; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>