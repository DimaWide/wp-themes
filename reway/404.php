<?php

get_header();

$page_404    = get_field('404_page', 'option');
$tagline     = $page_404['tagline'];
$title       = $page_404['title'];
$description = $page_404['description'];
$button_text = $page_404['button_text'];
?>
<!-- 404 -->
<div class="wcl-404-page wcl-acf-block-38" itemscope itemtype="https://schema.org/Article">
    <div class="data-container wcl-container">
        <h1 class="data-bg-text" itemprop="headline">
            404
        </h1>

        <?php if (!empty($tagline)) : ?>
            <div class="wcl-cmp-tagline data-tagline" itemprop="text">
                <?php echo $tagline; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($title)) : ?>
            <div class="wcl-cmp-title data-title-two" itemprop="alternativeHeadline">
                <?php echo $title; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($description)) : ?>
            <div class="wcl-cmp-info data-info">
                <div class="wcl-cmp-desc data-desc" itemprop="description">
                    <?php echo $description; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($button_text)) : ?>
            <div class="data-link">
                <a href="<?php echo wcl_get_current_site_url_lang(); ?>" class="wcl-cmp-button-two" itemprop="url">
                    <?php echo $button_text; ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>