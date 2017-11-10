<!-- EXo Cretion P.inscription 2017. | ce Code aété remplacé, partie pwd est correct.
if ( !empty($_POST["ZuserName"]) && !empty($_POST["ZuserPwd"]) && !empty($_POST["ZuserPwdRewrite"]) && !empty($_POST["ZuserEmail"]) ) {
    $query="INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
    $stmt=$db->prepare($query);
    $stmt->bindValue("username",htmlspecialchars($_POST["ZuserName"]) );
    $stmt->bindValue("email",htmlspecialchars($_POST["ZuserEmail"]) );

    $pwdLenght=strlen($_POST["ZuserPwd"]) ;
    if ( $pwdLenght >=8 ) {
      if ( is_numeric($_POST["ZuserPwd"]) === false ) {
          if ($_POST["ZuserPwd"] == $_POST["ZuserPwdRewrite"]) {
              $password=$_POST["ZuserPwd"];
              $hash=password_hash($password, PASSWORD_DEFAULT);
              $stmt->bindValue("password",$hash);
              $stmt->execute();
              echo $succeded.="Merci votre création de compte est enregistrée avec le login:".$_POST["ZuserName"];
          } else { echo $error.= "Les mots de passe saisis ne sont pas les mêmes";  }
        } else {echo $error.= "Le mot de passe doit être une composition de chiffres et de lettres"; }
    } else { echo $error.= "Ecrivez un mot de passe avec au minimum de 8 caractères"; }
}
CREA 2017.11.8-->
<?php
$page = [
    'title' => 'S´inscrire',
    'premium' => false,
    'admin' => false,
];
require_once "view/app.php";


  $errors="";
  $succeded="";

    /*ISSET , vérifie que le formulaire a déjà été ENVOYÉ pour ne pas envoyer de messages d'erreurs à l'utilisateur qui arrive sur la page pour la première fois*/
    if (isset( $_POST['Zusername'] ) ){
    /*Vérifications d'input en input.*/

      // si l'username est pas rempli
    	if( empty( $_POST['Zusername']) ){$errors .= "<li>Saisir un nom</li>"; }

      // si l'username fait moins de 4 caractères
      if( strlen( $_POST['Zusername']) <4 ){$errors .= "<li>Le nom doit comporter plus de 4 caractères</li>"; }

      // Si l´email n´est pas rempli
      if( empty( $_POST['Zemail']) ){$errors .= "<li>Saisir un email</li>"; }

      // La fonction vérifie si c'est un mail. Si faux, envoi une erreur.
    	if( filter_var($_POST['Zemail'], FILTER_VALIDATE_EMAIL) === false) {$errors .= "<li>Saisir un format d´email valide</li>"; }

      /*EMAIL : Recherche dans la BDD 1 email grâce à 1 paramètre. */
    	$stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    	$stmt -> bindValue(1, $_POST["Zemail"]);
    	$stmt -> execute();
      //Si la condition est TRUE ALORS 1 email identique se trouve ds la BDD - envoi une erreur email est utilisé
    	if ( $stmt -> fetch() ) {$errors .="<li>Cet adresse email est déjà utilisé</li>"; }

      /*MDP control checking: */
      //Si MDP vide
    	if( empty( $_POST['Zpwd']) ){$errors .= "<li>Saisir un mot de passe</li>"; }

      //Si  les 2 MDP ne sont pas les mêmes
    	if ( $_POST['Zpwd'] !== $_POST['Zcheckpwd'] ){ $errors .= "<li>Les mots de passe doivent être identiques</li>";}

      //is_numeric, vérifie si le MDP contient que des chiffres. Si TRUE alors envoi une erreur.
    	if (is_numeric($_POST['Zpwd']) ){ $errors .= "<li>Saisir des lettres à votre mot de passe </li>" ; }

      //Si le MDP est trop court
    	if (strlen($_POST['Zpwd']) <8 ){ $errors .= "<li>Le mot de passe comporte au minimum 8 caractères</li>"; }

      /*	Ajout du compte dans la BDD */
      //La variable errors contenant le message d´errors est vide, alors ajout utilisateur dans la BDD
    	if (empty( $errors ) ) {
    		$query = 'INSERT INTO users (username, email, password) VALUES ( :username, :email, :password)';
    		$stmt = $db->prepare( $query );
    		$stmt->bindValue('username', htmlspecialchars( $_POST['Zusername'] ) );
    		$stmt->bindValue('email', htmlspecialchars( $_POST['Zemail'] ) );
    		//La fonction password_hash, le MDP est envoyé sous forme de clé encodé dans le tableau
    		$stmt->bindValue('password', password_hash( $_POST['Zpwd'], PASSWORD_DEFAULT ) );

    /*Avec la condition suivante, si l'inscription dans la BDD s'est bien déroulé, j'envoi un message, et j'envoi une erreur si c'est pas le cas. */
    		if ( $stmt ->execute() ) { $succeded.= "Bienvenu ".$_POST['Zusername']."!";
    		}else{ $errors .= "<li>Erreur dans l'inscription</li>";
    		//var_dump($stmt->errorInfo());
    		}
    	}
    }
require_once"header.php"; ?>

<!-- Le formulaire.HTML  -->

 <form method="post" class="grid-x add">
    <div class="small-12 medium-12 cell">
        <h1> Page d´inscription </h1>
        <?php echo showErr( $errors ); ?>
        <h1><?php echo showOk( $succeded ); ?></h1>
    </div>
     <div class="small-12 medium-2 cell">
         <input type="text" name="Zusername" placeholder="Votre nom" />
         <input type="text" name="Zemail" placeholder="Votre mail">
         <input type="password" name="Zpwd" placeholder="Votre mot de passe" />
         <input type="password" name="Zcheckpwd" placeholder="Confirmez votre M.D.P.">
         <input type="submit" value="Valider" class="button expanded" />
     </div>
     <!-- Note la position si placé ici:<input type="submit" value="Valider" class="button expanded" /> -->
 </form>

<?php 	require_once"footer.php"; ?>
