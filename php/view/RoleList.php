<?php

$listeRoles = RoleService::select();
foreach ($listeRoles as $role) {
   echo '<div>'.$role->getLibelle().'</div>';
}