<?php

class DbConnect {
    private static $db;

    public static function getDb() {
        return DbConnect::$db;
    }

    public static function init() {
        try {
            
            $host = Parametre::getHost();
            $port = Parametre::getPort();
            $dbname = Parametre::getNomBase();
            $login = Parametre::getLogin();
            $password = Parametre::getPassword();

            
            DbConnect::$db = new PDO('mysql:host=' . $host . ';port=' . $port . ';dbname=' . $dbname . ';charset=utf8', $login, $password);
            
            
            DbConnect::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (Exception $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }
}