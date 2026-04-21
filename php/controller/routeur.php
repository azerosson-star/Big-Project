<?php

function chargerPage()
{
    $listeRoutes[""] = new Routes(["chemin" => "php/view/general/", "nomFichier" => "Accueil", "roleRequis" => 0]);
    $listeRoutes["Accueil"] = new Routes(["chemin" => "php/view/general/", "nomFichier" => "Accueil", "roleRequis" => 0]);
    
    // CORRECTION ICI : "php/view/" au lieu de "php/view/list/"
    $listeRoutes["ProduitList"] = new Routes(["chemin" => "php/view/", "nomFichier" => "ProduitList", "roleRequis" => 1]);
    $listeRoutes["ProduitForm"] = new Routes(["chemin" => "php/view/form/", "nomFichier" => "ProduitForm", "roleRequis" => 0]);
    $listeRoutes["ProduitAction"] = new Routes(["chemin" => "php/controller/action/", "nomFichier" => "ProduitAction", "roleRequis" => 1]);
    
    // CORRECTION ICI : "php/view/" au lieu de "php/view/list/"
    $listeRoutes["UtilisateurList"] = new Routes(["chemin" => "php/view/", "nomFichier" => "UtilisateurList", "roleRequis" => 0]);
    $listeRoutes["UtilisateurForm"] = new Routes(["chemin" => "php/view/form/", "nomFichier" => "UtilisateurForm", "roleRequis" => 0]);
    $listeRoutes["UtilisateurAction"] = new Routes(["chemin" => "php/controller/action/", "nomFichier" => "UtilisateurAction", "roleRequis" => 0]);
    
    // CORRECTION ICI : "php/view/" au lieu de "php/view/list/"
    $listeRoutes["RoleList"] = new Routes(["chemin" => "php/view/", "nomFichier" => "RoleList", "roleRequis" => 1]);
    $listeRoutes["RoleForm"] = new Routes(["chemin" => "php/view/form/", "nomFichier" => "RoleForm", "roleRequis" => 0]);
    $listeRoutes["RoleAction"] = new Routes(["chemin" => "php/controller/action/", "nomFichier" => "RoleAction", "roleRequis" => 1]);

    $listeRoutes["ConnexionForm"] = new Routes(["chemin" => "php/view/form/", "nomFichier" => "ConnexionForm", "roleRequis" => 0]);
    $listeRoutes["ConnexionAction"] = new Routes(["chemin" => "php/controller/action/", "nomFichier" => "ConnexionAction", "roleRequis" => 0]);

    require "php/view/general/header.php";
    $pageCherchee = isset($_GET['page']) ? $_GET['page'] : "";
    
    if (isset($listeRoutes[$pageCherchee]))
        if ($listeRoutes[$pageCherchee]->getRoleRequis()>0 )
            {
            if (isset($_SESSION['utilisateur']) && $listeRoutes[$pageCherchee]->getRoleRequis() <= $_SESSION['utilisateur']->getIdRole())  // on compare role de l'utilisateur connecte au role requis minimum
                require $listeRoutes[$pageCherchee]->getChemin() . $listeRoutes[$pageCherchee]->getNomFichier() . ".php";
            else require "php/view/general/droitInsuffisant.php";
        } else {
            require $listeRoutes[$pageCherchee]->getChemin() . $listeRoutes[$pageCherchee]->getNomFichier() . ".php";
        }
    else {
        require "php/view/general/accueil.php";
    }

    require "php/view/general/footer.php";
}