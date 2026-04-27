<?php
$idParam = isset($_GET['id']) ? $_GET['id'] : "";  
$disabled = "";
$mode = $_GET['mode'];

switch ($mode)
{
    case "Ajouter" :
        $uti = new Utilisateur();
        break;
    case "Modifier" : 
    case "Supprimer":
        $uti = UtilisateurService::findById($idParam);
        $disabled = ($mode == "Supprimer") ? " disabled " : "";
        break;
}

$token = getToken();
$idUti = htmlspecialchars((string)$uti->getId_utilisateur());
$nom = htmlspecialchars((string)$uti->getNom());
$prenom = htmlspecialchars((string)$uti->getPrenom());
$email = htmlspecialchars((string)$uti->getEmail());
$adresse = htmlspecialchars((string)$uti->getAdresse());
$tel = htmlspecialchars((string)$uti->getTel());

$utilisateurFormHtml = <<<HTML
<form action="?page=UtilisateurAction&mode={$mode}" method="post">
    <input type="hidden" name="csrf_token" value="{$token}">
    <input hidden type="text" id="id_utilisateur" name="id_utilisateur" value="{$idUti}">
    
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" {$disabled} value="{$nom}">
    <br/>

    <label for="prenom">Prénom</label>
    <input type="text" id="prenom" name="prenom" {$disabled} value="{$prenom}">
    <br/>
    
    <label for="email">Email / Login</label>
    <input type="email" id="email" name="email" {$disabled} value="{$email}">
    <br/>
    
    <label for="adresse">Adresse</label>
    <input type="text" id="adresse" name="adresse" {$disabled} value="{$adresse}">
    <br/>
    
    <label for="tel">Téléphone</label>
    <input type="text" id="tel" name="tel" {$disabled} value="{$tel}">
    <br/>
    
    <button type="submit">Valider</button>
</form>
HTML;

echo $utilisateurFormHtml;