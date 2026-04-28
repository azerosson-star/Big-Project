<?php
// 1. D'abord on déclare l'Autoloader pour que PHP connaisse les classes
function ChargerClasse($classe)
{
    if (file_exists("./php/controller/classes/" . $classe . ".Class.php")) {
        require "./php/controller/classes/" . $classe . ".Class.php";
    } else {
        require "./php/model/services/" . $classe . ".Class.php";
    }

}
spl_autoload_register("ChargerClasse");

require "php/controller/routeur.php";
require "php/controller/helpers.php";
// 2. Ensuite on initialise...
// ...les paramètres
Parametre::init();
// ...la base de donnée
DbConnect::init();

// 3. Puis on démarre la session (PHP saura reconstruire l'objet Utilisateur)
session_start();
if ($_SESSION == []) {
    $_SESSION['utilisateur'] = new Utilisateur(['id_role' => '1']);
}

// 4. Et on lance la page via le routeur
chargerPage();
