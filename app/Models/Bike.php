<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bike extends Model
{
    use HasFactory, SoftDeletes;

    //campos de la BDD en los que se permite la asignación masiva
    protected $fillable = [
        'marca', 'modelo', 'kms', 'precio', 'imagen',
        'user_id', 'matriculada', 'matricula', 'color'
    ];

    public static function recent(int $number=1){
        return self::whereNotNull('imagen')
                    ->latest()
                    ->limit($number)
                    ->get();
    }
    
    //retorna el usuario propietario de la moto
    public function user(){
        return $this->belongsTo(User::class);
    }
}
