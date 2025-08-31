<?php

$title = get_field('title');
?>
<!-- acf-4-faq – FAQ -->
<div class="acf-4-faq">
    <div class="data-container wcl-container">
        <?php if (!empty($title)) : ?>
            <h2 class="data-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <?php if (have_rows('list')) : ?>
            <div class="data-list">
                <div class="data-list-inner">
                    <?php
                    $index = 0;
                    ?>
                    <?php while (have_rows('list')) : the_row(); ?>
                        <?php
                        $index++;
                        $question = get_sub_field('question');
                        $answer   = get_sub_field('answer');

                        $active = '';

                        if ($index == 2) {
                          $active = 'active';
                        }
                        ?>
                        <div class="data-item <?php echo $active; ?>">
                            <div class="data-item-inner">
                                <div class="data-item-question">
                                    <?php if (! empty($question)): ?>
                                        <h3 class="data-item-title">
                                            <?php echo $question; ?>
                                        </h3>

                                        <div class="data-item-arrow">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/faq-plus.svg'; ?>" alt="img">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/faq-minus.svg'; ?>" alt="img">
                                        </div>

                                        <div class="data-item-index">
                                            <?php echo 0 . $index; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php if (! empty($answer)): ?>
                                    <div class="data-item-answer">
                                        <div class="data-item-answer-inner">
                                            <?php echo $answer; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>