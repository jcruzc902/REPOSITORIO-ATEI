<?php
include ('../../config.php');

require ('../../librerias/FPDF/fpdf.php');

session_start();

if (isset($_SESSION['busqueda_periodo'])) {
    $periodo = $_SESSION['busqueda_periodo'];
} else {
    $periodo = "";
}

if (isset($_SESSION['busqueda_nt'])) {
    $nt = $_SESSION['busqueda_nt'];
} else {
    $nt = "";
}

if (isset($_SESSION['busqueda_anio_nt'])) {
    $anio_nt = $_SESSION['busqueda_anio_nt'];
} else {
    $anio_nt = "";
}

if (isset($_SESSION['busqueda_proveido'])) {
    $proveido = $_SESSION['busqueda_proveido'];
} else {
    $proveido = "";
}

if (isset($_SESSION['busqueda_fecha_proveido'])) {
    $fecha_proveido = $_SESSION['busqueda_fecha_proveido'];
} else {
    $fecha_proveido = "";
}

if (isset($_SESSION['busqueda_oficio'])) {
    $oficio = $_SESSION['busqueda_oficio'];
} else {
    $oficio = "";
}

if (isset($_SESSION['busqueda_fecha_oficio'])) {
    $fecha_oficio = $_SESSION['busqueda_fecha_oficio'];
} else {
    $fecha_oficio = "";
}

if (isset($_SESSION['busqueda_informe'])) {
    $informe = $_SESSION['busqueda_informe'];
} else {
    $informe = "";
}

if (isset($_SESSION['busqueda_fecha_informe'])) {
    $fecha_informe = $_SESSION['busqueda_fecha_informe'];
} else {
    $fecha_informe = "";
}

