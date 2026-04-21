<?php

class Utilisateur
{

    /*****************Attributs***************** */
    private $_iduser;
    private $_Login;
    private $_adresse;
    private $_idRole;
    private $_tel;
    private $_username;
    private $_password;
    private static $_attributes=['id_user',"login","password","id_role"];

#region
    /*****************Accesseurs***************** */

    public static function getAttributes()
    {
        return self::$_attributes;
    }

    public function getIdRole()
    {
        return $this->_idRole;
    }

    public function setIdRole($_idRole)
    {
        $this->_idRole = $_idRole;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function setPassword($_password)
    {
        $this->_password = $_password;
    }

    public function getLogin()
    {
        return $this->_Login;
    }

    public function setLogin($_Login)
    {
        $this->_Login = $_Login;
    }

    public function getIdUser()
    {
        return $this->_iduser;
    }

    public function setIdUser($_iduser)
    {
        $this->_iduser = $_iduser;
    }
    public function getAdresse()
    {
        return $this->_adresse;
    }
    public function setAdresse($_adresse)
    {
        $this->_adresse = $_adresse;
    }
    public function getTel()
    {
        return $this->_tel;
    
    }
    public function setTel($_idtel)
    {
        $this->_tel = $_idtel;
    }

    public function GetUsername()
    {
        return $this->_username;
    }
    public function setUsername($_username)
    {
        $this->_username = $_username;
    }
    /*****************Constructeur***************** */

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

#finregion
    /*****************Autres Méthodes***************** */
    
}