<!DOCTYPE html>
<html class="dark" lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php pdo</title>
    <link rel="stylesheet" href="output.css">
    <script src="https://kit.fontawesome.com/0a3766d4f1.js" crossorigin="anonymous"></script>
</head>
<body class="bg-indigo-500 dark:bg-slate-800">

        <!-- Création du header pour l'afficher dans l'index. -->
    <header class="flex justify-center py-4 dark">

            <!-- Création du h1. -->
        <h1 class="md:flex w-16 md:w-32 lg:w-48 rounded-md border-4 border-slate-500 flex justify-around dark:text-indigo-500">Mes favoris
            <form action="create.php" method="get">
            <button name="id_fav" value="<?php echo $favori['id_fav']?>" type="submit"><i class="fa-solid fa-plus rounded dark:text-amber-500 dark:hover:bg-slate-500"></i></button></td>
            </form>
        </h1>
    </header>