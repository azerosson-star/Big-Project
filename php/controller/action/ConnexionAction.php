<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $message = '';
    
    if (empty($email) || empty($password)) {
        $message = "Veuillez remplir tous les champs.";
    } else {
        try {
            $db = DbConnect::getDb();
            $query = $db->prepare("SELECT id, email, password FROM utilisateurs WHERE email = ?");
            $query->execute([$email]);
            $utilisateur = $query->fetch(PDO::FETCH_ASSOC);
            
            if ($utilisateur) {
                if (password_verify($password, $utilisateur['password'])) {
                    $_SESSION['utilisateur_id'] = $utilisateur['id'];
                    $_SESSION['utilisateur_email'] = $utilisateur['email'];
                    $_SESSION['utilisateur'] = $utilisateur;
                    
                    header('Location: index.php?page=Accueil');
                    exit();
                } else {
                    $message = "Email ou mot de passe incorrect.";
                }
            } else {
                $message = "Email ou mot de passe incorrect.";
            }
        } catch (Exception $e) {
            $message = "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }
    
    if (!empty($message)) {
        echo "<div class='error-message' style='color: red; padding: 10px; margin: 10px 0; background: #fee;'>" . htmlspecialchars($message) . "</div>";
        include 'php/view/form/connexion.php';
    }
} else {
    include 'php/view/form/connexion.php';
}
