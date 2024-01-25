    <!-- Inclusion du header et du pdo via la fonction include.php afin d'afficher le <h1> "Mes favoris". -->
<?php
include("header.php");
include("pdo.php");

?>

        <!-- Création de la section 'filtre_domaine' afin  de pouvoir les filtrer par la suite. -->
    <section class="filtre_domaine flex justify-center">
        <form action="" method="GET">
                <input class="rounded-md bg-slate-500" name="search_bar" type="search">
                <!-- Déclaration du nom : 'filtre_dom' puis création du résultat selon le domaine sur lequel on clique. -->
            <select name="filtre_dom" class="my-8 rounded-md border-4 border-sky-500 hover:bg-slate-500">
                <option value="aucun">-Tous les domaines-</option>
            <?php            
                $result = $pdo->query("SELECT * FROM domaine");
                $domaine = $result->fetchAll(PDO::FETCH_ASSOC); 
                    foreach($domaine as $un_domaine){
            ?>

                    <!-- Création d'une option afin de faire comprendre à la machine qu'il faut afficher le domaine par rapport à l'id. -->
                    <option value="<?php echo $un_domaine['id_dom']?>"><?php echo $un_domaine['nom_dom']?></option>
                <?php
                    }
                ?>

                    <!-- Création d'une selection par catégorie -->
            </select>
                <select name="filtre_cat" class="my-8 rounded-md border-4 border-sky-500 hover:bg-slate-500">
                    <option value="aucun">-Toutes catégories-</option>
                    <?php
                      
                        $result = $pdo->query("SELECT * FROM categorie");
                        $categorie = $result->fetchAll(PDO::FETCH_ASSOC); 
                        $selection = "";
                        foreach($categorie as $une_cat){
                            if (!empty($_GET['filtre_cat'])){
                                if($_GET['filtre_cat'] == $une_cat['id_cat'] ){
                                    $selection = "selected='selected' ";
                                }else{
                                    $selection ="";
                                }
                        }
                    ?>

                            <!-- Déclaration d'une option pour chaque catégorie. -->
                <option <?php echo $selection ?> value="<?php echo $une_cat['id_cat']?>"><?php echo $une_cat['nom_cat']?></option>
                <?php
                }
                ?>
                </select>
                
            <select class="my-4 text align-center rouned-md border-4 border-orange-500 hover:bg-slate-500" name="Limite" id="">
                <option value="tout">-Tous-</option>
                <option value="1">1</option>
                <option value="10">10</option>
                <option value="30">30</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
                
                <!-- Création/décla d'un bouton afin de soumettre son résultat pour ensuite éxécuter l'affichage. -->
            <button class="my-4 text align-center rouned-md border-4 border-orange-500 hover:bg-slate-500" type="submit">
                Appliquer
            </button>

                <!-- Fermeture du bloc formulaire. -->
        </form>
    </section>

                <!-- Déclaration de la condition, si le 'filtre_dom' est défini alors la requête sql sélectionne l'id correspondant, l'affiche dans l'url et sur la page en cours. -->
            <?php 
                if (!empty($_GET['filtre_dom']) || !empty($_GET['filtre_cat'])){
                    print_r($_GET['filtre_dom']);
                    if ($_GET['filtre_dom'] == "aucun" && $_GET['filtre_cat'] != "aucun"){
                        $rqtsql="SELECT domaine.nom_dom, libelle, date_creation, GROUP_CONCAT(nom_cat SEPARATOR ' | ') as 'liste_cat', url FROM favori 
                        INNER JOIN domaine ON favori.id_dom = domaine.id_dom
                        INNER JOIN cat_fav ON favori.id_fav = cat_fav.id_fav
                        INNER JOIN categorie ON categorie.id_cat = cat_fav.id_cat

                        WHERE categorie.id_cat = ".$_GET['filtre_cat'];


                    }else{
                        if($_GET['filtre_cat'] == "aucun" && $_GET['filtre_dom'] != "aucun"){
                            $rqtsql="SELECT  domaine.nom_dom, libelle, date_creation, GROUP_CONCAT(nom_cat SEPARATOR ' | ') as 'liste_cat', url FROM favori 
                            INNER JOIN domaine ON favori.id_dom = domaine.id_dom
                            INNER JOIN cat_fav ON favori.id_fav = cat_fav.id_fav
                            INNER JOIN categorie ON categorie.id_cat = cat_fav.id_cat
                            
                            WHERE domaine.id_dom =".$_GET['filtre_dom'];

                        }else{

                            $rqtsql="SELECT  domaine.nom_dom, libelle, date_creation, GROUP_CONCAT(nom_cat SEPARATOR ' | ') as 'liste_cat', url FROM favori 
                                        INNER JOIN domaine ON favori.id_dom = domaine.id_dom
                                        INNER JOIN cat_fav ON favori.id_fav = cat_fav.id_fav
                                        INNER JOIN categorie ON categorie.id_cat = cat_fav.id_cat
                                        
                                        WHERE domaine.id_dom =".$_GET['filtre_dom']." AND categorie.id_cat = ".$_GET['filtre_cat'];



                        }
                    }
                        /*$rqtsql="SELECT  domaine.nom_dom, libelle, date_creation, GROUP_CONCAT(nom_cat SEPARATOR ' | ') as 'liste_cat', url FROM favori 
                                        INNER JOIN domaine ON favori.id_dom = domaine.id_dom
                                        INNER JOIN cat_fav ON favori.id_fav = cat_fav.id_fav
                                        INNER JOIN categorie ON categorie.id_cat = cat_fav.id_cat
                                        
                                        WHERE domaine.id_dom =".$_GET['filtre_dom']." AND categorie.id_cat = ".$_GET['filtre_cat'].
                                        " GROUP BY favori.id_fav ";*/
                    
                
                    // $result = $pdo->query"SELECT * FROM `favoris` 
                    // INNER JOIN `domaine` ON favoris.id_dom = domaine.id_dom
                    // INNER JOIN `cat_fav` ON favoris.id_fav = cat_fav.id_fav 
                    // INNER JOIN `categorie` ON categorie.id_cat = cat_fav.id_cat
                    // WHERE favoris.id_fav=".$_GET['favori'].";";
                    // $favoris = $result->fetchAll(PDO::FETCH_ASSOC); 
                
                }else{ 
                    $rqtsql = "SELECT domaine.nom_dom, libelle, date_creation, GROUP_CONCAT(nom_cat SEPARATOR ' | ') as 'liste_cat', url  FROM favori  
                    INNER JOIN domaine ON favori.id_dom = domaine.id_dom 
                    INNER JOIN cat_fav ON favori.id_fav = cat_fav.id_fav 
                    INNER JOIN categorie ON categorie.id_cat = cat_fav.id_cat";
                   
                    // echo "on";
                }
                if (!empty($_GET['search_bar'])){
                     $rqtsql = "SELECT domaine.nom_dom, libelle, date_creation, GROUP_CONCAT(nom_cat SEPARATOR ' | ') as 'liste_cat', url  FROM favori  
                    INNER JOIN domaine ON favori.id_dom = domaine.id_dom 
                    INNER JOIN cat_fav ON favori.id_fav = cat_fav.id_fav 
                    INNER JOIN categorie ON categorie.id_cat = cat_fav.id_cat WHERE libelle LIKE '%".$_GET['search_bar']."%'";


                }
                $rqtsql .= " GROUP BY favori.id_fav ";
                if (!empty($_GET['Limite'])){
                    if ($_GET['Limite']!="tout"){
                        $rqtsql=$rqtsql." LIMIT ".$_GET["Limite"];
                    }
                }

                echo $rqtsql;

                $result = $pdo->query($rqtsql);
                $favoris = $result->fetchAll(PDO::FETCH_ASSOC); 
               
            ?>

                <!-- Création d'une balise main regroupant tout mon tableau -->
