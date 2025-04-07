<?php
/**
 * Template Name: Goldie Chatbot
 */

// Verwijder header en footer
remove_action('get_header', 'wp_enqueue_scripts', 1);
remove_action('wp_head', '_wp_render_title_tag', 1);
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div class="goldie-chat-container">
        <div class="chat-header">
            Goldie Chat
        </div>
        <div id="chatMessages" class="goldie-chat-messages">
            <div class="bot-message">
                <p>Hallo! Ik ben Goldie. Hoe kan ik je vandaag helpen?</p>
            </div>
        </div>
        <form id="goldieChatForm" class="goldie-chat-form">
            <div class="input-wrapper">
                <textarea 
                    id="userMessage" 
                    placeholder="Stel je vraag aan Goldie..." 
                    rows="1"
                ></textarea>
                <button type="submit">
                    <svg class="send-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22 2L11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M22 2L15 22L11 13L2 9L22 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
    <?php wp_footer(); ?>
</body>
</html> 