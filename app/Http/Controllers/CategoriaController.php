<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as PostRequest;
use Inertia\Inertia;
use Illuminate\Validation\Rule;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $param = PostRequest::get('search');
        $param = ($param == NULL) ? ($param = '') : $param;
        $totalItems = Categoria::all()->count();
        $all = Categoria::where('nombre', 'like','%'.$param.'%')->orderBy('nombre','asc')->paginate(50);
        
        return Inertia::render('Categorias/Index',
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
                'nombre' => 'required|string|unique:categorias'
            ],
            [
                'nombre.required' => 'El nombre es requerido',
                'nombre.unique' => 'El nombre ya se encuentra registrado',
            ]
        );
        Categoria::create(
            [
                'nombre' => $request->nombre
            ]
        );
        return back()->with(['success'=> true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        return Inertia::render('Categorias/Show',
        [
            'item' => $categoria,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate(
            [            
                'nombre' => ['required','string',Rule::unique('categorias')->ignore($categoria->id)]
            ],
            [
                'nombre.required' => 'El nombre es requerido',
                'nombre.unique' => 'El nombre ya se encuentra registrado',
            ]
        );
        $categoria->nombre = $request->nombre;
        $categoria->saveOrFail();
        return back()->with(['success'=> true]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {        
        if ( $categoria->profesores()->count() > 0) {
            return back()->withErrors(['error'=> 'Tiene profesores asignados']); 
        }else{
            $categoria->delete();
            return to_route('categorias.index');
        }
    }
}
