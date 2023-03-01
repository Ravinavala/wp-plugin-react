<?php

/* 
 Plugin Name: Faq Plugin
 Description: A plugin that adds a searchable and collapsible FAQ section to your website using React JS.
 Version: 1.0.0
 Author: Ravina Vala
 License: GPL2
 License URI: https://www.gnu.org/licenses/gpl-2.0.html
 Text Domain: faq-section
 */

$CUSTOMFORM = '1.0.0';

if (!defined('FAQ_SECTION_VERSION')) {
    define('FAQ_SECTION_VERSION', 'faq-section');
}

if (!defined('FAQ_SECTION_PLUGIN_URL')) {
    define('FAQ_SECTION_PLUGIN_URL', plugin_dir_url(__FILE__));
}

if (!defined('FAQ_SECTION_PLUGIN_PATH')) {
    define('FAQ_SECTION_PLUGIN_PATH', plugin_dir_path(__FILE__));
}

if (!defined('FAQ_DIR_PATH')) {
    define('FAQ_DIR_PATH', plugin_dir_path(__DIR__));
}

function faq_plugin_activate() {
    // Create custom table
    global $wpdb;
    
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'faq_plugin_data';

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        question varchar(255) NOT NULL,
        answer text NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

/** The code that runs when plugin uninstall. */
function faq_plugin_uninstall() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'faq_plugin_data';
    $sql = "DROP TABLE IF EXISTS $table_name";
    $wpdb->query($sql);
}

register_activation_hook( __FILE__, 'faq_plugin_activate' );
register_uninstall_hook(__FILE__, 'faq_plugin_uninstall');

require FAQ_SECTION_PLUGIN_PATH . 'includes/class-faq-section.php';

$admin = new Faq_Admin();