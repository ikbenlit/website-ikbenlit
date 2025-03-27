<?php
if (!defined('ABSPATH')) exit;

// Add REST API endpoint for ChatGPT
function register_chatgpt_route() {
    register_rest_route('ikbenlit/v1', '/chat', array(
        'methods' => 'POST',
        'callback' => 'handle_chat_request',
        'permission_callback' => function () {
            return true; // Adjust based on your security requirements
        }
    ));
}
add_action('rest_api_init', 'register_chatgpt_route');

function handle_chat_request($request) {
    $parameters = $request->get_json_params();
    $message = sanitize_text_field($parameters['message']);
    
    // Your OpenAI API key should be stored securely
    $api_key = defined('OPENAI_API_KEY') ? OPENAI_API_KEY : '';
    
    if (empty($api_key)) {
        return new WP_Error('missing_api_key', 'OpenAI API key is not configured', array('status' => 500));
    }

    $response = wp_remote_post('https://api.openai.com/v1/chat/completions', array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $api_key,
            'Content-Type' => 'application/json',
        ),
        'body' => json_encode(array(
            'model' => 'gpt-3.5-turbo',
            'messages' => array(
                array(
                    'role' => 'user',
                    'content' => $message
                )
            ),
            'temperature' => 0.7,
            'max_tokens' => 150
        ))
    ));

    if (is_wp_error($response)) {
        return new WP_Error('api_error', $response->get_error_message(), array('status' => 500));
    }

    $body = json_decode(wp_remote_retrieve_body($response), true);
    
    if (isset($body['choices'][0]['message']['content'])) {
        return array(
            'response' => $body['choices'][0]['message']['content']
        );
    }

    return new WP_Error('invalid_response', 'Invalid response from OpenAI', array('status' => 500));
} 