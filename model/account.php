<!-- 

/**
 * @method ajouter un compte en BDD
 * @param PDO $bdd
 * @param array $account [firstname, lastname, email, password]
 * @return void
 */
function addAccount(PDO $bdd, array $account): void {
    try{
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

/**
 * @method modifier un compte en BDD
 * @param PDO $bdd
 * @param array $account [firstname, lastname, ancien-email, nouvel-mail]
 * @return void
 */
function updateAccount(PDO $bdd, array $account): void {
    try {
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

/**
 * @method Supprimer un compte en BDD
 * @param PDO $bdd
 * @param string $email
 * @return void
 */
function deleteAccount(PDO $bdd, string $email): void {
    try{
        $requete = "DELETE FROM account WHERE email=?";
        $req = $bdd->prepare($requete);
        $req->bindParam(1,$email, PDO::PARAM_STR);
        $req->execute();
    } catch(Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
/**
 * @method afficher un compte depuis son email
 * @param PDO $bdd
 * @param string $email
 * @return ?array acount [id, firstname, lastname, email]
 */
function getAccountByEmail(PDO $bdd, string $email): array|null|string {
    try {
        $requete = "SELECT id_account, firstname, lastname, email FROM account
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

/**
 * @method afficher tous les comptes
 * @param PDO $bdd
 * @return ?array acount [id, firstname, lastname, email]
 */
function getAllAccount(PDO $bdd): array|null|string{
    try {
        $requete = "SELECT id_account, firstname, lastname, email FROM account";
        $req = $bdd->prepare($requete);
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
} -->


<?php 

class ModelAccount extends AbstractModel {

    private ?int $id;
    private ?array $account;
    private ?string $email;

    public function getId(): ?int {
        return $this->id;
    }

    public function getAccount(): ?array {
        return $this->account;
    }

    public function getEmail(): ?string {
        return $this->email;
    }
    
    public function setId(?int $id): self {
        $this->id = $id;
        return $this;
    }

    public function setAccount(?array $account): self {
        $this->account = $account;
        return $this;
    }

    public function setEmail(?string $email): self {
        $this->email = $email;
        return $this;
    }
    
    public function add(): void{
        try{
            $bdd=$this->getBdd()->connexion();
            $requete = "INSERT INTO account(firstname, lastname, email, `password`)
            VALUE(?,?,?,?)";
            $req =$bdd->prepare($requete);
            $req->bindParam(1,$this->account[0], PDO::PARAM_STR);
            $req->bindParam(2,$this->account[1], PDO::PARAM_STR);
            $req->bindParam(3,$this->account[2], PDO::PARAM_STR);
            $req->bindParam(4,$this->account[3], PDO::PARAM_STR);
            $req->execute();
        }
        catch(Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

public function delete(): void {
    try{
        $bdd=$this->getBdd()->connexion();
        $requete = "DELETE FROM account WHERE email=?";
        $req =$bdd->prepare($requete);
        $req->bindParam(1,$this->email, PDO::PARAM_STR);
        $req->execute();
    } catch(Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}


public function update():void{
    try {
        $bdd= $this->getBdd()->connexion();
        $requete = "UPDATE account SET firstname=?, lastname=?, email=? 
        WHERE email=?";
        $req =$bdd->prepare($requete);
        $req->bindParam(1,$this->account[0], PDO::PARAM_STR);
        $req->bindParam(2,$this->account[1], PDO::PARAM_STR);
        $req->bindParam(3,$this->account[3], PDO::PARAM_STR);
        $req->bindParam(4,$this->account[2], PDO::PARAM_STR);
        $req->execute();
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
public function getAll():?array{
    try {
        $bdd = $this->getBdd()->connexion();
        $requete = "SELECT id_account, firstname, lastname, email FROM account";
        $req =$bdd->prepare($requete);
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
public function getById():?array{
    try {
        $bdd = $this->getBdd()->connexion();
        $requete = "SELECT id_account, firstname, lastname, email FROM account
        WHERE id_account = ?";
        $req =$bdd->prepare($requete);
        $req->bindParam(1,$this->email, PDO::PARAM_STR);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        return $data;
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}



}