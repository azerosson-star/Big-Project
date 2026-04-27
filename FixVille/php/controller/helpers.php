<?php

function hashage($texte)
{
    $hashe = md5(md5($texte) . "1");
    return $hashe;
}

/**
 * Appel le getter en fonction du nom de l'attribut (chaine) dans la classe de $obj
 */
function appelGet($obj, $chaine)
{
    $methode = 'get' . ucfirst($chaine);
    return call_user_func(array($obj, $methode));
}

/**
 * Crée un select a partir des informations passées en parametre
 */
function creerSelect(?int $valeur, string $table, array $nomColonnes, ?string $attributs = "", ?array $condition = null, ?string $orderBy = null, ?string $attributId = null, string $invite = "choisissez")
{
    $nomId = $table::getAttributes()[0];
    $atrId = ($attributId == null ? $nomId : $attributId); 

    $select = '<select id="' . $atrId . '" name="' . $atrId . '"' . $attributs . '>';
    $servic = $table . 'Service';
    $libelle = $nomColonnes;
    array_push($nomColonnes, $nomId); 
    $liste = $servic::select($nomColonnes, $condition, $orderBy, false, false);
    if ($valeur == null) {
        $select .= '<option value="" SELECTED>' . $invite . '</option>';
    } else {
        $select .= '<option value="">' . $invite . '</option>';
    }
    foreach ($liste as $elt) {
        $content = "";
        foreach ($libelle as $value) {
            $content .= appelGet($elt, $value) . " | ";
        }

        $content = substr($content, 0, -3);

        if ($valeur == appelGet($elt, $nomId)) {
            $select .= '<option value="' . appelGet($elt, $nomId) . '" SELECTED>' . $content . '</option>';
        } else {
            $select .= '<option value="' . appelGet($elt, $nomId) . '">' . $content . '</option>';
        }
    }
    $select .= "</select>";
    return $select;
}

/**
 * MESSAGES FLASH
 */
function setFlash($message, $type = 'success') {
    $_SESSION['flash'] = [
        'message' => $message,
        'type' => $type
    ];
}

function displayFlash() {
    if (isset($_SESSION['flash'])) {
        $f = $_SESSION['flash'];
        $bg = ($f['type'] == 'danger') ? '#f44336' : '#4CAF50';
        echo '<div style="background-color: '.$bg.'; color: white; padding: 15px; margin: 10px 0; border-radius: 5px; text-align: center; font-weight: bold; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">';
        echo htmlspecialchars($f['message']);
        echo '</div>';
        unset($_SESSION['flash']); 
    }
}

/**
 * GÉNÉRATION / VÉRIFICATION CSRF
 */
function getToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function checkToken($token) {
    return (isset($_SESSION['csrf_token']) && $token === $_SESSION['csrf_token']);
}

/**
 * CONDITIONS SELECT SÉCURISÉES (Requêtes préparées PDO)
 * Retourne un tableau ['sql' => "WHERE...", 'params' => [tableau de bind]]
 */
function conditionsSelect(?array $conditions = null) {
    $res = ['sql' => "", 'params' => []];
    if ($conditions == null) return $res;

    $sql = " WHERE ";
    foreach ($conditions as $key => $value) {
        if ($key != "fullTexte") {
            if (is_array($value)) {
                // Gestion du IN (ex: id in (1,2,3)) - un peu plus complexe avec PDO, on simplifie pour l'exemple
                $in = "";
                foreach($value as $i => $item) {
                    $in .= ":{$key}{$i},";
                    $res['params']["{$key}{$i}"] = $item;
                }
                $in = rtrim($in, ",");
                $sql .= "$key IN ($in) AND ";
            } elseif ($value == "") {
                $sql .= "$key IS NULL AND ";
            } elseif (strpos((string)$value, "%") !== false) {
                $sql .= "$key LIKE :$key AND ";
                $res['params'][$key] = $value;
            } elseif (strpos((string)$value, "->") !== false) {
                $tab = explode("->", $value);
                $sql .= "($key BETWEEN :{$key}min AND :{$key}max) AND ";
                $res['params'][$key.'min'] = $tab[0];
                $res['params'][$key.'max'] = $tab[1];
            } else {
                $sql .= "$key = :$key AND ";
                $res['params'][$key] = $value;
            }
        } else {
            // Gestion FullTexte simplifiée (Recherche globale)
            $listeColonne = Utilisateur::getAttributes();
            $sql .= "(";
            foreach ($listeColonne as $i => $colo) {
                $sql .= "$colo LIKE :full$i OR ";
                $res['params']["full$i"] = "%" . $value . "%";
            }
            $sql = substr($sql, 0, -4) . ") AND ";
        }
    }
    $res['sql'] = substr($sql, 0, -5); // On enlève le dernier " AND "
    return $res;
}