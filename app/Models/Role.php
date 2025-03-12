<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Si la tabla de roles tiene un nombre diferente, agrégalo aquí
    // protected $table = 'roles'; 
    public function users()
{
    return $this->belongsToMany(User::class);
}

}

