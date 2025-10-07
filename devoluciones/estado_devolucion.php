<?php

include ('../app/config.php');
include ('../layout/sesion.php');


include ('../app/controllers/devolucion/show_devolucion.php');


require ('../app/librerias/FPDF/fpdf.php');

$sql_detalle_devolucion = "SELECT *, 
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
giro.estado as estado_giro,
docpago.nombre as nombre_docpago,
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
INNER JOIN tb_estado_giro as giro ON giro.id_estado_giro= t_detalle.id_estado_giro 
INNER JOIN tb_doc_pagos as docpago ON docpago.id_doc_pagos= t_detalle.id_doc_pagos 
WHERE t_detalle.visible!=1 AND t_detalle.nt='$numero_tramite' AND anio_nt.id_anio_nt='$id_anio_nt'";
$query_detalle_devolucion = $pdo->prepare($sql_detalle_devolucion);
$query_detalle_devolucion->execute();
$detalle_devolucion_datos = $query_detalle_devolucion->fetchAll(PDO::FETCH_ASSOC);

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
        $this->Cell(40, 10, utf8_decode('ESTADO DE DEVOLUCION DE DINERO')); //texto

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
$pdf->Cell(40, 10, utf8_decode('Periodo:')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(18); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($periodo_anio)); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(40); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('NT:')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(47); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($numero_tramite . " - " . $nt_anio)); //texto


$pdf->Ln(5); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(5); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Proveido:')); //texto

if ($fecha_proveido == "0000-00-00") {
    $fecha_proveido_anio = "";
} else {
    $theDate = new DateTime($fecha_proveido);
    $fecha_proveido_anio = $theDate->format('Y');
}

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(20); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($proveido."-".$fecha_proveido_anio."-DIGA-UNFV")); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(100); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Fecha:')); //texto

if ($fecha_proveido == "0000-00-00") {
    $fecha_proveido = "";
} else {
    $theDate = new DateTime($fecha_proveido);
    $fecha_proveido = $theDate->format('d/m/Y');
}

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(110); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($fecha_proveido)); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(5); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Oficio:')); //texto



$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(16); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($oficio)); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(100); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Fecha:')); //texto

if ($fecha_oficio == "0000-00-00") {
    $fecha_oficio = "";
} else {
    $theDate = new DateTime($fecha_oficio);
    $fecha_oficio = $theDate->format('d/m/Y');
}

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(110); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($fecha_oficio)); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(5); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Informe:')); //texto

if ($fecha_informe == "0000-00-00") {
    $fecha_informe_anio = "";
} else {
    $theDate = new DateTime($fecha_informe);
    $fecha_informe_anio = $theDate->format('Y');
}

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(18); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($informe."-".$fecha_informe_anio."-D-PI-OT-DIGA-UNFV")); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(100); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Fecha:')); //texto

if ($fecha_informe == "0000-00-00") {
    $fecha_informe = "";
} else {
    $theDate = new DateTime($fecha_informe);
    $fecha_informe = $theDate->format('d/m/Y');
}

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(110); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($fecha_informe)); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(5); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Dependencia:')); //texto

if ($dependencia == "SELECCIONAR") {
    $dependencia = "";
}

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(25); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($dependencia)); //texto




$pdf->Line(15, 105, 194, 105); //LINEA

$pdf->Ln(12); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(7); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('N°')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(15); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('N° Recibo')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(35); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Banco')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(55); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Monto (S/.)')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(75); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Fecha')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(95); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Concepto')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(135); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Estado')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(160); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Transaccion')); //texto




$pdf->Line(15, 110, 194, 110); //LINEA

$i=1;
$total_devolucion= 0;
$pdf->Ln(10); //salto de linea

