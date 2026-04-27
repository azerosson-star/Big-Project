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
            self::$_connectBase = new PDO($connectionString, Parametre::getLogin(), Parametre::getPassword(), [
                // Demande à PDO de lever des exceptions en cas d'erreur SQL (super utile pour débugger)
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                // Force les résultats sous forme de tableaux associatifs par défaut
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC 
            ]);
        } catch (Exception $e) {
            // "die" arrête net le script pour éviter des plantages en cascade
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
}