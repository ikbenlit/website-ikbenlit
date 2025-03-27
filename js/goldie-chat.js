jQuery(document).ready(function($) {
    const chatMessages = $('#chatMessages');
    const chatForm = $('#goldieChatForm');
    const userInput = $('#userMessage');

    // Handle Enter key
    userInput.on('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            chatForm.submit();
        }
    });

    // Auto-resize textarea
    userInput.on('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    // Scroll naar beneden bij het laden van de pagina
    function scrollToBottom() {
        const messagesContainer = chatMessages[0];
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    // Scroll direct naar beneden bij het laden
    scrollToBottom();

    chatForm.on('submit', function(e) {
        e.preventDefault();
        
        const message = userInput.val().trim();
        if (!message) return;

        // Reset textarea
        userInput.val('').css('height', 'auto');
        
        // Add user message
        appendMessage('user-message', message);
        
        // Create bot message container with typing indicator
        const botMessageDiv = $('<div class="bot-message"><div class="typing-indicator"><span></span><span></span><span></span></div><p></p></div>');
        chatMessages.append(botMessageDiv);
        const botMessageP = botMessageDiv.find('p');

        // Create EventSource for streaming
        const streamUrl = `${ajaxurl}?action=goldie_chat_stream&nonce=${goldieChat.nonce}&message=${encodeURIComponent(message)}`;
        const eventSource = new EventSource(streamUrl);

        let fullResponse = '';

        eventSource.onmessage = function(e) {
            const data = JSON.parse(e.data);
            
            if (data.error) {
                botMessageDiv.addClass('error');
                botMessageP.html(`Error: ${data.error}`);
                eventSource.close();
                return;
            }

            if (data.chunk) {
                fullResponse += data.chunk;
                botMessageDiv.find('.typing-indicator').remove();
                botMessageP.html(fullResponse);
                scrollToBottom();
            }
        };

        eventSource.onerror = function(e) {
            eventSource.close();
            botMessageDiv.find('.typing-indicator').remove();
        };
    });

    function appendMessage(className, message) {
        // Verwijder bestaande typing indicator
        $('.typing-indicator').remove();
        
        if (className === 'typing-indicator') {
            chatMessages.append(`
                <div class="typing-indicator active">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            `);
        } else {
            const messageDiv = $(`<div class="${className}"><p></p></div>`);
            chatMessages.append(messageDiv);
            
            if (className === 'bot-message') {
                // Typewriter effect voor bot berichten
                const p = messageDiv.find('p');
                let i = 0;
                const speed = 20; // ms per karakter
                
                function typeWriter() {
                    if (i < message.length) {
                        // Voeg HTML tags in één keer toe
                        if (message.substr(i).startsWith('<')) {
                            const endIndex = message.indexOf('>', i) + 1;
                            if (endIndex > i) {
                                p.html(p.html() + message.substring(i, endIndex));
                                i = endIndex;
                            } else {
                                p.html(p.html() + message[i]);
                                i++;
                            }
                        } else {
                            p.html(p.html() + message[i]);
                            i++;
                        }
                        
                        // Scroll naar beneden tijdens het typen
                        scrollToBottom();
                        setTimeout(typeWriter, speed);
                    }
                }
                
                typeWriter();
            } else {
                // Direct tonen voor gebruikersberichten
                messageDiv.find('p').html(message);
            }
        }
        
        setTimeout(scrollToBottom, 0);
    }
}); 