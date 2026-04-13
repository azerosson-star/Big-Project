<?php

class Role
{
    private $_idRole;
    private $_libelle;

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

    
    public function __construct(array $options = [])
    {
        if (!empty($options))
        {
            $this->hydrate($options);
        }
    }
    public function hydrate($data)
    {
        foreach ($data as $key => $value)
        {
            $methode = "set" . ucfirst($key);
            if (is_callable([$this, $methode])) {
                $this->$methode($value==""?null:$value);
            }
        }
    }

}
