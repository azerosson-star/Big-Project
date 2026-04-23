<?php

$prod = new Produit($_POST);
switch ($_GET['mode']) {
    case 'Ajouter':
        ProduitService::insert($prod);
        break;
    case 'Modifier':
        ProduitService::update($prod);
        break;
    case 'Supprimer':
        ProduitService::delete($prod->getIdProduit());
        break;
    
    default:
        # code...
        break;
}