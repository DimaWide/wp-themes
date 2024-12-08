<?php


$url   = get_permalink();
$title = get_the_title();
$image = get_the_post_thumbnail_url($post->ID, 'image-size-2');
?>
<div class="wcl-share-media">
    <div class="data-container">
        <div class="data-list">
            <div class="data-item mod-facebook">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" target="_blank">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
            </div>

            <div class="data-item mod-twitter">
                <a href="https://twitter.com/share?text=[post-title]&url=<?php echo $url; ?>&via=<?php echo $title; ?>" target="_blank">
                    <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/ico-x-twitter.svg', false); ?>
                </a>
            </div>

            <div class="data-item mod-pinterest">
                <a href="https://pinterest.com/pin/create/button/?url=<?php echo $url; ?>&media=<?php echo $image; ?>&description=<?php echo $title; ?>" target="_blank">
                    <i class="fa-brands fa-pinterest"></i>
                </a>
            </div>

            <div class="data-item mod-whatsapp">
                <a href="<?php echo 'whatsapp://send?text=' . $title . ' ' . $url; ?>" target="_blank">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
            </div>

            <div class="data-item mod-massenger">
                <a href="https://www.facebook.com/dialog/send?app_id=244819978951470&display=popup&link=http%3A%2F%2Floc.best-of-bali-2%2F22-best-museums-in-bali%2F&redirect_uri=http%3A%2F%2Floc.best-of-bali-2%2F22-best-museums-in-bali/" target="_blank">
                    <i class="fa-brands fa-facebook-messenger"></i>
                </a>
            </div>
        </div>
    </div>
</div>