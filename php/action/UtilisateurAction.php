<?php
$util = new Utilisateur($_POST);
switch ($_GET['mode']) {
    case 'Ajouter':
        UtilisateurService::insert($util);
        break;
    case 'Modifier':
        UtilisateurService::update($util);
        break;
    case 'Supprimer':
        // CORRECTION : getIdUser() au lieu de getIdUtilisateur()
        UtilisateurService::delete($util->getIdUser());
        break;
    default:
        break;
}