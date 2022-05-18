<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'clientes';
    protected $primaryKey = 'UID';
    protected $fillable = [
        'email','nombre','apellidos','password'
    ];
}