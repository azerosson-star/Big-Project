<?php
// 1. D'ABORD on déclare l'Autoloader pour que PHP connaisse les classes
function ChargerClasse($classe) {
    if (file_exists("./php/controller/classes/" . $classe . ".Class.php"))
        require "./php/controller/classes/" . $classe . ".Class.php";
    else
        require "./php/model/services/" . $classe . ".Class.php";
}
spl_autoload_register("ChargerClasse");

// 2. ENSUITE on démarre la session (PHP saura reconstruire l'objet Utilisateur)
session_start(); 

require "php/controller/routeur.php";
require "php/controller/helpers.php";

// Initialisation
Parametre::init();
DbConnect::init();

// Lancement de la page via le routeur
chargerPage();