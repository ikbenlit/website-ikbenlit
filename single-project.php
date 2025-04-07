<?php get_header(); ?>

<main class="site-main single-project">
    <div class="container">
        <?php while (have_posts()) : the_post(); 
            $programming_language = get_post_meta(get_the_ID(), '_project_programming_language', true);
            $technology = get_post_meta(get_the_ID(), '_project_technology', true);
            $status = get_post_meta(get_the_ID(), '_project_status', true);
            $date = get_the_date();
        ?>
            <article class="project-card">
                <header class="project-header">
                    <h1 class="project-title"><?php the_title(); ?></h1>
                    <?php if ($date) : ?>
                        <span class="project-date"><?php echo esc_html($date); ?></span>
                    <?php endif; ?>
                </header>

                <div class="project-content">
                    <div class="project-meta">
                        <div class="meta-left">
                            <?php if ($programming_language) : 
                                $languages = explode(',', $programming_language);
                                foreach ($languages as $lang) : ?>
                                    <span class="meta-tag"><?php echo esc_html(trim($lang)); ?></span>
                                <?php endforeach;
                            endif; ?>
                        </div>
                        
                        <div class="meta-right">
                            <?php if ($technology) :
                                $techs = explode(',', $technology);
                                foreach ($techs as $tech) : ?>
                                    <span class="meta-tag"><?php echo esc_html(trim($tech)); ?></span>
                                <?php endforeach;
                            endif; ?>
                        </div>
                    </div>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="project-featured-image">
                            <?php the_post_thumbnail('project-featured', array(
                                'loading' => 'lazy',
                                'alt' => get_the_title()
                            )); ?>
                        </div>
                    <?php endif; ?>

                    <div class="project-description">
                        <?php the_content(); ?>
                    </div>
                </div>
            </article>

            <nav class="post-navigation">
                <?php
                $prev_post = get_previous_post();
                $next_post = get_next_post();
                ?>
                
                <?php if ($prev_post) : ?>
                    <div class="nav-previous">
                        <a href="<?php echo get_permalink($prev_post->ID); ?>">
                            <span class="nav-subtitle"><?php _e('Vorige Project', 'ikbenlit'); ?></span>
                            <span class="nav-title"><?php echo esc_html($prev_post->post_title); ?></span>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if ($next_post) : ?>
                    <div class="nav-next">
                        <a href="<?php echo get_permalink($next_post->ID); ?>">
                            <span class="nav-subtitle"><?php _e('Volgende Project', 'ikbenlit'); ?></span>
                            <span class="nav-title"><?php echo esc_html($next_post->post_title); ?></span>
                        </a>
                    </div>
                <?php endif; ?>
            </nav>
        <?php endwhile; ?>
    </div>
</main>

<?php /* get_footer(); */ // Footer verwijderd voor deze template ?> 