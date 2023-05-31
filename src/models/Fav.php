<?php

namespace src\models;

use core\BaseModel;

class Fav extends BaseModel
{
    public function __construct()
    {
        $this->table = "favs";
        $this->getConnection();
    }

    public function insertInDb($id_employee, $id_product)
    {
        // Insérer les infos du nouveau favori dans la base de données
        $sql = "INSERT INTO $this->table (id_employee, id_product) VALUES (:id_employee, :id_product)";
        $query = $this->_connexion->prepare($sql);
        $query->bindValue(':id_employee', $id_employee);
        $query->bindValue(':id_product', $id_product);
        $query->execute();
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

    public function deleteInDb($id)
    {
        // supprimer la ligne du produit dans la base de données
        $sql = "DELETE FROM $this->table WHERE id= $id";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
    }
}
