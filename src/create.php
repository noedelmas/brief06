<?php
include("header.php")
?>


<!DOCTYPE html>
<html class="dark" lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AddFav</title>
    </head>
<body>

    <!-- Formulaire pour inclure les informations de la nvlle ligne favori. -->
    <form class="flex justify-center" action="" method="">
        <fieldset class="mt-12 w-1/12 text-center  flex-col border border-slate p-4 dark:border-indigo-500 border-orange-400">

        <label for="libelle">
            <p class="text-amber-500">Libellé :</p>
        </label>   
    <input type="text" placeholder="Saisir le libellé.">
             
        <label for="nom_dom">
            <p class="text-amber-500">Domaine :</p>
        </label>
        <input type="text" placeholder="Saisir le domaine.">

        <label for="categorie"> 
            <p class="text-amber-500">Catégorie :</p>
        </label>
           <input type="text" placeholder="Saisir la catégorie.">

        <label for="date_creation">
            <p class="text-amber-500">Date d'ajout :</p>
            <input type="text" placeholder="Saisir la date de création.">
        </label>
        
        <label for="date_creation">
            <p class="text-amber-500">Lien :</p>
        </label>
        <input type="text" placeholder="Saisir le libellé.">
        
            <button class="dark my-6 px-4 text align-center rounded-md border-4 dark:bg-white bg-slate-500 dark:border-amber-500 border-amber-500 dark:hover:bg-slate-500 hover:bg-slate-500" type="submit">
                Ajouter aux favoris.
            </button>
        </fieldset> 
    </form>
</body>
</html>