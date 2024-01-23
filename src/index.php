<?php
include("header.php");
include("pdo.php");
$result = $pdo->query("SELECT * FROM favori inner join domaine");
$favoris = $result->fetchAll(PDO::FETCH_ASSOC); 
?>

    <section class="flex items-center justify-center">
        <table>
            <tr class="border border-orange-500">
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

            <tr class="old:bg-white even:bg-orange-200 hover:bg-slate-500">
                <td class="rounded-md border border-orange-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:hover:bg-gray-600"><?php echo $favori['nom_dom']?></td>
                <td class="rounded-md border border-orange-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:hover:bg-gray-600"><?php echo $favori['libelle']?></td>
                <td class="rounded-md border border-orange-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:hover:bg-gray-600"><?php echo $favori['date_creation']?></td>
                <td class="rounded-md border border-orange-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:hover:bg-gray-600"><?php echo $favori['url']?></td>
                <td class="rounded-md border border-orange-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:hover:bg-gray-600"><i class="fa-solid fa-rotate"></i></td>
                <td class="rounded-md border border-orange-500 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:hover:bg-gray-600"><i class="fa-solid fa-trash-can"></i></td>
            </tr>
            
                    
            <?php
                }
            ?>
        </table>
    </section>
</body>
</html>

