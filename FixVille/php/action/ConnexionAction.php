<?php
if (isset($_GET['mode']) && $_GET['mode'] == "deco") session_destroy();
else {
    $userSaisi = new Utilisateur($_POST);
    $userBase = UtilisateurService::findByLogin($_POST['login']);
    
    // J'ai ajouté une petite vérification ($userBase != null) au cas où le login tapé n'existe pas
    if ($userBase && hashage($userSaisi->getPassword()) == $userBase->getPassword()) {
        // utilisateur connecté
        $_SESSION['utilisateur'] = $userBase;
        header("location:?Accueil");
    } else {
        //retour au formulaire
        header("location:?ConnexionForm");
    }
}