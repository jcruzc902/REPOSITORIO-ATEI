<?php

include('../app/config.php');
include('../layout/sesion.php');


include('../app/controllers/detalle_estado_egresos/show_detalle_egreso.php');


require('../app/librerias/FPDF/fpdf.php');



class PDF extends FPDF
{
    public function header()
    {
        $this->Image('../public/images/logo_unfv2.png', 25, 10, 50);



        $this->SetY(35);
        $this->SetFont('Times', 'B', 11); //fuente
        $this->Cell(76); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('OFICINA DE TESORERÍA')); //texto

        /*
        $this->SetY(38);
        $this->SetFont('Times', '', 10); //fuente
        $this->Cell(50); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('"Año de la recuperación y consolidación de la economía peruana"')); //texto

        $this->SetY(43);
        $this->SetTextColor(255, 95, 3);  // Establece el color del texto (en este caso es blanco)
        $this->SetFont('Times', 'U', 10); //fuente
        $this->Cell(15); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('                                                                                                                                                                               ')); //texto
*/




        $this->Ln(7); //salto de linea

    }

    public function footer()
    {
        /*
        $this->SetY(-35);
        $this->SetTextColor(0, 0, 0);  // Establece el color del texto (en este caso es blanco)
        $this->SetFont('Times', 'U', 10); //fuente
        $this->Cell(15); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('                                                                                                                                                                               ')); //texto


        $this->SetY(-24); //salto de linea
        $this->SetFont('Times', '', 10); //fuente
        $this->Cell(24); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Calle Carlos Gonzales n°285 - Maranga - San Miguel - Central Telefónica: 7480888, anexo 9174')); //texto
        

        $this->SetY(-20); //salto de linea
        $this->SetFont('Arial', 'I', 8);  //fuente
        $this->Cell(15); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Adjunto.: Expediente')); //texto

        $this->SetY(-16); //salto de linea
        $this->SetFont('Arial', 'I', 8);  //fuente
        $this->Cell(15); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('PCC/HEDLCV')); //texto
        */
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(TRUE, 5);

$theDate = new DateTime($fecha_informe);
$anio_fecha_informe = $theDate->format('Y');

$numero_estado_cuenta = str_pad($numero_estado_cuenta, 3, "0", STR_PAD_LEFT); //rellena con ceros a la izquierda

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Times', 'BU', 14);  //fuente
$pdf->Cell(35); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('ESTADO DE CUENTA N.° '.$numero_estado_cuenta.'-'.$anio_fecha_informe.'-E-OT-DIGA-UNFV')); //texto


$pdf->Ln(12); //salto de linea
$pdf->SetFont('Arial', 'B', 9);  //fuente
$pdf->Cell(20); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Al                :')); //texto

$pdf->Ln(3); //salto de linea
$pdf->SetFont('Arial', '', 9);  //fuente
$pdf->Cell(41); //mover a la derecha
$pdf->Cell(120, 5, utf8_decode('LIC. PATHERSON ALEXANDER CABANILLAS CIEZA')); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Arial', '', 9);  //fuente
$pdf->Cell(41); //mover a la derecha
$pdf->Cell(120, 5, utf8_decode('JEFE DE LA OFICINA DE TESORERÍA')); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Arial', 'B', 9);  //fuente
$pdf->Cell(20); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Asunto       :')); //texto

//REEMPLAZAR EL GUION LARGO DEL ASUNTO
$asunto_ec = str_replace('−', '-', $asunto_ec);

$pdf->Ln(3); //salto de linea
$pdf->SetFont('Arial', '', 9);  //fuente
$pdf->Cell(41); //mover a la derecha
$pdf->MultiCell(120, 5, utf8_decode($asunto_ec . '')); //texto



$pdf->Ln(1); //salto de linea
$pdf->SetFont('Arial', 'B', 9);  //fuente
$pdf->Cell(20); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Ref.             :')); //texto

$pdf->Ln(-5); //salto de linea

if ($proveido_contabilidad != null) {
    $pdf->Ln(5); //salto de linea
    $pdf->SetFont('Arial', '', 9);  //fuente
    $pdf->Cell(41); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('PROVEIDO N°' . $proveido_contabilidad . '-OC-DIGA-UNFV')); //texto
}

if ($proveido_diga != null) {
    $pdf->Ln(5); //salto de linea
    $pdf->SetFont('Arial', '', 9);  //fuente
    $pdf->Cell(41); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('PROVEIDO N°' . $proveido_diga . '-DIGA-UNFV')); //texto

}

if ($oficio != null) {
    $pdf->Ln(5); //salto de linea
    $pdf->SetFont('Arial', '', 9);  //fuente
    $pdf->Cell(41); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('OFICIO N°' . $oficio)); //texto
}





$pdf->Ln(10); //salto de linea
$pdf->SetFont('Arial', 'B', 9);  //fuente
$pdf->Cell(20); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Fecha         :')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 9);  //fuente
$pdf->Cell(41); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('San Miguel,')); //texto

$theDateX = new DateTime($fecha_informe);
$dia_fecha_informe = $theDateX->format('d');

$theDateY = new DateTime($fecha_informe);
$mes_fecha_informe = $theDateY->format('m');

$theDateZ = new DateTime($fecha_informe);
$anio_fecha_informe = $theDateZ->format('Y');

$dia = $dia_fecha_informe;
$mes = $mes_fecha_informe;
$anio = $anio_fecha_informe;

