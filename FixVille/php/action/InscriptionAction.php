<?php
if(isset($_POST["Nom"])) {
    $nom = $_POST["Nom"];
    $prenom = $_POST["Prenom"];
    $email = $_POST["email"];
    $mdp = password_hash($_POST["mdp"], PASSWORD_BCRYPT);
    $adresse = $_POST["adresse"];
    $tel = $_POST["tel"];
    $date_naissance = $_POST["date_naissance"];
    $date_aujourd_hui = date("Y-m-d");

    $bdd = DbConnect::getConnectBase(); // RÉPARÉ : Bonne récupération de PDO

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
        ':mdp'               => $mdp,
        ':adresse'           => $adresse,
        ':tel'               => $tel,
        ':date_naissance'    => $date_naissance,
        ':date_inscription'  => $date_aujourd_hui,
        ':id_role'           => 1 // rôle par défaut "utilisateur"
    ]);

    header("Location: ?page=ConnexionForm"); // RÉPARÉ : Redirection propre
    exit;
} else {
    echo "Aucune donnée reçue.";
}