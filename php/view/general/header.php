<?php

echo ' <header class="bg-dark p-1">
        <nav class="flex justify-between align-center container">
            <h2>ECF</h2>
            <div class="flex gap-1">';

// 1. Récupération des infos de navigation et du rôle de l'utilisateur connecté
$navInfo = Parametre::getNav();
// Si un utilisateur est connecté on prend son rôle, sinon le rôle est 0 (visiteur)
$roleUtilisateur = isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur']->getIdRole() : 0;

foreach ($navInfo as $value) {
    // 2. On vérifie si l'utilisateur a le droit de voir ce lien
    if ($value->getRoleRequis() <= $roleUtilisateur) {
        
        // 3. Gestion de l'icône (sécurité si l'icône n'est pas définie dans le JSON)
        $icon = $value->getIcon() ? $value->getIcon() : 'circle'; 

        echo '<a href="?page='.$value->getReference().'" class="td-none nav-icon">
                <span class="fas fa-'.$icon.'"></span>
                <span class="nav-text">'.$value->getNom().'</span>
              </a>';
    }
}

// 4. Boutons Connexion / Déconnexion
if (isset($_SESSION['utilisateur'])) {
    // Si connecté : on affiche Déconnexion
    echo '<a href="?page=ConnexionAction&mode=deco" class="td-none nav-icon text-danger">
            <span class="fas fa-sign-out-alt"></span>
            <span class="nav-text">Déconnexion</span>
          </a>';
} else {
    // Si non connecté : on affiche Connexion
    echo '<a href="?page=ConnexionForm" class="td-none nav-icon text-success">
            <span class="fas fa-sign-in-alt"></span>
            <span class="nav-text">Connexion</span>
          </a>';
}

echo '      </div>
        </nav>
    </header>
    <main class="container">
';