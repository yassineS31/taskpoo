<?php
abstract class AbstractModel {
    //ATTRIBUT
    private ?interfaceBDD $bdd;

    //CONSTRUCTEUR
    public function __construct(?InterfaceBDD $bdd){
        $this->bdd = $bdd;
    }
    
    //GETTER ET SETTER
    public function getBdd(): ?interfaceBDD { return $this->bdd; }
    public function setBdd(?interfaceBDD $bdd): AbstractModel { $this->bdd = $bdd; return $this; }

    //METHOD
       abstract  public function add():void;

       abstract  public function update():void;

    abstract  public function delete():void;

    abstract  public function getAll():array | null;

    abstract public function getById():array | null;
}