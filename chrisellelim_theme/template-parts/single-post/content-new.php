<?php if(have_posts()): ?>
    <?php while(have_posts()): the_post(); ?>
        <?php 
            $category               = get_main_cat( $post ); 
            $main_post              = $post;
            $full_banner_overlapped = get_field('full_banner_overlapped') ? 'full-banner-overlapped': '';
            $is_full_banner         = get_field('general_full_width_featured') ? 'full':               'original';
            $video                  = get_post_meta( $post->ID, '_post_big_video', true); 
            $nextPost               = get_next_post();
            $prevPost               = get_previous_post();
        ?>

        <div class="post-container" data-next="<?php echo !empty($nextPost) ? get_the_permalink( $nextPost) : ''; ?>">
            <?php if( (get_field('show_portrait_as_main_banner')) && !$video): ?>
                <div class="featured-portrait-banner">
                    <?php
                        if($prevPost) {
                            $postLink = get_the_permalink( $prevPost->ID );
                            postHeaderNavigation($prevPost->ID, 'featured-portrait-prev');
                            echo "<div class='featured-portrait-arrow featured-portrait-prev-arrow'><a href='{$postLink}' rel='prev'><i class='fa fa-long-arrow-left'></i><span>Last Post</span></a></div>";
                        }
                        postHeaderNavigation(get_the_ID(), 'featured-portrait-current');
                        if($nextPost) {
                            $postLink = get_the_permalink( $nextPost->ID );
                            echo "<div class='featured-portrait-arrow featured-portrait-next-arrow'><a href='{$postLink}' rel='next'><i class='fa fa-long-arrow-right'></i><span>Next Post</span></a></div>";
                            postHeaderNavigation($nextPost->ID, 'featured-portrait-next');
                        }
                    ?>
                </div>
            <?php endif;?>
        
            <div class="single-post-body">
                <?php if( (get_field('full_banner_overlapped')  && !get_field('show_portrait_as_main_banner'))): ?>
                    <div class='featured-image featured-image-size-<?php echo $is_full_banner; ?> <?=$full_banner_overlapped;?>'>
                        <?php the_post_thumbnail( 'full', ['class' => 'nopin']); ?>
                    </div>
                    <div class="full-banner-meta article-intro">
                        <h2>
                            <a href='<?php echo get_term_link( $category ); ?>'>
                                <?php echo $category->name; ?>
                            </a> 
                            <?php echo exsite_time_ago( $post->post_date ); ?>
                        </h2>
                        <h1>
                            <?php if(get_field('full_banner_custom_title')): ?>
                                <?php echo get_field('full_banner_custom_title'); ?>
                            <?php else: ?>
                                <?php echo $post->post_title; ?>
                            <?php endif; ?>
                        </h1>
                        <?php if(get_field('full_banner_custom_excerpt') || has_excerpt()): ?>
                            <div class="full-banner-custom-excerpt">
                                <?php 
                                    if(get_field('full_banner_custom_excerpt'))  {
                                        the_field('full_banner_custom_excerpt');
                                    }
                                    else {
                                        the_excerpt();
                                    }
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif;?>
        
                <article class="single-post" data-next="<?php echo !is_null($nextPost) ? get_the_permalink( $nextPost) : ''; ?>">
                    <div class="post-wrapper">
                        <div class='wrapper'>
                            <?php if( (!get_field('full_banner_overlapped') || get_field('full_banner_overlapped') === null) || ($video && !get_field('full_banner_overlapped'))): ?>
                                <div class='article-intro'>
                                    <?php if(!get_field('full_banner_overlapped') || get_field('full_banner_overlapped') === null): ?>
                                        <h2>
                                            <a href='<?php echo get_term_link( $category ); ?>'>
                                                <?php echo $category->name; ?>
                                            </a> 
                                            <?php echo exsite_time_ago( $post->post_date ); ?>
                                        </h2>
                                        <h1><?php echo $post->post_title; ?></h1>
                                    <?php endif;?>
                                    
                                    <?php 
                                        require_once '_inc/Mobile_Detect.php';
                                        $detect = new Mobile_Detect;
                                        
                                        if( $detect->isMobile() && !$detect->isTablet() )
                                        {
                                            $mobile_video = get_post_meta( $post->ID, '_post_mobile_article_video', true);
                                            if($mobile_video)
                                                $video = $mobile_video;
                                        }
                                    ?>
                            
                                    <?php if($video): ?>
                                        <video autoplay loop muted playsinline>
                                            <source src="<?php echo $video; ?>">
                                        </video>
                                    <?php else: ?>
                                        <?php if(has_post_thumbnail() && !get_field('show_portrait_as_main_banner') && !get_field('full_banner_overlapped')): ?>
                                            <div class='featured-image featured-image-size-<?php echo $is_full_banner; ?>'>
                                                <?php the_post_thumbnail( 'full', ['class' => 'nopin']); ?>
                                            </div>
                                        <?php endif;?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class='wrapper'>
                            <?php global $shop_products; ?>
                            <?php $shop_products = array(); ?>
                            <div class='article-content'>
                                <?php
                                    if(post_password_required() || is_preview()) {
                                        the_content();
                                    }
                                    else {
                                        the_content();
                                       // echo exsite_images_check(apply_filters('the_content', $post->post_content));
                                    }
                                ?>
                                <?php $credits_meta = get_post_meta( get_the_ID(), 'credits', true );
                                if( ! empty( $credits_meta ) ) { ?>
                                <h4>Credits:</h4>
                                <?php echo do_shortcode($credits_meta); ?>
                                <?php } ?>
                            </div>
                            
                            <?php if(get_post_meta($post->ID,'_post_products_hide', true) != 'on'): ?>
                                <?php
                                    $products = get_post_meta($post->ID,'_post_products', true); 
                                    if($products)
                                        foreach($products as $product_id)
                                            $shop_products[$product_id] = $product_id;
                                ?>
                                
                                <?php if($shop_products && !post_password_required()): ?>
                                    <div class='post-slider'>
                                        <h2>Shop The Post</h2>
                                        <div class='slider outro-slider'>
                                            <div class='mob-hide'>
                                                <h2>Shop The Post</h2>
                                            </div>
                                            <?php foreach($shop_products as $shop_product_id): ?>
                                                <?php $product = get_post($shop_product_id); ?>
                                                <?php $link = get_post_meta( $product->ID, 'link', true ); ?>
                                                <?php $brand = get_post_meta( $product->ID, 'brand', true ); ?>
                                                <div class='slide'>
                                                    <a href='<?php echo $link; ?>' target="_blank">
                                                        <?php $image = exsite_image_resize(get_post_thumbnail_id($product->ID), '350x150', false); ?>
                                                        <img class="no-wrap" src="<?php echo $image; ?>">
                                                    </a>
                                                    <div class='content'>
                                                        <h3><a href='<?php echo $link; ?>' target="_blank"><?php echo $brand; ?></a></h3>
                                                        <h2><a href='<?php echo $link; ?>' target="_blank"><?php echo $product->post_title; ?></a></h2>
                                                        <a href='<?php echo $link; ?>' target="_blank">Get It <svg class='arrow-right'><use xlink:href="#arrow-right"></use></svg></a>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </article>
        
  
            </div>
        </div>


    <?php endwhile; ?>
<?php endif; ?>
