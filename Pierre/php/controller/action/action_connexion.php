<?php

$utilisateur_try = new Utilisateur($_POST);
$try_email = $utilisateur_try->get_email();
$try_pwd = $utilisateur_try->get_pwd() ;
$utilisateur_db = UtilisateurService::find_by_email($utilisateur_try->get_email());
$pwd_db = $utilisateur_db->get_pwd() ;
if ($pwd_db == $try_pwd) {
    echo 'Connexion reussie !';
    header("Refresh:1;url=index.php?page=accueil");
    $_SESSION['utilisateur']=$utilisateur_db;

} else {
    echo 'Connexion échouée...';
    header("Refresh:1;url=index.php?page=connexion");
}