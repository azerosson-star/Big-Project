<?php

// Bouton d'ajout
echo '<a href="?page=UtilisateurForm&mode=Ajouter"><my-icon name="plus-'.Parametre::getTypeIcon().'"></my-icon></a>';

echo '<div class="grid">';

// Récupération de la liste des utilisateurs depuis la table "users"
$listeUtilisateurs = UtilisateurService::select(null);

foreach ($listeUtilisateurs as $uti) {
    echo '<div>' . $uti->getUsername() . '</div>';
    echo '<div></div>'; 
    
    // CORRECTION : getIdUser() au lieu de getIdUtilisateur()
    echo '<a href="?page=UtilisateurForm&mode=Modifier&id=' . $uti->getIdUser() . '"><my-icon name="edit-' . Parametre::getTypeIcon() . '"></my-icon></a>';
    echo '<a href="?page=UtilisateurForm&mode=Supprimer&id=' . $uti->getIdUser() . '"><my-icon name="trash-' . Parametre::getTypeIcon() . '"></my-icon></a>';
}

echo '</div>';
