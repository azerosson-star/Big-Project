<?php
$titreHtml = <<<HTML
<h2>Ma boîte de réception</h2>
HTML;
echo $titreHtml;

$monId = $_SESSION['utilisateur']->getId_utilisateur();
$mesMessages = MessageService::findByDestinataire($monId);

if(empty($mesMessages)) {
    $videHtml = <<<HTML
    <p>Vous n'avez aucun message.</p>
HTML;
    echo $videHtml;
} else {
    foreach($mesMessages as $msg) {
        $expediteur = UtilisateurService::findById($msg->getId_expediteur());
        $nomExpediteur = "Utilisateur supprimé";
        
        if ($expediteur !== null) {
            $nomExpediteur = htmlspecialchars($expediteur->getPrenom() . " " . $expediteur->getNom());
        }

        $objet = htmlspecialchars($msg->getObjet());
        $contenu = nl2br(htmlspecialchars($msg->getContent()));
        $idMsg = $msg->getId_message();
        $token = getToken();

        $messageHtml = <<<HTML
        <div class="message-box bg-white p-2 mb-1 shadow">
            <strong>De : </strong>{$nomExpediteur}<br>
            <strong>Sujet : </strong>{$objet}<br>
            <p>{$contenu}</p>
            <a href="?page=MessageAction&mode=Supprimer&id={$idMsg}&csrf_token={$token}" style="color:red; font-size:0.8em;">Supprimer ce message</a>
        </div>
HTML;
        echo $messageHtml;
    }
}

$boutonNouveauHtml = <<<HTML
<br><a href="?page=MessageForm" class="btn">Nouveau message</a>
HTML;
echo $boutonNouveauHtml;