<?php
function ChargerClasse($classe)
{
    if (file_exists("./php/controller/classes/" . $classe . ".Class.php"))
        require "./php/controller/classes/" . $classe . ".Class.php";
    else if (file_exists("./php/model/" . $classe . ".Class.php"))
        require "./php/model/" . $classe . ".Class.php";
    else if (file_exists("./php/model/services/" . $classe . ".Class.php"))
        require "./php/model/services/" . $classe . ".Class.php";
    else if (file_exists("./php/controller/" . $classe . ".Class.php"))
        require "./php/controller/" . $classe . ".Class.php";
}
spl_autoload_register("ChargerClasse");

require "php/controller/routeur.php";

session_start();

Parametre::init();
DbConnect::init();

chargerPage();