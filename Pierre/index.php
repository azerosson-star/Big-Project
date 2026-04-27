<?php

function ChargerClasse($classe)
{
    if (file_exists("./php/controller/classes/" . $classe . ".Class.php")) {
        require "./php/controller/classes/" . $classe . ".Class.php";
    } else {
        require "./php/model/services/" . $classe . ".Class.php";
    }
}
spl_autoload_register("ChargerClasse");

require "./php/controller/routes.php";
require "./php/controller/helpers.php";
// on initialise les parametres * on recupere les infos pour se connecter à la base
Parametres::init();

//on initialise la connection
DbConnect::init();

session_start();
if ($_SESSION == []) {
    $_SESSION['utilisateur'] = new Utilisateur(['id_role' => '1']);
}
// var_dump($_SESSION);
// session_destroy();

charger_page();
