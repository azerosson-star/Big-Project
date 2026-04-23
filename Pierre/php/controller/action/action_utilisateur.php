<?php

$utilisateur_saisi = new Utilisateur($_POST);

switch ($_GET['mode']) {
    case 'Ajouter':
        UtilisateurService::insert($utilisateur_saisi);
        break;
    case 'Modifier':
        UtilisateurService::update($utilisateur_saisi);
        break;
    case 'Supprimer':
        UtilisateurService::delete($utilisateur_saisi->get_id_utilisateur());
        break;
    default:
        break;
}
header("location:index.php?page=utilisateur_list");