<?php

$title = get_sub_field('title');
$content_group = get_sub_field('content_group');
$text_1 = $content_group['text_1'];
$text_2 = $content_group['text_2'];
$gallery_title = get_sub_field('gallery_title');
$gallery = get_sub_field('gallery');

?>
<div class="wcl-section-9">
    <div class="data-contaier wcl-container">
        <?php if (!empty($title)) : ?>
            <h2 class="data-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <div class="data-a">
            <div class="data-a-col">
                <?php if (!empty($text_1)) : ?>
                    <div class="data-a-text">
                        <?php echo wpautop($text_1); ?>
                    </div>
                <?php endif; ?>

            </div>
            <div class="data-a-col">
                <?php if (!empty($text_2)) : ?>
                    <div class="data-a-text">
                        <?php echo wpautop($text_2); ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>

        <?php if (!empty($gallery)) : ?>
            <?php
            $counter = 0;
            ?>
            <div class="data-b">
                <div class="data-b-in">
                    <?php if (!empty($gallery_title)) : ?>
                        <h2 class="data-b-title">
                            <?php echo $gallery_title; ?>
                        </h2>
                    <?php endif; ?>

                    <ul class="data-b-list">
                        <?php foreach ($gallery as $item) : ?>
                            <?php
                            $counter++;
                            $active = '';
                            $image = wp_get_attachment_image($item, 'image-l');
                            if ($counter == 1) {
                                $active = 'active';
                            }
                            ?>
                            <li class="data-b-item <?php echo $active; ?>">
                                <?php if (!empty($image)) : ?>
                                    <?php echo $image; ?>
                                <?php endif; ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>