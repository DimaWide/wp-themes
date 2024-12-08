<?php
/**
 * Block Name: 2 Images Overlapped
*/
?>
<?php 
  $quote = get_field('block_two_images_overlapped_quote');
  $quote_side = get_field('block_two_images_overlapped_quote_side');
  
?>
<?php if ( have_rows('block_two_images_overlapped_gp') ) : ?>
  <div class="cd-block cd-block-two-images-overlapped <?=$quote_side; ?>">
    <figure class="cd-block-two-images-overlapped-figure">
      <?php while( have_rows('block_two_images_overlapped_gp') ) : the_row(); ?>
        <?php
          if ( $image1 = get_sub_field('image1') ) {
            echo '<div class="cd-block-two-images-overlapped-i1">';
              echo wp_get_attachment_image( $image1,  'large', false, ['class' => 'nopin']);
            echo "</div>";
          }
          if ( $image2 = get_sub_field('image2') ) {
            echo '<div class="cd-block-two-images-overlapped-i2">';
              echo wp_get_attachment_image( $image2,  'large', false, ['class' => 'nopin']);
            echo "</div>";
          }
        ?>
        <?php if ( $quote ) : ?>
          <figcaption>
            <?php echo $quote; ?>
          </figcaption>
        <?php endif; ?>
      <?php endwhile; ?>
    </figure>
  </div>
<?php endif; ?>
