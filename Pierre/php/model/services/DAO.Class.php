<?php

class DAO
{
    /* @param array $conditions => null par défaut, attendu un tableau associatif 
	 * qui peut prendre plusieurs formes en fonction de la complexité des conditions.
	 *  Exemples : tableau associatif
	 *  [nomColonne => '1'] => "WHERE nomColonne = 1"
	 *  [nomColonne => ''] => "WHERE nomColonne is null "
	 *  [nomColonne => ['1','3']] => "WHERE nomColonne in (1,3)"
	 *  [nomColonne => '%abcd%'] => "WHERE nomColonne like "%abcd%" "
	 *  [nomColonne => '1->5'] => "WHERE nomColonne BETWEEN 1 and 5 "
	 *  Si il y a plusieurs conditions alors :
	 *  [nomColonne1 => '1', nomColonne2 => '%abcd%' ] => "WHERE nomColonne1 = 1 AND nomColonne2 LIKE "%abcd%"
	 * 	[fullTexte]=>'test'=> "WHERE nomColonne1 like "%test%" OR nomColonne2 LIKE "%test%"
	 */
    public static function select(string $table, ?array $colonnes = null, ?array $conditions = null, ?string $order_by = null, bool $api = false, bool $debug = false)
    {
        $str = json_encode($colonnes) . $table . json_encode($conditions) . $order_by;
        if (! str_contains($str, ";")) { // si pas de ; on continue
            $bdd = DbConnect::get_db();
            if ($colonnes == null) {
                $liste_colonnes = "*";
            } else {
                $liste_colonnes = implode(',', $colonnes);
            }
            $req_string  = "SELECT " . $liste_colonnes . " FROM " . $table;
            $where       = conditions_select($conditions);
            $req_string .= $where;
            $req_string .= $order_by == null ? "" : " ORDER BY " . $order_by;
            $requete     = $bdd->prepare($req_string);
            if ($debug) {
                var_dump($requete);
            }
            $liste = [];
            $requete->execute();
            while ($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
                if ($api) {
                    $liste[] = $donnees;
                } else {
                    $liste[] = new $table($donnees);
                }
            }
            return $liste;
        }
    }

    public static function insert($obj)
    {
        $table          = lcfirst(get_class($obj));
        $liste_colonnes = '';
        $liste_valeurs  = '';
        foreach ($table::get_attributs() as $attribut) {
            $liste_colonnes .= substr($attribut, 1) . ',';
            $liste_valeurs  .= ':' . substr($attribut, 1) . ',';
        }
        $db      = DbConnect::get_db();
        $req     = 'INSERT INTO ' . $table . ' (' . $liste_colonnes . 'utilisateur_crea) VALUES (' . $liste_valeurs . ':utilisateur_crea)';
        $requete = $db->prepare($req);
        foreach ($table::get_attributs() as $attribut) {
            $get    = 'get' . $attribut;
            $valeur = $obj->$get();
            switch (gettype($valeur)) {
                case 'string':
                    $type = 'STR';
                    break;
                case 'integer':
                    $type = 'INT';
                    break;
                case 'boolean':
                    $type = 'BOOL';
                    break;
                default:
                    $type = 'NULL';
                    break;
            }
            $requete->bindValue(':' . substr($attribut, 1), $valeur, constant('PDO::PARAM_' . $type));
        }
        $requete->bindValue(':utilisateur_crea', isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur']->get_id_utilisateur() : null, PDO::PARAM_INT);
        if ($requete->execute()) {
            $reussie = true;
        } else {
            $reussie = false;
        }
        $requete->closeCursor();
        return $reussie;
    }

    public static function update($obj)
    {
        $table                  = lcfirst(get_class($obj));
        $liste_colonnes_valeurs = '';
        foreach ($table::get_attributs() as $attribut) {
            $liste_colonnes_valeurs .= substr($attribut, 1) . '=:' . substr($attribut, 1) . ',';
        }
        $db      = DbConnect::get_db();
        $req     = 'UPDATE ' . $table . ' SET ' . $liste_colonnes_valeurs . 'utilisateur_modif=:utilisateur_modif WHERE id_' . $table . '=:id_' . $table;
        $requete = $db->prepare($req);
        foreach ($table::get_attributs() as $attribut) {
            if ($attribut != '_id_' . $table) {
                $get    = 'get' . $attribut;
                $valeur = $obj->$get();
                switch (gettype($valeur)) {
                    case 'string':
                        $type = 'STR';
                        break;
                    case 'integer':
                        $type = 'INT';
                        break;
                    case 'boolean':
                        $type = 'BOOL';
                        break;
                    default:
                        $type = 'NULL';
                        break;
                }
                $requete->bindValue(':' . substr($attribut, 1), $valeur, constant('PDO::PARAM_' . $type));
            }
        }
        $requete->bindValue(':utilisateur_modif', isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur']->get_id_utilisateur() : null, PDO::PARAM_INT);
        if ($requete->execute()) {
            $reussie = true;
        } else {
            $reussie = false;
        }
        $requete->closeCursor();
        return $reussie;
    }

    public static function delete($table, $id)
    {
        $db      = DbConnect::get_db();
        $req     = 'DELETE FROM ' . $table . ' WHERE id_' . $table . '=:id_' . $table . '';
        $requete = $db->prepare($req);
        $requete->bindValue(':id_' . $table, $id, PDO::PARAM_INT);
        if ($requete->execute()) {
            $reussie = true;
        } else {
            $reussie = false;
        }
        $requete->closeCursor();
        return $reussie;
    }

    public static function find_by_id($table, $id)
    {
        return DAO::select($table, null, ["id_" . $table => $id]);
    }

#endMethods
}
