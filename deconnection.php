<?php
session_start(); 
// initialise la session
session_unset();
// desactive la session
session_destroy();
// Détruit la session
setcookie('log', '', time()-3444, '/', null, false, true);
// Detruit le cookie
header('location: ./');



?>