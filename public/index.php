<?php

require __DIR__. "./../vendor/autoload.php";
// dd(dirname(public_path()).'/resources/views/layouts/app.php');
// $uri = str_replace("/", "", $_SERVER['REQUEST_URI']);

use App\Http\Controllers\PostController;

$router = new AltoRouter();




// $page = $_GET['page'] ?? '404';
// dump($page);
ob_start();

$router->map('GET', '/home', function() {
    require resource_path().'views/home.php';
}, 'home');

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

$router->map('GET', '/post/[a:"App\Http\Controllers\PostController"]/[a:"index"]', 'post');


// $router->map('GET', '/article/[*:slug]-[i:id]', function() {
//     require resource_path(). "views/blog/article.php";
// }, 'article');

$match = $router->match();

if (is_array($match)) {
    call_user_func_array($match['target'], $match['params']);
    // $match['target']();
} else {
    header("HTTP/1.0 404 Not Found");
    require resource_path().'views/errors/404.php';
}



// if ($uri === 'blogs') {
//     require  resource_path(). "views/blog/index.php";
// } elseif ($uri == 'article') {
//     require  resource_path(). "views/blog/article.php";
// } elseif($uri === 'contact') {
//     require resource_path(). "views/contact.php";
// } elseif($uri === 'home') {
//     require resource_path().'views/home.php';
// } else {
//     require resource_path().'views/errors/404.php';
// }
$content =  ob_get_clean();
require resource_path().'views/layouts/app.php';

?>