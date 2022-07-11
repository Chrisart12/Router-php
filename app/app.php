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


?>