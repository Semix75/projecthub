import { render } from 'preact';
import ChatView from './components/ChatView';

const el = document.getElementById('chat');
if (el) {
  const token = el.dataset.token;
  const conversationId = el.dataset.conversationId;

  render(
    <ChatView conversationId={conversationId} token={token} />,
    el
  );
}