<?php

namespace App\Controllers;

use App\Core\RenderView;

class HomeController
{
    public function index()
    {
        RenderView::loadView('home', [
            'title' => 'Página inicial',
            'message' => 'Seja bem vindo ao meu site!!!' 
        ]);
    }
}