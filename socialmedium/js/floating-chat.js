document.addEventListener('DOMContentLoaded', function() {
    const chatButton = document.querySelector('.chat-button');
    const chatOverlay = document.querySelector('.chat-overlay');
    const closeButton = document.querySelector('.close-chat');
    const chatInput = document.querySelector('#chat-input');
    const sendButton = document.querySelector('#send-message');
    const chatMessages = document.querySelector('.chat-messages');
    const speechBubbles = document.querySelector('.speech-bubbles');
    const closeBubbles = document.querySelector('.close-bubbles');
    
    // Show speech bubbles after 4 seconds
    setTimeout(() => {
        speechBubbles.setAttribute('aria-hidden', 'false');
    }, 4000);
    
    // Close speech bubbles
    closeBubbles.addEventListener('click', function() {
        speechBubbles.setAttribute('aria-hidden', 'true');
    });
    
    // Open chat
    chatButton.addEventListener('click', function() {
        chatOverlay.setAttribute('aria-hidden', 'false');
        speechBubbles.setAttribute('aria-hidden', 'true');
        chatInput.focus();
        document.body.style.overflow = 'hidden';
    });
    
    // Close chat
    closeButton.addEventListener('click', function() {
        chatOverlay.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    });
    
    // Close on overlay click
    chatOverlay.addEventListener('click', function(e) {
        if (e.target === chatOverlay) {
            chatOverlay.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }
    });
    
    // Send message on enter
    chatInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && !e.shiftKey && chatInput.value.trim()) {
            sendMessage();
        }
    });
    
    // Send message on button click
    sendButton.addEventListener('click', function() {
        if (chatInput.value.trim()) {
            sendMessage();
        }
    });
    
    function sendMessage() {
        const message = chatInput.value.trim();
        
        // Add user message
        const userMessage = document.createElement('div');
        userMessage.className = 'user-message';
        userMessage.textContent = message;
        chatMessages.appendChild(userMessage);
        
        // Clear input and scroll
        chatInput.value = '';
        chatMessages.scrollTop = chatMessages.scrollHeight;
        
        // Show typing indicator
        const typingIndicator = document.createElement('div');
        typingIndicator.className = 'bot-message typing';
        typingIndicator.textContent = '...';
        chatMessages.appendChild(typingIndicator);
        chatMessages.scrollTop = chatMessages.scrollHeight;
        
        // Send to WordPress backend
        fetch(ajaxurl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'chatbot_message',
                message: message
            })
        })
        .then(response => response.json())
        .then(data => {
            // Remove typing indicator
            typingIndicator.remove();
            
            // Add bot response
            const botMessage = document.createElement('div');
            botMessage.className = 'bot-message';
            botMessage.textContent = data.data;
            chatMessages.appendChild(botMessage);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        })
        .catch(error => {
            // Remove typing indicator
            typingIndicator.remove();
            
            // Show error message
            const errorMessage = document.createElement('div');
            errorMessage.className = 'bot-message error';
            errorMessage.textContent = 'Sorry, er ging iets mis. Probeer het later nog eens.';
            chatMessages.appendChild(errorMessage);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        });
    }
}); 