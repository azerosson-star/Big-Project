<?php
$nb_colonne = count(Utilisateur::get_attributes())-1;
echo '
        <div class=flex>
        <h1>Liste des utilisateurs</h1>
        <a href="?page=utilisateur_form&mode=Ajouter"><my-icon name=plus-outline></my-icon></a>
        </div>
        <div class=grid_crud style=--cols:' . $nb_colonne . '>';
foreach (Utilisateur::get_attributes() as $attribut) {
    switch ($attribut) {
        case '_mdp':
            break;
        case '_id_utilisateur':
            echo '<div> id </div>';
            break;
        case '_id_role':
            echo '<div> role </div>';
            break;
        default:
            echo '<div>' . substr($attribut, 1) . '</div>';
            break;
    }
}
echo '<div>MODIFIER</div><div>SUPPRIMER</div>';
foreach (DAO::select('utilisateur') as $utilisateur) {
    foreach (Utilisateur::get_attributes() as $attribut) {
        //Utilisateur::get_attributes() = ['_id_utilisateur','_nom','_prenom','_email','_mdp','_id_role'] (le underscore viens du nom des attributs)
        // $utilisateur->get_id_role() = 3
        switch ($attribut) {
            case '_mdp':
                break;
            case '_id_role':
                $valeur = DAO::find_by_id('role', $utilisateur->get_id_role())->get_libelle();
                echo '<div>' . $valeur . '</div>';
                break;
            default:
                $get    = 'get' . $attribut; //$attribut = '_id_role' => $get = 'get'.'_id_role' => $get = 'get_id_role'
                $valeur = $utilisateur->$get();
                echo '<div>' . $valeur . '</div>';
                break;
        }
    }
    echo '<a href="?page=utilisateur_form&mode=Modifier&id_utilisateur=' . $utilisateur->get_id_utilisateur() . '"><my-icon name=edit-outline></my-icon></a>
    <a href="?page=utilisateur_form&mode=Supprimer&id_utilisateur=' . $utilisateur->get_id_utilisateur() . '"><my-icon name=trash-outline></my-icon></a>';
}
echo '</div>';
