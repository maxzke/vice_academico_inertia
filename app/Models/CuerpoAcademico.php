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

    public function profesores(){
        return $this->belongsToMany(Profesor::class);
    }
    public function proyectos(){
        return $this->hasMany(Proyecto::class);
    }
}
