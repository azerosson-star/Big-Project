<?php

$acceuil = <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Application | Accueil</title>
    <link rel="stylesheet" href="css/navbar+logo.css">
    <link rel="stylesheet" href="css/gen+root.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body>
    
    <header>
        <h1 class="logo">MON LOGO</h1>

        <nav>
            <div class="navbar">
                <input type="button"class="accueil" value="Accueil">
                <input type="button" class="produits"" value="Produits">
                <input type="button" class="apropos" value="À Propos">
                <input type="button" class="contect"value="Contact">
            </div>
        </nav>
    </header>
    <main class="hero-section">
        <div class="hero-content">
            <h1>Bienvenue sur MonApp</h1>
            <p>Votre slogan ici.</p>
            <a href="login.html" class="btn-primary btn-large">Commencer</a>
        </div>
    </main>

    <script src="script.js"></script>
</body>
</html>
HTML;
echo $acceuil;
