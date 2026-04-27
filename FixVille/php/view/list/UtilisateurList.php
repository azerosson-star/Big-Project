<?php
$iconType = Parametre::getTypeIcon();

$ajoutHtml = <<<HTML
<a href="?page=UtilisateurForm&mode=Ajouter"><my-icon name="plus-{$iconType}"></my-icon></a>
<div class="grid">
HTML;
echo $ajoutHtml;

$listeUtilisateurs = UtilisateurService::select(null);

foreach ($listeUtilisateurs as $uti) {
    $nomComplet = htmlspecialchars($uti->getNom() . " " . $uti->getPrenom());
    $email = htmlspecialchars($uti->getEmail());
    $id = $uti->getId_utilisateur();

    $ligneUtilisateurHtml = <<<HTML
    <div>{$nomComplet}</div>
    <div>{$email}</div>
    <a href="?page=UtilisateurForm&mode=Modifier&id={$id}"><my-icon name="edit-{$iconType}"></my-icon></a>
    <a href="?page=UtilisateurForm&mode=Supprimer&id={$id}"><my-icon name="trash-{$iconType}"></my-icon></a>
HTML;
    echo $ligneUtilisateurHtml;
}

$finGridHtml = <<<HTML
</div>
HTML;
echo $finGridHtml;