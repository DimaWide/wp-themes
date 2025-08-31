<?php


$title = get_field('title');

$faq_categories = [
    'all'       => [],
    'design'    => [],
    'technical' => [],
];

if (have_rows('design')) {
    while (have_rows('design')) {
        the_row();
        $question = get_sub_field('question');
        $answer   = get_sub_field('answer');

        $faq_categories['design'][] = [
            'question' => $question,
            'answer'   => $answer,
        ];

        $faq_categories['all'][] = [
            'question' => $question,
            'answer'   => $answer,
        ];
    }
}

if (have_rows('technical')) {
    while (have_rows('technical')) {
        the_row();
        $question = get_sub_field('question');
        $answer   = get_sub_field('answer');

        $faq_categories['technical'][] = [
            'question' => $question,
            'answer'   => $answer,
        ];

        $faq_categories['all'][] = [
            'question' => $question,
            'answer'   => $answer,
        ];
    }
}

?>
<!-- acf-10-faq -->
<div class="acf-10-faq">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <div class="data-sidebar">
                    <div class="data-sidebar-title">
                        Categories
                    </div>

                    <div class="data-cats-out">
                        <div class="data-cats faq-tab-buttons">
                            <?php foreach ($faq_categories as $category => $items): ?>
                                <div class="data-cats-item">
                                    <button
                                        class="data-cats-item-btn cmp-button faq-tab-button <?php echo $category === 'all' ? 'active' : ''; ?>"
                                        data-tab="<?php echo esc_attr($category); ?>">
                                        <?php echo ucfirst($category);
                                        ?>
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="data-col">
                <div class="data-tabs faq-tab-content">
                    <?php foreach ($faq_categories as $category => $items): ?>
                        <div
                            class="data-tab faq-tab-panel <?php echo $category === 'all' ? 'active' : ''; ?>"
                            id="tab-<?php echo esc_attr($category); ?>">
                            <?php
                            $index = 1;
                            foreach ($items as $item):
                                $question = $item['question'];
                                $answer   = $item['answer'];
                            ?>
                                <div class="data-item">
                                    <div class="data-item-inner">
                                        <div class="data-item-question">
                                            <?php if (!empty($question)): ?>
                                                <h3 class="data-item-title">
                                                    <?php echo esc_html($question); ?>
                                                </h3>

                                                <div class="data-item-arrow">
                                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/faq-plus.svg'; ?>" alt="plus">
                                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/faq-minus.svg'; ?>" alt="minus">
                                                </div>

                                                <div class="data-item-index">
                                                    <?php echo str_pad($index, 2, '0', STR_PAD_LEFT);
                                                    ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <?php if (!empty($answer)): ?>
                                            <div class="data-item-answer">
                                                <div class="data-item-answer-inner">
                                                    <?php echo esc_html($answer); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php $index++; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>