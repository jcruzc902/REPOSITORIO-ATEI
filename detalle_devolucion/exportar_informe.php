<?php
include('../app/config.php');

require('../app/librerias/FPDF/fpdf.php');


session_start();

if (isset($_SESSION['sesion_user_sistemadedevoluciondedinero'])) {
    $usuario = $_SESSION['sesion_user_sistemadedevoluciondedinero'];
} else {
    $usuario = "";
}


if (isset($_SESSION['numero_tramite'])) {
    $numero_tramite = $_SESSION['numero_tramite'];
} else {
    $numero_tramite = "";
}

if (isset($_SESSION['anio_nt'])) {
    $anio_numero_tramite = $_SESSION['anio_nt'];
} else {
    $anio_numero_tramite = '';
}

if (isset($_SESSION['proveido'])) {
    $proveido = $_SESSION['proveido'];
} else {
    $proveido = '';
}

if (isset($_SESSION['fecha_proveido'])) {
    $theDate = new DateTime($_SESSION['fecha_proveido']);
    $fecha_proveido = $theDate->format('Y');
} else {
    $fecha_proveido = '';
}

if (isset($_SESSION['informe'])) {
    $informe = $_SESSION['informe'];
} else {
    $informe = '';
}

if (isset($_SESSION['fecha_informe'])) {
    $theDate = new DateTime($_SESSION['fecha_informe']);
    $fecha_informe = $theDate->format('Y');
} else {
    $fecha_informe = '';
}

if (isset($_SESSION['dependencia'])) {
    $dependencia = $_SESSION['dependencia'];
} else {
    $dependencia = '';
}


class PDF extends FPDF
{



}

$sql_detalle_devolucion = "SELECT * from pagos_realizado where numero_tramite='$numero_tramite' AND anio_numerotramite='$anio_numero_tramite'";
$query_detalle_devolucion = $pdo->prepare($sql_detalle_devolucion);
$query_detalle_devolucion->execute();
$detalle_devolucion_datos = $query_detalle_devolucion->fetchAll(PDO::FETCH_ASSOC);

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(TRUE, 15);


$pdf->Ln(1); //salto de linea
$pdf->SetFont('Times', 'B', 14); //fuente
$pdf->Cell(36); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('UNIVERSIDAD NACIONAL FEDERICO VILLAREAL')); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Helvetica', 'B', 12); //fuente
$pdf->Cell(70); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('OFICINA DE TESORERIA')); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Helvetica', 'B', 10); //fuente
$pdf->Cell(68); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('PROGRAMACION DE INGRESOS')); //texto

$informe = str_pad($informe, 3, "0", STR_PAD_LEFT); //rellena con ceros a la izquierda


$pdf->Ln(10); //salto de linea
$pdf->SetFont('Times', 'BU', 12); //fuente
$pdf->Cell(50); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode("INFORME N° " . $informe . "-" . $fecha_informe . "-D-PI-OT-DIGA-UNFV")); //texto

$pdf->Ln(10); //salto de linea
$pdf->SetFont('Times', 'B', 12); //fuente
$pdf->Cell(23); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode("AL")); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Times', 'B', 12); //fuente
$pdf->Cell(50); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode(":")); //texto


/*********************************************************/
date_default_timezone_set("America/Lima");

if (isset($_SESSION['fecha_informe'])) {
    $theDateX = new DateTime($_SESSION['fecha_informe']);
    $dia_fecha_informe = $theDateX->format('d');

    $theDateY = new DateTime($_SESSION['fecha_informe']);
    $mes_fecha_informe = $theDateY->format('m');

    $theDateZ = new DateTime($_SESSION['fecha_informe']);
    $anio_fecha_informe = $theDateZ->format('Y');
} else {
    $dia_fecha_informe = 00;
    $mes_fecha_informe = 00;
    $$anio_fecha_informe = 0000;
}

$dia = $dia_fecha_informe;
$mes = $mes_fecha_informe;
$anio = $anio_fecha_informe;

