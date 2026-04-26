<?php

$inscription=<<<HTML


    

<form action="?page=InscriptionAction" method="post">
 <label for="Nom">Nom:</label>
 <input type="text" id="Nom" name="Nom">
    <br>
    <label for="Prenom">Prenom:</label>
    <input type="text" id="Prenom" name="Prenom" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br> 
    <label for="mot_de_passe">Mot de passe:</label>
    <input type="password" id="mdp" name="mdp" required>
    <br>
    <label for="adresse">Adresse:</label>
    <input type="text" id="adresse" name="adresse" required>
    <br>
    <label for="tel">Téléphone:</label>
    <input type="tel" id="tel" name="tel" required  >
    <br>
    <label for="date_naissance">Date de naissance:</label>
    <input type="date" id="date_naissance" name="date_naissance" required>
    <button type="submit">S'inscrire</button>
</form>

HTML;

echo $inscription;

















