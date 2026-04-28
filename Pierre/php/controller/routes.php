<?php

function charger_page()
{
    $route['']                   = new Route(["chemin" => "view/general/accueil", "role_requis" => 1]);
    $route['accueil']            = new Route(["chemin" => "view/general/accueil", "role_requis" => 1]);
    $route['contact']            = new Route(["chemin" => "view/form/contact", "role_requis" => 1]);
    $route['utilisateur_list']   = new Route(["chemin" => "view/list/utilisateur_list", "role_requis" => 2]);
    $route['connexion']          = new Route(["chemin" => "view/form/connexion", "role_requis" => 1]);
    $route['utilisateur_form']   = new Route(["chemin" => "view/form/utilisateur_form", "role_requis" => 1]);
    $route['test_ajax']          = new Route(["chemin" => "view/form/test_ajax", "role_requis" => 2]);
    $route['action_connexion']   = new Route(["chemin" => "controller/action/action_connexion", "role_requis" => 1]);
    $route['action_utilisateur'] = new Route(["chemin" => "controller/action/action_utilisateur", "role_requis" => 1]);

    require "./php/view/general/head.php";
    require "./php/view/general/header.php";
    $page         = isset($_GET["page"]) ? $_GET["page"] : "";
    $role_session = DAO::find_by_id('role', $_SESSION['utilisateur']->get_id_role())->get_niveau_perm();
    if (isset($route[$page]) || ($route[$page]->get_role_requis() <= $role_session)) {
        require "./php/" . $route[$page]->get_chemin() . ".php";
    } else {
        require "./php/view/general/accueil.php";
    }
    require "./php/view/general/footer.php";
}
