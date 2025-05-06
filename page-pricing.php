<?php
/**
 * Page Template: Pricing Page
 *
 * @package ikbenlit-theme
 */

// Voeg een klasse toe aan de body voor specifieke CSS styling
add_filter('body_class', function($classes) {
    $classes[] = 'page-template-page-pricing';
    return $classes;
});

get_header();
?>

<div id="primary" class="content-area pricing-page-wrapper">
    <main id="main" class="site-main pricing-main-content">

        <?php
        // Toon de pagina-inhoud boven de prijstabel
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <div class="page-content pricing-page-content">
                    <div class="container">
                        <?php the_content(); ?>
                    </div>
                </div>
                <?php
            endwhile;
        endif;
        
        // Include pricing data
        require_once get_template_directory() . '/includes/pricing-data.php';

        // Get pricing plans data
        $pricing_plans = get_pricing_plans();
        $pricing_title = get_pricing_title();
        $pricing_description = get_pricing_description();

        // Include template parts to render the pricing table
        require_once get_template_directory() . '/includes/pricing-template-parts.php';
        
        // Render the complete pricing section
        render_pricing_section($pricing_plans, $pricing_title, $pricing_description);
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer(); 