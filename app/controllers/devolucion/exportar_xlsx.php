<?php
include('../../config.php');
//call the autoload
require '../../../vendor/autoload.php';

//load phpspreadsheet class using namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
//call iofactory instead of xlsx writer
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard\Currency;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard\Number;




$fileName = "REPORTE DE DEVOLUCION DE DINERO " . date('d-m-Y H:i:s') . ".xlsx";

//styling arrays
//table head style
$tableHead = [
    'font' => [
        'color' => [
            'rgb' => 'FFFFFF'
        ],
        'bold' => true,
        'size' => 11
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => '000000'
        ]
    ],
];
//even row
$evenRow = [
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'FFF8D2'
        ]
    ]
];
//odd row
$oddRow = [
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'FFFBE5'
        ]
    ]
];

//styling arrays end

//make a new spreadsheet object
$spreadsheet = new Spreadsheet();
//get current active sheet (first sheet)
$sheet = $spreadsheet->getActiveSheet();

//set default font
$spreadsheet->getDefaultStyle()
    ->getFont()
    ->setName('Arial')
    ->setSize(10);

$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$drawing->setName('logo');
$drawing->setDescription('logo');
$drawing->setPath('../../../public/images/logo2_unfv.jpg'); // put your path and image here
$drawing->setCoordinates('A1');
$drawing->getShadow()->setVisible(true);
$drawing->setWidth(147);
$drawing->setWorksheet($spreadsheet->getActiveSheet());

//heading
$spreadsheet->getActiveSheet()
    ->setCellValue('B1', "REPORTE DE DEVOLUCION DE DINERO - OFICINA DE TESORERIA");

//merge heading
$spreadsheet->getActiveSheet()->mergeCells("B1:BI1");

// set font style
$spreadsheet->getActiveSheet()->getStyle('B1')->getFont()->setSize(30);

// set font style
$spreadsheet->getActiveSheet()->getStyle('B1')->getFont()->setName('Cambria');

// set font style
$spreadsheet->getActiveSheet()->getStyle('B1')->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_DARKBLUE));

// set font style
$spreadsheet->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);

// set cell alignment
$spreadsheet->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

//setting column width
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(21);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('T')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('U')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('V')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('W')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('X')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('Y')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('Z')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AA')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AB')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AC')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AD')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AE')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AF')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AG')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AH')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AI')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AJ')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AK')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AL')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AM')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AN')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AO')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AP')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AQ')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AR')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AS')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AT')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AU')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AV')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AW')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AX')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AY')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AZ')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('BA')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('BB')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('BC')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('BD')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('BE')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('BF')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('BG')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('BH')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('BI')->setWidth(40);

