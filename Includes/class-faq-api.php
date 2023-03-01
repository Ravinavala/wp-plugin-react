<?php

class Faq_API {

    protected $version;

    public function __construct() {
        add_action('rest_api_init', array($this, 'register_faq_route'));
    }

    /** Register custom endpoint for faqplugin */
    public function register_faq_route() {
        register_rest_route('faqplugin/v1', '/faq', array(
            'methods' => 'POST',
            'callback' => array(
                $this,
                'save_faq_data'
            ),
                // 'permission_callback' => function () {
                //     return current_user_can( 'edit_others_posts' );
                // }
        ));
        register_rest_route('faqplugin/v1', '/getfaq', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_faq_list')
        ));
    }

    public function save_faq_data(WP_REST_Request $request) {
        $data = $request->get_params();

        // Validate data
        if (empty($data['question']) || empty($data['answer'])) {
            return new WP_Error('missing_fields', 'Missing required fields', array('status' => 400));
        }

        // Save data to database
        $saved = $this->save_faq_to_database($data);

        if ($saved) {
            return array('success' => true);
        } else {
            return new WP_Error('save_failed', 'Failed to save data', array('status' => 500));
        }
    }

    public function save_faq_to_database($data) {
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

    public function get_faq_list($request) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'faq_plugin_data';
        $results = $wpdb->get_results("SELECT * FROM $table_name");
        if (empty($results)) {
            return new WP_Error('no_faq', 'No Faq Found', array('status' => 404));
        }
        return new WP_REST_Response($results, 200);
    }

}

$Faq_API = new Faq_API();
