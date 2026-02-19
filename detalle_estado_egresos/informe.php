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



        $this->SetY(30);
        $this->SetFont('Times', 'B', 12); //fuente
        $this->Cell(70); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('OFICINA DE TESORERÍA')); //texto

        $this->SetY(38);
        $this->SetFont('Times', '', 10); //fuente
        $this->Cell(55); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('"Año de la esperanza y el fortalecimiento de la democracia"')); //texto



        $this->SetY(43);
        $this->SetTextColor(255, 95, 3);  // Establece el color del texto (en este caso es blanco)
        $this->SetFont('Times', 'U', 10); //fuente
        $this->Cell(15); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('                                                                                                                                                                               ')); //texto





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
        $this->SetFont('Arial', 'IB', 9);  //fuente
        $this->Cell(15); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('PCC/HEDLCV')); //texto

        $this->SetY(-16); //salto de linea
        $this->SetFont('Arial', 'IB', 9);  //fuente
        $this->Cell(15); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Adjunto: (folios)')); //texto
*/
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(TRUE, 5);

$theDate = new DateTime($fecha_informe);
$anio_fecha_informe = $theDate->format('Y');

$informe = str_pad($informe, 3, "0", STR_PAD_LEFT); //rellena con ceros a la izquierda

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'BU', 12);  //fuente
$pdf->Cell(43); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('INFORME DE EGRESOS N.° ' . $informe . '-' . $anio_fecha_informe . '-E-OT-DIGA-UNFV')); //texto


$pdf->Ln(10); //salto de linea
$pdf->SetFont('Arial', 'B', 9);  //fuente
$pdf->Cell(20); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('AL                       :')); //texto

/*********************************************************/
date_default_timezone_set("America/Lima");

$theDateX = new DateTime($fecha_informe);
$dia_fecha_informe = $theDateX->format('d');

$theDateY = new DateTime($fecha_informe);
$mes_fecha_informe = $theDateY->format('m');

$theDateZ = new DateTime($fecha_informe);
$anio_fecha_informe = $theDateZ->format('Y');

$dia = $dia_fecha_informe;
$mes = $mes_fecha_informe;
$anio = $anio_fecha_informe;


$fecha_cambio = date("2025-09-05");

$fecha_establecida = date("$anio-$mes-$dia");

if ($fecha_establecida < $fecha_cambio) {

    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', '', 9);  //fuente
    $pdf->Cell(47); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('LIC. PATHERSON ALEXANDER CABANILLAS CIEZA')); //texto
} else {
    
    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', '', 9);  //fuente
    $pdf->Cell(47); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('MG. LUIS IGNACIO ARAUJO CAJAMARCA')); //texto
}



$pdf->Ln(5); //salto de linea
$pdf->SetFont('Arial', '', 9);  //fuente
$pdf->Cell(47); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('JEFE DE LA OFICINA DE TESORERÍA')); //texto


$pdf->Ln(10); //salto de linea
$pdf->SetFont('Arial', 'B', 9);  //fuente
$pdf->Cell(20); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('ASUNTO             :')); //texto

//REEMPLAZAR EL GUION LARGO DEL ASUNTO
$asunto_informe = str_replace('−', '-', $asunto_informe);

$pdf->Ln(3); //salto de linea
$pdf->SetFont('Arial', '', 9);  //fuente
$pdf->Cell(47); //mover a la derecha
$pdf->MultiCell(120, 5, utf8_decode($asunto_informe . '')); //texto



$pdf->Ln(1); //salto de linea
$pdf->SetFont('Arial', 'B', 9);  //fuente
$pdf->Cell(20); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('REFERENCIA     :')); //texto

$pdf->Ln(-5); //salto de linea

if ($proveido_contabilidad != null) {
    $pdf->Ln(5); //salto de linea
    $pdf->SetFont('Arial', '', 9);  //fuente
    $pdf->Cell(47); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('PROVEIDO N°' . $proveido_contabilidad . '-OC-DIGA-UNFV')); //texto
}

if ($proveido_diga != null) {
    $pdf->Ln(5); //salto de linea
    $pdf->SetFont('Arial', '', 9);  //fuente
    $pdf->Cell(47); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('PROVEIDO N°' . $proveido_diga . '-DIGA-UNFV')); //texto

}

if ($oficio != null) {
    $pdf->Ln(5); //salto de linea
    $pdf->SetFont('Arial', '', 9);  //fuente
    $pdf->Cell(47); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('OFICIO N°' . $oficio)); //texto
}





