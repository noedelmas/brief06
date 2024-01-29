<?php
include("pdo.php");


$rqtsql = "DELETE FROM favoris 
WHERE id_fav = ".$_GET['id_fav'];

$pdo->query($rqtsql);

header('Location: index.php');

?>