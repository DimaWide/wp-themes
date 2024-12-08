<?php

$title = get_sub_field('title');
$list = get_sub_field('list');

?>
<div class="wcl-section-33 wcl-section-4 mod-b">
    <div class="data-container wcl-container">
        <?php if (!empty($title)) : ?>
            <h2 class="data-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <?php 
        if( !empty($list) ) {
            $count = 0;
            ?>

            <div class="data-list">
                <?php
                foreach ($list as $list_item) {

                    $count++;
                    $align = 'left';
                    if ($count % 2 == 0) {
                        $align = 'right';
                    }
                    $args =  array(
                        'align' => $align,
                        'list_item' => $list_item,
                    );
                    
                    get_template_part('template-parts/section-4/item-mod-b', null, $args);
                    
                }
                ?>
            </div>
            
            <?php
        }
        ?>
    </div>
</div>