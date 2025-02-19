<?php
class AccountModel extends AbstractModel{
    //ATTRIBUT
    private ?int $id;
    private ?array $account;
    private ?string $email;

    //GETTER ET SETTER
    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): AccountModel { $this->id = $id; return $this; }

    public function getAccount(): ?array { return $this->account; }
    public function setAccount(?array $account): AccountModel { $this->account = $account; return $this; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(?string $email): AccountModel { $this->email = $email; return $this; }

    //METHOD
    public function add():void{
        try{
            $bdd = $this->getBdd()->connexion();
            $account = $this->getAccount();

            $requete = "INSERT INTO account(firstname, lastname, email, `password`)
            VALUE(?,?,?,?)";
            $req = $bdd->prepare($requete);
            $req->bindParam(1,$account[0], PDO::PARAM_STR);
            $req->bindParam(2,$account[1], PDO::PARAM_STR);
            $req->bindParam(3,$account[2], PDO::PARAM_STR);
            $req->bindParam(4,$account[3], PDO::PARAM_STR);
            $req->execute();
        }
        catch(Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function update():void{
        try {
            $bdd = $this->getBdd()->connexion();
            $account = $this->getAccount();

            $requete = "UPDATE account SET firstname=?, lastname=?, email=? 
            WHERE email=?";
            $req = $bdd->prepare($requete);
            $req->bindParam(1,$account[0], PDO::PARAM_STR);
            $req->bindParam(2,$account[1], PDO::PARAM_STR);
            $req->bindParam(3,$account[3], PDO::PARAM_STR);
            $req->bindParam(4,$account[2], PDO::PARAM_STR);
            $req->execute();
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function delete():void{
        try{
            $bdd = $this->getBdd()->connexion();
            $email = $this->getEmail();

            $requete = "DELETE FROM account WHERE email=?";
            $req = $bdd->prepare($requete);
            $req->bindParam(1,$email, PDO::PARAM_STR);
            $req->execute();
        } catch(Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function getAll():array | null{
        try {
            $bdd = $this->getBdd()->connexion();

            $requete = "SELECT id_account, firstname, lastname, email FROM account";
            $req = $bdd->prepare($requete);
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function getById():array | null{
        try {
            $bdd = $this->getBdd()->connexion();
            $id = $this->getId();

            $requete = "SELECT id_account, firstname, lastname, email, `password` FROM account
            WHERE id_account = ?";
            $req = $bdd->prepare($requete);
            $req->bindParam(1,$id, PDO::PARAM_STR);
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function getByEmail():array | null | bool{
        try {
            $bdd = $this->getBdd()->connexion();
            $email = $this->getEmail();

            $requete = "SELECT id_account, firstname, lastname, email, `password` FROM account
            WHERE email = ?";
            $req = $bdd->prepare($requete);
            $req->bindParam(1,$email, PDO::PARAM_STR);
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}