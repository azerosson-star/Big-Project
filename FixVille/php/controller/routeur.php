<?php

function chargerPage()
{
    // Routes générales
    $listeRoutes[""]          = new Routes(["chemin" => "php/view/general/", "nomFichier" => "Accueil",       "roleRequis" => 0]);
    $listeRoutes["Accueil"]   = new Routes(["chemin" => "php/view/general/", "nomFichier" => "Accueil",       "roleRequis" => 0]);
    $listeRoutes["Contact"]   = new Routes(["chemin" => "php/view/general/", "nomFichier" => "Contact",       "roleRequis" => 0]);
    $listeRoutes["Message"]   = new Routes(["chemin" => "php/view/general/", "nomFichier" => "Message",       "roleRequis" => 1]);
    $listeRoutes["Formulaire"]= new Routes(["chemin" => "php/view/general/", "nomFichier" => "Formulaire",    "roleRequis" => 0]);

    // Connexion
  // Connexion
    $listeRoutes["ConnexionForm"]   = new Routes(["chemin" => "php/view/form/",  "nomFichier" => "ConnexionForm",   "roleRequis" => 0]);
    $listeRoutes["ConnexionAction"] = new Routes(["chemin" => "php/action/",     "nomFichier" => "ConnexionAction", "roleRequis" => 0]);

    // Inscription
    $listeRoutes["InscriptionForm"]   = new Routes(["chemin" => "php/view/form/", "nomFichier" => "InscriptionForm",   "roleRequis" => 0]);
    $listeRoutes["InscriptionAction"] = new Routes(["chemin" => "php/action/",    "nomFichier" => "InscriptionAction", "roleRequis" => 0]);

    // Utilisateur
    $listeRoutes["UtilisateurList"]   = new Routes(["chemin" => "php/view/list/", "nomFichier" => "UtilisateurList",   "roleRequis" => 1]);
    $listeRoutes["UtilisateurForm"]   = new Routes(["chemin" => "php/view/form/", "nomFichier" => "UtilisateurForm",   "roleRequis" => 1]);
    $listeRoutes["UtilisateurAction"] = new Routes(["chemin" => "php/action/",    "nomFichier" => "UtilisateurAction", "roleRequis" => 1]);
    $listeRoutes["EspaceMembre"] = new Routes(["chemin" => "php/view/general/", "nomFichier" => "EspaceMembre", "roleRequis" => 1]);
    // Rôle
    $listeRoutes["RoleList"]   = new Routes(["chemin" => "php/view/list/", "nomFichier" => "RoleList",   "roleRequis" => 1]);
    $listeRoutes["RoleForm"]   = new Routes(["chemin" => "php/view/form/", "nomFichier" => "RoleForm",   "roleRequis" => 1]);
    $listeRoutes["RoleAction"] = new Routes(["chemin" => "php/action/",    "nomFichier" => "RoleAction", "roleRequis" => 1]);
   // Messagerie
$listeRoutes["MessageList"]   = new Routes(["chemin" => "php/view/list/", "nomFichier" => "MessageList",   "roleRequis" => 1]);
$listeRoutes["MessageForm"]   = new Routes(["chemin" => "php/view/form/", "nomFichier" => "MessageForm",   "roleRequis" => 1]);
$listeRoutes["MessageAction"] = new Routes(["chemin" => "php/action/",    "nomFichier" => "MessageAction", "roleRequis" => 1]);
   
    
    
    require "php/view/general/head.php";
    require "php/view/general/header.php";
    $pageCherchee = isset($_GET['page']) ? $_GET['page'] : "";

    if (isset($listeRoutes[$pageCherchee])) {
        if ($listeRoutes[$pageCherchee]->getRoleRequis() > 0) {
            // CORRECTION ICI : Remplacement de getIdRole() par getId_role()
            // Dans routeur.php
if (isset($_SESSION['utilisateur']) && $listeRoutes[$pageCherchee]->getRoleRequis() <= $_SESSION['utilisateur']->getId_role()) {
    require $listeRoutes[$pageCherchee]->getChemin() . $listeRoutes[$pageCherchee]->getNomFichier() . ".php";
} else {
    // S'il n'est pas autorisé, on le renvoie à la connexion !
    header("Location: ?page=ConnexionForm");
    exit;
}
        } else {
            require $listeRoutes[$pageCherchee]->getChemin() . $listeRoutes[$pageCherchee]->getNomFichier() . ".php";
        }
    } else {
        require "php/view/general/accueil.php";
    }

    require "php/view/general/footer.php";
}
