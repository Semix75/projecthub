import React, { useEffect, useState } from "react";

function ChatView({ conversationId, token }) {
  const [messages, setMessages] = useState([]);
  const [content, setContent] = useState("");

  useEffect(() => {
    fetch(`/api/conversations/${conversationId}/messages`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    })
      .then((res) => res.json())
      .then(setMessages);
  }, [conversationId, token]);

  const handleSubmit = async (e) => {
    e.preventDefault();
    const response = await fetch("/api/messages", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${token}`,
      },
      body: JSON.stringify({
        content,
        conversation: `/api/conversations/${conversationId}`,
      }),
    });

    if (response.ok) {
      const newMessage = await response.json();
      setMessages((prev) => [...prev, newMessage]);
      setContent("");
    } else {
      console.error("Échec de l'envoi");
    }
  };

  return (
    <div style={{ padding: "2rem" }}>
      <h2>Conversation #{conversationId}</h2>
      <ul>
        {messages.map((m) => (
          <li key={m.id}>
            <strong>{m.sendBy}</strong>: {m.content}
          </li>
        ))}
      </ul>

      <form onSubmit={handleSubmit}>
        <input
          type="text"
          value={content}
          onChange={(e) => setContent(e.target.value)}
          placeholder="Écris ton message..."
          required
        />
        <button type="submit">Envoyer</button>
      </form>
    </div>
  );
}

export default ChatView;
