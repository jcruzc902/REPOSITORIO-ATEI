<?php
include ('../../config.php');
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



$fileName = "REPORTE DE CHEQUES " . date('d-m-Y H:i:s') . ".xlsx";

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
    ->setCellValue('B1', "REPORTE DE CHEQUES - OFICINA DE TESORERIA");

//merge heading
$spreadsheet->getActiveSheet()->mergeCells("B1:AF1");

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


//header text
$spreadsheet->getActiveSheet()
    ->setCellValue('A2', "ID")
    ->setCellValue('B2', "NT")
    ->setCellValue('C2', "AÑO")
    ->setCellValue('D2', "PROVEIDO (DIGA)")
    ->setCellValue('E2', "FECHA")
    ->setCellValue('F2', "PROVEIDO (CONTABILIDAD)")
    ->setCellValue('G2', "FECHA")
    ->setCellValue('H2', "INFORME")
    ->setCellValue('I2', "FECHA")
    ->setCellValue('J2', "ASUNTO")
    ->setCellValue('K2', "SIAF")
    ->setCellValue('L2', "TIPO")
    ->setCellValue('M2', "OFICIO")
    ->setCellValue('N2', "FECHA")
    ->setCellValue('O2', "OBSERVACION TRAMITE")
    ->setCellValue('P2', "TIPO CHEQUE")
    ->setCellValue('Q2', "N° C.I.")
    ->setCellValue('R2', "FECHA C.I.")
    ->setCellValue('S2', "N° C.E.")
    ->setCellValue('T2', "FECHA C.E.")
    ->setCellValue('U2', "N° CHEQUE")
    ->setCellValue('V2', "FECHA EMISION")
    ->setCellValue('W2', "MONTO")
    ->setCellValue('X2', "N° ENVIO")
    ->setCellValue('Y2', "FECHA APROBADO (GIRO)")
    ->setCellValue('Z2', "FECHA ENTREGADO")
    ->setCellValue('AA2', "FECHA PAGADO")
    ->setCellValue('AB2', "ESTADO")
    ->setCellValue('AC2', "OBSERVACION CHEQUE")
    ->setCellValue('AD2', "FECHA REGISTRO")
    ->setCellValue('AE2', "FECHA ACTUALIZACION")
    ->setCellValue('AF2', "USUARIO");

//set font style and background color
$spreadsheet->getActiveSheet()->getStyle('A2:AF2')->applyFromArray($tableHead); //estilo de fondo en la cabecera
$spreadsheet->getActiveSheet()->getStyle('A2:AF2')->getAlignment()->setHorizontal('center'); //alineacion cental
$spreadsheet->getActiveSheet()->freezePane('A3'); //Congela la pantalla


$styleArray = [

    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],

];

$spreadsheet->getActiveSheet()->getStyle('A2:AF2')->applyFromArray($styleArray);


#BASE DE DATOS
$contador = 0;
session_start();

if (isset($_SESSION['busqueda_nt_cheque'])) {
    $nt = $_SESSION['busqueda_nt_cheque'];
} else {
    $nt = "";
}

if (isset($_SESSION['busqueda_anio_nt_cheque'])) {
    $anio_nt = $_SESSION['busqueda_anio_nt_cheque'];
} else {
    $anio_nt = "";
}

if (isset($_SESSION['busqueda_proveido_cheque'])) {
    $proveido = $_SESSION['busqueda_proveido_cheque'];
} else {
    $proveido = "";
}

if (isset($_SESSION['busqueda_fecha_proveido_cheque'])) {
    $fecha_proveido = $_SESSION['busqueda_fecha_proveido_cheque'];
} else {
    $fecha_proveido = "";
}

if (isset($_SESSION['busqueda_asunto_cheque'])) {
    $asunto = $_SESSION['busqueda_asunto_cheque'];
} else {
    $asunto = "";
}

