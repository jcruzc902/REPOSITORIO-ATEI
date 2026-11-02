<?php
include('../../config.php');

require('../../librerias/FPDF/fpdf.php');

$contador = 0;
session_start();

if (isset($_SESSION['busqueda_dependencia'])) {
    $nombre_dependencia = $_SESSION['busqueda_dependencia'];
} else {
    $nombre_dependencia = "";
}

if (isset($_SESSION['busqueda_concepto'])) {
    $concepto = $_SESSION['busqueda_concepto'];
} else {
    $concepto = "";
}

if (isset($_SESSION['busqueda_desde_fecha_recaudacion'])) {
    $desde_fecha_recaudacion = $_SESSION['busqueda_desde_fecha_recaudacion'];
} else {
    $desde_fecha_recaudacion = "";
}

if (isset($_SESSION['busqueda_hasta_fecha_recaudacion'])) {
    $hasta_fecha_recaudacion = $_SESSION['busqueda_hasta_fecha_recaudacion'];
} else {
    $hasta_fecha_recaudacion = "";
}

if (isset($_SESSION['busqueda_documento_recepcion'])) {
    $documento_recepcion = $_SESSION['busqueda_documento_recepcion'];
} else {
    $documento_recepcion = "";
}

if (isset($_SESSION['busqueda_desde_fecha_deposito'])) {
    $desde_fecha_deposito = $_SESSION['busqueda_desde_fecha_deposito'];
} else {
    $desde_fecha_deposito = "";
}

if (isset($_SESSION['busqueda_hasta_fecha_deposito'])) {
    $hasta_fecha_deposito = $_SESSION['busqueda_hasta_fecha_deposito'];
} else {
    $hasta_fecha_deposito = "";
}

if (isset($_SESSION['busqueda_codigo_operacion'])) {
    $codigo_operacion = $_SESSION['busqueda_codigo_operacion'];
} else {
    $codigo_operacion = "";
}

if (isset($_SESSION['busqueda_estado'])) {
    $estado = $_SESSION['busqueda_estado'];
} else {
    $estado = "";
}


$sql_recaudacion_ingresos = "SELECT * FROM tb_recaudacion_ingresos WHERE visible!=1 ";

if (isset($_SESSION["busqueda_boton_recaudacion_ingreso"])) {


    if (
        !isset($nombre_dependencia) && !isset($concepto) && !isset($desde_fecha_recaudacion) && !isset($hasta_fecha_recaudacion) && !isset($documento_recepcion) && !isset($desde_fecha_deposito)
        && !isset($hasta_fecha_deposito) && !isset($codigo_operacion) && !isset($estado)
    ) {
        $sql_recaudacion_ingresos .= "";
    } else {

        if (!empty($nombre_dependencia)) {
            $sql_recaudacion_ingresos .= " AND nombre_dependencia='" . $nombre_dependencia . "'";
        }

        if (!empty($concepto)) {
            $sql_recaudacion_ingresos .= " AND detalle_concepto like '%" . $concepto . "%'";
        }

        if (!empty($desde_fecha_recaudacion) && !empty($hasta_fecha_recaudacion)) {
            $sql_recaudacion_ingresos .= " AND fecha_recaudacion between '" . $desde_fecha_recaudacion . " 00:00:00" . "' and '" . $hasta_fecha_recaudacion . " 23:59:59" . "'";
        }

        if (!empty($documento_recepcion)) {
            $sql_recaudacion_ingresos .= " AND documento_recepcion like '%" . $documento_recepcion . "%'";
        }

        if (!empty($desde_fecha_deposito) && !empty($hasta_fecha_deposito)) {
            $sql_recaudacion_ingresos .= " AND fecha_deposito between '" . $desde_fecha_deposito . " 00:00:00" . "' and '" . $hasta_fecha_deposito . " 23:59:59" . "'";
        }

        if (!empty($codigo_operacion)) {
            $sql_recaudacion_ingresos .= " AND numero_operacion='" . $codigo_operacion . "'";
        }

        if (!empty($estado)) {
            $sql_recaudacion_ingresos .= " AND estado='" . $estado . "'";
        }

    }

    $sql_recaudacion_ingresos .= " ORDER BY fecha_recaudacion ASC";


    $query_recaudacion_ingresos = $pdo->prepare($sql_recaudacion_ingresos);
    $query_recaudacion_ingresos->execute();
    $recaudacion_ingresos_datos = $query_recaudacion_ingresos->fetchAll(PDO::FETCH_ASSOC);

}

class PDF extends FPDF
{



