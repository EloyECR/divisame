<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/fontawesome.css" integrity="sha384-eHoocPgXsiuZh+Yy6+7DsKAerLXyJmu2Hadh4QYyt+8v86geixVYwFqUvMU8X90l" crossorigin="anonymous"/>
    <title>Divisa Me</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>ARGENTINA</h2>
                <table class="table table-bordered table-dark">
                    <thead class="text-center">
                        <tr>
                            <th colspan="2">Dólar Blue</th>
                        </tr>
                        <tr>
                            <th>Compra</th>
                            <th>Venta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-right"><strong>${{$AR["blue"]["compra"]}}</strong></td>
                            <td class="text-right"><strong>${{$AR["blue"]["venta"]}}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered table-dark">
                    <thead class="text-center">
                        <tr>
                            <th colspan="2">Dólar Oficial</th>
                        </tr>
                        <tr>
                            <th>Compra</th>
                            <th>Venta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-right"><strong>${{$AR["oficial"]["compra"]}}</strong></td>
                            <td class="text-right"><strong>${{$AR["oficial"]["venta"]}}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>VENEZUELA</h2>
                <table class="table table-bordered table-dark">
                    <thead class="text-center">
                        <tr>
                            <th>Entidad</th>
                            <th><i class="fas fa-arrow-up"></i></th>
                            <th>Tasa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>DolarToday</strong></td>
                            <td></td>
                            <td class="text-right"><strong>Bs. {{$VE["venta"]}}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>