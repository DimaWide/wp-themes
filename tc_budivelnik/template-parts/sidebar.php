<?php


?>
<div class="wcl-sidebar data-sidebar">
    <div class="data-cats">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'sidebar-menu',
            'menu_id'        => 'sidebar-menu',
            'menu_class'     => 'data-cats-list',
            'depth'          => 1,
            'walker'         => new Custom_Walker_Nav_Menu()
        ));
        ?>
    </div>
</div>