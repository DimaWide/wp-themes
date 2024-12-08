
<?php


$mailchimp           = get_field('mailchimp', 'option');
$mailchimp_title     = $mailchimp['title'];
$mailchimp_shortcode = $mailchimp['shortcode'];
?>
<div class="wcl-section-6 mod-two">
    <div class="data-container wcl-container">
        <div class="data-inner">
            <div class="data-inner-b">
                <div class="data-row">
                    <div class="data-col">
                    </div>

                    <div class="data-col">
                        <?php if (!empty($mailchimp_title)) : ?>
                            <h2 class="data-title">
                              <?php echo $mailchimp_title; ?>
                            </h2>
                        <?php endif; ?>
                    </div>

                    <div class="data-col">
                        <?php if (!empty($mailchimp_shortcode)) : ?>
                            <div class="data-form">
                                <?php echo do_shortcode($mailchimp_shortcode); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>