<?php

class Route
{
# attributes ************************
    private $_chemin;
    private $_role_requis;
    

#endAttributes
# accessors ************************

    public function get_role_requis()
    {
        return $this->_role_requis;
    }

    public function set_role_requis($_role_requis)
    {
        $this->_role_requis = $_role_requis;
    }

    public function get_nom_fichier()
    {
        return $this->_nom_fichier;
    }

    public function set_nom_fichier($_nom_fichier)
    {
        $this->_nom_fichier = $_nom_fichier;
    }

    public function get_chemin()
    {
        return $this->_chemin;
    }

    public function set_chemin($_chemin)
    {
        $this->_chemin = $_chemin;
    }
    

#endAccessors
# constructor ************************
    public function __construct(array $data = [])
    {
        if (!empty($data)){ // empty : renvoi vrai si le tableau est vide
            foreach ($data as $key => $value)
            {
                $methode = "set_" .$key;
                if (is_callable(([$this, $methode]))) // is_callable verifie que la methode existe
                {
                    $this->$methode($value==""?null:$value);
                }
            }
        }
    }
#endConstructor
# methods ************************
    

#endMethods
}