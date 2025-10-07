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




$fileName = "REPORTE DE ESTADO DE EGRESOS " . date('d-m-Y H:i:s') . ".xlsx";

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
    ->setCellValue('B1', "REPORTE DE EGRESOS - OFICINA DE TESORERIA");

//merge heading
$spreadsheet->getActiveSheet()->mergeCells("B1:AZ1");

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


//header text
$spreadsheet->getActiveSheet()
    ->setCellValue('A2', "ID")
    ->setCellValue('B2', "FACULTAD")
    ->setCellValue('C2', "ACTIVIDAD PRINCIPAL")
    ->setCellValue('D2', "SUBACTIVIDAD")
    ->setCellValue('E2', "SALDO INICIAL")
    ->setCellValue('F2', "PERIODO")
    ->setCellValue('G2', "ESTADO")
    ->setCellValue('H2', "OBSERVACION EGRESO")
    ->setCellValue('I2', "NT PRINCIPAL")
    ->setCellValue('J2', "AÑO NT PRINC.")
    ->setCellValue('K2', "NT EXPEDIENTE")
    ->setCellValue('L2', "AÑO NT EXP.")
    ->setCellValue('M2', "PROVEIDO CONTABILIDAD")
    ->setCellValue('N2', "FECHA CONTABILIDAD")
    ->setCellValue('O2', "PROVEIDO DIGA")
    ->setCellValue('P2', "FECHA DIGA")
    ->setCellValue('Q2', "OFICIO")
    ->setCellValue('R2', "FECHA OFICIO")
    ->setCellValue('S2', "RESOLUCION")
    ->setCellValue('T2', "FECHA RESOLUCION")
    ->setCellValue('U2', "ESPECIALIDAD")
    ->setCellValue('V2', "DETALLE")
    ->setCellValue('W2', "PERIODO")
    ->setCellValue('X2', "NRO ORDEN COMPRA")
    ->setCellValue('Y2', "NRO ORDEN SERVICIO")
    ->setCellValue('Z2', "NRO COMPROBANTE")
    ->setCellValue('AA2', "SIAF")
    ->setCellValue('AB2', "MONTO")
    ->setCellValue('AC2', "EGRESOS")
    ->setCellValue('AD2', "INGRESOS")
    ->setCellValue('AE2', "NOTA DE PAGO")
    ->setCellValue('AF2', "FECHA DE GIRO")
    ->setCellValue('AG2', "ESTADO DE GIRO")
    ->setCellValue('AH2', "FECHA DE PAGO")
    ->setCellValue('AI2', "OBSERVACION DE GIRO")
    ->setCellValue('AJ2', "INFORME DE INGRESO")
    ->setCellValue('AK2', "FECHA INFORME DE INGRESO")
    ->setCellValue('AL2', "PROVEIDO/RESOLUCION")
    ->setCellValue('AM2', "FECHA DOCUMENTO")
    ->setCellValue('AN2', "CONCEPTO")
    ->setCellValue('AO2', "N° INFORME DE EGRESO")
    ->setCellValue('AP2', "FECHA DE INFORME")
    ->setCellValue('AQ2', "ASUNTO DE I.E")
    ->setCellValue('AR2', "DESCRIPCION DE INFORME DE EGRESO")
    ->setCellValue('AS2', "N° ESTADO DE CUENTA")
    ->setCellValue('AT2', "FECHA DE ESTADO DE CUENTA")
    ->setCellValue('AU2', "ASUNTO DE E.C")
    ->setCellValue('AV2', "DESCRIPCION DE ESTADO DE CUENTA")
    ->setCellValue('AW2', "OBSERVACION NT")
    ->setCellValue('AX2', "FECHA REGISTRO")
    ->setCellValue('AY2', "FECHA ACTUALIZACION")
    ->setCellValue('AZ2', "USUARIO");




