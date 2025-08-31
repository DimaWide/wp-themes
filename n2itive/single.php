<?php

get_header();


$author_name = get_the_author_meta('display_name', $post->post_author);
?>

<!-- MAIN CONTENT -->
<main id="wcl-page-content" class="wcl-page-content">

    <div class="sct-single">
        <div class="data-cotainer wcl-container">
            <div class="data-meta">
                <span class="post-author">By <?php echo $author_name; ?></span>
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

            <div class="data-row">
                <div class="data-col">
                    <div class="data-sidebar">
                        <div class="data-share">
                            <div class="data-share-title">
                                Please Share This, Choose Your Platform!
                            </div>

                            <div class="data-share-list">
                                <?php
                                $post_title = get_the_title();
                                $post_url = get_permalink();

                                $social_links = [
                                    'facebook'  => "https://www.facebook.com/sharer/sharer.php?u={$post_url}",
                                    'twitter-x' => "https://twitter.com/intent/tweet?url={$post_url}&text={$post_title}",
                                    'reddit'    => "https://reddit.com/submit?url={$post_url}&title={$post_title}",
                                    'linked-in' => "https://www.linkedin.com/shareArticle?mini=true&url={$post_url}&title={$post_title}",
                                    'tumblr'    => "https://www.tumblr.com/widgets/share/tool?canonicalUrl={$post_url}&title={$post_title}",
                                    'pinterest' => "https://pinterest.com/pin/create/button/?url={$post_url}&description={$post_title}",
                                    'mail'      => "mailto:?subject=" . rawurlencode($post_title) . "&body=" . rawurlencode($post_url),
                                ];

                                foreach ($social_links as $name => $url) : ?>
                                    <div class="data-share-item">
                                        <a href="<?php echo esc_url($url); ?>" class="data-share-item-link" target="_blank" rel="noopener noreferrer">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/social/' . $name . '.svg'; ?>" alt="<?php echo esc_attr($name); ?>">
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                        </div>

                        <div class="data-author">
                            <?php
                            $author_id = $post->post_author;
                            $user_description = get_the_author_meta('description', $author_id);
                            ?>
                            <div class="data-author-title">
                                About the Author: <br>
                                <span class="post-author"> <?php echo $author_name ?></span>
                            </div>

                            <div class="data-author-info">
                                <div class="data-author-image">
                                    <?php echo get_avatar($author_id, 96); ?>
                                </div>

                                <?php if (! empty($user_description)): ?>
                                    <div class="data-author-desc">
                                        <?php echo $user_description; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="data-col">
                    <div class="data-content cmp-content">
                        <h1 class="data-title">
                            <?php echo get_the_title(); ?>
                        </h1>

                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main> <!-- #wcl-page-content -->

<?php

get_footer();

?>