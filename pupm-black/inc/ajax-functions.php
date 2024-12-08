<?php




/**
 * project_load_posts
 */
function project_load_posts() {
    $mint  = isset($_POST['mint']) ? $_POST['mint'] : 'AnM6bkqJy3D4douPgp1keUTmQNygP2KKiM7bVw9qpump';
    $token = '';

    $token_name           = '';
    $token_usd_market_cap = '';
    $token_image_uri      = '';

    if ($mint) {
        if (is_local_dev_site()) {
            $token = get_option('test_token');
        } else {
            $token = getTokenDetails($mint);
        }

        if ($mint) {
            $token_name           = $token['name'];
            $token_usd_market_cap = $token['usd_market_cap'];
            $token_image_uri      = $token['image_uri'];

            $usd_market_cap_formatted = '$' . number_format($token_usd_market_cap, 2, '.', ',');
        }
    }

    ob_start();
?>
    <?php if (! empty($token)): ?>
        <div class="data-b1-img">
            <?php if ($token_image_uri): ?>
                <img src="<?php echo $token_image_uri; ?>" alt="img">
            <?php endif; ?>
        </div>

        <div class="data-b1-info">
            <div class="data-b1-name">
                <?php echo $token_name; ?>
            </div>

            <div class="data-b1-price">
                <?php echo $usd_market_cap_formatted; ?>
            </div>
        </div>
    <?php endif; ?>
<?php
    $output['token'] = ob_get_clean();
    $output['mint'] = $mint;

    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_project_load_posts', 'project_load_posts');
add_action('wp_ajax_nopriv_project_load_posts', 'project_load_posts');










/**
 * dex_paid_token_load
 */
function dex_paid_token_load() {
    $mint  = isset($_POST['mint']) ? $_POST['mint'] : 'AnM6bkqJy3D4douPgp1keUTmQNygP2KKiM7bVw9qpump';
    $token = '';
    $isDexPaid = '';

    $token_name           = '';
    $token_usd_market_cap = '';
    $token_image_uri      = '';

    if ($mint) {
        if (is_local_dev_site()) {
            $token = get_option('test_token');
            $isDexPaid = true;
        } else {
            $token     = getTokenDetails($mint);
            $isDexPaid = checkDexPaid($mint);
        }

        $token_name           = $token['name'];
        $token_usd_market_cap = $token['usd_market_cap'];
        $token_image_uri      = $token['image_uri'];

        $usd_market_cap_formatted = '$' . number_format($token_usd_market_cap, 2, '.', ',');
    }

    ob_start();
?>
    <?php if (! empty($token)): ?>
        <div class="data-col">
            <div class="data-img">
                <?php if ($token_image_uri): ?>
                    <img src="<?php echo $token_image_uri; ?>" alt="img">
                <?php endif; ?>
            </div>
        </div>

        <div class="data-col">
            <div class="data-list">
                <div class="data-list-item">
                    <div class="data-list-item-label">
                        Status:
                    </div>

                    <div class="data-list-item-value">
                        <div class="data-status">
                            <?php if ($isDexPaid === false): ?>
                                DEX NOT PAID
                            <?php else: ?>
                                <span>DEX PAID</span>
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/check-circle.svg'; ?>" alt="img">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="data-list-item">
                    <div class="data-list-item-label">
                        Name:
                    </div>

                    <div class="data-list-item-value">
                        <div class="data-name">
                            <!-- GOONER -->
                            <?php echo $token_name; ?>
                        </div>
                    </div>
                </div>

                <div class="data-list-item">
                    <div class="data-list-item-label">
                        Marketcap:
                    </div>

                    <div class="data-list-item-value">
                        <div class="data-marketcap">
                            <!-- $3259.94 -->
                            <?php echo $usd_market_cap_formatted; ?>
                        </div>
                    </div>
                </div>

                <div class="data-list-item">
                    <div class="data-list-item-label">
                        CA:
                    </div>

                    <div class="data-list-item-value">
                        <div class="data-name">
                            <div class="cmp-ca-item data-ca">
                                <div class="cmp-ca-item-field data-ca-field" data-mint="<?php echo $mint; ?>">
                                    <div class="data-ca-code"><?php echo format_mint_string($mint); ?></div>
                                </div>

                                <div class="cmp-ca-item-btn data-ca-btn">
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/copy.svg'; ?>" alt="img">
                                    <div class="cmp-ca-item-copy-notify data-ca-copy-notify">Copied</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="data-links">
                <div class="data-link">
                    <a href="<?php echo site_url('/'); ?>?section=check-dexscreener-paid-status" class="cmp-button">
                        <span>CHECK ANOTHER TOKEN</span>
                    </a>
                </div>

                <div class="data-link-2 data-btn-download">
                    <button>DOWNLOAD SCREENSHOT</button>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php
    $output['token'] = ob_get_clean();

    ob_start();
    ?>
    <?php if (! empty($token)): ?>
        <div class="data-col">
            <div class="data-img">
                <?php if ($token_image_uri): ?>
                    <img src="<?php echo $token_image_uri; ?>" alt="img">
                <?php endif; ?>
            </div>
        </div>

        <div class="data-col">
            <div class="data-list">
                <div class="data-list-item">
                    <div class="data-list-item-label">
                        Status:
                    </div>

                    <div class="data-list-item-value">
                        <div class="data-status">
                            <?php if ($isDexPaid === false): ?>
                                DEX NOT PAID
                            <?php else: ?>
                                <span>DEX PAID</span>
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/check-circle.svg'; ?>" alt="img">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="data-list-item">
                    <div class="data-list-item-label">
                        Name:
                    </div>

                    <div class="data-list-item-value">
                        <div class="data-name">
                            <!-- GOONER -->
                            <?php echo $token_name; ?>
                        </div>
                    </div>
                </div>

                <div class="data-list-item">
                    <div class="data-list-item-label">
                        Marketcap:
                    </div>

                    <div class="data-list-item-value">
                        <div class="data-marketcap">
                            <!-- $3259.94 -->
                            <?php echo $usd_market_cap_formatted; ?>
                        </div>
                    </div>
                </div>

                <div class="data-list-item">
                    <div class="data-list-item-label">
                        CA:
                    </div>

                    <div class="data-list-item-value">
                        <div class="data-name">
                            <div class="cmp-ca-item data-ca">
                                <div class="cmp-ca-item-field data-ca-field" data-mint="<?php echo $mint; ?>">
                                    <div class="data-ca-code"><?php echo format_mint_string($mint); ?></div>
                                </div>

                                <div class="cmp-ca-item-btn data-ca-btn">
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/copy.svg'; ?>" alt="img">
                                    <div class="cmp-ca-item-copy-notify data-ca-copy-notify">Copied</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="data-links">
                <div class="data-link">
                    <a href="#" class="cmp-button">
                        <span>CHECK OTHER TOKEN ON PUMP.BLACK</span>
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php
    $output['token_for_screenshot'] = ob_get_clean();
    $output['status_dex_paid'] = $isDexPaid;

    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_dex_paid_token_load', 'dex_paid_token_load');
add_action('wp_ajax_nopriv_dex_paid_token_load', 'dex_paid_token_load');
