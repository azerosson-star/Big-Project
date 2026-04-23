<?php

if (isset($_GET['id_poste'])) // cas du modif et supprimer
{
    $prod = PosteService::find_by_id($_GET['id_poste']);
    if ($prod == null) header("location:index.php?page=poste_list");
} else {
    $prod = new Poste(); // on crée un objet vide pour eviter les erreurs dans le mode ajout
}
if($_GET['mode']=="Supprimer") $disabled=" disabled "; else $disabled=" ";

echo '
<form action="?page=action_poste&mode='.$_GET['mode'].'" method="post">
    <input hidden type="text" name=id_poste id=id_poste  value = ' . $prod->get_id_poste() . '>
    <label for="nom">nom</label>
    <input required type="text" name=nom id=nom  '.$disabled.' value = ' . $prod->get_nom() . '>
    <br>
    <label for="description">description</label>
    <input required type="text" name=description id=description  '.$disabled.' value = ' . $prod->get_description() . '>
    <br>
    <label for="id_role">Id Role</label>
    <select name=id_role id=id_role>';
    echo '</select>
    <br>
    <button type="submit">'.$_GET['mode'].'</button>
</form>';
