<?php

include './utils/utils.php';
include './interfaces/InterfaceView.php';
include 'controller/categorieController.php';

include './vue/header.php';
include './vue/account.php';
include './vue/footer.php';
include './abstract/abstractController.php';
include './abstract/accountController.php';
include './interfaces/interfaceBDD.php';
// // Nav
// $nav = new headerView();
// echo $nav->displayView();
// // Body
// $body = new ViewAccount();
// echo $body->displayView();
// // Footer
// $footer = new ViewFooter();
// echo $footer->displayView();

$home = new AccountController(null,['header'=>new ViewHeader(),'footer'=> new ViewFooter()]);
$home->render();