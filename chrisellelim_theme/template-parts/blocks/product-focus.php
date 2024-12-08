<?php
/**
 * Block Name: Product Focus
*/
?>
<?php $image_side = get_field('product_focus_image_side'); ?>
<?php if ( have_rows('product_focus_gp') ) : ?>
  <div class="cd-block cd-block-product-focus <?php echo $image_side; ?>">
    <?php while(have_rows('product_focus_gp')): the_row(); ?>
      <?php $product_info = get_sub_field('product_info'); ?>
      <?php if($product_info): ?>
        <div class="cd-block-product-info">
          <h3 class="cd-block-product-focus-title"><?=$product_info['name']; ?></h3>
          <div class="cd-block-product-focus-description">
            <?=$product_info['description']; ?>
          </div>
          <?php if($product_button = $product_info['button_gp']): ?>
            <div class="button-wrap">
              <a href="<?=$product_button['url']; ?>" class="cd-block-product-focus-button" target="_blank"><?=$product_button['label']; ?></a>
            </div>
          <?php endif; ?>
        </div>
        <div class="cd-block-product-thumbnail">
          <?php if($product_button): ?><a href="<?=$product_button['url']; ?>" target="_blank"><?php endif;?>
          <?php
            if ( $product_image = get_sub_field('image') ) {
              echo wp_get_attachment_image( $product_image,  'full', false, ["class" => "nopin"]);
            }
          ?>
          <?php if($product_button): ?></a><?php endif;?>
        </div>
      <?php endif; ?>
      
    <?php endwhile; ?>
  </div>
<?php endif; ?>