$fecha_cambio = date("2025-09-05");

$fecha_establecida = date("$anio-$mes-$dia");

if ($fecha_establecida < $fecha_cambio) {

    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Times', 'B', 12); //fuente
    $pdf->Cell(52); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode("LIC. PATHERSON ALEXANDER CABANILLAS CIEZA")); //texto
} else {

    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Times', 'B', 12); //fuente
    $pdf->Cell(52); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode("MG. LUIS IGNACIO ARAUJO CAJAMARCA")); //texto

}

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Times', 'B', 12); //fuente
$pdf->Cell(52); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode("JEFE DE LA OFICINA DE TESORERIA")); //texto

$pdf->Ln(10); //salto de linea
$pdf->SetFont('Times', 'B', 12); //fuente
$pdf->Cell(23); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode("ASUNTO")); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Times', 'B', 12); //fuente
$pdf->Cell(50); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode(":")); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Times', '', 12); //fuente
$pdf->Cell(52); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode("DEVOLUCION DE DINERO")); //texto

$item = 1;

foreach ($detalle_devolucion_datos as $detalle_devolucion_data) {
    $solicitante = $detalle_devolucion_data['solicitante'];

    $pdf->Ln(5); //salto de linea
    $pdf->SetFont('Times', '', 12); //fuente
    $pdf->Cell(52); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode($item . ". " . $solicitante)); //texto

    $item++;
}

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Times', '', 12); //fuente
$pdf->Cell(52); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($dependencia)); //texto

$pdf->Ln(10); //salto de linea
$pdf->SetFont('Times', 'B', 12); //fuente
$pdf->Cell(23); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode("REF")); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Times', 'B', 12); //fuente
$pdf->Cell(50); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode(":")); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Times', '', 12); //fuente
$pdf->Cell(52); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode("PROVEIDO N°" . $proveido . "-" . $fecha_proveido . "-DIGA-UNFV")); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Times', '', 12); //fuente
$pdf->Cell(52); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode("NT. " . $numero_tramite . "-" . $anio_numero_tramite)); //texto

$pdf->Ln(10); //salto de linea
$pdf->SetFont('Times', 'B', 12); //fuente
$pdf->Cell(23); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode("FECHA")); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Times', 'B', 12); //fuente
$pdf->Cell(50); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode(":")); //texto



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
$pdf->SetFont('Times', '', 12); //fuente
$pdf->Cell(52); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($dia . " de " . $mes . " del " . $anio)); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Times', 'U', 12); //fuente
$pdf->Cell(5); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode("                                                                                                                                                                        ")); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Times', '', 11); //fuente
$pdf->Cell(15); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode("Por el presente me dirijo a usted, para informar sobre lo indicado en el asunto, y en atención a lo")); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Times', '', 11); //fuente
$pdf->Cell(15); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode("verificado el pago realizado, el cual se detalla a continuación")); //texto

$pdf->Ln(5); //salto de linea



