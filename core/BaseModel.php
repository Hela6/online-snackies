<?php

namespace core;

use PDO;
use PDOException;

abstract class BaseModel
{

    // Ajoutez à votre classe des propriétés privées : host, db_name, username, password. Une propriété protégée _connexion, et deux propriétés publiques table et id.
    private $host = "localhost";
    private $db_name = "online_snackies";
    private $username = "root";
    private $password = "";
    protected $_connexion;
    public $table;
    public $id;



    public function getConnection()
    {
        // On supprime la connexion précédente
        $this->_connexion = null;

        // On essaie de se connecter à la base avec PDO
        try {
            $this->_connexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->_connexion->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    public function getOne($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id=" . $id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM " . $this->table;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
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
}
