<?php

require_once "BDD.Class.php";

class Inscription{

private $_username;
private $_email;
private $_password;
private $_adresse;

private $_tel;

public function getTel() {
    return $this->_tel;
    }
public function setTel($_tel)
    {
        $this->_tel = $_tel;
    }

public function getAdresse() {
    return $this->_adresse;
    }

public function setAdresse($_adresse)
    {
        $this->_adresse = $_adresse;
    }

   public function getUsername()
    {
        return $this->_username;
    }

    public function setUsername($_username)
    {
        $this->_username = $_username;
    }


    public function getEmail() {
    return $this->_email;
    
}

public function setEmail($_email)
    {
        $this->_email = $_email;
    }


public function getPassword() {
    return $this->_password;
    
}

public function setPassword($_password)
    {
        $this->_password = $_password;
    }



        public function __construct(array $options = [])
    {
        if (!empty($options)) 
        {
            $this->hydrate($options);
        }
    }
    public function hydrate($data)
    {
        foreach ($data as $key => $value)
        {
            $methode = "set" . ucfirst($key); 
            if (is_callable(([$this, $methode]))) //
                $this->$methode($value==""?null:$value);
        }
    }

 public function Lecture(){
 $chemin_config = dirname(__DIR__, 3) . '/config.json';
    $config = json_decode(file_get_contents($chemin_config), true);
    $username = null;
    $password = null;
    $email = null;
    $adresse = null;
    $tel = null;
 if($_SERVER["REQUEST_METHOD"]=="POST"){

 
 $this->_username = $username= htmlspecialchars(trim($_POST['username']));
 $this->_password = $password = htmlspecialchars(trim($_POST['password']));
 $this->_email= $email = htmlspecialchars(trim($_POST['email']));}
 $this->_adresse = $adresse = htmlspecialchars(trim($_POST['adresse']));
    $this->_tel = $tel = htmlspecialchars(trim($_POST['tel']));
 return [$username ,$password , $email , $adresse, $tel, $config];
 }
 


public function Ajouter(){
$donneesLecture = $this->Lecture();
    
    $username = $donneesLecture[0];
    $password = $donneesLecture[1];
    $email = $donneesLecture[2];
    $adresse = $donneesLecture[3];
    $tel = $donneesLecture[4];
    $config = $donneesLecture[5];
 if(!empty($username) && !empty($password) && !empty($email)) {
 try {
  $newUser = new BDD($config);
  $pdo = $newUser->connexion();
  $sql = "INSERT INTO users (username, email, password, adresse, tel) VALUES (:username, :email, :password, :adresse, :tel)";
  $requete = $pdo->prepare($sql);

  $requete->execute([
    ':username' => $username,
    ':email' => $email,
    ':password' => password_hash($password, PASSWORD_DEFAULT),
    ':adresse' => $adresse,
    ':tel' => $tel
  ]);
 } catch (Exception $e) {
  echo "Erreur : " . $e->getMessage();
 }
 }
}}