foreach ($detalle_devolucion_datos as $detalle_devolucion_dato) {
    

    if ($detalle_devolucion_dato["nombre_banco"] == "BANCO DE COMERCIO") {
        $detalle_devolucion_dato["nombre_banco"] = "COMERCIO";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "BANCO DE CREDITO DEL PERU") {
        $detalle_devolucion_dato["nombre_banco"] = "BCP";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "BANCO INTERAMERICANO DE FINANZAS (BANBIF)") {
        $detalle_devolucion_dato["nombre_banco"] = "BANBIF";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "BANCO PICHINCHA") {
        $detalle_devolucion_dato["nombre_banco"] = "PICHINCHA";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "BANCO DE LA NACIÓN") {
        $detalle_devolucion_dato["nombre_banco"] = "NACIÓN";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "CITIBANK PERÚ") {
        $detalle_devolucion_dato["nombre_banco"] = "CITIBANK";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "INTERBANK") {
        $detalle_devolucion_dato["nombre_banco"] = "INTERBANK";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "MIBANCO") {
        $detalle_devolucion_dato["nombre_banco"] = "MIBANCO";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "SCOTIABANK PERÚ") {
        $detalle_devolucion_dato["nombre_banco"] = "SCOTIABANK";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "BANCO GNB PERÚ") {
        $detalle_devolucion_dato["nombre_banco"] = "GNB";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "BANCO FALABELLA") {
        $detalle_devolucion_dato["nombre_banco"] = "FALABELLA";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "BANCO RIPLEY") {
        $detalle_devolucion_dato["nombre_banco"] = "RIPLEY";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "BANCO SANTANDER PERÚ") {
        $detalle_devolucion_dato["nombre_banco"] = "SANTANDER";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "ALFIN BANCO") {
        $detalle_devolucion_dato["nombre_banco"] = "ALFIN";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "BANK OF CHINA") {
        $detalle_devolucion_dato["nombre_banco"] = "CHINA";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "BCI PERÚ") {
        $detalle_devolucion_dato["nombre_banco"] = "BCI";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "ICBC PERU BANK") {
        $detalle_devolucion_dato["nombre_banco"] = "ICBC";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "AGROBANCO") {
        $detalle_devolucion_dato["nombre_banco"] = "AGROBANCO";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "BBVA") {
        $detalle_devolucion_dato["nombre_banco"] = "BBVA";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "COFIDE") {
        $detalle_devolucion_dato["nombre_banco"] = "COFIDE";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "FONDO MIVIVIENDA") {
        $detalle_devolucion_dato["nombre_banco"] = "MIVIVIENDA";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "CAJA AREQUIPA") {
        $detalle_devolucion_dato["nombre_banco"] = "AREQUIPA";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "CAJA CUSCO") {
        $detalle_devolucion_dato["nombre_banco"] = "CUSCO";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "CAJA DEL SANTA") {
        $detalle_devolucion_dato["nombre_banco"] = "SANTA";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "CAJA TRUJILLO") {
        $detalle_devolucion_dato["nombre_banco"] = "TRUJILLO";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "CAJA HUANCAYO") {
        $detalle_devolucion_dato["nombre_banco"] = "HUANCAYO";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "CAJA ICA") {
        $detalle_devolucion_dato["nombre_banco"] = "ICA";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "CAJA MAYNAS") {
        $detalle_devolucion_dato["nombre_banco"] = "MAYNAS";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "CAJA PAITA") {
        $detalle_devolucion_dato["nombre_banco"] = "PAITA";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "CAJA PIURA") {
        $detalle_devolucion_dato["nombre_banco"] = "PIURA";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "CAJA SULLANA") {
        $detalle_devolucion_dato["nombre_banco"] = "SULLANA";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "CAJA TACNA") {
        $detalle_devolucion_dato["nombre_banco"] = "TACNA";
    } else if ($detalle_devolucion_dato["nombre_banco"] == "CAJA METROPOLITANA DE LIMA") {
        $detalle_devolucion_dato["nombre_banco"] = "LIMA";
    }

    if($detalle_devolucion_dato["nombre_docpago"]=="SELECCIONAR"){
        $detalle_devolucion_dato["nombre_docpago"]="";
    }

    $pdf->SetFont('Arial', '', 8); //fuente
    $pdf->Cell(7); //mover a la derecha
    $pdf->Cell(8, 5, utf8_decode($i));
    $pdf->Cell(20, 5, utf8_decode($detalle_devolucion_dato["nro_liquidacion"]));


    $pdf->Cell(20, 5, utf8_decode($detalle_devolucion_dato["nombre_banco"]));

    $detalle_devolucion_dato["importe_voucher"]=  number_format($detalle_devolucion_dato["importe_voucher"],2,'.',''); //convertir int a decimal    

    $total_devolucion= $total_devolucion + $detalle_devolucion_dato["importe_voucher"];
    $pdf->Cell(20, 5, utf8_decode($detalle_devolucion_dato["importe_voucher"]));

    $theDate = new DateTime($detalle_devolucion_dato["fecha_voucher"]);
    $detalle_devolucion_dato["fecha_voucher"] = $theDate->format('d/m/Y');

    $pdf->Cell(20, 5, utf8_decode($detalle_devolucion_dato["fecha_voucher"]));
    $pdf->Cell(40, 5, utf8_decode(substr($detalle_devolucion_dato["nombre_concepto"],0,20)));
    $pdf->Cell(25, 5, utf8_decode($detalle_devolucion_dato["estado_giro"]));
    $pdf->Cell(20, 5, utf8_decode($detalle_devolucion_dato["nombre_docpago"]));
    

    $i++;
    $pdf->Ln();
}



$pdf->Ln(-4); //salto de linea
$pdf->SetFont('Arial', 'U', 8);  //fuente
$pdf->Cell(4); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('                                                                                                                                                                                                                                    ')); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(40); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('TOTAL')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(55); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode(number_format($total_devolucion,2,'.',''))); //texto


$pdf->Output('Estado de Devolucion de Dinero.pdf', 'I');