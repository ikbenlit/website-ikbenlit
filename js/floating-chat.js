document.addEventListener('DOMContentLoaded', function() {
    let chatResponses;
    const chatButton = document.querySelector('.chat-button');
    const chatOverlay = document.querySelector('.chat-overlay');
    const closeChat = document.querySelector('.close-chat');
    const chatMessages = document.querySelector('.chat-messages');
    const chatInput = document.querySelector('#chat-input');
    const sendButton = document.querySelector('#send-message');
    const speechBubbles = document.querySelector('.speech-bubbles');
    const closeBubbles = document.querySelector('.close-bubbles');

    // Clear any existing messages
    chatMessages.innerHTML = '';

    // Load chat responses
    fetch(chatConfig.themeUrl + '/js/chat-responses.json')
        .then(response => response.json())
        .then(data => {
            chatResponses = data;
            // Only show greeting if no messages exist
            if (chatMessages.children.length === 0) {
                showGreeting();
            }
        })
        .catch(error => {
            console.error('Error loading chat responses:', error);
            // Show error message in chat
            addMessage('bot', 'Sorry, er is iets misgegaan bij het laden van de chat. Probeer de pagina te verversen.');
        });

    // Show initial greeting after 4 seconds
    setTimeout(() => {
        if (speechBubbles) {
            speechBubbles.setAttribute('aria-hidden', 'false');
        }
    }, 4000);

    // Chat button click handler
    chatButton.addEventListener('click', () => {
        chatOverlay.setAttribute('aria-hidden', 'false');
        speechBubbles.setAttribute('aria-hidden', 'true');
    });

    // Close chat handler
    closeChat.addEventListener('click', () => {
        chatOverlay.setAttribute('aria-hidden', 'true');
    });

    // Close speech bubbles handler
    closeBubbles.addEventListener('click', () => {
        speechBubbles.setAttribute('aria-hidden', 'true');
    });

    // Send message handlers
    sendButton.addEventListener('click', handleSendMessage);
    chatInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            handleSendMessage();
        }
    });

    function handleSendMessage() {
        const message = chatInput.value.trim();
        if (message) {
            addMessage('user', message);
            chatInput.value = '';
            processMessage(message);
        }
    }

    function addMessage(type, text) {
        const messageDiv = document.createElement('div');
        messageDiv.className = type === 'user' ? 'user-message' : 'bot-message';
        messageDiv.textContent = text;
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function showGreeting() {
        if (chatResponses) {
            // Pick a random greeting
            const randomIndex = Math.floor(Math.random() * chatResponses.greetings.length);
            addMessage('bot', chatResponses.greetings[randomIndex]);
        }
    }

    function processMessage(message) {
        // Add typing indicator
        const typingIndicator = document.createElement('div');
        typingIndicator.className = 'bot-message typing';
        typingIndicator.innerHTML = '<span>.</span><span>.</span><span>.</span>';
        chatMessages.appendChild(typingIndicator);

        // First try to find a local response
        const localResponse = findLocalResponse(message.toLowerCase());
        
        // Check if it's a fallback response by comparing with all fallbacks
        const isFallbackResponse = chatResponses.fallbacks.includes(localResponse);
        
        if (!isFallbackResponse) {
            // If we found a specific local response, use it
            setTimeout(() => {
                chatMessages.removeChild(typingIndicator);
                addMessage('bot', localResponse);
            }, 1000);
        } else {
            // If no specific local response, use OpenAI API
            fetch(chatConfig.ajaxurl, {
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
                chatMessages.removeChild(typingIndicator);
                // Handle both possible response formats
                const botResponse = data.data || data.response || data;
                addMessage('bot', botResponse);
            })
            .catch(error => {
                console.error('API error:', error);
                chatMessages.removeChild(typingIndicator);
                // Use a random fallback message on error
                const randomFallback = chatResponses.fallbacks[Math.floor(Math.random() * chatResponses.fallbacks.length)];
                addMessage('bot', randomFallback);
            });
        }
    }

    function findLocalResponse(message) {
        if (!chatResponses) return "Sorry, er is iets misgegaan. Probeer het later nog eens.";

        // Check each topic's keywords
        for (const [topic, data] of Object.entries(chatResponses.topics)) {
            if (data.keywords.some(keyword => message.includes(keyword.toLowerCase()))) {
                return data.response;
            }
        }

        // If no match found, return random fallback message
        const randomIndex = Math.floor(Math.random() * chatResponses.fallbacks.length);
        return chatResponses.fallbacks[randomIndex];
    }
}); 