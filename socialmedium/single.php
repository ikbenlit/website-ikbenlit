<?php get_header(); ?>

<main class="site-main blog-projects">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <article class="single-post-content">
                <header class="single-post-header">
                    <h1><?php the_title(); ?></h1>
                    <div class="single-post-meta">
                        <span class="date"><?php echo get_the_date('d M Y'); ?></span> |
                        <span class="categories"><?php echo get_the_category_list(', '); ?></span>
                    </div>
                </header>
                
                <div class="post-content">
                    <?php the_content(); ?>
                </div>
                
                <footer class="post-footer">
                    <?php
                    // Add tags if they exist
                    $tags_list = get_the_tag_list('', ', ');
                    if ($tags_list) {
                        printf('<div class="post-tags">Tags: %s</div>', $tags_list);
                    }
                    ?>
                </footer>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?> 