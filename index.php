<?php
session_start();
if(isset($_SESSION['sessionid'])&& $_SESSION['sessionid']== session_id()){
  header("Location: tchat.php");
}

require_once 'connect.php';

if (isset($_POST['lelogin'])&& isset($_POST['lemdp'])){
 $lelogin = htmlentities(strip_tags(trim($_POST['lelogin'])),ENT_QUOTES);
 $lemdp = htmlentities(strip_tags(trim($_POST['lemdp'])),ENT_QUOTES);
 
 // requete de verification si le login et le mot de passe correspondent
 // à ce qu'il ya dans la db
 
 $req = "SELECT id, lelogin, lemail, avatar FROM utilisateur WHERE lelogin = '$lelogin' AND mdp = '$lemdp' ";
 $query = mysqli_query($mysqli, $req) or die(mysqli_error($mysqli));
 if(mysqli_num_rows($query)){
     $data_user = mysqli_fetch_assoc($query);
     $_SESSION['login'] = $data_user['lelogin'];
     $_SESSION['id'] = $data_user['id'];
     $_SESSION['lemail'] = $data_user['lemail'];
     $_SESSION['avatar'] = $data_user['avatar'];
     $_SESSION['sessionid'] = session_id();
    
     header("Location: tchat.php");
 }
 else{
     $erreur = " Mauvais mot de passe ou login !";
 }  
}

?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Bienvenue!</title>
        <link rel="stylesheet" href="<?php echo PATH ?>/tchat.css"/>
    </head>
    <body>
        <div class="connect">
        <form method="POST" action="" name="form">
            <label for="lelogin" ></label>
            <input id="lelogin" type="text"name="lelogin" placeholder="login" required/> 
            <label for="lemdp"></label>
            <input id="lemdp" type="password" name="lemdp" placeholder="mot de passe"required/> 
            <input type="submit" value="se connecter"/>  
        </form>
        
        <?php
        if (isset($erreur)){
        echo $erreur;
        
        }
        
        ?>
        </div>
    </body>
</html>
