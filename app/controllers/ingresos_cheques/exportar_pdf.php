<?php
include('../../config.php');

require('../../librerias/FPDF/fpdf.php');

$contador = 0;
session_start();

if (isset($_SESSION['busqueda_detalle_c_nt'])) {
    $nt = $_SESSION['busqueda_detalle_c_nt'];
} else {
    $nt = "";
}

if (isset($_SESSION['busqueda_detalle_c_anio_nt'])) {
    $anio_nt = $_SESSION['busqueda_detalle_c_anio_nt'];
} else {
    $anio_nt = "";
}

if (isset($_SESSION['busqueda_detalle_c_tipo_cheque'])) {
    $tipo_cheque = $_SESSION['busqueda_detalle_c_tipo_cheque'];
} else {
    $tipo_cheque = "";
}

if (isset($_SESSION['busqueda_detalle_c_nro_cheque'])) {
    $numero_cheque = $_SESSION['busqueda_detalle_c_nro_cheque'];
} else {
    $numero_cheque = "";
}

if (isset($_SESSION['busqueda_detalle_c_fecha_emision'])) {
    $fecha_emision = $_SESSION['busqueda_detalle_c_fecha_emision'];
} else {
    $fecha_emision = "";
}

if (isset($_SESSION['busqueda_detalle_c_estado_cheque'])) {
    $estado_cheque = $_SESSION['busqueda_detalle_c_estado_cheque'];
} else {
    $estado_cheque = "";
}

if (isset($_SESSION['busqueda_c_desde'])) {
    $desde = $_SESSION['busqueda_c_desde'];
} else {
    $desde = "";
}

if (isset($_SESSION['busqueda_c_hasta'])) {
    $hasta = $_SESSION['busqueda_c_hasta'];
} else {
    $hasta = "";
}


$sql_cheques = "SELECT cheque.id_cheque as id_cheque,
    cheque.nt as numero_tramite,
    cheque.id_anio_nt as id_anio_nt,
    anio_nt.anio_nt as nt_anio,
    cheque.proveido_diga as proveido_diga,
    cheque.fecha_diga as fecha_diga,
    cheque.proveido_conta as proveido_conta,
    cheque.fecha_conta as fecha_conta,
    cheque.informe as informe,
    cheque.fecha_informe as fecha_informe,
    cheque.id_asunto as id_asunto,
    asunto.nombre_asunto as nombre_asunto,
    detalle.siaf as siaf,
    cheque.id_tipo_gasto as id_tipo_gasto,
    tipo_gasto.nombre_tipo_gasto as nombre_tipo_gasto,
    cheque.oficio as oficio,
    cheque.fecha_oficio as fecha_oficio,
    cheque.observacion as observacion,
    nrocuenta.nro_cuenta as nro_cuenta,
    detalle.nro_ci as nro_ci,
    detalle.fecha_ci as fecha_ci,
    detalle.nro_ce as nro_ce,
    detalle.fecha_ce as fecha_ce,
    detalle.nro_cheque as nro_cheque,
    detalle.fecha_emision_cheque as fecha_emision_cheque,
    detalle.monto as monto,
    detalle.nro_envio as nro_envio,
    detalle.fecha_aprobado as fecha_aprobado,
    detalle.fecha_entregado as fecha_entregado,
    detalle.fecha_pagado as fecha_pagado,
    estado_cheque.nombre_estado_cheque as estado_cheque,
    detalle.observacion as observacion_cheque,
    usuario.nombres as nombres,
    usuario.apaterno as apaterno,
    usuario.amaterno as amaterno,
    detalle.id_asunto as detalle_id_asunto,
    detalle.fyh_creacion as fyh_creacion_detalle,
    detalle.fyh_actualizacion as fyh_actualizacion_detalle
    FROM tb_cheque as cheque 
    INNER JOIN tb_anio_nt as anio_nt ON anio_nt.id_anio_nt = cheque.id_anio_nt 
    INNER JOIN tb_asunto as asunto ON asunto.id_asunto = cheque.id_asunto 
    INNER JOIN tb_tipo_gasto as tipo_gasto ON tipo_gasto.id_tipo_gasto = cheque.id_tipo_gasto
    LEFT JOIN tb_detalle_cheque AS detalle ON detalle.id_cheque = cheque.id_cheque 
    LEFT JOIN tb_nrocuenta AS nrocuenta ON nrocuenta.id_nrocuenta = detalle.id_nrocuenta 
    LEFT JOIN tb_estado_cheque as estado_cheque ON estado_cheque.id_estado_cheque = detalle.id_estado_cheque
    LEFT JOIN tb_usuarios AS usuario ON usuario.id_usuario = detalle.id_usuario 
    WHERE cheque.visible>=0 ";

if (isset($_SESSION["busqueda_boton_detalle_cheque"])) {


    if (
        !isset($nt) && !isset($anio_nt) && !isset($tipo_cheque) && !isset($numero_cheque) && !isset($fecha_emision) && !isset($estado_cheque)
        && !isset($desde) && !isset($hasta)
    ) {
        $sql_cheques .= "";
    } else {

        if (!empty($nt)) {
            $sql_cheques .= " AND cheque.nt like '%" . $nt . "%'";
        }

        if (!empty($anio_nt)) {
            $sql_cheques .= " AND cheque.id_anio_nt='" . $anio_nt . "'";
        }

        if (!empty($tipo_cheque)) {
            $sql_cheques .= " AND detalle.id_nrocuenta='" . $tipo_cheque . "'";
        }

        if (!empty($numero_cheque)) {
            $sql_cheques .= " AND detalle.nro_cheque like '%" . $numero_cheque . "%'";
        }

        if (!empty($fecha_emision)) {
            $sql_cheques .= " AND detalle.fecha_emision_cheque='" . $fecha_emision . "'";
        }

        if (!empty($estado_cheque)) {
            $sql_cheques .= " AND detalle.id_estado_cheque='" . $estado_cheque . "'";
        }

        if (!empty($desde) && !empty($hasta)) {
            $sql_cheques .= " AND detalle.fecha_emision_cheque between '" . $desde . "' and '" . $hasta . "'";
        }
    }

    $sql_cheques .= " GROUP BY detalle.nro_cheque";


    $query_cheques = $pdo->prepare($sql_cheques);
    $query_cheques->execute();
    $cheques_datos = $query_cheques->fetchAll(PDO::FETCH_ASSOC);

}

