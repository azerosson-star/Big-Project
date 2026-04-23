<?php

class Utilisateur
{
# attributes ************************
    private $_id_utilisateur;
    private $_nom;
    private $_prenom;
    private $_email;
    private $_pwd;
    private $_id_role;

#endAttributes
# accessors ************************

    public function get_id_role()
    {
        return $this->_id_role;
    }

    public function set_id_role($_id_role)
    {
        $this->_id_role = $_id_role;
    }

    public function get_id_utilisateur()
    {
        return $this->_id_utilisateur;
    }

    public function set_id_utilisateur($_id_utilisateur)
    {
        $this->_id_utilisateur = $_id_utilisateur;
    }

    public function get_prenom()
    {
        return $this->_prenom;
    }

    public function set_prenom($_prenom)
    {
        $this->_prenom = $_prenom;
    }

    public function get_email()
    {
        return $this->_email;
    }

    public function set_email($_email)
    {
        $this->_email = $_email;
    }

    public function get_pwd()
    {
        return $this->_pwd;
    }

    public function set_pwd($_pwd)
    {
        $this->_pwd = $_pwd;
    }

    public function get_nom()
    {
        return $this->_nom;
    }

    public function set_nom($_nom)
    {
        $this->_nom = $_nom;
    }

#endAccessors
# constructor ************************
    public function __construct(array $data = [])
    {
        if (! empty($data)); // empty : renvoi vrai si le tableau est vide
        {
            foreach ($data as $key => $value) {
                $methode = "set_" . $key;
                if (is_callable([$this, $methode])) { // is_callable verifie que la methode exist
                    $value = htmlspecialchars($value);
                    $this->$methode($value == "" ? null : $value);
                }
            }
        }
    }
#endConstructor
# methods ************************
    public static function get_attributes()
    {
        $reflection = new ReflectionClass(Utilisateur::class);
        $props      = $reflection->getProperties();

        $names = array_map(fn($prop) => $prop->getName(), $props);

        return ($names);
    }
#endMethods
}
