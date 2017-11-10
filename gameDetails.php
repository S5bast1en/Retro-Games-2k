<?php
$page = [
    'title' => 'Jeu détail',
    'premium' => false,
    'admin' => false,
];
require_once "view/app.php";

		 if(isset($_GET["indexGamesListTab"])) {
			$stmt=$db->prepare("SELECT *, games.name AS gname, games.id AS gid FROM games LEFT JOIN games_type ON games.type_id=games_type.id LEFT JOIN editor ON games.editor_id=editor.id LEFT JOIN developer ON games.developer_id=developer.id WHERE games.id=?");
			$stmt->bindValue(1, $_GET["indexGamesListTab"], PDO::PARAM_INT);
			$stmt->execute();
			$GamePage_Tab = $stmt->fetch();
			}else{
				header("Location:index_GamesList.php");
			exit;
		}

require_once "header.php";
?>

		<a href="contest.php">the Contest</a>
		<?php if ($GamePage_Tab["name"]=="Horreur"){?> <h1>warning : jeu d´horreur </h1>
		<?php }elseif($GamePage_Tab["name"]=="Adulte"){?> <h1>warning : jeu pour adulte</h1>
		<?php } ?>


		<h1><?php echo strtoupper($GamePage_Tab["gname"])?></h1>
		<div class=pict><img src="<?php echo $GamePage_Tab["picture"]?>" /></div>
		<div class=descGame>Description :<br/><?php echo $GamePage_Tab["description"]; ?></div>
		<div class=devGame>Developpeur : <?php echo $GamePage_Tab["developer_name"]; ?></div>
		<div class=editGame>Editeur : <?php echo $GamePage_Tab["editor_name"]; ?></div>

		<div class=sortGame>
			Genre: <?php echo $GamePage_Tab["name"];?>
		</div>

		<div class=outDateGame><br/>Date de sortie: <?php echo $GamePage_Tab["release_date"]; ?></div>
		<div class=outDateGame>Nbr de secondes depuis 1970 à date_sortie: <?php echo strtotime($GamePage_Tab["release_date"]);  ?></div>
		<div class=outDateGame>Nbr secondes a aujourd´hui: <?php echo time(); ?></div>
		<div class=outDateGame>Nbr de secondes de date_sortie à aujourd´hui: <?php echo (time()-strtotime($GamePage_Tab["release_date"]));  ?></div>
		<div class=outDateGame>Date: <?php $z=date("d/m/Y,H:i:s", time()-strtotime($GamePage_Tab["release_date"])); echo $z; ?>
		</div>

		<div class=pressNote>Note Presse: <?php echo $GamePage_Tab["press_note"]; ?></div>
		<div class=userNote>Note Joueurs: <?php echo $GamePage_Tab["player_note"]; ?></div>

		<div class=averNote>Moyenne des notes: <?php echo $average=averageNotes($GamePage_Tab["press_note"],$GamePage_Tab["player_note"]); ?>
<!-- Note : changement du parametre switch de $MoyenneNote par $average cf l34 cf functions.php fonction averageNotes-->
				<?php switch($average) {
					case 1:
					case 2:
					case 3:
					case 4:
					case 5:
					case 6:
					case 7:
					case 8:
					case 9:?> &nbsp;<i class="fa fa-thumbs-down" aria-hidden="true"></i>&nbsp;&nbsp;<i class="fa fa-frown-o" aria-hidden="true"></i>
					<?php break;
					case 10:?> &nbsp;<i class="fa fa-thumbs-up" aria-hidden="true"></i>&nbsp;&nbsp;<i class="fa fa-meh-o" aria-hidden="true"></i>
					<?php break;
					case 11:
					case 12:
					case 13:
					case 14:
					case 15:
					case 16:
					case 17:
					case 18:
					case 19:
					case 20:?> &nbsp;<i class="fa fa-thumbs-up" aria-hidden="true"></i>&nbsp;&nbsp;<i class="fa fa-smile-o" aria-hidden="true"></i>
					<?php
					default:
					break;
				}?>
		</div>

		<br/>

		<form method="POST">
			<label for="commentsForm">Commentaires: </label>
			<textarea id="commentsForm" name="ZcommentsForm"  placeholder="Ecrire votre commentaire" rows="10" cols="80"></textarea>
			<input type="submit" value="Envoyez!"/>
		</form>

		<?php
		if ( !empty($_POST["ZcommentsForm"])) {
		    $query="INSERT INTO comment (content, user_id, game_id, comment_date) VALUES (:content, :user_id, :game_id, NOW())";
		    $stmt=$db->prepare($query);
		    $stmt->bindValue("content",$_POST["ZcommentsForm"]);
		    $stmt->bindValue("user_id",3);
				$stmt->bindValue("game_id",$GamePage_Tab["gid"]);

		    if ($stmt->execute()) {
		     echo "Votre commentaire a été posté.";
		    }
		}?>
<br/> <br/>Les Post   :
	<?php
		$stmt=$db->prepare("SELECT * FROM comment LEFT JOIN users ON comment.user_id=users.id WHERE comment.game_id=?"); //A ajouter un ORDER BY published at DESC
		$stmt->bindValue(1, $_GET["indexGamesListTab"]);
		$stmt->execute();
		$allCommentsOfThisGame = $stmt->fetchAll();
		?> <br/><?php
		foreach($allCommentsOfThisGame as $key=>$playerComment) { ?>
			<?php echo $playerComment["comment_date"]; ?>
			Commentaire du joueur <?php echo $playerComment["user_id"];?> / <?php echo $playerComment["email"] ;?> :<br/><?php echo $playerComment["content"]; ?>
			<br/><br/><?php
		}
	?>


<?php require_once"footer.php"; ?>
