<?php
abstract class AbstractModel {
    //ATTRIBUTS
    private ?interfaceBDD $bdd;


    //CONSTRUCTEUR
 public function __construct(?interfaceBDD $bdd){
    $this->bdd = $bdd;
 }
    
    //GETTER ET SETTER
    public function getBdd():interfaceBDD{
        return $this->bdd;
    }

    public function setBdd(?object $newBdd){
        $this->bdd = $newBdd;
        return $this;
    }


    //METHOD
     abstract public function add():void;
     abstract public function update():void;
     abstract public function delete():void;
     abstract public function getAll():?array;
     abstract public function getById():?array;



}