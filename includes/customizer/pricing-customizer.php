<?php
/**
 * Pricing Customizer Settings
 *
 * Voegt Customizer-instellingen toe voor het aanpassen van prijspakketten.
 *
 * @package ikbenlit-theme
 */

/**
 * Voegt pricing-instellingen toe aan de Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
 */
function ikbenlit_pricing_customizer_settings($wp_customize) {
    // Sectie voor prijsinstellingen toevoegen
    $wp_customize->add_section('ikbenlit_pricing_settings', array(
        'title'       => __('Prijzen en Pakketten', 'ikbenlit'),
        'description' => __('Instellingen voor de prijzenpagina.', 'ikbenlit'),
        'priority'    => 30,
    ));

    // Algemene instellingen
    $wp_customize->add_setting('pricing_title', array(
        'default'           => 'Eenvoudige, Transparante Prijzen',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('pricing_title', array(
        'label'    => __('Titel prijzensectie', 'ikbenlit'),
        'section'  => 'ikbenlit_pricing_settings',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('pricing_description', array(
        'default'           => 'Kies het pakket dat bij je past
Alle pakketten geven toegang tot ons platform, tools voor lead generatie en toegewijde ondersteuning.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('pricing_description', array(
        'label'    => __('Beschrijving prijzensectie', 'ikbenlit'),
        'section'  => 'ikbenlit_pricing_settings',
        'type'     => 'textarea',
    ));

    // Pakket 1 instellingen
    $wp_customize->add_setting('package_1_name', array(
        'default'           => 'STARTER',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('package_1_name', array(
        'label'    => __('Pakket 1 - Naam', 'ikbenlit'),
        'section'  => 'ikbenlit_pricing_settings',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('package_1_price', array(
        'default'           => '50',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('package_1_price', array(
        'label'    => __('Pakket 1 - Prijs', 'ikbenlit'),
        'section'  => 'ikbenlit_pricing_settings',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('package_1_period', array(
        'default'           => 'per maand',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('package_1_period', array(
        'label'    => __('Pakket 1 - Periode', 'ikbenlit'),
        'section'  => 'ikbenlit_pricing_settings',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('package_1_features', array(
        'default'           => 'Tot 10 projecten
Basis analytics
48-uur reactietijd voor support
Beperkte API toegang
Community ondersteuning',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('package_1_features', array(
        'label'       => __('Pakket 1 - Features', 'ikbenlit'),
        'description' => __('Voer elke feature op een nieuwe regel in', 'ikbenlit'),
        'section'     => 'ikbenlit_pricing_settings',
        'type'        => 'textarea',
    ));

    $wp_customize->add_setting('package_1_description', array(
        'default'           => 'Perfect voor individuen en kleine projecten',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('package_1_description', array(
        'label'    => __('Pakket 1 - Beschrijving', 'ikbenlit'),
        'section'  => 'ikbenlit_pricing_settings',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('package_1_button_text', array(
        'default'           => 'Start Gratis Proefperiode',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('package_1_button_text', array(
        'label'    => __('Pakket 1 - Button Tekst', 'ikbenlit'),
        'section'  => 'ikbenlit_pricing_settings',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('package_1_button_link', array(
        'default'           => '/aanmelden',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('package_1_button_link', array(
        'label'    => __('Pakket 1 - Button Link', 'ikbenlit'),
        'section'  => 'ikbenlit_pricing_settings',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('package_1_is_popular', array(
        'default'           => false,
        'sanitize_callback' => 'ikbenlit_sanitize_checkbox',
    ));

    $wp_customize->add_control('package_1_is_popular', array(
        'label'    => __('Pakket 1 - Markeren als populair', 'ikbenlit'),
        'section'  => 'ikbenlit_pricing_settings',
        'type'     => 'checkbox',
    ));

    // Pakket 2 instellingen
    $wp_customize->add_setting('package_2_name', array(
        'default'           => 'PROFESSIONAL',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('package_2_name', array(
        'label'    => __('Pakket 2 - Naam', 'ikbenlit'),
        'section'  => 'ikbenlit_pricing_settings',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('package_2_price', array(
        'default'           => '99',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('package_2_price', array(
        'label'    => __('Pakket 2 - Prijs', 'ikbenlit'),
        'section'  => 'ikbenlit_pricing_settings',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('package_2_period', array(
        'default'           => 'per maand',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('package_2_period', array(
        'label'    => __('Pakket 2 - Periode', 'ikbenlit'),
        'section'  => 'ikbenlit_pricing_settings',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('package_2_features', array(
        'default'           => 'Onbeperkt aantal projecten
Geavanceerde analytics
24-uur reactietijd voor support
Volledige API toegang
Prioriteit ondersteuning
Team samenwerking
Custom integraties',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('package_2_features', array(
        'label'       => __('Pakket 2 - Features', 'ikbenlit'),
        'description' => __('Voer elke feature op een nieuwe regel in', 'ikbenlit'),
        'section'     => 'ikbenlit_pricing_settings',
        'type'        => 'textarea',
    ));

    $wp_customize->add_setting('package_2_description', array(
        'default'           => 'Ideaal voor groeiende teams en bedrijven',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('package_2_description', array(
        'label'    => __('Pakket 2 - Beschrijving', 'ikbenlit'),
        'section'  => 'ikbenlit_pricing_settings',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('package_2_button_text', array(
        'default'           => 'Aan de Slag',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('package_2_button_text', array(
        'label'    => __('Pakket 2 - Button Tekst', 'ikbenlit'),
        'section'  => 'ikbenlit_pricing_settings',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('package_2_button_link', array(
        'default'           => '/aanmelden',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('package_2_button_link', array(
        'label'    => __('Pakket 2 - Button Link', 'ikbenlit'),
        'section'  => 'ikbenlit_pricing_settings',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('package_2_is_popular', array(
        'default'           => true,
        'sanitize_callback' => 'ikbenlit_sanitize_checkbox',
    ));

    $wp_customize->add_control('package_2_is_popular', array(
        'label'    => __('Pakket 2 - Markeren als populair', 'ikbenlit'),
        'section'  => 'ikbenlit_pricing_settings',
        'type'     => 'checkbox',
    ));

    // Pakket 3 instellingen
    $wp_customize->add_setting('package_3_name', array(
        'default'           => 'ENTERPRISE',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('package_3_name', array(
        'label'    => __('Pakket 3 - Naam', 'ikbenlit'),
        'section'  => 'ikbenlit_pricing_settings',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('package_3_price', array(
        'default'           => '299',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('package_3_price', array(
        'label'    => __('Pakket 3 - Prijs', 'ikbenlit'),
        'section'  => 'ikbenlit_pricing_settings',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('package_3_period', array(
        'default'           => 'per maand',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('package_3_period', array(
        'label'    => __('Pakket 3 - Periode', 'ikbenlit'),
        'section'  => 'ikbenlit_pricing_settings',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('package_3_features', array(
        'default'           => 'Alles in Professional
Maatwerk oplossingen
Dedicated accountmanager
1-uur reactietijd voor support
SSO Authenticatie
Geavanceerde beveiliging
Aangepaste contracten
SLA overeenkomst',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('package_3_features', array(
        'label'       => __('Pakket 3 - Features', 'ikbenlit'),
        'description' => __('Voer elke feature op een nieuwe regel in', 'ikbenlit'),
        'section'     => 'ikbenlit_pricing_settings',
        'type'        => 'textarea',
    ));

    $wp_customize->add_setting('package_3_description', array(
        'default'           => 'Voor grote organisaties met specifieke wensen',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('package_3_description', array(
        'label'    => __('Pakket 3 - Beschrijving', 'ikbenlit'),
        'section'  => 'ikbenlit_pricing_settings',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('package_3_button_text', array(
        'default'           => 'Neem Contact Op',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('package_3_button_text', array(
        'label'    => __('Pakket 3 - Button Tekst', 'ikbenlit'),
        'section'  => 'ikbenlit_pricing_settings',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('package_3_button_link', array(
        'default'           => '/contact',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('package_3_button_link', array(
        'label'    => __('Pakket 3 - Button Link', 'ikbenlit'),
        'section'  => 'ikbenlit_pricing_settings',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('package_3_is_popular', array(
        'default'           => false,
        'sanitize_callback' => 'ikbenlit_sanitize_checkbox',
    ));

    $wp_customize->add_control('package_3_is_popular', array(
        'label'    => __('Pakket 3 - Markeren als populair', 'ikbenlit'),
        'section'  => 'ikbenlit_pricing_settings',
        'type'     => 'checkbox',
    ));
}
add_action('customize_register', 'ikbenlit_pricing_customizer_settings');

/**
 * Sanitize checkbox.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function ikbenlit_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? true : false);
} 