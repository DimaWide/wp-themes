<?php
/**
 * Block Name: Product List
*/
?>
<?php $title = get_field('block_shop_list_title'); ?>
<?php if ( have_rows('block_shop_list_products') ) : ?>
  <div class="cd-block cd-block-shop-list">
    <?php if($title): ?>
      <h2 class="cd-block-shop-list-title"><?=$title; ?></h2>
    <?php endif;?>
    <ul class="cd-block-shop-list-products">
      <?php while(have_rows('block_shop_list_products')): the_row(); ?>
        <li class="cd-block-shop-list-item">
          <figure class="cd-block-shop-list-item-product">
            <?php if(get_sub_field('link')): ?><a href="<?php the_sub_field('link') ?>" target="_blank"><?php endif;?>
              <?php
                if ( $image = get_sub_field('image') ) {
                  echo wp_get_attachment_image( $image, 'large', false, ['class' => 'nopin'] );
                }
              ?>
            <?php if(get_sub_field('link')): ?></a><?php endif;?>
            <figcaption>
              <div class="cd-block-shop-list-item-product-name"><?php the_sub_field('name'); ?></div>
              <div class="cd-block-shop-list-item-product-description"><?php the_sub_field('description'); ?></div>
              <div class="cd-block-shop-list-item-product-price"><?php the_sub_field('price'); ?></div>
            </figcaption>
          </figure>
        </li>
      <?php endwhile; ?>
    </ul>
  </div>
<?php endif; ?>