//set font style and background color
$spreadsheet->getActiveSheet()->getStyle('A2:AZ2')->applyFromArray($tableHead); //estilo de fondo en la cabecera
$spreadsheet->getActiveSheet()->getStyle('A2:AZ2')->getAlignment()->setHorizontal('center'); //alineacion cental
$spreadsheet->getActiveSheet()->freezePane('A3'); //Congela la pantalla


$styleArray = [

    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],

];

$spreadsheet->getActiveSheet()->getStyle('A2:AZ2')->applyFromArray($styleArray);


#BASE DE DATOS
$contador = 0;
session_start();

/*
if (isset($_SESSION['busqueda_detalle_nt'])) {
    $nt = $_SESSION['busqueda_detalle_nt'];
} else {
    $nt = "";
}

if (isset($_SESSION['busqueda_detalle_anio_nt'])) {
    $anio_nt = $_SESSION['busqueda_detalle_anio_nt'];
} else {
    $anio_nt = "";
}

if (isset($_SESSION['busqueda_detalle_facultad'])) {
    $facultad = $_SESSION['busqueda_detalle_facultad'];
} else {
    $facultad = "";
}

if (isset($_SESSION['busqueda_detalle_actividad'])) {
    $actividad_principal = $_SESSION['busqueda_detalle_actividad'];
} else {
    $actividad_principal = "";
}

if (isset($_SESSION['busqueda_detalle_siaf'])) {
    $siaf = $_SESSION['busqueda_detalle_siaf'];
} else {
    $siaf = "";
}

if (isset($_SESSION['busqueda_detalle_fecha_giro'])) {
    $fecha_giro = $_SESSION['busqueda_detalle_fecha_giro'];
} else {
    $fecha_giro = "";
}

if (isset($_SESSION['busqueda_detalle_estado_giro'])) {
    $estado_giro = $_SESSION['busqueda_detalle_estado_giro'];
} else {
    $estado_giro = "";
}

if (isset($_SESSION['busqueda_detalle_resolucion'])) {
    $resolucion = $_SESSION['busqueda_detalle_resolucion'];
} else {
    $resolucion = "";
}

if (isset($_SESSION['busqueda_detalle_desde'])) {
    $desde = $_SESSION['busqueda_detalle_desde'];
} else {
    $desde = "";
}

if (isset($_SESSION['busqueda_detalle_hasta'])) {
    $hasta = $_SESSION['busqueda_detalle_hasta'];
} else {
    $hasta = "";
}

$sql_egresos = "SELECT egresos.id_egresos as id_egresos,
    egresos.cargo_facultad as cargo_facultad,
    egresos.actividad_principal	 as actividad_principal,
    egresos.saldo_inicial as saldo_inicial,
    egresos.anio as anio_egreso,
    estado_egreso.nombre_estado_egreso as estado_egreso,
    egresos.observacion_egreso as observacion_egreso,
    detalle_egresos.nt_principal as nt_principal,
    anios.anio_nt as anio_nt,
    detalle_egresos.nt_expediente as nt_expediente,
    anios_exp.anio_nt as anio_nt_exp,
    detalle_egresos.proveido_contabilidad as proveido_contabilidad,
    detalle_egresos.fecha_contabilidad as fecha_proveido_contabilidad,
    detalle_egresos.proveido_diga as proveido_diga,
    detalle_egresos.fecha_diga as fecha_diga,
    detalle_egresos.oficio as oficio,
    detalle_egresos.fecha_oficio as fecha_oficio,
    detalle_egresos.resolucion as resolucion,
    detalle_egresos.fecha_resolucion as fecha_resolucion,
    detalle_egresos.especialidad as especialidad,
    detalle_egresos.n_oc as numero_orden_compra,
    detalle_egresos.n_os as numero_orden_servicio,
    detalle_egresos.siaf as siaf,
    detalle_egresos.monto as monto,
    detalle_egresos.egresos as egresos,
    detalle_egresos.ingresos as ingresos,
    detalle_egresos.nota_pago as nota_pago,
    detalle_egresos.fecha_giro as fecha_giro,
    detalle_egresos.estado_giro as estado_giro,
    detalle_egresos.observacion_giro as observacion_giro,
    detalle_egresos.fecha_pago as fecha_pago,
    detalle_egresos.informe_ingreso as informe_ingreso,
    detalle_egresos.fecha_informe_ingreso as fecha_informe_ingreso,
    detalle_egresos.documento as documento,
    detalle_egresos.fecha_documento as fecha_documento,
    detalle_egresos.tipo_pago as concepto,
    detalle_egresos.detalle_pago as detalle_pago,
    detalle_egresos.periodo_pago as periodo_pago,
    detalle_egresos.informe as informe,
    detalle_egresos.fecha_informe as fecha_informe,
    detalle_egresos.asunto_informe as asunto_informe,
    detalle_egresos.descripcion_informe as descripcion_informe,
    detalle_egresos.numero_ec as numero_estado_cuenta,
    detalle_egresos.fecha_ec as fecha_estado_cuenta,
    detalle_egresos.asunto_ec as asunto_estado_cuenta,
    detalle_egresos.descripcion_ec as descripcion_estado_cuenta,
    detalle_egresos.observacion_egreso as detalle_observacion_egreso,
    detalle_egresos.fyh_creacion as fyh_creacion_detalle,
    detalle_egresos.fyh_actualizacion as fyh_actualizacion_detalle,
    usuario.nombres as nombre_usuario,
    usuario.apaterno as apaterno_usuario,
    usuario.amaterno as amaterno_usuario, 
    egresos.fyh_creacion as fyh_creacion_egreso 
    FROM tb_egresos as egresos 
    LEFT JOIN tb_estado_egreso as estado_egreso ON estado_egreso.id_estado_egreso = egresos.id_estado 
    LEFT JOIN tb_detalle_egresos as detalle_egresos ON detalle_egresos.id_egresos = egresos.id_egresos 
    LEFT JOIN tb_usuarios as usuario ON usuario.id_usuario= detalle_egresos.id_usuario
    LEFT JOIN tb_anio_nt as anios ON anios.id_anio_nt= detalle_egresos.id_anio_nt_principal 
    LEFT JOIN tb_anio_nt as anios_exp ON anios.id_anio_nt= detalle_egresos.id_anio_nt_expediente
    WHERE egresos.visible>=0";



if (isset($_SESSION['busqueda_boton_detalle_egresos'])) {

    if ($nt != "") {
        $sql_egresos .= " AND detalle_egresos.nt_principal like '%" . $nt . "%'";
    }

    if ($anio_nt != "") {
        $sql_egresos .= " AND anios.anio_nt='" . $anio_nt . "'";
    }

    if ($facultad != "") {
        $sql_egresos .= " AND detalle_egresos.facultad='" . $facultad . "'";
    }

    if ($facultad != "" && $actividad_principal != "") {
        $sql_egresos .= " AND detalle_egresos.actividad_principal='" . $actividad_principal . "'";
    }

    if ($siaf != "") {
        $sql_egresos .= " AND detalle_egresos.siaf like '%" . $siaf . "%'";
    }

    if ($fecha_giro != "") {
        $sql_egresos .= " AND detalle_egresos.fecha_giro='" . $fecha_giro . "'";
    }

    if ($estado_giro != "") {
        $sql_egresos .= " AND detalle_egresos.estado_giro='" . $estado_giro . "'";
    }

    if ($resolucion != "") {
        $sql_egresos .= " AND detalle_egresos.resolucion='" . $resolucion . "'";
    }
    

    if ($desde != "" && $hasta != "") {
        $sql_egresos .= " AND detalle_egresos.fecha_giro between '" . $desde . "' and '" . $hasta . "'";
    }

    $sql_egresos .= " ORDER BY detalle_egresos.egresos,detalle_egresos.facultad ASC"; //ordena el nombre del banco en forma ascendente

    $query_egresos = $pdo->prepare($sql_egresos);
    $query_egresos->execute();
    $egresos_datos = $query_egresos->fetchAll(PDO::FETCH_ASSOC);
}*/

