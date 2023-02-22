<?php

class Faq_Section {

protected $version;

/**
 * Define the core functionality of the plugin.
 *
 * Set the plugin name and the plugin version that can be used throughout the plugin.
 * Load the dependencies, and set the hooks for the admin area and the public-facing
 * side of the site.
 */
public function __construct() {
    $this->load_dependencies();
    add_action('admin_enqueue_scripts', array($this, 'faq_plugin_admin_script'));
}

/* * * Load the required dependencies for this plugin */

private function load_dependencies() {
    require_once FAQ_SECTION_PLUGIN_PATH . 'admin/class-faq-admin.php';
}

public function faq_plugin_admin_script() {
    wp_enqueue_style( 'faq-sec-style', plugin_dir_url( __FILE__ ) . 'build/index.css' );
    wp_enqueue_script( 'faq-sec-script', plugin_dir_url( __FILE__ ) . 'build/index.js', array( 'wp-element' ), '1.0.0', true );
}
}

$Faq_Section = new Faq_Section();
