<?php
include("header.php");
include("pdo.php");

$groupConcat = ", GROUP_CONCAT(categorie.nom_cat)"; 
$groupBy = "GROUP BY favoris.id_fav;";

$rqtsql = "SELECT  *" . $groupConcat . " FROM favoris 
INNER JOIN cat_fav    ON favoris.id_fav = cat_fav.id_fav
INNER JOIN categorie  ON categorie.id_cat = cat_fav.id_cat
INNER JOIN domaine    ON domaine.id_dom = favoris.id_dom
WHERE favoris.id_fav =" . $_GET['id_fav'];
$groupBy;
// echo $rqtsql;
$result = $pdo->query($rqtsql);
$favoris = $result->fetch(PDO::FETCH_ASSOC);

?>

<!---------------------------------------------------HTML---------------------------------------------->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="output.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e14b518d69.js" crossorigin="anonymous"></script>
    <title>Single Favori</title>
</head>

<body class="p-6 flex justify-center">

    <section class="justify-center flex flex-col items-center">
        <div class="rounded w-1/3 p-6 flex justify-center text-gray-400 bg-blue-800">
            <h1></strong><?php echo $favoris['libelle'] ?></h1>
        </div>
        <div class="px-6 flex justify-center py-6">
            <ul class="px-6 flex justify-center text-center bg-gray-500 rounded-md">
                <li>
                   <a href="index.php"> 
                        <button class="font-bold bg-blue-500 hover:bg-blue-900 text-white px-4 py-2 rounded h-10 m-14 border
                                 border-gray-300 shadow-lg
                                    fas fa-arrow-left">
                        </button> 
                    </a>
                </li>
                <li class="pt-6 px-6"><strong>Date de création : </strong><?php echo $favoris['date_creation'] ?></li>
                <li class="pt-6 px-12"><strong>URL : </strong><a href="<?php echo $favoris['url'] ?>"> <?php echo $favoris['url'] ?></a></li>
                <li class="pt-6"><strong>Catégorie : </strong><?php echo $favoris['nom_cat'] ?></li>
                <li class="pt-6"><strong>Domaine : </strong><?php echo $favoris['nom_dom'] ?></li>
                

            </ul>

        </div>  
    </section>

</body>
</html>