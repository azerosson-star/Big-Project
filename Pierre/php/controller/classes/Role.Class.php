<?php

class Role
{
# attributes ************************
    private $_id_role;
    private $_libelle;
    private $_niveau_perm;

#endAttributes
# accessors ************************

    public function get_niveau_perm()
    {
        return $this->_niveau_perm;
    }

    public function set_niveau_perm($_niveau_perm)
    {
        $this->_niveau_perm = $_niveau_perm;
    }

    public function get_id_role()
    {
        return $this->_id_role;
    }

    public function set_id_role($_id_role)
    {
        $this->_id_role = $_id_role;
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
        if (! empty($data)){
         // empty : renvoi vrai si le tableau est vide
            foreach ($data as $key => $value) {
                $methode = "set_" . $key;
                if (is_callable([$this, $methode])){
                    // is_callable verifie que la methode existe
                
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
        $reflection = new ReflectionClass(Role::class);
        $props      = $reflection->getProperties();

        $names = array_map(fn($prop) => $prop->getName(), $props);

        return ($names);
    }
#endMethods
}
