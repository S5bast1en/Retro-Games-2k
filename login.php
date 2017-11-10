<?php
$page = [
    'title' => 'Se connecter',
    'premium' => false,
    'admin' => false,
];
require_once "view/app.php";

/* Définir une variable vides errors pour afficher les messages. */
$errors = "";

if ( isset( $_POST["loginemail"] ) ) {

  /*Récupère dans la BDD l email utilisateur saisi avec le formulaire de connexion.*/
	$checkMail = $db->prepare('SELECT * FROM users WHERE email = ?');
	$checkMail -> bindValue(1, htmlspecialchars($_POST["loginemail"]) );
	$checkMail -> execute();
  /*Si condition if est TRUE . Stock l´input (table d´1 utilisateur) dans la variable passUser*/
	if ( $passUser = $checkMail ->fetch() ) {

    /*Vérification du MDP avec la fonction password verify. Je mets deux paramètres, le comparant et le comparé. Le comparé étant ce que je récupère de l'input "password", le comparant est la clé hashé du tableau user, qui est en fait le password encodé. La fonction va vérifier que les deux correspondent*/
		if (password_verify( $_POST["loginpwd"], $passUser["password"] ) ){
      //$_SESSION["userConnected"] = true;
      //$_SESSION["user"] = $passUser; Remplacer 2017.11.9 par la function maison
      login($passUser);

			header("location: index_GamesList.php");
		 }else{ $errors .= "<li>Identifiants non reconnus</li>"; }

  }else{ $errors .= "<li>Identifiants non reconnus</li>"; }
}

/*CREA 2017 11 8 Si tout fonctionne, l'utilisateur est maintenant connecté ! */

require_once"header.php"; ?>

 <h2>Connectez vous</h2>

 <form method="post" class="grid-x add">
		<?php echo showErr( $errors ); ?>

     <div class="small-12 medium-3 cell">
         <input type="email" name="loginemail" placeholder="votre mail">
         <input type="password" name="loginpwd" placeholder="Votre mot de passe" />
     </div>

     <input type="submit" value="Valider" class="button expanded" />
 </form>
<div>
  <a href="pwd_Forgotten.php">Si vous avez oublié votre mot de passe</a>
</div>


<?php require_once "footer.php"; ?>
