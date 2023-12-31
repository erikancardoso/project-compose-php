<?php

require 'bootstrap.php';

try {
    router();
    var_dump(VIEWS); //raiz do projeto
}catch (Exception $e){
    var_dump($e -> getMessage());
}
