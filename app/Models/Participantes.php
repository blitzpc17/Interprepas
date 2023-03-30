<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participantes extends Model
{
    use HasFactory;

    protected $table = 'participantes';
    public $timestamps = false;
    protected $fillable = ['Apellidos', 'Nombres', 'PreparatoriaId', 'Foto', 'Sexo'];
}
