<?php

$poste_saisi = new Poste($_POST);

switch ($_GET['mode']) {
    case 'Ajouter':
        PosteService::insert($poste_saisi);
        break;
    case 'Modifier':
        PosteService::update($poste_saisi);
        break;
    case 'Supprimer':
        PosteService::delete($poste_saisi->get_id_poste());
        break;
    default:
        break;
}
header("location:index.php?page=poste_list");
