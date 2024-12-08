<?php

$post_permalink = urlencode(get_permalink());
$post_title     = get_the_title();
?>
<div class="tmp-1-share-post data-share-post">
    <div class="tmp1-inner">
        <div class="tmp1-label">
            Поділитись новиною
        </div>

        <div class="tmp1-list">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_permalink; ?>" target="_blank" rel="noopener noreferrer" class="tmp1-facebook">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/share/facebook.svg'; ?>" alt="img">
            </a>

            <a href="https://twitter.com/intent/tweet?url=<?php echo $post_permalink; ?>&text=<?php echo $post_title; ?>" target="_blank" rel="noopener noreferrer" class="tmp1-twitter">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/share/x-twitter.svg'; ?>" alt="img">
            </a>

            <a href="https://www.linkedin.com/shareArticle?url=<?php echo $post_permalink; ?>&title=<?php echo $post_title; ?>" target="_blank" rel="noopener noreferrer" class="tmp1-linkedin">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/share/linked-in.svg'; ?>" alt="img">
            </a>
        </div>
    </div>
</div>