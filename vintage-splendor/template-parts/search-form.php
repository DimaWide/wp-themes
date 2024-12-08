<?php


?>
<div class="wcl-t1-search">
    <div class="t1-inner">
        <form class="t1-inner-b" method="get" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="text" name="s" placeholder="Search this site…" value="<?php echo esc_attr(get_search_query()); ?>" required>

            <button type="submit">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/search_icon.svg'; ?>" alt="img">
            </button>
        </form>
    </div>
</div>