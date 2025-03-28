import React, { useEffect, useState } from 'react';

const ChatView = ({ conversationId, token }) => {
    const [messages, setMessages] = useState([]);
    const [newMessage, setNewMessage] = useState('');
    const [user, setUser] = useState(null);

    // Récupération de l'utilisateur connecté
    useEffect(() => {
        fetch('/api/me', {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        })
            .then(res => {
                if (!res.ok) {
                    throw new Error('Impossible de récupérer le user connecté');
                }
                return res.json();
            })
            .then(data => setUser(data))
            .catch(err => console.error('Erreur récupération user :', err));
    }, [token]);

    // Récupération des messages de la conversation
    useEffect(() => {
        fetch(`/api/conversations/${conversationId}/messages`, {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        })
            .then(res => {
                if (!res.ok) {
                    throw new Error('Erreur de chargement des messages');
                }
                return res.json();
            })
            .then(data => setMessages(data))
            .catch(err => console.error('Erreur chargement messages :', err));
    }, [conversationId, token]);

    // Abonnement à Mercure
    useEffect(() => {
        const url = new URL('http://localhost:3000/.well-known/mercure');
        url.searchParams.append('topic', `/conversations/${conversationId}`);

        const eventSource = new EventSource(url, { withCredentials: true });

        eventSource.onmessage = (event) => {
            const data = JSON.parse(event.data);
            setMessages(prev => [...prev, data]);
        };

        eventSource.onerror = (err) => {
            console.error('Erreur EventSource Mercure :', err);
        };

        return () => {
            eventSource.close();
        };
    }, [conversationId]);

    // Envoi du message
    const handleSubmit = (e) => {
        e.preventDefault();

        if (!newMessage.trim()) return;

        fetch('/api/messages', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                Authorization: `Bearer ${token}`,
            },
            body: JSON.stringify({
                content: newMessage,
                conversation: `/api/conversations/${conversationId}`,
            }),
        })
            .then(res => {
                if (!res.ok) {
                    throw new Error('Erreur lors de l’envoi du message');
                }
                return res.json();
            })
            .then((data) => {
                setNewMessage('');
                console.log("Message envoyé :", data);
                // Le message arrivera automatiquement via Mercure
            })
            .catch((err) => {
                console.error(err);
            });
    };

    if (!user) return <p>Chargement de l’utilisateur...</p>;

    return (
        <div>
            <h2>Conversation #{conversationId}</h2>
            <ul>
                {messages.map((msg) => (
                    <li key={msg.id}>
                        <strong>{msg.sendBy?.username ?? '??'}:</strong> {msg.content}
                    </li>
                ))}
            </ul>

            <form onSubmit={handleSubmit}>
                <input
                    type="text"
                    value={newMessage}
                    onChange={(e) => setNewMessage(e.target.value)}
                    placeholder="Votre message..."
                />
                <button type="submit">Envoyer</button>
            </form>
        </div>
    );
};

export default ChatView;
