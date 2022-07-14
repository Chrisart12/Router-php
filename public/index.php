<?php

require __DIR__. "./../vendor/autoload.php";

// Permet de gerer les fichier .env
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();



// dd(config('app'));
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

$router->map('GET', '/post', 'App\Http\Controllers\PostController#index', 'post.index');
$router->map('GET', '/post/[i:id]', 'App\Http\Controllers\PostController#show', 'post.show');
$router->map('GET', '/post/create', 'App\Http\Controllers\PostController#create', 'post.create');
$router->map('POST', '/post/store', 'App\Http\Controllers\PostController#store', 'post.store');
$router->map('GET', '/post/[i:id]/edit', 'App\Http\Controllers\PostController#edit', 'post.edit');
$router->map('POST', '/post/[i:id]/update', 'App\Http\Controllers\PostController#update', 'post.update');
$router->map('POST', '/post/[i:id]/destroy', 'App\Http\Controllers\PostController#destroy', 'post.destroy');


// $router->map('GET', '/article/[*:slug]-[i:id]', function() {
//     require resource_path(). "views/blog/article.php";
// }, 'article');

$match = $router->match();

list( $controller, $action ) = explode( '#', $match['target'] );

if ( is_callable(array($controller, $action)) ) {
    $obj = new $controller();
    call_user_func_array(array($obj,$action), $match['params']);
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