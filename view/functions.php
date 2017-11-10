<?php
//-- function calcul moyenne -->
		function averageNotes($note1,$note2){
			return round(($note1+$note2)/2);
		}

// Plus à jour :
// condition premium-->
//		if(!$premium){
//			header("location:premium.php");
//			exit("Désolé vous n´avez pas l´accès premium");	}

// - function numéros -> type de jeu pour le fichier dameDetails.php -->
// -- Fonction abandonnée avec l utilisation de la BDD -->

		function kindOfGame ($a) {
			switch ($a) {
				case 1: return "horreur";
				break;
				case 2: return "adulte";
				break;
				case 3: return "fantastique";
				break;
				case 4: return "MMORPG";
				break;
				case 5: return "sci-fi";
				break;
				default: return "Un3EfInE3";
				break;
			}
		}

		// function affichage du mini description du tableau $GamePage_Tab vers index_GameList.php -->
		 function shortDescrFront($d){
				 if ((strlen($d))<80) {
					 	echo $d;
				 }else{
			   	echo substr($d, 7, 80)."...";
			 }
		}

// Si erreur Affiche dans une ul, même chose avec success -->

function showErr( $errors ){
if( !empty( $errors ) ){ ?>
		<div class="small-12 cell">
				<div class="callout alert">
						<ul><?php echo $errors; ?></ul>
				</div>
		</div>
 <?php }
}
function showOk( $succeded ){
if( !empty( $succeded ) ){ ?>
		<div class="small-12 cell">
				<div class="callout success">
						<ul><?php echo $succeded; ?></ul>
				</div>
		</div>
 <?php }
}

// DB 3 fonction pour les logs et erreurs-->
	function addLog($message) {
		$Log=fopen("log/".date("Y-m-d").".log","a+");
		fwrite( $Log,date("Y-m-d")."-".$message."\n" );
		fclose($Log);
	}

// 2017 09 11 cookies -->
	 function login($user) {
			$_SESSION["auth"]=true;
			$_SESSION["user"]=$user;

			$keychain=generateCookieKeyChain($user);
			setcookie("autoauth", $keychain, time()+15*24*3600,null,null,false,true );
		}

 function generateCookieKeyChain($user) {
			$kc=$user["id"];
			$kc.="____";
			$kc.=md5($user["username"].$user["email"].$user["password"]);
			return $kc;
	}

	// 2017 09 11 OUblie de mot de passe -->
	 function generateResetToken (){
		return md5( uniqid( rand (), true ) );
	}
