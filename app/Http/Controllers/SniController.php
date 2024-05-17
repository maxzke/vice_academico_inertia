<?php

namespace App\Http\Controllers;

use App\Models\Sni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as PostRequest;
use Inertia\Inertia;
use Illuminate\Validation\Rule;

class SniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $param = PostRequest::get('search');
        $param = ($param == NULL) ? ($param = '') : $param;
        $totalItems = Sni::all()->count();
        $all = Sni::where('nombre', 'like','%'.$param.'%')->orderBy('nombre','asc')->paginate(50);
        
        return Inertia::render('Sni/Index',
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
                'nombre' => 'required|string|unique:sni'
            ],
            [
                'nombre.required' => 'El nombre es requerido',
                'nombre.unique' => 'El nombre ya se encuentra registrado',
            ]
        );
        Sni::create(
            [
                'nombre' => $request->nombre
            ]
        );
        return back()->with(['success'=> true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sni $sni)
    {
        return Inertia::render('Sni/Show',
        [
            'item' => $sni,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sni $sni)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sni $sni)
    {
        $request->validate(
            [            
                'nombre' => ['required','string',Rule::unique('sni')->ignore($sni->id)]
            ],
            [
                'nombre.required' => 'El nombre es requerido',
                'nombre.unique' => 'El nombre ya se encuentra registrado',
            ]
        );
        $sni->nombre = $request->nombre;
        $sni->saveOrFail();
        return back()->with(['success'=> true]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sni $sni)
    {        
        if ( $sni->profesores()->count() > 0) {
            return back()->withErrors(['error'=> 'Tiene profesores asignados']); 
        }else{
            $sni->delete();
            return to_route('sni.index');
        }
    }
}
