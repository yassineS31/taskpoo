<?php
//FICHIER D'EXECUTION, DONC IMPORT DE TOUTES LES RESSOURCES
session_start();

include './env.php';
include './utils/utils.php';
include './interfaces/interfaceView.php';
include './interfaces/interfaceBDD.php';
include './abstract/abstractController.php';
include './abstract/abstractModel.php';
include './view/viewHeader.php';
include './view/viewAccount.php';
include './view/viewFooter.php';
include './utils/mySQLBDD.php';
include './model/accountModel.php';
include './controller/accountController.php';

$home = new AccountController(['accountModel'=>new AccountModel(new MySQLBDD())],['header'=>new ViewHeader(),'footer'=> new ViewFooter(), 'accueil' => new ViewAccount()]);


//Récupérer le path entrer par l'utilisateur
$url = parse_url($_SERVER['REQUEST_URI']);

//Test le path pour savoir in on a une route, sinon on retourne l'élément racine /
$path = isset($url['path']) ? $url['path'] : '/taskpoo/';

//Mise en place du Routeur et des routes

switch($path){
    //Route pour l'accueil
    case '/taskpoo/':
        $home->render();
        // include './controller/accountController.php';
        break;
    case '/taskpoo/accueil/':
        $home->render();

        break;
    case '/taskpoo/moncompte/':

        include './controller/accountController.php';
        include './controller/MyAccountController.php';

        break;
    
    }