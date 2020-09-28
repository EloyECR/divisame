<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="refresh" content="120"/>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/fontawesome.css" integrity="sha384-eHoocPgXsiuZh+Yy6+7DsKAerLXyJmu2Hadh4QYyt+8v86geixVYwFqUvMU8X90l" crossorigin="anonymous"/>
    <title>Divisa Me</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                @yield('table')
                <div class="col-xs-6">
                    <a href="/argentina" class="col-xs-12 btn btn-primary {{Request::path() == "argentina" ? "active" : ""}}">Argentina</a>
                </div>
                <div class="col-xs-6">
                    <a href="/venezuela" class="col-xs-12 btn btn-primary {{Request::path() == "venezuela" ? "active" : ""}}">Venezuela</a>
                </div>
                <br><br>
            </div>
        </div>
    </div>
<script>
    document.ready()
</script>
</body>
</html>