<?php
    if(!function_exists('app_path')) {
        function app_path(){
            return dirname($_SERVER['DOCUMENT_ROOT']);
        }
    }

    if(!function_exists('public_path')) {
        function public_path(){
            return $_SERVER['DOCUMENT_ROOT'];
        }
    }

    if(!function_exists('asset')) {
        function asset($path){
            return "http://localhost:8000/" . $path;
        }
    }

    if(!function_exists('resource_path')) {
	
        function resource_path()
        {
            return dirname($_SERVER['DOCUMENT_ROOT']).'/resources/' ;
        }
    }

    if(!function_exists('view')) {
	
        function view($path, $data = null)
        {
            if ( $data) {
                foreach ($data as $key => $value) {
                    $$key = $value;
                }
            }
            
            // Permet de faire des remplacement du point par le slash
            $path = str_replace('.', '/', $path);
            return require dirname($_SERVER['DOCUMENT_ROOT']).'/resources/views/'.$path. '.php';
        }
    }

    if(!function_exists('config')) {
	
        function config($file)
        {
            $file_expode = explode('.', $file);
            
            $array = require dirname($_SERVER['DOCUMENT_ROOT']).'/config/' . $file_expode[0] .'.php';

            return $array[$file_expode[1]];
        }
    }

    if(!function_exists('env')) {
	
        function env($variable)
        {
            return $_ENV[$variable];
        }
    }

    if(!function_exists('url')) {
	
        function url($path)
        {
            // Permet de faire des remplacement du point par le slash
            $path = str_replace('.', '/', $path);
            return header('Location: '.'http://localhost:8000/' . $path);
        }
    }





?>