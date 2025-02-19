<?php
//FICHIER D'EXECUTION, DONC IMPORT DE TOUTES LES RESSOURCES
session_start();

include './env.php';
include './utils/utils.php';
include './interface/interfaceView.php';
include './interface/interfaceBDD.php';
include './abstract/abstractController.php';
include './abstract/abstractModel.php';
include './view/viewHeader.php';
include './view/viewAccount.php';
include './view/viewFooter.php';
include './utils/mySQLBDD.php';
include './model/accountModel.php';
include './controller/accountController.php';

$home = new AccountController(['accountModel'=>new AccountModel(new MySQLBDD())],['header'=>new ViewHeader(),'footer'=> new ViewFooter(), 'accueil' => new ViewAccount()]);
$home->render();