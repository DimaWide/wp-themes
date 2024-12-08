<?php

$title   = get_sub_field('title');
$form_id = get_sub_field('form_id');
?>
<div class="wcl-section-13 wcl-flodesk">
    <div class="data-container wcl-container">
        <?php if (!empty($title)) : ?>
            <h2 class="data-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <div class="data-form">
            <div class="flodesk-form">
                <div class="fd-ef-6065f206568cfe3b519983f8">
                    <div class="ff__root">
                        <div class="ff__container">
                            <form class="ff__form" action="https://form.flodesk.com/submit" method="post" data-form="fdv2" autocomplete="nope">
                                <div class="ff__fields">
                                    <input type="text" name="name" value="" style="display: none" />
                                    <input type="hidden" name="submitToken" value="0a9959d43bcccec88b5c9c01d70bfc2d46e53e2c1a0ca7e7ed6b42a3c919e008f5d00ebed3a9ece8480b704d68aa2478d7f344b88eed8a8f789773fdc5fc4a315ba1f8f08203063f67925d0f5056060dc1dbcd0db5c04331e5a4fde10ba3dab8" />
                                    <div class="ff__grid">
                                        <div class="ff__group">
                                            <div class="ff-field">
                                                <label for="firstName">First name</label>
                                                <input class="fd-form-control ff__control" type="text" name="firstName" id="firstName" autocomplete="nope">
                                            </div>

                                            <div class="ff-field">
                                                <label for="email">Email address</label>
                                                <input class="fd-form-control ff__control" type="text" name="email" id="email" autocomplete="nope">
                                            </div>
                                        </div>

                                        <div class="ff__submit">
                                            <button type="submit" class="fd-btn ff__button view-more" data-form-el="submit">
                                                <span>Subscribe</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="fd-success ff__success" data-form-el="success">
                                    <p>Thank you for subscribing!</p>
                                </div>

                                <div class="fd-error ff__error" data-form-el="error"></div>
                            </form>
                        </div>
                    </div>

                    <img height="1" width="1" style="display:none" src="https://t.flodesk.com/utm.gif?r=6065f206568cfe3b519983f8" />
                    <script src="https://assets.flodesk.com/form.js?v=1617293863253"></script>
                </div>
            </div>
        </div>
    </div>
</div>