switch ($mes) {
    case '01':
        $mes = 'enero';
        break;
    case '02':
        $mes = 'febrero';
        break;
    case '03':
        $mes = 'marzo';
        break;
    case '04':
        $mes = 'abril';
        break;
    case '05':
        $mes = 'mayo';
        break;
    case '06':
        $mes = 'junio';
        break;
    case '07':
        $mes = 'julio';
        break;
    case '08':
        $mes = 'agosto';
        break;
    case '09':
        $mes = 'setiembre';
        break;
    case '10':
        $mes = 'octubre';
        break;
    case '11':
        $mes = 'noviembre';
        break;
    case '12':
        $mes = 'diciembre';
        break;
}

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 9);  //fuente
$pdf->Cell(58); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($dia . " de " . $mes . " del " . $anio . '')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 9);  //fuente
$pdf->Cell(135); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('NT   : ')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 9);  //fuente
$pdf->Cell(145); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($nt_principal)); //texto

$pdf->Ln(5);
$pdf->SetFont('Times', 'U', 10); //fuente
$pdf->Cell(20); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('
                                                                                                                                                                    ')); //texto
$pdf->Ln(10); //salto de linea
$pdf->SetFont('Arial', '', 10);  //fuente
$pdf->Cell(20); //mover a la derecha
#$pdf->MultiCell(158, 5, utf8_decode('Por medio del presente se informan que no se registraron egresos referentes a ' . mb_convert_case($actividad_principal . ' - ' . $subactividad, MB_CASE_TITLE, "UTF-8") . ', realizado por ' . $facultad . ', en mérito a la Resolución Rectoral Nº ' . $resolucion . '-CU-UNFV, con fecha ' . $dia_resolucion . '.' . $mes_resolucion . '.' . $anio_resolucion . '.')); //texto
$pdf->MultiCell(148, 5, utf8_decode($descripcion_ec )); //texto


$saldo_inicial_x = number_format($saldo_inicial, 2, '.', ','); //convertir int a decimal
$egresos_x = number_format($egresos, 2, '.', ','); //convertir int a decimal

$saldo= $saldo_inicial-$egresos;
$saldo_x = number_format($saldo, 2, '.', ','); //convertir int a decimal


$pdf->Ln(5); //salto de linea
$pdf->SetFont('Arial', '', 11);  //fuente
$pdf->Cell(50); //mover a la derecha
$pdf->Cell(50, 7, utf8_decode('TOTAL DE INGRESOS S/.'), 1); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', null, 12);  //fuente
$pdf->Cell(100); //mover a la derecha
$pdf->Cell(35, 7, utf8_decode($saldo_inicial_x), 1, null, 'R'); //texto

$pdf->Ln(7); //salto de linea
$pdf->SetFont('Arial', '', 11);  //fuente
$pdf->Cell(50); //mover a la derecha
$pdf->Cell(50, 7, utf8_decode('TOTAL DE EGRESOS S/.'), 1); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', null, 12);  //fuente
$pdf->Cell(100); //mover a la derecha
$pdf->Cell(35, 7, utf8_decode($egresos_x), 1, null, 'R'); //texto

$pdf->Ln(7); //salto de linea
$pdf->SetFont('Arial', 'B', 11);  //fuente
$pdf->Cell(50); //mover a la derecha
$pdf->Cell(50, 7, utf8_decode('SALDO S/.'), 1); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 12);  //fuente
$pdf->Cell(100); //mover a la derecha
$pdf->Cell(35, 7, utf8_decode($saldo_x), 1, null, 'R'); //texto



$pdf->Ln(15); //salto de linea
$pdf->SetFont('Arial', null, 10);  //fuente
$pdf->Cell(20); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Lo que hago de su conocimiento para los fines correspondientes.')); //texto

$pdf->Ln(15); //salto de linea
$pdf->SetFont('Arial', '', 10);  //fuente
$pdf->Cell(70); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Atentamente;')); //texto

/*
$pdf->Ln(15); //salto de linea
$pdf->SetFont('Times', '', 11); //fuente
$pdf->Cell(137); //mover a la derecha
$pdf->Cell(40, 10, $pdf->Image('../public/images/firma_hans_white.png', null, null, 30)); //texto
*/

#$pdf->Ln(1); //salto de linea

$pdf->Ln(35); //salto de linea
$pdf->SetFont('Arial', null, 10);  //fuente
$pdf->Cell(125); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Hans Ever De la Cruz Vilca')); //texto

$pdf->Ln(4); //salto de linea
$pdf->SetFont('Arial', 'IB', 8);  //fuente
$pdf->Cell(129); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('OFICINA DE TESORERÍA -')); //texto

$pdf->Ln(4); //salto de linea
$pdf->SetFont('Arial', 'IB', 8);  //fuente
$pdf->Cell(125); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('PROGRAMACIÓN DE EGRESOS')); //texto


/*
$pdf->Ln(20); //salto de linea
$pdf->SetFont('Arial', 'I', 8);  //fuente
$pdf->Cell(15); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Adjunto.: Expediente')); //texto

$pdf->Ln(4); //salto de linea
$pdf->SetFont('Arial', 'I', 8);  //fuente
$pdf->Cell(15); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('PCC/HEDLCV')); //texto
*/

$pdf->Output('ESTADO DE CUENTA NRO. ' . $numero_estado_cuenta . '-' . $anio_fecha_informe . '-E-OT-DIGA-UNFV.pdf', 'I');