<?php

// Function to get price range from the database
$prices = get_price_range();

$min_price = $prices->min_price;
$max_price = $prices->max_price;

// Set default values for range inputs
$default_min_price = $min_price > 0 ? $min_price : 0;
$default_max_price = $max_price > 0 ? $max_price : 10000;

// Curent // Get the min_price and max_price from the URL parameters
$current_min_price = isset($_GET['min_price']) ? intval($_GET['min_price']) : $default_min_price;
$current_max_price = isset($_GET['max_price']) ? intval($_GET['max_price']) : $default_max_price;

// Formatted price
$formatted_price_min = number_format($default_min_price, 2, '.', ' ') . ' ₴';
$formatted_price_max = number_format($default_max_price, 2, '.', ' ') . ' ₴';

if (isset($_GET['min_price']) && isset($_GET['max_price'])) {
    $formatted_price_min = number_format($current_min_price, 2, '.', ' ') . ' ₴';
    $formatted_price_max = number_format($current_max_price, 2, '.', ' ') . ' ₴';
}

// Set the position and width of the fill color element to represent the selected range
$minPercentage = (($current_min_price - 10) / $default_max_price) * 100;
$maxPercentage = (($current_max_price - 10) / $default_max_price) * 100;

$leftStyle = "style='left: " . $minPercentage . "%;'";
$widthStyle = "style='width: " . ($maxPercentage - $minPercentage) . "%;'";
?>
<div class="cmp-price-range data-price-range">
    <div class="data-price">
        <div class="data-price-field">
            <input type="text" class="input-min" value="<?php echo $formatted_price_min; ?>" readonly>
        </div>

        <div class="data-price-separator"></div>

        <div class="data-price-field">
            <input type="text" class="input-max" value="<?php echo $formatted_price_max; ?>" readonly>
        </div>
    </div>

    <div class="data-slider">
        <div class="data-slider-fill range-fill" <?php echo $leftStyle . $widthStyle; ?>></div>
    </div>

    <div class="data-range-input">
        <input type="range" class="data-range-input min-price" min="<?php echo $default_min_price; ?>" max="<?php echo $default_max_price; ?>" value="<?php echo $current_min_price; ?>" step="1">
        <input type="range" class="data-range-input max-price" min="<?php echo $default_min_price; ?>" max="<?php echo $default_max_price; ?>" value="<?php echo $current_max_price; ?>" step="1">
    </div>
</div>