if (isset($_SESSION['busqueda_detalle_nt'])) {
    $nt = $_SESSION['busqueda_detalle_nt'];
} else {
    $nt = "";
}

if (isset($_SESSION['busqueda_detalle_anio_nt'])) {
    $anio_nt = $_SESSION['busqueda_detalle_anio_nt'];
} else {
    $anio_nt = "";
}

if (isset($_SESSION['busqueda_detalle_facultad'])) {
    $facultad = $_SESSION['busqueda_detalle_facultad'];
} else {
    $facultad = "";
}

if (isset($_SESSION['busqueda_detalle_actividad'])) {
    $actividad_principal = $_SESSION['busqueda_detalle_actividad'];
} else {
    $actividad_principal = "";
}

if (isset($_SESSION['busqueda_detalle_subactividad'])) {
    $subactividad = $_SESSION['busqueda_detalle_subactividad'];
} else {
    $subactividad = "";
}

if (isset($_SESSION['busqueda_detalle_siaf'])) {
    $siaf = $_SESSION['busqueda_detalle_siaf'];
} else {
    $siaf = "";
}

if (isset($_SESSION['busqueda_detalle_fecha_giro'])) {
    $fecha_giro = $_SESSION['busqueda_detalle_fecha_giro'];
} else {
    $fecha_giro = "";
}

