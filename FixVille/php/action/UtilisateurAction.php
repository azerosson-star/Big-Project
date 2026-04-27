<?php
// Protection CSRF pour toutes les actions (sauf suppression qui pourrait passer par GET, à sécuriser plus tard via POST idéalement)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || !checkToken($_POST['csrf_token'])) {
        setFlash("Erreur de sécurité (CSRF). Veuillez réessayer.", "danger");
        header("Location: ?page=Accueil");
        exit;
    }
}

$util = new Utilisateur($_POST);
$mode = $_GET['mode'] ?? ''; 

switch ($mode) {
    case 'Modifier':
        $mdp = !empty($_POST['nouveau_mdp']) ? $_POST['nouveau_mdp'] : null;
        UtilisateurService::update($util, $mdp);
        
        // Si c'est l'utilisateur connecté qui se modifie lui-même, on met à jour sa session
        if ($_SESSION['utilisateur']->getId_utilisateur() == $util->getId_utilisateur()) {
            $_SESSION['utilisateur'] = UtilisateurService::findById($util->getId_utilisateur());
            setFlash("Votre profil a été mis à jour.", "success");
            header("Location: ?page=EspaceMembre");
        } else {
            setFlash("Utilisateur modifié.", "success");
            header("Location: ?page=UtilisateurList");
        }
        exit;
        
    case 'Ajouter':
        $util->setMdp(password_hash("motdepasse", PASSWORD_BCRYPT)); // Mdp par défaut généré de façon sécurisée
        UtilisateurService::insert($util);
        setFlash("Utilisateur créé.", "success");
        header("Location: ?page=UtilisateurList");
        exit;

    case 'Supprimer':
        $idASupprimer = $util->getId_utilisateur() ?? $_GET['id'] ?? null;
        if($idASupprimer) {
            UtilisateurService::delete($idASupprimer); 
            setFlash("Utilisateur supprimé.", "success");
        }
        header("Location: ?page=UtilisateurList");
        exit;
}

header("Location: ?page=Accueil");
exit;