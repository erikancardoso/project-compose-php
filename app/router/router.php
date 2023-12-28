<?php

function routes()
{
   return require 'routes.php';
}
function exactMatchUri($uri, $routes){
    //função que verifica a rota é a mesma do retorno do array
    if(array_key_exists($uri, $routes)){
        return [$uri => $routes[$uri]];
    }
    return [];
}

function router()
{
    //rota fixass
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $routes = routes();
    $matchedUri = exactMatchUri($uri, $routes);
    //rota dinamica
    if(empty($matchedUri)){
        $matchedUri = array_filter( //criar uma funcao
            $routes,
            function ($value) use ($uri){
                $regex = str_replace('/','\/', ltrim($value, '/'));
                return preg_match("/^$regex$/", ltrim($uri, '/'));
            },
            ARRAY_FILTER_USE_KEY
        );
    }
    var_dump($matchedUri);
    die();
}
