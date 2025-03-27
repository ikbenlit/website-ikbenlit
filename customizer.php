<?php
/**
 * IkBenLit Theme Customizer
 */

function ikbenlit_customize_register($wp_customize) {
    // Add section for theme options
    $wp_customize->add_section('ikbenlit_theme_options', array(
        'title'    => __('Theme Options', 'ikbenlit'),
        'priority' => 130,
    ));

    // Add setting for primary color
    $wp_customize->add_setting('primary_color', array(
        'default'           => '#007bff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label'    => __('Primary Color', 'ikbenlit'),
        'section'  => 'ikbenlit_theme_options',
        'settings' => 'primary_color',
    )));

    // Add setting for footer text
    $wp_customize->add_setting('footer_text', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('footer_text', array(
        'label'    => __('Footer Text', 'ikbenlit'),
        'section'  => 'ikbenlit_theme_options',
        'settings' => 'footer_text',
        'type'     => 'textarea',
    ));

    // Add setting for social media links
    $social_platforms = array('facebook', 'twitter', 'instagram', 'linkedin');

    foreach ($social_platforms as $platform) {
        $wp_customize->add_setting($platform . '_url', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control($platform . '_url', array(
            'label'    => sprintf(__('%s URL', 'ikbenlit'), ucfirst($platform)),
            'section'  => 'ikbenlit_theme_options',
            'settings' => $platform . '_url',
            'type'     => 'url',
        ));
    }
}
add_action('customize_register', 'ikbenlit_customize_register');

/**
 * Output customizer CSS
 */
function ikbenlit_customizer_css() {
    $primary_color = get_theme_mod('primary_color', '#007bff');
    ?>
    <style type="text/css">
        a:hover,
        .site-title a:hover,
        .entry-title a:hover {
            color: <?php echo esc_attr($primary_color); ?>;
        }

        .button,
        button,
        input[type="button"],
        input[type="reset"],
        input[type="submit"] {
            background-color: <?php echo esc_attr($primary_color); ?>;
        }

        .main-navigation .current-menu-item > a,
        .main-navigation .current-menu-ancestor > a {
            border-bottom-color: <?php echo esc_attr($primary_color); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'ikbenlit_customizer_css'); 