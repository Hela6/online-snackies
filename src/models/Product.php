<?php

namespace src\models;

use core\BaseModel;

class Product extends BaseModel
{
    public function __construct()
    {
        $this->table = "products";
        $this->getConnection();
    }

    public function count()
    {
        // Faire une requête SQL pour récupérer le nombre total d'entrées dans la table
        $sql = "SELECT COUNT(*) FROM $this->table";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        $totalInTable = $query->fetchColumn();
        return $totalInTable;
    }

    public function insertInDb()
    {
        if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['quantity'])) {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];

            // Insérer les infos du produit dans la base de données
            $sql = "INSERT INTO $this->table (name, price, quantity) VALUES (:name, :price, :quantity)";
            $query = $this->_connexion->prepare($sql);
            $query->bindValue(':name', $name);
            $query->bindValue(':price', $price);
            $query->bindValue(':quantity', $quantity);
            $query->execute();
        }
    }

    // Modifier la quantité en base de données
    public function changeQuantity($id, $amount)
    {
        // Mettre à jour la quantité du produit dans la base de données
        $sql = "UPDATE $this->table SET quantity = quantity + $amount WHERE id= $id";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
    }

    public function updateInDb($data)
    {
        $id = $data['id'];
        $name = $data['name'];
        $price = $data['price'];
        $quantity = $data['quantity'];

        // mettre à jour les infos du produit dans la base de données
        $sql = "UPDATE $this->table SET name = :name, price = :price, quantity = :quantity WHERE id = :id";
        $query = $this->_connexion->prepare($sql);
        $query->bindValue(':id', $id);
        $query->bindValue(':name', $name);
        $query->bindValue(':price', $price);
        $query->bindValue(':quantity', $quantity);
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
