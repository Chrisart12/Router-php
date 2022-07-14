<?php

namespace App\Http\Controllers;

use PDO;
use App\Models\Post;
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
            $blogs = $pdoStatement->fetchAll();
    // dd("rrrr",compact('posts'));
        } catch (PDOException $e) {
            
            $this->error = $e->getMessage();
        }

        return view("post.index", compact('posts', 'blogs'));
        // require resource_path(). "views/blog/articles.php";
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function create()
    {
        return view("post.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        if (isset($_POST['author']) && isset($_POST['title']) && isset($_POST['description'])) {

            if ($_POST['author'] && $_POST['title'] && $_POST['description']) {
            
                $postQuery = "INSERT INTO posts (author, title, description, created_at) VALUE(:author, :title, :description, :created_at)";

                // Préparation de la requête
                $pdoStatement = $this->pdo->prepare($postQuery);
                
                $pdoStatement->bindValue(':author', $_POST['author'], PDO::PARAM_STR);
                $pdoStatement->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
                $pdoStatement->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
                $pdoStatement->bindValue(':created_at', date("Y-m-d H:i:s"));
        
                $result = $pdoStatement->execute();

                return url('post');

            } else {
               
                return url('post.create');
            }
        
        } else {
        
            return url('post.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        if ($id) {
            try {
                $resultQuery = "SELECT * FROM posts WHERE id = :id";
        
                // Préparation de la requête
                $pdoStatement = $this->pdo->prepare($resultQuery);
            
                $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        
                $pdoStatement->execute();
        
                $post = $pdoStatement->fetch();
        
            } catch (PDOException $e) {
                $error = $e->getMessage();
            }

            return view("post.show", compact('post'));
        }
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id) {
            try {
                $resultQuery = "SELECT * FROM posts WHERE id = :id";
        
                // Préparation de la requête
                $pdoStatement = $this->pdo->prepare($resultQuery);
            
                $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        
                $pdoStatement->execute();
        
                $post = $pdoStatement->fetch();
        
            } catch (PDOException $e) {
                $error = $e->getMessage();
            }

            return view("post.edit", compact('post'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $id)
    {
        if ($id) {
            
            if (isset($_POST['id'] ) && isset($_POST['author']) && isset($_POST['title']) && isset($_POST['description'])) {
           
                if ($_POST['author'] && $_POST['title'] && $_POST['description']) {
                    
                    try {
            
                        $postQuery =  "UPDATE posts SET author= :author, title= :title, description= :description, created_at= :created_at WHERE id= :id LIMIT 1";
    
                        // Préparation de la requête
                        $pdoStatement = $this->pdo->prepare($postQuery);
                        
                        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT );
                        $pdoStatement->bindValue(':author', $_POST['author'], PDO::PARAM_STR);
                        $pdoStatement->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
                        $pdoStatement->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
                        $pdoStatement->bindValue(':created_at', date("Y-m-d H:i:s"));
                
                        $result = $pdoStatement->execute();
    
                        return url('post');
            
                    } catch (PDOException $e) {
                        $error = $e->getMessage();
                    }
            
                } else {
                    return url('post.create');
                }
            
            } else {
                return url('post.create');
            }
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        if ($id) {
                    
                try {
        
                    $postQuery = "DELETE FROM posts WHERE id= :id LIMIT 1";

                    // Préparation de la requête
                    $pdoStatement = $this->pdo->prepare($postQuery);
            
                    $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
                    
                    $result = $pdoStatement->execute();
            
                    return url('post');
                
                } catch (PDOException $e) {
                    $error = $e->getMessage();
                }
                    
        }
    }
}