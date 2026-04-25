<?php
echo '<a href="?page=ProduitForm&mode=Ajouter"><my-icon name="plus-'.Parametre::getTypeIcon().'" ></my-icon></a>';
echo '<div class=grid>';
$listeProduits = ProduitService::select();
foreach ($listeProduits as $prod) {
   echo '<div>'.$prod->getNom().'</div>';
   echo '<div>'.$prod->getDescription().'</div>';
   echo '<a href="?page=ProduitForm&mode=Modifier&id='.$prod->getIdProduit().'"><my-icon name=edit-'.Parametre::getTypeIcon().'></my-icon></a>';
   echo '<a href="?page=ProduitForm&mode=Supprimer&id='.$prod->getIdProduit().'"><my-icon name=trash-'.Parametre::getTypeIcon().'></my-icon></a>';
}
echo '</div>';