//header text
$spreadsheet->getActiveSheet()
    ->setCellValue('A2', "ID")
    ->setCellValue('B2', "PERIODO")
    ->setCellValue('C2', "NT")
    ->setCellValue('D2', "AÑO")
    ->setCellValue('E2', "PROVEIDO")
    ->setCellValue('F2', "FECHA")
    ->setCellValue('G2', "OFICIO")
    ->setCellValue('H2', "FECHA")
    ->setCellValue('I2', "INFORME")
    ->setCellValue('J2', "FECHA")
    ->setCellValue('K2', "DEPENDENCIA")
    ->setCellValue('L2', "OBSERVACION NT")
    ->setCellValue('M2', "N° RECIBO")
    ->setCellValue('N2', "NOMBRE DEL BANCO")
    ->setCellValue('O2', "N° CUENTA DE BANCO")
    ->setCellValue('P2', "IMPORTE DEL VOUCHER")
    ->setCellValue('Q2', "FECHA DEL VOUCHER")
    ->setCellValue('R2', "CONCEPTO")
    ->setCellValue('S2', "AÑO")
    ->setCellValue('T2', "CICLO")
    ->setCellValue('U2', "CLASIFICADOR")
    ->setCellValue('V2', "SIAF (DEVOLUCION)")
    ->setCellValue('W2', "AÑO")
    ->setCellValue('X2', "SIAF (ORIGEN)")
    ->setCellValue('Y2', "AÑO")
    ->setCellValue('Z2', "TIPO DE IDENTIFICACION")
    ->setCellValue('AA2', "DNI")
    ->setCellValue('AB2', "NOMBRE DEL SOLICITANTE")
    ->setCellValue('AC2', "NOMBRE DEL APODERADO")
    ->setCellValue('AD2', "EMPRESA")
    ->setCellValue('AE2', "N° RUC")
    ->setCellValue('AF2', "TELEFONO")
    ->setCellValue('AG2', "CORREO")
    ->setCellValue('AH2', "IMPORTE DEVOLUCION (UNFV)")
    ->setCellValue('AI2', "N° CUENTA")
    ->setCellValue('AJ2', "ESTADO DE GIRO")
    ->setCellValue('AK2', "OBSERVACION (ESTADO DE GIRO)")
    ->setCellValue('AL2', "SALDO")
    ->setCellValue('AM2', "DOCUMENTO DE PAGO")
    ->setCellValue('AN2', "N° CHEQUE")
    ->setCellValue('AO2', "FECHA CHEQUE")
    ->setCellValue('AP2', "N° ENVIO")
    ->setCellValue('AQ2', "AÑO")
    ->setCellValue('AR2', "N° OPE")
    ->setCellValue('AS2', "FECHA OPE")
    ->setCellValue('AT2', "N° CCI")
    ->setCellValue('AU2', "FECHA CCI")
    ->setCellValue('AV2', "N° CARTA ORDEN")
    ->setCellValue('AW2', "FECHA CARTA ORDEN")
    ->setCellValue('AX2', "N° COMPROB. INTERNO")
    ->setCellValue('AY2', "N° COMPROB. EXTERNO")
    ->setCellValue('AZ2', "FECHA ENTREGA (PAGADURIA)")
    ->setCellValue('BA2', "CONDICION")
    ->setCellValue('BB2', "FECHA PAGO (BN)")
    ->setCellValue('BC2', "CONDICION")
    ->setCellValue('BD2', "IMPORTE DEVOLUCION (BN)")
    ->setCellValue('BE2', "DIFERENCIA")
    ->setCellValue('BF2', "OBSERVACION")
    ->setCellValue('BG2', "FECHA REGISTRO")
    ->setCellValue('BH2', "FECHA ACTUALIZACION")
    ->setCellValue('BI2', "USUARIO");




//set font style and background color
$spreadsheet->getActiveSheet()->getStyle('A2:BI2')->applyFromArray($tableHead); //estilo de fondo en la cabecera
$spreadsheet->getActiveSheet()->getStyle('A2:BI2')->getAlignment()->setHorizontal('center'); //alineacion cental
$spreadsheet->getActiveSheet()->freezePane('A3'); //Congela la pantalla


$styleArray = [

    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],

];

$spreadsheet->getActiveSheet()->getStyle('A2:BI2')->applyFromArray($styleArray);


#BASE DE DATOS
$contador = 0;
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

