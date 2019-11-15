<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); // Verifica se o usuário está logado ou não
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}


/*
Middlewares: Dentro de aplicações web, ele é um código ou programa que é executado entre
a requisição(Request) e a nossa aplicação (é a lógica executado pelo acesso a uma determinada rota)

Request -> Middleware -> Aplicação (Acesso qualquer rota) <- Marketplace

*/


















