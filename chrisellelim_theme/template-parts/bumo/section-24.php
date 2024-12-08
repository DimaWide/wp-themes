<?php

$left_column = get_sub_field('left_column');
$right_column = get_sub_field('right_column');

$title = $left_column['title'];
$quote_1 = $left_column['quote_1'];
$author_1 = $left_column['author_1'];
$quote_2 = $left_column['quote_2'];
$author_2 = $left_column['author_2'];

$image_1 = $right_column['images_group']['image_1'];
$image_1 = wp_get_attachment_image($image_1, 'image-u');
$image_2 = $right_column['images_group']['image_2'];
$image_2 = wp_get_attachment_image($image_2, 'image-u');
$note_1 = $right_column['note_group']['note_1'];
$note_2 = $right_column['note_group']['note_2'];

?>
<div class="wcl-section-24">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-a data-col">
                <?php if (!empty($title)) : ?>
                    <h2 class="data-title">
                        <?php echo $title; ?>
                    </h2>
                <?php endif; ?>

                <div class="data-quotes">
                    <div class="data-quotes-item">
                        <?php if (!empty($quote_1)) : ?>
                            <div class="data-quotes-item-text">
                                <?php echo wpautop($quote_1); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($author_1)) : ?>
                            <div class="data-quotes-item-author">
                                <?php echo $author_1; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="data-quotes-item">
                        <?php if (!empty($quote_2)) : ?>
                            <div class="data-quotes-item-text">
                                <?php echo wpautop($quote_2); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($author_2)) : ?>
                            <div class="data-quotes-item-author">
                                <?php echo $author_2; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="data-b data-col">
                <?php if (!empty($image_1)) : ?>
                    <div class="data-b-img">
                        <?php echo $image_1; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($image_2)) : ?>
                    <div class="data-b-img">
                        <?php echo $image_2; ?>

                        <div class="data-b-note">
                            <?php if (!empty($note_1)) : ?>
                                <?php
                                $text = $note_1['text'];
                                $url  = $note_1['url'];
                                ?>
                                <?php if (!empty($url)) : ?>
                                    <a href="<?php echo $url; ?>" class="data-b-note-item" target="_blank">
                                        <?php echo $text; ?>
                                    </a>
                                <?php else : ?>
                                    <div class="data-b-note-item">
                                        <?php echo $text; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if (!empty($note_1) && !empty($note_2)) : ?>
                                <?php echo '&nbsp;&nbsp;-&nbsp;&nbsp;'; ?>
                            <?php endif; ?>

                            <?php if (!empty($note_2)) : ?>
                                <?php
                                $text = $note_2['text'];
                                $url  = $note_2['url'];
                                ?>
                                <?php if (!empty($url)) : ?>
                                    <a href="<?php echo $url; ?>" class="data-b-note-item" target="_blank">
                                        <?php echo $text; ?>
                                    </a>
                                <?php else : ?>
                                    <div class="data-b-note-item">
                                        <?php echo $text; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="data-b-note">
                    <?php if (!empty($note_1)) : ?>
                        <?php
                        $text = $note_1['text'];
                        $url  = $note_1['url'];
                        ?>
                        <?php if (!empty($url)) : ?>
                            <a href="<?php echo $url; ?>" class="data-b-note-item" target="_blank">
                                <?php echo $text; ?>
                            </a>
                        <?php else : ?>
                            <div class="data-b-note-item">
                                <?php echo $text; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if (!empty($note_1) && !empty($note_2)) : ?>
                        <?php echo '&nbsp;&nbsp;-&nbsp;&nbsp;'; ?>
                    <?php endif; ?>

                    <?php if (!empty($note_2)) : ?>
                        <?php
                        $text = $note_2['text'];
                        $url  = $note_2['url'];
                        ?>
                        <?php if (!empty($url)) : ?>
                            <a href="<?php echo $url; ?>" class="data-b-note-item" target="_blank">
                                <?php echo $text; ?>
                            </a>
                        <?php else : ?>
                            <div class="data-b-note-item">
                                <?php echo $text; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>