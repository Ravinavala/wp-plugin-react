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
    add_action( 'rest_api_init', array($this, 'register_faq_route'));
}

/* * * Load the required dependencies for this plugin */

private function load_dependencies() {
    require_once FAQ_SECTION_PLUGIN_PATH . 'admin/class-faq-admin.php';
}
/** Register custom endpoint for faqplugin */
public function register_faq_route() {
  register_rest_route( 'faqplugin/v1', '/faq', array(
    'methods' => 'POST',
    'callback' => array(
            $this,
            'save_faq_data'
    ),
    // 'permission_callback' => function () {
    //     return current_user_can( 'edit_others_posts' );
    // }
  ) );
}

public function save_faq_data( WP_REST_Request $request ) {
   $data = $request->get_params();

    // Validate data
    if ( empty( $data['question'] ) || empty( $data['answer'] ) ) {
        return new WP_Error( 'missing_fields', 'Missing required fields', array( 'status' => 400 ) );
    }

    // Save data to database
    $saved = $this->save_faq_to_database( $data );

    if ( $saved ) {
        return array( 'success' => true );
    } else {
        return new WP_Error( 'save_failed', 'Failed to save data', array( 'status' => 500 ) );
    }
}

public function save_faq_to_database( $data ) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'faq_plugin_data';

    $wpdb->insert( 
        $table_name, 
        array( 
            'question' => sanitize_text_field($data['question']), 
            'answer' => sanitize_textarea_field($data['answer']), 
        ), 
        array('%s', '%s') 
    );

    return $wpdb->insert_id;
}

public function faq_plugin_admin_script() {
    wp_enqueue_style( 'faq-sec-style', FAQ_SECTION_PLUGIN_URL . 'build/index.css' );
    wp_enqueue_script( 'faq-sec-script', FAQ_SECTION_PLUGIN_URL . 'build/index.js', array( 'wp-element' ), '1.0.0', true );
}
}

$Faq_Section = new Faq_Section();