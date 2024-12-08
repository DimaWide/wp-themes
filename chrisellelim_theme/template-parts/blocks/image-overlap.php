<?php
/**
 * Block Name: Image + Text overlap
*/
?>
<?php if ( $block_image_overlap_img = get_field('block_image_overlap_img') ): ?>
  <div class="cd-block cd-block-image-overlap">
    <figure class="cd-block-image-overlap-img">
      <?php
        if ( $block_image_overlap_img ) {
          echo wp_get_attachment_image( $block_image_overlap_img, 'full', false, ['class' => 'nopin'] );
        }
      ?>
      <?php if ( have_rows('block_text_overlap_gp') ) : ?>
        <figcaption class="cd-block-image-overlap-text">
          <?php while( have_rows('block_text_overlap_gp') ) : the_row(); ?>
            <h2 class="cd-block-image-overlap-title"><?php the_sub_field('title'); ?></h2>
            <div class="cd-block-image-overlap-description">
              <?php the_sub_field('description'); ?>
            </div>
          <?php endwhile; ?>
        </figcaption>
      <?php endif; ?>
    </figure>
  </div>
<?php endif; ?>
