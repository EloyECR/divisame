<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;



class ScrapingController extends Controller
{
    public function DolarInfo($tipo = 1){
        $client = new Client();
        $entidad = array(); $valor = array();
        $crawler = $client->request('GET', 'https://www.infodolar.com/cotizacion-dolar-blue.aspx');
        $clase = "'nombre'";
        $nombreEntidades = $crawler->filter("[class=$clase]")->each(function($nombres){
            $this->entidad[] = $nombres->filter('')->text();
        });

        $clase = "'colCompraVenta'";
        $valores = $crawler->filter("[class=$clase]")->each(function($tasa){
            $this->valor[] = substr($tasa->text(),2,6);
        });

        $pos=0;
        for($i=0;$i<sizeof($this->valor);$i++){
            if($i % 2 == 0){
                $pos++;
                $datos[] = [
                    "entidad"   => $this->entidad[$pos-1],
                    "compra"    => $this->valor[$i],
                    "venta"     => $this->valor[$i+1],
                ];
            }
        }

        $promedioVenta=0;$auxVenta=0;$promedioCompra=0;$auxCompra=0;
        for($i=0;$i<sizeof($datos);$i++){
            if($datos[$i]["venta"]>0){
                $promedioVenta += $this->tofloat($datos[$i]["venta"]);
                $auxVenta++;
            }
            if($datos[$i]["compra"]>0){
                $promedioCompra += $this->tofloat($datos[$i]["compra"]);
                $auxCompra++;
            }
        }

        $promedioVenta = $promedioVenta / $auxVenta;
        $promedioCompra = $promedioCompra / $auxCompra;
        if($tipo==1){
            $AR2VE = $this->AR2VE($promedioVenta);
            return view('blue',['datos'=>$datos,'promedioCompra' => $promedioCompra,'promedioVenta'=>$promedioVenta,'AR2VE'=>$AR2VE]);
        }
        return $promedioVenta;
    }

    public function DolarHoy($tipo = 1){
        $client = new Client();
        
        $valorCompra = "";$valorVenta = "";
        $crawler = $client->request('GET', 'https://www.dolarhoy.com/cotizacion-dolar-blue');
        $divCompra = "'col-md-6 compra'";
        // $valor = $crawler->filter("[class=$spanRight]")->first();
        $boxCompra = $crawler->filter("[class=$divCompra]")->each(function($textoCompra){
            $span = $textoCompra->filter("span")->text();
            $this->valorCompra = substr($span,-6);
        });
        $divVenta = "'col-md-6 venta'";
        // $valor = $crawler->filter("[class=$spanRight]")->first();
        $boxVenta = $crawler->filter("[class=$divVenta]")->each(function($textoVenta){
            $span = $textoVenta->filter("span")->text();
            $this->valorVenta = substr($span,-6);
        });
        $blue = [
            "compra"    => number_format($this->tofloat($this->valorCompra),2,',',''),
            "venta"     => number_format($this->tofloat($this->valorVenta),2,',',''),

        ];
        $crawler = $client->request('GET', 'https://www.dolarhoy.com/cotizacion-dolar-oficial');
        $divCompra = "'col-md-6 compra'";
        // $valor = $crawler->filter("[class=$spanRight]")->first();
        $boxCompra = $crawler->filter("[class=$divCompra]")->each(function($textoCompra){
            $span = $textoCompra->filter("span")->text();
            $this->valorCompra = substr($span,-6);
        });
        $divVenta = "'col-md-6 venta'";
        // $valor = $crawler->filter("[class=$spanRight]")->first();
        $boxVenta = $crawler->filter("[class=$divVenta]")->each(function($textoVenta){
            $span = $textoVenta->filter("span")->text();
            $this->valorVenta = substr($span,-6);
        });
        $oficial = [
            "compra"    => number_format($this->tofloat($this->valorCompra),2,',',''),
            "venta"     => number_format($this->tofloat($this->valorVenta),2,',',''),
        ];        

        $valorCompra = "";$valorVenta = "";
        $crawler = $client->request('GET', 'https://dolartoday.com/');
        $result = $crawler->filterXpath('//meta[@name="description"]')->attr('content');
        $description = explode(" ",$result);
        $i=0;
        foreach($description as $data){
            if($i == 12){
                $valorVenta = $data;
            }
            $i++;
        }
        $VE = [
            "venta" => number_format($this->tofloat($valorVenta),2,',',''),
        ];

        $AR = [
            "blue" => $blue,
            "oficial" => $oficial,
        ];

        return view('test',['AR'=>$AR,'VE'=>$VE]);
    }

    public function MonitorDolarVE($tipo = 1){
        $client = new Client();

        $datos = array();
        $crawler = $client->request('GET', 'https://monitordolarvenezuela.com/');
        $claseBox = "'box-prices row'";
        $nombreEntidades = $crawler->filter("[class=$claseBox]")->each(function($data){
            $claseEntidad = "'col-12 col-lg-5'";
            $claseCambio = "'col-6 col-lg-4'";
            $this->datos[] = [
                "entidad" => $data->filter("[class=$claseEntidad]")->text(),
                "venta"  => $data->filter("[class=$claseCambio]")->text(),
            ];
        });
        $promedio=0;
        $aux=0;
        for($i=0;$i<sizeof($this->datos);$i++){
            if($this->datos[$i]["venta"]>0){
                $promedio += $this->tofloat($this->datos[$i]["venta"]);
                $aux++;
            }
        }
        $promedio = $promedio / $aux;
        if($tipo==1){
            $VE2AR = $this->VE2AR($promedio);
            return view('negro',['datos'=>$this->datos, 'promedio'=>$promedio,'VE2AR'=>$VE2AR]);
        }
        return $promedio;

    }

    public function tofloat($num){
        $dotPos = strrpos($num, '.');
        $commaPos = strrpos($num, ',');
        $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos : 
            ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);
       
        if (!$sep) {
            return floatval(preg_replace("/[^0-9]/", "", $num));
        } 
    
        return floatval(
            preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
            preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
        );
    }

    public function AR2VE($AR){
        $VE = $this->MonitorDolarVE(0);
        return number_format($VE / $AR,2,',','.');
    }
    
    public function VE2AR($VE){
        $AR = $this->DolarInfo(0);
        return number_format($AR / $VE,6,',','.');
    }
}



