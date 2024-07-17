<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;

class AdminController extends Controller
{
    public function deletedBikes()
    {
        //recupera las motos
        $bikes = Bike::onlyTrashed()->paginate(config('pagination.bikes', 10));

        //carga la vista
        return view('admin.bikes.deleted', ['bikes' => $bikes]);
    }
}
