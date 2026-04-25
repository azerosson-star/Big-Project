<?php
$id =  isset($_GET['id'])?$_GET['id']:"";  
$disabled="";
switch ($_GET['mode'])
{
    case "Ajouter" :
        $prod=new Produit();
        $disabled="";
        break;
    case "Modifier" : 
        $prod = ProduitService::findById($id);
        $disabled="";
        break;
    case "Supprimer":
        $prod = ProduitService::findById($id);
        $disabled = " disabled ";
        break;
}

echo '
<form action="?page=ProduitAction&mode='.$_GET['mode'].'" method="post" enctype="multipart/form-data">
    <input hidden type="text" name=idProduit   value = '.$prod->getIdProduit().' >
    <label for="nom">Nom</label>
    <input type="text" name=nom id=nom  '.$disabled.' value = '.$prod->getNom().'>
    <br/>
    <label for="description">Description</label>
    <input type="text" name=description id=description  '.$disabled.' value = '.$prod->getDescription().'>
    <br/>
    <input type=file name=fichier>
    <button type="submit">'.$_GET['mode'].'</button>
</form>';

