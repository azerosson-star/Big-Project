<?php
echo '
        <h1 class="mb-1">Connexion</h1>
        <form class="bg-white p-2 br-1 shadow flex flex-col" action="?page=action_connexion" method="post">
            <div class="form-group">
                <label class="form-label" for="identifiant">Identifiant</label>
                <input type="text" class="form-input" name="identifiant" id="identifiant" placeholder="Adresse email ou numéro de téléphone">
            </div>
            <div class="form-group">
                <label class="form-label" for="mdp">Mot de passe</label>
                <input type="password" class="form-input" name="mdp" id="mdp">
            </div>
            <button type="submit" class="btn bg-primary br-1">Envoyer le message</button>
        </form>
    ';
