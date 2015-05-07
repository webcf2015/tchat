<?php
session_start();
if(!isset($_SESSION['sessionid'])|| $_SESSION['sessionid']!= session_id()){
  header("Location: deconnect.php");
}
require_once 'connect.php';
?>
<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="<?php echo PATH ?>/tchat.css"/>
    <head>
        <meta charset="UTF-8">
        <title>Bonjour <?php
        echo ucfirst($_SESSION['login']);
        ?>
        </title>
        <script src="<?php echo PATH ?>/ajax.js"></script>
    </head>
    <body onload="recup_texte(
                'recup.php',
                'lescontenus', 
                'chargement_contenu',
                '<?php echo PATH ?>/img/loader.gif'
                );">
    <div class="connect">
        <img src="<?php echo PATH.$_SESSION['avatar'] ?>" alt="<?php echo $_SESSION['login']?>" title="<?php echo ucfirst($_SESSION['login'])?>"/>
   <a href="deconnect.php">Déconnexion</a>
    </div>
    
    
    
    <div id="lescontenus" class="text">
  
    </div>
    
    <div id="chargement_contenu"></div>
    
    
    <div class="formulaire">
        <textarea name="envoi" id="envoi"></textarea><button id="envoyer" onclick="sauve_texte('<?php echo PATH ?>/sauve.php',
                    'envoi',
                    'chargement',
                    '<?php echo PATH ?>/img/loading.gif');">Envoyer</button>
        <div id="chargement"></div>
    </div>
    <script>
    // on crée un interval qui va appeler la fonction verif_table toutes les 3000 millisecondes    
    setInterval(function(){ verif_table('verif.php',
                'recup.php',
                'lescontenus', 
                'chargement_contenu',
                '<?php echo PATH ?>/img/loader.gif'
                );}, 3000);
    
    </script>
</body>
</html>