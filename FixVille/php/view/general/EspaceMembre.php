<?php
$user = $_SESSION['utilisateur'];
$token = getToken();
$id = $user->getId_utilisateur();
$nom = htmlspecialchars((string)$user->getNom());
$prenom = htmlspecialchars((string)$user->getPrenom());
$email = htmlspecialchars((string)$user->getEmail());
$adresse = htmlspecialchars((string)$user->getAdresse());
$tel = htmlspecialchars((string)$user->getTel());

$espaceMembreHtml = <<<HTML
<h2 class="text-center">Mon Profil</h2>
<form action="?page=UtilisateurAction&mode=Modifier" method="post" class="bg-white p-2 shadow br-1">
    <input type="hidden" name="csrf_token" value="{$token}">
    <input type="hidden" name="id_utilisateur" value="{$id}">

    <div class="grid-2 gap-1">
        <div>
            <label>Nom</label>
            <input type="text" name="nom" value="{$nom}" required>
        </div>
        <div>
            <label>Prénom</label>
            <input type="text" name="prenom" value="{$prenom}" required>
        </div>
    </div>

    <label>Email (Login)</label>
    <input type="email" name="email" value="{$email}" required>

    <label>Adresse</label>
    <input type="text" name="adresse" value="{$adresse}">

    <label>Téléphone</label>
    <input type="text" name="tel" value="{$tel}">

    <hr class="my-1">
    <p class="text-info" style="font-size: 0.9em; margin-bottom:5px;">Laissez vide pour ne pas modifier le mot de passe :</p>
    <label>Nouveau mot de passe</label>
    <input type="password" name="nouveau_mdp">

    <button type="submit" class="btn btn-success w-100 mt-1">Mettre à jour mon profil</button>
</form>
HTML;

echo $espaceMembreHtml;