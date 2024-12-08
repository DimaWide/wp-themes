<?php


?>
<div class="wcl-popup mod-review-form js-review-form" data-id="review-form">
    <div class="data-overlay"></div>

    <div class="data-inner-out">
        <div class="data-close js-close">
            <img src="<?php echo get_stylesheet_directory_uri() . '/img/close-popup.svg'; ?>" alt="img">
        </div>

        <div class="wcl-review-form cmp-6-form data-inner" id="review-form">
            <div class="data-container">
                <div class="data-title">
                    Залишити відгук
                </div>

                <form class="data-form cmp6-form">
                    <div class="cmp6-form-field">
                        <input type="text" name="name" placeholder="Ваше Ім'я" required>
                    </div>

                    <div class="data-form-b1">
                        <div class="data-avatar">
                            <input type="file" id="avatar" name="avatar" accept="image/*">

                            <label for="avatar">
                                <div class="data-avatar-preview">
                                    <div class="data-avatar-preview-bg">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/avatar.svg'; ?>" alt="img">
                                    </div>

                                    <div class="data-avatar-preview-img">
                                    </div>

                                    <span class="data-avatar-preview-edit">
                                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/pencil.svg', false); ?>
                                    </span>
                                </div>

                                <span class="data-avatar-label-text">Завантажити фото</span>
                            </label>
                        </div>

                        <div class="data-rating">
                            <input type="number" name="rating" required>

                            <div class="data-rating-label">
                                Загальна оцінка
                            </div>

                            <div class="data-rating-stars">

                                <div class="data-rating-item" data-value="1">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/star-filled.svg" alt="Empty Star" class="star-filled">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/star-empty.svg" alt="Filled Star" class="star-empty">
                                </div>
                                <div class="data-rating-item" data-value="2">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/star-filled.svg" alt="Empty Star" class="star-filled">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/star-empty.svg" alt="Filled Star" class="star-empty">
                                </div>
                                <div class="data-rating-item" data-value="3">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/star-filled.svg" alt="Empty Star" class="star-filled">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/star-empty.svg" alt="Filled Star" class="star-empty">
                                </div>
                                <div class="data-rating-item" data-value="4">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/star-filled.svg" alt="Empty Star" class="star-filled">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/star-empty.svg" alt="Filled Star" class="star-empty">
                                </div>
                                <div class="data-rating-item" data-value="5">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/star-filled.svg" alt="Empty Star" class="star-filled">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/star-empty.svg" alt="Filled Star" class="star-empty">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cmp6-form-field">
                        <textarea name="description" placeholder="Розкажіть детальніше" required></textarea>
                    </div>

                    <div class="cmp6-form-btns">
                        <div class="cmp6-form-reset js-close">
                            <button type="reset" name="reset" class="cmp-button mod-big mod-btn">
                                <span>Закрити</span>
                            </button>
                        </div>

                        <div class="cmp6-form-submit">
                            <input type="submit" value="Надіслати відгук" class="cmp-button mod-big mod-hover-2 mod-btn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>