<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VendedorExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($data,$empleado)
    {
        $this->data = $data;
        $this->empleado = $empleado;
    }
    public function view(): View
    {        
        return view('reporte-vendedores', [
            'data' => $this->data,
            'empleado' => $this->empleado
        ]);
    }
}
