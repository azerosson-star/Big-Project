<?php
$droitInsuffisant = <<<HTML
<div class="droit-insuffisant">
    <h2>Accès refusé</h2>
    <p>Vous n'avez pas les droits suffisants pour accéder à cette page.</p>
    <p><a href="index.php?page=Accueil">Retour à l'accueil</a></p>
</div>
HTML;
echo $droitInsuffisant;
