<?php 

namespace Database;

use PDO;

class DBConnection 
{
    private $pdo;

    private static $_instance = null;

    public function __construct()
    {
        $this->pdo = new PDO(
            config('app.db_connection').":host=".config('app.db_host').";dbname=".config('app.db_name').";chrset=utf8",
            config('app.db_username'),
            config('app.db_password'),
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //Permet de lancer une exception en cas d'erreur
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ //Permet d'avoir toujours des objets au lieu d'un tableau
            ]
        );
    }

    /**
     * Permet d'avoir une seule instance de la classe
     *
     * @return void
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new DBConnection();
        }

        return self::$_instance;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getPdo()
    {
        return $this->pdo;
    }
}