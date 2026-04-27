<?php
if (isset($_GET['mode']) && $_GET['mode'] == "deco") {
    session_destroy();
    session_start(); // On redémarre une session vide juste pour le message flash
    setFlash("Vous avez bien été déconnecté.", "success");
    header("location:?page=Accueil");
    exit;
} else {
    // Nettoyage de l'email
    $login = trim($_POST['login']);
    $userBase = UtilisateurService::findByLogin($login);  

    if ($userBase && password_verify($_POST['password'], $userBase->getMdp())) {  
        $_SESSION['utilisateur'] = $userBase;
        setFlash("Bienvenue " . $userBase->getPrenom() . " !", "success");
        header("location:?page=Accueil");
        exit;
    } else {
        setFlash("Email ou mot de passe incorrect.", "danger");
        header("location:?page=ConnexionForm");
        exit;
    }
}