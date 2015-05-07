<?php
require_once 'config.php';
$mysqli=  mysqli_connect(DBHOST, DBLOGIN, DBMDP, DBNAME) or die("erreur: ".mysqli_connect_error($mysqli));
mysqli_set_charset($mysqli, "utf8");