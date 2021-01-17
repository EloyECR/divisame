@php
    $bolivares =  336093.27;
    $pesoArgentino = 136;
    $pesoChileno = 779.60;
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="row mt-5">
        <div class="col-xs-12 col-md-6 offset-md-3">
            <form action="POST" class="form-control">
                <h3 class="">ORIGEN</h3><hr>
                <div class="form-group">
                    <label for="pais_origen">País Origen: </label>
                    <select name="pais_origen" id="pais_origen" class="form-control" onchange="calcular();">
                        <option value="54">Argentina</option>
                        <option value="56">Chile</option>
                        <option value="58">Venezuela</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pais_destino">País Destino: </label>
                    <select name="pais_destino" id="pais_destino" class="form-control" onchange="calcular();">
                        <option value="54">Argentina</option>
                        <option value="56">Chile</option>
                        <option value="58">Venezuela</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="divisa_origen">Divisa:</label>
                    <select name="divisa_origen" id="divisa_origen" class="form-control">
                        <option value="01">Dolar</option>
                        <option value="02">Peso País</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tipo_pago">Tipo Pago:</label>
                    <select name="tipo_pago" id="tipo_pago" class="form-control">
                        <option value="01">Efectivo</option>
                        <option value="02">Depósito</option>
                        <option value="02">Transferencia</option>
                        <option value="03">MercadoPago</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="delivery">Delivery:</label>
                    Si <input type="checkbox" name="si" id="">
                    No <input type="checkbox" name="no" id="">
                </div>
                <div class="form-group">
                    <label for="monto">Monto:</label>
                    <input type="number" name="monto" id="monto" class="form-control text-right" onkeyup="calcular();">
                </div>
                <hr>
                <div class="form-group">
                    <label for="monto">Monto a Recibir:</label>
                    <input type="text" name="monto" id="montoCambio" class="form-control text-right" disabled>
                </div>
                <input type="hidden" value="{{$bolivares}}" id="bolivares">
                <input type="hidden" value="{{$pesoChileno}}" id="pesoChileno">
                <input type="hidden" value="{{$pesoArgentino}}" id="pesoArgentino">
            </form>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-xs-12 col-md-6 offset-md-3">
            <form action="POST" class="form-control">
                <h3 class="">DESTINO</h3><hr>
                <div class="form-group">
                    <label for="pais_origen">Banco: </label>
                    <select name="pais_origen" id="pais_origen" class="form-control">
                        <option value="54">Banco 1</option>
                        <option value="56">Banco 2</option>
                        <option value="58">Banco 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pais_destino">Tipo de Cuenta: </label>
                    <select name="pais_destino" id="pais_destino" class="form-control">
                        <option value="54">Corriente</option>
                        <option value="56">Ahorros</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="monto">Numero de Cuenta:</label>
                    <input type="text" name="monto" id="monto" class="form-control text-right">
                </div>
                <div class="form-group">
                    <label for="monto">Nombre Titular:</label>
                    <input type="text" name="monto" id="monto" class="form-control text-right">
                </div>
                <div class="form-group">
                    <label for="monto">Cédula Titular:</label>
                    <input type="text" name="monto" id="monto" class="form-control text-right">
                </div>
                <hr>
                <input type="hidden" value="{{$bolivares}}" id="bolivares">
                <input type="hidden" value="{{$pesoChileno}}" id="pesoChileno">
                <input type="hidden" value="{{$pesoArgentino}}" id="pesoArgentino">
            </form>
        </div>
    </div>
    <script>
        function calcular(){
            var bolivares = document.getElementById("bolivares");
            var pesoChileno = document.getElementById("pesoChileno");
            var pesoArgentino  = document.getElementById("pesoArgentino");

            var monto = document.getElementById("monto");
            var ori = document.getElementById("pais_origen");
            var pais_origen = ori.options[ori.selectedIndex].value;
            var des = document.getElementById("pais_destino");
            var pais_destino = des.options[des.selectedIndex].value;

            monto2change = monto.value;

            if(pais_origen == "54"){
                montoA = pesoArgentino.value;
                if(pais_destino == "56"){
                    porcentaje = 0.045;
                    montoB = pesoChileno.value;
                }else if(pais_destino == "58"){
                    porcentaje = 0.045;
                    montoB = bolivares.value;
                }
            }else if(pais_origen == "56"){
                montoA = pesoChileno.value;
                if(pais_destino == "54"){
                    porcentaje = 0.045;
                    montoB = pesoArgentino.value;
                }else if(pais_destino == "58"){
                    porcentaje = 0.115;
                    montoB = bolivares.value;
                }
            }else if(pais_origen == "58"){
                montoA = bolivares.value;
                if(pais_destino == "54"){
                    porcentaje = 0.045;
                    montoB = pesoArgentino.value;
                }else if(pais_destino == "56"){
                    porcentaje = 0.045;
                    montoB = pesoChileno.value;
                }
            }

            var tasa = montoB / montoA;
            var tasaTotal = tasa - (tasa * porcentaje);

            var monto2recibir = document.getElementById("montoCambio");
            var numero = monto2change * tasaTotal;
            monto2recibir.value = Intl.NumberFormat("de-DE").format(numero);
            
        }
    </script>
</body>
</html>

