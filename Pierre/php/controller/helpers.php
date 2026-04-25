<?php

function decode($texte)
{
    return $texte;
}

/* @param array $conditions => null par défaut, attendu un tableau associatif 
* qui peut prendre plusieurs formes en fonction de la complexité des conditions.
*  Exemples : tableau associatif
*  [nomColonne => '1'] => "WHERE nomColonne = 1"
*  [nomColonne => ''] => "WHERE nomColonne is null "
*  [nomColonne => ['1','3']] => "WHERE nomColonne in (1,3)"
*  [nomColonne => '%abcd%'] => "WHERE nomColonne like "abcd" "
*  [nomColonne => '1->5'] => "WHERE nomColonne BETWEEN 1 and 5 "
*  Si il y a plusieurs conditions alors :
*  [nomColonne1 => '1', nomColonne2 => '%abcd%' ] => "WHERE nomColonne1 = 1 AND nomColonne2 LIKE "%abcd%"
* 	[fullTexte]=>'test'=> "WHERE nomColonne1 like "%test%" OR nomColonne2 LIKE "%test%"
*/
function conditions_select(?array $conditions = null)
{
    if ($conditions == null) {
        return "";
    }
    $reponse = " WHERE ";
    foreach ($conditions as $key => $value) {
        if (is_array($value)) {
            $reponse .= $key . " in (";
            foreach ($value as $item) {
                $reponse .= $item . ",";
            }
            $reponse  = substr($reponse, 0, strlen($reponse) - 1);
            $reponse .= ") AND ";
        } else {
            if ($value == "") {
                $reponse .= $key . " is null AND ";
            } else {
                if (str_contains($value, '%')) {
                    $reponse .= $key . " like '" . $value . "' AND";
                } else {
                    if (str_contains($value, '->')) {
                        $reponse .= $key . " BETWEEN " . substr($value, 0, 1) . " and " . substr($value, -1, 1) . " AND "; //strlen($val)
                    } else {
                        $reponse .= $key . " = '" . $value . "' AND ";
                    }
                }

            }
        }
    }

    $reponse  = substr($reponse, 0, strlen($reponse) - 4);
    return $reponse;
}
