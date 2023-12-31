<?php

function controller($matchedUri, $params)
{
    [$controller, $method] = explode('@', array_values($matchedUri)[0]); //string
    $controllerWithNameSpace = CONTROLLER_PATH.$controller; //verificar o caminho da classe
    if(!class_exists($controllerWithNameSpace)) { //verificando
        throw new Exception("controller {$controller} não existe");
    }

    //criando a instancia do controler
    $controllerInstance = new $controllerWithNameSpace; //pega o caminho e o nome para transformar em uma classe
    $controllerInstance-> $method($params); // acessando o metodo dele que é o index.
    //Class->$funcao como class.metodo
}
