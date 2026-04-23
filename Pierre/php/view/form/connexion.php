<?php
echo '
        <h1 class="mb-1">Connexion</h1>
        <form class="bg-white p-2 br-1 shadow flex flex-col" action="?page=action_connexion" method="post">
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" class="form-input" name="email" id="email" placeholder="nom@domaine.com">
            </div>
            <div class="form-group">
                <label class="form-label" for="pwd">Mot de passe</label>
                <input type="password" class="form-input" name="pwd" id="pwd">
            </div>
            <button type="submit" class="btn bg-primary br-1">Envoyer le message</button>
        </form>
    ';
