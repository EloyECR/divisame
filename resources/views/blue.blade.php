@extends('divisame.header')
@section('table')
    <h2>ARGENTINA</h2>
    <h4>AR$ 1 = VE Bs. {{$AR2VE}}</h4>
    <table class="table table-bordered table-dark">
        <thead class="text-center">
            <tr>
                <th colspan="3" class="text-center">{{date("h:i:s d/m/Y")}}</th>
            </tr>
            <tr>
                <th class="text-center">Entidad</th>
                <th class="text-center">Compra</th>
                <th class="text-center">Venta</th>
            </tr>
        </thead>
        <tbody>
            <tr class="info">
                <td class=""><strong>Dólar Promedio</strong></td>
                <td class="text-right"><strong>${{number_format($promedioCompra,2,',','.')}}</strong></td>
                <td class="text-right"><strong>${{number_format($promedioVenta,2,',','.')}}</strong></td>
            </tr>
            @php
                $i=0;
            @endphp
            @foreach ($datos as $item)
                @if ($i>0)
                    <tr>
                        <td class=""><strong>{{$item["entidad"]}}</strong></td>
                        <td class="text-right"><strong>${{$item["compra"] == false ? 0 : $item["compra"]}}</strong></td>
                        <td class="text-right"><strong>${{$item["venta"]}}</strong></td>
                    </tr>
                @endif
                @php $i++; @endphp
            @endforeach
        </tbody>
    </table>
@endsection