<?php
if (!defined('ABSPATH')) exit;

// Chat Widget Configuration
function init_chat_widget() {
    if (is_front_page()) {
        // Enqueue CSS
        wp_enqueue_style('floating-chat', get_template_directory_uri() . '/css/floating-chat.css', array(), '1.0');
        
        // Ensure jQuery is loaded
        wp_enqueue_script('jquery');
        
        // Enqueue JavaScript with jQuery dependency
        wp_enqueue_script('floating-chat', get_template_directory_uri() . '/js/floating-chat.js', array('jquery'), '1.0', true);
        wp_localize_script('floating-chat', 'chatConfig', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'themeUrl' => get_template_directory_uri()
        ));
    }
}
add_action('wp_enqueue_scripts', 'init_chat_widget'); 