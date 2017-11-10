<?php require_once"header.php"; ?>



<br/><br/>
<form method="POST" enctype="multipart/form-data">

      <label for="nameGame">Nom du jeu :</label>
      <input type="text" id="nameGame" name="ZnameGame" placeholder="Ecrire le nom du jeu"/>
      <br/>

      <label for="pict">Chemin de l´image: </label>
      <input type="text" id="pict" name="Zpict" placeholder="Chemin de l´image"/>
      <br/>
      <label for="uploadIT">ou télécharger l image: </label>
      <input type="file" id="uploadIT" name="Zuploadfile" />
      <br/>

      <label for="editorName">Developpeur: </label>
      <select id="editorName" name="ZeditorName">
        <?php
          $stmt= $db->query("SELECT * FROM editor");
            while ($editor=$stmt->fetch()) {?>
              <option value="<?php echo $editor["id"];?>"> <?php echo $editor["editor_name"];?>
              </option><?php
          }?>
      </select>
      <br/>
      <label for="developerName">Developpeur: </label>
      <select id="developerName" name="ZdeveloperName">
        <?php
          $stmt= $db->query("SELECT * FROM developer");
            while ($developer=$stmt->fetch()) {?>
              <option value="<?php echo $developer["id"];?>"> <?php echo $developer["developer_name"];?></option><?php
          }?>
      </select>
      <br/>

      <label for="descrGame">Description: </label>
      <textarea id="descrGame" name="ZdescrGame"  placeholder="Ecrire la description du jeu" rows="10" cols="150"></textarea>
      <br/>

      <label for="kindOf">Genre: </label>
      <select id="kindOf" name="ZkindOf">
        <?php
          $stmt= $db->query("SELECT * FROM games_type");
            while ($game_kind=$stmt->fetch()) {?>
              <option value="<?php echo $game_kind["id"];?>"> <?php echo $game_kind["name"];?></option><?php
          }?>
      </select>
      <br/>

      <label for="releaseDate">Date de sortie: </label>
      <input type="date" id="releaseDate" name="ZreleaseDate" placeholder="Ecrivez la date format Y-m-d"/>
      <br/>

      <label for="pressNote">Note du site web </label>
      <input type="text" id="pressNote" name="ZpressNote" placeholder="Ecrire une note de part le site web"/>
      <br/>
      <label for="userNote">Note de l´utilisateur </label>
      <input type="text" id="userNote" name="ZuserNote" placeholder="Ecrire une note utilisateur"/>
      <br/>

      <input type="submit" value="Envoyez!"/>
</form>
<br/><br/><br/><br/><br/>

<?php
    //echo "L67"; var_dump($_POST["Zuploadfile"]);
    if ( !empty($_POST["ZnameGame"]) && !empty($_POST["Zpict"])
        && !empty($_POST["ZeditorName"]) && !empty($_POST["ZdeveloperName"])
        && !empty($_POST["ZdescrGame"]) && !empty($_POST["ZkindOf"])
        && !empty($_POST["ZpressNote"]) && !empty($_POST["ZuserNote"]) ) {
        $query="INSERT INTO games (name, picture, type_id, editor_id, developer_id, description, release_date, press_note, player_note)
                VALUES (:name, :picture, :type_id, :editor_id, :developer_id, :description, :release_date, :press_note, :player_note )";
        $stmt=$db->prepare($query);
        $stmt->bindValue("name",htmlspecialchars($_POST["ZnameGame"]));

        $pictContentRetriev=file_get_contents($_POST["Zpict"]);
        $ext=pathinfo($_POST["Zpict"],PATHINFO_EXTENSION);

        $path="img/".uniqid("file_",true).".".$ext;
        file_put_contents($path,$pictContentRetriev);
        $stmt->bindValue("picture",$path);


        $stmt->bindValue("type_id",htmlspecialchars($_POST["ZkindOf"]));
        $stmt->bindValue("editor_id",htmlspecialchars($_POST["ZeditorName"]));
        $stmt->bindValue("developer_id",htmlspecialchars($_POST["ZdeveloperName"]));
        $stmt->bindValue("description",htmlspecialchars($_POST["ZdescrGame"]));
        $stmt->bindValue("release_date",htmlspecialchars($_POST["ZreleaseDate"]));
        $stmt->bindValue("press_note",htmlspecialchars($_POST["ZpressNote"]));
        $stmt->bindValue("player_note",htmlspecialchars($_POST["ZuserNote"]));

        if ($stmt->execute()) {
          echo "ID du jeu inséré: ".$db->lastInsertId();
      //DB3 - les 2 exos game logs
      //$gameLog=fopen("log/logs.txt","a+"); // note ./log/ ou log/

      //    $gameLog=fopen("log/".date("D, d M Y")."logRotate","a+"); // meme chose que la ligne114 mais repond a l´exo logrotate
      //    fwrite( $gameLog,"nom du jeu enregistré: ".$_POST["ZnameGame"].date("d/m/Y")."\n" );
      //    fclose($gameLog); Remplace par : DB3 - essai de gerer les erreurs ajout de la fonction :
            addLog("Ajout de jeu". htmlspecialchars($_POST["ZnameGame"]) );

      //DB3 - affiche sur la page web hors sujet de l exo logs
          echo "<br/> Nom du jeu enregistré: <br/>";
          echo $_POST["ZnameGame"]."<br/>";
          echo file_put_contents($path,$pictContentRetriev)."<br/>";
          echo $_POST["ZkindOf"]."<br/>";

        } else {
          $errors .="une erreur est survenu";
          addLog("Erreur lors de l insertion d un jeu en DB");
        }
    }

?>




<?php 	require_once"footer.php"; ?>
