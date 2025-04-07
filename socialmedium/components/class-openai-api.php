<?php
/**
 * OpenAI API Integration
 */
class OpenAI_API {
    private $api_key;
    private $config;
    private $base_url = 'https://api.openai.com/v1';

    public function __construct($config) {
        $this->api_key = defined('OPENAI_API_KEY') ? OPENAI_API_KEY : '';
        $this->config = $config;

        // Then verify specific assistant ID
        if (defined('OPENAI_ASSISTANT_ID')) {
            $assistant = $this->make_request('GET', '/assistants/' . OPENAI_ASSISTANT_ID);
            if (is_wp_error($assistant)) {
                error_log('OpenAI: Failed to verify assistant ID: ' . $assistant->get_error_message());
            }
        }
    }

    public function chat($messages) {
        if (!is_array($messages)) {
            error_log('OpenAI: Invalid message format received');
            return new WP_Error('invalid_format', 'Invalid message format');
        }

        // Create a thread
        $thread = $this->create_thread();
        if (is_wp_error($thread)) return $thread;

        // Add the message to the thread
        $message = $this->add_message_to_thread($thread->id, end($messages)['content']);
        if (is_wp_error($message)) return $message;

        // Create a run with the assistant
        $run = $this->create_run($thread->id);
        if (is_wp_error($run)) return $run;

        // Poll for the run completion
        $completion = $this->wait_for_run_completion($thread->id, $run->id);
        if (is_wp_error($completion)) return $completion;

        // Get the messages (assistant's response)
        $messages = $this->list_messages($thread->id);
        if (is_wp_error($messages)) return $messages;

        // Controleer en format het antwoord
        if (!isset($messages->data[0]->content[0]->text->value)) {
            error_log('OpenAI: Unexpected response format');
            return new WP_Error('invalid_response', 'Unexpected response format from OpenAI');
        }

        // Format response to match the expected structure
        return [
            'choices' => [
                [
                    'message' => [
                        'content' => $messages->data[0]->content[0]->text->value
                    ]
                ]
            ]
        ];
    }

    public function chat_stream($messages) {
        if (!is_array($messages)) {
            return new WP_Error('invalid_format', 'Invalid message format');
        }

        // Create thread and message
        $thread = $this->create_thread();
        if (is_wp_error($thread)) return $thread;

        $message = $this->add_message_to_thread($thread->id, end($messages)['content']);
        if (is_wp_error($message)) return $message;

        // Create and monitor run
        $run = $this->create_run($thread->id);
        if (is_wp_error($run)) return $run;

        // Poll and stream response
        $attempt = 0;
        while ($attempt < 30) {
            $run_status = $this->make_request('GET', "/threads/{$thread->id}/runs/{$run->id}");
            
            if ($run_status->status === 'completed') {
                $messages = $this->list_messages($thread->id);
                if (is_wp_error($messages)) return $messages;

                $content = $messages->data[0]->content[0]->text->value;
                
                // Parse de volledige tekst met Markdown
                require_once get_template_directory() . '/vendor/parsedown/Parsedown.php';
                $parsedown = new Parsedown();
                $parsedown->setSafeMode(true);
                $formatted_content = $parsedown->text($content);
                
                // Split de HTML in kleinere chunks (behoud HTML tags intact)
                $chunks = str_split($formatted_content, 3);  // Kleinere chunks voor vloeiender effect
                
                foreach ($chunks as $chunk) {
                    echo "data: " . json_encode(['chunk' => $chunk]) . "\n\n";
                    ob_flush();
                    flush();
                    usleep(20000); // 20ms delay tussen chunks
                }
                
                return;
            } elseif (in_array($run_status->status, ['failed', 'cancelled', 'expired'])) {
                return new WP_Error('run_failed', "Run failed with status: {$run_status->status}");
            }

            $attempt++;
            sleep(1);
        }

        return new WP_Error('timeout', 'Run timed out');
    }

    private function create_thread() {
        return $this->make_request('POST', '/threads');
    }

    private function add_message_to_thread($thread_id, $content) {
        return $this->make_request('POST', "/threads/{$thread_id}/messages", [
            'role' => 'user',
            'content' => $content
        ]);
    }

    private function create_run($thread_id) {
        $assistant_id = defined('OPENAI_ASSISTANT_ID') ? OPENAI_ASSISTANT_ID : '';
        
        if (empty($assistant_id)) {
            error_log('OpenAI: No Assistant ID configured');
            return new WP_Error('no_assistant_id', 'OpenAI Assistant ID is niet geconfigureerd');
        }

        return $this->make_request('POST', "/threads/{$thread_id}/runs", [
            'assistant_id' => $assistant_id
        ]);
    }

    private function wait_for_run_completion($thread_id, $run_id, $max_attempts = 30) {
        $attempt = 0;
        while ($attempt < $max_attempts) {
            $run = $this->make_request('GET', "/threads/{$thread_id}/runs/{$run_id}");
            if (is_wp_error($run)) return $run;

            if ($run->status === 'completed') {
                // Get messages after completion
                $messages = $this->list_messages($thread_id);
                if (is_wp_error($messages)) return $messages;

                // Get the content
                $content = $messages->data[0]->content[0]->text->value;
                
                // Return formatted response instead of streaming
                return [
                    'choices' => [
                        [
                            'message' => [
                                'content' => $content
                            ]
                        ]
                    ]
                ];

            } elseif (in_array($run->status, ['failed', 'cancelled', 'expired'])) {
                return new WP_Error('run_failed', "Run failed with status: {$run->status}");
            }

            $attempt++;
            sleep(1);
        }
        return new WP_Error('timeout', 'Run timed out');
    }

    private function list_messages_stream($thread_id) {
        $args = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->api_key,
                'Content-Type' => 'application/json',
                'OpenAI-Beta' => 'assistants=v2'
            ],
            'method' => 'GET',
            'stream' => true  // Enable streaming
        ];

        $response = wp_remote_request($this->base_url . "/threads/{$thread_id}/messages", $args);
        
        // ... handle streaming response
    }

    private function list_messages($thread_id) {
        return $this->make_request('GET', "/threads/{$thread_id}/messages");
    }

    private function make_request($method, $endpoint, $data = null) {
        $args = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->api_key,
                'Content-Type' => 'application/json',
                'OpenAI-Beta' => 'assistants=v2'
            ],
            'method' => $method
        ];

        if ($data !== null) {
            $args['body'] = json_encode($data);
        }

        $response = wp_remote_request($this->base_url . $endpoint, $args);

        if (is_wp_error($response)) {
            error_log('OpenAI API Error: ' . $response->get_error_message());
            return $response;
        }

        $body = json_decode(wp_remote_retrieve_body($response));
        $status = wp_remote_retrieve_response_code($response);

        if ($status !== 200) {
            error_log('OpenAI API Error: ' . wp_remote_retrieve_body($response));
            return new WP_Error('api_error', 'API request failed with status ' . $status);
        }

        return $body;
    }

    public function list_assistants() {
        $assistants = $this->make_request('GET', '/assistants?limit=100&order=desc');
        
        return $assistants;
    }
} 