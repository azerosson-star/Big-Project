<?php

class DbConnect
{
# attributes ************************
    private static $_db;

#endAttributes
# accessors ************************
    public static function get_db()
    {
        return self::$_db;
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
    public static function init()
    {
        try {
            $connection_string = "mysql:host=" . Parametres::get_host() . ";dbname=" . Parametres::get_db_name() . ";port=" . Parametres::get_port() . "";
            self::$_db         = new PDO($connection_string, Parametres::get_login(), Parametres::get_pwd());
            self::$_db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            self::$_db->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
        } catch (Exception $e) {
            echo "Base non trouvée";
            echo $e->getMessage();
        }
    }

#endMethods
}
