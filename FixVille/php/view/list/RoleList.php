<?php
$listeRoles = RoleService::select();

foreach ($listeRoles as $role) {
    $libelle = htmlspecialchars((string)$role->getLibelle());
    $roleHtml = <<<HTML
    <div>{$libelle}</div>
HTML;
    echo $roleHtml;
}