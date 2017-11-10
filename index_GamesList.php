<?php
$page = [
    'title' => 'Bibliothèque',
    'premium' => false,
    'admin' => false,
];
require_once "view/app.php";

	$stmt=$db->query("SELECT *, games.name AS gname, games.id AS gid FROM games LEFT JOIN games_type ON games.type_id=games_type.id");
	$AllGames=$stmt->fetchAll();

require_once "header.php";
?>

		<h1><?php echo "TOP ".count($AllGames)." des jeux";?></h1>
		<h1>arcade - fin années 80 - Jeux de role  </h1>

		<div class="searchengine">
			<form method="GET">
				<label for="searchEngine">Recherche </label>
				<input type="search" id="searchEngine" name="ZsearchEngine" placeholder="Ecrivez le mot clef de recherche"/>
				<input type="submit" value="Recherchez!"/>
			</form>
		</div>


	   <div class="containerCentral">
			<div class="row">
						<?php foreach($AllGames AS $key=>$GameList_Tab) {

							if (!empty($_GET["ZsearchEngine"]) && stripos ($GameList_Tab["gname"],$_GET["ZsearchEngine"])===false) {
								continue;
							} ?>
							<div class="col-xs-12 col-sm-6 col-md-4">
									<h2 ><?php echo strtoupper($GameList_Tab["gname"]);?></h2>
									<img src="<?php echo $GameList_Tab["picture"];?>"/>
									<p><?php echo $GameList_Tab["name"];?></p>
									<p><?php echo shortDescrFront($GameList_Tab["description"]);?></p>
									<?php var_dump($GameList_Tab["gid"])?>
									<p><a class="btn btn-default btn-lg" href="gameDetails.php?indexGamesListTab=<?php echo $GameList_Tab["gid"]; ?>" role="button">+2 détails &RuleDelayed;</a></p>
							</div>
					<?php } ?>
    	</div>
		</div>

		<br/><br/><br/>

		<div class="gametotalnb">
			<?php
			if(count($AllGames)==0) {
				echo "Il n´y a aucun jeu sur le site! ";
			}	else {
				echo "Nombre de jeux du site : ".count($AllGames);
			}
			?>
 		</div>


<?php 	require_once"footer.php"; ?>
