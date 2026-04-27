<?php
if(isset($_POST["Nom"])) {
    // 1. Nettoyage drastique des données (anti faille XSS)
    $nom = trim(htmlspecialchars($_POST["Nom"]));
    $prenom = trim(htmlspecialchars($_POST["Prenom"]));
    $email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL);
    $mdp = $_POST["mdp"];
    $adresse = trim(htmlspecialchars($_POST["adresse"]));
    $tel = trim(htmlspecialchars($_POST["tel"]));
    $date_naissance = $_POST["date_naissance"];

    // 2. Vérification de l'email
    if(!$email) {
        setFlash("Le format de l'adresse email est invalide.", "danger");
        header("Location: ?page=InscriptionForm");
        exit;
    }

    // 3. Vérification des doublons (Email déjà utilisé ?)
    $exist = UtilisateurService::findByLogin($email);
    if($exist) {
        setFlash("Cet email est déjà utilisé par un autre compte.", "danger");
        header("Location: ?page=InscriptionForm");
        exit;
    }

    $mdpHash = password_hash($mdp, PASSWORD_BCRYPT);
    $date_aujourd_hui = date("Y-m-d");

    $bdd = DbConnect::getConnectBase(); 

    $requete = $bdd->prepare("
        INSERT INTO utilisateur 
            (nom, prenom, email, mdp, adresse, tel, date_naissance, date_inscription, id_role) 
        VALUES 
            (:nom, :prenom, :email, :mdp, :adresse, :tel, :date_naissance, :date_inscription, :id_role)
    ");

    $requete->execute([
        ':nom'               => $nom,
        ':prenom'            => $prenom,
        ':email'             => $email,
        ':mdp'               => $mdpHash,
        ':adresse'           => $adresse,
        ':tel'               => $tel,
        ':date_naissance'    => $date_naissance,
        ':date_inscription'  => $date_aujourd_hui,
        ':id_role'           => 1 // rôle par défaut "utilisateur"
    ]);

    setFlash("Votre inscription est validée ! Vous pouvez maintenant vous connecter.", "success");
    header("Location: ?page=ConnexionForm"); 
    exit;
} else {
    header("Location: ?page=InscriptionForm");
    exit;
}