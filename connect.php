<?php
// pour les erreurs
ini_set('display_errors', '1');
require_once 'config.php';
$mysqli=  mysqli_connect(DBHOST, DBLOGIN, DBMDP, DBNAME) or die("erreur: ".mysqli_connect_error($mysqli));
mysqli_set_charset($mysqli, "utf8"); 