if (isset($_SESSION['busqueda_dependencia'])) {
    $dependencia = $_SESSION['busqueda_dependencia'];
} else {
    $dependencia = "";
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

$sql_devoluciones = "SELECT *,
anio_periodo.anio_periodo AS periodo_anio,
dev.nt AS nt_devolucion,
anio_nt.anio_nt AS nt_anio,
dev.proveido AS proveido,
dev.fecha_proveido AS fecha_proveido,
dev.oficio AS oficio,
dev.fecha_oficio AS fecha_oficio,
dev.informe AS informe,
dev.fecha_informe AS fecha_informe,
dep.nombre AS dependencia,
us.nombres AS nombres,
us.apaterno AS apellidopaterno,
us.amaterno AS apellidomaterno,
dev.fyh_creacion AS fyh_creacion_dev,
dev.fyh_actualizacion AS fyh_actualizacion_dev,
detalle.nro_liquidacion AS numero_recibo,
banco.nombre_banco AS nombre_banco,
detalle.nro_cuenta_banco AS nro_cuenta_banco,
detalle.importe_voucher AS importe_voucher,
detalle.fecha_voucher AS fecha_voucher,
concepto.nombre	AS nombre_concepto,
concepto_anio.anio_concepto AS anio_concepto,
ciclo.ciclo AS ciclo,
detalle.clasificador AS clasificador,
detalle.siaf_devolucion AS siaf_devolucion,
anio_siafdevolucion.anio_siaf AS anio_siafdev,
detalle.siaf_origen AS siaf_origen,
anio_siaforigen.anio_siaf AS anio_siaforigen,
tipo_documento.nombre_documento AS nombre_documento,
detalle.dni AS dni,
detalle.nombre_solicitante AS nombre_solicitante,
detalle.nombre_apoderado AS nombre_apoderado,
empresa.razon_social AS razon_social,
empresa.ruc AS ruc,
detalle.telefono AS telefono,
detalle.correo AS correo,
detalle.importe_devolucion_unfv AS importe_devolucion_unfv,
nro_cuenta.nro_cuenta AS nro_cuenta,
estado_giro.estado AS estado_giro,
detalle.saldo AS saldo,
doc_pago.nombre AS documento_pago,
detalle.numero_cheque AS numero_cheque,
detalle.fecha_cheque AS fecha_cheque,
detalle.numero_ope AS numero_ope,
detalle.fecha_ope AS fecha_ope,
detalle.numero_cci AS numero_cci,
detalle.fecha_cci AS fecha_cci,
detalle.numero_cartaorden AS numero_cartaorden,
detalle.fecha_cartaorden AS fecha_cartaorden,
detalle.nro_envio AS nro_envio,
anio_envio.anio_envio AS envio_anio,
detalle.nci AS numero_comprobante_interno,
detalle.nce AS numero_comprobante_externo,
detalle.fecha_entrega AS fecha_entrega,
cond1.condicion AS condicion_entrega,
detalle.fecha_pago AS fecha_pago,
cond2.condicion AS condicion_pago,
detalle.importe_devolucion_bn AS importe_devolucion_bn,
detalle.diferencia AS diferencia,
detalle.observacion AS observacion,
detalle.fyh_creacion AS fecha_registro_detalle,
detalle.fyh_actualizacion AS fyh_actualizacion_detalle 
FROM tb_devoluciones AS dev
INNER JOIN tb_anio_periodo AS anio_periodo ON anio_periodo.id_anio_periodo = dev.id_anio_periodo
INNER JOIN tb_anio_nt AS anio_nt ON anio_nt.id_anio_nt = dev.id_anio_nt
INNER JOIN tb_dependencias AS dep ON dep.id_dependencia = dev.id_dependencia 
INNER JOIN tb_usuarios AS us ON us.id_usuario = dev.id_usuario
LEFT JOIN tb_detalle_devolucion AS detalle ON (detalle.nt = dev.nt AND detalle.id_anio_nt = dev.id_anio_nt) 
LEFT JOIN tb_bancos AS banco ON banco.id_banco = detalle.id_banco 
LEFT JOIN tb_conceptos AS concepto ON concepto.id_concepto = detalle.id_concepto 
LEFT JOIN tb_anio_concepto AS concepto_anio ON concepto_anio.id_anio_concepto = detalle.id_anio_concepto
LEFT JOIN tb_ciclos AS ciclo ON ciclo.id_ciclo = detalle.id_ciclo_concepto 
LEFT JOIN tb_anio_siafdevolucion AS anio_siafdevolucion ON anio_siafdevolucion.id_anio_siafdevolucion = detalle.id_anio_siaf_devolucion 
LEFT JOIN tb_anio_siaforigen AS anio_siaforigen ON anio_siaforigen.id_anio_siaforigen = detalle.id_anio_siaf_origen 
LEFT JOIN tb_tipo_documento AS tipo_documento ON tipo_documento.id_tipo_documento = detalle.id_tipo_documento 
LEFT JOIN tb_empresas AS empresa ON empresa.id_empresa = detalle.id_empresa
LEFT JOIN tb_nrocuenta AS nro_cuenta ON nro_cuenta.id_nrocuenta = detalle.id_nrocuenta 
LEFT JOIN tb_estado_giro AS estado_giro ON estado_giro.id_estado_giro= detalle.id_estado_giro
LEFT JOIN tb_doc_pagos AS doc_pago ON doc_pago.id_doc_pagos = detalle.id_doc_pagos
LEFT JOIN tb_anio_envio AS anio_envio ON anio_envio.id_anio_envio = detalle.id_anio_envio
LEFT JOIN tb_condicion AS cond1 ON cond1.id_condicion = detalle.id_condicion
LEFT JOIN tb_condicion2 AS cond2 ON cond2.id_condicion2 = detalle.id_condicion2 
WHERE dev.visible != 1 ";

if (isset($_SESSION['busqueda_boton_devolucion'])) {
    if (
        !isset($periodo) && !isset($nt) && !isset($anio_nt) && !isset($proveido) && !isset($fecha_proveido) && !isset($oficio) && !isset($fecha_oficio)
        && !isset($informe) && !isset($fecha_informe) && !isset($dependencia) && !isset($desde) && !isset($hasta)
    ) {
        $sql_devoluciones .= "";
    } else {
        if (!empty($periodo)) {
            $sql_devoluciones .= " AND dev.id_anio_periodo='" . $periodo . "'";
        }

        if (!empty($nt)) {
            $sql_devoluciones .= " AND dev.nt like '%" . $nt . "%'";
        }

        if (!empty($anio_nt)) {
            $sql_devoluciones .= " AND dev.id_anio_nt='" . $anio_nt . "'";
        }

        if (!empty($proveido)) {
            $sql_devoluciones .= " AND dev.proveido like '%" . $proveido . "%'";
        }

        if (!empty($fecha_proveido)) {
            $sql_devoluciones .= " AND dev.fecha_proveido='" . $fecha_proveido . "'";
        }

        if (!empty($oficio)) {
            $sql_devoluciones .= " AND dev.oficio like '%" . $oficio . "%'";
        }

        if (!empty($fecha_oficio)) {
            $sql_devoluciones .= " AND dev.fecha_oficio='" . $fecha_oficio . "'";
        }

        if (!empty($informe)) {
            $sql_devoluciones .= " AND dev.informe like '%" . $informe . "%'";
        }

        if (!empty($fecha_informe)) {
            $sql_devoluciones .= " AND dev.fecha_informe='" . $fecha_informe . "'";
        }

        if (!empty($dependencia)) {
            $sql_devoluciones .= " AND dev.id_dependencia='" . $dependencia . "'";
        }

        if (!empty($desde) && !empty($hasta)) {
            $sql_devoluciones .= " AND dev.fyh_creacion between '" . $desde . "' and '" . $hasta . "'";
        }
    }


    $query_devoluciones = $pdo->prepare($sql_devoluciones);
    $query_devoluciones->execute();
    $devolucion_datos = $query_devoluciones->fetchAll(PDO::FETCH_ASSOC);
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
        $this->Cell(55); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('REPORTE DE DEVOLUCION DE DINERO')); //texto

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
        $this->Cell(35); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Recibo')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(55); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Banco')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(75); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Importe')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(95); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Fecha')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(115); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Estado')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(135); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Transaccion')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(155); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('N° Cuenta')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(172); //mover a la derecha
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
$importe_total=0;

