<?php 

require_once (__DIR__. '/../helpers/helpers.php');


$dns = $app_config['db_connection'].":host=".$app_config['db_host'].";dbname=".$app_config['db_name'].";chrset=utf8";
$user = $app_config['db_username'];
$password = $app_config['db_password'];

$db = new PDO(
        $dns,
        $user,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //Permet de lancer une exception en cas d'erreur
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ //Permet d'avoir toujours des objets au lieu d'un tableau
        ]
    );

