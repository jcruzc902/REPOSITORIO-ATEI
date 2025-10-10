<?php
include ('../../config.php');

require ('../../librerias/FPDF/fpdf.php');

$contador = 0;
session_start();

if (isset($_SESSION['busqueda_banco'])) {
    $banco = $_SESSION['busqueda_banco'];
} else {
    $banco = "";
}

if (isset($_SESSION['busqueda_cuenta'])) {
    $cuenta = $_SESSION['busqueda_cuenta'];
} else {
    $cuenta = "";
}

if (isset($_SESSION['busqueda_nombre'])) {
    $nombre = $_SESSION['busqueda_nombre'];
} else {
    $nombre = "";
}

if (isset($_SESSION['busqueda_tipocuenta'])) {
    $tipo_cuenta = $_SESSION['busqueda_tipocuenta'];
} else {
    $tipo_cuenta = "";
}

if (isset($_SESSION['busqueda_situacion'])) {
    $situacion = $_SESSION['busqueda_situacion'];
} else {
    $situacion = "";
}

if (isset($_SESSION['busqueda_fecha'])) {
    $fecha = $_SESSION['busqueda_fecha'];
} else {
    $fecha = "";
}

if (isset($_SESSION['busqueda_estado'])) {
    $estado = $_SESSION['busqueda_estado'];
} else {
    $estado = "";
}

if (isset($_SESSION['busqueda_desde'])) {
    $desde = $_SESSION['busqueda_desde'];
} else {
    $desde = "";
}

if (isset($_SESSION['busqueda_hasta'])) {
    $hasta = $_SESSION['busqueda_hasta'];
} else {
    $hasta = "";
}

$sql_saldo_bancario = "SELECT saldo_banco.id_saldo_banco as id_saldo_banco,
    saldo_banco.nombre_banco as nombre_banco,
    saldo_banco.numero_cuenta as numero_cuenta,
    saldo_banco.nombre_cuenta as nombre_cuenta,
    cuenta_saldo.id_cuenta_saldo as id_cuenta_saldo,
    cuenta_saldo.cuenta_saldo as cuenta_saldo,
    saldo_banco.fecha as fecha,
    saldo_banco.monto as monto_saldo,
    saldo_banco.detalle_cuenta as detalle_cuenta,
    saldo_banco.observacion as observacion,
    situacion_saldo.id_situacion_saldo as id_situacion_saldo,
    situacion_saldo.nombre_situacion as nombre_situacion,
    estado_saldo.id_estado_saldo as id_estado_saldo,
    estado_saldo.nombre_estado as nombre_estado,
    usuarios.id_usuario as id_usuario,
    usuarios.nombres as nombres,
    usuarios.apaterno as apaterno,
    usuarios.amaterno as amaterno,
    saldo_banco.fyh_creacion as fyh_creacion,
    saldo_banco.fyh_actualizacion as fyh_actualizacion
    FROM tb_saldo_banco as saldo_banco 
    LEFT JOIN tb_cuenta_saldo as cuenta_saldo ON cuenta_saldo.id_cuenta_saldo = saldo_banco.tipo_cuenta 
    LEFT JOIN tb_situacion_saldo as situacion_saldo ON situacion_saldo.id_situacion_saldo = saldo_banco.situacion 
    LEFT JOIN tb_estado_saldo as estado_saldo ON estado_saldo.id_estado_saldo = saldo_banco.estado 
    LEFT JOIN tb_usuarios as usuarios ON usuarios.id_usuario = saldo_banco.id_usuario
    WHERE saldo_banco.visible!=1 ";

