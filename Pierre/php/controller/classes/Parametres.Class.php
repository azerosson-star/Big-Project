<?php

class Parametres
{
	private static $_nom_projet;
	private static $_host;
	private static $_port;
	private static $_db_name;
	private static $_login;
	private static $_pwd;
	private static $_nav;

	#region
	static public function get_nom_projet()
	{
		return self::$_nom_projet;
	}

	static function get_host()
	{
		return self::$_host;
	}

	static function get_port()
	{
		return self::$_port;
	}

	static function get_db_name()
	{
		return self::$_db_name;
	}

	static function get_login()
	{
		return self::$_login;
	}

	static function get_pwd()
	{
		return self::$_pwd;
	}

		static public function get_nav()
	{
		return self::$_nav;
	}

	#endregion
	static function init()
	{
        if (file_exists("config.json")) {
            //json_decode => decode en objet
            // json_decode(...,true) =>decode en tableau associatif
            $contenu = json_decode(file_get_contents("config.json"));
            self::$_nom_projet = $contenu->nom_projet;
            self::$_host = $contenu->host;
            self::$_login = $contenu->login;
            self::$_pwd = $contenu->pwd;
            self::$_db_name = $contenu->db_name;
            self::$_port = $contenu->port;
            $tabNav = json_decode(json_encode($contenu->nav), true);
            // tabNav est un tableau associatif
            foreach ($tabNav as  $value) {
				$obj = new NavElement($value);
				$tab_obj[]=$obj;
                NavElement::set_new_elt($obj);
            }
            self::$_nav = $tab_obj;
        }
	}
}

	