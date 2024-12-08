<?php

get_header();


$page_404 = get_field('page_404', 'option');
$title    = $page_404['title'];
$link     = $page_404['link'];
?>

<!-- MAIN CONTENT -->
<main id="wcl-page-content" class="wcl-page-content">
    <div class="wcl-404">
        <div class="data-container wcl-container">
            <h1 class="data-title">
                404
            </h1>

            <?php if (!empty($title)) : ?>
                <div class="data-subtitle">
                    <?php echo $title; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($link)) : ?>
                <?php
                $link_url    = $link['url'];
                $link_title  = $link['title'];
                $link_target = $link['target'] ?: '_self';
                ?>
                <div class="data-link">
                    <a href="<?php echo $link_url; ?>" class="cmp-button" target="<?php echo $link_target; ?>">
                        <?php echo $link_title; ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main> <!-- #wcl-page-content -->

<?php
get_footer();
?>