<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactData extends Model{
    protected $fillable = ['movil', 'fijo', 'direccion', 'user_id'];
}