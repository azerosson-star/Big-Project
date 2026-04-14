<?php

class utilisateur {
    private $_id_user;
    private $_username;
    private $_email;    
    private $_password;
    private $_adresse;
    private $_tel;
    private $_id_role;

    // Getters
    public function getId_user() {
        return $this->_id_user;
    }

    public function getUsername() {
        return $this->_username;
    }

    public function getEmail() {
        return $this->_email;
    }

    public function getPassword() {
        return $this->_password;
    }

    public function getAdresse() {
        return $this->_adresse;
    }

    public function getTel() {
        return $this->_tel;
    }

    public function getId_role() {
        return $this->_id_role;
    }

    // Setters
    public function setId_user($_id_user) {
        $this->_id_user = $_id_user;
    }

    public function setUsername($_username) {
        $this->_username = $_username;
    }

    public function setEmail($_email) {
        $this->_email = $_email;
    }

    public function setPassword($_password) {
        $this->_password = $_password;
    }

    public function setAdresse($_adresse) {
        $this->_adresse = $_adresse;
    }

    public function setTel($_tel) {
        $this->_tel = $_tel;
    }

    public function setId_role($_id_role) {
        $this->_id_role = $_id_role;

    }

    public function __construct(array $options = [])
    {
        if (!empty($options)) // empty : renvoi vrai si le tableau est vide
        {
            $this->hydrate($options);
        }
    }
    public function hydrate($data)
    {
        foreach ($data as $key => $value)
        {
            $methode = "set" . ucfirst($key); //ucfirst met la 1ere lettre en majuscule
            if (is_callable(([$this, $methode]))) // is_callable verifie que la methode existe
            {
                $this->$methode($value==""?null:$value);
            }
        }
    }


}