<?php

class Produit
{

    /*****************Attributs***************** */
    private $_idProduit;
    private $_nom;
    private $_description;

#region
    /*****************Accesseurs***************** */

    public function getDescription()
    {
        return $this->_description;
    }

    public function setDescription($_description)
    {
        $this->_description = $_description;
    }

    public function getNom()
    {
        return $this->_nom;
    }

    public function setNom($_nom)
    {
        $this->_nom = $_nom;
    }

    public function getIdProduit()
    {
        return $this->_idProduit;
    }

    public function setIdProduit($_idProduit)
    {
        $this->_idProduit = $_idProduit;
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
                $value=htmlspecialchars($value); // pour eviter les injections HTML
                $this->$methode($value==""?null:$value);
            }
        }
    }

#finregion
    /*****************Autres Méthodes***************** */
    
}