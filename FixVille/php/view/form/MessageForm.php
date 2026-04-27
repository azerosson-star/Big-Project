<?php
$token = getToken();

$debutFormHtml = <<<HTML
<h2 class="text-center">Envoyer un message</h2>
<form action="?page=MessageAction" method="post">
    <input type="hidden" name="csrf_token" value="{$token}">
    <label>Destinataire :</label>
    <select name="id_destinataire">
HTML;
echo $debutFormHtml;

$users = UtilisateurService::select();
foreach($users as $u) {
    if($u->getId_utilisateur() != $_SESSION['utilisateur']->getId_utilisateur()) {
        $idOpt = $u->getId_utilisateur();
        $nomOpt = htmlspecialchars($u->getPrenom() . ' ' . $u->getNom());
        
        $optionHtml = <<<HTML
        <option value="{$idOpt}">{$nomOpt}</option>
HTML;
        echo $optionHtml;
    }
}

$finFormHtml = <<<HTML
    </select><br>
    <label>Sujet :</label>
    <input type="text" name="objet" required><br>
    <label>Message :</label>
    <textarea name="content" required></textarea><br>
    <button type="submit">Envoyer</button>
</form>
HTML;
echo $finFormHtml;