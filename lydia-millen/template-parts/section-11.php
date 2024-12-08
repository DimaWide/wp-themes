<?php


$title = get_sub_field('title');
?>
<div class="wcl-section-11" id="FAQ">
    <div class="data-container wcl-container">
        <?php if (!empty($title)) : ?>
            <h2 class="data-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <?php if (have_rows('list')) : ?>
            <div class="data-list">
                <?php while (have_rows('list')) : the_row(); ?>
                    <?php
                    $question = get_sub_field('question');
                    $answer   = get_sub_field('answer');
                    ?>
                    <div class="data-item">
                        <h3 class="data-item-question">
                            <?php if (!empty($question)) : ?>
                                <?php echo $question; ?>

                                <div class="data-item-icon">
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/sc-11-plus.svg'; ?>" class="data-plus" alt="img">
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/sc-11-minus.svg'; ?>" class="data-minus" alt="img">
                                </div>
                            <?php endif; ?>
                        </h3>

                        <?php if (!empty($answer)) : ?>
                            <div class="data-item-answer">
                                <?php echo $answer; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</div>