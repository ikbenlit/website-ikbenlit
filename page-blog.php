<?php
/**
 * Template Name: Blog & Projects
 */

get_header();
?>

<main class="site-main blog-projects">
    <div class="container">
        <header class="page-header">
            <?php the_title('<h1 class="page-title">', '</h1>'); ?>
        </header>

        <div class="blog-grid">
            <?php
            $posts_query = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => -1,
                'category_name' => 'blog,ai-projects'
            ));

            if ($posts_query->have_posts()) :
                while ($posts_query->have_posts()) : $posts_query->the_post();
                    // Categorieën ophalen
                    $categories = get_the_category();
                    ?>
                    <article class="blog-card">
                        <a href="<?php the_permalink(); ?>" class="blog-link">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="blog-featured-image">
                                    <?php the_post_thumbnail('large'); ?>
                                    <?php if (!empty($categories)) : ?>
                                        <div class="blog-categories">
                                            <?php foreach ($categories as $category) : ?>
                                                <span class="blog-category"><?php echo esc_html($category->name); ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <div class="blog-content">
                                <h3 class="blog-title"><?php the_title(); ?></h3>
                                <div class="blog-meta">
                                    <span class="blog-date"><?php echo get_the_date('d M Y'); ?></span>
                                </div>
                                <div class="blog-description">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                                </div>
                            </div>
                        </a>
                    </article>
                    <?php
                endwhile;
                wp_reset_postdata();
            else:
                echo '<p>Geen posts gevonden.</p>';
            endif;
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?> 