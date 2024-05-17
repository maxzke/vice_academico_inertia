<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CobradorExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function view(): View
    {        
        return view('reporte-cobradores', [
            'data' => $this->data
        ]);
    }
}
