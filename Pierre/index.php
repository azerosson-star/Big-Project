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

chargerPage();


// echo 'par id <br>';
// var_dump(ObjectService::find_by_attribute('utilisateur','id_utilisateur','int',3));
// var_dump(ObjectService::find_by_attribute('poste','id_poste','int',3));
// var_dump(ObjectService::find_by_attribute('role','id_role','int',3));
// var_dump(ObjectService::find_by_attribute('utilisateur','id_utilisateur','int',3));
// var_dump(ObjectService::find_by_attribute('poste','id_poste','int',3));
// var_dump(ObjectService::find_by_attribute('role','id_role','int',3));
// echo 'par email <br>';
// var_dump(ObjectService::find_by_attribute('utilisateur','email','str','tata.titi@gmail.com'));

// $condition=['nom'=>'%o%'];
// var_dump(UtilisateurService::select($condition,true));