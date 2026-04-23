<?php

class DbConnect
{

    /*****************Attributs***************** */
    private static $_db;

#region
    /*****************Accesseurs***************** */

    public static function get_db()
    {
        return self::$_db;
    }

    /*****************Constructeur***************** */

    public function __construct(array $options = [])
    {
        if (! empty($options)); // empty : renvoi vrai si le tableau est vide
        {
            $this->hydrate($options);
        }
    }
    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            $methode = "set" . ucfirst($key);      //ucfirst met la 1ere lettre en majuscule
            if (is_callable(([$this, $methode]))); // is_callable verifie que la methode existe
            {
                $this->$methode($value == "" ? null : $value);
            }
        }
    }

#finregion
    /*****************Autres Méthodes***************** */

    public static function init()
    {
        try {
            $connection_string = "mysql:host=" . Parametres::get_host() . ";dbname=" . Parametres::get_db_name() . ";port=" . Parametres::get_port() . "";
            self::$_db = new PDO($connection_string, Parametres::get_login(), Parametres::get_pwd());
            self::$_db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            self::$_db->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
        } catch (Exception $e) {
            echo "Base non trouvée";
            echo $e->getMessage();
        }
    }
}