foreach ($detalle_devolucion_datos as $detalle_devolucion_dato) {
    $solicitante = $detalle_devolucion_dato['solicitante'];
    $apoderado = $detalle_devolucion_dato['apoderado'];
    $concepto = $detalle_devolucion_dato['nombre_concepto'];
    $monto_voucher = $detalle_devolucion_dato['monto_voucher'];
    $nro_cuenta_banco = $detalle_devolucion_dato['nro_cuenta_banco'];
    $nombre_banco = $detalle_devolucion_dato['nombre_banco'];

    $concepto = str_replace('MATRICULA', '', $concepto);
    $concepto = str_replace('PENSIONES', '', $concepto);

    $pdf->Ln(2); //salto de linea
    $pdf->SetFont('Times', 'B', 9); //fuente
    $pdf->Cell(25); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode($solicitante . " - SOLICITANTE")); //texto

    if ($apoderado != "") {
        $pdf->Ln(3); //salto de linea
        $pdf->SetFont('Times', 'B', 9); //fuente
        $pdf->Cell(25); //mover a la derecha
        $pdf->Cell(40, 10, utf8_decode($apoderado . " - APODERADO")); //texto
    }



    $pdf->Ln(3); //salto de linea
    $pdf->SetFont('Times', 'B', 9); //fuente
    $pdf->Cell(25); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode($dependencia)); //texto




    $pdf->Ln(8); //salto de linea

    $pdf->SetFont('Times', 'B', 9); //fuente
    $pdf->Cell(3); //mover a la derecha
    $pdf->Cell(20, 5, utf8_decode('N° RECIBO'), 1, 0, 'C', 0);
    $pdf->Cell(20, 5, utf8_decode('BANCO'), 1, 0, 'C', 0);
    $pdf->Cell(20, 5, utf8_decode('MONTO S/.'), 1, 0, 'C', 0);
    $pdf->Cell(18, 5, utf8_decode('FECHA'), 1, 0, 'C', 0);
    $pdf->Cell(52, 5, utf8_decode('CONCEPTO'), 1, 0, 'C', 0);
    $pdf->Cell(18, 5, utf8_decode('CLASIF.'), 1, 0, 'C', 0);
    $pdf->Cell(18, 5, utf8_decode('SIAF-DEV.'), 1, 0, 'C', 0);
    $pdf->Cell(18, 5, utf8_decode('SIAF-ORIG.'), 1, 1, 'C', 0);



    $sql_detalle = "SELECT *,
    tip_documento.nombre_documento as tipo_identificacion,
    empresa.razon_social as nombre_empresa,
    empresa.ruc as nro_ruc,
    banco.nombre_banco as nombre_banco,
    concepto.nombre as nombre_concepto,
    ciclo.ciclo as nombre_ciclo,
    anio_concepto.anio_concepto as anio_de_concepto,
    anio_siafdevolucion.anio_siaf as anio_siafdevolucion,
    anio_siaforigen.anio_siaf as anio_siaforigen,
    nrocuenta.nro_cuenta as numero_cuenta,
    anio_nt.id_anio_nt as anio_idnt,
    anio_nt.anio_nt as anio_numerotramite,
    usuario.id_usuario as id_usuario,
    usuario.nombres as nombre_usuario,
    usuario.apaterno as apaterno_usuario,
    usuario.amaterno as amaterno_usuario 
    FROM tb_detalle_devolucion as t_detalle 
    INNER JOIN tb_tipo_documento as tip_documento ON tip_documento.id_tipo_documento= t_detalle.id_tipo_documento 
    INNER JOIN tb_empresas as empresa ON empresa.id_empresa = t_detalle.id_empresa 
    INNER JOIN tb_bancos as banco ON banco.id_banco = t_detalle.id_banco 
    INNER JOIN tb_conceptos as concepto ON concepto.id_concepto= t_detalle.id_concepto 
    INNER JOIN tb_ciclos as ciclo ON ciclo.id_ciclo= t_detalle.id_ciclo_concepto 
    INNER JOIN tb_anio_concepto as anio_concepto ON anio_concepto.id_anio_concepto= t_detalle.id_anio_concepto 
    INNER JOIN tb_anio_siafdevolucion as anio_siafdevolucion ON anio_siafdevolucion.id_anio_siafdevolucion= t_detalle.id_anio_siaf_devolucion 
    INNER JOIN tb_anio_siaforigen as anio_siaforigen ON anio_siaforigen.id_anio_siaforigen = t_detalle.id_anio_siaf_origen 
    INNER JOIN tb_nrocuenta as nrocuenta ON nrocuenta.id_nrocuenta = t_detalle.id_nrocuenta
    INNER JOIN tb_usuarios as usuario ON usuario.id_usuario= t_detalle.id_usuario 
    INNER JOIN tb_anio_nt as anio_nt ON anio_nt.id_anio_nt= t_detalle.id_anio_nt 
    WHERE t_detalle.visible!=1 AND t_detalle.nombre_solicitante='$solicitante' AND t_detalle.nt='$numero_tramite'";
    $query_detalle = $pdo->prepare($sql_detalle);
    $query_detalle->execute();
    $detalle_dev = $query_detalle->fetchAll(PDO::FETCH_ASSOC);

    $monto_devolucion_total = 0.00;

    foreach ($detalle_dev as $detalle_persona) {

        $recibo_nuevo_giro = str_contains($detalle_persona['nro_liquidacion'], 'NG'); //buscar palabra



        $id_user = $detalle_persona["id_usuario"];
        $id_estado_pago = $detalle_persona["id_condicion2"];

        //si es nuevo recibo y diferente de anulado se pinta de verde

        if ($recibo_nuevo_giro == true && $id_estado_pago != 3) {
            #$monto_voucher=$monto_voucher/2; //evita duplicados en los montos
            $pdf->SetFont('Times', '', 8); //fuente
            $pdf->Cell(3); //mover a la derecha

            $pdf->SetTextColor(0, 0, 0);  // Establece el color del texto (en este caso es blanco)
            $pdf->SetFillColor(23, 194, 124); // establece el color del fondo de la celda (en este caso es VERDE)

            $detalle_persona['nro_liquidacion'] = str_replace('NGNG', 'NG', $detalle_persona['nro_liquidacion']);
            $pdf->Cell(20, 5, utf8_decode($detalle_persona['nro_liquidacion']), 1, 0, 'C', true);

            if ($detalle_persona["nombre_banco"] == "BANCO DE COMERCIO") {
                $detalle_persona["nombre_banco"] = "COMERCIO";
            } else if ($detalle_persona["nombre_banco"] == "BANCO DE CREDITO DEL PERU") {
                $detalle_persona["nombre_banco"] = "BCP";
            } else if ($detalle_persona["nombre_banco"] == "BANCO INTERAMERICANO DE FINANZAS (BANBIF)") {
                $detalle_persona["nombre_banco"] = "BANBIF";
            } else if ($detalle_persona["nombre_banco"] == "BANCO PICHINCHA") {
                $detalle_persona["nombre_banco"] = "PICHINCHA";
            } else if ($detalle_persona["nombre_banco"] == "BANCO DE LA NACIÓN") {
                $detalle_persona["nombre_banco"] = "NACIÓN";
            } else if ($detalle_persona["nombre_banco"] == "CITIBANK PERÚ") {
                $detalle_persona["nombre_banco"] = "CITIBANK";
            } else if ($detalle_persona["nombre_banco"] == "INTERBANK") {
                $detalle_persona["nombre_banco"] = "INTERBANK";
            } else if ($detalle_persona["nombre_banco"] == "MIBANCO") {
                $detalle_persona["nombre_banco"] = "MIBANCO";
            } else if ($detalle_persona["nombre_banco"] == "SCOTIABANK PERÚ") {
                $detalle_persona["nombre_banco"] = "SCOTIABANK";
            } else if ($detalle_persona["nombre_banco"] == "BANCO GNB PERÚ") {
                $detalle_persona["nombre_banco"] = "GNB";
            } else if ($detalle_persona["nombre_banco"] == "BANCO FALABELLA") {
                $detalle_persona["nombre_banco"] = "FALABELLA";
            } else if ($detalle_persona["nombre_banco"] == "BANCO RIPLEY") {
                $detalle_persona["nombre_banco"] = "RIPLEY";
            } else if ($detalle_persona["nombre_banco"] == "BANCO SANTANDER PERÚ") {
                $detalle_persona["nombre_banco"] = "SANTANDER";
            } else if ($detalle_persona["nombre_banco"] == "ALFIN BANCO") {
                $detalle_persona["nombre_banco"] = "ALFIN";
            } else if ($detalle_persona["nombre_banco"] == "BANK OF CHINA") {
                $detalle_persona["nombre_banco"] = "CHINA";
            } else if ($detalle_persona["nombre_banco"] == "BCI PERÚ") {
                $detalle_persona["nombre_banco"] = "BCI";
            } else if ($detalle_persona["nombre_banco"] == "ICBC PERU BANK") {
                $detalle_persona["nombre_banco"] = "ICBC";
            } else if ($detalle_persona["nombre_banco"] == "AGROBANCO") {
                $detalle_persona["nombre_banco"] = "AGROBANCO";
            } else if ($detalle_persona["nombre_banco"] == "BBVA") {
                $detalle_persona["nombre_banco"] = "BBVA";
            } else if ($detalle_persona["nombre_banco"] == "COFIDE") {
                $detalle_persona["nombre_banco"] = "COFIDE";
            } else if ($detalle_persona["nombre_banco"] == "FONDO MIVIVIENDA") {
                $detalle_persona["nombre_banco"] = "MIVIVIENDA";
            } else if ($detalle_persona["nombre_banco"] == "CAJA AREQUIPA") {
                $detalle_persona["nombre_banco"] = "AREQUIPA";
            } else if ($detalle_persona["nombre_banco"] == "CAJA CUSCO") {
                $detalle_persona["nombre_banco"] = "CUSCO";
            } else if ($detalle_persona["nombre_banco"] == "CAJA DEL SANTA") {
                $detalle_persona["nombre_banco"] = "SANTA";
            } else if ($detalle_persona["nombre_banco"] == "CAJA TRUJILLO") {
                $detalle_persona["nombre_banco"] = "TRUJILLO";
            } else if ($detalle_persona["nombre_banco"] == "CAJA HUANCAYO") {
                $detalle_persona["nombre_banco"] = "HUANCAYO";
            } else if ($detalle_persona["nombre_banco"] == "CAJA ICA") {
                $detalle_persona["nombre_banco"] = "ICA";
            } else if ($detalle_persona["nombre_banco"] == "CAJA MAYNAS") {
                $detalle_persona["nombre_banco"] = "MAYNAS";
            } else if ($detalle_persona["nombre_banco"] == "CAJA PAITA") {
                $detalle_persona["nombre_banco"] = "PAITA";
            } else if ($detalle_persona["nombre_banco"] == "CAJA PIURA") {
                $detalle_persona["nombre_banco"] = "PIURA";
            } else if ($detalle_persona["nombre_banco"] == "CAJA SULLANA") {
                $detalle_persona["nombre_banco"] = "SULLANA";
            } else if ($detalle_persona["nombre_banco"] == "CAJA TACNA") {
                $detalle_persona["nombre_banco"] = "TACNA";
            } else if ($detalle_persona["nombre_banco"] == "CAJA METROPOLITANA DE LIMA") {
                $detalle_persona["nombre_banco"] = "LIMA";
            }

            $pdf->Cell(20, 5, utf8_decode($detalle_persona['nombre_banco']), 1, 0, 'C', true);

            $detalle_persona["importe_voucher"] = number_format($detalle_persona["importe_voucher"], 2, '.', ''); //convertir int a decimal

            $monto_devolucion_total += $detalle_persona["importe_devolucion_unfv"];  //solo suma los nuevos giros

            $pdf->Cell(20, 5, utf8_decode($detalle_persona['importe_voucher']), 1, 0, 'C', true);



            $theDate = new DateTime($detalle_persona['fecha_voucher']);
            $detalle_persona['fecha_voucher'] = $theDate->format('d/m/Y');

            $pdf->Cell(18, 5, utf8_decode($detalle_persona['fecha_voucher']), 1, 0, 'C', true);




            $pdf->Cell(52, 5, utf8_decode(substr($detalle_persona["nombre_concepto"], 0, 27)), 1, 0, 'C', true);
            $pdf->Cell(18, 5, utf8_decode($detalle_persona['clasificador']), 1, 0, 'C', true);

            $pdf->SetTextColor(0, 0, 0);  // Establece el color del texto (en este caso es blanco)
            $pdf->SetFillColor(255, 179, 3); // establece el color del fondo de la celda (en este caso es AMARILLO
            $pdf->Cell(18, 5, utf8_decode($detalle_persona['siaf_devolucion']), 1, 0, 'C', true);

            $pdf->SetTextColor(0, 0, 0);  // Establece el color del texto (en este caso es blanco)
            $pdf->SetFillColor(23, 194, 124); // establece el color del fondo de la celda (en este caso es VERDE
            $pdf->Cell(18, 5, utf8_decode($detalle_persona['siaf_origen']), 1, 1, 'C', true);

        }

        if ($recibo_nuevo_giro == false && $id_estado_pago != 3) {

            $pdf->SetFont('Times', '', 8); //fuente
            $pdf->Cell(3); //mover a la derecha
            $pdf->Cell(20, 5, utf8_decode($detalle_persona['nro_liquidacion']), 1, 0, 'C', 0);

            if ($detalle_persona["nombre_banco"] == "BANCO DE COMERCIO") {
                $detalle_persona["nombre_banco"] = "COMERCIO";
            } else if ($detalle_persona["nombre_banco"] == "BANCO DE CREDITO DEL PERU") {
                $detalle_persona["nombre_banco"] = "BCP";
            } else if ($detalle_persona["nombre_banco"] == "BANCO INTERAMERICANO DE FINANZAS (BANBIF)") {
                $detalle_persona["nombre_banco"] = "BANBIF";
            } else if ($detalle_persona["nombre_banco"] == "BANCO PICHINCHA") {
                $detalle_persona["nombre_banco"] = "PICHINCHA";
            } else if ($detalle_persona["nombre_banco"] == "BANCO DE LA NACIÓN") {
                $detalle_persona["nombre_banco"] = "NACIÓN";
            } else if ($detalle_persona["nombre_banco"] == "CITIBANK PERÚ") {
                $detalle_persona["nombre_banco"] = "CITIBANK";
            } else if ($detalle_persona["nombre_banco"] == "INTERBANK") {
                $detalle_persona["nombre_banco"] = "INTERBANK";
            } else if ($detalle_persona["nombre_banco"] == "MIBANCO") {
                $detalle_persona["nombre_banco"] = "MIBANCO";
            } else if ($detalle_persona["nombre_banco"] == "SCOTIABANK PERÚ") {
                $detalle_persona["nombre_banco"] = "SCOTIABANK";
            } else if ($detalle_persona["nombre_banco"] == "BANCO GNB PERÚ") {
                $detalle_persona["nombre_banco"] = "GNB";
            } else if ($detalle_persona["nombre_banco"] == "BANCO FALABELLA") {
                $detalle_persona["nombre_banco"] = "FALABELLA";
            } else if ($detalle_persona["nombre_banco"] == "BANCO RIPLEY") {
                $detalle_persona["nombre_banco"] = "RIPLEY";
            } else if ($detalle_persona["nombre_banco"] == "BANCO SANTANDER PERÚ") {
                $detalle_persona["nombre_banco"] = "SANTANDER";
            } else if ($detalle_persona["nombre_banco"] == "ALFIN BANCO") {
                $detalle_persona["nombre_banco"] = "ALFIN";
            } else if ($detalle_persona["nombre_banco"] == "BANK OF CHINA") {
                $detalle_persona["nombre_banco"] = "CHINA";
            } else if ($detalle_persona["nombre_banco"] == "BCI PERÚ") {
                $detalle_persona["nombre_banco"] = "BCI";
            } else if ($detalle_persona["nombre_banco"] == "ICBC PERU BANK") {
                $detalle_persona["nombre_banco"] = "ICBC";
            } else if ($detalle_persona["nombre_banco"] == "AGROBANCO") {
                $detalle_persona["nombre_banco"] = "AGROBANCO";
            } else if ($detalle_persona["nombre_banco"] == "BBVA") {
                $detalle_persona["nombre_banco"] = "BBVA";
            } else if ($detalle_persona["nombre_banco"] == "COFIDE") {
                $detalle_persona["nombre_banco"] = "COFIDE";
            } else if ($detalle_persona["nombre_banco"] == "FONDO MIVIVIENDA") {
                $detalle_persona["nombre_banco"] = "MIVIVIENDA";
            } else if ($detalle_persona["nombre_banco"] == "CAJA AREQUIPA") {
                $detalle_persona["nombre_banco"] = "AREQUIPA";
            } else if ($detalle_persona["nombre_banco"] == "CAJA CUSCO") {
                $detalle_persona["nombre_banco"] = "CUSCO";
            } else if ($detalle_persona["nombre_banco"] == "CAJA DEL SANTA") {
                $detalle_persona["nombre_banco"] = "SANTA";
            } else if ($detalle_persona["nombre_banco"] == "CAJA TRUJILLO") {
                $detalle_persona["nombre_banco"] = "TRUJILLO";
            } else if ($detalle_persona["nombre_banco"] == "CAJA HUANCAYO") {
                $detalle_persona["nombre_banco"] = "HUANCAYO";
            } else if ($detalle_persona["nombre_banco"] == "CAJA ICA") {
                $detalle_persona["nombre_banco"] = "ICA";
            } else if ($detalle_persona["nombre_banco"] == "CAJA MAYNAS") {
                $detalle_persona["nombre_banco"] = "MAYNAS";
            } else if ($detalle_persona["nombre_banco"] == "CAJA PAITA") {
                $detalle_persona["nombre_banco"] = "PAITA";
            } else if ($detalle_persona["nombre_banco"] == "CAJA PIURA") {
                $detalle_persona["nombre_banco"] = "PIURA";
            } else if ($detalle_persona["nombre_banco"] == "CAJA SULLANA") {
                $detalle_persona["nombre_banco"] = "SULLANA";
            } else if ($detalle_persona["nombre_banco"] == "CAJA TACNA") {
                $detalle_persona["nombre_banco"] = "TACNA";
            } else if ($detalle_persona["nombre_banco"] == "CAJA METROPOLITANA DE LIMA") {
                $detalle_persona["nombre_banco"] = "LIMA";
            }

            $pdf->Cell(20, 5, utf8_decode($detalle_persona['nombre_banco']), 1, 0, 'C', 0);

            $detalle_persona["importe_voucher"] = number_format($detalle_persona["importe_voucher"], 2, '.', ''); //convertir int a decimal

            #$monto_devolucion_total= $detalle_persona["importe_voucher"];

            $pdf->Cell(20, 5, utf8_decode($detalle_persona['importe_voucher']), 1, 0, 'C', 0);


            $theDate = new DateTime($detalle_persona['fecha_voucher']);
            $detalle_persona['fecha_voucher'] = $theDate->format('d/m/Y');

            $pdf->Cell(18, 5, utf8_decode($detalle_persona['fecha_voucher']), 1, 0, 'C', 0);




            $pdf->Cell(52, 5, utf8_decode(substr($detalle_persona["nombre_concepto"], 0, 27)), 1, 0, 'C', 0);
            $pdf->Cell(18, 5, utf8_decode($detalle_persona['clasificador']), 1, 0, 'C', 0);

            $pdf->SetTextColor(0, 0, 0);  // Establece el color del texto (en este caso es blanco)
            $pdf->SetFillColor(255, 179, 3); // establece el color del fondo de la celda (en este caso es AMARILLO
            $pdf->Cell(18, 5, utf8_decode($detalle_persona['siaf_devolucion']), 1, 0, 'C', true);
            $pdf->Cell(18, 5, utf8_decode($detalle_persona['siaf_origen']), 1, 1, 'C', 0);

        }


    }

    $monto_voucher = number_format($monto_voucher, 2, '.', ''); //convertir int a decimal

    if ($monto_devolucion_total == null) {
        $monto_devolucion_total = $monto_voucher;
    }

    $monto_devolucion_total = number_format($monto_devolucion_total, 2, '.', ','); //convertir int a decimal

    $pdf->Ln(1); //salto de linea
    $pdf->SetFont('Times', '', 11); //fuente
    $pdf->Cell(15); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('La devolución es por el monto de S/. ' . $monto_devolucion_total . ' soles, y se afectaría a la Cta.Cte. N° ' . $nro_cuenta_banco)); //texto

    $pdf->Ln(5); //salto de linea
    $pdf->SetFont('Times', '', 11); //fuente
    $pdf->Cell(15); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('del ' . $nombre_banco . ', por ser Recursos Directamente Recaudados no tiene')); //texto

    $pdf->Ln(5); //salto de linea
    $pdf->SetFont('Times', '', 11); //fuente
    $pdf->Cell(15); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('afectación presupuestal, se ejecutará el giro rebajando del ingreso obtenido del mismo día.')); //texto


    $pdf->Ln(5); //salto de linea

}

