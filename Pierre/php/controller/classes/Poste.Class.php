<?php

class Poste
{
# attributes ************************
    private $_id_poste;
    private $_nom;
    private $_contenu;
    private $_date_poste;
    private $_adresse;
    private $_importance;
    private $_nb_upvote;
    private $_source_photo;
    private $_id_ville;
    private $_id_utilisateur;
    private $_id_travaux;

#endAttributes
# accessors ************************

    public function get_id_poste()
    {
        return $this->_id_poste;
    }

    public function set_id_poste($_id_poste)
    {
        $this->_id_poste = $_id_poste;
    }

    public function get_nom()
    {
        return $this->_nom;
    }

    public function set_nom($_nom)
    {
        $this->_nom = $_nom;
    }

    public function get_contenu()
    {
        return $this->_contenu;
    }

    public function set_contenu($_contenu)
    {
        $this->_contenu = $_contenu;
    }

    public function get_date_poste()
    {
        return $this->_date_poste;
    }

    public function set_date_poste($_date_poste)
    {
        $this->_date_poste = $_date_poste;
    }

    public function get_adresse()
    {
        return $this->_adresse;
    }

    public function set_adresse($_adresse)
    {
        $this->_adresse = $_adresse;
    }

    public function get_importance()
    {
        return $this->_importance;
    }

    public function set_importance($_importance)
    {
        $this->_importance = $_importance;
    }

    public function get_nb_upvote()
    {
        return $this->_nb_upvote;
    }

    public function set_nb_upvote($_nb_upvote)
    {
        $this->_nb_upvote = $_nb_upvote;
    }

    public function get_source_photo()
    {
        return $this->_source_photo;
    }

    public function set_source_photo($_source_photo)
    {
        $this->_source_photo = $_source_photo;
    }

    public function get_id_ville()
    {
        return $this->_id_ville;
    }

    public function set_id_ville($_id_ville)
    {
        $this->_id_ville = $_id_ville;
    }

    public function get_id_utilisateur()
    {
        return $this->_id_utilisateur;
    }

    public function set_id_utilisateur($_id_utilisateur)
    {
        $this->_id_utilisateur = $_id_utilisateur;
    }

    public function get_id_travaux()
    {
        return $this->_id_travaux;
    }

    public function set_id_travaux($_id_travaux)
    {
        $this->_id_travaux = $_id_travaux;
    }

#endAccessors
# constructor ************************
    public function __construct(array $data = [])
    {
        if (! empty($data)); // empty : renvoi vrai si le tableau est vide
        {
            foreach ($data as $key => $value) {
                $methode = "set_" . $key;
                if (is_callable([$this, $methode])) { // is_callable verifie que la methode existe
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
        $reflection = new ReflectionClass(Poste::class);
        $props      = $reflection->getProperties();

        $names = array_map(fn($prop) => $prop->getName(), $props);

        return ($names);
    }
#endMethods
}
