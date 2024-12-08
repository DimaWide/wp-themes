<?php


?>
<aside class="cmp-3-sidebar data-sidebar">
    <?php
    if (is_active_sidebar('primary-sidebar')) {
        dynamic_sidebar('primary-sidebar');
    }
    ?>
</aside>