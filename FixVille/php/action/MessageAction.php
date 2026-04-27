<?php
// SI MODE SUPPRESSION
if (isset($_GET['mode']) && $_GET['mode'] == 'Supprimer' && isset($_GET['id'])) {
    $monId = $_SESSION['utilisateur']->getId_utilisateur();
    MessageService::delete($_GET['id'], $monId);
    setFlash("Le message a bien été supprimé.", "success");
    header("Location: ?page=MessageList");
    exit;
}

// SI MODE ENVOI (formulaire normal)
if (
    !empty($_POST['id_destinataire']) && 
    !empty(trim($_POST['objet'])) && 
    !empty(trim($_POST['content']))
) {
    $msg = new Message();
    $msg->setId_expediteur($_SESSION['utilisateur']->getId_utilisateur());
    $msg->setId_destinataire($_POST['id_destinataire']);
    
    // Nettoyage anti-XSS avant la base de données
    $msg->setObjet(trim(htmlspecialchars($_POST['objet'])));
    $msg->setContent(trim(htmlspecialchars($_POST['content'])));

    MessageService::insert($msg);
    setFlash("Votre message a bien été envoyé !", "success");
} else {
    setFlash("Erreur : Veuillez remplir tous les champs du message.", "danger");
}

header("Location: ?page=MessageList");
exit;