<?php

require __DIR__. "./../vendor/autoload.php";

// Permet de gerer les fichier .env
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

dd("eeeeee");
// Permet d'afficher un joli debug
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


$router = new AltoRouter();



ob_start();

// $router->map('GET', '/', function() {
//     require resource_path().'views/home.php';
// }, 'home');

$router->map('GET', '/blog', function() {
    require resource_path(). "views/blog/index.php";
}, 'blog');

$router->map('GET', '/contact', function() {
    require resource_path(). "views/contact.php";
}, 'contact');

$router->map('GET', '/articles', function() {
    require resource_path(). "views/blog/articles.php";
}, 'articles');

$router->map('GET', '/article/[i:id]', function($id) {
    require resource_path(). "views/blog/article.php";
    
}, 'article');

$router->map('GET', '/', 'App\Http\Controllers\HomeController#index', 'home');

$router->map('GET', '/post', 'App\Http\Controllers\PostController#index', 'post');


// $router->map('GET', '/article/[*:slug]-[i:id]', function() {
//     require resource_path(). "views/blog/article.php";
// }, 'article');

$match = $router->match();

list( $controller, $action ) = explode( '#', $match['target'] );

if ( is_callable(array($controller, $action)) ) {
    $obj = new $controller();
    call_user_func_array(array($obj,$action), array($match['params']));
} else if ($match['target']==''){
    echo 'Error: no route was matched'; 
    //possibly throw a 404 error
} else {
    echo 'Error: can not call '.$controller.'#'.$action; 
    //possibly throw a 404 error
}

// // call closure or throw 404 status
// if( is_array($match) && is_callable( $match['target'] ) ) {
// 	call_user_func_array( $match['target'], $match['params'] ); 
// } else {
// 	// no route was matched
// 	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
//     require resource_path().'views/errors/404.php';
// }

// if (is_array($match)) {
//     call_user_func_array($match['target'], $match['params']);
//     // $match['target']();
// } else {
//     header("HTTP/1.0 404 Not Found");
//     require resource_path().'views/errors/404.php';
// }


$content =  ob_get_clean();
require resource_path().'views/layouts/app.php';

?>