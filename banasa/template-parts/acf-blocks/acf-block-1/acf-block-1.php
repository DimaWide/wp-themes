<?php

if (display_preview_image($block)) {
   return;
}

?>
<!-- Acf Block #1 – Hero -->
<div class="wcl-acf-block-1 mod-section-animate">
   <div class="data-container wcl-container">
      <?php if (have_rows('slider')) : ?>
         <div class="data-slider-out">
            <div class="data-slider swiper">
               <div class="data-slider-inner swiper-wrapper">
                  <?php while (have_rows('slider')) : the_row(); ?>
                     <?php
                     $text = get_sub_field('text');
                     $link = get_sub_field('link');

                     $type_media = get_sub_field('type_media');
                     $type_media = !empty($type_media) ? $type_media : 'image';

                     if ($type_media == 'image') {
                        $image = get_sub_field('image');
                        $image = wp_get_attachment_image($image, 'image-size-1');
                     }
                     ?>
                     <div class="data-item swiper-slide">
                        <div class="data-item-inner">
                           <div class="data-item-media">
                              <?php if ($type_media == 'image') : ?>
                                 <?php if (!empty($image)) : ?>
                                    <div class="data-item-img">
                                       <?php echo $image; ?>
                                    </div>
                                 <?php endif; ?>
                              <?php elseif ($type_media == 'video') : ?>
                                 <?php if (have_rows('video')) : ?>
                                    <div class="data-item-video">
                                       <?php while (have_rows('video')) : the_row(); ?>
                                          <?php
                                          $preview_image = get_sub_field('preview_image');
                                          $preview_image = wp_get_attachment_image($preview_image, 'image-size-1');
                                          $video_id      = get_sub_field('video');
                                          ?>
                                          <?php if (!empty($video_id)) : ?>
                                             <div class="data-video mod-pause ">
                                                <div class="data-video-preview">
                                                   <?php if (!empty($preview_image)) : ?>
                                                      <?php echo $preview_image; ?>
                                                   <?php endif; ?>
                                                </div>

                                                <?php
                                                $video_url = wp_get_attachment_url($video_id);
                                                ?>
                                                <?php if (!empty($video_url)) : ?>
                                                   <video loop playsinline>
                                                      <source src="<?php echo $video_url; ?>" type="video/mp4">
                                                   </video>

                                                   <div class="data-video-play-btn">
                                                      <img src="<?php echo get_stylesheet_directory_uri() . '/img/play-btn.svg'; ?>" alt="img">
                                                   </div>
                                                <?php endif; ?>
                                             </div>
                                          <?php endif; ?>
                                       <?php endwhile; ?>
                                    </div>
                                 <?php endif; ?>
                              <?php endif; ?>
                           </div>

                           <div class="data-item-info">
                              <?php if (!empty($link)) : ?>
                                 <a href="<?php echo $link; ?>" class="data-item-info-text">
                                    <?php if (!empty($text)) : ?>
                                       <?php echo $text; ?>
                                    <?php endif; ?>
                                 </a>
                              <?php else : ?>
                                 <?php if (!empty($text)) : ?>
                                    <div class="data-item-info-text">
                                       <?php echo $text; ?>
                                    </div>
                                 <?php endif; ?>
                              <?php endif; ?>
                           </div>
                        </div>
                     </div>
                  <?php endwhile; ?>
               </div>
            </div>

            <div class="data-slider-nav">
               <div class="data-slider-nav-btn mod-prev">
                  <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/arrow-long-right.svg', false); ?>
               </div>

               <div class="data-slider-nav-btn mod-next">
                  <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/arrow-long-right.svg', false); ?>
               </div>
            </div>
         </div>
      <?php endif; ?>
   </div>
</div>