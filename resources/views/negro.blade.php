@extends('header')
@section('table')
    <h2>VENEZUELA</h2>
    <h4>VE Bs. 1 = AR ${{$VE2AR}}</h4>
    <table class="table table-bordered table-dark">
        <thead class="text-center">
            <tr>
                <th class="text-center">{{date("h:i:s d/m/Y")}}</th>
                <th class="text-center">Venta</th>
            </tr>
        </thead>
        <tbody>
            <tr class="info">
                <td class="text-center"><strong>Dólar Promedio</strong></td>
                <td class="text-right"><strong>Bs. {{number_format($promedio,2,',','.')}}</strong></td>
            </tr>
            @foreach ($datos as $item)
                <tr>
                    <td class=""><strong>{{$item["entidad"]}}</strong></td>
                    <td class="text-right"><strong>Bs. {{$item["venta"]}}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

