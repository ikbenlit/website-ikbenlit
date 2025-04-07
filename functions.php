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
    
    // Voeg aangepaste afbeeldingsgrootte toe voor projecten
    add_image_size('project-featured', 1200, 400, true);
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'ikbenlit'),
        'footer' => __('Footer Menu', 'ikbenlit'),
    ));
}
add_action('after_setup_theme', 'ikbenlit_theme_setup');

// Enqueue scripts and styles
function ikbenlit_scripts() {
    // Enqueue Google Fonts eerst
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Fira+Code:wght@400;500&display=swap', array(), null);
    
    // Enqueue projects styling met hogere prioriteit
    if (is_post_type_archive('project') || is_singular('project') || is_page_template('page-projects.php')) {
        wp_enqueue_style('ikbenlit-projects', get_template_directory_uri() . '/css/projects.css', array(), time());
    }
    
    // Basis stylesheets
    wp_enqueue_style('ikbenlit-style', get_stylesheet_uri());
    
    // Scripts
    wp_enqueue_script('ikbenlit-script', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true);
    
    // Debug informatie
    if (current_user_can('administrator')) {
        echo '<!-- Debug CSS loading:
        is_post_type_archive("project"): ' . (is_post_type_archive('project') ? 'true' : 'false') . '
        is_singular("project"): ' . (is_singular('project') ? 'true' : 'false') . '
        is_page_template("page-projects.php"): ' . (is_page_template('page-projects.php') ? 'true' : 'false') . '
        -->';
    }
    
    // Enqueue chat script only if needed
    if (is_front_page()) {
        wp_enqueue_script('floating-chat', get_template_directory_uri() . '/js/floating-chat.js', array(), '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'ikbenlit_scripts');

// Include API configurations
require_once get_template_directory() . '/includes/api/openai-config.php';
require_once get_template_directory() . '/includes/api/claude-config.php';

// Include project meta fields
require_once get_template_directory() . '/includes/project-meta.php';

// Voeg ajaxurl toe voor niet-admin pagina's
function add_ajax_url() {
    echo '<script type="text/javascript">
            var ajaxurl = "' . admin_url('admin-ajax.php') . '";
          </script>';
}
add_action('wp_head', 'add_ajax_url'); 

// Register Projects Custom Post Type
function register_project_post_type() {
    $labels = array(
        'name'               => __('Projecten', 'ikbenlit'),
        'singular_name'      => __('Project', 'ikbenlit'),
        'menu_name'          => __('Projecten', 'ikbenlit'),
        'add_new'            => __('Nieuw Project', 'ikbenlit'),
        'add_new_item'       => __('Nieuw Project Toevoegen', 'ikbenlit'),
        'edit_item'          => __('Project Bewerken', 'ikbenlit'),
        'new_item'           => __('Nieuw Project', 'ikbenlit'),
        'view_item'          => __('Bekijk Project', 'ikbenlit'),
        'search_items'       => __('Zoek Projecten', 'ikbenlit'),
        'not_found'          => __('Geen projecten gevonden', 'ikbenlit'),
        'not_found_in_trash' => __('Geen projecten gevonden in de prullenbak', 'ikbenlit'),
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => false,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array(
            'slug' => 'projecten',
            'with_front' => false
        ),
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'menu_position'       => 5,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'            => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'custom-fields',
        ),
        'show_in_rest'        => true,
    );

    register_post_type('project', $args);
}
add_action('init', 'register_project_post_type');

// Flush rewrite rules on theme activation
function ikbenlit_rewrite_flush() {
    register_project_post_type();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'ikbenlit_rewrite_flush');