<?php


?>
<div class="wcl-page">
    <div class="data-container wcl-container">
        <div class="data-a">
            <h1 class="data-title">
                <?php echo get_the_title(); ?>
            </h1>

            <div class="data-el"></div>
        </div>

        <div class="data-content">
            <?php the_content(); ?>
        </div>
    </div>
</div>