<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;
    protected $table = 'profesores';
    protected $fillable = [
        'campus_id',
        'sni_id',
        'categoria_id',
        'nombre',
        'apellido_p',
        'apellido_m',
        'ingreso',
        'sexo',
    ];

    public function carreras(){
        return $this->belongsToMany(Carrera::class)->withPivot('fecha');                                                     
    }
    public function grados(){
        return $this->belongsToMany(Grado::class)->withPivot('fecha');
    }
    public function campus(){
        return $this->belongsTo(Campus::class);
    }
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }
    public function sni(){
        return $this->belongsTo(Sni::class);
    }

    protected function nombre(): Attribute
    {
        return Attribute::make(
            //get: fn (string $value) => strtolower($value),
            set: fn (string $value) => strtolower($value),
        );
    }
}
