<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuerpoAcademico extends Model
{
    use HasFactory;
    protected $table = 'cuerpos_academicos'; 
    protected $fillable = [
        'nombre',
    ];
}
