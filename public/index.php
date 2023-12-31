<?php

require 'bootstrap.php';

try {
    router();
    var_dump(ROOT); //raiz do projeto

}catch (Exception $e){
    var_dump($e -> getMessage());
}
