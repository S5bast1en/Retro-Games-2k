<?php 

session_start(); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 




				
	include("connectPDO.php"); 


	$query='SELECT *, games.id AS gID FROM games LEFT JOIN games_type ON games.type_id = games_type.id';

	if( !empty( $_GET['search'])) {

		$reponse=$bdd->prepare("SELECT *, games.id AS gID FROM games LEFT JOIN games_type ON games.type_id = games_type.id WHERE games.name LIKE CONCAT('%', ?, '%')");
		$reponse->bindValue(1, $_GET['search']); 
		$reponse->execute(); 
	}

	else {

		$reponse=$bdd->query('SELECT *, games.id AS gID FROM games LEFT JOIN games_type ON games.type_id = games_type.id');

	}



	

	//$games = $stmt->fetchAll() 
		//a utiliser avec 

		//foreach($games as $game) et travaillé avec le game 

	$count=$reponse->rowCount();

			 
			//include ("function.php"); ?
			  include("globalPhp.php"); 
			 include("headType.php"); 
			include("navBarType.php"); 
?>
		<!-- $personnes = array(
		1 => array('prenom' => 'Jessy', 'nom' => 'Brown', 'telephone' => '00001111'),
		2 => array('prenom' => 'Sharon', 'nom' => 'Dain', 'telephone' => '00221111'),
		3 => array('prenom' => 'Marta', 'nom' => 'Blanca', 'telephone' => '003311111')
		); -->


	<form method="get" action="liste.php">
		<label for="search">Recherche :</label>
		<input type="search" name="search" placeholder="Votre recherche..">

	</form>
	<div class="myCar owl-carousel">
	<?php 

		
	$verif=0;

	while ($game=$reponse->fetch()) {
		//var_dump($game['gID']); 
		// foreach ($games as $key => $game  ) {

			// $pos= stripos($game["name"], $_GET["search"]);
			// var_dump($pos); 
			// var_dump($game["name"]); 
			// var_dump($_GET["search"]); 
			
			 //if(isset($_GET["search"]) && stripos($game["name"], $_GET["search"]) === false ) { 
			 	// $verif++; 
			 		//continue; 
			//}
			$verif++;
			?>

			<div class=" contList">
				<div class="list">
					<div class="">
						<img src="<?php echo $game["visual"];?>"/>
					</div>
				 	<ul>

				 	
				 	<li><h2><?php echo $game["name"] ; ?></h2></li>
				 	
				 	<li><a href="<?php echo "detail.php?numGame=".$game['gID']."" ; ?>">Lien</a></li>
				 	<li><?php echo $game["genre"] ; ?></li>



				 	 </ul>
				</div>
			</div>
					
			<?php 
				
			  
			}
	
			$reponse->closeCursor(); 
		

		?>
		</div>
		<div class="infoGame" data-verif="<?php echo $verif ;?>"> 
		<?php 

		if(count($count)==0) {

			echo "Vous n'avez aucun jeu ! "; 
		}


		else {

			echo "Nombre de jeux : ".$count; 
		}
		?> <br/>
		
	    </div>
			
	


			

	
<?php include("footerType.php"); ?>

