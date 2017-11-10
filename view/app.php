<?php
require_once "config.php";
require_once "functions.php";
require_once "tabs.php";

// 2017 11 02 - se connecter à la DB
//note le charset pour traiter les carcateres speciaux utf-8 ne fonctionne pas .
//$dsn="mysql:host=localhost; dbname=monsitedejeux; charset=utf8";
//$db=new PDO($dsn,"cplay","Cpassword");
//Pour tester si connexion est bonne - var_dump($AllGames[0]);
// remplacement par :
$dsn = "mysql:host=" . $dbConfig['host'] . ";dbname=" . $dbConfig['name'] . ";charset=utf8";
$db = new PDO( $dsn, $dbConfig['user'], $dbConfig['pass'] );

session_start();
var_dump($_SESSION);
//$isConnected = $_SESSION["auth"];

// note "auth"L20 versus "user"L25 dans ce cadre boolean les 2 parametres sont bons
    if( $page['premium'] && (!isset($_SESSION["auth"]) || !$_SESSION["user"]["premium"] ) ){
        header('Location: premium.php');
        exit();
    }

    if( $page['admin'] && (!isset($_SESSION["user"]) || !$_SESSION["user"]["admin"] ) ){
        echo "Vous devez être admin pour accéder a cette section";
        exit();
    }

// 2017 11 09 cookies

    setcookie ("lang", "fr", time()+365*24*3600,null,null,false,true);
    //print_r ($_COOKIE);

  if ( !isset( $_SESSION["auth"] ) && isset( $_COOKIE["autoauth"] ) ) {
    $keychain=$_COOKIE["autoauth"];
    $userId=explode("____",$keychain)[0];

    $stmt=$db->prepare("SELECT * FROM users WHERE id=?");
    $stmt->bindValue(1, htmlspecialchars($userId));
    $stmt-->execute();
    $user=$stmt->fetch();

    if ($user) {
      $validator=generateCookieKeyChain($user);
      if ($keychain===$validator) {
        login($user);
      }
    }

  } ?>
