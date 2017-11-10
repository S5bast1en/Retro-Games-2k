<?php try {

	
//$bdd = new PDO('mysql:host=localhost;dbname=CMM_BDD_TEST;charset=utf8', 'root', 'root');

 //$bdd = new PDO('mysql:host=cmamaisowogiusep.mysql.db;dbname=cmamaisowogiusep;charset=utf8', 'cmamaisowogiusep', 'Fujiwara59');

 $bdd = new PDO("mysql:host=localhost;dbname=TheBestSite;charset=utf8", 'root', 'root');
// host = cmamaisowogiusep.mysql.db
//dbname = cmamaisowogiusep
//user = cmamaisowogiusep
//password = Fujiwara59
// Se connecte à la base de données 

}

// Verifie si il y a des erreurs 
catch (Exception $e)
	{
        die('Erreur : la connexion au serveur PhpMyServer a échoué ' . $e->getMessage());
    }