$pdf->Ln(10); //salto de linea
$pdf->SetFont('Arial', 'B', 9);  //fuente
$pdf->Cell(20); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('FECHA                :')); //texto



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
$pdf->Cell(47); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($dia . " de " . $mes . " del " . $anio . '')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 9);  //fuente
$pdf->Cell(150); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('NT: ')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 9);  //fuente
$pdf->Cell(157); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($nt_principal)); //texto

$pdf->Ln(5);
$pdf->SetFont('Times', 'U', 10); //fuente
$pdf->Cell(15); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('      
                                                                                                                                                                            ')); //texto
/*
$theDate = new DateTime($fecha_resolucion);
$anio_fecha_resolucion = $theDate->format('Y');

$theDateX = new DateTime($fecha_resolucion);
$dia_resolucion = $theDateX->format('d');

$theDateY = new DateTime($fecha_resolucion);
$mes_resolucion = $theDateY->format('m');

$theDateZ = new DateTime($fecha_resolucion);
$anio_resolucion = $theDateZ->format('Y');

*/

//convertir cadena a fecha
$fecha_string = $fecha_resolucion;  // Cadena de fecha con formato específico
$formato = "d/m/Y";  // El formato de la fecha

$fecha_resolucion = DateTime::createFromFormat($formato, $fecha_string);


$pdf->Ln(h: 10); //salto de linea
$pdf->SetFont('Arial', '', 10);  //fuente
$pdf->Cell(15); //mover a la derecha
#$pdf->MultiCell(158, 5, utf8_decode('Por medio del presente se informan los egresos referentes a ' . mb_convert_case($actividad_principal . ' - ' . $subactividad, MB_CASE_TITLE, "UTF-8") . ', realizado por ' . $facultad . ', en mérito a la Resolución Rectoral Nº ' . $resolucion . '-CU-UNFV, con fecha ' . $dia_resolucion . '.' . $mes_resolucion . '.' . $anio_resolucion . '; el cual es el siguiente:')); //texto
$pdf->MultiCell(158, 5, utf8_decode($descripcion_informe)); //texto

if ($egresos > 0) {
    $total_acumulado = number_format($egresos, 2, '.', ','); //convertir int a decimal

    $pdf->Ln(5); //salto de linea
    $pdf->SetFont('Arial', 'B', 12);  //fuente
    $pdf->Cell(135); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('TOTAL, EGRESOS ===> S/. ' . $total_acumulado), null, null, 'R'); //texto

}





$pdf->Ln(15); //salto de linea
$pdf->SetFont('Arial', null, 10);  //fuente
$pdf->Cell(15); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Lo cual se informa, para los fines pertinentes.')); //texto

$pdf->Ln(15); //salto de linea
$pdf->SetFont('Arial', '', 10);  //fuente
$pdf->Cell(115); //mover a la derecha
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
$pdf->Cell(40, 10, utf8_decode('Juana Valeria Medina Panduro')); //texto

$pdf->Ln(4); //salto de linea
$pdf->SetFont('Arial', 'IB', 8);  //fuente
$pdf->Cell(133); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('OFICINA DE TESORERÍA -')); //texto

$pdf->Ln(4); //salto de linea
$pdf->SetFont('Arial', 'IB', 8);  //fuente
$pdf->Cell(120); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('RESPONSABLE DE ESTADO DE CUENTA O')); //texto

$pdf->Ln(4); //salto de linea
$pdf->SetFont('Arial', 'IB', 8);  //fuente
$pdf->Cell(115); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('SALDO DE ACTIVIDADES GENERADORAS EN RDR')); //texto


/*
$pdf->Ln(4); //salto de linea
$pdf->SetFont('Arial', 'IB', 8);  //fuente
$pdf->Cell(128); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('PROGRAMACIÓN DE EGRESOS')); //texto
*/

/*
$pdf->Ln(60); //salto de linea
$pdf->SetFont('Arial', 'IB', 9);  //fuente
$pdf->Cell(15); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('PCC/HEDLCV')); //texto

$pdf->Ln(4); //salto de linea
$pdf->SetFont('Arial', 'IB', 9);  //fuente
$pdf->Cell(15); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Adjunto: (folios)')); //texto
*/

$pdf->Output('INFORME DE EGRESOS NRO. ' . $informe . '-' . $anio_fecha_informe . '-E-OT-DIGA-UNFV.pdf', 'I');