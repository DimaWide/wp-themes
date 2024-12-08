<?php

$title = get_field('title');
?>
<!-- Acf Block #10 – FAQ -->
<div class="wcl-acf-block-10" id="faq">
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
                        <?php if (!empty($question)) : ?>
                            <div class="data-item-question">
                                <h2 class="data-item-question-text">
                                    <?php echo $question; ?>
                                </h2>

                                <div class="data-item-question-arrow">
                                    <i class="fa-fw fas fa-caret-down"></i>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($answer)) : ?>
                            <div class="data-item-answer">
                                <div class="data-item-answer-text">
                                    <?php echo $answer; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</div>