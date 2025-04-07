<?php get_header(); ?>

<main class="site-main blog-projects">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title">
                <?php
                if (is_category()) {
                    single_cat_title();
                } else {
                    echo 'Blog';
                }
                ?>
            </h1>
        </header>

        <div class="blog-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    ?>
                    <article class="blog-card">
                        <div class="card-header">
                            <div class="terminal-dots">
                                <span class="terminal-dot"></span>
                                <span class="terminal-dot"></span>
                                <span class="terminal-dot"></span>
                            </div>
                            <span class="terminal-title">ikbenlit:~$ cat post.txt</span>
                        </div>
                        <div class="blog-content">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="blog-meta">
                                <span class="date"><?php echo get_the_date('d M Y'); ?></span>
                                <span class="categories"><?php echo get_the_category_list(', '); ?></span>
                            </div>
                            <?php the_excerpt(); ?>
                            <a href="<?php the_permalink(); ?>" class="button">Read More ></a>
                        </div>
                    </article>
                    <?php
                endwhile;
            else :
                echo '<p>Geen posts gevonden.</p>';
            endif;
            ?>
        </div>

        <?php the_posts_pagination(); ?>
    </div>
</main>

<?php get_footer(); ?> 