if (isset($_SESSION['busqueda_tipo_gasto_cheque'])) {
    $tipo_gasto = $_SESSION['busqueda_tipo_gasto_cheque'];
} else {
    $tipo_gasto = "";
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
    LEFT JOIN tb_detalle_cheque AS detalle ON (detalle.nt = cheque.nt AND detalle.id_anio_nt = cheque.id_anio_nt AND detalle.id_asunto= cheque.id_asunto) 
    LEFT JOIN tb_nrocuenta AS nrocuenta ON nrocuenta.id_nrocuenta = detalle.id_nrocuenta 
    LEFT JOIN tb_estado_cheque as estado_cheque ON estado_cheque.id_estado_cheque = detalle.id_estado_cheque
    LEFT JOIN tb_usuarios AS usuario ON usuario.id_usuario = detalle.id_usuario 
    WHERE cheque.visible>=0 ";

if (isset($_SESSION["busqueda_boton_cheque"])) {


    if (
        !isset($nt) && !isset($anio_nt) && !isset($proveido) && !isset($fecha_proveido) && !isset($asunto) && !isset($tipo_gasto)
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

        if (!empty($proveido)) {
            $sql_cheques .= " AND cheque.proveido_diga like '%" . $proveido . "%'";
        }

        if (!empty($fecha_proveido)) {
            $sql_cheques .= " AND cheque.fecha_diga='" . $fecha_proveido . "'";
        }

        if (!empty($asunto)) {
            $sql_cheques .= " AND cheque.id_asunto='" . $asunto . "'";
        }

        if (!empty($tipo_gasto)) {
            $sql_cheques .= " AND cheque.id_tipo_gasto='" . $tipo_gasto . "'";
        }

        if (!empty($desde) && !empty($hasta)) {
            $sql_cheques .= " AND cheque.fyh_creacion between '" . $desde . "' and '" . $hasta . "'";
        }
    }

    $sql_cheques .= " GROUP BY detalle.nro_cheque";


    $query_cheques = $pdo->prepare($sql_cheques);
    $query_cheques->execute();
    $cheques_datos = $query_cheques->fetchAll(PDO::FETCH_ASSOC);

}

if (!isset($cheques_datos)) {
    $cheques_datos = '';
} else {
    $row = 3;
    foreach ($cheques_datos as $cheques_dato) {


        if ($cheques_dato['fecha_diga'] == "0000-00-00") {
            $cheques_dato['fecha_diga'] = "";
        }

        if ($cheques_dato['fecha_diga'] == "0000-00-00") {
            $fecha_diga_anio = "";
        } else {
            $theDate = new DateTime($cheques_dato['fecha_diga']);
            $fecha_diga_anio = $theDate->format('Y');
        }

        if ($cheques_dato['fecha_conta'] == "0000-00-00") {
            $cheques_dato['fecha_conta'] = "";
        }

        if ($cheques_dato['fecha_conta'] == "0000-00-00") {
            $fecha_conta_anio = "";
        } else {
            $theDate = new DateTime($cheques_dato['fecha_conta']);
            $fecha_conta_anio = $theDate->format('Y');
        }

        if ($cheques_dato['fyh_actualizacion_detalle'] == "0000-00-00 00:00:00") {
            $cheques_dato['fyh_actualizacion_detalle'] = "";
        } else {
            $theDate = new DateTime($cheques_dato['fyh_actualizacion_detalle']);
            $cheques_dato['fyh_actualizacion_detalle'] = $theDate->format('d/m/Y H:i:s');
        }

        $cheques_dato['proveido_diga'] = str_replace('-DIGA', '', $cheques_dato['proveido_diga']);

        if ($cheques_dato['proveido_conta'] != null) {
            $cheques_dato['proveido_conta'] = $cheques_dato['proveido_conta'] . "-" . $fecha_conta_anio . "-OC-UNFV";
        } else {
            $cheques_dato['proveido_conta'] = "";
        }

        if($cheques_dato['proveido_diga']!=null){
            $cheques_dato['proveido_diga']= $cheques_dato['proveido_diga'] . "-" . $fecha_diga_anio . "-DIGA-UNFV";
        }else{
            $cheques_dato['proveido_diga']= "";
        }

        $spreadsheet->getActiveSheet()
            ->setCellValue('A' . $row, $contador = $contador + 1, )
            ->setCellValue('B' . $row, $cheques_dato['numero_tramite'])
            ->setCellValue('C' . $row, $cheques_dato['nt_anio'])
            ->setCellValue('D' . $row, $cheques_dato['proveido_diga'])
            ->setCellValue('E' . $row, $cheques_dato['fecha_diga'])
            ->setCellValue('F' . $row, $cheques_dato['proveido_conta'])
            ->setCellValue('G' . $row, $cheques_dato['fecha_conta'])
            ->setCellValue('H' . $row, $cheques_dato['informe'])
            ->setCellValue('I' . $row, $cheques_dato['fecha_informe'])
            ->setCellValue('J' . $row, $cheques_dato['nombre_asunto'])
            ->setCellValue('K' . $row, $cheques_dato['siaf'])
            ->setCellValue('L' . $row, $cheques_dato['nombre_tipo_gasto'])
            ->setCellValue('M' . $row, $cheques_dato['oficio'])
            ->setCellValue('N' . $row, $cheques_dato['fecha_oficio'])
            ->setCellValue('O' . $row, $cheques_dato['observacion'])
            ->setCellValue('P' . $row, $cheques_dato['nro_cuenta'])
            ->setCellValue('Q' . $row, $cheques_dato['nro_ci'])
            ->setCellValue('R' . $row, $cheques_dato['fecha_ci'])
            ->setCellValue('S' . $row, $cheques_dato['nro_ce'])
            ->setCellValue('T' . $row, $cheques_dato['fecha_ce'])
            ->setCellValue('U' . $row, $cheques_dato['nro_cheque'])
            ->setCellValue('V' . $row, $cheques_dato['fecha_emision_cheque'])
            ->setCellValue('W' . $row, $cheques_dato['monto'])
            ->setCellValue('X' . $row, $cheques_dato['nro_envio'])
            ->setCellValue('Y' . $row, $cheques_dato['fecha_aprobado'])
            ->setCellValue('Z' . $row, $cheques_dato['fecha_entregado'])
            ->setCellValue('AA' . $row, $cheques_dato['fecha_pagado'])
            ->setCellValue('AB' . $row, $cheques_dato['estado_cheque'])
            ->setCellValue('AC' . $row, $cheques_dato['observacion_cheque'])
            ->setCellValue('AD' . $row, $cheques_dato['fyh_creacion_detalle'])
            ->setCellValue('AE' . $row, $cheques_dato['fyh_actualizacion_detalle'])
            ->setCellValue('AF' . $row, $cheques_dato['nombres'] . " " . $cheques_dato['apaterno'] . " " . $cheques_dato['amaterno']);


        //Convierte en formato decimal
        $currencyMask = new Currency(
            '',
            2,
            Number::WITH_THOUSANDS_SEPARATOR,
            Currency::TRAILING_SYMBOL,
            Currency::SYMBOL_WITH_SPACING
        );

        $value = $cheques_dato['monto'];
        $spreadsheet->getActiveSheet()->setCellValue('W' . $row, $value);
        $spreadsheet->getActiveSheet()->getStyle('W' . $row)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);


        //Convierte en formato fecha
        $value = $cheques_dato['fecha_diga'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('E' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $cheques_dato['fecha_conta'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('G' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('G' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $cheques_dato['fecha_informe'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('I' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('I' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $cheques_dato['fecha_oficio'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('N' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('N' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $cheques_dato['fecha_ci'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('R' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('R' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $cheques_dato['fecha_ce'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('T' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('T' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $cheques_dato['fecha_emision_cheque'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('V' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('V' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $cheques_dato['fecha_aprobado'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('Y' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('Y' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $cheques_dato['fecha_entregado'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('Z' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('Z' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $cheques_dato['fecha_pagado'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AA' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AA' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $cheques_dato['fyh_creacion_detalle'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AD' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AD' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY HH:mm:ss');

        $value = $cheques_dato['fyh_actualizacion_detalle'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AE' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AE' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY HH:mm:ss');



        //set row style
        if ($row % 2 == 0) {
            //even row
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AF' . $row)->applyFromArray($evenRow);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AF' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AF' . $row)->getAlignment()->setHorizontal('left');
        } else {
            //odd row
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AF' . $row)->applyFromArray($oddRow);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AF' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AF' . $row)->getAlignment()->setHorizontal('left');
        }
        //increment row
        $row++;


    }


    //autofilter
    //define first row and last row
    $firstRow = 2;
    $lastRow = $row - 1;
    //set the autofilter
    $spreadsheet->getActiveSheet()->setAutoFilter("A" . $firstRow . ":AF" . $lastRow); //Establecer filtros en las columnas
}

//set the header first, so the result will be treated as an xlsx file.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//make it an attachment so we can define filename
header('Content-Disposition: attachment;filename=' . $fileName . '');

//create IOFactory object
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//save into php output
$writer->save('php://output');

