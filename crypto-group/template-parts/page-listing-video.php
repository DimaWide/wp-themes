<?php
get_header();
?>

<?php
$standard_membership_level_id = 2;

if (function_exists('pmpro_hasMembershipLevel') && pmpro_hasMembershipLevel($standard_membership_level_id)) {
?>
    <div class="wcl-page">
        <div class="data-container">
            <div class="data-content">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
<?php
} else {
?>
    <div class="wcl-page mod-default">
        <div class="page-container wcl-container">
            <div class="page-content">
                <div class="pmpro_content_message">
                    <p>
                        Šis turinys skirtas tik standartiniams nariams.</p>

                    <div class="data-link">
                        <a href="<?php echo site_url('/'); ?>/membership-levels/" class="wcl-cmp-button-2 mod-type-1">Prisijunkite dabar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
<?php
get_footer();
?>