if (isset($_SESSION['busqueda_boton_saldo_bancario'])) {

    /*
    if (
        !isset($banco) && !isset($cuenta) && !isset($nombre) && !isset($tipocuenta) && !isset($situacion) && !isset($fecha) && !isset($estado)
        && !isset($desde) && !isset($hasta)
    ) {
        $sql_saldo_bancario .= " ";
    } else {
        if (!empty($banco)) {
            $sql_saldo_bancario .= " AND saldo_banco.nombre_banco='" . $banco . "'";
        }

        if (!empty($cuenta)) {
            $sql_saldo_bancario .= " AND saldo_banco.numero_cuenta='" . $cuenta . "'";
        }

        if (!empty($nombre)) {
            $sql_saldo_bancario .= " AND saldo_banco.nombre_cuenta='" . $nombre . "'";
        }

        if (!empty($tipo_cuenta)) {
            $sql_saldo_bancario .= " AND saldo_banco.tipo_cuenta='" . $tipo_cuenta . "'";
        }

        if (!empty($situacion)) {
            $sql_saldo_bancario .= " AND saldo_banco.situacion='" . $situacion . "'";
        }

        if (!empty($fecha)) {
            $sql_saldo_bancario .= " AND saldo_banco.fecha='" . $fecha . "'";
        }

        if (!empty($estado)) {
            $sql_saldo_bancario .= " AND saldo_banco.estado='" . $estado . "'";
        }



        if (!empty($desde) && !empty($hasta)) {
            $sql_saldo_bancario .= " AND saldo_banco.fyh_creacion between '" . $desde . "' and '" . $hasta . "'";
        }
    }

    */

    if ($banco!="") {
        $sql_saldo_bancario .= " AND saldo_banco.nombre_banco='" . $banco . "'";
    }

    if ($banco!="" && $cuenta!="") {
        $sql_saldo_bancario .= " AND saldo_banco.numero_cuenta='" . $cuenta . "'";
    }

    if ($banco!="" && $cuenta!="" && $nombre!="") {
        $sql_saldo_bancario .= " AND saldo_banco.nombre_cuenta='" . $nombre . "'";
    }

    if ($tipo_cuenta!="") {
        $sql_saldo_bancario .= " AND cuenta_saldo.id_cuenta_saldo='" . $tipo_cuenta . "'";
    }

    if ($situacion!="") {
        $sql_saldo_bancario .= " AND situacion_saldo.id_situacion_saldo='" . $situacion . "'";
    }

    if ($fecha!="") {
        $sql_saldo_bancario .= " AND saldo_banco.fecha='" . $fecha . "'";
    }

    if ($estado!="") {
        $sql_saldo_bancario .= " AND estado_saldo.id_estado_saldo='" . $estado . "'";
    }

    if ($desde!="" && $hasta!="") {
        $sql_saldo_bancario .= " AND saldo_banco.fyh_creacion between '" . $desde . "' and '" . $hasta . "'";
    }

    $sql_saldo_bancario .= " ORDER BY saldo_banco.nombre_banco ASC"; //ordena el nombre del banco en forma ascendente

    $query_saldo_bancario = $pdo->prepare($sql_saldo_bancario);
    $query_saldo_bancario->execute();
    $saldo_bancario_datos = $query_saldo_bancario->fetchAll(PDO::FETCH_ASSOC);
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
        $this->Cell(40, 10, utf8_decode(date('H:i:s a'))); //texto

        $this->SetY(30);
        $this->SetFont('Arial', 'B', 12); //fuente
        $this->Cell(110); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('REPORTE DE SALDO BANCARIO')); //texto

        $this->SetY(40);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(1); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Entidad:')); //texto

        $this->SetY(40);
        $this->SetFont('Arial', '', 8); //fuente
        $this->Cell(20); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('UNIVERSIDAD NACIONAL FEDERICO VILLAREAL')); //texto

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
        $this->Cell(1); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('N°')); //texto


        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(12); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('BANCO')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(46); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('CUENTA')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(120); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('NOMBRE')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(167); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('TIPO CUENTA')); //texto


        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(195); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('SITUACION')); //texto


        $this->SetTextColor(0, 0, 0);  // Establece el color del texto (en este caso es blanco)
        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(232); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('MONTO')); //texto


        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(252); //mover a la derecha
        $this->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es blanco)
        $this->SetFillColor(0, 0, 0); // establece el color del fondo de la celda (en este caso es VERDE)
        $this->Cell(24, 10, utf8_decode('FECHA SALDO'), 1, 0, 'C', true); //texto




        /*
                $this->SetY(65);
                $this->SetFont('Arial', 'B', 8); //fuente
                $this->Cell(257); //mover a la derecha
                $this->Cell(40, 10, utf8_decode('F. Registro')); //texto*/

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
$pdf->AddPage('LANDSCAPE', 'A4'); //orientacion y tamaño de la hoja
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(TRUE, 15);

