<?php
include("header.php");
include('pdo.php');

if (!empty($_POST)){
    // AJOUT de favoris
    $libelle = $_POST['libellule'];
    // echo $libelle;
    $url = $_POST['lien'];
    // echo $url;
    $domaine = $_POST['dom'];
    // echo $domaine;
    $date = date("Y-m-d");
    $ids_cat = $_POST['noms_cat'];
    // print_r($ids_cat);
    $sql= " INSERT INTO favoris (libelle, date_creation, url, id_dom) 
            VALUES ('".$libelle."','".$date."','".$url."',".$domaine.")";
    $pdo->query($sql);

    $lastInsertID = $pdo->lastInsertId();
    $id_fav = $lastInsertID;
    foreach($ids_cat as $id_cat){
        $sql= " INSERT INTO cat_fav (id_fav, id_cat) 
                VALUES ('".$id_fav."',".$id_cat.")";
        $pdo->query($sql);
        // echo "hello";
    }

    // requête pour faire l'association entre le favori 44 et la catégorie 3 (donc une boucle pour les catégories sélectionnées.)
    // $sql = "INSERT INTO `cat_fav` (`id_fav`, `id_cat`) VALUES ('".$id_fav."', '".$id_cat."')";

    // echo "ID Favori Nouveau:".$lastInsertID;
}
   

// INSERT INTO `favoris` (`id_fav`, `libelle`, `url`, `id_dom`) VALUES (NULL, 'crash2', 'http://crashtest2.com', '2');
?>
    <!-- Formulaire pour inclure les informations de la nvlle ligne favori. -->
    <form class="flex justify-center" action="" method="post">
        
        <fieldset class="mb-6 mt-12 w-1/12 text-center flex flex-col  justify-center border border-slate p-4 dark:border-indigo-500 border-orange-400">

        <label for="libelle">
            <p class="text-amber-400">Libellé :</p>
        </label>   
    <input class="mb-6" type="text" name="libellule" placeholder="Saisir le libellé :">
             

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
            <input class="mb-6" name="lien" type="text" placeholder="Saisir le lien :">

            <?php 
            $rqtsql = "SELECT * FROM `domaine`;";

            $result = $pdo->query($rqtsql);
            $noms_dom = $result->fetchAll(PDO::FETCH_ASSOC);

            ?>

        <label for="nom_dom">
            <p class="text-amber-400">Domaine :</p>
        </label>
        <select class="mb-6" type="text" name="dom" value ="" placeholder="Saisir le domaine.">
            <option>Veuillez sélectionner un domaine</option>
            <?php
                foreach($noms_dom as $nom_dom){ ?>
                    <option value="<?=$nom_dom['id_dom']?>"><?php echo $nom_dom['nom_dom'] ?></option>
                <?php } ?>
          
        </select>


            <?php 
                $rqtsql = "SELECT * FROM `categorie`;";

                $result = $pdo->query($rqtsql);
                $noms_cat = $result->fetchAll(PDO::FETCH_ASSOC);

            ?>

                    <label for="nom_cat">
                        <p class="text-amber-400">Catégories</p>
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