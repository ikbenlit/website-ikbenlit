<?php

if (!defined('ABSPATH')) exit;

// Theme Setup
function ikbenlit_theme_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'ikbenlit'),
        'footer' => __('Footer Menu', 'ikbenlit'),
    ));
}
add_action('after_setup_theme', 'ikbenlit_theme_setup');

// Enqueue scripts and styles
function ikbenlit_scripts() {
    wp_enqueue_style('ikbenlit-style', get_stylesheet_uri());
    wp_enqueue_script('ikbenlit-script', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true);
    
    // Enqueue chat script only if needed
    if (is_front_page()) {
        wp_enqueue_script('floating-chat', get_template_directory_uri() . '/js/floating-chat.js', array(), '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'ikbenlit_scripts');

// Include API configurations
require_once get_template_directory() . '/includes/api/openai-config.php';
require_once get_template_directory() . '/includes/api/claude-config.php';

// Voeg ajaxurl toe voor niet-admin pagina's
function add_ajax_url() {
    echo '<script type="text/javascript">
            var ajaxurl = "' . admin_url('admin-ajax.php') . '";
          </script>';
}
add_action('wp_head', 'add_ajax_url'); 

function enqueue_socialmedium_demo_assets() {
    // Alleen laden op de demo-pagina (gebruik de slug van je pagina)
    if (is_page('socialmedium')) { // Vervang 'social-media-demo' door de slug van jouw pagina
        // CSS
        wp_enqueue_style('socialmedium-styles', get_template_directory_uri() . '/socialmedium/styles.css');
        // JS
        wp_enqueue_script('socialmedium-script', get_template_directory_uri() . '/socialmedium/script.js', array(), false, true);
        // Google Fonts
        wp_enqueue_style('poppins-font', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_socialmedium_demo_assets');