$i = 1;
$importe_total = 0;

if (!isset($saldo_bancario_datos)) {
    $saldo_bancario_datos = '';
} else {
    foreach ($saldo_bancario_datos as $saldo_bancario_dato) {

        if ($saldo_bancario_dato["nombre_banco"] == "BANCO DE COMERCIO") {
            $saldo_bancario_dato["nombre_banco"] = "COMERCIO";
        } else if ($saldo_bancario_dato["nombre_banco"] == "BANCO DE CREDITO DEL PERU") {
            $saldo_bancario_dato["nombre_banco"] = "BCP";
        } else if ($saldo_bancario_dato["nombre_banco"] == "BANCO DE LA NACION") {
            $saldo_bancario_dato["nombre_banco"] = "NACION";
        } else if ($saldo_bancario_dato["nombre_banco"] == "BANCO PICHINCHA") {
            $saldo_bancario_dato["nombre_banco"] = "PICHINCHA";
        }



        if ($saldo_bancario_dato['cuenta_saldo'] == "SELECCIONAR") {
            $saldo_bancario_dato['cuenta_saldo'] = "";
        }

        if ($saldo_bancario_dato['nombre_situacion'] == "SELECCIONAR") {
            $saldo_bancario_dato['nombre_situacion'] = "";
        }

        $pdf->SetFont('Arial', '', 8); //fuente
        $pdf->Cell(1); //mover a la derecha
        $pdf->Cell(9, 5, utf8_decode($i));
        $pdf->Cell(15, 5, utf8_decode($saldo_bancario_dato["nombre_banco"]),null,null,'R'); //alineacion a la derecha


        if ($saldo_bancario_dato["numero_cuenta"] == "OTROS") {
            $saldo_bancario_dato["numero_cuenta"] = str_replace('OTROS', 'CUT', $saldo_bancario_dato["numero_cuenta"]);
        } else if ($saldo_bancario_dato["numero_cuenta"] == "0000-300152") {
            $saldo_bancario_dato["numero_cuenta"] = str_replace('0000-300152', 'CUT', $saldo_bancario_dato["numero_cuenta"]);
        }

        $pdf->Cell(35, 5, utf8_decode($saldo_bancario_dato["numero_cuenta"]),null,null,'R');

        $saldo_bancario_dato["nombre_cuenta"] = substr($saldo_bancario_dato["nombre_cuenta"], 0, 45); //cortar cadena

        $pdf->Cell(90, 5, utf8_decode($saldo_bancario_dato["nombre_cuenta"]),null,null,'R');

        if (
            $saldo_bancario_dato["nombre_banco"] == "NACION" && $saldo_bancario_dato["numero_cuenta"] == "CUT"
            && $saldo_bancario_dato["nombre_cuenta"] == "CUENTA UNICA DE TESORO" && $saldo_bancario_dato["cuenta_saldo"] == "CTA. CUT"
        ) {
            $saldo_bancario_dato["cuenta_saldo"] = "CTA. CUT 300152";
        }

        $pdf->Cell(35, 5, utf8_decode($saldo_bancario_dato["cuenta_saldo"]),null,null,'R');
        $pdf->Cell(25, 5, utf8_decode($saldo_bancario_dato["nombre_situacion"]),null,null,'R');


        $saldo_bancario_dato["monto_saldo"] = number_format($saldo_bancario_dato["monto_saldo"], 2, '.', ''); //convertir int a decimal
        $importe_total = $importe_total + $saldo_bancario_dato["monto_saldo"];

        $importe_sb= number_format($saldo_bancario_dato["monto_saldo"], 2, '.', ','); //convertir int a decimal


        $pdf->Cell(35, 5, utf8_decode($importe_sb),null,null,'R');

        if ($saldo_bancario_dato["fecha"] == "0000-00-00") {
            $fecha_saldo = "";
        } else {
            $theDate = new DateTime($saldo_bancario_dato["fecha"]);
            $fecha_saldo = $theDate->format('d/m/Y');
        }

        $pdf->Cell(28, 5, utf8_decode($fecha_saldo),null,null,'R');

        /*
        $theDate = new DateTime($saldo_bancario_dato["fyh_creacion"]);
        $fecha_registro = $theDate->format('d/m/Y');
        $pdf->Cell(10, 5, utf8_decode($fecha_registro));*/

        $i++;
        $pdf->Ln(6);
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
    $pdf->Cell(221); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('S/. ' . $importe_total)); //texto

    $pdf->Ln(2); //salto de linea
    $pdf->SetFont('Arial', 'U', 8);  //fuente
    $pdf->Cell(1); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('                                                                                                                                                                                                                                                                                                                                                           ')); //texto

}

