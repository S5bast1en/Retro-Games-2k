<?php 


include("connectPDO.php"); 


$req=$bdd->prepare('INSERT INTO games (name, visual, description, release_date, press_note, player_note, editor_id, developer_id, type_id ) VALUES(:name, :visual, :description, :release_date, :press_note, :player_note, :editor_id, :developer_id, :type_id)');


$req->bindValue(':name', $_POST['name'],PDO::PARAM_STR); 
$req->bindValue(':visual', $_POST['visual'],PDO::PARAM_STR); 
$req->bindValue(':description', $_POST['description'],PDO::PARAM_STR); 
$req->bindValue(':release_date', $_POST['date'],PDO::PARAM_INT);
$req->bindValue(':press_note', $_POST['pressNote'],PDO::PARAM_INT); 
$req->bindValue(':player_note', $_POST['playerNote'],PDO::PARAM_INT); 
$req->bindValue(':editor_id', $_POST['editor'],PDO::PARAM_INT); 
$req->bindValue(':developer_id', $_POST['developer'],PDO::PARAM_INT); 
$req->bindValue(':type_id', $_POST['type'],PDO::PARAM_INT);

//var_dump($req); 
if($req->execute()){

	echo "Good job ! Jeu ajouté.";
} 


// if($req->execute()) {

// 	echo "Le jeu a bien été rajouté.";
// 	//$bdd->lastInsertId(); 
// }

?>