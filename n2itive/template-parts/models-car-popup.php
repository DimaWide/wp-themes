<?php

$data = get_tesla_configurator_data();

$selectedModel     = $data['selectedModel'];
$selectedCarOption = $data['selectedCarOption'];
$selectedYear      = $data['selectedYear'];
$stateConfigurator = $data['stateConfigurator'];
$options           = $data['options'];
$teslaModels       = $data['teslaModels'];

$activeSlideIndex = array_search($selectedModel, array_column($teslaModels, 'slug'));
$activeSlideIndex = $activeSlideIndex === false ? '0' : $activeSlideIndex;
?>
<div class="cmp-4-popup mod-models-car-popup" data-id="models-car-popup">
    <div class="cmp4-overlay"></div>
    <div class="cmp4-inner-out">
        <div class="cmp4-inner" id="models-car-popup">

            <div class="cmp-1-models" data-active-index="<?php echo $activeSlideIndex; ?>">
                <div class="cmp4-close js-close">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/cars/popup-close.svg'; ?>" alt="img">
                </div>

                <div class="cmp1-inner tesla-models" data-tesla-models='<?php echo json_encode($teslaModels); ?>'>
                    <h3 class="cmp1-title">
                        Select model of your Tesla
                    </h3>
                    <div class="cmp1-list">

                        <?php
                        foreach ($teslaModels as $model) {
                            $isActiveModel = $model['slug'] === $selectedModel ? 'active' : '';
                        ?>
                            <div class="cmp1-item model <?php echo $isActiveModel; ?>" data-slug="<?php echo $model['slug']; ?>">
                                <div class="cmp1-item-info">
                                    <div class="cmp1-item-img">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/cars/' . $model['image']; ?>" alt="<?php echo $model['name']; ?>">
                                    </div>

                                    <div class="cmp1-item-name">
                                        <span><?php echo $model['name']; ?></span>
                                    </div>
                                </div>

                                <div class="cmp1-item-years year-selection">
                                    <?php
                                    foreach ($model['years'] as $year) {
                                        $isActiveYear = ($year === $selectedYear) ? 'active' : '';
                                    ?>
                                        <button class="cmp1-item-years-item year <?php echo $isActiveYear; ?>" data-year="<?php echo $year; ?>">
                                            <?php echo $year; ?>
                                        </button>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="cmp1-submit">
                    <button class="cmp1-submit-btn cmp-button" id="confirmButton">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>