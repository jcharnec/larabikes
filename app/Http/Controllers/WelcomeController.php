<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;
use Illuminate\Support\Facades\View;

class WelcomeController extends Controller
{
    public function index()
    {
        // Recuperar las últimas 5 motos creadas que tienen imagen
        $bikes = Bike::whereNotNull('imagen')->latest()->take(5)->get();

        // Pasar las motos a la vista
        return view('welcome', ['bikes' => $bikes]);
    }

    public function showWelcome()
    {
        $bikes = Bike::take(4)->get();
        return view('welcome', compact('bikes'));
    }
}
