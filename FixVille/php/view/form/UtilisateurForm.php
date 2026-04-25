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
    <input hidden type="text" id="id_user" name="id_user" value="'.$uti->getId_user().'">
    
    <label for="username">Nom d\'utilisateur</label>
    <input type="text" id="username" name="username" '.$disabled.' value="'.$uti->getUsername().'">
    <br/>
    
    <label for="password">Mot De Passe</label>
    <input type="text" id="password" name="password" '.$disabled.' value="'.$uti->getPassword().'">
    <br/>
    
    <label for="login">Email / Login</label>
    <input type="email" id="login" name="login" '.$disabled.' value="'.$uti->getLogin().'">
    <br/>
    
    <label for="adresse">Adresse</label>
    <input type="text" id="adresse" name="adresse" '.$disabled.' value="'.$uti->getAdresse().'">
    <br/>
    
    <label for="tel">Téléphone</label>
    <input type="text" id="tel" name="tel" '.$disabled.' value="'.$uti->getTel().'">
    <br/>
    
    <button type="submit">Valider</button>
</form>';