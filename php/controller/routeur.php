<?php

function chargerPage()
{
    $listeRoutes[""] = new Routes(["chemin" => "php/view/general/", "nomFichier" => "acceuil", "roleRequis" => 0]);
    $listeRoutes["Accueil"] = new Routes(["chemin" => "php/view/general/", "nomFichier" => "acceuil", "roleRequis" => 0]);
    $listeRoutes["Contact"] = new Routes(["chemin" => "php/view/general/", "nomFichier" => "contact", "roleRequis" => 0]);
    $listeRoutes["ContactAction"] = new Routes(["chemin" => "php/controller/action/", "nomFichier" => "ContactAction", "roleRequis" => 0]);
    $listeRoutes["Inscription"] = new Routes(["chemin" => "php/view/form/", "nomFichier" => "inscription", "roleRequis" => 0]);
    $listeRoutes["InscriptionAction"] = new Routes(["chemin" => "php/controller/action/", "nomFichier" => "InscriptionAction", "roleRequis" => 0]);
    $listeRoutes["Connexion"] = new Routes(["chemin" => "php/view/form/", "nomFichier" => "connexion", "roleRequis" => 0]);
    $listeRoutes["ConnexionAction"] = new Routes(["chemin" => "php/controller/action/", "nomFichier" => "ConnexionAction", "roleRequis" => 0]);

    require "php/view/general/header.php";
    $pageCherchee = isset($_GET['page']) ? $_GET['page'] : "";
    
    if (isset($listeRoutes[$pageCherchee]))
        if ($listeRoutes[$pageCherchee]->getRoleRequis()>0 )
            {
            if (isset($_SESSION['utilisateur']) && $listeRoutes[$pageCherchee]->getRoleRequis() <= $_SESSION['utilisateur']->getIdRole())
                require $listeRoutes[$pageCherchee]->getChemin() . $listeRoutes[$pageCherchee]->getNomFichier() . ".php";
            else require "php/view/general/droitInsuffisant.php";
        } else {
            require $listeRoutes[$pageCherchee]->getChemin() . $listeRoutes[$pageCherchee]->getNomFichier() . ".php";
        }
    else {
        require "php/view/general/acceuil.php";
    }

    require "php/view/general/footer.php";
}
