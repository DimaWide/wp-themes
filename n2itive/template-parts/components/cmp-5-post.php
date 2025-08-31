<?php

$categories = get_the_category();
$image = get_the_post_thumbnail($post->ID, 'image-size-6');
?>
<div class="cmp-5-post <?php echo empty($image) ? 'mod-empty-img' : ''; ?>">
    <div class="cmp5-inner">
        <div class="cmp5-img">
            <a href="<?php echo get_permalink(); ?>">
                <?php if (! empty($image)): ?>
                    <?php echo $image; ?>
                <?php endif; ?>
            </a>
        </div>

        <div class="cmp5-info">
            <div class="cmp5-meta">
                <span class="post-author">By <?php echo get_the_author(); ?></span>
                | <span class="post-date"><?php echo get_the_date(); ?></span>
                | <span class="post-categories">
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) {
                        $max_categories = array_slice($categories, 0, 2);
                        $category_links = array_map(function ($category) {
                            return '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
                        }, $max_categories);
                        echo implode(', ', $category_links);
                    }
                    ?>
                </span>
                <?php if (get_the_tag_list()) : ?>
                    | <span class="post-tags">Tags: <?php echo get_the_tag_list('', ', '); ?></span>
                <?php endif; ?>
            </div>

            <h2 class="cmp5-title">
                <a href="<?php echo get_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h2>

            <div class="cmp5-desc">
                <?php if (!empty(get_the_excerpt())): ?>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                <?php else: ?>
                    <p><?php echo wp_trim_words(get_the_content(), 20, '...'); ?></p>
                <?php endif; ?>
            </div>

            <div class="cmp5-link">
                <a href="<?php the_permalink(); ?>" class="cmp-button">Read More</a>
            </div>
        </div>
    </div>
</div>