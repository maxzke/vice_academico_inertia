<?php

namespace App\Exports;

use App\Models\Articulo;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

//class ArticuloExport implements FromCollection
class ArticuloExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $articulos = Articulo::orderBy('nombre','asc')->get();
        return view('articulo-report', [
            'articulos' => $articulos
        ]);
    }
}
