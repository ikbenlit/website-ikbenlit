<?php
if (!defined('ABSPATH')) exit;

// Include Claude API class
require_once get_template_directory() . '/components/class-claude-api.php';

// Register REST API endpoint for chat
add_action('rest_api_init', function () {
    register_rest_route('ikbenlit/v1', '/chat', array(
        'methods' => 'POST',
        'callback' => 'handle_claude_chat_message',
        'permission_callback' => '__return_true',
        'args' => array(
            'message' => array(
                'required' => true,
                'type' => 'string',
                'sanitize_callback' => 'sanitize_text_field',
            ),
            'prompt_type' => array(
                'required' => false,
                'type' => 'string',
                'sanitize_callback' => 'sanitize_text_field',
            ),
            'conciseness' => array(
                'required' => false,
                'type' => 'string',
                'sanitize_callback' => 'sanitize_text_field',
                'enum' => ['normal', 'concise', 'explanatory', 'formal']
            )
        )
    ));
});

function handle_claude_chat_message($request) {
    try {
        error_log('=== Claude Chat Handler Start ===');
        error_log('Request data: ' . print_r($request, true));
        
        // Get and validate message
        $message = $request->get_param('message');
        $prompt_type = $request->get_param('prompt_type') ?? 'default';
        $conciseness = $request->get_param('conciseness') ?? 'normal';
        error_log('Received message: ' . $message);
        
        if (empty($message)) {
            error_log('Empty message received');
            return new WP_Error('no_message', 'No message provided', array('status' => 400));
        }

        // Initialize API
        $claude = new Claude_API();
        error_log('Claude API initialized');
        
        // Send message
        error_log('Sending message to Claude API...');
        $response = $claude->send_message($message, $prompt_type, $conciseness);
        error_log('Claude API response: ' . print_r($response, true));
        
        if ($response['success']) {
            error_log('Successful response, returning data');
            return array(
                'response' => $response['message']
            );
        }

        error_log('=== Chat Handler End with Error ===');
        error_log('Error message: ' . $response['message']);
        return new WP_Error('api_error', $response['message'], array('status' => 500));
        
    } catch (Exception $e) {
        error_log('Handler Exception: ' . $e->getMessage());
        error_log('Stack trace: ' . $e->getTraceAsString());
        return new WP_Error('server_error', 'Internal server error', array('status' => 500));
    }
}

// Add menu page for API settings
add_action('admin_menu', function() {
    add_options_page(
        'Claude API Settings',
        'Claude API',
        'manage_options',
        'claude-api-settings',
        'render_claude_settings'
    );
});

function render_claude_settings() {
    // Check permissions
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }

    // Verify nonce for form submission
    if (isset($_POST['claude_api_key']) && isset($_POST['claude_settings_nonce'])) {
        if (!wp_verify_nonce($_POST['claude_settings_nonce'], 'claude_settings')) {
            wp_die(__('Security check failed.'));
        }

        // Save API key with sanitization
        $api_key = sanitize_text_field($_POST['claude_api_key']);
        update_option('claude_api_key', $api_key);
        
        echo '<div class="notice notice-success"><p>Settings saved.</p></div>';
    }
    
    $api_key = get_option('claude_api_key');
    ?>
    <div class="wrap">
        <h1>Claude API Settings</h1>
        <form method="post">
            <?php wp_nonce_field('claude_settings', 'claude_settings_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th><label for="claude_api_key">API Key</label></th>
                    <td>
                        <input type="password" 
                               id="claude_api_key" 
                               name="claude_api_key" 
                               value="<?php echo esc_attr($api_key); ?>" 
                               class="regular-text"
                               autocomplete="off">
                        <?php if ($api_key): ?>
                            <p class="description">API key is set.</p>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
} 