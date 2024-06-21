<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    use HasFactory;

    //campos de la BDD en los que se permite la asignación masiva
    protected $fillable = ['marca', 'modelo', 'kms', 'precio', 'matriculada'];
}
