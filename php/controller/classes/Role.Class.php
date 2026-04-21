<?php

class Role
{

    /*****************Attributs***************** */
    private $_idRole;
    private $_libelle;
    private static $_attributes=['idRole',"libelle"];

#region
    /*****************Accesseurs***************** */

    public static function getAttributes()
    {
        return self::$_attributes;
    }
    public function getLibelle()
    {
        return $this->_libelle;
    }

    public function setLibelle($_libelle)
    {
        $this->_libelle = $_libelle;
    }

    public function getIdRole()
    {
        return $this->_idRole;
    }

    public function setIdRole($_idRole)
    {
        $this->_idRole = $_idRole;
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