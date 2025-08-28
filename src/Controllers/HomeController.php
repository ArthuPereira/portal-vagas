<?php

namespace App\Controllers;

use App\Utils\Render;

class HomeController
{
    public function index()
    {
        Render::load("home", [
            "title" => "Título",
            "message" => "Isso foi um exemplo base do projeto"
        ]);
    }
}