$pdf->Ln(10); //salto de linea
$pdf->SetFont('Arial', 'B', 12);  //fuente
$pdf->Cell(11); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('RESUMEN DE SALDO POR BANCO Y TIPO DE CUENTA')); //texto

$theDate = new DateTime($fecha);
$fecha_a_consultar = $theDate->format('d-m-Y');

$pdf->Ln(8); //salto de linea
$pdf->SetFont('Arial', '', 9);  //fuente
$pdf->Cell(11); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('AL '.$fecha_a_consultar)); //texto

$total1 = 0;
$total2 = 0;
$total3 = 0;
$total4 = 0;
$total5 = 0;
$total6 = 0;
$total7 = 0;
$total8 = 0;
$total9 = 0;
$v1 = 0;
$v2 = 0;
$v3 = 0;
$v4 = 0;
$v5 = 0;
$v6 = 0;
$v7 = 0;
$v8 = 0;
$v9 = 0;

$sql_cta_ahorro_banco_nacion = "SELECT SUM(monto) as monto
from tb_saldo_banco 
WHERE tipo_cuenta=3 AND visible!=1 AND fecha='$fecha' AND nombre_banco='BANCO DE LA NACION'
GROUP BY nombre_banco
ORDER BY nombre_banco";
$query_cta_ahorro_banco_nacion = $pdo->prepare($sql_cta_ahorro_banco_nacion);
$query_cta_ahorro_banco_nacion->execute();
$total_cta_ahorro_banco_nacion = $query_cta_ahorro_banco_nacion->fetchAll(PDO::FETCH_ASSOC);

foreach ($total_cta_ahorro_banco_nacion as $cta_ahorro_banco_nacion) {
    $total1 = $cta_ahorro_banco_nacion["monto"];
    $v1 = $v1 + $cta_ahorro_banco_nacion["monto"];
    $total1 = floatval($total1);
    $total1 = number_format($total1, 2, '.', ','); //convertir int a decimal
}

if ($total1 == null) {
    $total1 = 0.00;
}



$sql_cta_ahorro_banco_credito = "SELECT SUM(monto) as monto
from tb_saldo_banco 
WHERE tipo_cuenta=3 AND visible!=1 AND fecha='$fecha' AND nombre_banco='BANCO DE CREDITO DEL PERU'
GROUP BY nombre_banco
ORDER BY nombre_banco";
$query_cta_ahorro_banco_credito = $pdo->prepare($sql_cta_ahorro_banco_credito);
$query_cta_ahorro_banco_credito->execute();
$total_cta_ahorro_banco_credito = $query_cta_ahorro_banco_credito->fetchAll(PDO::FETCH_ASSOC);

foreach ($total_cta_ahorro_banco_credito as $cta_ahorro_banco_credito) {
    $total2 = $cta_ahorro_banco_credito["monto"];
    $v2 = $v2 + $cta_ahorro_banco_credito["monto"];
    $total2 = floatval($total2);
    $total2 = number_format($total2, 2, '.', ','); //convertir int a decimal
}

if ($total2 == null) {
    $total2 = 0.00;
}


$sql_cta_cte_banco_nacion = "SELECT SUM(monto) as monto
from tb_saldo_banco 
WHERE tipo_cuenta=2 AND visible!=1 AND fecha='$fecha' AND nombre_banco='BANCO DE LA NACION'
GROUP BY nombre_banco 
ORDER BY nombre_banco";
$query_cta_cte_banco_nacion = $pdo->prepare($sql_cta_cte_banco_nacion);
$query_cta_cte_banco_nacion->execute();
$total_cta_cte_banco_nacion = $query_cta_cte_banco_nacion->fetchAll(PDO::FETCH_ASSOC);

