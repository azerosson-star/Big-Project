<?php

 echo '   <header class="bg-dark p-1">
        <nav class="flex justify-between align-center container">
            <h2>ECF</h2>
            <div class="flex gap-1">';
            $navInfo = Parametre::getNav();
foreach ($navInfo as $value) {
    // On ajoute "?page=" devant la référence pour que le routeur intercepte la demande
    echo '<a href="?page='.$value->getReference().'" class="td-none nav-icon" >
    <span class="fas fa-'.$value->getIcon().'"></span>
    <span class="nav-text ">'.$value->getNom().'</span></a>';
}
echo '            </div>
        </nav>
    </header>
    <main class="container">
';