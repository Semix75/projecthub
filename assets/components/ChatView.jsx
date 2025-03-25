import { useEffect, useState } from 'preact/hooks';

export default function ChatView({ conversationId, token }) {
  const [messages, setMessages] = useState([]);

  useEffect(() => {
    fetch(`http://localhost:8000/api/conversations/${conversationId}/messages`, {
        headers: {
          'Authorization': `Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE3NDI2ODE1NjcsImV4cCI6MTc0MjY4NTE2Nywicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6ImFkbWluIn0.B5Tb1i60f6VBv8pLjpMDj7HMTpKLZ88YxjEMVP_pzqovAdCjKm3BIIgg6nIQWMtT9TwW_XTUe0VxuGqWU6f7w03HlM3d4kB-CcUuIhwSKS8AbsYFVfVS5x1eITszeRSsymeZdF8P7UIwd6Wdg_bYs_F4-zJ2zqHM6IzDvnaoDVmWsNwIzhh0NW0ivIgBNrqzZ77A8wMiyi5ep-uXO8RSkCS1js8hytsFGPHLUNoq40n2lrJUO-qqJNZY7B4DfFvpTJKB74-hNjt2CECe-k9lNaPgXEVjdPShymik2w85nIteSq2cmFuO-YH822e8duCEi_o3peHMbNxbyRmicJGOFdYdkM-cqykdqLls6kRdEJd2bThKa8xNulRjz6qbxwc3xwroqZL9MbxLy9NMYmHFiHP-pZEiEO_z2zpP6vJjRrx3mOdbw3L7Mda_Ab0-3xtBlbKLXSbt9oS0HPrUXx_3ZUU0Vd5I9nosh8HRUKn7wUN4RPKJeFgaCbfEyoQTNXm74EfwdQ6t1abUqjtORqolcIiHeAPxnTMNgGiNDDRbMNvUKQqUqR4vgdvS6TzPAlyPFgmu_RidNYFjbmQ3rim8K_HKCzdWEQ86wxTb7hpQiQQWzoJoziJQvnxOWsWzPS0sCn0nJpJXE-Y3mjUIVfkdtRoHftJCjvX6jhmMraOKbAM`
        }
      })
      .then(response => response.json())
      .then(data => setMessages(data));
  }, [conversationId]);

  return (
    <div>
      <h2>Conversation #{conversationId}</h2>
      <ul>
        {messages.map(msg => (
          <li key={msg.id}>
            <strong>{msg.sendBy}:</strong> {msg.content}
            <br />
            <small>{new Date(msg.sendAt).toLocaleString()}</small>
          </li>
        ))}
      </ul>
    </div>
  );
}