    public function header()
    {
        $this->Image('../../../public/images/logo2_unfv.jpg', 15, 8, 70);

        $this->SetY(10);
        $this->SetFont('Arial', 'B', 8);  //fuente
        $this->Cell(250); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Fecha:')); //texto

        $this->SetY(10);
        $this->SetFont('Arial', '', 8);  //fuente
        $this->Cell(260); //mover a la derecha
        $this->Cell(40, 10, utf8_decode(date('d/m/Y'))); //texto

        $this->SetY(15);
        $this->SetFont('Arial', 'B', 8);  //fuente
        $this->Cell(250); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Hora:')); //texto

        $this->SetY(15);
        $this->SetFont('Arial', '', 8);  //fuente
        $this->Cell(260); //mover a la derecha
        $this->Cell(40, 10, utf8_decode(date('H:i:s'))); //texto

        if (isset($_SESSION['busqueda_estado'])) {
            $estado_recaudacion = $_SESSION['busqueda_estado'];
        } else {
            $estado_recaudacion = "";
        }

        switch ($estado_recaudacion) {
            case 'PAGADO':
                $estado_recaudacion = "PAGADO";
                break;
            case 'PENDIENTE':
                $estado_recaudacion = "PENDIENTE";
                break;
            case 'ANULADO':
                $estado_recaudacion = "ANULADO";
                break;
            default:
                $estado_recaudacion = "";
                break;
        }

        $this->SetY(30);
        $this->SetFont('Arial', 'B', 12); //fuente
        //$this->Cell(110); //mover a la derecha
        $this->Cell(0, 10, utf8_decode('REPORTE DE RECAUDACION DE INGRESOS ' . $estado_recaudacion), 0, 0, 'C'); //texto

        $this->SetY(40);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(1); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Entidad:')); //texto

        $this->SetY(40);
        $this->SetFont('Arial', '', 8); //fuente
        $this->Cell(20); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('UNIVERSIDAD NACIONAL FEDERICO VILLARREAL')); //texto

        $this->SetY(45);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(1); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('RUC:')); //texto

        $this->SetY(45);
        $this->SetFont('Arial', '', 8); //fuente
        $this->Cell(20); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('20170934289')); //texto

        $this->SetY(50);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(1); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Dirección:')); //texto

        $this->SetY(50);
        $this->SetFont('Arial', '', 8); //fuente
        $this->Cell(20); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('JR. CARLOS GONZALES 285 URB. MARANGA - SAN MIGUEL')); //texto

        $this->SetY(55);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(1); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Organo:')); //texto

        $this->SetY(55);
        $this->SetFont('Arial', '', 8); //fuente
        $this->Cell(20); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('DIRECCION GENERAL DE ADMINISTRACIÓN - OFICINA DE TESORERÍA')); //texto

        $this->Line(10, 65, 285, 65); //LINEA

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(3); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('N°')); //texto


        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(18); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Dependencia')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(62); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Concepto')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(82); //mover a la derecha
        $this->MultiCell(40, 5, utf8_decode("Fecha de \nRecaudacion"), 0, 'C'); //texto


        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(127); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Documento')); //texto


        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(157); //mover a la derecha
        $this->MultiCell(40, 5, utf8_decode("Fecha de \nDeposito"), 0, 'C'); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(185); //mover a la derecha
        $this->MultiCell(40, 5, utf8_decode("Cuenta \nDeposito"), 0, 'C'); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(217); //mover a la derecha
        $this->MultiCell(40, 5, utf8_decode("Codigo de \nOperacion"), 0, 'C'); //texto


        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(257); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Importe')); //texto



        $this->Line(10, 75, 285, 75); //LINEA





        $this->Ln(12); //salto de linea

    }

    public function footer()
    {
        $this->SetY(-15); //salto de linea
        $this->SetFont('Arial', '', 8); //fuente
        $this->Cell(1); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Oficina de Tesorería')); //texto

        $this->SetY(-15); //salto de linea
        $this->AliasNbPages('tpagina');
        $this->SetFont('Arial', '', 8); //fuente
        $this->Cell(267); //mover a la derecha
        $this->Cell(40, 10, utf8_decode($this->PageNo() . '/tpagina')); //texto
    }
}

$pdf = new PDF();
$pdf->AddPage('LANDSCAPE', 'A4');
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(TRUE, 15);

$i = 1;
$importe_total = 0;

