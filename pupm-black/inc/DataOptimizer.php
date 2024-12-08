<?php



/* 
class DataOptimizer
 */
class DataOptimizer {
    private $data;
    public static $currentSolPrice = '';
    public $tableType;

    public function __construct(array $row, string $tableType = 'default') {
        global $current_sol_price; 
        self::$currentSolPrice = $current_sol_price; 

        $this->data = [
            'name'              => $row['name'] ?? 'N/A',                // Name
            'mint'              => $row['mint'] ?? 'N/A',                // CA
            'usd_market_cap'    => $row['usd_market_cap'] ?? 'N/A',      // USD 
            'symbol'            => $row['symbol'] ?? 'N/A',              // SYMBOL
            'sol_amount'        => $row['sol_amount'] ?? 'N/A',          // SOL
            'image_uri'         => $row['image_uri'] ?? 'N/A',           // Image
            'tabletka'          => $row['tabletka'] ?? '',               // Social link tabletka
            'twitter'           => $row['twitter'] ?? '',                // Social link twitter
            'telegram'          => $row['telegram'] ?? '',               // Social link telegram
            'website'           => $row['website'] ?? '',                // Social link website
            'market_cap'        => $row['market_cap'] ?? 'N/A',   // Marketcap
            'holders_count'     => $row['holders_count'] ?? 'N/A',       // Holders
            'reply_count'       => $row['reply_count'] ?? 'N/A',         // Replies
            'created_timestamp' => $row['created_timestamp'] ?? 'N/A',   // Launch
            'buy_link_1'        => $row['buy_link_1'] ?? '',             // Buy links 1
            'buy_link_2'        => $row['buy_link_2'] ?? '',             // Buy links 2
            'buy_link_3'        => $row['buy_link_3'] ?? '',             // Buy links 3
            'buy_link_4'        => $row['buy_link_4'] ?? '',             // Buy links 4
            'market_cap_usd'    => $row['market_cap_usd'] ?? '',         // market_cap_usd
        ];

        $this->tableType = $tableType;
    }


    // get
    public function get($key) {
        return $this->data[$key] ?? '';
    }


    // formatMarketCap
    public function formatMarketCap() {
        $market_cap = $this->get('usd_market_cap');

        if ($this->tableType == 'DexPaid') {
            $market_cap = $this->get('market_cap_usd');
        }
        
        if ($market_cap) {
            // Преобразуем значение в float для предотвращения ошибок
            $market_cap = floatval($market_cap);
            $market_cap = number_format($market_cap, 0, ',', ' ') . 'k';
            $string = '$' . $market_cap;
            
            return $string;
        }
        
        return 'N/A';
    }


    // getTabletkaLink
    public function getTabletkaLink() {
        $mint = $this->get('mint');

        if (! empty($mint)) {
            $link = 'https://pump.fun/' . $mint;
            return $link;
        }

        return '';
    }


    // formatSolAmount
    public function formatSolAmount($withSign = false) {
        $sol_amount = $this->get('sol_amount');
        if (is_numeric($sol_amount)) {
            // Divide by 1,000,000,000
            $sol_amount = $sol_amount / 1000000000;

            // Format to two decimal places
            $sol_amount = number_format($sol_amount, 2);

            // Return with or without sign
            return ($withSign ? '+' : '') . $sol_amount . 'k';
        }
        return $sol_amount;
    }


    // formatUsdSolAmountBigBuys
    public function formatUsdSolAmountBigBuys() {
        $solAmount = (float)$this->data['sol_amount'];
        $solPrice = self::$currentSolPrice;

        if (!is_nan($solAmount) && $solPrice !== null) {
            $usdValue = ($solAmount / 1000000000) * $solPrice; // Calculate USD value
            return number_format($usdValue, 0) . 'k'; // Format to two decimal places
        }
        return null; // Return null if there is an issue
    }


