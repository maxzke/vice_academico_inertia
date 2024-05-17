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
            
        </thead>
        <tbody>
            {{ $i=1;}}
        @foreach ($data as $item)
        <tr class="bg-gray-400">
                <th>
                    <strong>
                    @if(count($data)>0)
                        {{ $item->empleado->nombre}}
                        @else
                        NO HAY DATOS PARA MOSTRAR
                        @endIf
                    </strong>
                </th>
            </tr>
            <tr class="bg-gray-400">
                <th></th>
                <th>
                    <strong>No. Tarjeta</strong>
                </th>
                <th>{{$item->nota->tarjeta}}</th>
                <th>
                    <strong>Articulo</strong>
                </th>
                <th><strong>Cantidad</strong></th>
                <th><strong>Precio</strong></th>
                <th><strong>Pago sugerido semanal</strong></th>       
                <th></th>         
                <th><strong>Plazo</strong></th>
                <th>{{$item->nota->plazo}}</th>
                
                <th><strong>Abono</strong></th>
                <th>{{number_format($item->importe, 1, '.', ',')}}</th>       
                <th><strong>Fecha</strong></th>     
                <th>{{$item->fecha}}</th>  
                <th><strong>Comentario</strong></th>     
                <th>{{$item->comentario}}</th>             
            </tr>
            @foreach ($item->nota->detalles as $producto)            
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-capitalize">
                    {{$producto->articulo->nombre}}
                </td>
                <td style="text-align:right;">
                    {{$producto->cantidad}}
                </td>
                <td style="text-align:right;">
                    {{number_format($producto->precio, 1, '.', ',')}}
                </td>
                <td></td>
                <td style="text-align:right;">
                    {{number_format($producto->pago_sugerido_semanal, 1, '.', ',')}}
                </td>
            </tr>
        @endforeach
            {{$i++}}
        @endforeach
        </tbody>
    </table>
</body>
</html>