if (isset($_SESSION['busqueda_documento_pago'])) {
    $documento_pago = $_SESSION['busqueda_documento_pago'];
} else {
    $documento_pago = "";
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
dev.observacion_devolucion AS observacion_devolucion,
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
detalle.observacion_giro AS observacion_giro,
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
WHERE dev.visible >= 0 ";

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

if (!isset($devolucion_datos)) {
    $devolucion_datos = '';
} else {
    $row = 3;
    foreach ($devolucion_datos as $devolucion_dato) {

        if ($devolucion_dato['fecha_proveido'] == "0000-00-00") {
            $devolucion_dato['fecha_proveido'] = "";
        }

        if ($devolucion_dato['fecha_proveido'] == "0000-00-00") {
            $fecha_proveido_anio = "";
        } else {
            $theDate = new DateTime($devolucion_dato['fecha_proveido']);
            $fecha_proveido_anio = $theDate->format('Y');
        }

        if ($devolucion_dato['fecha_oficio'] == "0000-00-00") {
            $devolucion_dato['fecha_oficio'] = "";
        }

        if ($devolucion_dato['fecha_informe'] == "0000-00-00") {
            $devolucion_dato['fecha_informe'] = "";
        }

        if ($devolucion_dato['fecha_informe'] == "0000-00-00") {
            $fecha_informe_anio = "";
        } else {
            $theDate = new DateTime($devolucion_dato['fecha_informe']);
            $fecha_informe_anio = $theDate->format('Y');
        }

        if ($devolucion_dato['dependencia'] == "SELECCIONAR") {
            $devolucion_dato['dependencia'] = "";
        }

        if ($devolucion_dato['documento_pago'] == "SELECCIONAR") {
            $devolucion_dato['documento_pago'] = "";
        }

        if ($devolucion_dato['fecha_cheque'] == "0000-00-00") {
            $devolucion_dato['fecha_cheque'] = "";
        }

        if ($devolucion_dato['fecha_ope'] == "0000-00-00") {
            $devolucion_dato['fecha_ope'] = "";
        }

        if ($devolucion_dato['fecha_cci'] == "0000-00-00") {
            $devolucion_dato['fecha_cci'] = "";
        }

        if ($devolucion_dato['fecha_cartaorden'] == "0000-00-00") {
            $devolucion_dato['fecha_cartaorden'] = "";
        }

        if ($devolucion_dato['envio_anio'] == "SELECCIONAR") {
            $devolucion_dato['envio_anio'] = "";
        }

        if ($devolucion_dato['fecha_entrega'] == "0000-00-00") {
            $devolucion_dato['fecha_entrega'] = "";
        }

        if ($devolucion_dato['condicion_entrega'] == "SELECCIONAR") {
            $devolucion_dato['condicion_entrega'] = "";
        }

        if ($devolucion_dato['fecha_pago'] == "0000-00-00") {
            $devolucion_dato['fecha_pago'] = "";
        }

        if ($devolucion_dato['condicion_pago'] == "SELECCIONAR") {
            $devolucion_dato['condicion_pago'] = "";
        }

        if ($devolucion_dato['ciclo'] == "SELECCIONAR") {
            $devolucion_dato['ciclo'] = "";
        }

        if ($devolucion_dato['razon_social'] == "SELECCIONAR") {
            $devolucion_dato['razon_social'] = "";
        }

        if ($devolucion_dato['ruc'] == "SELECCIONAR") {
            $devolucion_dato['ruc'] = "";
        }

        if ($devolucion_dato['fyh_actualizacion_detalle'] == "0000-00-00 00:00:00") {
            $devolucion_dato['fyh_actualizacion_detalle'] = "";
        } else {
            $theDate = new DateTime($devolucion_dato['fyh_actualizacion_detalle']);
            $devolucion_dato['fyh_actualizacion_detalle'] = $theDate->format('d/m/Y H:i:s');
        }


        $spreadsheet->getActiveSheet()
            ->setCellValue('A' . $row, $contador = $contador + 1, )
            ->setCellValue('B' . $row, $devolucion_dato['periodo_anio'])
            ->setCellValue('C' . $row, $devolucion_dato['nt_devolucion'])
            ->setCellValue('D' . $row, $devolucion_dato['nt_anio'])
            ->setCellValue('E' . $row, $devolucion_dato['proveido'] . "-" . $fecha_proveido_anio . "-DIGA-UNFV")
            ->setCellValue('F' . $row, $devolucion_dato['fecha_proveido'])
            ->setCellValue('G' . $row, $devolucion_dato['oficio'])
            ->setCellValue('H' . $row, $devolucion_dato['fecha_oficio'])
            ->setCellValue('I' . $row, $devolucion_dato['informe'] . "-" . $fecha_informe_anio . "-D-PI-OT-DIGA-UNFV")
            ->setCellValue('J' . $row, $devolucion_dato['fecha_informe'])
            ->setCellValue('K' . $row, $devolucion_dato['dependencia'])
            ->setCellValue('L' . $row, $devolucion_dato['observacion_devolucion'])
            ->setCellValue('M' . $row, $devolucion_dato['numero_recibo'])
            ->setCellValue('N' . $row, $devolucion_dato['nombre_banco'])
            ->setCellValue('O' . $row, $devolucion_dato['nro_cuenta_banco'])
            ->setCellValue('P' . $row, $devolucion_dato['importe_voucher'])
            ->setCellValue('Q' . $row, $devolucion_dato['fecha_voucher'])
            ->setCellValue('R' . $row, $devolucion_dato['nombre_concepto'])
            ->setCellValue('S' . $row, $devolucion_dato['anio_concepto'])
            ->setCellValue('T' . $row, $devolucion_dato['ciclo'])
            ->setCellValue('U' . $row, $devolucion_dato['clasificador'])
            ->setCellValue('V' . $row, $devolucion_dato['siaf_devolucion'])
            ->setCellValue('W' . $row, $devolucion_dato['anio_siafdev'])
            ->setCellValue('X' . $row, $devolucion_dato['siaf_origen'])
            ->setCellValue('Y' . $row, $devolucion_dato['anio_siaforigen'])
            ->setCellValue('Z' . $row, $devolucion_dato['nombre_documento'])
            ->setCellValue('AA' . $row, $devolucion_dato['dni'])
            ->setCellValue('AB' . $row, $devolucion_dato['nombre_solicitante'])
            ->setCellValue('AC' . $row, $devolucion_dato['nombre_apoderado'])
            ->setCellValue('AD' . $row, $devolucion_dato['razon_social'])
            ->setCellValue('AE' . $row, $devolucion_dato['ruc'])
            ->setCellValue('AF' . $row, $devolucion_dato['telefono'])
            ->setCellValue('AG' . $row, $devolucion_dato['correo'])
            ->setCellValue('AH' . $row, $devolucion_dato['importe_devolucion_unfv'])
            ->setCellValue('AI' . $row, $devolucion_dato['nro_cuenta'])
            ->setCellValue('AJ' . $row, $devolucion_dato['estado_giro'])
            ->setCellValue('AK' . $row, $devolucion_dato['observacion_giro'])
            ->setCellValue('AL' . $row, $devolucion_dato['saldo'])
            ->setCellValue('AM' . $row, $devolucion_dato['documento_pago'])
            ->setCellValue('AN' . $row, $devolucion_dato['numero_cheque'])
            ->setCellValue('AO' . $row, $devolucion_dato['fecha_cheque'])
            ->setCellValue('AP' . $row, $devolucion_dato['nro_envio'])
            ->setCellValue('AQ' . $row, $devolucion_dato['envio_anio'])
            ->setCellValue('AR' . $row, $devolucion_dato['numero_ope'])
            ->setCellValue('AS' . $row, $devolucion_dato['fecha_ope'])
            ->setCellValue('AT' . $row, $devolucion_dato['numero_cci'])
            ->setCellValue('AU' . $row, $devolucion_dato['fecha_cci'])
            ->setCellValue('AV' . $row, $devolucion_dato['numero_cartaorden'])
            ->setCellValue('AW' . $row, $devolucion_dato['fecha_cartaorden'])
            ->setCellValue('AX' . $row, $devolucion_dato['numero_comprobante_interno'])
            ->setCellValue('AY' . $row, $devolucion_dato['numero_comprobante_externo'])
            ->setCellValue('AZ' . $row, $devolucion_dato['fecha_entrega'])
            ->setCellValue('BA' . $row, $devolucion_dato['condicion_entrega'])
            ->setCellValue('BB' . $row, $devolucion_dato['fecha_pago'])
            ->setCellValue('BC' . $row, $devolucion_dato['condicion_pago'])
            ->setCellValue('BD' . $row, $devolucion_dato['importe_devolucion_bn'])
            ->setCellValue('BE' . $row, $devolucion_dato['diferencia'])
            ->setCellValue('BF' . $row, $devolucion_dato['observacion'])
            ->setCellValue('BG' . $row, $devolucion_dato['fyh_creacion_dev'])
            ->setCellValue('BH' . $row, $devolucion_dato['fyh_actualizacion_detalle'])
            ->setCellValue('BI' . $row, $devolucion_dato['nombres'] . " " . $devolucion_dato['apellidopaterno'] . " " . $devolucion_dato['apellidomaterno']);

        //Convierte en formato fecha
        $value = $devolucion_dato['fecha_proveido'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('F' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('F' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $devolucion_dato['fecha_oficio'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('H' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $devolucion_dato['fecha_informe'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('J' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('J' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $devolucion_dato['fecha_voucher'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('Q' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('Q' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $devolucion_dato['fecha_cheque'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AO' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AO' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $devolucion_dato['fecha_ope'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AS' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AS' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $devolucion_dato['fecha_entrega'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AZ' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AZ' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $devolucion_dato['fecha_pago'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('BB' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('BB' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');


        //Convierte en formato decimal
        $currencyMask = new Currency(
            '',
            2,
            Number::WITH_THOUSANDS_SEPARATOR,
            Currency::TRAILING_SYMBOL,
            Currency::SYMBOL_WITH_SPACING
        );

        $value = $devolucion_dato['importe_voucher'];
        $spreadsheet->getActiveSheet()->setCellValue('P' . $row, $value);
        $spreadsheet->getActiveSheet()->getStyle('P' . $row)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);


        $value = $devolucion_dato['importe_devolucion_unfv'];
        $spreadsheet->getActiveSheet()->setCellValue('AH' . $row, $value);
        $spreadsheet->getActiveSheet()->getStyle('AH' . $row)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $devolucion_dato['saldo'];
        $spreadsheet->getActiveSheet()->setCellValue('AL' . $row, $value);
        $spreadsheet->getActiveSheet()->getStyle('AL' . $row)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $devolucion_dato['importe_devolucion_bn'];
        $spreadsheet->getActiveSheet()->setCellValue('BD' . $row, $value);
        $spreadsheet->getActiveSheet()->getStyle('BD' . $row)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $devolucion_dato['diferencia'];
        $spreadsheet->getActiveSheet()->setCellValue('BE' . $row, $value);
        $spreadsheet->getActiveSheet()->getStyle('BE' . $row)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);


        $value = $devolucion_dato['fyh_creacion_dev'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('BG' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('BG' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY HH:mm:ss');

        $value = $devolucion_dato['fyh_actualizacion_detalle'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('BH' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('BH' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY HH:mm:ss');




        //set row style
        if ($row % 2 == 0) {
            //even row
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':BI' . $row)->applyFromArray($evenRow);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':BI' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':BI' . $row)->getAlignment()->setHorizontal('left');
        } else {
            //odd row
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':BI' . $row)->applyFromArray($oddRow);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':BI' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':BI' . $row)->getAlignment()->setHorizontal('left');
        }
        //increment row
        $row++;


    }

    //autofilter
    //define first row and last row
    $firstRow = 2;
    $lastRow = $row - 1;
    //set the autofilter
    $spreadsheet->getActiveSheet()->setAutoFilter("A" . $firstRow . ":BI" . $lastRow); //Establecer filtros en las columnas
}

//set the header first, so the result will be treated as an xlsx file.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//make it an attachment so we can define filename
header('Content-Disposition: attachment;filename=' . $fileName . '');

//create IOFactory object
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//save into php output
$writer->save('php://output');

