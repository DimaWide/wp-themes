<?php


$title = get_sub_field('title');
?>
<div class="wcl-section-7">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-a">
                <div class="data-icon">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/section-7-icon.svg'; ?>" alt="img">
                </div>

                <?php if (!empty($title)) : ?>
                    <div class="data-title">
                        <?php echo $title; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-b wcl-subscribe">
                <form class="data-form" autocomplete="off">
                    <div class="data-form-group">
                        <div class="data-field">
                            <input type="name" name="name" placeholder="Your Name" required>
                        </div>

                        <div class="data-field">
                            <input type="email" name="email" placeholder="Email Address" required>
                        </div>

                        <div class="data-field">
                            <input type="submit" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>