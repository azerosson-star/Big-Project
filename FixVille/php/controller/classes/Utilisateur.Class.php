<?php
class Utilisateur
{
    private $_id_utilisateur;
    private $_nom;
    private $_prenom;
    private $_email;
    private $_mdp;
    private $_adresse;
    private $_tel;
    private $_date_naissance;
    private $_id_role;

    private static $_attributes = ['id_utilisateur', 'nom', 'prenom', 'email', 'mdp', 'adresse', 'tel', 'date_naissance', 'id_role'];

    public static function getAttributes() { return self::$_attributes; }

    public function getId_utilisateur() { return $this->_id_utilisateur; }
    public function setId_utilisateur($_id_utilisateur) { $this->_id_utilisateur = $_id_utilisateur; }

    public function getNom() { return $this->_nom; }
    public function setNom($_nom) { $this->_nom = $_nom; }

    public function getPrenom() { return $this->_prenom; }
    public function setPrenom($_prenom) { $this->_prenom = $_prenom; }

    public function getEmail() { return $this->_email; }
    public function setEmail($_email) { $this->_email = $_email; }

    public function getMdp() { return $this->_mdp; }
    public function setMdp($_mdp) { $this->_mdp = $_mdp; }

    public function getAdresse() { return $this->_adresse; }
    public function setAdresse($_adresse) { $this->_adresse = $_adresse; }

    public function getTel() { return $this->_tel; }
    public function setTel($_tel) { $this->_tel = $_tel; }

    public function getDate_naissance() { return $this->_date_naissance; }
    public function setDate_naissance($_date_naissance) { $this->_date_naissance = $_date_naissance; }

    public function getId_role() { return $this->_id_role; }
    public function setId_role($_id_role) { $this->_id_role = $_id_role; }

    // Alias pour conserver la compatibilité avec le reste du code si nécessaire
    public function getUsername() { return $this->_nom . ' ' . $this->_prenom; }
    public function getLogin() { return $this->_email; }
    public function getPassword() { return $this->_mdp; }

    public function __construct(array $options = [])
    {
        if (!empty($options)) {
            $this->hydrate($options);
        }
    }

    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            $methode = "set" . ucfirst($key);
            if (is_callable([$this, $methode])) {
                $this->$methode($value == "" ? null : $value);
            }
        }
    }
}