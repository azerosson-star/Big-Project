document.getElementById('btn-calcul').addEventListener('click', () => {
    const material = document.getElementById('material').value;
    const surface = document.getElementById('surface').value;
    const resultParagraph = document.getElementById('result');

    if (!surface || isNaN(surface) || surface <= 0) {
        resultParagraph.textContent = 'Veuillez entrer une surface valide (nombre positif).';
        return;
    }

    const prompt = `Estime le coût de construction pour ${surface} m² avec le matériau suivant : ${material}. Donne un prix approximatif en euros avec une explication courte.`;

    resultParagraph.textContent = 'Calcul en cours...';

    fetch('http://localhost:3000/api/prix', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ prompt })
    })
    .then(response => {
        if (!response.ok) throw new Error(`Erreur HTTP ${response.status}`);
        return response.json();
    })
    .then(data => {
        resultParagraph.textContent = data.text;
    })
    .catch(error => {
        resultParagraph.textContent = 'Erreur : ' + error.message;
        console.error('Fetch error:', error);
    });
});