<?php
if (!$_POST) {
    session_destroy();
    echo'Déconnexion réussie';
    header("Refresh:1;url=?page=accueil");
} else {
    $identifiant = $_POST['identifiant'];
    if (str_contains($identifiant, '@')) {
        $identifiant_type = 'email';
    } else {
        $identifiant_type = 'tel';
    }
    $utilisateur_essai = new Utilisateur([$identifiant_type => $identifiant, 'mdp' => $_POST['mdp']]);
    $utilisateur_db    = DAO::select('utilisateur', null, [$identifiant_type => $identifiant]);
    if ($utilisateur_db && $utilisateur_essai->get_mdp() == $utilisateur_db[0]->get_mdp()) {
        echo'Connexion réussie';
        header("Refresh:1;url=?page=accueil");
        $_SESSION['utilisateur'] = $utilisateur_db[0];
    } else {
        echo 'Connexion échouée, identifiant ou mot de passe incorrect';
        header("Refresh:1;url=?page=connexion");
    }
}
