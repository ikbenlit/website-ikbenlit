<?php get_header(); ?>

<main class="site-main error-404">
    <div class="container">
        <div class="error-content">
            <h1>404</h1>
            <h2><?php esc_html_e('Page Not Found', 'ikbenlit'); ?></h2>
            <p><?php esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'ikbenlit'); ?></p>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="button"><?php esc_html_e('Return to Homepage', 'ikbenlit'); ?></a>
        </div>
    </div>
</main>

<?php get_footer(); ?> 