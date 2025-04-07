document.addEventListener('DOMContentLoaded', function() {
    const chatMessages = document.getElementById('chat-messages');
    const chatInput = document.getElementById('chat-input');
    const sendButton = document.getElementById('send-message');

    // Add welcome message
    function addWelcomeMessage() {
        const welcomeMessage = "Welkom bij de ikbenlit Terminal! Hoe kan ik je helpen vandaag?";
        addMessage(welcomeMessage, false);
    }

    function addMessage(message, isUser = false) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `chat-message ${isUser ? 'user-message' : 'bot-message'}`;
        messageDiv.textContent = message;
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Voeg conciseness selector toe
    const conciseness = document.getElementById('conciseness-select');
    
    async function sendMessage() {
        const message = chatInput.value.trim();
        if (!message) return;
        
        // Input validatie
        if (message.length > 1000) {
            addMessage('Bericht is te lang (maximum 1000 tekens)', false);
            return;
        }

        // Anti-spam: Voorkom snelle opeenvolgende berichten
        if (sendButton.disabled) return;
        
        sendButton.disabled = true;
        setTimeout(() => { sendButton.disabled = false; }, 1000);

        addMessage(message, true);
        chatInput.value = '';
        chatInput.focus();

        const endpoint = chatbotSettings.root + 'ikbenlit/v1/chat';
        console.log('Sending request to:', endpoint);
        console.log('Message:', message);
        console.log('Nonce:', chatbotSettings.nonce);

        try {
            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-WP-Nonce': chatbotSettings.nonce
                },
                body: JSON.stringify({ 
                    message,
                    conciseness: conciseness.value
                })
            });

            console.log('Response status:', response.status);
            const responseText = await response.text();
            console.log('Raw response:', responseText);

            let data;
            try {
                data = JSON.parse(responseText);
            } catch (e) {
                console.error('JSON parse error:', e);
                addMessage('Fout: Ongeldig antwoord van de server');
                return;
            }

            if (response.ok && data.response) {
                addMessage(data.response);
            } else {
                console.error('API error:', data);
                addMessage('Fout: ' + (data.message || 'Er ging iets mis. Probeer het opnieuw.'));
            }
        } catch (error) {
            console.error('Network error:', error);
            addMessage('Fout: Er ging iets mis met de verbinding. Probeer het opnieuw.');
        }
    }

    sendButton.addEventListener('click', sendMessage);
    chatInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });

    // Voeg event listener toe om de placeholder optie te beheren
    conciseness.addEventListener('change', function() {
        if (this.value === 'normal') {
            this.firstElementChild.text = 'Kies antwoordstijl';
        }
    });

    // Reset naar placeholder als er geen waarde is geselecteerd
    conciseness.addEventListener('blur', function() {
        if (this.value === 'normal') {
            this.firstElementChild.text = 'Kies antwoordstijl';
        }
    });

    // Show welcome message on load
    addWelcomeMessage();
}); 