<?php
/**
 * Pricing Data
 *
 * Definieert de data voor de pricing pakketten op ikbenlit.nl
 */

if (!function_exists('get_pricing_title')) {
    /**
     * Geeft de titel voor de pricing sectie terug.
     *
     * @return string De titel van de pricing sectie.
     */
    function get_pricing_title() {
        return get_theme_mod('pricing_title', 'Eenvoudige, Transparante Prijzen');
    }
}

if (!function_exists('get_pricing_description')) {
    /**
     * Geeft de beschrijving voor de pricing sectie terug.
     *
     * @return string De beschrijving van de pricing sectie.
     */
    function get_pricing_description() {
        return get_theme_mod('pricing_description', 'Kies het pakket dat bij je past
Alle pakketten geven toegang tot ons platform, tools voor lead generatie en toegewijde ondersteuning.');
    }
}

if (!function_exists('get_pricing_plans')) {
    /**
     * Geeft de prijspakketten terug.
     *
     * @return array Array met prijspakketten.
     */
    function get_pricing_plans() {
        // Pakket 1
        $package_1_features = explode("\n", get_theme_mod('package_1_features', 'Tot 10 projecten
Basis analytics
48-uur reactietijd voor support
Beperkte API toegang
Community ondersteuning'));
        
        $package_1 = array(
            'name'        => get_theme_mod('package_1_name', 'STARTER'),
            'price'       => get_theme_mod('package_1_price', '50'),
            'period'      => get_theme_mod('package_1_period', 'per maand'),
            'features'    => array_map('trim', $package_1_features),
            'description' => get_theme_mod('package_1_description', 'Perfect voor individuen en kleine projecten'),
            'buttonText'  => get_theme_mod('package_1_button_text', 'Start Gratis Proefperiode'),
            'href'        => get_theme_mod('package_1_button_link', '/aanmelden'),
            'isPopular'   => get_theme_mod('package_1_is_popular', false),
        );
        
        // Pakket 2
        $package_2_features = explode("\n", get_theme_mod('package_2_features', 'Onbeperkt aantal projecten
Geavanceerde analytics
24-uur reactietijd voor support
Volledige API toegang
Prioriteit ondersteuning
Team samenwerking
Custom integraties'));
        
        $package_2 = array(
            'name'        => get_theme_mod('package_2_name', 'PROFESSIONAL'),
            'price'       => get_theme_mod('package_2_price', '99'),
            'period'      => get_theme_mod('package_2_period', 'per maand'),
            'features'    => array_map('trim', $package_2_features),
            'description' => get_theme_mod('package_2_description', 'Ideaal voor groeiende teams en bedrijven'),
            'buttonText'  => get_theme_mod('package_2_button_text', 'Aan de Slag'),
            'href'        => get_theme_mod('package_2_button_link', '/aanmelden'),
            'isPopular'   => get_theme_mod('package_2_is_popular', true),
        );
        
        // Pakket 3
        $package_3_features = explode("\n", get_theme_mod('package_3_features', 'Alles in Professional
Maatwerk oplossingen
Dedicated accountmanager
1-uur reactietijd voor support
SSO Authenticatie
Geavanceerde beveiliging
Aangepaste contracten
SLA overeenkomst'));
        
        $package_3 = array(
            'name'        => get_theme_mod('package_3_name', 'ENTERPRISE'),
            'price'       => get_theme_mod('package_3_price', '299'),
            'period'      => get_theme_mod('package_3_period', 'per maand'),
            'features'    => array_map('trim', $package_3_features),
            'description' => get_theme_mod('package_3_description', 'Voor grote organisaties met specifieke wensen'),
            'buttonText'  => get_theme_mod('package_3_button_text', 'Neem Contact Op'),
            'href'        => get_theme_mod('package_3_button_link', '/contact'),
            'isPopular'   => get_theme_mod('package_3_is_popular', false),
        );
        
        return array(
            $package_1,
            $package_2,
            $package_3,
        );
    }
} 