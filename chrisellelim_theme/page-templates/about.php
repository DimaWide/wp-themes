<?php

/**
 * Template Name: About Page
 */

get_header();

$shortcode = get_field('form_shortcode');
?>
<div class="wcl-contact">
    <div class="data-container wcl-container">
        <h1 class="data-title">
            <?php echo get_the_title(); ?>
        </h1>

        <div class="data-row">
            <div class="data-a data-col">
                <div class="data-col-inner">

                    <?php if (have_rows('contact_list', 'option')) : ?>
                        <?php
                        $counter = 0;
                        ?>
                        <ul class="data-list">
                            <?php while (have_rows('contact_list', 'option')) : the_row(); ?>
                                <?php
                                $counter++;
                                $label = get_sub_field('label');
                                $email  = get_sub_field('email');
                                if ($counter > 2) {
                                    continue;
                                }
                                ?>
                                <div class="data-list-item">
                                    <span class="data-list-item-label">
                                        <?php echo $label; ?>
                                    </span>

                                    <a href="mailto:<?php echo $email; ?>" class="data-list-item-link">
                                        <?php echo $email; ?>
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if (have_rows('contact_list', 'option')) : ?>
                        <?php
                        $counter = 0;
                        ?>
                        <ul class="data-list">
                            <?php while (have_rows('contact_list', 'option')) : the_row(); ?>
                                <?php
                                $counter++;
                                $label = get_sub_field('label');
                                $email  = get_sub_field('email');
                                if ($counter < 3) {
                                    continue;
                                }
                                ?>
                                <div class="data-list-item">
                                    <span class="data-list-item-label">
                                        <?php echo $label; ?>
                                    </span>

                                    <a href="mailto:<?php echo $email; ?>" class="data-list-item-link">
                                        <?php echo $email; ?>
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="data-b data-col">
                <div class="data-col-inner">
                    <h2 class="data-b-title">
                        Send a message
                    </h2>

                    <?php if (!empty($shortcode)) : ?>
                        <div class="data-b-form">
                            <?php echo do_shortcode($shortcode); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