foreach ($total_cta_cte_banco_nacion as $cta_cte_banco_nacion) {
    $total3 = $cta_cte_banco_nacion["monto"];
    $v3 = $v3 + $cta_cte_banco_nacion["monto"];
    $total3 = floatval($total3);
    $total3 = number_format($total3, 2, '.', ','); //convertir int a decimal
}

if ($total3 == null) {
    $total3 = 0.00;
}



$sql_cta_cte_banco_credito = "SELECT SUM(monto) as monto
from tb_saldo_banco 
WHERE tipo_cuenta=2 AND visible!=1 AND fecha='$fecha' AND nombre_banco='BANCO DE CREDITO DEL PERU'
GROUP BY nombre_banco 
ORDER BY nombre_banco";
$query_cta_cte_banco_credito = $pdo->prepare($sql_cta_cte_banco_credito);
$query_cta_cte_banco_credito->execute();
$total_cta_cte_banco_credito = $query_cta_cte_banco_credito->fetchAll(PDO::FETCH_ASSOC);

foreach ($total_cta_cte_banco_credito as $cta_cte_banco_credito) {
    $total4 = $cta_cte_banco_credito["monto"];
    $v4 = $v4 + $cta_cte_banco_credito["monto"];
    $total4 = floatval($total4);
    $total4 = number_format($total4, 2, '.', ','); //convertir int a decimal
}

if ($total4 == null) {
    $total4 = 0.00;
}



$sql_cta_cte_banco_comercio = "SELECT SUM(monto) as monto
from tb_saldo_banco 
WHERE tipo_cuenta=2 AND visible!=1 AND fecha='$fecha' AND nombre_banco='BANCO DE COMERCIO'
GROUP BY nombre_banco 
ORDER BY nombre_banco";
$query_cta_cte_banco_comercio = $pdo->prepare($sql_cta_cte_banco_comercio);
$query_cta_cte_banco_comercio->execute();
$total_cta_cte_banco_comercio = $query_cta_cte_banco_comercio->fetchAll(PDO::FETCH_ASSOC);

foreach ($total_cta_cte_banco_comercio as $cta_cte_banco_comercio) {
    $total5 = $cta_cte_banco_comercio["monto"];
    $v5 = $v5 + $cta_cte_banco_comercio["monto"];
    $total5 = floatval($total5);
    $total5 = number_format($total5, 2, '.', ','); //convertir int a decimal
}

if ($total5 == null) {
    $total5 = 0.00;
}



$sql_cta_cte_banco_pichincha = "SELECT SUM(monto) as monto
from tb_saldo_banco 
WHERE tipo_cuenta=2 AND visible!=1 AND fecha='$fecha' AND nombre_banco='BANCO PICHINCHA'
GROUP BY nombre_banco 
ORDER BY nombre_banco";
$query_cta_cte_banco_pichincha = $pdo->prepare($sql_cta_cte_banco_pichincha);
$query_cta_cte_banco_pichincha->execute();
$total_cta_cte_banco_pichincha = $query_cta_cte_banco_pichincha->fetchAll(PDO::FETCH_ASSOC);

foreach ($total_cta_cte_banco_pichincha as $cta_cte_banco_pichincha) {
    $total6 = $cta_cte_banco_pichincha["monto"];
    $v6 = $v6 + $cta_cte_banco_pichincha["monto"];
    $total6 = floatval($total6);
    $total6 = number_format($total6, 2, '.', ','); //convertir int a decimal
}

if ($total6 == null) {
    $total6 = 0.00;
}


$sql_cut_banco_nacion = "SELECT SUM(monto) as monto
from tb_saldo_banco 
WHERE tipo_cuenta=4 AND nombre_cuenta='CUENTA UNICA DE TESORO' AND visible!=1 AND fecha='$fecha' AND nombre_banco='BANCO DE LA NACION'
GROUP BY nombre_banco 
ORDER BY nombre_banco";
$query_cut_banco_nacion = $pdo->prepare($sql_cut_banco_nacion);
$query_cut_banco_nacion->execute();
$total_cut_banco_nacion = $query_cut_banco_nacion->fetchAll(PDO::FETCH_ASSOC);

