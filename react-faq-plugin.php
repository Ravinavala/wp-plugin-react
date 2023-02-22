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

require FAQ_SECTION_PLUGIN_PATH . 'includes/class-faq-section.php';

$admin = new Faq_Admin();
