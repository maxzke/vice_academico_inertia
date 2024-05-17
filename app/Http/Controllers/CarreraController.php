<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as PostRequest;
use Inertia\Inertia;
use Illuminate\Validation\Rule;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $param = PostRequest::get('search');
        $param = ($param == NULL) ? ($param = '') : $param;
        $totalItems = Carrera::all()->count();
        $all = Carrera::where('nombre', 'like','%'.$param.'%')->orderBy('nombre','asc')->paginate(50);
        
        return Inertia::render('Carreras/Index',
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
                'nombre' => 'required|string|unique:carreras'
            ],
            [
                'nombre.required' => 'El nombre es requerido',
                'nombre.unique' => 'El nombre ya se encuentra registrado',
            ]
        );
        Carrera::create(
            [
                'nombre' => $request->nombre
            ]
        );
        return back()->with(['success'=> true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Carrera $carrera)
    {
        return Inertia::render('Carreras/Show',
        [
            'item' => $carrera,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carrera $carrera)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carrera $carrera)
    {
        $request->validate(
            [            
                'nombre' => ['required','string',Rule::unique('carreras')->ignore($carrera->id)]
            ],
            [
                'nombre.required' => 'El nombre es requerido',
                'nombre.unique' => 'El nombre ya se encuentra registrado',
            ]
        );
        $carrera->nombre = $request->nombre;
        $carrera->saveOrFail();
        return back()->with(['success'=> true]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carrera $carrera)
    {        
        if ( $carrera->profesores()->count() > 0) {
            return back()->withErrors(['error'=> 'Tiene profesores asignados']); 
        }else{
            $carrera->delete();
            return to_route('carreras.index');
        }
    }
}
