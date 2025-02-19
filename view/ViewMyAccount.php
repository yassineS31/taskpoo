<?php

class MyAccountView implements InterfaceView {
    public function displayView():string{
        ob_start();
?>
    <h1>Mon Compte</h1>
    <h2>Nom Prénom : <?= $_SESSION['lastname']." ".$_SESSION['firstname']?></h2>
    <p>Email : <?= $_SESSION['email']?></p>
<?php
        return ob_get_clean();
    }
}