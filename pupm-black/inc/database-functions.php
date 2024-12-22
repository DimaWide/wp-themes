<?php 





/* 
create_featured_fields_token_table_if_not_exists
 */
function create_featured_fields_token_table_if_not_exists() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'featured_fields_token'; // Custom table name
    $charset_collate = $wpdb->get_charset_collate();

    // Check if the table already exists
    $table_exists = $wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name;

    if (!$table_exists) {
        // SQL to create the table
        $sql = "CREATE TABLE $table_name (
            id BIGINT(20) NOT NULL AUTO_INCREMENT,
            order_id VARCHAR(255) NOT NULL, 
            token_mint_value VARCHAR(255) NOT NULL,
            token_details LONGTEXT NOT NULL,
            dex_paid_status TINYINT(1) NOT NULL DEFAULT 0,  /* New field for payment status */
            PRIMARY KEY (id)
        ) $charset_collate;";

        // Load WordPress dbDelta function for table creation
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}
// Hook the function to an appropriate action
add_action('after_switch_theme', 'create_featured_fields_token_table_if_not_exists');








/* 
create_dexscreener_token_table_if_not_exists
 */
function create_dexscreener_token_table_if_not_exists() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'dexscreener_fields_token'; // Custom table name
    $charset_collate = $wpdb->get_charset_collate();

    // Check if the table already exists
    $table_exists = $wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name;

    if (!$table_exists) {
        // SQL to create the table
        $sql = "CREATE TABLE $table_name (
            id BIGINT(20) NOT NULL AUTO_INCREMENT,
            token_mint_value VARCHAR(255) NOT NULL,
            token_details LONGTEXT NOT NULL,
            dex_paid_status TINYINT(1) NOT NULL DEFAULT 0,  /* New field for payment status */
            PRIMARY KEY (id)
        ) $charset_collate;";

        // Load WordPress dbDelta function for table creation
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}
// Hook the function to an appropriate action
add_action('after_switch_theme', 'create_dexscreener_token_table_if_not_exists');
