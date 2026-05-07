 
<!-- Chat Bot -->
<div class="chat-bot">
    <div class="chat-toggle" onclick="toggleChat()">
        <i class="fas fa-robot"></i>
    </div>
    <div class="chat-window" id="chatWindow">
        <div class="chat-header">
            <span><i class="fas fa-robot"></i> AI Assistant</span>
            <i class="fas fa-times" onclick="toggleChat()" style="cursor:pointer"></i>
        </div>
        <div class="chat-messages" id="chatMessages">
            <div class="bot-message">
                <p>Hello! I'm your AI assistant. How can I help you today? 😊</p>
            </div>
        </div>
        <div class="chat-input">
            <input type="text" id="chatInput" placeholder="Type your message..." onkeypress="if(event.key==='Enter') sendMessage()">
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>
</div>

<script>
function toggleChat() {
    document.getElementById('chatWindow').classList.toggle('active');
}

function sendMessage() {
    const input = document.getElementById('chatInput');
    const message = input.value.trim();
    if(message === '') return;
    
    const messagesDiv = document.getElementById('chatMessages');
    
    // Add user message
    messagesDiv.innerHTML += `
        <div class="message user-message">
            <p>${message}</p>
        </div>
    `;
    
    input.value = '';
    messagesDiv.scrollTop = messagesDiv.scrollHeight;
    
    // Send to AI API
    fetch('api/chat-response.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ message: message })
    })
    .then(response => response.json())
    .then(data => {
        messagesDiv.innerHTML += `
            <div class="message bot-message">
                <p>${data.response}</p>
            </div>
        `;
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    });
}
</script>
<script src="js/script.js"></script>
</body>
</html>