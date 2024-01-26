<?php

    // On récupère les constantes de connexion définis dans connect.php
    require("connect.php");

    // On prépare la connexion à la base de données.
    $dsn="mysql:dbname=".BASE.";host=".SERVER;

    // On vérifie si nous ne rencontrons pas d'erreur lors de la connexion.
    try{
        // Connexion à la bdd.
        $pdo = new PDO($dsn,USER,PASSWD, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

    } catch(PDOException $e){
        echo "Échec de connexion : %s/n" .$e->getMEssage();
        exit();
    }
    // echo"Connexion réussie";

?>