<main class="w-full">
          
                <!-- Création de la classe section. -->
    <section class="w-full flex items-center justify-center">

                <!-- Création de la table afin d'afficher les en-têtes + contour orange. -->
        <table>
            <tr class="border border-amber-500">

                    <!-- Création de chaque en-tête 1 par 1, colonne par colonne. -->
                <th class="bg-sky-500">Domaine</th>
                <th class="bg-sky-500">Libellé</th>
                <th class="bg-sky-500">Date ajout</th>
                <th class="bg-sky-500">Catégories</th>
                <th class="bg-sky-500">Lien</th>
                <th class="bg-sky-500">Update</th>
                <th class="bg-sky-500">Delete</th>
            </tr>

                <!-- Appel de variable pour afficher les favoris dynamiquement. -->
            <?php
                foreach($favoris as $favori){
            ?>

                <!-- Création de l'affichage des différents colonnes (1 sur 2 s'affiche en couleur.) -->
            <tr class="old:bg-white even:bg-amber-200 hover:bg-zinc-500">

                <!-- Création du contour orange + l'animation quand on passe la souris dessus. -->
                <td class="border border-amber-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:hover:bg-gray-600"><?php echo $favori['nom_dom']?></td>
                <td class="border border-amber-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:hover:bg-gray-600"><?php echo $favori['libelle']?></td>
                <td class="border border-amber-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:hover:bg-gray-600"><?php echo $favori['date_creation']?></td>
                <td class="border border-amber-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:hover:bg-gray-600"><?php echo $favori['liste_cat']?></td>
                <td class="border border-amber-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap hover:bg-gray-50 dark:text-white dark:hover:bg-gray-600"><a href="<?php echo $favori['url']?>">Url</a></td>
                <td class="border border-amber-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap hover:bg-gray-50 dark:text-white dark:hover:bg-gray-600"><button class="fa-solid fa-rotate" type="submit"></button></td>
                <td class="border border-amber-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap hover:bg-gray-50 dark:text-white dark:hover:bg-gray-600"><button class="fa-solid fa-trash-can" type="submit"></button></td>
            </tr>

            <?php
                }
            ?>
        </table>
    </section>
</main>
<?php
include("footr.php")
?>
</body>
</html>

