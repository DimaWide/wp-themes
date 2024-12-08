<?php

$ratings = $args['ratings'];
?>
<?php if (!empty($ratings)) : ?>
    <div class="data-rating-out">
        <div class="data-rating">
            <div class="data-rating-list">
                <?php foreach ($ratings as $key => $item) : ?>
                    <?php
                    $item_name       = $item['name'];
                    $item_value      = $item['value'];
                    $item_count_vote = $item['count_vote'];
                    $item_title      = $item['title'];

                    $item_value = (float)$item_value;

                    if (empty($item_value)) {
                        continue;
                    }
                    
                    $item_value = wcl_rating_to_stars((float)$item_value);
                    
                    $class = '';

                    if ($item_name == 'trip-advisor') {
                        $class = 'mod-trip-advisor';
                    }
                    ?>
                    <?php if (!empty($item_value)) : ?>
                        <div class="data-rating-item <?php echo $class; ?>">
                            <div class="data-rating-item-title">
                                <?php echo $item_title; ?>
                            </div>

                            <div class="data-rating-item-score">
                                <?php
                                if ($item_name == 'trip-advisor') {
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $item_value) {
                                            echo '<i class="fa-solid fa-circle"></i>';
                                        } else {
                                            if ($item_value - $i == -0.5) {
                                                echo '<i class="fa-solid fa-circle-half-stroke"></i>';
                                            } else {
                                                echo '<i class="fa-regular fa-circle"></i>';
                                            }
                                        }
                                    }
                                } else{
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $item_value) {
                                            echo '<i class="fa-solid fa-star"></i>';
                                        } else {
                                            if ($item_value - $i == -0.5) {
                                                echo '<i class="fa-solid fa-star-half-stroke"></i>';
                                            } else {
                                                echo '<i class="fa-regular fa-star"></i>';
                                            }
                                        }
                                    }
                                }
                                ?>
                            </div>

                            <?php if (!empty($item_count_vote) && $item_name != 'local') : ?>
                                <div class="data-rating-item-num">
                                    <span>Rating count</span>

                                    <span>
                                        <?php echo $item_count_vote; ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>