if (isset($_SESSION['busqueda_detalle_estado_giro'])) {
    $estado_giro = $_SESSION['busqueda_detalle_estado_giro'];
} else {
    $estado_giro = "";
}

if (isset($_SESSION['busqueda_detalle_resolucion'])) {
    $resolucion = $_SESSION['busqueda_detalle_resolucion'];
} else {
    $resolucion = "";
}

if (isset($_SESSION['busqueda_detalle_desde'])) {
    $desde = $_SESSION['busqueda_detalle_desde'];
} else {
    $desde = "";
}

if (isset($_SESSION['busqueda_detalle_hasta'])) {
    $hasta = $_SESSION['busqueda_detalle_hasta'];
} else {
    $hasta = "";
}

$sql_egresos = "SELECT t_detalle.facultad as facultad,
t_detalle.actividad_principal as actividad_principal,
t_detalle.subactividad as subactividad,
t_detalle.saldo_inicial as saldo_inicial,
t_detalle.periodo_anio as anio_egreso,
estado_egreso.nombre_estado_egreso as estado_egreso,
egresos.observacion_egreso as observacion_egreso,
t_detalle.nt_principal as nt_principal,
anios.anio_nt as anio_nt,
t_detalle.nt_expediente as nt_expediente,
anios_exp.anio_nt as anio_nt_exp,
t_detalle.proveido_contabilidad as proveido_contabilidad,
t_detalle.fecha_contabilidad as fecha_contabilidad,
t_detalle.proveido_diga as proveido_diga,
t_detalle.fecha_diga as fecha_diga,
t_detalle.oficio as oficio,
t_detalle.fecha_oficio as fecha_oficio,
t_detalle.resolucion as resolucion,
t_detalle.fecha_resolucion as fecha_resolucion,
t_detalle.especialidad as especialidad,
t_detalle.detalle_pago as detalle_pago,
t_detalle.periodo_pago as periodo_pago,
t_detalle.n_oc as numero_orden_compra,
t_detalle.n_os as numero_orden_servicio,
t_detalle.numero_comprobante as numero_comprobante,
t_detalle.siaf as siaf,
t_detalle.monto as monto,
t_detalle.egresos as egresos,
t_detalle.ingresos as ingresos,
t_detalle.nota_pago as nota_pago,
t_detalle.fecha_giro as fecha_giro,
t_detalle.estado_giro as estado_giro,
t_detalle.observacion_giro as observacion_giro,
t_detalle.fecha_pago as fecha_pago,
t_detalle.informe_ingreso as informe_ingreso,
t_detalle.fecha_informe_ingreso as fecha_informe_ingreso,
t_detalle.documento as documento,
t_detalle.fecha_documento as fecha_documento,
t_detalle.tipo_pago as concepto,
t_detalle.informe as informe,
t_detalle.fecha_informe as fecha_informe,
t_detalle.asunto_informe as asunto_informe,
t_detalle.descripcion_informe as descripcion_informe,
t_detalle.numero_ec as numero_estado_cuenta,
t_detalle.fecha_ec as fecha_estado_cuenta,
t_detalle.asunto_ec as asunto_estado_cuenta,
t_detalle.descripcion_ec as descripcion_estado_cuenta,
t_detalle.observacion_egreso as detalle_observacion_egreso,
t_detalle.fyh_creacion as fyh_creacion_detalle,
t_detalle.fyh_actualizacion as fyh_actualizacion_detalle,
usuario.nombres as nombre_usuario,
usuario.apaterno as apaterno_usuario,
usuario.amaterno as amaterno_usuario 
FROM tb_detalle_egresos as t_detalle 
INNER JOIN tb_usuarios as usuario ON usuario.id_usuario= t_detalle.id_usuario 
LEFT JOIN tb_anio_nt as anios ON anios.id_anio_nt= t_detalle.id_anio_nt_principal 
LEFT JOIN tb_anio_nt as anios_exp ON anios_exp.id_anio_nt= t_detalle.id_anio_nt_expediente 
LEFT JOIN tb_egresos as egresos ON egresos.id_egresos= t_detalle.id_egresos 
LEFT JOIN tb_estado_egreso as estado_egreso ON estado_egreso.id_estado_egreso= egresos.id_estado
WHERE t_detalle.visible!=1";

