<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use App\Models\Campus;
use App\Models\Carrera;
use App\Models\Categoria;
use App\Models\Sni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as PostRequest;
use Inertia\Inertia;
use Illuminate\Validation\Rule;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $param = PostRequest::get('search');
        $param = ($param == NULL) ? ($param = '') : $param;
        $totalItems = Profesor::all()->count();
        $all = Profesor::where('nombre', 'like','%'.$param.'%')->orderBy('nombre','asc')->paginate(50);
        
        return Inertia::render('Profesores/Index',
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
        $campus = Campus::all();
        $snis= Sni::all();
        $categorias= Categoria::all();
        $carreras= Carrera::all();

        return Inertia::render('Profesores/Add',
        [
            'campus' => $campus,
            'snis' => $snis,
            'categorias' => $categorias,
            'carreras' => $carreras
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [            
                'nombre' => 'required|string|unique:profesores',
                'sexo'=> 'required|string',
                'campus_id'=> 'required',
                'sni_id'=> 'required',
                'categoria_id'=> 'required',
                'carrera_id'=> 'required'
            ],
            [
                'nombre.required' => 'El nombre es requerido',
                'nombre.unique' => 'El nombre ya se encuentra registrado',
                'campus_id.required' => 'El campus es requerido',
                'sni_id.required' => 'El sni es requerido',
                'categoria_id.required' => 'La categoria es requerida',
                'carrera_id.required' => 'La carrera es requerida',
            ]
        );
        $profesor_saved = Profesor::create(
            [
                'nombre' => $request->nombre,
                'sexo' => $request->sexo,
                'campus_id' => $request->campus_id,
                'sni_id' => $request->sni_id,
                'categoria_id' => $request->categoria_id
            ]
        );
        try {
            $profesor = Profesor::find($profesor_saved->id);
            $profesor->carreras()->attach($request->carrera_id,
                    [
                        'fecha' => $request->fecha,
                    ]
            );
            return back()->with(['success'=> true]);
        } catch (\Throwable $th) {
            //throw $th;
            return back()->withErrors(['error'=> 'ya se encuentra registrado en la carrera']);
        }   
    }

    /**
     * Display the specified resource.
     */
    public function show(Profesor $profesor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profesor $profesor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profesor $profesor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profesor $profesor)
    {
        //
    }
}
