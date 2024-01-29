    <!-- Inclusion du header et du pdo via la fonction include.php afin d'afficher le <h1> "Mes favoris". -->
<?php
include("header.php");
include("pdo.php");
?>

        <!-- Création de la section 'filtre_domaine' afin  de pouvoir les filtrer par la suite. -->
    <section class="filtre_domaine flex justify-center">
        <form action="" method="GET">

            <!-- Rajout d'une bordure pour les filtres -->
            <fieldset class="text-center flex flex-col border border-slate p-4 border-orange-400">

                <!-- SearchBar -->
                <legend>
                <h2 class="text-amber-500">Choix multiples</h2></legend>
                <input class="rounded-md border border-slate-400" name="search_bar" type="search" placeholder="SearchBar">

                <!-- Déclaration du nom : 'filtre_dom' puis création du résultat selon le domaine sur lequel on clique. -->
            <select name="filtre_dom" class="my-4 rounded-md border-4 border-slate-500 hover:bg-slate-500">
                <option class="text-center" value="aucun">Tous domaines (par défaut)</option>
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
                <select name="filtre_cat" class="my-1 rounded-md border-4 border-slate-500 hover:bg-slate-500">
                    <option class="text-center" value="aucun">Toutes catégories (par défaut)</option>
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
                
            <select class="my-2 text align-center rounded-md border-4 border-orange-400 hover:bg-slate-500" name="Limite" id="">
                <option class="text-center" value="tout">Pas de limite (par défaut)</option>
                <option value="1">Limite à 1</option>
                <option value="10">Limite à 10</option>
                <option value="30">Limite à 30</option>
                <option value="50">Limite à 50</option>
                <option value="100">Limite à 100</option>
            </select>
              
                <!-- Création/décla d'un bouton afin de soumettre son résultat pour ensuite éxécuter l'affichage. -->
            <button class="my-2 text align-center rounded-md border-4 border-orange-400 hover:bg-slate-500" type="submit">
                Appliquer
            </button>
            </fieldset>  
                <!-- Fermeture du bloc formulaire. -->
        </form>
    </section>

                <!-- Déclaration de la condition, si le 'filtre_dom' est défini alors la requête sql sélectionne l'id correspondant, l'affiche dans l'url et sur la page en cours. -->
            <?php 
                if (!empty($_GET['filtre_dom']) || !empty($_GET['filtre_cat'])){
                    if ($_GET['filtre_dom'] == "aucun" && $_GET['filtre_cat'] != "aucun"){
                        $rqtsql="SELECT  favoris.id_fav, domaine.nom_dom, libelle, date_creation, GROUP_CONCAT(nom_cat SEPARATOR ' | ') as 'liste_cat', url FROM favoris 
                        INNER JOIN domaine ON favoris.id_dom = domaine.id_dom
                        INNER JOIN cat_fav ON favoris.id_fav = cat_fav.id_fav
                        INNER JOIN categorie ON categorie.id_cat = cat_fav.id_cat

                        WHERE categorie.id_cat = ".$_GET['filtre_cat'];


                    }else{
                        if($_GET['filtre_cat'] == "aucun" && $_GET['filtre_dom'] != "aucun"){
                            $rqtsql="SELECT  favoris.id_fav, domaine.nom_dom, libelle, date_creation, GROUP_CONCAT(nom_cat SEPARATOR ' | ') as 'liste_cat', url FROM favoris 
                            INNER JOIN domaine ON favoris.id_dom = domaine.id_dom
                            INNER JOIN cat_fav ON favoris.id_fav = cat_fav.id_fav
                            INNER JOIN categorie ON categorie.id_cat = cat_fav.id_cat
                            
                            WHERE domaine.id_dom =".$_GET['filtre_dom'];

                        }else{

                            $rqtsql="SELECT  favoris.id_fav, domaine.nom_dom, libelle, date_creation, GROUP_CONCAT(nom_cat SEPARATOR ' | ') as 'liste_cat', url FROM favoris 
                                        INNER JOIN domaine ON favoris.id_dom = domaine.id_dom
                                        INNER JOIN cat_fav ON favoris.id_fav = cat_fav.id_fav
                                        INNER JOIN categorie ON categorie.id_cat = cat_fav.id_cat
                                        
                                        WHERE domaine.id_dom =".$_GET['filtre_dom']." AND categorie.id_cat = ".$_GET['filtre_cat'];



                        }
                    }
                        /*$rqtsql="SELECT  domaine.nom_dom, libelle, date_creation, GROUP_CONCAT(nom_cat SEPARATOR ' | ') as 'liste_cat', url FROM favoris 
                                        INNER JOIN domaine ON favoris.id_dom = domaine.id_dom
                                        INNER JOIN cat_fav ON favoris.id_fav = cat_fav.id_fav
                                        INNER JOIN categorie ON categorie.id_cat = cat_fav.id_cat
                                        
                                        WHERE domaine.id_dom =".$_GET['filtre_dom']." AND categorie.id_cat = ".$_GET['filtre_cat'].
                                        " GROUP BY favoris.id_fav ";*/
                    
                
                    // $result = $pdo->query"SELECT * FROM `favoris` 
                    // INNER JOIN `domaine` ON favoris.id_dom = domaine.id_dom
                    // INNER JOIN `cat_fav` ON favoris.id_fav = cat_fav.id_fav 
                    // INNER JOIN `categorie` ON categorie.id_cat = cat_fav.id_cat
                    // WHERE favoris.id_fav=".$_GET['favoris'].";";
                    // $favoris = $result->fetchAll(PDO::FETCH_ASSOC); 
                
                }else{ 
                    $rqtsql = "SELECT  favoris.id_fav, domaine.nom_dom, libelle, date_creation, GROUP_CONCAT(nom_cat SEPARATOR ' | ') as 'liste_cat', url  FROM favoris  
                    INNER JOIN domaine ON favoris.id_dom = domaine.id_dom 
                    INNER JOIN cat_fav ON favoris.id_fav = cat_fav.id_fav 
                    INNER JOIN categorie ON categorie.id_cat = cat_fav.id_cat";
                   
                    // echo "on";
                }
                if (!empty($_GET['search_bar'])){
                     $rqtsql = "SELECT favoris.id_fav, domaine.nom_dom, libelle, date_creation, GROUP_CONCAT(nom_cat SEPARATOR ' | ') as 'liste_cat', url  FROM favoris  
                    INNER JOIN domaine ON favoris.id_dom = domaine.id_dom 
                    INNER JOIN cat_fav ON favoris.id_fav = cat_fav.id_fav 
                    INNER JOIN categorie ON categorie.id_cat = cat_fav.id_cat WHERE libelle LIKE '%".$_GET['search_bar']."%'";


                }
                $rqtsql .= " GROUP BY favoris.id_fav ";
                if (!empty($_GET['Limite'])){
                    if ($_GET['Limite']!="tout"){
                        $rqtsql=$rqtsql." LIMIT ".$_GET["Limite"];
                    }
                }

                // echo $rqtsql;

                $result = $pdo->query($rqtsql);
                $favoris = $result->fetchAll(PDO::FETCH_ASSOC); 
               
            ?>

                <!-- Création d'une balise main regroupant tout mon tableau -->