if (isset($_SESSION['busqueda_boton_detalle_egresos'])) {

    if ($nt != "") {
        $sql_egresos .= " AND t_detalle.nt_principal like '%" . $nt . "%'";
    }

    if ($anio_nt != "") {
        $sql_egresos .= " AND anios.anio_nt='" . $anio_nt . "'";
    }

    if ($facultad != "") {
        $sql_egresos .= " AND t_detalle.facultad='" . $facultad . "'";
    }

    if ($facultad != "" && $actividad_principal != "") {
        $sql_egresos .= " AND t_detalle.actividad_principal='" . $actividad_principal . "'";
    }

    if ($facultad != "" && $actividad_principal != "" && $subactividad != "") {
        $sql_egresos .= " AND t_detalle.subactividad='" . $subactividad . "'";
    }

    if ($siaf != "") {
        $sql_egresos .= " AND t_detalle.siaf like '%" . $siaf . "%'";
    }

    if ($fecha_giro != "") {
        $sql_egresos .= " AND t_detalle.fecha_giro='" . $fecha_giro . "'";
    }

    if ($estado_giro != "") {
        $sql_egresos .= " AND t_detalle.estado_giro='" . $estado_giro . "'";
    }

    if ($resolucion != "") {
        $sql_egresos .= " AND t_detalle.resolucion='" . $resolucion . "'";
    }
    

    if ($desde != "" && $hasta != "") {
        $sql_egresos .= " AND t_detalle.fecha_giro between '" . $desde . "' and '" . $hasta . "'";
    }

    $sql_egresos .= " ORDER BY t_detalle.egresos,t_detalle.facultad ASC"; //ordena el nombre del banco en forma ascendente

    $query_egresos = $pdo->prepare($sql_egresos);
    $query_egresos->execute();
    $egresos_datos = $query_egresos->fetchAll(PDO::FETCH_ASSOC);
}

