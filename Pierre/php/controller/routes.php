<?php

function chargerPage()
{
    $route[''] = new Route(["nom_fichier" => "accueil", "chemin" => "view/general/accueil","role_requis"=>0]);
    $route['accueil'] = new Route(["nom_fichier" => "accueil", "chemin" => "view/general/accueil","role_requis"=>0]);
    $route['contact'] = new Route(["nom_fichier" => "contact", "chemin" => "view/form/contact","role_requis"=>0]);
    $route['utilisateur_list'] = new Route(["nom_fichier" => "utilisateur_list", "chemin" => "view/list/utilisateur_list","role_requis"=>0]);
    $route['poste_list'] = new Route(["nom_fichier" => "poste_list", "chemin" => "view/list/poste_list","role_requis"=>0]);
    $route['connexion'] = new Route(["nom_fichier" => "connexion", "chemin" => "view/form/connexion","role_requis"=>0]);
    $route['test_ajax'] = new Route(["nom_fichier" => "test_ajax", "chemin" => "view/general/test_ajax","role_requis"=>0]);
    $route['utilisateur_form'] = new Route(["nom_fichier" => "utilisateur_form", "chemin" => "view/form/utilisateur_form","role_requis"=>0]);
    $route['poste_form'] = new Route(["nom_fichier" => "poste_form", "chemin" => "view/form/poste_form","role_requis"=>0]);
    $route['action_connexion'] = new Route(["nom_fichier" => "action_connexion", "chemin" => "controller/action/action_connexion","role_requis"=>0]);
    $route['action_deconnexion'] = new Route(["nom_fichier" => "action_deconnexion", "chemin" => "controller/action/action_deconnexion","role_requis"=>0]);
    $route['action_utilisateur'] = new Route(["nom_fichier" => "action_utilisateur", "chemin" => "controller/action/action_utilisateur","role_requis"=>0]);
    $route['action_poste'] = new Route(["nom_fichier" => "action_poste", "chemin" => "controller/action/action_poste","role_requis"=>0]);

    require "./php/view/general/head.php";
    require "./php/view/general/header.php";
    $page = isset($_GET["page"]) ? $_GET["page"] : "";
    if (isset($route[$page])) {
        require "./php/" . $route[$page]->get_chemin() . ".php";
    } else {
        require "./php/view/general/accueil.php";
    }

    require "./php/view/general/footer.php";
}

