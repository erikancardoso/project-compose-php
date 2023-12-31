<?php
namespace app\controllers;

Class Home
{
    public function index($params)
    {
        return [
            'view' => 'home',
            'data' => [
                'name' => 'banana',
            ],
        ];
    }
}
