<?php

function controller($matchedUri)
{
    [$controller, $method] = explode('@', array_values($matchedUri)[0]);
    if(class_exists($controller)){
        var_dump("existe");
        die();
    }else {
        var_dump("nao existe");
        die();
    }
}