foreach ($total_cut_banco_nacion as $cut_banco_nacion) {
    $total7 = $cut_banco_nacion["monto"];
    $v7 = $v7 + $cut_banco_nacion["monto"];
    $total7 = floatval($total7);
    $total7 = number_format($total7, 2, '.', ','); //convertir int a decimal
}

if ($total7 == null) {
    $total7 = 0.00;
}


$sql_dytrnsf_banco_nacion = "SELECT SUM(monto) as monto
from tb_saldo_banco 
WHERE nombre_cuenta LIKE '%DONACIONES Y TRANSFERENCIAS%' AND tipo_cuenta=4 AND visible!=1 AND fecha='$fecha' AND nombre_banco='BANCO DE LA NACION'
GROUP BY nombre_banco 
ORDER BY nombre_banco";
$query_dytrnsf_banco_nacion = $pdo->prepare($sql_dytrnsf_banco_nacion);
$query_dytrnsf_banco_nacion->execute();
$total_dytrnsf_banco_nacion = $query_dytrnsf_banco_nacion->fetchAll(PDO::FETCH_ASSOC);

foreach ($total_dytrnsf_banco_nacion as $dytrnsf_banco_nacion) {
    $total8 = $dytrnsf_banco_nacion["monto"];
    $v8 = $v8 + $dytrnsf_banco_nacion["monto"];
    $total8 = floatval($total8);
    $total8 = number_format($total8, 2, '.', ','); //convertir int a decimal
}

if ($total8 == null) {
    $total8 = 0.00;
}


$sql_canon_banco_nacion = "SELECT SUM(monto) as monto
from tb_saldo_banco 
WHERE nombre_cuenta='REGALIAS MINERAS (SUB-CTA. VIRTUAL) CANON Y SOBRECANON, REGALIAS, RENTA DE ADUANAS Y PARTICIPACIONES' AND visible!=1 AND fecha='$fecha' AND nombre_banco='BANCO DE LA NACION'
GROUP BY nombre_banco 
ORDER BY nombre_banco";
$query_canon_banco_nacion = $pdo->prepare($sql_canon_banco_nacion);
$query_canon_banco_nacion->execute();
$total_canon_banco_nacion = $query_canon_banco_nacion->fetchAll(PDO::FETCH_ASSOC);

foreach ($total_canon_banco_nacion as $canon_banco_nacion) {
    $total9 = $canon_banco_nacion["monto"];
    $v9 = $v9 + $canon_banco_nacion["monto"];
    $total9 = floatval($total9);
    $total9 = number_format($total9, 2, '.', ','); //convertir int a decimal
}

if ($total9 == null) {
    $total9 = 0.00;
}


$pdf->Ln(8); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(12); //mover a la derecha
$pdf->Cell(50, 7, utf8_decode('ENTIDADES FINANCIERAS'), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(62); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode('CUENTA DE AHORRO'), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(94); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode('CUENTA CORRIENTES'), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(126); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode('CUT RDR'), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(158); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode('DY TRNSF'), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(190); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode('CANON'), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(222); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode('TOTAL'), 1, null, 'C'); //texto

//BANCO DE LA NACION
$pdf->Ln(7); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(12); //mover a la derecha
$pdf->Cell(50, 7, utf8_decode('BANCO DE LA NACION'), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(62); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode($total1), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(94); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode($total3), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(126); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode($total7), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(158); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode($total8), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(190); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode($total9), 1, null, 'C'); //texto

$sh1 = $v1 + $v3 + $v7 + $v8 + $v9;
$sh1 = number_format($sh1, 2, '.', ','); //convertir int a decimal

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(222); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode($sh1), 1, null, 'C'); //texto

//BANCO DE CREDITO DEL PERU
$pdf->Ln(7); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(12); //mover a la derecha
$pdf->Cell(50, 7, utf8_decode('BANCO DE CREDITO DEL PERU'), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(62); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode($total2), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(94); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode($total4), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(126); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode('0.00'), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(158); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode('0.00'), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(190); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode('0.00'), 1, null, 'C'); //texto

