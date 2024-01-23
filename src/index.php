    <!-- Inclusion du header et du pdo via la fonction include.php afin d'afficher le <h1> "Mes favoris". -->

<?php
include("header.php");
include("pdo.php");

?>

        <!-- Création de la section 'filtre_domaine' afin  de pouvoir les filtrer par la suite. -->

    <section class="filtre_domaine flex justify-center">
        <form action="" method="GET">

                <!-- Déclaration du nom : 'filtre_dom' puis création du résultat selon le domaine sur lequel on clique. -->

            <select name="filtre_dom" class="my-8 rounded rounded-md hover:bg-slate-500">
            <?php
            $result = $pdo->query("SELECT * FROM domaine");
            $domaine = $result->fetchAll(PDO::FETCH_ASSOC); 
                foreach($domaine as $un_domaine){
            ?>

                    <!-- Création/décla d'une option afin de faire comprendre à la machine qu'il faut afficher le domaine par rapport à l'id. -->

                <option value="<?php echo $un_domaine['id_dom']?>"><?php echo $un_domaine['nom_dom']?></option>
                <?php
                }
            ?>
            </select>

                <!-- Création/décla d'un bouton afin de soumettre son résultat pour ensuite éxécuter l'affichage. -->

            <button class="my-4 text align-center rounded rouned-md hover:bg-slate-500" type="submit">
                Appliquer
            </button>

                <!-- Fermeture du bloc formulaire. -->

        </form>
    </section>

                <!-- Déclaration de la condition, si le 'filtre_dom' est défini alors la requête sql sélectionne l'id correspondant, l'affiche dans l'url et sur la page en cours. -->

            <?php 
                if (isset($_GET['filtre_dom'])){
                    print_r($_GET['filtre_dom']);
                    $rqtsql="SELECT * FROM favori inner join domaine on favori.id_dom = domaine.id_dom where domaine.id_dom =".$_GET['filtre_dom'].";";
                }else{ 
                    $rqtsql = "SELECT * FROM favori inner join domaine";
                }
                $result = $pdo->query($rqtsql);
                $favoris = $result->fetchAll(PDO::FETCH_ASSOC); 
            ?>

                <!-- Création de la classe section. -->

    <section class="flex items-center justify-center">

                <!-- Création de la table afin d'afficher les en-têtes + contour orange. -->

        <table>
            <tr class="border border-amber-500">

                    <!-- Création de chaque en-tête 1 par 1, colonne par colonne. -->
            
                <th class="bg-sky-500">Domaine</th>
                <th class="bg-sky-500">Libellé</th>
                <th class="bg-sky-500">Date ajout</th>
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
                <td class="border border-amber-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:hover:bg-gray-600"><?php echo $favori['url']?></td>
                <td class="border border-amber-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:hover:bg-gray-600"><button class="fa-solid fa-rotate" type="submit"></button></td>
                <td class="border border-amber-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:hover:bg-gray-600"><button class="fa-solid fa-trash-can" type="submit"></button></td>
            </tr>
                
            <?php
                }
            ?>
        </table>
    </section>
</body>
</html>

