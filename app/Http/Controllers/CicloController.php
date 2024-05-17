<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as PostRequest;
use Inertia\Inertia;
use Illuminate\Validation\Rule;

class CicloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $param = PostRequest::get('search');
        $param = ($param == NULL) ? ($param = '') : $param;
        $totalItems = Ciclo::all()->count();
        $all = Ciclo::where('nombre', 'like','%'.$param.'%')->orderBy('nombre','asc')->paginate(50);
        
        return Inertia::render('Ciclos/Index',
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [            
                'nombre' => 'required|string|unique:ciclos'
            ],
            [
                'nombre.required' => 'El nombre es requerido',
                'nombre.unique' => 'El nombre ya se encuentra registrado',
            ]
        );
        Ciclo::create(
            [
                'nombre' => $request->nombre
            ]
        );
        return back()->with(['success'=> true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ciclo $ciclo)
    {
        return Inertia::render('Ciclos/Show',
        [
            'item' => $ciclo,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ciclo $ciclo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ciclo $ciclo)
    {
        $request->validate(
            [            
                'nombre' => ['required','string',Rule::unique('ciclos')->ignore($ciclo->id)]
            ],
            [
                'nombre.required' => 'El nombre es requerido',
                'nombre.unique' => 'El nombre ya se encuentra registrado',
            ]
        );
        $ciclo->nombre = $request->nombre;
        $ciclo->saveOrFail();
        return back()->with(['success'=> true]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ciclo $ciclo)
    {        
        if ( $ciclo->planes_de_estudios()->count() > 0) {
            return back()->withErrors(['error'=> 'Tiene planes de estudio asignados']); 
        }else{
            $ciclo->delete();
            return to_route('ciclos.index');
        }
    }
}
