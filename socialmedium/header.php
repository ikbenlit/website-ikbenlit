<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container">
        <div class="site-branding">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="custom-logo-link">
                <img src="<?php echo get_template_directory_uri(); ?>/images/ikbenlit_logo.png" alt="IkBenLit Logo" class="custom-logo">
            </a>
        </div>

        <nav class="main-navigation">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <span class="menu-icon"></span>
            </button>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class' => 'primary-menu',
                'container' => false,
                'menu_id' => 'primary-menu',
                'fallback_cb' => false,
            ));
            ?>
        </nav>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const menuIcon = document.querySelector('.menu-icon');
    const primaryMenu = document.querySelector('.primary-menu');
    
    if (menuToggle && primaryMenu) {
        menuToggle.addEventListener('click', function() {
            primaryMenu.classList.toggle('active');
            menuToggle.classList.toggle('active');
            menuToggle.setAttribute('aria-expanded', 
                menuToggle.getAttribute('aria-expanded') === 'false' ? 'true' : 'false'
            );
        });
    }
});
</script> 