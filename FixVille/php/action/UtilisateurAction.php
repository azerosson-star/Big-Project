<?php
$util = new Utilisateur($_POST);
switch ($_GET['mode']) {
    case 'Ajouter':
        $util->setMdp(password_hash("motdepassepardefaut", PASSWORD_BCRYPT)); // Sécurité
        UtilisateurService::insert($util);
        break;
    case 'Modifier':
        UtilisateurService::update($util);
        break;
    case 'Supprimer':
        UtilisateurService::delete($util->getId_utilisateur()); // RÉPARÉ
        break;
    default:
        break;
}
header("Location: ?page=UtilisateurList"); // RÉPARÉ : Redirection propre
exit;