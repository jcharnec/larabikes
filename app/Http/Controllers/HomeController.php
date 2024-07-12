<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $bikes = $user->bikes()->paginate(10);
        $deleteBikes = $user->bikes()->onlyTrashed()->get();

        return view('home', [
            'users' => $user,
            'bikes' => $bikes,
            'deleteBikes' => $deleteBikes,
        ]);
    }
}

