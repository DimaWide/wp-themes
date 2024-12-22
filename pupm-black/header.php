<!DOCTYPE html>
<html <?php echo get_language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo wp_get_document_title(); ?></title>

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <meta name="cryptomus" content="2a6f6c30" />

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>


    <!-- 
	====================================================================
		DEVELOPED BY WebComplete (webcomplete.io)
	====================================================================
	 -->



    <?php
    $telegram_link = get_field('telegram_link', 'option');
    ?>
    <?php if (! is_front_page()): ?>
        <div id="tsparticles" class="wcl-tsparticles"></div>
    <?php endif; ?>

    <div class="wcl-body-inner">
        <div class="sct-decoration">
            <div class="data-container wcl-container">
                <div class="data-circles mod-1">
                    <div class="data-circles-item"></div>
                    <div class="data-circles-item"></div>
                    <div class="data-circles-item"></div>
                </div>

                <div class="data-circles mod-2">
                    <div class="data-circles-item"></div>
                    <div class="data-circles-item"></div>
                    <div class="data-circles-item"></div>
                </div>
            </div>

            <div class="data-b1" style="display: none;">
                <div class="data-b1-item">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/1-2-left.png'; ?>" alt="img">
                </div>

                <div class="data-b1-item">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/1-1-right.png'; ?>" alt="img">
                </div>
            </div>
        </div>

        <div class="sct-header">
            <div class="data-container wcl-container">
                <div class="data-row">
                    <div class="data-col">
                        <div class="data-logo">
                            <a href="<?php echo site_url(); ?>">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/logo.svg'; ?>" alt="img">
                            </a>
                        </div>
                    </div>

                    <div class="data-col">
                        <div class="data-btns">
                            <div class="data-btns-item">
                                <?php if (! empty($telegram_link)): ?>
                                    <a href="<?php echo esc_url($telegram_link); ?>" target="_blank" rel="noopener noreferrer">
                                        Сontact
                                    </a>
                                <?php endif; ?>
                            </div>

                            <div class="data-btns-item">
                                <a href="<?php echo site_url('/') . 'order'; ?>">
                                    Advertise
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>