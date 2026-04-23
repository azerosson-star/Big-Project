<?php
$cols = count(Utilisateur::get_attributes());
echo '
        <div class=flex>
        <h1>Liste des utilisateurs</h1>
        <a href="?page=utilisateur_form&mode=Ajouter"><my-icon name=plus-outline></my-icon></a>
        </div>
        <div class=grid_crud style=--cols:' . $cols . '>';
foreach (Utilisateur::get_attributes() as $value) {
    echo '<div>' . (str_contains($value, '_id_') && $value != '_id_utilisateur' ? substr($value, 4) : substr($value, 1)) . '</div>';
}
echo '<div>MODIFIER</div><div>SUPPRIMER</div>';

foreach (UtilisateurService::select() as $utilisateur) {
    foreach (Utilisateur::get_attributes() as $value) {
        //Utilisateur::get_attributes() = ['_id_utilisateur','_nom','_prenom_email','_pwd','_id_role'] (le underscore viens du nom des attributs)
        $get   = 'get' . $value; //$value = '_id_role' => $get = 'get'.'_id_role' => $get = 'get_id_role'
        $cible = $utilisateur;
        $val   = $cible->$get(); // $cible->get_id_role() = 3
        if (str_contains($value, '_id_') && $value != '_id_utilisateur') {
            $obj = ObjectService::find_by_attribute(substr($value, 4), substr($value, 1), 'int', $val);
            //ObjectService::find_by_attribute('role', 'id_role', 'int', 3) renvoie un objet correspondant à une entrée de la table role
            if (is_callable([$obj, 'get_nom'])) { // la classe Role n'a pas de methode get_nom()
                $val = $obj->get_nom();
            } elseif (is_callable([$obj, 'get_libelle'])) { // la classe Role a une methode get_libelle()
                $val = $obj->get_libelle(); // objet role : ['_id_role'=>3,'_libelle'=>'admin']
            } else {
                $val = 'verifier attribut'; // message d'erreur fait maison
            }
        }
        echo '<div>' . $val . '</div>';
    }
    echo '<a href="?page=utilisateur_form&mode=Modifier&id_utilisateur=' . $utilisateur->get_id_utilisateur() . '"><my-icon name=edit-outline></my-icon></a>
    <a href="?page=utilisateur_form&mode=Supprimer&id_utilisateur=' . $utilisateur->get_id_utilisateur() . '"><my-icon name=trash-outline></my-icon></a>';
}
echo '</div>';
