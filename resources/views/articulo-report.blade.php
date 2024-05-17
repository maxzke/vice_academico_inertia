<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de articulos</title>
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
                    <strong>#</strong>
                </th>
                <th>
                    <strong>ARTICULO</strong>
                </th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            {{ $i=1;}}
        @foreach ($articulos as $item)
            <tr class="row-articulo text-capitalize">
                <td>
                    {{$i}}
                </td>
                <td>
                    {{$item->nombre}}
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @if(count($item->sucursales)>0)
            <tr class="bg-row-header">
                <td></td>
                <td>Sucursal</td>
                <td style="text-align:center;">Precio</td>
                <td style="text-align:center;">Enganche</td>
                <td style="text-align:center;">Pago semanal</td>
                <td style="text-align:center;">Comisión</td>
                <td style="text-align:center;">Existencias</td>
            </tr>
            @endIf
            @foreach ($item->sucursales as $sucursal)
            
            <tr>
                <td></td>
                <td class="text-capitalize">
                    {{$sucursal->nombre}}
                </td>
                <td style="text-align:right;">
                    {{number_format($sucursal->pivot->precio, 1, '.', ',')}}
                </td>
                <td style="text-align:right;">
                    {{number_format($sucursal->pivot->enganche, 1, '.', ',')}}
                </td>
                <td style="text-align:right;">
                    {{number_format($sucursal->pivot->pago_sugerido_semanal, 1, '.', ',')}}
                </td>
                <td style="text-align:right;">
                    {{$sucursal->pivot->porcentaje_comision}} %
                </td>
                <td style="text-align:right;">
                    {{$sucursal->pivot->stock}}
                </td>
            </tr>
        @endforeach
            {{$i++}}
        @endforeach
        </tbody>
    </table>
</body>
</html>