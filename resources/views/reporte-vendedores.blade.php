<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte</title>
    <style>
        table {
  border-collapse: collapse;
}
        th, td {
        text-align: left;
        border: 1px solid;
        border-color: #cccccc;
        padding: 3px;
        }
        .header{
            background: #Dcdddd;
        }
        .row-articulo{
            background: #ececec;
        }
        .bg-row-header{
            background: #fdfdd3;
        }
        .bg-row-body{
            background: #ffffe7;
        }
        .text-capitalize{
            text-transform: capitalize;
        }
    </style>
</head>
<body>
    <!-- <div style="margin-bottom:25px;align"><strong>REPORTE DE ARTICULOS</strong></div> -->
    <table style="width:100%;border">
        <thead class="header">
            <tr class="bg-gray-400">
                <th>
                    {{ $empleado }}
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach ($data as $ruta)
            <tr>
                <th>
                    <strong>
                    @if(count($data)==0)
                        NO HAY DATOS PARA MOSTRAR
                    @endIf
                    </strong>
                </th>
            </tr>
            <tr class="bg-gray-400">
                <th></th>
                <th>
                    <strong>Vehiculo</strong>
                </th>
                <th>Fecha</th>            
            </tr>
            <tr>
                <td></td>
                <td>{{$ruta->vehiculo->nombre}}</td>                
                <td>{{\Carbon\Carbon::parse($ruta->fecha)->format('d-m-Y')}}</td>
            </tr>
            <tr>
                <td>Cantidad</td>
                <td>Descripcion</td>
                <td>Precio</td>
                <td>Total</td>
                <td>Enganche</td>
            </tr>
            @if(count($ruta->notas)>0)
                @foreach ($ruta->notas as $notas) 
                    @foreach ($notas->detalles as $producto)           
                        <tr>
                            <td style="text-align:right;">
                                {{$producto->cantidad}}
                            </td>
                            <td class="text-capitalize">
                                {{$producto->articulo->nombre}}
                            </td>
                            <td style="text-align:right;">
                                {{number_format($producto->precio, 1, '.', ',')}}
                            </td>
                            <td>{{number_format($producto->total, 1, '.', ',')}}</td>
                            <td style="text-align:right;">
                                {{number_format($producto->enganche_recibido, 1, '.', ',')}}
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            @endif
        @endforeach
        </tbody>
    </table>
</body>
</html>