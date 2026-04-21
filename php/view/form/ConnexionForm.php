<?php
echo '
<form action="?page=ConnexionAction" method="post">
    <label for="login">Login</label>
    <input type="text" id="login" name="login">
    <br/>
    <label for="password">Mot De Passe</label>
    <input type="text" id="password" name="password">
    <br/>
    
    <button type="submit">Se connecter</button>
</form>';