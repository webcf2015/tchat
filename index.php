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
        <link href='http://fonts.googleapis.com/css?family=Anton' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo PATH ?>/css/tchat.css"/>
        <link rel="stylesheet" href="<?php echo PATH ?>/css/bootstrap.css" />
        <style>
		body{ backround:#3aada9}
		</style>
    </head>
    <body>
        <div class="connexion">
            <h1>Bienvenue sur CF2m Tchat </h1>
            <div class="connect one-login">
                <div class="login-head">
                     <img src="img/login-icon.png" alt="Connexion" />
                     <h2>CONNEXION</h2>
                     <span></span>
                </div>
                <form method="POST" action="" name="form">
                <ul>
                    <li>
                        <input id="lelogin" type="text" name="lelogin" value="login" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'Login';}" required/><a href="#" class=" icon user"></a> 
                    </li>
                    <li>
                        <input id="lemdp" type="password" name="lemdp" value="mot de passe" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'Mot de pass';}" required/><a href="#" class=" icon kumba"></a> 
                    </li> 
                 </ul>   
                <div class="version-2">
                   <label class="checkbox"><input type="checkbox" name="checkbox" checked /><i></i>Se Souvenir de moi</label>
                   <h6><a href="#">Password perdu ?</a></h6>
                   <div class="clear"></div>
                </div>
                <div class="submit">
                    <input type="submit" value="CONNEXION"/> 
                </div>
                <h5>Vous n'avez pas encore de compte ? <a href="#">S'enregistrer</a></h5>
                     
                </form>
                
                <?php
                if (isset($erreur)){
                echo $erreur;
                
                }
                
                ?>
            </div>
        </div>
    </body>
</html>