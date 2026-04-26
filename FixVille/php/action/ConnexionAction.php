<?php
if (isset($_GET['mode']) && $_GET['mode'] == "deco") {
    session_destroy();
    header("location:?page=Accueil");
    exit;
} else {
    $userBase = UtilisateurService::findByLogin($_POST['login']);  

    if ($userBase && password_verify($_POST['password'], $userBase->getMdp())) {  
        $_SESSION['utilisateur'] = $userBase;
        header("location:?page=Accueil");
        exit;
    } else {
        header("location:?page=ConnexionForm");
        exit;
    }
}