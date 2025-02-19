<?php
class ViewAccount implements interfaceView{
    //ATTRIBUT
    private ?string $form = '';
    private ?string $listUsers = '';

    //GETTER ET SETTER
    public function getForm(): ?string { return $this->form; }
    public function setForm(?string $form): self { $this->form = $form; return $this; }

    public function getListUsers(): ?string { return $this->listUsers; }
    public function setListUsers(?string $listUsers): self { $this->listUsers = $listUsers; return $this; }


    //METHOD
    public function displayView():string{
        ob_start();
        echo $this->getForm();
?>

        <section>
            <h1>Liste d'Utilisateurs</h1>
            <ul>
                <?php echo $this->getListUsers() ?>
            </ul>
        </section>
<?php
        return ob_get_clean();
    }
}