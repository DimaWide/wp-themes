<?php

$token = '';

$payment_plans = get_field('payment_plans', 'option');

$plans = [
    'basic'    => 'Basic',
    'standart' => 'Standart',
    'premium'  => 'Premium',
];
?>
<!-- sct-8-gooner -->
<div class="sct-8-gooner" data-mint="<?php echo $token_mint; ?>">
    <div class="data-container wcl-container">
        <div class="data-inner">
            <div class="data-b1-out">
                <div class="preloader" style="display: none;">
                    <div class='loader loader1'>
                        <div>
                            <div>
                                <div>
                                    <div>
                                        <div>
                                            <div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="data-b1">

                </div>
            </div>

            <div class="data-list-out">
                <?php if (have_rows('payment_plans', 'option')) : ?>
                    <div class="data-list">
                        <?php while (have_rows('payment_plans', 'option')) : the_row(); ?>
                            <?php
                            $id    = get_sub_field('id');
                            $name  = get_sub_field('name');
                            $price = get_sub_field('price');
                            $time  = get_sub_field('time');

                            $seconds = get_plan_prices_time_per_seconds($time);
                            $minutes = round($seconds / 60); // Делим на 60 и округляем

                            $is_on_sale = get_sub_field('is_on_sale');
                            $sale_price = get_sub_field('sale_price');
                            ?>
                            <div class="data-item" data-plan="<?php echo $id; ?>">
                                <div class="data-item-inner">
                                    <div class="data-item-inner-2">
                                        <?php if (! empty($name)): ?>
                                            <div class="data-item-name">
                                                <?php echo $name; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (! empty($is_on_sale)) : ?>
                                            <div class="data-item-price-old">
                                                <?php echo $price . ' SOL'; ?>
                                            </div>

                                            <div class="data-item-price">
                                                <span class="data-item-price"><?php echo $sale_price . ' SOL'; ?></span>
                                            </div>
                                        <?php else: ?>
                                            <div class="data-item-price">
                                                <span class="data-item-price"><?php echo $price . ' SOL'; ?></span>
                                            </div>
                                        <?php endif; ?>

                                        <div class="data-item-note">
                                            The ad will be online for <strong><?php echo $minutes; ?> minutes</strong>.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-link">
                <button class="cmp-button" disabled>
                    <span>Order</span>
                </button>
            </div>
        </div>
    </div>
</div