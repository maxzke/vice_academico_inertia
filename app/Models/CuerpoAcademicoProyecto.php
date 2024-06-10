<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuerpoAcademicoProyecto extends Model
{
    use HasFactory;
    protected $table = 'cuerpo_academico_proyecto';
    protected $fillable = [
        'proyecto_id',
        'cuerpo_academico_id',
    ];
}
