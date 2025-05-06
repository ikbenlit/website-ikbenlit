<?php
/**
 * Template Parts for Pricing Page
 *
 * Bevat herbruikbare functies voor het renderen van verschillende delen
 * van de pricing pagina.
 */

if (!function_exists('render_pricing_header')) {
    /**
     * Rendert de header van de pricing sectie.
     *
     * @param string $title       De titel van de pricing sectie.
     * @param string $description De beschrijving van de pricing sectie.
     * @return void
     */
    function render_pricing_header($title, $description) {
        ?>
        <div class="pricing-header">
            <h1 class="pricing-title"><?php echo esc_html($title); ?></h1>
            <p class="pricing-description"><?php echo nl2br(esc_html($description)); ?></p>
        </div>
        <?php
    }
}

if (!function_exists('render_pricing_plan')) {
    /**
     * Rendert een pricing plan.
     *
     * @param array $plan De data van het plan.
     * @return void
     */
    function render_pricing_plan($plan) {
        $is_popular = !empty($plan['isPopular']);
        $plan_class = $is_popular ? 'pricing-plan pricing-plan-popular' : 'pricing-plan';
        ?>
        <div class="<?php echo esc_attr($plan_class); ?>">
            <?php if ($is_popular) : ?>
                <div class="pricing-plan-popular-badge">
                    <span>Populair</span>
                </div>
            <?php endif; ?>
            
            <div class="pricing-plan-header">
                <h3 class="pricing-plan-name"><?php echo esc_html($plan['name']); ?></h3>
                
                <div class="pricing-plan-price-container">
                    <div class="pricing-plan-price">
                        <span class="currency">€</span><span class="price"><?php echo esc_html($plan['price']); ?></span>
                    </div>
                    <span class="pricing-plan-period"><?php echo esc_html($plan['period']); ?></span>
                </div>
            </div>
            
            <?php render_feature_list($plan['features']); ?>
            
            <div class="pricing-plan-footer">
                <a href="<?php echo esc_url($plan['href']); ?>" class="pricing-plan-button <?php echo $is_popular ? 'pricing-plan-button-primary' : ''; ?>">
                    <?php echo esc_html($plan['buttonText']); ?>
                </a>
                <p class="pricing-plan-description"><?php echo esc_html($plan['description']); ?></p>
            </div>
        </div>
        <?php
    }
}

if (!function_exists('render_feature_list')) {
    /**
     * Rendert een lijst met features voor een pricing plan.
     *
     * @param array $features De features van het plan.
     * @return void
     */
    function render_feature_list($features) {
        if (empty($features) || !is_array($features)) {
            return;
        }
        ?>
        <ul class="pricing-plan-features">
            <?php foreach ($features as $feature) : ?>
                <li class="pricing-plan-feature">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/check-icon.svg" alt="Check" class="feature-icon">
                    <span><?php echo esc_html($feature); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
    }
}

if (!function_exists('render_pricing_section')) {
    /**
     * Rendert de volledige pricing sectie.
     *
     * @param array  $plans       De array met pricing plannen.
     * @param string $title       De titel van de pricing sectie.
     * @param string $description De beschrijving van de pricing sectie.
     * @return void
     */
    function render_pricing_section($plans, $title, $description) {
        ?>
        <div class="pricing-container">
            <?php 
            render_pricing_header($title, $description);
            ?>
            
            <div class="pricing-plans">
                <?php foreach ($plans as $plan) : ?>
                    <?php render_pricing_plan($plan); ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }
} 