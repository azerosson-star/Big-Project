<?php
$connexionform= <<<HTML
<form action="?page=ConnexionAction" method="post">
    <label for="login">Login (Email)</label>
    <input type="text" id="login" name="login">
    <br/>
    <label for="password">Mot De Passe</label>
    <input type="password" id="password" name="password">
    <br/>
    
    <button type="submit">Se connecter</button>
</form>
HTML;

// C'est cette ligne qui manquait pour que la page s'affiche !
echo $connexionform;