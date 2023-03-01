<?php

class Faq_Shortcode {

    protected $version;

    const FAQ_API_BASE = '/wp-json/faqplugin/v1/getfaq';

    public function __construct() {
        add_shortcode('faq_section', array($this, 'display_faq_section'));
    }

    /* Shortcode for faq section */

    public function display_faq_section() {

        $api_url = get_site_url() . Faq_Shortcode::FAQ_API_BASE;
        $response = file_get_contents($api_url);

        if (!$response) {
            return 'Error retrieving FAQs.';
        }

        $faqs = json_decode($response, true);

        if (empty($faqs)) {
            return 'No FAQs found.';
        }

        $output = '<div class="faq-container">';

        foreach ($faqs as $faq) {
        $output .= '<div class="faq-item">
            <h3 class="faq-question">' . $faq['question'] . '</h3>
            <div class="faq-answer">
            <p>' . $faq['answer'] . '</p>
            </div>
        </div>';
        }

        $output .= '</div>';
        
        wp_enqueue_style('faq-style', FAQ_SECTION_PLUGIN_URL . 'front-assests/faq-section.css');
        wp_enqueue_script('faq-script', FAQ_SECTION_PLUGIN_URL . 'front-assests/faq-script.js', array(), '1.0.0', true);

        return $output;
    }

}

$Faq_Shortcode = new Faq_Shortcode();
