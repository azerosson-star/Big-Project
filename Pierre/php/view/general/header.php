<?php
if ($_SESSION['utilisateur']->get_id_role() > 1) {
    $utilisateur['str']  = 'Bonjour ' . $_SESSION['utilisateur']->get_prenom() . '<br> role : ' . DAO::select('role', ['libelle'], ["id_role" => $_SESSION['utilisateur']->get_id_role()])[0]->get_libelle();
    $utilisateur['bool'] = true;
} else {
    $utilisateur['str']  = "Mode Visiteur";
    $utilisateur['bool'] = false;
}

echo '<header class="bg-dark p-1">
        <nav class="flex justify-between align-center container">
            <h2>' . $utilisateur['str'] . '</h2>
            <div class="flex gap-1">';
foreach (NavElement::get_all_elt() as $value) {
    switch ([$value->get_libelle(), $utilisateur['bool']]) {
        case (['Connexion', true]):
            break;
        case (['Deconnexion', false]):
            break;
        default:
            $role_session = DAO::find_by_id('role', $_SESSION['utilisateur']->get_id_role())->get_niveau_perm();
            if ($role_session >= $value->get_role_requis()) {
                echo '<a href=' . $value->get_reference() . ' class="td-none nav-icon">
            <span class="fas fa-' . $value->get_icone() . '"></span>
            <span class="nav-text ' . $value->get_couleur() . '">' . $value->get_libelle() . '</span></a>';
            }
            break;
    }

}
echo '            </div>
        </nav>
    </header>
    <main class="container">';
