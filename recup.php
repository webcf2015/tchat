<?php

session_start();
if(!isset($_SESSION['sessionid'])|| $_SESSION['sessionid']!= session_id()){
  header("Location: deconnect.php");
}
require_once 'connect.php';

    
// requête qui insert le commentaire dans le db
$sql = "SELECT l.lemess, l.ladate, u.lelogin, u.avatar FROM lepost l
	INNER JOIN utilisateur u ON l.utilisateur_id = u.id
        ORDER BY l.ladate DESC
        LIMIT $nb_messages_tchat;";
    
// exécution de la requête
$req = mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));

// récupération de toutes les lignes dans un tableau associatif
$recup = mysqli_fetch_all($req);

// on trie le contenu du tableau par les clefs par ordre descendant
krsort($recup);

// var_dump($recup);

// création de la variable de sortie de type text
$sortie = "";

/* tant que l'on a des éléments dans le tableau dont la "$value" sera également un tableau indexé avec comme valeurs: 
 * 0 => le texte
 * 1 => la date
 * 2 => le login
 * 3 => l'url de l'image
 */
foreach ($recup as $key => $value) {
    $sortie .= "<div id='txt$key' class='lepost'>";
    $sortie .= "<div style='float:left; margin-right:1em'><img src='".PATH.$value[3]."' title='".$value[2]."' alt='".$value[2]."' /></div>";
    $sortie .="<div style='width:80%; float:left'>";
    $sortie .= "<span style='font-size:1.5em; font-weight:bolder; color:green'>".$value[2]."</span><br /><span>".$value[1]."</span>";
    $sortie .= "<p>".$value[0]."</p>";
    $sortie .= "</div>";
    $sortie .= "</div>";
}
echo $sortie;


