<?php
/**
 * Template Name: Pricing en Diensten
 */
get_header(); 
?>

<main class="site-main page-pricing-services">
    <div class="container">
        <?php
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('large'); // Of een andere geschikte afbeeldingsgrootte ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php
                    the_content();

                    // Laad de pricing data en template parts
                    require_once get_template_directory() . '/includes/pricing-data.php';
                    require_once get_template_directory() . '/includes/pricing-template-parts.php';
                    
                    // Haal pricing data op
                    $pricing_plans = get_pricing_plans();
                    $pricing_title = get_pricing_title();
                    $pricing_description = get_pricing_description();
                    
                    // Render de prijzen sectie
                    render_pricing_section($pricing_plans, $pricing_title, $pricing_description);

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'ikbenlit'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div><!-- .entry-content -->

            </article><!-- #post-<?php the_ID(); ?> -->

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
        endwhile; // End of the loop.
        ?>
    </div><!-- .container -->
</main><!-- .site-main -->

<?php get_footer(); ?> 