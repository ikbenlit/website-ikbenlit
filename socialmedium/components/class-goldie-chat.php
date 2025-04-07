<?php
/**
 * Goldie Chat Handler
 */
class Goldie_Chat {
    private $openai;
    private $config;
    private $parsedown;

    public function __construct() {
        require_once get_template_directory() . '/vendor/parsedown/Parsedown.php';
        $this->parsedown = new Parsedown();
        $this->parsedown->setSafeMode(true); // Voor veiligheid
        
        $this->config = json_decode(
            file_get_contents(get_template_directory() . '/config/goldie-config.json'),
            true
        );
        $this->openai = new OpenAI_API($this->config);
        
        add_action('wp_ajax_goldie_chat_request', [$this, 'handle_chat_request']);
        add_action('wp_ajax_nopriv_goldie_chat_request', [$this, 'handle_chat_request']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('wp_ajax_goldie_chat_stream', [$this, 'handle_chat_stream']);
        add_action('wp_ajax_nopriv_goldie_chat_stream', [$this, 'handle_chat_stream']);
    }

    public function enqueue_scripts() {
        if (is_page_template('page-templates/goldie-chatbot.php')) {
            wp_enqueue_script('jquery');
            wp_enqueue_style('goldie-chat', get_template_directory_uri() . '/css/goldie-chat.css');
            wp_enqueue_script(
                'goldie-chat-js',
                get_template_directory_uri() . '/js/goldie-chat.js',
                ['jquery'],
                '1.0.0',
                true
            );
            wp_localize_script('goldie-chat-js', 'goldieChat', [
                'nonce' => wp_create_nonce('goldie_chat_nonce')
            ]);
        }
    }

    public function handle_chat_request() {
        check_ajax_referer('goldie_chat_nonce', 'nonce');

        $message = sanitize_textarea_field($_POST['message'] ?? '');
        
        if (empty($message)) {
            error_log('Goldie Chat: Empty message received');
            wp_send_json_error($this->config['messages']['error']['no_message']);
        }

        $messages = [
            [
                'role' => 'user',
                'content' => $message
            ]
        ];

        $response = $this->openai->chat($messages);

        if (is_wp_error($response)) {
            error_log('Goldie Chat: Got WP_Error: ' . $response->get_error_message());
            wp_send_json_error($this->config['messages']['error']['api_error']);
        }

        $reply = $response['choices'][0]['message']['content'] ?? '';
        
        if (empty($reply)) {
            error_log('Goldie Chat: Empty reply from OpenAI');
            wp_send_json_error($this->config['messages']['error']['no_response']);
        }

        // Parse markdown naar HTML
        $formatted_reply = $this->parsedown->text($reply);
        
        wp_send_json_success($formatted_reply);
    }

    public function handle_chat_stream() {
        check_ajax_referer('goldie_chat_nonce', 'nonce');
        
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header('Connection: keep-alive');
        
        $message = sanitize_textarea_field($_GET['message'] ?? '');
        
        if (empty($message)) {
            echo "data: " . json_encode(['error' => 'No message provided']) . "\n\n";
            exit;
        }

        $messages = [['role' => 'user', 'content' => $message]];
        $response = $this->openai->chat_stream($messages);
        
        if (is_wp_error($response)) {
            echo "data: " . json_encode(['error' => $response->get_error_message()]) . "\n\n";
            exit;
        }

        // Parse markdown naar HTML voordat we het versturen
        $formatted_response = $this->parsedown->text($response);
        echo "data: " . json_encode(['chunk' => $formatted_response]) . "\n\n";
        exit;
    }
} 