if (!isset($devolucion_datos)) {
    $devolucion_datos = '';
} else {
    foreach ($devolucion_datos as $devolucion_dato) {

        if ($devolucion_dato['periodo_anio'] == "SELECCIONAR") {
            $devolucion_dato['periodo_anio'] = "";
        }

        if ($devolucion_dato['nt_anio'] == "SELECCIONAR") {
            $devolucion_dato['nt_anio'] = "";
        }

        if ($devolucion_dato['nro_cuenta'] == "SELECCIONAR") {
            $devolucion_dato['nro_cuenta'] = "";
        }

        if ($devolucion_dato['condicion_entrega'] == "SELECCIONAR") {
            $devolucion_dato['condicion_entrega'] = "";
        }

        if ($devolucion_dato['condicion_pago'] == "SELECCIONAR") {
            $devolucion_dato['condicion_pago'] = "";
        }

        if ($devolucion_dato['fyh_creacion_dev'] == "0000-00-00 00:00:00") {
            $devolucion_dato['fyh_creacion_dev'] = "";
        }

        if ($devolucion_dato["nombre_banco"] == "BANCO DE COMERCIO") {
            $devolucion_dato["nombre_banco"] = "COMERCIO";
        } else if ($devolucion_dato["nombre_banco"] == "BANCO DE CREDITO DEL PERU") {
            $devolucion_dato["nombre_banco"] = "BCP";
        } else if ($devolucion_dato["nombre_banco"] == "BANCO INTERAMERICANO DE FINANZAS (BANBIF)") {
            $devolucion_dato["nombre_banco"] = "BANBIF";
        } else if ($devolucion_dato["nombre_banco"] == "BANCO PICHINCHA") {
            $devolucion_dato["nombre_banco"] = "PICHINCHA";
        } else if ($devolucion_dato["nombre_banco"] == "BANCO DE LA NACIÓN") {
            $devolucion_dato["nombre_banco"] = "NACIÓN";
        } else if ($devolucion_dato["nombre_banco"] == "CITIBANK PERÚ") {
            $devolucion_dato["nombre_banco"] = "CITIBANK";
        } else if ($devolucion_dato["nombre_banco"] == "INTERBANK") {
            $devolucion_dato["nombre_banco"] = "INTERBANK";
        } else if ($devolucion_dato["nombre_banco"] == "MIBANCO") {
            $devolucion_dato["nombre_banco"] = "MIBANCO";
        } else if ($devolucion_dato["nombre_banco"] == "SCOTIABANK PERÚ") {
            $devolucion_dato["nombre_banco"] = "SCOTIABANK";
        } else if ($devolucion_dato["nombre_banco"] == "BANCO GNB PERÚ") {
            $devolucion_dato["nombre_banco"] = "GNB";
        } else if ($devolucion_dato["nombre_banco"] == "BANCO FALABELLA") {
            $devolucion_dato["nombre_banco"] = "FALABELLA";
        } else if ($devolucion_dato["nombre_banco"] == "BANCO RIPLEY") {
            $devolucion_dato["nombre_banco"] = "RIPLEY";
        } else if ($devolucion_dato["nombre_banco"] == "BANCO SANTANDER PERÚ") {
            $devolucion_dato["nombre_banco"] = "SANTANDER";
        } else if ($devolucion_dato["nombre_banco"] == "ALFIN BANCO") {
            $devolucion_dato["nombre_banco"] = "ALFIN";
        } else if ($devolucion_dato["nombre_banco"] == "BANK OF CHINA") {
            $devolucion_dato["nombre_banco"] = "CHINA";
        } else if ($devolucion_dato["nombre_banco"] == "BCI PERÚ") {
            $devolucion_dato["nombre_banco"] = "BCI";
        } else if ($devolucion_dato["nombre_banco"] == "ICBC PERU BANK") {
            $devolucion_dato["nombre_banco"] = "ICBC";
        } else if ($devolucion_dato["nombre_banco"] == "AGROBANCO") {
            $devolucion_dato["nombre_banco"] = "AGROBANCO";
        } else if ($devolucion_dato["nombre_banco"] == "BBVA") {
            $devolucion_dato["nombre_banco"] = "BBVA";
        } else if ($devolucion_dato["nombre_banco"] == "COFIDE") {
            $devolucion_dato["nombre_banco"] = "COFIDE";
        } else if ($devolucion_dato["nombre_banco"] == "FONDO MIVIVIENDA") {
            $devolucion_dato["nombre_banco"] = "MIVIVIENDA";
        } else if ($devolucion_dato["nombre_banco"] == "CAJA AREQUIPA") {
            $devolucion_dato["nombre_banco"] = "AREQUIPA";
        } else if ($devolucion_dato["nombre_banco"] == "CAJA CUSCO") {
            $devolucion_dato["nombre_banco"] = "CUSCO";
        } else if ($devolucion_dato["nombre_banco"] == "CAJA DEL SANTA") {
            $devolucion_dato["nombre_banco"] = "SANTA";
        } else if ($devolucion_dato["nombre_banco"] == "CAJA TRUJILLO") {
            $devolucion_dato["nombre_banco"] = "TRUJILLO";
        } else if ($devolucion_dato["nombre_banco"] == "CAJA HUANCAYO") {
            $devolucion_dato["nombre_banco"] = "HUANCAYO";
        } else if ($devolucion_dato["nombre_banco"] == "CAJA ICA") {
            $devolucion_dato["nombre_banco"] = "ICA";
        } else if ($devolucion_dato["nombre_banco"] == "CAJA MAYNAS") {
            $devolucion_dato["nombre_banco"] = "MAYNAS";
        } else if ($devolucion_dato["nombre_banco"] == "CAJA PAITA") {
            $devolucion_dato["nombre_banco"] = "PAITA";
        } else if ($devolucion_dato["nombre_banco"] == "CAJA PIURA") {
            $devolucion_dato["nombre_banco"] = "PIURA";
        } else if ($devolucion_dato["nombre_banco"] == "CAJA SULLANA") {
            $devolucion_dato["nombre_banco"] = "SULLANA";
        } else if ($devolucion_dato["nombre_banco"] == "CAJA TACNA") {
            $devolucion_dato["nombre_banco"] = "TACNA";
        } else if ($devolucion_dato["nombre_banco"] == "CAJA METROPOLITANA DE LIMA") {
            $devolucion_dato["nombre_banco"] = "LIMA";
        }
    
        if($devolucion_dato["documento_pago"]=="SELECCIONAR"){
            $devolucion_dato["documento_pago"]="";
        }

        $pdf->SetFont('Arial', '', 8); //fuente
        $pdf->Cell(1); //mover a la derecha
        $pdf->Cell(9, 5, utf8_decode($i));

        $pdf->Cell(25, 5, utf8_decode($devolucion_dato["nt_devolucion"] . '-' . $devolucion_dato["nt_anio"]));
        $pdf->Cell(20, 5, utf8_decode($devolucion_dato["numero_recibo"]));


        $pdf->Cell(20, 5, utf8_decode($devolucion_dato["nombre_banco"]));

        $devolucion_dato["importe_voucher"]=  number_format($devolucion_dato["importe_voucher"],2,'.',''); //convertir int a decimal

        $pdf->Cell(20, 5, utf8_decode($devolucion_dato["importe_voucher"]));

        $importe_total= $importe_total+$devolucion_dato["importe_voucher"];

        $theDate = new DateTime($devolucion_dato['fecha_voucher']);
        $devolucion_dato['fecha_voucher'] = $theDate->format('d/m/Y');

        $pdf->Cell(20, 5, utf8_decode($devolucion_dato["fecha_voucher"]));

        $pdf->Cell(20, 5, utf8_decode($devolucion_dato["estado_giro"]));
        $pdf->Cell(20, 5, utf8_decode($devolucion_dato["documento_pago"]));
        $pdf->Cell(17, 5, utf8_decode($devolucion_dato["nro_cuenta"]));

        $theDate = new DateTime($devolucion_dato["fyh_creacion_dev"]);
        $fecha_registro = $theDate->format('d/m/Y');
        $pdf->Cell(10, 5, utf8_decode($fecha_registro));

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

    $importe_total=  number_format($importe_total,2,'.',''); //convertir int a decimal

    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', 'B', 8);  //fuente
    $pdf->Cell(71); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('S/. '.$importe_total)); //texto

    $pdf->Ln(2); //salto de linea
    $pdf->SetFont('Arial', 'U', 8);  //fuente
    $pdf->Cell(1); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('                                                                                                                                                                                                                                             ')); //texto

}

$pdf->Output('Reporte de Devolucion de Dinero.pdf', 'I');