<main class="w-full mt-6">
          
                <!-- Création de la classe section. -->
    <section class="w-full flex items-center justify-center">

                <!-- Création de la table afin d'afficher les en-têtes + contour orange. -->
        <table>
            <tr class="border border-amber-500">

                    <!-- Création de chaque en-tête 1 par 1, colonne par colonne. -->
                <th class="hover:bg-indigo-500 bg-amber-500">Domaine</th>
                <th class="hover:bg-indigo-500 bg-amber-500">Libellé</th>
                <th class="hover:bg-indigo-500 bg-amber-500">Date ajout</th>
                <th class="hover:bg-indigo-500 bg-amber-500">Catégories</th>
                <th class="hover:bg-indigo-500 bg-amber-500">Lien</th>
                <th class="hover:bg-indigo-500 bg-amber-500">Lire</th>
                <th class="hover:bg-indigo-500 bg-amber-500">Supprimer</th>

            </tr>

                <!-- Appel de variable pour afficher les favoris dynamiquement. -->
            <?php
                foreach($favoris as $favori){
            ?>

                <!-- Création de l'affichage des différents colonnes (1 sur 2 s'affiche en couleur.) -->
            <tr class="odd:bg-zinc-500 even:bg-slate-400 hover:bg-indigo-500">

                <!-- Création du contour orange + l'animation quand on passe la souris dessus. -->
                <td class="border border-amber-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap hover:bg-gray-50 dark:text-white dark:hover:bg-gray-600"><?php echo $favori['nom_dom']?></td>
                <td class="border border-amber-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap hover:bg-gray-50 dark:text-white dark:hover:bg-gray-600"><?php echo $favori['libelle']?></td>
                <td class="border border-amber-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap hover:bg-gray-50 dark:text-white dark:hover:bg-gray-600"><?php echo $favori['date_creation']?></td>
                <td class="border border-amber-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap hover:bg-gray-50 dark:text-white dark:hover:bg-gray-600"><?php echo $favori['liste_cat']?></td>
                <td class="border border-amber-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap hover:bg-gray-50 dark:text-white dark:hover:bg-gray-600"><a href="<?php echo $favori['url']?>">Url</a></td>
                <form action="singleFavori.php" method="get">
                <td class="border border-amber-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap hover:bg-gray-50 dark:text-white dark:hover:bg-gray-600"><button name="id_fav" value="<?php echo $favori['id_fav']?>"  class="fa-solid fa-eye" type="submit"></button></td>
                </form>   
                <form action="delete.php" method="get">
                        <td class=" text-centerborder border-amber-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap hover:bg-gray-50 dark:text-white dark:hover:bg-gray-600"><button name="id_fav" value="<?php echo $favori['id_fav']?>" type="submit"><i class="fa-solid fa-trash-can"></i></button></td>

                    </form>

                
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

