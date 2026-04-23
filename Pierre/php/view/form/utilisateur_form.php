<?php

if (isset($_GET['id_utilisateur'])) {
    // cas du modif et supprimer
    $utilisateur = UtilisateurService::find_by_id($_GET['id_utilisateur']);
    if ($utilisateur == null) {
        header("location:index.php?page=utilisateur_list");
    }
} else {
    $utilisateur = new Utilisateur(); // on crée un objet vide pour eviter les erreurs dans le mode ajout
}
if ($_GET['mode'] == "Supprimer") {
    $disabled = " disabled ";
} else {
    $disabled = " ";
}

echo '
<form action="?page=action_utilisateur&mode=' . $_GET['mode'] . '" method="post">
    <input hidden type="text" name=id_utilisateur id=id_utilisateur  value = ' . $utilisateur->get_id_utilisateur() . '>';
foreach (Utilisateur::get_attributes() as $attribut) {
    if ($attribut != '_id_utilisateur' || '_id_role') {
        $get    = 'get' . $attribut;
        $valeur = $utilisateur->$get();
        // if (str_contains($attribut, '_id_')) {
        //     $obj = DAO::select(substr($attribut, 4), [substr($attribut, 1)], $valeur);
        //     if (is_callable([$obj, 'get_nom'])) {
        //         $valeur = $obj->get_nom();
        //     } elseif (is_callable([$obj, 'get_libelle'])) {
        //         $valeur = $obj->get_libelle();
        //     } else {
        //         $valeur = 'verifier attribut';
        //     }
        // }
        switch (gettype($valeur)) {
            case 'integer':
            case 'double':
                $type = 'number';
                break;
            default:
                $type = 'text';
                break;
        }
        echo '<label for="' . $attribut . '">' . ucfirst($attribut) . '</label>
        <input required type="' . $type . '" name=' . $attribut . ' id=' . $attribut . '  ' . $disabled . ' value = ' . $valeur . '>
        <br>';
    }
}
echo '
    <label for="id_role">Role</label>
    <select name=id_role id=id_role>';
foreach (DAO::select('role') as $role) {
    echo '<option value="' . $role->get_id_role() . '" ' . ($role->get_id_role() == $utilisateur->get_id_role() ? "selected" : "") . ' >' . $role->get_libelle() . '</option>';
}
echo '
    <a href="?page=utilisateur_form&mode=Modifier&id_utilisateur=' . $utilisateurlisateur->get_id_utilisateur() . '"><my-icon name=edit-outline></my-icon></a>
    <a href="?page=utilisateur_form&mode=Supprimer&id_utilisateur=' . $utilisateurlisateur->get_id_utilisateur() . '"><my-icon name=trash-outline></my-icon></a>';

echo '</select>
    <br>
    <button type="submit">' . $_GET['mode'] . '</button>
</form>';
