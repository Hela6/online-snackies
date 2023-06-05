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

    public function deleteInDb($id_employee, $id_product)
    {
        // supprimer la ligne du produit dans la base de données
        $sql = "DELETE FROM $this->table WHERE (id_employee = :id_employee) AND (id_product = :id_product)";
        $query = $this->_connexion->prepare($sql);
        $query->bindValue(':id_employee', $id_employee);
        $query->bindValue(':id_product', $id_product);
        $query->execute();
    }
}