$sh2 = $v2 + $v4;
$sh2 = number_format($sh2, 2, '.', ','); //convertir int a decimal

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(222); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode($sh2), 1, null, 'C'); //texto


//BANCO DE COMERCIO
$pdf->Ln(7); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(12); //mover a la derecha
$pdf->Cell(50, 7, utf8_decode('BANCO DE COMERCIO'), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(62); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode('0.00'), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(94); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode($total5), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(126); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode('0.00'), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(158); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode('0.00'), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(190); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode('0.00'), 1, null, 'C'); //texto

$sh3 = $v5;
$sh3 = number_format($sh3, 2, '.', ','); //convertir int a decimal

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(222); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode($sh3), 1, null, 'C'); //texto


//BANCO PICHINCHA
$pdf->Ln(7); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(12); //mover a la derecha
$pdf->Cell(50, 7, utf8_decode('BANCO PICHINCHA'), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(62); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode('0.00'), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(94); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode($total6), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(126); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode('0.00'), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(158); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode('0.00'), 1, null, 'C'); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(190); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode('0.00'), 1, null, 'C'); //texto

$sh4 = $v6;
$sh4 = number_format($sh4, 2, '.', ','); //convertir int a decimal


$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(222); //mover a la derecha
$pdf->Cell(32, 7, utf8_decode($sh4), 1, null, 'C'); //texto

$pdf->Ln(7); //salto de linea
$pdf->SetFont('Arial', '', 9);  //fuente
$pdf->Cell(28); //mover a la derecha
$pdf->Cell(40, 7, utf8_decode('TOTALES')); //texto


$t1 = $v1 + $v2;
$f1 = $t1;
$t1 = floatval($t1);
$t1 = number_format($t1, 2, '.', ',');

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 10);  //fuente
$pdf->Cell(70); //mover a la derecha
$pdf->Cell(40, 7, utf8_decode($t1)); //texto

$t2 = $v3 + $v4 + $v5 + $v6;
$f2 = $t2;
$t2 = floatval($t2);
$t2 = number_format($t2, 2, '.', ',');

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 9);  //fuente
$pdf->Cell(100); //mover a la derecha
$pdf->Cell(40, 7, utf8_decode($t2)); //texto

$t3 = $v7;
$f3 = $t3;
$t3 = floatval($t3);
$t3 = number_format($t3, 2, '.', ',');

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 9);  //fuente
$pdf->Cell(133); //mover a la derecha
$pdf->Cell(40, 7, utf8_decode($t3)); //texto

$t4 = $v8;
$f4 = $t4;
$t4 = floatval($t4);
$t4 = number_format($t4, 2, '.', ',');

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 9);  //fuente
$pdf->Cell(166); //mover a la derecha
$pdf->Cell(40, 7, utf8_decode($t4)); //texto

$t5 = $v9;
$f5 = $t5;
$t5 = floatval($t5);
$t5 = number_format($t5, 2, '.', ',');

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 9);  //fuente
$pdf->Cell(197); //mover a la derecha
$pdf->Cell(40, 7, utf8_decode($t5)); //texto

$t6 = $f1 + $f2 + $f3 + $f4 + $f5; //suma total
$t6 = floatval($t6);
$t6 = number_format($t6, 2, '.', ',');

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 9);  //fuente
$pdf->Cell(228); //mover a la derecha
$pdf->Cell(40, 7, utf8_decode($t6)); //texto

$pdf->Ln(2); //salto de linea
$pdf->SetFont('Arial', 'U', 8);  //fuente
$pdf->Cell(11); //mover a la derecha
$pdf->Cell(40, 7, utf8_decode('                                                                                                                                                                                                                                                                                                                    ')); //texto

$pdf->Ln(1); //salto de linea
$pdf->SetFont('Arial', 'U', 8);  //fuente
$pdf->Cell(11); //mover a la derecha
$pdf->Cell(40, 7, utf8_decode('                                                                                                                                                                                                                                                                                                                    ')); //texto



$pdf->Output('Reporte de Saldo Bancario.pdf', 'I');