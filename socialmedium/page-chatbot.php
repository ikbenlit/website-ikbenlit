<?php
/**
 * Template Name: Chatbot Page
 */

get_header();

// Debug info
error_log('Loading chatbot page');
error_log('REST URL: ' . esc_url_raw(rest_url()));
error_log('Nonce: ' . wp_create_nonce('wp_rest'));
?>

<main class="site-main">
    <div class="chatbot-interface">
        <div class="chat-header">Spark Terminal v1.0</div>
        <div id="chat-messages" class="chat-messages"></div>
        <div class="chat-input-container">
            <div class="input-wrapper">
                <input type="text" id="chat-input" placeholder="Type je bericht hier..." autocomplete="off">
                <button id="send-message" aria-label="Verstuur bericht">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.01 21L23 12L2.01 3L2 10L17 12L2 14L2.01 21Z" fill="currentColor"/>
                    </svg>
                </button>
            </div>
            <div class="style-selector">
                <select id="conciseness-select" class="conciseness-select">
                    <option value="normal">Kies antwoordstijl</option>
                    <option value="concise">Beknopt</option>
                    <option value="explanatory">Uitgebreid</option>
                    <option value="formal">Formeel</option>
                </select>
                <div class="style-icon">📝</div>
            </div>
        </div>
    </div>
</main>

<?php
// Voeg de nonce en root URL toe aan de pagina als JavaScript variabelen
wp_enqueue_script('chatbot-script', get_template_directory_uri() . '/js/chatbot.js', array('jquery'), '1.0.0', true);
wp_localize_script('chatbot-script', 'chatbotSettings', array(
    'nonce' => wp_create_nonce('wp_rest'),
    'root' => esc_url_raw(rest_url())
));

// Debug output
error_log('Chatbot settings: ' . print_r(array(
    'nonce' => wp_create_nonce('wp_rest'),
    'root' => esc_url_raw(rest_url())
), true));

get_footer();
?> 