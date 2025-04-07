<?php
/**
 * Claude API Integration Class
 * 
 * Deze class verzorgt de integratie met de Anthropic Claude 3.5 Haiku API voor WordPress.
 */
class Claude_API {
    /**
     * API configuratie eigenschappen
     */
    private $api_key;
    private $api_url = 'https://api.anthropic.com/v1/messages';
    private $config;
    
    /**
     * Constructor: Initialiseert de API key
     */
    public function __construct() {
        error_log('=== Claude API Initialization ===');
        error_log('CLAUDE_API_KEY defined: ' . (defined('CLAUDE_API_KEY') ? 'Yes' : 'No'));
        if (defined('CLAUDE_API_KEY')) {
            error_log('CLAUDE_API_KEY length: ' . strlen(CLAUDE_API_KEY));
            error_log('CLAUDE_API_KEY first 20 chars: ' . substr(CLAUDE_API_KEY, 0, 20) . '...');
        }
        
        $this->api_key = defined('CLAUDE_API_KEY') ? CLAUDE_API_KEY : get_option('claude_api_key');
        error_log('Final API key length: ' . strlen($this->api_key));
        error_log('Final API key first 20 chars: ' . substr($this->api_key, 0, 20) . '...');
        error_log('=== End Initialization ===');
        $this->load_config();
    }

    private function load_config() {
        $config_file = dirname(__FILE__) . '/../config/claude-config.json';
        
        if (file_exists($config_file)) {
            error_log('Loading config from JSON file: ' . $config_file);
            $config_json = file_get_contents($config_file);
            $this->config = json_decode($config_json, true);
            
            if (json_last_error() === JSON_ERROR_NONE) {
                error_log('Successfully loaded JSON config');
                return;
            }
            error_log('Failed to parse JSON config: ' . json_last_error_msg());
        }

        // Fallback naar hardcoded config
        error_log('Using fallback hardcoded config');
        $this->config = array(
            'model_config' => array(
                'model' => 'claude-3-haiku-20240307',
                'temperature' => 0.7,
                'conciseness_levels' => array(
                    'concise' => array(
                        'instruction' => 'Wees beknopt en to-the-point.',
                        'max_tokens' => 512
                    ),
                    'normal' => array(
                        'instruction' => 'Geef complete maar efficiënte antwoorden.',
                        'max_tokens' => 1024
                    ),
                    'detailed' => array(
                        'instruction' => 'Geef gedetailleerde en uitgebreide antwoorden.',
                        'max_tokens' => 2048
                    )
                )
            ),
            'system_prompts' => array(
                'default' => array(
                    'instruction' => "Je bent Spark de AI assistent op de ikbenlit website. " .
                        "Je specialiseert je in AI development en consultancy. " .
                        "Je communiceert altijd in het Nederlands met een professionele maar toegankelijke toon. " .
                        "Als je iets niet weet, zeg je dat eerlijk. " .
                        "Je antwoorden zijn bondig en to-the-point, perfect passend bij een chat-interface. " .
                        "Je stelt je voor als: 'Hallo! Ik ben Spark de AI-assistent van ikbenlit. Hoe kan ik je vandaag helpen?'"
                )
            )
        );
    }

    public function send_message($message, $prompt_type = 'default', $conciseness = 'normal') {
        error_log('=== Claude API Send Message Start ===');
        error_log('API URL: ' . $this->api_url);
        error_log('Message: ' . $message);
        error_log('API Key first 10 chars: ' . substr($this->api_key, 0, 10) . '...');
        error_log('Authorization header: Bearer ' . substr($this->api_key, 0, 10) . '...');
        
        try {
            if (empty($this->api_key)) {
                error_log('Claude API key is missing');
                return $this->error_response('Claude API key is not configured');
            }

            // Bijgewerkte headers voor Claude 3.5
            $headers = array(
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . trim($this->api_key),
                'anthropic-version' => '2023-06-01',
                'x-api-key' => trim($this->api_key)
            );

            error_log('Full Authorization header: ' . $headers['Authorization']);

            $system_message = $this->config['system_prompts'][$prompt_type]['instruction'];
            $conciseness_config = $this->config['model_config']['conciseness_levels'][$conciseness];

            // Bijgewerkt request format voor Claude 3.5
            $body = array(
                'model' => $this->config['model_config']['model'],
                'messages' => array(
                    array(
                        'role' => 'user',
                        'content' => $message
                    )
                ),
                'system' => $system_message,
                'max_tokens' => $conciseness_config['max_tokens'],
                'temperature' => $this->config['model_config']['temperature']
            );

            error_log('Request Headers: ' . print_r($headers, true));
            error_log('Request Body: ' . json_encode($body));

            $response = wp_remote_post($this->api_url, array(
                'headers' => $headers,
                'body' => json_encode($body),
                'timeout' => 30,
                'sslverify' => true
            ));

            if (is_wp_error($response)) {
                error_log('WP_Error in API request: ' . $response->get_error_message());
                return $this->error_response('WordPress error: ' . $response->get_error_message());
            }

            $status_code = wp_remote_retrieve_response_code($response);
            $response_body = wp_remote_retrieve_body($response);
            
            error_log('Response Status Code: ' . $status_code);
            error_log('Raw Response Body: ' . $response_body);

            $data = json_decode($response_body, true);

            if ($status_code !== 200) {
                error_log('API Error - Status Code: ' . $status_code);
                return $this->error_response('API returned error: ' . $status_code . ' - ' . ($data['error']['message'] ?? 'Unknown error'));
            }

            if (isset($data['content'][0]['text'])) {
                error_log('=== Claude API Send Message Success ===');
                return array(
                    'success' => true,
                    'message' => $data['content'][0]['text']
                );
            }

            error_log('=== Claude API Send Message Failed - Unexpected Response ===');
            return $this->error_response('Unexpected API response structure');

        } catch (Exception $e) {
            error_log('Exception in send_message: ' . $e->getMessage());
            return $this->error_response('Server error: ' . $e->getMessage());
        }
    }

    private function error_response($message) {
        error_log('Error Response: ' . $message);
        return array(
            'success' => false,
            'message' => $message
        );
    }
}  // End of class