<?php
session_destroy();
session_start();
echo 'Déconnexion reussie !';
header("Refresh:2;url=index.php?page=accueil");