/*FIRMA DE WILLIAM Y JOEL*/

$pdf->Ln(10); //salto de linea
$pdf->SetFont('Times', '', 11); //fuente
$pdf->Cell(25); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Atentamente,')); //texto

/*
$pdf->Ln(15); //salto de linea
$pdf->SetFont('Times', '', 11); //fuente
$pdf->Cell(25); //mover a la derecha
$pdf->Cell(40, 10, $pdf->Image('../public/images/firma_william.png', null, null, 40)); //texto

$pdf->Ln(-15); //salto de linea
$pdf->SetFont('Times', '', 11); //fuente
$pdf->Cell(120); //mover a la derecha
$pdf->Cell(40, 10, $pdf->Image('../public/images/firma_joel.png', null, null, 40)); //texto
*/


$pdf->Ln(10); //salto de linea





if ($usuario == "jvillanueva") {
    //$personal_ingreso = "JOHN EDINSON VILLANUEVA GERONIMO";
    $pdf->Ln(1); //salto de linea
    $pdf->SetFont('Times', '', 8); //fuente
    //$pdf->Cell(20); //mover a la derecha
    $pdf->Cell(70); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('JOHN EDINSON VILLANUEVA GERONIMO')); //texto

    $pdf->Ln(3); //salto de linea
    $pdf->SetFont('Times', '', 8); //fuente
    //$pdf->Cell(30); //mover a la derecha
    $pdf->Cell(73); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('Jefe (e) de la Unidad de Ingreso y Cobranza')); //texto
} else if ($usuario == "wcruz") {
    $pdf->Ln(10); //salto de linea
    $pdf->SetFont('Times', '', 8); //fuente
    //$pdf->Cell(25); //mover a la derecha
    $pdf->Cell(20); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('LIC. WILLIAM DE LA CRUZ CARRILLO')); //texto


    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Times', '', 8); //fuente
    //$pdf->Cell(20); //mover a la derecha
    $pdf->Cell(115); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('JOHN EDINSON VILLANUEVA GERONIMO')); //texto

    $pdf->Ln(3); //salto de linea
    $pdf->SetFont('Times', '', 8); //fuente
    //$pdf->Cell(30); //mover a la derecha
    $pdf->Cell(28); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('Unidad de Ingreso y Cobranza')); //texto

    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Times', '', 8); //fuente
    //$pdf->Cell(30); //mover a la derecha
    $pdf->Cell(118); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('Jefe (e) de la Unidad de Ingreso y Cobranza')); //texto
}






/*
$pdf->Ln(1); //salto de linea
$pdf->SetFont('Times', '', 8); //fuente
$pdf->Cell(117); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('JOHN EDINSON VILLANUEVA GERONIMO')); //texto

$pdf->Ln(3); //salto de linea
$pdf->SetFont('Times', '', 8); //fuente
$pdf->Cell(120); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Jefe (e) de la Unidad de Ingreso y Cobranza')); //texto
*/


$nombre_archivo = 'INFORME NRO. ' . $informe . '-' . $fecha_informe . '-D-PI-OT-DIGA-UNFV.pdf';

$pdf->Output('I', $nombre_archivo);