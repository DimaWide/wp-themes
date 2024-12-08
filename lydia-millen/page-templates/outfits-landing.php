<?php

/**
 * Template Name: Outfits Landing Page
 */

get_header();

$post_date   = date("Y-M");
$has_post    = '';
$count_month = 3;
?>
<div class="wcl-outfits-p">
    <h1 class="data-title">
        Shop all outfits
    </h1>

    <div class="data-a">
        <div class="data-a-container wcl-container">
            <?php
            while ($count_month > 0) {
                $posts     = posts_landing_page_render_month($post_date, '', 'cd-outfit');
                $post_date = $posts['post_date'];
                $post_date = date("Y-M", strtotime('-1 month', strtotime($post_date)));

                if (!empty($posts)) {
                    $count_month--;
                    echo $posts['posts'];
                }

                $has_post = posts_landing_page_if_has_post($post_date, '', 'cd-outfit');
                if (empty($has_post)) {
                    break;
                }
            }
            ?>
        </div>
    </div>

    <div class="wcl-load-more">
        <div class="d2-container">
            <?php if (!empty($has_post)) : ?>
                <button class="d2-btn" data-post-date="<?php echo $post_date; ?>">
                    View More
                </button>
            <?php else : ?>
                <button class="d2-btn" data-post-date="<?php echo $post_date; ?>" disabled="true">
                    All Viewed
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
get_footer();
