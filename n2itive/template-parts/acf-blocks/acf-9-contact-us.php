<?php


$description  = get_field('description');
$contact_info = get_field('contact_info');
$note         = get_field('note');
?>
<!-- acf-9-contact-us -->
<div class="acf-9-contact-us">
    <div class="data-container wcl-container">
        <div class="data-inner-out">
            <div class="data-img">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf-9-logo.svg'; ?>" alt="img">
            </div>

            <div class="data-inner">
                <?php if (!empty($description)) : ?>
                    <div class="data-desc">
                        <?php echo $description; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($contact_info)) : ?>
                    <div class="data-info">
                        <div class="data-info-ico">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/time-circle.svg'; ?>" alt="img">
                        </div>

                        <div class="data-info-text">
                            <?php echo $contact_info; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($note)) : ?>
                    <div class="data-note">
                        <?php echo $note; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>