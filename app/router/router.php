<?php

// caminhos dentro site
function routes()
{
    //pega o arquivo de rotas
   return require 'routes.php';
}
function exactMatchUri($uri, $routes){
    //função que verifica a rota é a mesma do retorno do array
    if(array_key_exists($uri, $routes)){
        return [$uri => $routes[$uri]];
    }
    return [];
}
//consulta por uri

function regularExpressionMatchArrayRoutes($uri, $routes)
{
    //expressão regular
    return array_filter(
        $routes,
        function ($value) use ($uri){
            $regex = str_replace('/','\/', ltrim($value, '/'));
            return preg_match("/^$regex$/", ltrim($uri, '/'));
        },
        ARRAY_FILTER_USE_KEY
    );
}
function params($uri, $matchedUri)
{
    //o diff resgatar o usuario e id de usuario para que a comparação possa ser feita com a rota de navegação
    if(!empty($matchedUri)) {
        $matchToGetParams = array_keys($matchedUri)[0]; // recebe a chave dentro array
        return array_diff(
            //comparação a função definida com a da barra de pesquisa, coloca na string, e extra os elementos diferentes e joga no novo array
            $uri,
            explode('/', ltrim($matchToGetParams, '/'))
        );
    }
    return [];
}
function FormParams($uri, $params)
{
    $paramsData = [];
    foreach ($params as $index => $param){
        $paramsData[$uri[$index - 1]]= $param;
    }
    return $paramsData;
}
function router()
{
    //rota fixas
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $routes = routes();
    $matchedUri = exactMatchUri($uri, $routes);
    //rota dinamica
    if(empty($matchedUri)){
        //separar por expressão regular
        $matchedUri = regularExpressionMatchArrayRoutes($uri,$routes);
        $uri = explode('/', ltrim($uri,$routes));
        //resultado dos parametros
        $params = params($uri, $matchedUri);
        $params = FormParams($uri, $params);
    }
    //se encontrou a rota exata ou dinamica o resultado ficará aqui
    if(!empty($matchedUri)){
        controller($matchedUri);
        return;
    }
    throw new Exception("ops");

}