class PDF extends FPDF
{
    public function header()
    {
        $this->Image('../../../public/images/logo2_unfv.jpg', 15, 8, 70);

        $this->SetY(10);
        $this->SetFont('Arial', 'B', 8);  //fuente
        $this->Cell(155); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Fecha:')); //texto

        $this->SetY(10);
        $this->SetFont('Arial', '', 8);  //fuente
        $this->Cell(170); //mover a la derecha
        $this->Cell(40, 10, utf8_decode(date('d/m/Y'))); //texto

        $this->SetY(15);
        $this->SetFont('Arial', 'B', 8);  //fuente
        $this->Cell(155); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Hora:')); //texto

        $this->SetY(15);
        $this->SetFont('Arial', '', 8);  //fuente
        $this->Cell(173); //mover a la derecha
        $this->Cell(40, 10, utf8_decode(date('H:i:s'))); //texto

        $this->SetY(30);
        $this->SetFont('Arial', 'B', 12); //fuente
        $this->Cell(70); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('REPORTE DE CHEQUES')); //texto

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

        $this->Line(10, 65, 200, 65); //LINEA

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(1); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('N°')); //texto


        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(15); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('NT')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(31); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Proveido')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(50); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Fecha')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(68); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Tipo de Gasto')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(93); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('N° Cheque')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(120); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Fecha Emision')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(148); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Monto')); //texto


        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(168); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('F. Registro')); //texto

        $this->Line(10, 75, 200, 75); //LINEA





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
        $this->Cell(180); //mover a la derecha
        $this->Cell(40, 10, utf8_decode($this->PageNo() . '/tpagina')); //texto
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(TRUE, 15);

$i = 1;
$importe_total = 0;

if (!isset($cheques_datos)) {
    $cheques_datos = '';
} else {
    foreach ($cheques_datos as $cheques_dato) {

        $pdf->SetFont('Arial', '', 8); //fuente

        $pdf->Cell(1); //mover a la derecha
        $pdf->Cell(5, 5, utf8_decode($i),null, null, 'R');


        $pdf->Cell(20, 5, utf8_decode($cheques_dato["numero_tramite"] . '-' . $cheques_dato["nt_anio"]),null, null, 'R');

        $cheques_dato["proveido_diga"] = substr($cheques_dato['proveido_diga'], 0, 7);
        $pdf->Cell(18, 5, utf8_decode($cheques_dato["proveido_diga"]),null, null, 'R');

        if ($cheques_dato["fecha_diga"] != '0000-00-00') {
            $theDate = new DateTime($cheques_dato['fecha_diga']);
            $cheques_dato['fecha_diga'] = $theDate->format('d/m/Y');
        } else {
            $cheques_dato["fecha_diga"] = "";
        }

        $pdf->Cell(20, 5, utf8_decode($cheques_dato["fecha_diga"]),null, null, 'R');

        $pdf->Cell(23, 5, utf8_decode($cheques_dato["nombre_tipo_gasto"]),null, null, 'R');

        $pdf->Cell(22, 5, utf8_decode($cheques_dato["nro_cheque"]),null, null, 'R');

        $theDate = new DateTime($cheques_dato['fecha_emision_cheque']);
        $cheques_dato['fecha_emision_cheque'] = $theDate->format('d/m/Y');

        $pdf->Cell(30, 5, utf8_decode($cheques_dato["fecha_emision_cheque"]),null, null, 'R');

        if($cheques_dato["monto"]!=null){
            $monto_reporte=  number_format($cheques_dato["monto"],2,'.',','); //convertir int a decimal

            
        }else{
            $monto_reporte="";
        }

        $pdf->Cell(20, 5, utf8_decode($monto_reporte),null, null, 'R');

        $importe_total = $importe_total + $cheques_dato["monto"]; //suma monto de cheques para el total

        $theDate = new DateTime($cheques_dato['fyh_creacion_detalle']);
        $cheques_dato['fyh_creacion_detalle'] = $theDate->format('d/m/Y');

        $pdf->Cell(25, 5, utf8_decode($cheques_dato["fyh_creacion_detalle"]),null, null, 'R');

        $i++;
        $pdf->Ln();
    }



    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', 'U', 8);  //fuente
    $pdf->Cell(1); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('                                                                                                                                                                                                                                             ')); //texto


    $pdf->Ln(5); //salto de linea
    $pdf->SetFont('Arial', 'B', 8);  //fuente
    $pdf->Cell(5); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('TOTAL')); //texto

    $importe_total = number_format($importe_total, 2, '.', ''); //convertir int a decimal

    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', 'B', 8);  //fuente
    $pdf->Cell(141); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('S/. ' . $importe_total)); //texto

    $pdf->Ln(2); //salto de linea
    $pdf->SetFont('Arial', 'U', 8);  //fuente
    $pdf->Cell(1); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('                                                                                                                                                                                                                                             ')); //texto

}

$pdf->Output('Reporte de Cheques.pdf', 'I');