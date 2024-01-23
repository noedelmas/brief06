<?php
include("header.php");
include("pdo.php");

?>
    <section class="filtre_domaine flex justify-center">
        <form action="" method="GET">
            <select name="filtre_dom" class="my-8 rounded rounded-md hover:bg-slate-500">
            <?php
            $result = $pdo->query("SELECT * FROM domaine");
            $domaine = $result->fetchAll(PDO::FETCH_ASSOC); 
                foreach($domaine as $un_domaine){
            ?>
                <option value="<?php echo $un_domaine['id_dom']?>"><?php echo $un_domaine['nom_dom']?></option>
                <?php
                }
            ?>
            </select>
            <button class="my-4 text align-center rounded rouned-md hover:bg-slate-500" type="submit">
                Appliquer
            </button>
        </form>
    </section>
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
    <section class="flex items-center justify-center">
        <table>
            <tr class="border border-amber-500">
                <th class="bg-sky-500">Domaine</th>
                <th class="bg-sky-500">Libellé</th>
                <th class="bg-sky-500">Date ajout</th>
                <th class="bg-sky-500">Lien</th>
                <th class="bg-sky-500">Update</th>
                <th class="bg-sky-500">Delete</th>
            </tr>
            <?php
                foreach($favoris as $favori){
            ?>

            <tr class="old:bg-white even:bg-orange-200 hover:bg-zinc-500">
                <td class="border border-orange-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:hover:bg-gray-600"><?php echo $favori['nom_dom']?></td>
                <td class="border border-orange-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:hover:bg-gray-600"><?php echo $favori['libelle']?></td>
                <td class="border border-orange-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:hover:bg-gray-600"><?php echo $favori['date_creation']?></td>
                <td class="border border-orange-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:hover:bg-gray-600"><?php echo $favori['url']?></td>
                <td class="border border-orange-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:hover:bg-gray-600"><button class="fa-solid fa-rotate"></button></td>
                <td class="border border-orange-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:hover:bg-gray-600"><button class="fa-solid fa-trash-can"></button></td>
            </tr>
                
            <?php
                }
            ?>
        </table>
    </section>
</body>
</html>

