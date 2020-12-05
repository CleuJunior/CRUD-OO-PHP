<?php

class Contact {
    private $pdo;

    public function __construct(){
        $this->pdo = new PDO("mysql:dbname=crud_poo;host=localhost", "root", "root");

    }

    public function adicionar($email, $nome = ''){
        if($this->exiteEmail($email) == false){
            $sql = "INSERT INTO contatos (nome, email) VALUES (:nome, :email)";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(':nome', $nome);
            $sql->bindValue(':email', $email);
            $sql->execute();

            return true;
        } else{
            return false;
        }
    }

    public function getNome($email){
        $sql = "SELECT nome FROM contatos WHERE email = :email";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetch();

            return $data['nome'];
        } else{
            return '';
        }
    }

    public function getAll(){
        $sql = "SELECT * FROM contatos";
        $sql = $this->pdo->query($sql);

        if($sql->rowCount() > 0){
            return $sql->fetchAll()
        } else{
            return array();
        }
    }

    private function exiteEmail($email){

    }
}

?>