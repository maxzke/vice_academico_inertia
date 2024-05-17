<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuarpoAcademicoProfesor extends Model
{
    use HasFactory;
    protected $table = 'cuerpo_academico_profesor';
    protected $fillable = [
        'profesor_id',
        'cuerpo_academico_id',
    ];
}
