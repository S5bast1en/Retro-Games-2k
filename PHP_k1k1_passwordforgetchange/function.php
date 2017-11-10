<?php

	function average($a, $b) {

		$c = ($a + $b) / 2; 
		//$c = round($c);
		return $c; 

	}

	function averageArray($array) {
			$totalNote=0;
		foreach ($array as  $value) {
			$totalNote+= $value;
			
		}

		return $totalNote / count($array); 


	}

	function gameType($a) {

		switch ($a) {
			case 0:
				return "Horreur";
				break;
			case 1:
				return "RPG";
				break;
			case 2:
				return "Aventure";
				break;
			case 3: 
				return "Educatif";
				break;
			case 4: 
				return "STR";
				break; 

			
			default:
				# code...
				break;
		}


	}


	function nbDeSec($a) {
			$b=strtotime($a);

			return time()-$b;  



	}

	//<!-- echo strlen(); => donnes la longueur d'une chaîne
	//echo substr(laChaine, début, nombreDeCharacterAretourner); -->


	function returnChar($a) {


		if(strlen($a)>= 40 ) {

			return substr($a, 0, 40);

		}

		 else {

		 	return $a; 
		 }
	}


	function logFile($message) {

		$fileLog=fopen("logFile".date("d-m-Y").".log", 'a+');
		fputs($fileLog, $message); 
		fclose($fileLog); 

	}


	function login($user) {

		$_SESSION['auth']=true;  
		$_SESSION['ip']= $_SERVER['REMOTE_ADDR'];
		$_SESSION['user']= $user; 

		$keychain = generateCookieKeychain($user); 

		setcookie('autoauth', $keychain, time() + 15*24*3600, null, null, false, true); 


	}

	function generateCookieKeychain($user) {

		$kc = $user['id']; 
		$kc .= '____'; 
		$kc .= md5( $user['username'].$user['email'].$user['password']); 


		return $kc; 



	}

	function generateResetToken() {

		return md5(uniqid( rand(), true));

	}


	function checkToken($id, $token) {
		//include("connectPDO.php"); 

		global $bdd; 

		$stmt=$bdd->prepare('SELECT * FROM users WHERE id = ?'); 
	$stmt->bindValue(1, $id); 
	$stmt->execute(); 

	$userInfo=$stmt->fetch(); 

	$time=strtotime($userInfo['reset_expire']); 


	if($userInfo['reset_token']==$token && time() < $time  ) {


		return true; 



	}

	

		return false; 
	




	}

	


	