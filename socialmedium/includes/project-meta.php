<?php
/**
 * Project Meta Fields
 */

// Add meta box for project details
function add_project_meta_box() {
    add_meta_box(
        'project_details',
        __('Project Details', 'ikbenlit'),
        'render_project_meta_box',
        'project',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_project_meta_box');

// Render meta box content
function render_project_meta_box($post) {
    // Get existing values
    $programming_language = get_post_meta($post->ID, '_project_programming_language', true);
    $technology = get_post_meta($post->ID, '_project_technology', true);
    $status = get_post_meta($post->ID, '_project_status', true);
    
    // Add nonce for security
    wp_nonce_field('project_meta_box', 'project_meta_box_nonce');
    ?>
    <div class="project-meta-fields">
        <p>
            <label for="project_programming_language"><?php _e('Programmeertaal', 'ikbenlit'); ?></label>
            <input type="text" id="project_programming_language" name="project_programming_language" value="<?php echo esc_attr($programming_language); ?>" class="widefat">
        </p>
        <p>
            <label for="project_technology"><?php _e('Technologie', 'ikbenlit'); ?></label>
            <input type="text" id="project_technology" name="project_technology" value="<?php echo esc_attr($technology); ?>" class="widefat">
        </p>
        <p>
            <label for="project_status"><?php _e('Status', 'ikbenlit'); ?></label>
            <select id="project_status" name="project_status" class="widefat">
                <option value=""><?php _e('Selecteer status', 'ikbenlit'); ?></option>
                <option value="completed" <?php selected($status, 'completed'); ?>><?php _e('Afgerond', 'ikbenlit'); ?></option>
                <option value="in-progress" <?php selected($status, 'in-progress'); ?>><?php _e('In ontwikkeling', 'ikbenlit'); ?></option>
                <option value="planned" <?php selected($status, 'planned'); ?>><?php _e('Gepland', 'ikbenlit'); ?></option>
            </select>
        </p>
    </div>
    <?php
}

// Save meta box data
function save_project_meta_box($post_id) {
    // Check if our nonce is set
    if (!isset($_POST['project_meta_box_nonce'])) {
        return;
    }

    // Verify that the nonce is valid
    if (!wp_verify_nonce($_POST['project_meta_box_nonce'], 'project_meta_box')) {
        return;
    }

    // If this is an autosave, don't do anything
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save the data
    $fields = array(
        'project_programming_language',
        'project_technology',
        'project_status'
    );

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_project', 'save_project_meta_box'); 