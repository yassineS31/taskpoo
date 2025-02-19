<?php
class MyAccountController extends AbstractController {

    private ?array $listModels;
    private ?array $listViews;


    public function render():void{
        if(!isset($_SESSION['id'])){
            header('location:/taskpoo/');
            exit;
        }
        $this->renderHeader();
        echo $this->getListViews()['mon_compte']->displayView();
        $this->renderFooter();
    }
}

