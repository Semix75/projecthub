import React from 'react';
import { createRoot } from 'react-dom/client';
import ChatView from './components/ChatView';

const el = document.getElementById('chat-app');

if (el) {
    const conversationId = el.dataset.conversationId;
    const token = el.dataset.jwtToken;

    const root = createRoot(el);
    root.render(<ChatView conversationId={conversationId} token={token} />);
}
    