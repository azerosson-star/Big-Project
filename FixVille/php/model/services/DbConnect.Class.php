<?php

class DbConnect
{

    /*****************Attributs***************** */
    private static $_connectBase;

#region
    /*****************Accesseurs***************** */

    public static function getConnectBase()
    {
        return self::$_connectBase;
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
        foreach ($data as $key => $value) {
            $methode = "set" . ucfirst($key); //ucfirst met la 1ere lettre en majuscule
            if (is_callable(([$this, $methode]))) // is_callable verifie que la methode existe
            {
                $this->$methode($value == "" ? null : $value);
            }
        }
    }

#finregion
    /*****************Autres Méthodes***************** */

    public static function init()
    {
        $connectionString = "mysql:host=" . Parametre::getHost() . ";dbname=" . Parametre::getNomBase() . ";port=" . Parametre::getPort();
        try {

            self::$_connectBase = new PDO($connectionString, Parametre::getLogin(), Parametre::getPassword());
        } catch (Exception $e) {
            echo "La base de données n'est pas connectée";
            echo $e->getMessage();
        }
    }
}
