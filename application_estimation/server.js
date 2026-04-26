const express = require('express');
const cors = require('cors');
const fetch = require('node-fetch');

const app = express();
const PORT = 3000;

// Middleware
app.use(cors());         // autorise les requêtes depuis http://127.0.0.1:5500 par exemple
app.use(express.json()); // parse le JSON des requêtes

const DEEPSEEK_API_KEY = 'sk-d0ab27e31626475ab4e52dcdc9e2ec79'; // Attention : ne jamais mettre une clé en clair en production !

app.post('/api/prix', async (req, res) => {
    const { prompt } = req.body;

    if (!prompt) {
        return res.status(400).json({ erreur: "Le champ 'prompt' est requis" });
    }

    try {
        const response = await fetch('https://api.deepseek.com/chat/completions', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${DEEPSEEK_API_KEY}`
            },
            body: JSON.stringify({
                model: 'deepseek-chat',
                messages: [{ role: 'user', content: prompt }]
            })
        });

        if (!response.ok) {
            const errorText = await response.text();
            console.error('DeepSeek API error:', errorText);
            return res.status(response.status).json({ erreur: `API DeepSeek a répondu ${response.status}` });
        }

        const data = await response.json();
        const text = data.choices[0].message.content.trim();
        res.json({ text });
    } catch (err) {
        console.error('Server error:', err);
        res.status(500).json({ erreur: err.message });
    }
});

app.listen(PORT, () => {
    console.log(`Serveur démarré sur http://localhost:${PORT}`);
});