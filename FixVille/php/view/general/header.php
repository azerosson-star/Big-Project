<?php
$headerTopHtml = <<<HTML
<header class="bg-dark p-1">
    <nav class="flex justify-between align-center container">
        <h2>FIXVILLE</h2>
        <div class="flex gap-1">
HTML;
echo $headerTopHtml;

$navInfo = Parametre::getNav();
$roleUtilisateur = isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur']->getId_role() : 0;

foreach ($navInfo as $value) {
    if ($value->getRoleRequis() <= $roleUtilisateur) {
        $icon = $value->getIcon() ? $value->getIcon() : 'circle'; 
        $ref = $value->getReference();
        $nom = $value->getNom();

        $navLinkHtml = <<<HTML
            <a href="?page={$ref}" class="td-none nav-icon">
                <span class="fas fa-{$icon}"></span>
                <span class="nav-text">{$nom}</span>
            </a>
HTML;
        echo $navLinkHtml;
    }
}

if (isset($_SESSION['utilisateur'])) {
    $btnDecoHtml = <<<HTML
            <a href="?page=ConnexionAction&mode=deco" class="td-none nav-icon text-danger">
                <span class="fas fa-sign-out-alt"></span>
                <span class="nav-text">Déconnexion</span>
            </a>
HTML;
    echo $btnDecoHtml;
} else {
    $btnLogHtml = <<<HTML
            <a href="?page=ConnexionForm" class="td-none nav-icon text-success">
                <span class="fas fa-sign-in-alt"></span>
                <span class="nav-text">Connexion</span>
            </a>
            <a href="?page=InscriptionForm" class="td-none nav-icon text-info">
                <span class="fas fa-user-plus"></span>
                <span class="nav-text">Inscription</span>
            </a>
HTML;
    echo $btnLogHtml;
}

$headerBottomHtml = <<<HTML
        </div>
    </nav>
</header>
<main class="container">
HTML;
echo $headerBottomHtml;

// ON AFFICHE LES MESSAGES FLASH ICI (S'IL Y EN A)
displayFlash();