<?php

class NavElement
{
# attributes ************************
    private $_libelle;
    private $_icone;
    private $_reference;
    private $_role_requis;
    private $_couleur;
    public static $_all_elt = [];

#endAttributes
# accessors ************************

    public static function get_all_elt()
    {
        return self::$_all_elt;
    }

    public static function set_new_elt($_new_elt)
    {
        // if (is_callable([$_new_elt, 'get_libelle'])) {
            self::$_all_elt[$_new_elt->get_libelle()] = $_new_elt;
        // } else {
        //     self::$_all_elt[] = $_new_elt;
        // }
    }

    public static function set_all_elt($_all_elt)
    {
        self::$_all_elt = $_all_elt;
    }

    public function get_couleur()
    {
        return $this->_couleur;
    }

    public function set_couleur($_couleur)
    {
        $this->_couleur = $_couleur;
    }

    public function get_role_requis()
    {
        return $this->_role_requis;
    }

    public function set_role_requis($_role_requis)
    {
        $this->_role_requis = $_role_requis;
    }

    public function get_reference()
    {
        return $this->_reference;
    }

    public function set_reference($_reference)
    {
        $this->_reference = $_reference;
    }

    public function get_icone()
    {
        return $this->_icone;
    }

    public function set_icone($_icone)
    {
        $this->_icone = $_icone;
    }

    public function get_libelle()
    {
        return $this->_libelle;
    }

    public function set_libelle($_libelle)
    {
        $this->_libelle = $_libelle;
    }

#endAccessors
# constructor ************************
    public function __construct(array $data = [])
    {
        if (! empty($data)); // empty : renvoi vrai si le tableau est vide
        {
            foreach ($data as $key => $value) {
                $methode = "set_" . $key;
                if (is_callable(([$this, $methode]))); // is_callable verifie que la methode existe
                {
                    $this->$methode($value == "" ? null : $value);
                }
            }
        }
    }
#endConstructor
# methods ************************
    public static function get_attributes()
    {
        $reflection = new ReflectionClass(Role::class);
        $props      = $reflection->getProperties();

        $names = array_map(fn($prop) => $prop->getName(), $props);

        return ($names);
    }

#endMethods
}
