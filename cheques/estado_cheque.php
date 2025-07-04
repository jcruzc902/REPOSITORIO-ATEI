<?php

include ('../app/config.php');
include ('../layout/sesion.php');


include ('../app/controllers/cheque/show_cheque.php');


require ('../app/librerias/FPDF/fpdf.php');

$sql_detalle_cheque = "SELECT cheque.id_detalle_cheque as id_detalle_cheque,
cheque.id_nrocuenta as id_nrocuenta,
nrocuenta.nro_cuenta as nro_cuenta,
cheque.nro_ci as nro_ci,
cheque.fecha_ci as fecha_ci,
cheque.nro_ce as nro_ce,
cheque.fecha_ce as fecha_ce,
cheque.nro_cheque as nro_cheque,
cheque.fecha_emision_cheque as fecha_emision,
cheque.monto as monto,
cheque.nro_envio as nro_envio,
cheque.fecha_aprobado as fecha_aprobado,
cheque.fecha_entregado as fecha_entregado,
cheque.fecha_pagado as fecha_pagado,
cheque.observacion as observacion,
usuario.id_usuario as id_usuario,
usuario.nombres as nombre_usuario,
usuario.apaterno as apaterno_usuario,
usuario.amaterno as amaterno_usuario,
cheque.nt as nt,
cheque.id_anio_nt as id_anio_nt,
anio_nt.anio_nt as anio_nt,
cheque.fyh_creacion as fyh_creacion 
FROM tb_detalle_cheque as cheque 
INNER JOIN tb_nrocuenta as nrocuenta ON nrocuenta.id_nrocuenta= cheque.id_nrocuenta 
INNER JOIN tb_usuarios as usuario ON usuario.id_usuario= cheque.id_usuario 
INNER JOIN tb_anio_nt as anio_nt ON anio_nt.id_anio_nt= cheque.id_anio_nt  
WHERE cheque.visible!=1 AND cheque.nt='$nt' AND anio_nt.id_anio_nt='$id_anio_nt'";
$query_detalle_cheque = $pdo->prepare($sql_detalle_cheque);
$query_detalle_cheque->execute();
$detalle_cheque_datos= $query_detalle_cheque->fetchAll(PDO::FETCH_ASSOC);

class PDF extends FPDF
{
    public function header()
    {
        $this->Image('../public/images/logo2_unfv.jpg', 15, 8, 70);

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
        $this->Cell(170); //mover a la derecha
        $this->Cell(40, 10, utf8_decode(date('H:i:s a'))); //texto

        $this->SetY(30);
        $this->SetFont('Arial', 'B', 12); //fuente
        $this->Cell(60); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('ESTADO DE PROCESO DE CHEQUE')); //texto

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


        $this->Ln(7); //salto de linea

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

//CUADRO
$pdf->Ln(9); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(1); //mover a la derecha
$pdf->Cell(187, 200, "", 1, 0, 'C', 0);

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(5); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('NT:')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(12); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($nt . " - " . $nt_anio)); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(50); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Proveido (DIGA):')); //texto

//RESCATA EL AÑO
$theDate = new DateTime($fecha_diga);
$fecha_diga_anio = $theDate->format('Y');

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(75); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode("N° ".$proveido_diga."-".$fecha_diga_anio ."-DIGA-UNFV")); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(130); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Fecha:')); //texto

$theDate = new DateTime($fecha_diga);
$fecha_diga = $theDate->format('d/m/Y');

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(140); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($fecha_diga)); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(5); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Proveido (CONTABILIDAD):')); //texto

//RESCATA EL AÑO
$theDate = new DateTime($fecha_conta);
$fecha_conta_anio = $theDate->format('Y');

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(44); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode("N° ".$proveido_conta."-".$fecha_conta_anio."-OC-DIGA-UNFV")); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(90); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Fecha:')); //texto

$theDate = new DateTime($fecha_conta);
$fecha_conta = $theDate->format('d/m/Y');

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(100); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($fecha_conta)); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(5); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Asunto:')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(18); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($nombre_asunto)); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(90); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('SIAF:')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(100); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($siaf)); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(152); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Tipo:')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(160); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($nombre_tipo_gasto)); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(5); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Oficio:')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(15); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($oficio)); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(90); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Fecha:')); //texto

$theDate = new DateTime($fecha_oficio);
$fecha_oficio = $theDate->format('d/m/Y');

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(100); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($fecha_oficio)); //texto

$pdf->Line(15, 100, 194, 100); //LINEA
$pdf->Ln(12); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(7); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('N°')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(25); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Tipo')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(55); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('N° Cheque')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(90); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Fecha Emision')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(122); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Monto (S/.)')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(162); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Fecha Reg.')); //texto

$pdf->Line(15, 106, 194, 106); //LINEA

$i=1;
$total_cheque= 0;
$pdf->Ln(10); //salto de linea

foreach ($detalle_cheque_datos as $detalle_cheque_dato) {
    $pdf->SetFont('Arial', '', 8); //fuente
    $pdf->Cell(7); //mover a la derecha
    $pdf->Cell(18, 5, utf8_decode($i));
    $pdf->Cell(30, 5, utf8_decode($detalle_cheque_dato["nro_cuenta"]));
    $pdf->Cell(35, 5, utf8_decode($detalle_cheque_dato["nro_cheque"]));

    $theDate = new DateTime($detalle_cheque_dato["fecha_emision"]);
    $detalle_cheque_dato["fecha_emision"] = $theDate->format('d/m/Y');
    $pdf->Cell(32, 5, utf8_decode($detalle_cheque_dato["fecha_emision"]));
    
    $pdf->Cell(40, 5, utf8_decode($detalle_cheque_dato["monto"]));

    $total_cheque= $total_cheque + $detalle_cheque_dato["monto"]; //suma de cheques
    
    $theDate = new DateTime($detalle_cheque_dato["fyh_creacion"]);
    $detalle_cheque_dato["fyh_creacion"] = $theDate->format('d/m/Y');
    $pdf->Cell(20, 5, utf8_decode($detalle_cheque_dato["fyh_creacion"]));

    $i++;
    $pdf->Ln();
}

$pdf->Ln(-4); //salto de linea
$pdf->SetFont('Arial', 'U', 8);  //fuente
$pdf->Cell(4); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('                                                                                                                                                                                                                                    ')); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(105); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('TOTAL')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(122); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode(number_format($total_cheque,2,'.',''))); //texto


$pdf->Output('Estado de Cheque.pdf', 'I');