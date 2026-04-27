<?php
class Role
{
    private $_id_role;
    private $_libelle;
    private static $_attributes = ['id_role', "libelle"];

    public static function getAttributes() { return self::$_attributes; }
    
    public function getLibelle() { return $this->_libelle; }
    public function setLibelle($_libelle) { $this->_libelle = $_libelle; }

    public function getId_role() { return $this->_id_role; }
    public function setId_role($_id_role) { $this->_id_role = $_id_role; }

    public function __construct(array $options = [])
    {
        if (!empty($options)) { $this->hydrate($options); }
    }
    
    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            $methode = "set" . ucfirst($key);
            if (is_callable(([$this, $methode]))) {
                $this->$methode($value=="" ? null : $value);
            }
        }
    }
}