<?php

$utilisateur_saisi = new Utilisateur($_POST);

switch ($_GET['mode']) {
    case 'Ajouter':
        DAO::insert($utilisateur_saisi);
        break;
    case 'Modifier':
        DAO::update($utilisateur_saisi);
        break;
    case 'Supprimer':
        DAO::delete('utilisateur',$utilisateur_saisi->get_id_utilisateur());
        break;
    default:
        break;
}
header("url=?page=utilisateur_list");