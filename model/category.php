<?php

/**
 * @param PDO $bdd
 * @param string $name
 * @return void 
 */
function addCategory(PDO $bdd, string $name): void
{
    //Requête
    $requete = "INSERT INTO category(name) VALUE(?)";
    try {
        //Préparation de la requête
        $req = $bdd->prepare($requete);
        //Associer les paramètres (?)
        $req->bindParam(1, $name, PDO::PARAM_STR);
        //Exécuter la requête
        $req->execute();
    } catch (Exception $e) {
        echo "Erreur" . $e->getMessage();
    }
}

/**
 * @param PDO $bdd 
 * @param string $name 
 * @return void
 */
function updateCategory(PDO $bdd, string $name): void
{
    //Requête
    $requete = "UPDATE category SET name=? WHERE name=?";
    try {
        //Préparation de la requête
        $req = $bdd->prepare($requete);
        //Associer les paramètres (?)
        $req->bindParam(1, $name, PDO::PARAM_STR);
        $req->bindParam(2, $name, PDO::PARAM_STR);
        //Exécuter la requête
        $req->execute();
    } catch (Exception $e) {
        echo "Erreur" . $e->getMessage();
    }
}


/**
 * @param PDO $bdd 
 * @param string $name
 * @return void
 */
function deleteCategory(PDO $bdd, string $name): void
{
    //Requête
    $requete = "DELETE FROM category WHERE name = ?";
    try {
        //Préparation de la requête
        $req = $bdd->prepare($requete);
        //Associer les paramètres (?)
        $req->bindParam(1, $name, PDO::PARAM_STR);
        //Exécuter la requête
        $req->execute();
    } catch (Exception $e) {
        echo "Erreur" . $e->getMessage();
    }
}

/**
 * @param PDO $bdd 
 * @param string $name
 * @return array|null
 */
function getCategoryByName(PDO $bdd, string $name): array|null|string
{
    //Requête
    $requete = "SELECT id_category, name FROM category WHERE name=?";
    try {
        //Préparation de la requête
        $req = $bdd->prepare($requete);
        //Associer les paramètres (?)
        $req->bindParam(1, $name, PDO::PARAM_STR);
        //Exécuter la requête
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        return $data;
    } catch (Exception $e) {
        echo "Erreur" . $e->getMessage();
    }
}

/**
 * @param PDO $bdd 
 * @return array|null
 */
function getAllCategory(PDO $bdd): array|null
{
    //Requête
    $requete = "SELECT id_category, name FROM category";
    try {
        //Préparation de la requête
        $req = $bdd->prepare($requete);
        //Exécuter la requête
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } catch (Exception $e) {
        echo "Erreur" . $e->getMessage();
    }
}
