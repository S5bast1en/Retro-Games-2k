<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 



include("function.php"); 
			$isConnected = false; 
			$isPremium = true; 

if(!isset($_COOKIE['lang'])) {

	setcookie('lang', 'fr', time() + 365*24*60*60, null, null, false, true); 

}
// vérification COOKIE pour connection auto 
if(!isset($_COOKIE['auth']) && isset( $_COOKIE['autoauth'])) {

	$keychain = $_COOKIE['autoauth']; 
	$userId = explode( '____', $keychain)[0];
	include("connectPDO.php"); 

	$stmt=$bdd->prepare('SELECT * FROM users WHERE id = ?'); 
	$stmt->bindValue(1, $userId);  
	$stmt->execute(); 
	$user = $stmt->fetch(); 

	if($user) {


		$validator = generateCookieKeychain($user); 

		if( $keychain === $validator) {

			$_SESSION['auth']=true;  
			$_SESSION['ip']= $_SERVER['REMOTE_ADDR'];
			$_SESSION['user']= $user; 

			$keychain = generateCookieKeychain($user); 

			setcookie('autoauth', $keychain, time() + 15*24*3600, null, null, false, true); 
		}
	}
}

	
// vérification session utilisateur

if(isset($_SESSION['auth'])) {
	if($_SESSION['auth']==true && $_SERVER['REMOTE_ADDR']==$_SESSION['ip']) {

		// echo "bravo, vous êtes bien connecté !!";
		$sessionConnected=true; 
	}

	else {
		session_destroy(); 
		$sessionConnected=false; 
		// echo "Vous n'êtes pas connecté."; 
	}
}

else {
	$sessionConnected=false; 


}




			$communityNoteArray = [16, 15, 13, 17, 16, 19]; 


			$games = [

				[			"name" => "The Legend Of Zelda",
							"visual" => "https://i.ytimg.com/vi/gXrKT4io8BE/maxresdefault.jpg",
							"link" => "detail.php",
							"kind" => 2,
							"editeur" =>	"Nintendo",
							"developpeur" =>	"Nintendo",
							"date_de_sortie" =>	"22 october 2014",
							"note_presse" =>	"19",
							"note_joueur" =>	"18",
							"description" => "Vivez l'aventure de Link, La Princesse Zelda (ゼルダ姫, Zeruda-hime?) est un personnage de la série The Legend of Zelda créée par Shigeru Miyamoto le 21 février 1986, qui a choisi ce nom en référence à la romancière Zelda Fitzgerald1. Elle fait partie de la famille royale d’Hyrule, étant très souvent la fille ou descendante du roi en place (Daltus, Roham, Daphnès…).

Du fait du titre de la série, The Legend of Zelda, Zelda est parfois confondue avec Link, le héros du jeu."

				],

				[			"name" => "Warcraft 3",
							"visual" => "http://image.jeuxvideo.com/images-md/pc/w/c/wcf3pc0a.jpg",
							"link" => "detail.php",
							"kind" => 4,
							"editeur" =>	"Blizzard",
							"developpeur" =>	"Blizzard",
							"date_de_sortie" =>	"15 july 2004",
							"note_presse" =>	"18",
							"note_joueur" =>	"16",
							"description" => "Plongez dans le monde d'Azeroth"
				],

				[			"name" => "Adibou 2",
							"visual" => "http://adibou.fr/images/adibou2.jpg",
							"link" => "detail.php",
							"kind" => 3,
							"editeur" =>	"Activision",
							"developpeur" =>	"Activision",
							"date_de_sortie" =>	"1 December 2001",
							"note_presse" =>	"14",
							"note_joueur" =>	"15",
							"description" => "Faites des gâteaux avec Adibou dans le 2ème volet de cette franchise légendaire"
				],

				[			"name" => "Starcraft 2",
							"visual" => "img/sc2.jpg",
							"link" => "detail.php",
							"kind" => 4,
							"editeur" =>	"Blizzard Activision",
							"developpeur" =>	"Blizzard",
							"date_de_sortie" =>	"27 July 2010",
							"note_presse" =>	"19",
							"note_joueur" =>	"19",
							"description" => "Le meilleur STR de l'univers entier"
				]






			];


			$test="coucou";

				$game = [

			"nom" => "The Legend Of Zelda",
			"visuel" => "https://i.ytimg.com/vi/gXrKT4io8BE/maxresdefault.jpg",
			"description" => "Vivez l'aventure de Link",
			"editeur" =>	"Nintendo",
			"developpeur" =>	"Nintendo",
			"genre" =>	2,
			"date_de_sortie" =>	"2014",
			"note_presse" =>	"19",
			"note_joueur" =>	"18",




			];


			// $moyenneNote = ($game["note_presse"]+$game["note_joueur"])/2;	

			$moyenneNote = average($game["note_presse"], $game["note_joueur"]); 

			

			$smileyNote; 

			switch (round($moyenneNote)) {
				case 0:
					
					;
				case 1:
					
					;
				case 2:
					
					;
				case 3:
					
					;
				case 4:
					
					;	
				case 5:
				
					$smileyNote= ":(";
					break;
				case 6:
					
					;
				case 7:
					
					;
				case 8:
					
					;
				case 9:
					
					;
				case 10:
					$smileyNote= ":/";
					break;

				case 11:
					
					;
				case 12:
					
					;
				case 13:
					
					;
				case 14:
					
					;
				case 15:
					$smileyNote= ":)";
					break;
				case 16:
					
				;
				case 17:
					
					;
				case 18:
					
					;
				case 19:
					
					;
				case 20:
					$smileyNote= ":D";
					break;

				
				
			} 

