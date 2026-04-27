<?php

function charger_page()
{
    $route[''] = new Route(["chemin" => "view/general/accueil","role_requis"=>0]);
    $route['accueil'] = new Route(["chemin" => "view/general/accueil","role_requis"=>0]);
    $route['contact'] = new Route(["chemin" => "view/form/contact","role_requis"=>0]);
    $route['utilisateur_list'] = new Route(["chemin" => "view/list/utilisateur_list","role_requis"=>0]);
    $route['connexion'] = new Route(["chemin" => "view/form/connexion","role_requis"=>0]);
    $route['utilisateur_form'] = new Route(["chemin" => "view/form/utilisateur_form","role_requis"=>0]);
    $route['test_ajax'] = new Route(["chemin" => "view/form/test_ajax","role_requis"=>0]);
    $route['action_connexion'] = new Route(["chemin" => "controller/action/action_connexion","role_requis"=>0]);
    $route['action_utilisateur'] = new Route(["chemin" => "controller/action/action_utilisateur","role_requis"=>0]);

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

