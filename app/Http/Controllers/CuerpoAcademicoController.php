<?php

namespace App\Http\Controllers;

use App\Models\CuerpoAcademico;
use App\Models\CuerpoAcademicoProfesor;
use App\Models\Profesor;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Request as PostRequest;
use Inertia\Inertia;
use Illuminate\Validation\Rule;

class CuerpoAcademicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $param = PostRequest::get('search');
        $param = ($param == NULL) ? ($param = '') : $param;
        $totalItems = CuerpoAcademico::all()->count();
        $all = CuerpoAcademico::           
            orderBy('nombre','asc')
            ->paginate(50);
        
        return Inertia::render('CuerposAcademicos/Index',
        [
            'all' => $all,
            'totalItem' => $totalItems,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profesores = Profesor::orderBy('nombre','asc')->get();
        return Inertia::render('CuerposAcademicos/Add',
        [
            'all' => $profesores,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [            
                'nombre' => 'required|string|unique:cuerpos_academicos',
                'profesores' => 'required'
            ],
            [
                'nombre.required' => 'El nombre es requerido',
                'nombre.unique' => 'El nombre ya se encuentra registrado',
                'profesores.required' => 'El profesor es requerido',
            ]
        );
        $cuerpo_academico = CuerpoAcademico::create(
            [
                'nombre' => $request->nombre
            ]
        );
//return $request->profesores;
        foreach ($request->profesores as $key) {
            CuerpoAcademicoProfesor::create(
                [
                    'profesor_id' => $key['id'],
                    'cuerpo_academico_id' => $cuerpo_academico->id
                ]
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CuerpoAcademico $cuerpoAcademico)
    {
        return Inertia::render('CuerposAcademicos/Show',
        [
            'cuerpo_academico' => $cuerpoAcademico,
            'profesores' => CuerpoAcademico::with('profesores.carreras')->with('profesores.grados')->with('profesores.sni')->with('profesores.campus')->with('profesores.categoria')->find($cuerpoAcademico->id),
            'proyectos' => $cuerpoAcademico->proyecto
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CuerpoAcademico $cuerpoAcademico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CuerpoAcademico $cuerpoAcademico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CuerpoAcademico $cuerpoAcademico)
    {
        //
    }
}
