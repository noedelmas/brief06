<?php
include("header.php");
include("pdo.php");
$result = $pdo->query("SELECT * FROM favori inner join domaine");
$favoris = $result->fetchAll(PDO::FETCH_ASSOC); 
?>

    <section id="bookmarks">
        <table class="table_fav">
            <tr>
                <th>Domaine</th>
                <th>Libellé</th>
                <th>Date ajout</th>
                <th>Lien</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            <?php
                foreach($favoris as $favori){
            ?>

            <tr>
                <td><?php echo $favori['nom_dom']?></td>
                <td><?php echo $favori['libelle']?></td>
                <td><?php echo $favori['date_creation']?></td>
                <td><?php echo $favori['url']?></td>
                <td><i class="fa-solid fa-rotate"></i></td>
                <td><i class="fa-solid fa-trash-can"></i></td>
            </tr>

            <?php
                }
            ?>
        </table>
    </section>
</body>
</html>

