<?php
class Signalement

{
    # attributes ************************
    private $_attribute;

    #endAttributes
    # accessors ************************

    #endAccessors
    # constructor ************************
    public function __construct(array $data = [])
    {
        if (! empty($data)); // empty : renvoi vrai si le tableau est vide
        {
            foreach ($data as $key => $value) {
                $methode = "set_" . $key;
                if (is_callable(([$this, $methode]))) { // is_callable verifie que la methode existe
                    $value = htmlspecialchars($value);
                    $this->$methode($value == "" ? null : $value);
                }
            }
        }
    }
    #endConstructor
    # methods ************************

    #endMethods
};
