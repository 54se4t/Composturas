<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'trabajadores';
    protected $primaryKey = 'TID';
    protected $fillable = [
        'email','nombre','apellidos','password','permiso'
    ];
}
