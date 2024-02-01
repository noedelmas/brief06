<?php
include("header.php");
include('pdo.php');

$groupConcat = ", GROUP_CONCAT(categorie.nom_cat)"; 
$groupBy = "GROUP BY favoris.id_fav;";

$rqtsql = "SELECT  *" . $groupConcat . " FROM favoris 
INNER JOIN cat_fav    ON favoris.id_fav = cat_fav.id_fav
INNER JOIN categorie  ON categorie.id_cat = cat_fav.id_cat
INNER JOIN domaine    ON domaine.id_dom = favoris.id_dom
WHERE favoris.id_fav =" . $_GET['id_fav'];
$groupBy;

$result = $pdo->query($rqtsql);
$favoris = $result->fetch(PDO::FETCH_ASSOC);

if(!empty($_POST)){
    $id_fav = $favoris['id_fav'];
    $libelle = $_POST['libellule'];
    $url = $_POST['lien'];
    $id_dom = $_POST['dom'];
        $rqtsql="UPDATE favoris
    SET libelle = '".$libelle."',
        url = '".$url."',
        id_dom = ".$id_dom."
    WHERE id_fav = ".$id_fav.";";
    echo $rqtsql;
    $pdo->query($rqtsql);
header("Location:index.php");
}

?>

<form class="flex justify-center" action="" method="post">
        
        <fieldset class="mb-6 mt-12 w-1/12 text-center flex flex-col  justify-center border border-slate p-4 dark:border-indigo-500 border-orange-400">

        <label for="libelle">
            <p class="text-amber-400">Libellé :</p>
        </label>   
    <input value="<?=$favoris["libelle"]?>" class="mb-6" type="text" name="libellule" placeholder="Saisir le libellé :">
             

        <!-- <label for="date_creation">
            <p class="text-amber-400">Date d'ajout :</p>
            <input type="text" placeholder="Saisir la date de création.">
        </label> -->

        <?php 
            $rqtsql = "SELECT * FROM `domaine`;";
            $result = $pdo->query($rqtsql);
            $noms_dom = $result->fetchAll(PDO::FETCH_ASSOC);

        ?>

        <label for="url">
            <p class="text-amber-400">URL :</p>
        </label>
            <input value="<?=$favoris["url"]?>" class="mb-6" name="lien" type="text" placeholder="Saisir le lien :">

            <?php 
            $rqtsql = "SELECT * FROM `domaine`;";

            $result = $pdo->query($rqtsql);
            $noms_dom = $result->fetchAll(PDO::FETCH_ASSOC);
            var_dump($noms_dom);
            ?>

        <label for="nom_dom">
            <p class="text-amber-400">Domaine :</p>
        </label>
        <select class="mb-6" type="text" name="dom" placeholder="Saisir le domaine.">
            <option>Veuillez sélectionner un domaine</option>
                <?php
                foreach($noms_dom as $nom_dom){ 
                    if($nom_dom["id_dom"] == $favoris["id_dom"]){
                        $selection="selected=selected";
                    } else{
                    $selection="";}?>
                    <option <?=$selection?> value="<?=$nom_dom['id_dom']?>"><?php echo $nom_dom['nom_dom'] ?></option>
                <?php } ?>
          
        </select>

            <?php 
                $rqtsql = "SELECT * FROM `categorie`;";

                $result = $pdo->query($rqtsql);
                $noms_cat = $result->fetchAll(PDO::FETCH_ASSOC);

            ?>

                    <label for="nom_cat">
                        <p class="text-amber-400">Catégories :</p>
                    </label>
                    
            <?php
                foreach($noms_cat as $nom_cat){ ?>
                <div class="flex">
                    <input value="<?=$nom_cat['id_cat']?>" name="noms_cat[]" type= "checkbox">
                    <label for=""><?=$nom_cat['nom_cat']?></label>
                </div>
            <?php } ?>

            <button class="dark my-6 px-4 text align-center rounded-md border-4 dark:bg-white bg-slate-500 dark:border-amber-400 border-amber-400 dark:hover:bg-slate-500 hover:bg-slate-500" type="submit">
                Ajouter aux favoris.
            </button>
            
        </fieldset>            
</form>
</body>
</html>