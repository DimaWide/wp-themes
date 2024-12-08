<?php 



/* 
create_upcoming_field_token_table
 */
function create_upcoming_field_token_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'upcoming_field_token';

    // Check if the table already exists
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") !== $table_name) {
        // Create the table
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            post_id bigint(20) NOT NULL,
            token text NOT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY  (id),
            UNIQUE KEY post_id (post_id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}

// Hook this function to an appropriate action, e.g., after theme setup
add_action('after_switch_theme', 'create_upcoming_field_token_table');








// function allow_null_for_token_field() {
//     global $wpdb;

//     $table_name = $wpdb->prefix . 'upcoming_field_token';

//     // Modify the 'token' column to allow NULL values
//     $sql = "ALTER TABLE $table_name MODIFY token TEXT NULL;";

//     $wpdb->query($sql);
// }
// // Hook this function to an appropriate action, e.g., after theme setup
// if (isset($_GET['test1'])) {
//     add_action('init', 'allow_null_for_token_field');
// }






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
