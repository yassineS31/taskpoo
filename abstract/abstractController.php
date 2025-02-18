<?php
abstract class AbstractController {
    //ATTRIBUTS
    private ?array $listModels;
    /**
     * $listViews : tableau associatif démarrant avec :
     * [
     *  header => ViewHeader,
     *  footer => ViewFooter,
     *  les autres vues...
     * ]
     */
    private ?array $listViews;

    //CONSTRUCTEUR
    public function __construct(?array $listModels, ?array $listViews){
        $this->listModels = $listModels;
        $this->listViews = $listViews;
    }
    
    //GETTER ET SETTER
    public function getListModels(): ?array { return $this->listModels; }
    public function setListModels(?array $listModels): self { $this->listModels = $listModels; return $this; }

    public function getListViews(): ?array { return $this->listViews; }
    public function setListViews(?array $listViews): self { $this->listViews = $listViews; return $this; }

    //METHOD
    public abstract function render():void;

    public function renderHeader():void{
        if(isset($_SESSION['id'])){
            $this->getListViews()['header']->setNav('<a href="/moncompte">Mon Compte</a>
                 <a href="/deconnexion">Se Déconnecter</a>');
         }
        echo $this->getListViews()['header']->displayView();
    }

    public function renderFooter():void{
        $footer = $this->getListViews();
        echo $footer['footer']->displayView();
    }
}