<?php get_header(); ?>

<main class="site-main">
    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php
                        if (is_singular()) :
                            the_title('<h1 class="entry-title">', '</h1>');
                        else :
                            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>');
                        endif;
                        ?>
                    </header>

                    <div class="entry-content">
                        <?php
                        if (is_singular()) :
                            the_content();
                        else :
                            the_excerpt();
                        endif;
                        ?>
                    </div>
                </article>
                <?php
            endwhile;

            the_posts_navigation();
        else :
            ?>
            <p><?php esc_html_e('No posts found.', 'ikbenlit'); ?></p>
            <?php
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?> 