    // getCaHtml
    public function getCaHtml() {
        $mint = $this->get('mint');
        $mint_cropped = substr($mint, 0, 4) . '...' . substr($mint, -4);

        ob_start();
?>
        <div class="data-b2-item-ca">
            <div class="data-b2-item-ca-field" data-mint="<?php echo $mint; ?>">
                <!-- aoPo...pump -->
                <?php echo $mint_cropped; ?>
            </div>
            <div class="data-b2-item-ca-btn">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/copy.svg'; ?>" alt="img">
                <div class="data-b2-item-ca-copy-notify">Copied</div>
            </div>
        </div>
    <?php
        $html = ob_get_clean();

        return $html;
    }





    // getSocialLinks
    public function getSocialLinks() {
        return [
            [
                'link'  => $this->getTabletkaLink(),
                'image' => 'social-tabletka.png',
                'key'   => 'tabletka'
            ],
            [
                'link'  => $this->get('twitter'),
                'image' => 'social-twitter.png',
                'key'   => 'twitter'
            ],
            [
                'link'  => $this->get('telegram'),
                'image' => 'social-telegram.png',
                'key'   => 'telegram'
            ],
            [
                'link'  => $this->get('website'),
                'image' => 'social-website.png',
                'key'   => 'website'
            ],
        ];
    }





    // getSocialLinksHtml
    public function getSocialLinksHtml() {
        $socialLinks = $this->getSocialLinks();

        ob_start();
    ?>
        <div class="data-b2-item-social">
            <?php foreach ($socialLinks as $item): ?>
                <?php
                $state = !empty($item['link']) ? 'mod-enabled' : 'mod-disabled';
                $icon = $item['image'];
                $key = $item['key'];
                ?>
                <div class="data-b2-item-social-item mod-<?php echo $key; ?> <?php echo $state; ?>">
                    <a href="<?php echo esc_url($item['link']); ?>" target="_blank" rel="noopener noreferrer">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/' . $icon; ?>" alt="img">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php

        return ob_get_clean();
    }





    // getBuyLinks
    public function getBuyLinks() {
        return [
            [
                'link'  => 'https://bullx.io/terminal?chainId=1399811149&address=' . $this->data['mint'] . '&r=K0AUT6R77CH',
                'image' => 'buy-links-1.png',
            ],
            [
                'link'  => 'https://t.me/paris_trojanbot?start=r-coinshill_up-' . $this->data['mint'],
                'image' => 'buy-links-2.png',
            ],
            [
                'link'  => 'https://photon-sol.tinyastro.io/en/r/@pumpblack/' . $this->data['mint'],
                'image' => 'buy-links-3.png',
            ],
            [
                'link'  => 'https://gmgn.ai/sol/token/SHQbIEUlt_' . $this->data['mint'],
                'image' => 'buy-links-4.png',
            ],
        ];
    }





    // getBuyLinksHtml
    public function getBuyLinksHtml() {
        $buyLinks = $this->getBuyLinks();

        ob_start();
    ?>
        <div class="data-b2-item-buy-links">
            <?php foreach ($buyLinks as $item): ?>
                <?php
                $state = 'mod-disabled';
                $url = $item['link'] ?? '';
                $imagePath = $item['image'] ?? '';

                if (!empty($url) && !empty($imagePath)) {
                    $state = 'mod-enabled';
                }
                ?>
                <div class="data-b2-item-buy-links-item <?php echo $state; ?>">
                    <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/' . $imagePath; ?>" alt="img">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <?php

        $html = ob_get_clean();
        return $html;
    }





    // getMarketCapBigBuys
    public function getMarketCapBigBuys() {
        $marketCap = $this->get('usd_market_cap');

        if ($marketCap) {
            // Преобразуем $marketCap в число
            $marketCap = floatval($marketCap);

            $roundedNumber = round($marketCap, 2);
            $formattedNumber = number_format($roundedNumber, 0, ',', ' ');
            $string = '$' . $formattedNumber;

            ob_start();
        ?>
            <div class="data-b2-item-marketcap">
                <?php echo $string; ?>
            </div>
<?php
            $html = ob_get_clean();

            return $html;
        }

        return '';
    }
}
