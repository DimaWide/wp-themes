<?php

/**
 * Template Name: SC Portal Page
 */


if (!wcl_is_subscriber()) {
   wp_redirect(home_url());
   exit();
}

$user = wp_get_current_user();

get_header();
?>
<div class="wcl-t7-bg"></div>

<div class="wcl-portal-sc-1">
   <div class="data-container wcl-container">
      <div class="data-avatar">
         <?php echo get_avatar(wp_get_current_user()->ID, 90); ?>
      </div>

      <h1 class="data-title">
         <span>Welcome<span>&nbsp;Back</span>, </span>
         <?php echo $user->first_name; ?>
      </h1>

      <div class="data-nav">
         <div class="data-nav-item">
            <a href="<?php echo site_url('/') . 'stories'; ?>" class="wcl-link">
               Stories
               <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
            </a>
         </div>

         <div class="data-nav-item">
            <a href="<?php echo site_url('/') . 'category/splendor-collective/splendor-collective-guides/'; ?>" class="wcl-link">
               Guides
               <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
            </a>
         </div>

         <div class="data-nav-item">
            <div class="wcl-t1-search">
               <div class="t1-inner">
                  <form class="t1-inner-b" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                     <input type="text" name="s" placeholder="What are you looking for?" value="<?php echo esc_attr(get_search_query()); ?>">

                     <button type="submit">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/search_icon.svg'; ?>" alt="img">
                     </button>
                  </form>
               </div>
            </div>
         </div>

         <div class="data-nav-item">
            <a href="<?php echo site_url('/') . 'shopping/'; ?>" class="wcl-link">
               Shop
               <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
            </a>
         </div>

         <div class="data-nav-item">
            <a href="#" class="wcl-link">
               Community
               <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
            </a>
         </div>
      </div>
   </div>
</div>


<?php
$page_items = 4;
$paged      = $_POST['paged'] ? $_POST['paged'] : 1;
$offset     = ($paged - 1) * $page_items;

$args = array(
   'post_type'      => 'post',
   'posts_per_page' => $page_items,
   'offset'         => $offset,
   'post_status'    => 'publish',
);

$args['tax_query'] = [
   array(
      'taxonomy' => 'category',
      'field'    => 'slug',
      'terms'    => 'splendor-collective',
   ),
];

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
$pages_el    = ceil(($total_count - $offset) / $page_items);

$empty_posts_class = '';
if (empty($query_obj->posts)) {
   $empty_posts_class = 'mod-empty-posts';
}
?>
<div class="wcl-portal-sc-2 wcl-stories-sc-2 mod-e2<?php echo $empty_posts_class; ?>">
   <div class="data-container wcl-container">
      <h2 class="data-title">
         Sc exclusive.
      </h2>

      <div class="data-nav">
         <div class="data-nav-label">
            Sort by:
         </div>

         <div class="data-nav-list">
            <div class="data-nav-list-inner">
               <div class="data-nav-item active" data-id="most-recent">
                  <span>Most Recent</span>
               </div>

               <?php
               $cats = get_terms([
                  'taxonomy'   => 'category',
                  'hide_empty' => false,
                  'include'    => CATS_EXCLUSIVE,
                  'orderby'    => 'include',
               ]);
               ?>
               <div class="data-nav-item" data-id="category">
                  <span>Category</span>

                  <div class="data-nav-cats">
                     <?php foreach ($cats as $key => $term) : ?>
                        <?php
                        $name = get_field('name', 'term_' . $term->term_id);
                        $active = '';
                        if ($key === 0) {
                           $active = 'active';
                        }
                        ?>
                        <div class="data-nav-cats-item <?php echo $active; ?>">
                           <a href="<?php echo get_term_link((int)$term->term_id); ?>" data-id="<?php echo $term->slug; ?>">
                              <?php echo $name; ?>
                           </a>
                        </div>
                     <?php endforeach; ?>
                  </div>
               </div>

               <div class="data-nav-item" data-id="most-popular">
                  <span> Most Popular</span>
               </div>
            </div>

            <div class="data-nav-line"></div>
         </div>
      </div>

      <div class="data-list">
         <?php if ($query_obj->have_posts()) : ?>
            <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
               <?php get_template_part('template-parts/stories/item'); ?>
            <?php endwhile;
            wp_reset_postdata(); ?>
         <?php else : ?>
            <div class="data-list-empty wcl-label-empty">
               Nothing found
            </div>
         <?php endif; ?>
      </div>

      <div class="data-btns">
         <div class="data-btns-item">
            <?php if ($_SERVER["SERVER_ADDR"] == '127.0.0.1') : ?>
               <a href="<?php echo get_term_link((int)CATS_EXCLUSIVE_ASSOC['splendor-collective-stories']); ?>" class="wcl-link">
                  All Stories
                  <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
               </a>
            <?php else : ?>
               <a href="<?php echo get_term_link((int)CATS_EXCLUSIVE_ASSOC['splendor-collective']); ?>" class="wcl-link">
                  All Stories
                  <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
               </a>
            <?php endif; ?>
         </div>

         <div class="data-btns-item">
            <a href="<?php echo get_term_link((int)CATS_EXCLUSIVE_ASSOC['splendor-collective-guides']); ?>" class="wcl-link">
               All Guides
               <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
            </a>
         </div>

         <div class="data-btns-item">
            <a href="<?php echo get_term_link((int)CATS_EXCLUSIVE_ASSOC['shopping-lists']); ?>" class="wcl-link">
               All Lists
               <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
            </a>
         </div>
      </div>
   </div>
