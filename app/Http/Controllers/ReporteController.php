<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\Ruta;
use App\Models\Empleado;
use App\Models\NotaAbono;
use App\Models\Vehiculo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as PostRequest;
use Inertia\Inertia;
use Carbon\Carbon;
//Excel
use App\Exports\CobradorExport;
use App\Exports\VendedorExport;
use Maatwebsite\Excel\Facades\Excel;
class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $param = PostRequest::get('filtrar');
        switch ($param) {
            case 'vendedor':
                $listado = Empleado::where('tipo','cargador-chofer')->get();
                break;
            case 'cobrador':
                $listado = Empleado::where('tipo','cobrador')->get();
                break;
            case 'vehiculo':
                $listado = Vehiculo::all();
                break;
            default:
                $listado = [];
                break;
        }
        return Inertia::render('Reportes/index',
        [
    'listado' => $listado,
    ]
);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }
    public function reporte(){
        $type = PostRequest::get('tipo');
        $inicio = PostRequest::get('inicio');
        $fin = PostRequest::get('fin');
        $selected = PostRequest::get('selected');
        $todos = PostRequest::get('checked');
        //return $todos;
        $format_inicio = Carbon::createFromFormat('Y-m-d', $inicio)->format('d-m-y');
        $format_fin = Carbon::createFromFormat('Y-m-d', $fin)->format('d-m-y');
        if ($todos=='on') {
            switch ($type) {
                case 'cobrador':
                    /**
                     * Retorna vista ubicada en
                     * app / Exports / CobradorExport
                     */
                    
                    $data = NotaAbono::with('empleado')
                            ->with('nota.detalles.articulo')
                            ->whereBetween('fecha', [$inicio, $fin])
                            ->where('empleado_id','!=',NULL)
                            ->get();
                            if (count($data)>0) {
                                return Excel::download(new CobradorExport($data), 'Reporte Todos cobradores'.$format_inicio.' - '.$format_fin.'.xlsx');
                            }else {
                                return "No hay datos que mostrar";
                            }
                            
                    break;
                case 'vendedor':
                        //POR VEHICULO
                        $data =Ruta::with('empleados')
                        ->with('notas.detalles.articulo')
                        ->with('notas.abonos')
                        ->with('vehiculo')
                        ->whereBetween('fecha', [$inicio, $fin])
                        ->get()
                        ->groupBy('vehiculo_id');
                        //->get();
                        $empleado = Empleado::find($selected);
                        return $data;
                        if (count($data)>0) {
                            return Excel::download(new VendedorExport($data,'Todos'), 'Reporte Todos'.' '.$format_inicio.' - '.$format_fin.'.xlsx');
                        }else {
                            return "No hay datos que mostrar";
                        }
                    break;
                default:
                    # code...
                    break;
            }
        }
        else{
            switch ($type) {
                case 'cobrador':
                    /**
                     * Retorna vista ubicada en
                     * app / Exports / CobradorExport
                     */
                    $data = NotaAbono::with('empleado')
                            ->with('nota.detalles.articulo')
                            ->whereBetween('fecha', [$inicio, $fin])
                            ->where('empleado_id',$selected)
                            ->get();
                    //return $data;
                    if (count($data)>0) {
                        return Excel::download(new CobradorExport($data), 'Reporte '.$data[0]->empleado->nombre.' '.$format_inicio.' - '.$format_fin.'.xlsx');
                    }else {
                        return "No hay datos que mostrar";
                    }
                    
                    break;
                case 'vendedor':
                    $data =Ruta::with('empleados')->whereHas('empleados', function($query) use ($selected){            
                                $query->where('empleado_id', $selected);
                            })
                            ->with('notas.detalles.articulo')
                            ->with('notas.abonos')
                            ->with('vehiculo')
                            ->whereBetween('fecha', [$inicio, $fin])
                            ->get();
                    $empleado = Empleado::find($selected);
                    return $data;
                    if (count($data)>0) {
                        return Excel::download(new VendedorExport($data,$empleado->nombre), 'Reporte '.$empleado->nombre.' '.$format_inicio.' - '.$format_fin.'.xlsx');
                    }else {
                        return "No hay datos que mostrar";
                    }
                    break;
                case 'vehiculo':
                    $data =Ruta::with('vehiculo')
                        ->whereHas('vehiculo', function($query) use ($selected){            
                            $query->where('vehiculo_id', $selected);
                        })
                        ->with('empleados')
                        ->with('notas.detalles.articulo')
                        ->with('notas.abonos')
                        
                        ->whereBetween('fecha', [$inicio, $fin])
                        ->get();
                        $vehiculo = Vehiculo::find($selected);
                       // return $data;
                        if (count($data)>0) {
                            return Excel::download(new VendedorExport($data,$vehiculo->nombre), 'Reporte '.$vehiculo->nombre.' '.$format_inicio.' - '.$format_fin.'.xlsx');
                        }else {
                            return "No hay datos que mostrar";
                        }
                default:
                    # code...
                    break;
            }
        }
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
    public function show(Reporte $reporte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reporte $reporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reporte $reporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reporte $reporte)
    {
        //
    }
}
