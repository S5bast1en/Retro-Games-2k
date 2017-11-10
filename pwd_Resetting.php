<?php

$page = [
    'title' => 'Mot de passe oublié',
    'premium' => false,
    'admin' => false,
];

require_once 'view/app.php';


/*A nouveau, je vais définir des variables vides success et errors pour afficher les messages. Sachant que j'utilise success pour tester la connection au début de l'exercice. A terme, la connection redirigera l'utilisateur sur une autre page. Je vais aussi utiliser isset a nouveau pour que l'utilisateur qui arrive sur la page n'est pas de message.*/


$success = "";
$errors = "";

    $query = 'SELECT reset_token, reset_expire FROM users WHERE id=?';
    $stmt = $db->prepare( $query );
    $stmt->bindValue( 1, $_POST["ZidPost"]);
    $stmt->execute();
    $tokenUser=$stmt -> fetch();

    $resetTime = strtotime($tokenUser["reset_expire"]);

if ( isset( $_POST["Zpwd"] ) ) {

    if( $tokenUser["reset_token"] =  $_POST["ZtokenPost"] ) {

      if( $resetTime >= time() ) {

        if( empty( $_POST["Zpwd"] ) ){ $errors .= "<li>Vous devez renseigner le mot de passe</li>";}
        if( strlen ($_POST["Zpwd"] <8  ) ){ $errors .= "<li>Votre mot de passe doit contenir 8 caratères</li>"; }
        if( is_numeric ($_POST["Zpwd"] ) ){ $errors .= "<li>Votre mot de passe doit contenir aussi des caratères</li>"; }
        if( $_POST["Zpwd"] != $_POST["Zpwd2"]) { $errors .= "<li>Vous devez renseigner le même mot de passe</li>"; }

              $query = 'UPDATE users SET password=?,reset_expire=?,reset_token=? WHERE id=?';
              $stmt = $db->prepare( $query );
              $stmt->bindValue( 1, password_hash( $_POST["Zpwd"], PASSWORD_DEFAULT));
              $stmt->bindValue( 2, NULL );
              $stmt->bindValue( 3, NULL );
              $stmt->bindValue( 4, $_POST["ZidPost"]);

              if( $stmt->execute() ){
                  $success = "Votre nouveau mot de passe est enregistre";
                  var_dump($success);

              }
        }else{

        }
      }
    }

require_once "header.php";
?>

 <h2>Création de votre nouveau mot de passe oublié</h2>

 <form method="POST">

 <label>Mot de passe: <input type="password" name="Zpwd"/></label><br/>
 <label>Confirmation du mot de passe: <input type="password" name="Zpwd2"/></label><br/>
 <label><input type="hidden" name="ZtokenPost" value="<?php echo $_GET["token"] ?>" /></label><br/>
 <label><input type="hidden" name="ZidPost" value="<?php echo $_GET["id"] ?>"/></label><br/>


 <input type="submit" value="Envoyer" class="button expanded" />
 </form>



<?php require_once "footer.php";  ?>
