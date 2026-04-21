<?php
// Page d'accueil principale de ton projet
echo '<h1>Bienvenue sur phpWebCrud !</h1>';

function ChargerClasse($classe)
{
    if (file_exists("./php/controller/classes/" . $classe . ".Class.php"))
        require "./php/controller/classes/" . $classe . ".Class.php";
    else
        require "./php/model/services/" . $classe . ".Class.php";
}
spl_autoload_register("ChargerClasse");
require "php/controller/routeur.php";
require "php/controller/helpers.php";
session_start();
echo "index";
if(isset($_SESSION['utilisateur'])) var_dump($_SESSION);
// on recupere les informations contenu dans le fichier config.json
Parametre::init();
DbConnect::init();
chargerPage();

var_dump(UtilisateurService::select(null));