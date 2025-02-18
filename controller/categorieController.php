<?php

include 'model/category.php';


function ajouterCategory(PDO $bdd) {
     $message = "";
     if(isset($_POST["submit"])) {
        if(!empty($_POST["name"])) {
            $categorie = getCategoryByName($bdd,$_POST["name"]);
            if(!$categorie) {
                 addCategory($bdd, $_POST["name"]);
                $message = "la catégorie a été ajouté";
            }
            else {
                $message = "La catégorie existe déja en BDD";
            } 
        }
    }
   
    include 'vue/addCategory.php';
}
