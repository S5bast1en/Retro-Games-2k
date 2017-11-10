<?php
$page = [
    'title' => 'Mot de passe oublié',
    'premium' => false,
    'admin' => false,
];
require_once "view/app.php";


$errors="";

//Vérification de l´email et si existance dans la BDD
  if (isset( $_POST['Zemail'] ) ){
    if( empty( $_POST['Zemail']) ){ $errors .= "<li>Saisir un email</li>"; }
    if( filter_var($_POST['Zemail'], FILTER_VALIDATE_EMAIL) === false) { $errors .= "<li>Saisir un format d´email valide</li>"; }

    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt -> bindValue(1, $_POST["Zemail"]);
    $stmt -> execute();
    $emailInDB = $stmt -> fetch();
    //var_dump($emailInDB); --> A eviter de laisser ce genre de var_dump !

    if ( $emailInDB ) {
      $msgReInit ="Vous avez demandé une réinitialisation de votre mot de passe, cliquez sur le lien : \n";
      $msgReInit .="http:/localhost/Projet_PHP_btstrp/pwd_Resetting.php?id=".$emailInDB["id"];
      $msgReInit .="&token=";
      $token = generateResetToken();
      $msgReInit .=$token;
      echo($msgReInit);

      $query = "UPDATE users SET reset_token = ?, reset_expire= ? WHERE id = ?" ;
      $stmt = $db->prepare( $query );
      $stmt->bindValue( 1, $token );
      $stmt->bindValue( 2, date(("Y-m-d"), time() + 24*60*60) );
      $stmt->bindValue( 3, $emailInDB["id"] );
      $stmt->execute();

    }
  } else { $errors .="<li>Cette adresse email n´existe pas </li>"; }

require_once "header.php"; ?>

 <h2>Mot de passe oublié </h2>

 <form method="post" class="grid-x add">
    <?php echo showErr( $errors ); ?>
     <div class="small-12 medium-3 cell">
         <input type="email" name="Zemail" placeholder="votre email">
     </div>
     <input type="submit" value="Valider" class="button expanded" />
 </form>

<?php 	require_once"footer.php"; ?>
