<?php

namespace src\models;

use core\BaseModel;
use PDO;

class Employee extends BaseModel
{
    public function __construct()
    {
        $this->table = "employees";
        $this->getConnection();
    }

    public function checkCredentials($email, $password, $checkAdmin = true)
    {
        // Faire une requête SQL pour récupérer les infos de login dans la base de données AND is_admin=1
        if ($checkAdmin == true) {
            $sql = "SELECT * FROM $this->table WHERE email = :email AND is_admin=1";
        } else {
            $sql = "SELECT * FROM $this->table WHERE email = :email";
        }
        $query = $this->_connexion->prepare($sql);
        $query->bindValue(':email', $email);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        // Vérifier si l'utilisateurice a été trouvé.e et si le mot de passe est correct
        if ($user && password_verify($password, $user['password'])) {

            // L'utilisateurice est authentifié.e avec succès
            return $user;
        } else {
            // L'authentification a échoué
            return false;
        }
    }

    public function getOneByEmail($email)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE email= :email";

        $query = $this->_connexion->prepare($sql);
        $query->bindValue(':email', $email);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function insertInDb()
    {
        if (isset($_POST['name']) && isset($_POST['credits']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['is_admin'])) {
            $name = $_POST['name'];
            $credits = $_POST['credits'];
            $email = $_POST['email'];
            $password = password_hash(($_POST['password']), PASSWORD_DEFAULT);
            $is_admin = $_POST['is_admin'];

            // Insérer les infos salarié.e dans la base de données
            $sql = "INSERT INTO $this->table (name, credits, email, password, is_admin) VALUES (:name, :credits, :email, :password, :is_admin)";
            $query = $this->_connexion->prepare($sql);
            $query->bindValue(':name', $name);
            $query->bindValue(':credits', $credits);
            $query->bindValue(':email', $email);
            $query->bindValue(':password', $password);
            $query->bindValue(':is_admin', $is_admin);
            $query->execute();
        }
    }

    // Modifier la quantité en base de données
    public function changeCredits($id, $amount)
    {
        // Mettre à jour la quantité de crédits dans la base de données
        $sql = "UPDATE $this->table SET credits = credits + $amount WHERE id= $id";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
    }

    public function updateInDb($data)
    {
        $id = $data['id'];
        $name = $data['name'];
        $credits = $data['credits'];
        $email = $data['email'];
        $is_admin = $_POST['is_admin'];

        // mettre à jour les infos salarié.e dans la base de données
        $sql = "UPDATE $this->table SET name = :name, credits = :credits, email = :email, is_admin = :is_admin WHERE id = :id";
        $query = $this->_connexion->prepare($sql);
        $query->bindValue(':id', $id);
        $query->bindValue(':name', $name);
        $query->bindValue(':credits', $credits);
        $query->bindValue(':email', $email);
        $query->bindValue(':is_admin', $is_admin);
        $query->execute();
    }

    public function deleteInDb($id)
    {
        // supprimer la ligne du produit dans la base de données
        $sql = "DELETE FROM $this->table WHERE id= $id";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
    }
}
