<?php
//precisa definir os caminhos aqui
return[
    '/' => 'Home@index',
    '/user/create' => 'User@create',
    '/user/[0-9]+' => 'User@create',
    '/user/[0-9]+/name/[a-z]+' => 'User@show',
];

