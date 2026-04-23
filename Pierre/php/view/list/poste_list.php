<?php
$cols = count(Poste::get_attributes());
echo '
        <div class=flex>
        <h1>Liste des postes</h1>
        <a href="?page=poste_form&mode=Ajouter"><my-icon name=plus-outline></my-icon></a>
        </div>
        <div class=grid_crud style=--cols:' . $cols . '>';
foreach (Poste::get_attributes() as $value) {
    echo '<div>' . (str_contains($value, '_id_') && $value != '_id_poste' ? substr($value, 4) : substr($value, 1)) . '</div>';
}
echo '<div>MODIFIER</div><div>SUPPRIMER</div>';

foreach (PosteService::select() as $poste) {
    foreach (Poste::get_attributes() as $value) {
        $get   = 'get' . $value;
        $cible = $poste;
        $val   = $cible->$get();
        if (str_contains($value, '_id_') && $value != '_id_poste') {
            $obj = ObjectService::find_by_attribute(substr($value, 4), substr($value, 1), 'int', $val);
            if (is_callable([$obj, 'get_nom'])) {
                $val = $obj->get_nom();
            } elseif (is_callable([$obj, 'get_libelle'])) {
                $val = $obj->get_libelle();
            } else {
                $val = 'verifier attribut';
            }
        }
        echo '<div>' . $val . '</div>';
    }
    echo '<a href="?page=poste_form&mode=Modifier&id_poste=' . $poste->get_id_poste() . '"><my-icon name=edit-outline></my-icon></a>
    <a href="?page=poste_form&mode=Supprimer&id_poste=' . $poste->get_id_poste() . '"><my-icon name=trash-outline></my-icon></a>';
}
echo '</div>';
