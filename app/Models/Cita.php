<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'citas';
    protected $primaryKey = 'CID';
    protected $fillable = [
        'UID','TID','descripcion','estado', 'tiempo_visita', 'tiempo_recogida'
    ];
}
