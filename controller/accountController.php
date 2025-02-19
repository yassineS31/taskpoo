<?php
class AccountController extends AbstractController {
    //METHOD
    public function signIn():?string{
        if(isset($_POST['submitSignIn'])){
            //Vérifie leschamps vides
            if(empty($_POST['emailSignIn']) || empty($_POST['passwordSignIn']) ){
                return 'Veuillez remplir tous les champs';
            }
    
            //Vérifier le format des données : le mail
            if(!filter_var($_POST['emailSignIn'],FILTER_VALIDATE_EMAIL)){
                //Retourne le message d'erreur
                return "Email pas au bon format !";
            }
    
            //Nettoyage des données
            $email = sanitize($_POST['emailSignIn']);
            $password = sanitize($_POST['passwordSignIn']);
    
            //Récupération des données de l'utilisateur
            $data = $this->getListModels()["accountModel"]->setEmail($email)->getByEmail();
    
            //Vérifie que mon utilisateur existe ($data n'est pas vide)
            if(empty($data)){
                //message d'erreur
                return 'Email et/ou Mot de Passe incorrect !';
            }
    
            //Vérifie la correspondance des mots de passe
            if(!password_verify($password, $data['password'])){
                //message d'erreur
                return 'Email et/ou Mot de Passe incorrect !';
            }
    
            $_SESSION['id'] = $data['id_account'];
            $_SESSION['firstname']= $data['firstname'];
            $_SESSION['lastname']= $data['lastname'];
            $_SESSION['email']= $data['email'];
    
            header('location:taskpoo/');
            exit;
    
            return $_SESSION['firstname']. " ".$_SESSION['lastname']." est connecté !";
        }
        return '';
    }

    public function signUp():?string{
        //Vérifier qu'on reçoit le formulaire
        if(isset($_POST['submitSignUp'])){
            echo 'test';
            //Vérifier les champs vide
            if(empty($_POST['lastname']) || empty($_POST['firstname']) || empty($_POST['email']) || empty($_POST['password'])){
                //Retourne le message d'erreur
                return "Veuillez remplir les champs !";
            }
    
            //Vérifier le format des données : ici l'email
            if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                //Retourne le message d'erreur
                return "Email pas au bon format !";
            }
    
            //Nettoyer les données
            $lastname = sanitize($_POST['lastname']);
            $firstname = sanitize($_POST['firstname']);
            $email = sanitize($_POST['email']);
            $password = sanitize($_POST['password']);
    
            //Hasher le mot de passe
            $password = password_hash($password, PASSWORD_BCRYPT);
    
            //Vérifier que l'utilisateur n'existe pas déjà en bdd
            if(!empty($this->getListModels()["accountModel"]->setEmail($email)->getByEmail())){
                //Retourne le message d'erreur
                return "Cet email existe déjà !";
            }
    
            //J'enregistre mon utilisateur en bdd
            $account = [$firstname, $lastname, $email, $password];
            $this->getListModels()["accountModel"]->setAccount($account)->add();
        
            return "$firstname $lastname a été enregistré avec succès !";
        }
        return '';
    }

    public function displayForm(?string $message='',?string $messageSignIn=''):string{
        if(!isset($_SESSION['id'])){
            return '
            <section>
                <h1>Inscription</h1>
                <form action="" method="post">
                    <input type="text" name="lastname" placeholder="Le Nom de Famille">
                    <input type="text" name="firstname" placeholder="Le Prénom">
                    <input type="text" name="email" placeholder="L\'Email">
                    <input type="password" name="password" placeholder="Le Mot de Passe">
                    <input type="submit" name="submitSignUp">
                </form>
                <p>'. $message .'</p>
            </section>
            <section>
                <h1>Connexion</h1>
                <form action="" method="post">
                    <input type="text" name="emailSignIn" placeholder="L\'Email">
                    <input type="password" name="passwordSignIn" placeholder="Le Mot de Passe">
                    <input type="submit" name="submitSignIn">
                </form>
                <p>'.$messageSignIn.'</p>
            </section>';
        }
        return '';
    }

    public function displayAccount():string{
        //Récupération de la liste des utilisateurs
        $data = $this->getListModels()["accountModel"]->getAll();

        $listUsers = "";
        foreach($data as $account){
            $listUsers = $listUsers."<li><h2>".$account['firstname'] ." ". $account['lastname']."</h2>      <p>".$account['email']."</p></li>";
        }
        return $listUsers;
    }

    public function render():void{
        //D'abord on traite les données (ici : connexion et inscription)
        $messageSignIn = $this->signIn();
        $message= $this->signUp();

        //Puis on fait le rendu des vues
        $this->renderHeader();
        echo $this->getListViews()['accueil']->setForm($this->displayForm($message,$messageSignIn))->setListUsers($this->displayAccount())->displayView();
        $this->renderFooter();
    }
}