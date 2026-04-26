<?php

echo ' <header class="bg-dark p-1">
        <nav class="flex justify-between align-center container">
            <h2>ECF</h2>
            <div class="flex gap-1">';

// 1. Récupération des infos de navigation
$navInfo = Parametre::getNav();
$roleUtilisateur = isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur']->getIdRole() : 0;

foreach ($navInfo as $value) {
    // On vérifie les droits (Formulaire ne s'affichera plus car supprimé du JSON)
    if ($value->getRoleRequis() <= $roleUtilisateur) {
        $icon = $value->getIcon() ? $value->getIcon() : 'circle'; 

        echo '<a href="?page='.$value->getReference().'" class="td-none nav-icon">
                <span class="fas fa-'.$icon.'"></span>
                <span class="nav-text">'.$value->getNom().'</span>
              </a>';
    }
}

// 2. Boutons Connexion / Inscription / Déconnexion
if (isset($_SESSION['utilisateur'])) {
    // Si connecté : on affiche uniquement Déconnexion
    echo '<a href="?page=ConnexionAction&mode=deco" class="td-none nav-icon text-danger">
            <span class="fas fa-sign-out-alt"></span>
            <span class="nav-text">Déconnexion</span>
          </a>';
} else {
    // Si non connecté : on affiche Connexion ET Inscription
    echo '<a href="?page=ConnexionForm" class="td-none nav-icon text-success">
            <span class="fas fa-sign-in-alt"></span>
            <span class="nav-text">Connexion</span>
          </a>';
          
    echo '<a href="?page=InscriptionForm" class="td-none nav-icon text-info">
            <span class="fas fa-user-plus"></span>
            <span class="nav-text">Inscription</span>
          </a>';
}

echo '      </div>
        </nav>
    </header>
    <main class="container">
';