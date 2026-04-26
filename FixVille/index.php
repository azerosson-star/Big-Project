<?php
// Page d'accueil principale de ton projet
echo '<h1>Bienvenue sur big project!</h1>';

function ChargerClasse($classe) {
    if (file_exists("./php/controller/classes/" . $classe . ".Class.php"))
        require "./php/controller/classes/" . $classe . ".Class.php";
    else
        require "./php/model/services/" . $classe . ".Class.php";
}
spl_autoload_register("ChargerClasse");
require "php/controller/routeur.php";
require "php/controller/helpers.php";

session_start();

// Initialisation
Parametre::init();
DbConnect::init(); // RÉPARÉ : Décommenté pour activer la base de données

// Lancement de la page via le routeur
chargerPage();