<?php
/**
 * Template Name: Projecten
 */

get_header(); ?>

<main class="site-main projects-section">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title"><?php the_title(); ?></h1>
            <?php if (get_the_content()) : ?>
                <div class="page-description">
                    <?php the_content(); ?>
                </div>
            <?php endif; ?>
        </header>

        <?php
        $args = array(
            'post_type' => 'project',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC'
        );

        $projects_query = new WP_Query($args);

        if ($projects_query->have_posts()) : ?>
            <div class="projects-grid">
                <?php while ($projects_query->have_posts()) : $projects_query->the_post(); 
                    $programming_language = get_post_meta(get_the_ID(), '_project_programming_language', true);
                    $technology = get_post_meta(get_the_ID(), '_project_technology', true);
                    $status = get_post_meta(get_the_ID(), '_project_status', true);
                ?>
                    <a href="<?php the_permalink(); ?>" class="project-card-link" aria-label="<?php printf(__('Bekijk project %s', 'ikbenlit'), get_the_title()); ?>">
                        <article class="project-card">
                            <?php if ($status) : ?>
                                <div class="status-ribbon status-<?php echo esc_attr($status); ?>"></div>
                            <?php endif; ?>
                            
                            <div class="project-content">
                                <h2 class="project-title"><?php the_title(); ?></h2>
                                
                                <div class="project-description">
                                    <?php the_excerpt(); ?>
                                </div>

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
                                    <span class="card-arrow-icon"></span>
                                </div>
                            </div>
                        </article>
                    </a>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p><?php _e('Geen projecten gevonden.', 'ikbenlit'); ?></p>
        <?php endif; wp_reset_postdata(); ?>
    </div>
</main>

<?php /* get_footer(); */ // Footer verwijderd voor deze template ?> 