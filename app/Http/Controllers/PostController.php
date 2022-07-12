<?php

namespace App\Http\Controllers;

use PDO;
use Database\DBConnection;

class PostController 
{
    private $pdo;

    public $error = null;

    public function __construct()
    {   
        $this->pdo = DBConnection::getInstance()->getPdo();
    }

    public function index()
    {
    
        try {
            $resultQuery = "SELECT * FROM posts";
    
            // Préparation de la requête
            $pdoStatement = $this->pdo->prepare($resultQuery);

            // J'assigne un fetch mode classe pour avoir les objets de type poste au lieur d'un stdclass
            $pdoStatement->setFetchMode(PDO::FETCH_CLASS, "App\Models\Post"); 
            $pdoStatement->execute();
    
            $posts = $pdoStatement->fetchAll();
    
        } catch (PDOException $e) {
            
            $this->error = $e->getMessage();
        }

        return view("post.index");
        // require resource_path(). "views/blog/articles.php";
    }
}