<?php

class Faq_Admin {

    /**
     * The ID of this plugin.
     *
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string  $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $plugin_name  The name of this plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'faq_admin_menu'));
    }

    public function faq_admin_menu() {
        add_menu_page('Faq Settings', 'Faq settings', 'manage_options', 'faq_settings', array(
            $this,
            'faq_content',
        ));
    }

    public function faq_content() {
        require FAQ_SECTION_PLUGIN_PATH . 'app.php';
    }
}
