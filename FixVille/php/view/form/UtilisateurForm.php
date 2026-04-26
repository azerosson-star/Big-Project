<?php
$id =  isset($_GET['id']) ? $_GET['id'] : "";  
$disabled = "";
switch ($_GET['mode'])
{
    case "Ajouter" :
        $uti = new Utilisateur();
        break;
    case "Modifier" : 
    case "Supprimer":
        $uti = UtilisateurService::findById($id);
        $disabled = ($_GET['mode'] == "Supprimer") ? " disabled " : "";
        break;
}

echo '
<form action="?page=UtilisateurAction&mode='.$_GET['mode'].'" method="post">
    <input hidden type="text" id="id_utilisateur" name="id_utilisateur" value="'.htmlspecialchars((string)$uti->getId_utilisateur()).'">
    
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" '.$disabled.' value="'.htmlspecialchars((string)$uti->getNom()).'">
    <br/>

    <label for="prenom">Prénom</label>
    <input type="text" id="prenom" name="prenom" '.$disabled.' value="'.htmlspecialchars((string)$uti->getPrenom()).'">
    <br/>
    
    <label for="email">Email / Login</label>
    <input type="email" id="email" name="email" '.$disabled.' value="'.htmlspecialchars((string)$uti->getEmail()).'">
    <br/>
    
    <label for="adresse">Adresse</label>
    <input type="text" id="adresse" name="adresse" '.$disabled.' value="'.htmlspecialchars((string)$uti->getAdresse()).'">
    <br/>
    
    <label for="tel">Téléphone</label>
    <input type="text" id="tel" name="tel" '.$disabled.' value="'.htmlspecialchars((string)$uti->getTel()).'">
    <br/>
    
    <button type="submit">Valider</button>
</form>';