if (!isset($recaudacion_ingresos_datos)) {
    $recaudacion_ingresos_datos = '';
} else {
    foreach ($recaudacion_ingresos_datos as $recaudacion_ingresos_dato) {

        $pdf->SetFont('Arial', '', 8); //fuente

        $pdf->Cell(1); //mover a la derecha
        $pdf->Cell(7, 5, utf8_decode($i), null, null, 'R');

        switch ($recaudacion_ingresos_dato["nombre_dependencia"]) {

            case "EDITORIAL UNIVERSITARIA":
                $recaudacion_ingresos_dato["nombre_dependencia"] = "ED. UNI.";
                break;

            case "FACULTAD DE ODONTOLOGIA":
                $recaudacion_ingresos_dato["nombre_dependencia"] = "FAC. ODON.";
                break;

            case "FACULTAD DE TECNOLOGIA MEDICA":
                $recaudacion_ingresos_dato["nombre_dependencia"] = "FAC. TEC. MED.";
                break;
            case "ADMINISTRACION CENTRAL":
                $recaudacion_ingresos_dato["nombre_dependencia"] = "ADM. CENTRAL";
                break;


        }

        $pdf->Cell(30, 5, utf8_decode($recaudacion_ingresos_dato["nombre_dependencia"]), null, null, 'R');

        /*
        $texto = $recaudacion_ingresos_dato["detalle_concepto"];

        $palabras = explode(' ', $texto);
        $resultado = [];

        foreach ($palabras as $palabra) {
            if (mb_strlen($palabra, 'UTF-8') <= 6) {
                $resultado[] = $palabra;
            } else {
                $resultado[] = mb_substr($palabra, 0, 6, 'UTF-8');
            }
        }

        $texto_abreviado = implode(' ', $resultado);

        $texto_abreviado= substr($texto_abreviado,0,30);

        */

        $texto_abreviado= substr($recaudacion_ingresos_dato["detalle_concepto"],0,20);

        $pdf->Cell(40, 5, utf8_decode($texto_abreviado), 0, 0, 'R');


        if($recaudacion_ingresos_dato["fecha_recaudacion"]!="0000-00-00"){
            $theDate = new DateTime($recaudacion_ingresos_dato["fecha_recaudacion"]);
            $recaudacion_ingresos_dato["fecha_recaudacion"] = $theDate->format('d/m/Y');
        }else{
            $recaudacion_ingresos_dato["fecha_recaudacion"]= "";
        }

        $pdf->Cell(32, 5, utf8_decode($recaudacion_ingresos_dato["fecha_recaudacion"]), null, null, 'R');

        
        $recaudacion_ingresos_dato["documento_recepcion"]= str_replace("XX","",$recaudacion_ingresos_dato["documento_recepcion"]);
        $recaudacion_ingresos_dato["documento_recepcion"]= substr($recaudacion_ingresos_dato["documento_recepcion"],0,28);

        $pdf->Cell(50, 5, utf8_decode($recaudacion_ingresos_dato["documento_recepcion"]), 0, 0, 'C');


        if($recaudacion_ingresos_dato["fecha_deposito"]!="0000-00-00"){
            $theDate = new DateTime($recaudacion_ingresos_dato["fecha_deposito"]);
            $recaudacion_ingresos_dato["fecha_deposito"] = $theDate->format('d/m/Y');
        }else{
            $recaudacion_ingresos_dato["fecha_deposito"]= "";
        }

        $pdf->Cell(25, 5, utf8_decode($recaudacion_ingresos_dato["fecha_deposito"]), 0, 0, 'R');

        $pdf->Cell(30, 5, utf8_decode($recaudacion_ingresos_dato["numero_cuenta2"]), 0, 0, 'R');

        $pdf->Cell(30, 5, utf8_decode($recaudacion_ingresos_dato["numero_operacion"]), 0, 0, 'R');

        $importe = number_format($recaudacion_ingresos_dato["importe"], 2, '.', ','); //convertir int a decimal
        $importe_total = $importe_total + $recaudacion_ingresos_dato["importe"];

        $pdf->Cell(25, 5, utf8_decode($importe), 0, 0, 'R');

        




        $i++;
        $pdf->Ln();
    }



    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', 'U', 8);  //fuente
    $pdf->Cell(1); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('                                                                                                                                                                                                                                                                                                                                                           ')); //texto


    $pdf->Ln(5); //salto de linea
    $pdf->SetFont('Arial', 'B', 8);  //fuente
    $pdf->Cell(5); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('TOTAL')); //texto

    $importe_total = number_format($importe_total, 2, '.', ','); //convertir int a decimal

    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', 'B', 8);  //fuente
    $pdf->Cell(230); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('S/. ' . $importe_total),0, 0, 'R'); //texto

    $pdf->Ln(2); //salto de linea
    $pdf->SetFont('Arial', 'U', 8);  //fuente
    $pdf->Cell(1); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('                                                                                                                                                                                                                                                                                                                                                           ')); //texto

}

$pdf->Output('Reporte de Recaudacion de Ingresos.pdf', 'I');