<?php
get_header();

?>

<!-- MAIN CONTENT -->
<main id="wcl-page-content" class="wcl-page-content">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <?php if (is_front_page()) : ?>
                <div class="wcl-page">
                    <div class="data-container">
                        <div class="data-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            <?php elseif (is_woocommerce_page()) : ?>
                <?php if (is_account_page() && is_user_logged_in()) : ?>
                    <div class="wcl-page mod-default">
                        <div class="data-container wcl-container">
                            <?php woocommerce_breadcrumb(); ?>

                            <h1 class="cmp-title mod-small page-title">
                                <span>Вітаємо, </span>
                                <span><?php echo $current_user->display_name; ?></span>
                            </h1>

                            <div class="data-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="wcl-page mod-start mod-woocommerce">
                        <div class="data-container wcl-container">
                            <?php if (is_checkout()) : ?>
                                <?php if (!empty(is_wc_endpoint_url('order-received'))) : ?>
                                    <?php woocommerce_breadcrumb(); ?>
                                <?php else : ?>
                                    <?php woocommerce_breadcrumb(); ?>
                                    <h1 class="cmp-title mod-small page-title">
                                        Оформлення замовлення
                                    </h1>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="data-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <div class="wcl-page mod-default mod-sidebar cmp-5-grid">
                    <div class="data-container wcl-container">
                        <div class="cmp5-row data-row">
                            <div class="cmp5-col data-col">
                                <?php get_template_part('template-parts/sidebar'); ?>
                            </div>

                            <div class="cmp5-col data-col">
                                <?php woocommerce_breadcrumb(); ?>

                                <div class="data-head">
                                    <h1 class="cmp-title data-title">
                                        <?php the_title(); ?>
                                    </h1>
                                </div>

                                <div class="data-content page-content">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php else : ?>
        <p><?php esc_html_e('No posts found'); ?></p>
    <?php endif; ?>
</main> <!-- #wcl-page-content -->

<?php
get_footer();
?>