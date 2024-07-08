<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Models\Bike;
=======
>>>>>>> 4af95217f3ccd875b6e0aca51c59afc19648210b
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
<<<<<<< HEAD
        //$this->middleware(['auth', 'verified']);
=======
>>>>>>> 4af95217f3ccd875b6e0aca51c59afc19648210b
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

<<<<<<< HEAD
        $bikes = bike::paginate(10);

        return view('home', [
            'users' => $user,
            'bikes' => $bikes,
        ]);
=======
        return view('home', ['users' => $user]);
>>>>>>> 4af95217f3ccd875b6e0aca51c59afc19648210b
    }
}
