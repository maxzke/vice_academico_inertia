<?php

namespace App\Http\Controllers;

use App\Models\CuerpoAcademico;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CuerpoAcademico $cuerpoAcademico)
    {
        //
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
