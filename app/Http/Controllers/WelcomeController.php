<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;
use Illuminate\Support\Facades\View;

class WelcomeController extends Controller{

    public function index(){
        return view('welcome');
    }
}