if (!isset($egresos_datos)) {
    $egresos_datos = '';
} else {
    $row = 3;
    foreach ($egresos_datos as $egresos_dato) {



        if ($egresos_dato['fecha_informe'] != "0000-00-00") {
            $theDate = new DateTime($egresos_dato['fecha_informe']);
            $fecha_informe_anio = $theDate->format('Y');
        }

        if ($egresos_dato['proveido_contabilidad'] != null) {
            $egresos_dato['proveido_contabilidad'] = $egresos_dato['proveido_contabilidad'] . "-OC-UNFV";
        } else {
            $egresos_dato['proveido_contabilidad'] = "";
        }

        if ($egresos_dato['proveido_diga'] != null) {
            $egresos_dato['proveido_diga'] = $egresos_dato['proveido_diga'] . "-DIGA-UNFV";
        } else {
            $egresos_dato['proveido_diga'] = "";
        }

        if ($egresos_dato['informe'] != null) {
            $egresos_dato['informe'] = $egresos_dato['informe'] . "-" . $fecha_informe_anio . "-E-OT-DIGA-UNFV";
        } else {
            $egresos_dato['informe'] = "";
        }

        if ($egresos_dato['resolucion'] != null) {
            $egresos_dato['resolucion'] = $egresos_dato['resolucion'] . "-CU-UNFV";
        } else {
            $egresos_dato['resolucion'] = "";
        }


        $spreadsheet->getActiveSheet()
            ->setCellValue('A' . $row, $contador = $contador + 1, )
            ->setCellValue('B' . $row, $egresos_dato['facultad'])
            ->setCellValue('C' . $row, $egresos_dato['actividad_principal'])
            ->setCellValue('D' . $row, $egresos_dato['subactividad'])
            ->setCellValue('E' . $row, $egresos_dato['saldo_inicial'])
            ->setCellValue('F' . $row, $egresos_dato['anio_egreso'])
            ->setCellValue('G' . $row, $egresos_dato['estado_egreso'])
            ->setCellValue('H' . $row, $egresos_dato['observacion_egreso'])
            ->setCellValue('I' . $row, $egresos_dato['nt_principal'])
            ->setCellValue('J' . $row, $egresos_dato['anio_nt'])
            ->setCellValue('K' . $row, $egresos_dato['nt_expediente'])
            ->setCellValue('L' . $row, $egresos_dato['anio_nt_exp'])
            ->setCellValue('M' . $row, $egresos_dato['proveido_contabilidad'])
            ->setCellValue('N' . $row, $egresos_dato['fecha_contabilidad'])
            ->setCellValue('O' . $row, $egresos_dato['proveido_diga'])
            ->setCellValue('P' . $row, $egresos_dato['fecha_diga'])
            ->setCellValue('Q' . $row, $egresos_dato['oficio'])
            ->setCellValue('R' . $row, $egresos_dato['fecha_oficio'])
            ->setCellValue('S' . $row, $egresos_dato['resolucion'])
            ->setCellValue('T' . $row, $egresos_dato['fecha_resolucion'])
            ->setCellValue('U' . $row, $egresos_dato['especialidad'])
            ->setCellValue('V' . $row, $egresos_dato['detalle_pago'])
            ->setCellValue('W' . $row, $egresos_dato['periodo_pago'])
            ->setCellValue('X' . $row, $egresos_dato['numero_orden_compra'])
            ->setCellValue('Y' . $row, $egresos_dato['numero_orden_servicio'])
            ->setCellValue('Z' . $row, $egresos_dato['numero_comprobante'])
            ->setCellValue('AA' . $row, $egresos_dato['siaf'])
            ->setCellValue('AB' . $row, $egresos_dato['monto'])
            ->setCellValue('AC' . $row, $egresos_dato['egresos'])
            ->setCellValue('AD' . $row, $egresos_dato['ingresos'])
            ->setCellValue('AE' . $row, $egresos_dato['nota_pago'])
            ->setCellValue('AF' . $row, $egresos_dato['fecha_giro'])
            ->setCellValue('AG' . $row, $egresos_dato['estado_giro'])
            ->setCellValue('AH' . $row, $egresos_dato['observacion_giro'])
            ->setCellValue('AI' . $row, $egresos_dato['fecha_pago'])
            ->setCellValue('AJ' . $row, $egresos_dato['informe_ingreso'])
            ->setCellValue('AK' . $row, $egresos_dato['fecha_informe_ingreso'])
            ->setCellValue('AL' . $row, $egresos_dato['documento'])
            ->setCellValue('AM' . $row, $egresos_dato['fecha_documento'])
            ->setCellValue('AN' . $row, $egresos_dato['concepto'])
            ->setCellValue('AO' . $row, $egresos_dato['informe'])
            ->setCellValue('AP' . $row, $egresos_dato['fecha_informe'])
            ->setCellValue('AQ' . $row, $egresos_dato['asunto_informe'])
            ->setCellValue('AR' . $row, $egresos_dato['descripcion_informe'])
            ->setCellValue('AS' . $row, $egresos_dato['numero_estado_cuenta'])
            ->setCellValue('AT' . $row, $egresos_dato['fecha_estado_cuenta'])
            ->setCellValue('AU' . $row, $egresos_dato['asunto_estado_cuenta'])
            ->setCellValue('AV' . $row, $egresos_dato['descripcion_estado_cuenta'])
            ->setCellValue('AW' . $row, $egresos_dato['detalle_observacion_egreso'])
            ->setCellValue('AX' . $row, $egresos_dato['fyh_creacion_detalle'])
            ->setCellValue('AY' . $row, $egresos_dato['fyh_actualizacion_detalle'])
            ->setCellValue('AZ' . $row, $egresos_dato['nombre_usuario'] . " " . $egresos_dato['apaterno_usuario'] . " " . $egresos_dato['amaterno_usuario']);


        //Convierte en formato decimal
        $currencyMask = new Currency(
            '',
            2,
            Number::WITH_THOUSANDS_SEPARATOR,
            Currency::TRAILING_SYMBOL,
            Currency::SYMBOL_WITH_SPACING
        );

        $value = $egresos_dato['saldo_inicial'];
        $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $value);
        $spreadsheet->getActiveSheet()->getStyle('E' . $row)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $egresos_dato['monto'];
        $spreadsheet->getActiveSheet()->setCellValue('AB' . $row, $value);
        $spreadsheet->getActiveSheet()->getStyle('AB' . $row)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $egresos_dato['egresos'];
        $spreadsheet->getActiveSheet()->setCellValue('AC' . $row, $value);
        $spreadsheet->getActiveSheet()->getStyle('AC' . $row)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $egresos_dato['ingresos'];
        $spreadsheet->getActiveSheet()->setCellValue('AD' . $row, $value);
        $spreadsheet->getActiveSheet()->getStyle('AD' . $row)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);



        $value = $egresos_dato['fecha_contabilidad'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('N' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('N' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $egresos_dato['fecha_diga'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('P' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('P' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $egresos_dato['fecha_oficio'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('R' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('R' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $egresos_dato['fecha_resolucion'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('T' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('T' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $egresos_dato['fecha_giro'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AF' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AF' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $egresos_dato['fecha_pago'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AI' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AI' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $egresos_dato['fecha_informe_ingreso'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AK' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AK' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $egresos_dato['fecha_documento'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AM' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AM' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $egresos_dato['fecha_informe'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AP' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AP' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $egresos_dato['fecha_estado_cuenta'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AT' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AT' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $egresos_dato['fyh_creacion_detalle'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AX' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AX' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY HH:mm:ss');

        $value = $egresos_dato['fyh_actualizacion_detalle'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AY' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AY' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY HH:mm:ss');






        //set row style
        if ($row % 2 == 0) {
            //even row
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AZ' . $row)->applyFromArray($evenRow);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AZ' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AZ' . $row)->getAlignment()->setHorizontal('left');
        } else {
            //odd row
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AZ' . $row)->applyFromArray($oddRow);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AZ' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AZ' . $row)->getAlignment()->setHorizontal('left');
        }
        //increment row
        $row++;


    }

    //autofilter
    //define first row and last row
    $firstRow = 2;
    $lastRow = $row - 1;
    //set the autofilter
    $spreadsheet->getActiveSheet()->setAutoFilter("A" . $firstRow . ":AZ" . $lastRow); //Establecer filtros en las columnas
}

//set the header first, so the result will be treated as an xlsx file.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//make it an attachment so we can define filename
header('Content-Disposition: attachment;filename=' . $fileName . '');

//create IOFactory object
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//save into php output
$writer->save('php://output');

