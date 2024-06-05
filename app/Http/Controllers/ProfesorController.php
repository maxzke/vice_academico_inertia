<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use App\Models\Campus;
use App\Models\Carrera;
use App\Models\Categoria;
use App\Models\Grado;
use App\Models\Sni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as PostRequest;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
// use Inertia\Response;
// use Illuminate\Http\RedirectResponse;

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
        $all = Profesor::with('campus')
            ->with('categoria')
            ->with('sni')
            ->with(['carreras' => fn($query) => $query->orderBy('fecha','desc')])
            ->with(['grados' => fn($query) => $query->orderBy('id','desc')])
            ->where('nombre', 'like','%'.$param.'%')
            ->orderBy('nombre','asc')
            ->paginate(50);
        
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
        $grados = Grado::all();

        return Inertia::render('Profesores/Add',
        [
            'campus' => $campus,
            'snis' => $snis,
            'categorias' => $categorias,
            'carreras' => $carreras,
            'grados' => $grados
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
                'carrera_id'=> 'required',
                'grado_id'=> 'required'
            ],
            [
                'nombre.required' => 'es requerido',
                'sexo.required' => 'es requerido',
                'nombre.unique' => 'ya se encuentra registrado',
                'campus_id.required' => 'es requerido',
                'sni_id.required' => 'es requerido',
                'categoria_id.required' => 'es requerida',
                'carrera_id.required' => 'es requerida',
            ]
        );
        $profesor_saved = Profesor::create(
            [
                'nombre' => $request->nombre,
                'sexo' => $request->sexo,
                'ingreso' => $request->ingreso,
                'campus_id' => $request->campus_id,
                'sni_id' => $request->sni_id,
                'categoria_id' => $request->categoria_id
            ]
        );
        try {
            $profesor = Profesor::find($profesor_saved->id);
            $profesor->carreras()->attach($request->carrera_id['id'],
                    [
                        'fecha' => $request->fecha,
                    ]
            );
            $profesor->grados()->attach($request->grado_id,
        [
            'fecha' => $request->fecha_grado,
        ]);
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
        $volver_url = url()->previous();
        return Inertia::render('Profesores/Show',
        [
            'profesor' => $profesor,
            'campus' => $profesor->campus,
            'snis' => $profesor->sni,
            'categorias' => $profesor->categoria,
            'carreras' => $profesor->carreras,
            'grados' => $profesor->grados,
            'volver_url' => $volver_url
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profesor $profesor)
    {
        $campus = Campus::all();
        $snis= Sni::all();
        $categorias= Categoria::all();
        $carreras= Carrera::all();
        $grados = Grado::all();
        $volver_url = url()->previous();
        //$profesorConCarreras = Profesor::with(['carreras' => fn($query) => $query->orderBy('id','desc')])->with('grados')->find($profesor->id);
        $profesorConCarreras = Profesor::with('carreras')->with('grados')->find($profesor->id);
        return Inertia::render('Profesores/Edit',
        [
            'profesor' => $profesorConCarreras,
            'campus' => $campus,
            'snis' => $snis,
            'categorias' => $categorias,
            'carreras' => $carreras,
            'grados' => $grados,
            'volver_url' => $volver_url
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profesor $profesor)
    {
        switch ($request->type) {
            case 'profesor':
                $profesor->update(
                    $request->validate(
                        [            
                            'nombre' => ['required', 'string', Rule::unique('profesores')->ignore($profesor->id)],
                            'sexo'=> 'required|string',
                            'campus_id'=> 'required',
                            'sni_id'=> 'required',
                            'categoria_id'=> 'required',
                        ],
                        [
                            'nombre.required' => 'es requerido',
                            'nombre.unique' => 'ya se encuentra registrado',
                            'campus_id.required' => 'es requerido',
                            'sni_id.required' => 'es requerido',
                            'categoria_id.required' => 'es requerida',
                        ]
                    )
                );
                return back()->with(['success'=> true]);
                break;
            case 'adscripcion':
                $request->validate(
                    [            
                        'fecha_adscripcion' => 'required',
                        'carrera_id' => 'required'
                    ]
                    );
                try {
                    $profesor->carreras()->attach($request->carrera_id['id'],
                            [
                                'fecha' => $request->fecha_adscripcion,
                            ]
                    );
                    return back()->with(['success'=> true]);
                } catch (\Throwable $th) {
                    //throw $th;
                    return back()->withErrors(['error'=> 'ya se encuentra registrado en la carrera']);
                }   
                break;
            case 'promocion':
                $request->validate(
                        [            
                            'fecha_grado' => 'required',
                            'grado_id' => 'required'
                        ]
                        );
                try {
                    
                    $profesor->grados()->attach($request->grado_id,
                            [
                                'fecha' => $request->fecha_grado,
                            ]
                    );
                    return back()->with(['success'=> true]);
                } catch (\Throwable $th) {
                    //throw $th;
                    return back()->withErrors(['error'=> 'ya se encuentra registrado en la carrera']);
                }   
                break;
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profesor $profesor)
    {
        //
    }
}