</div>



<?php
if (have_rows('page_content')) {
   while (have_rows('page_content')) {
      the_row();

      if (get_row_layout() == 'section_1') {
         get_template_part('template-parts/section-1');
      } elseif (get_row_layout() == 'section_2') {
         get_template_part('template-parts/section-2');
      } elseif (get_row_layout() == 'section_3') {
         get_template_part('template-parts/section-3');
      } elseif (get_row_layout() == 'section_4') {
         get_template_part('template-parts/section-4');
      } elseif (get_row_layout() == 'section_5') {
         get_template_part('template-parts/section-5');
      } elseif (get_row_layout() == 'section_6') {
         get_template_part('template-parts/section-6');
      } elseif (get_row_layout() == 'section_7') {
         get_template_part('template-parts/section-7');
      } elseif (get_row_layout() == 'section_8') {
         get_template_part('template-parts/section-8');
      } elseif (get_row_layout() == 'section_9') {
         get_template_part('template-parts/section-9');
      } elseif (get_row_layout() == 'section_10') {
         get_template_part('template-parts/section-10');
      } elseif (get_row_layout() == 'section_11') {
         get_template_part('template-parts/section-11');
      } elseif (get_row_layout() == 'section_12') {
         get_template_part('template-parts/section-12');
      } elseif (get_row_layout() == 'section_13') {
         get_template_part('template-parts/section-13');
      } elseif (get_row_layout() == 'section_14') {
         get_template_part('template-parts/section-14');
      } elseif (get_row_layout() == 'section_15') {
         get_template_part('template-parts/section-15');
      } elseif (get_row_layout() == 'section_16') {
         get_template_part('template-parts/section-16');
      } elseif (get_row_layout() == 'section_17') {
         get_template_part('template-parts/section-17');
      } elseif (get_row_layout() == 'section_18') {
         get_template_part('template-parts/section-18');
      } elseif (get_row_layout() == 'section_19') {
         get_template_part('template-parts/section-19');
      } elseif (get_row_layout() == 'section_20') {
         get_template_part('template-parts/section-20');
      } elseif (get_row_layout() == 'section_21') {
         get_template_part('template-parts/section-21');
      } elseif (get_row_layout() == 'section_22') {
         get_template_part('template-parts/section-22');
      } elseif (get_row_layout() == 'section_23') {
         get_template_part('template-parts/section-23');
      } elseif (get_row_layout() == 'section_24') {
         get_template_part('template-parts/section-24');
      }
   }
}

get_footer();
?>