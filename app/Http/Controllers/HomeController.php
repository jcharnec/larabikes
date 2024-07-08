<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware(['auth', 'verified']);
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Obtén el usuario autenticado
        $user = Auth::user();

        $bikes = bike::paginate(10);

        return view('home', [
            'users' => $user,
            'bikes' => $bikes,
        ]);
    }
}
