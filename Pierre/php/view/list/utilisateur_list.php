<?php
$nb_colonne = count(Utilisateur::get_attributes());
echo '
        <div class=flex>
        <h1>Liste des utilisateurs</h1>
        <a href="?page=utilisateur_form&mode=Ajouter"><my-icon name=plus-outline></my-icon></a>
        </div>
        <div class=grid_crud style=--cols:' . $nb_colonne . '>';
foreach (Utilisateur::get_attributes() as $attribut) {
    echo '<div>' . (str_contains($attribut, '_id_') && $attribut != '_id_utilisateur' ? substr($attribut, 4) : substr($attribut, 1)) . '</div>';
}
echo '<div>MODIFIER</div><div>SUPPRIMER</div>';
foreach (DAO::select('utilisateur') as $utilisateur) {
    foreach (Utilisateur::get_attributes() as $attribut) {
        //Utilisateur::get_attributes() = ['_id_utilisateur','_nom','_prenom_email','_mdp','_id_role'] (le underscore viens du nom des attributs)
        $get   = 'get' . $attribut; //$attribut = '_id_role' => $get = 'get'.'_id_role' => $get = 'get_id_role'
        $cible = $utilisateur;
        $valeur   = $cible->$get(); // $cible->get_id_role() = 3
        if (str_contains($attribut, '_id_') && $attribut != '_id_utilisateur') {
            $obj = DAO::select(substr($attribut, 4),null, [substr($attribut, 1)=>$valeur])[0];
            //DAO::find_by_attribute('role', ['id_role'=> 3]) renvoie une liste d'objets correspondants aux entrées de la table role
            if (is_callable([$obj, 'get_nom'])) { // la classe Role n'a pas de methode get_nom()
                $valeur = $obj->get_nom();
            } elseif (is_callable([$obj, 'get_libelle'])) { // la classe Role a une methode get_libelle()
                $valeur = $obj->get_libelle(); // objet role : ['_id_role'=>3,'_libelle'=>'admin']
            } else {
                $valeur = 'verifier attribut'; // message d'erreur fait maison
            }
        }
        echo '<div>' . $valeur . '</div>';
    }
    echo '<a href="?page=utilisateur_form&mode=Modifier&id_utilisateur=' . $utilisateur->get_id_utilisateur() . '"><my-icon name=edit-outline></my-icon></a>
    <a href="?page=utilisateur_form&mode=Supprimer&id_utilisateur=' . $utilisateur->get_id_utilisateur() . '"><my-icon name=trash-outline></my-icon></a>';
}
echo '</div>';
