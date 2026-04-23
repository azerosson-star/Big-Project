<?php

if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur'] != null) {
    $utilisateur['str']  = 'Utilisateur Connecté : ' . $_SESSION['utilisateur']->get_nom();
    $utilisateur['bool'] = true;
} else {
    $utilisateur['str']  = "Pas d'Utilisateur Connecté";
    $utilisateur['bool'] = false;
}

echo '   <header class="bg-dark p-1">
        <nav class="flex justify-between align-center container">
            <h2>' . $utilisateur['str'] . '</h2>
            <div class="flex gap-1">';
foreach (NavElement::get_all_elt() as $value) {
    switch ([$value->get_libelle(),$utilisateur['bool']]) {
        case (['Connexion',true]):
            break;
        case (['Deconnexion',false]):
            break;
        default:
            echo '<a href=' . $value->get_reference() . ' class="td-none nav-icon">
            <span class="fas fa-' . $value->get_icone() . '"></span>
            <span class="nav-text ' . $value->get_couleur() . '">' . $value->get_libelle() . '</span></a>';
            break;
    }
}
// <span class="fas fa-' . $value->get_icone() . '-'.Parametres::get_type_icone().'"></span>
echo '            </div>
        </nav>
    </header>
    <main class="container">
';
