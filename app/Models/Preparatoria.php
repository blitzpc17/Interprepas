<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preparatoria extends Model
{
    use HasFactory;
    protected $table = 'preparatorias';
    public $timestamps = false;
    protected $fillable = ['Nombre', 'Alias', 'Region', 'Logo'];

}
