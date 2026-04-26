<?php
echo '<a href="?page=UtilisateurForm&mode=Ajouter"><my-icon name="plus-'.Parametre::getTypeIcon().'"></my-icon></a>';
echo '<div class="grid">';

$listeUtilisateurs = UtilisateurService::select(null);

foreach ($listeUtilisateurs as $uti) {
    // RÉPARÉ : Prévention des failles XSS et affichage propre
    echo '<div>' . htmlspecialchars($uti->getNom() . " " . $uti->getPrenom()) . '</div>';
    echo '<div>' . htmlspecialchars($uti->getEmail()) . '</div>'; 
    
    echo '<a href="?page=UtilisateurForm&mode=Modifier&id=' . $uti->getId_utilisateur() . '"><my-icon name="edit-' . Parametre::getTypeIcon() . '"></my-icon></a>';
    echo '<a href="?page=UtilisateurForm&mode=Supprimer&id=' . $uti->getId_utilisateur() . '"><my-icon name="trash-' . Parametre::getTypeIcon() . '"></my-icon></a>';
}

echo '</div>';