<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as PostRequest;
use Inertia\Inertia;
use Illuminate\Validation\Rule;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $param = PostRequest::get('search');
        $param = ($param == NULL) ? ($param = '') : $param;
        $totalItems = Campus::all()->count();
        $all = Campus::where('nombre', 'like','%'.$param.'%')->orderBy('nombre','asc')->paginate(50);
        
        return Inertia::render('Campus/Index',
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
                'nombre' => 'required|string|unique:campus'
            ],
            [
                'nombre.required' => 'El nombre es requerido',
                'nombre.unique' => 'El nombre ya se encuentra registrado',
            ]
        );
        Campus::create(
            [
                'nombre' => $request->nombre
            ]
        );
        return back()->with(['success'=> true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Campus $campus)
    {
        return Inertia::render('Campus/Show',
        [
            'item' => $campus,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campus $campus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Campus $campus)
    {
        $request->validate(
            [            
                'nombre' => ['required','string',Rule::unique('campus')->ignore($campus->id)]
            ],
            [
                'nombre.required' => 'El nombre es requerido',
                'nombre.unique' => 'El nombre ya se encuentra registrado',
            ]
        );
        $campus->nombre = $request->nombre;
        $campus->saveOrFail();
        return back()->with(['success'=> true]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campus $campus)
    {        
        if ( $campus->profesores()->count() > 0) {
            return back()->withErrors(['error'=> 'Tiene profesores asignados']); 
        }else{
            $campus->delete();
            return to_route('campus.index');
        }
    }
}
