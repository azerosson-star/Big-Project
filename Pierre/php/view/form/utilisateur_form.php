<?php

if (isset($_GET['id_utilisateur'])); // cas du modif et supprimer
{
    $uti = UtilisateurService::find_by_id($_GET['id_utilisateur']);
    if ($uti == null) {
        header("location:index.php?page=utilisateur_list");
    }

} else {
    $uti = new Utilisateur(); // on crée un objet vide pour eviter les erreurs dans le mode ajout
}
if ($_GET['mode'] == "Supprimer") {
    $disabled = " disabled ";
} else {
    $disabled = " ";
}

echo '
<form action="?page=action_utilisateur&mode=' . $_GET['mode'] . '" method="post">
    <input hidden type="text" name=id_utilisateur id=id_utilisateur  value = ' . $uti->get_id_utilisateur() . '>
    <label for="nom">nom</label>
    <input required type="text" name=nom id=nom  ' . $disabled . ' value = ' . $uti->get_nom() . '>
    <br>
    <label for="prenom">prenom</label>
    <input required type="text" name=prenom id=prenom  ' . $disabled . ' value = ' . $uti->get_prenom() . '>
    <br>
    <label for="email">email</label>
    <input required type="text" name=email id=email  ' . $disabled . ' value = ' . $uti->get_email() . '>
    <br>
    <label for="pwd">Mot de passe</label>
    <input required type="text" name=pwd id=pwd  ' . $disabled . ' value = ' . $uti->get_pwd() . '>
    <br>
    <label for="id_role">Id Role</label>
    <select name=id_role id=id_role>';
$listeRole[] = new Role(['id_role' => '1', 'libelle' => 'visiteur']);
$listeRole[] = new Role(['id_role' => '2', 'libelle' => 'gerant']);
$listeRole[] = new Role(['id_role' => '3', 'libelle' => 'admin']);
foreach ($listeRole as $value) {
    echo '<option value="' . $value->get_id_role() . '" ' . ($value->get_id_role() == $uti->get_id_role() ? "selected" : "") . ' >' . $value->get_libelle() . '</option>';
}

foreach (UtilisateurService::select() as $utilisateur) {
    foreach (Utilisateur::get_attributes() as $value) {
        $get   = 'get' . $value;
        $cible = $utilisateur;
        $val   = $cible->$get();
        if (str_contains($value, '_id_') && $value != '_id_utilisateur') {
            $obj = ObjectService::find_by_attribute(substr($value, 4), substr($value, 1), 'int', $val);
            if (is_callable([$obj, 'get_nom'])) {
                $val = $obj->get_nom();
            } elseif (is_callable([$obj, 'get_libelle'])) {
                $val = $obj->get_libelle();
            } else {
                $val = 'verifier attribut';
            }
        }
        switch (gettype($val)) {
            case 'integer':
            case 'double':
                $type = 'number';
                break;
            default:
                $type = 'text';
                break;
        }
        echo '<label for="' . $value . '">' . $value . '</label>
    <input required type="' . $type . '" name=' . $value . ' id=' . $value . '  ' . $disabled . ' value = ' . $val . '>
    <br>';
    }
    echo '<a href="?page=utilisateur_form&mode=Modifier&id_utilisateur=' . $utilisateur->get_id_utilisateur() . '"><my-icon name=edit-outline></my-icon></a>
    <a href="?page=utilisateur_form&mode=Supprimer&id_utilisateur=' . $utilisateur->get_id_utilisateur() . '"><my-icon name=trash-outline></my-icon></a>';
}

echo '</select>
    <br>
    <button type="submit">' . $_GET['mode'] . '</button>
</form>';
