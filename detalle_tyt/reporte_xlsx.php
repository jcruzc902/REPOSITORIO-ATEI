<?php
include ('../app/config.php');
//call the autoload
require '../vendor/autoload.php';

//load phpspreadsheet class using namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
//call iofactory instead of xlsx writer
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard\Currency;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard\Number;



$fileName = "REPORTE DE TASAS Y TARIFAS " . date('d-m-Y H:i:s') . ".xlsx";

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
$drawing->setPath('../public/images/logo2_unfv.jpg'); // put your path and image here
$drawing->setCoordinates('A1');
$drawing->getShadow()->setVisible(true);
$drawing->setWidth(147);
$drawing->setWorksheet($spreadsheet->getActiveSheet());

//heading
$spreadsheet->getActiveSheet()
    ->setCellValue('B1', "REPORTE DE TASAS Y TARIFAS - OFICINA DE TESORERIA");

//merge heading
$spreadsheet->getActiveSheet()->mergeCells("B1:Y1");

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

//header text
$spreadsheet->getActiveSheet()
    ->setCellValue('A2', "ID")
    ->setCellValue('B2', "CODIGO DE PAGO")
    ->setCellValue('C2', "MODALIDAD")
    ->setCellValue('D2', "CONCEPTO")
    ->setCellValue('E2', "ABREVIATURA")
    ->setCellValue('F2', "MONTO")
    ->setCellValue('G2', "REFERENCIA")
    ->setCellValue('H2', "CLASIFICADOR")
    ->setCellValue('I2', "CODIGO DE FACULTAD")
    ->setCellValue('J2', "DEPENDENCIA")
    ->setCellValue('K2', "CODIGO DE SERVICIO BANCO")
    ->setCellValue('L2', "BANCO")
    ->setCellValue('M2', "CUENTA")
    ->setCellValue('N2', "RESOLUCION RECTORAL")
    ->setCellValue('O2', "ARCHIVO")
    ->setCellValue('P2', "OBSERVACION RESOLUCION")
    ->setCellValue('Q2', "ESTADO RESOLUCION")
    ->setCellValue('R2', "VIGENCIA")
    ->setCellValue('S2', "SITUACION")
    ->setCellValue('T2', "TIPO")
    ->setCellValue('U2', "ESTADO")
    ->setCellValue('V2', "OBSERVACION")
    ->setCellValue('W2', "FECHA REGISTRO")
    ->setCellValue('X2', "FECHA ACTUALIZACION")
    ->setCellValue('Y2', "USUARIO");

//set font style and background color
$spreadsheet->getActiveSheet()->getStyle('A2:Y2')->applyFromArray($tableHead); //estilo de fondo en la cabecera
$spreadsheet->getActiveSheet()->getStyle('A2:Y2')->getAlignment()->setHorizontal('center'); //alineacion cental
$spreadsheet->getActiveSheet()->freezePane('A3'); //Congela la pantalla


$styleArray = [

    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],

];

$spreadsheet->getActiveSheet()->getStyle('A2:Y2')->applyFromArray($styleArray);


#BASE DE DATOS
$contador = 0;

session_start();

if (isset($_SESSION['busqueda_codigo_pago'])) {
    $codigo_pago = $_SESSION['busqueda_codigo_pago'];
} else {
    $codigo_pago = "";
}

if (isset($_SESSION['busqueda_modalidad'])) {
    $modalidad = $_SESSION['busqueda_modalidad'];
} else {
    $modalidad = "";
}

if (isset($_SESSION['busqueda_concepto'])) {
    $concepto = $_SESSION['busqueda_concepto'];
} else {
    $concepto = "";
}

if (isset($_SESSION['busqueda_referencia'])) {
    $referencia = $_SESSION['busqueda_referencia'];
} else {
    $referencia = "";
}

if (isset($_SESSION['busqueda_dependencia'])) {
    $dependencia = $_SESSION['busqueda_dependencia'];
} else {
    $dependencia = "";
}

if (isset($_SESSION['busqueda_resolucion'])) {
    $resolucion = $_SESSION['busqueda_resolucion'];
} else {
    $resolucion = "";
}

if (isset($_SESSION['busqueda_estado'])) {
    $estado = $_SESSION['busqueda_estado'];
} else {
    $estado = "";
}

if (isset($_SESSION['busqueda_situacion'])) {
    $situacion = $_SESSION['busqueda_situacion'];
} else {
    $situacion = "";
}

if (isset($_SESSION['busqueda_tipo'])) {
    $tipo = $_SESSION['busqueda_tipo'];
} else {
    $tipo = "";
}

$sql_tasas_tarifas = "SELECT detalle_tyt.id_detalle_tyt as id_detalle_tyt,
 tasas_tarifas.codigo_pago as codigo_pago,
 tasas_tarifas.modalidad as modalidad,
 tasas_tarifas.concepto as concepto,
 tasas_tarifas.referencia as referencia,
 tasas_tarifas.dependencia as dependencia,
 detalle_tyt.resolucion as resolucion,
 detalle_tyt.archivo as archivo_resolucion,
 detalle_tyt.observacion as observacion_resolucion,
 detalle_tyt.monto as monto,
 tasas_tarifas.abreviatura as abreviatura,
 tasas_tarifas.situacion as situacion,
 tasas_tarifas.categoria_transaccion as categoria_transaccion,
 tasas_tarifas.referencia as referencia,
 tasas_tarifas.clasificador as clasificador,
 tasas_tarifas.codigo_facultad as codigo_facultad,
 tasas_tarifas.codigo_ser_banco as codigo_ser_banco,
 tasas_tarifas.vigencia as vigencia,
 tasas_tarifas.banco as banco,
 tasas_tarifas.cta as cta,
 tasas_tarifas.observacion as observacion,
 estado_tasas.nombre_estado_tasas as estado,
 tasas_tarifas.fyh_creacion as fyh_creacion_tyt,
 tasas_tarifas.fyh_actualizacion as fyh_actualizacion_tyt,
 usuario.id_usuario as id_usuario,
 usuario.nombres as nombres,
 usuario.apaterno as apaterno, 
 usuario.amaterno as amaterno,
 estado_resolucion.nombre_estado_resolucion as nombre_estado_resolucion
 FROM tb_detalle_tyt as detalle_tyt 
 LEFT JOIN tb_estado_resolucion as estado_resolucion ON estado_resolucion.id_estado_resolucion = detalle_tyt.id_estado_resolucion 
 LEFT JOIN tb_usuarios as usuario ON usuario.id_usuario= detalle_tyt.id_usuario 
 LEFT JOIN tb_tasas_tarifas as tasas_tarifas ON tasas_tarifas.id_tasas_tarifas= detalle_tyt.id_tasas_tarifas 
 LEFT JOIN tb_estado_tasas as estado_tasas ON estado_tasas.id_estado_tasas = tasas_tarifas.id_estado 
 WHERE detalle_tyt.visible!=1 AND tasas_tarifas.visible!=1 AND estado_resolucion.nombre_estado_resolucion IN ('APROBADO') AND tasas_tarifas.situacion IN ('INCORPORACION','ACTUALIZACION','MODIFICACION') ";

if (isset($_SESSION['busqueda_boton_tasas_tarifas'])) {
    if (
        !isset($codigo_pago) && !isset($modalidad) && !isset($concepto) && !isset($referencia) && !isset($dependencia) 
        && !isset($resolucion) && !isset($estado) && !isset($situacion) && !isset($tipo)
    ) {
        $sql_tasas_tarifas .= " ";
    } else {

        if (!empty($codigo_pago)) {
            $sql_tasas_tarifas .= " AND tasas_tarifas.codigo_pago like '%" . $codigo_pago . "%'";
        }

        if (!empty($modalidad)) {
            $sql_tasas_tarifas .= " AND tasas_tarifas.modalidad='" . $modalidad . "'";
        }

        if (!empty($concepto)) {
            $sql_tasas_tarifas .= " AND tasas_tarifas.concepto='" . $concepto . "'";
        }

        if (!empty($referencia)) {
            $sql_tasas_tarifas .= " AND tasas_tarifas.referencia='" . $referencia . "'";
        }

        if (!empty($dependencia)) {
            $sql_tasas_tarifas .= " AND tasas_tarifas.dependencia='" . $dependencia . "'";
        }

        if (!empty($resolucion)) {
            $sql_tasas_tarifas .= " AND detalle_tyt.resolucion='" . $resolucion . "'";
        }

        if (!empty($estado)) {
            $sql_tasas_tarifas .= " AND estado_resolucion.nombre_estado_resolucion='" . $estado . "'";
        }

        if (!empty($situacion)) {
            $sql_tasas_tarifas .= " AND tasas_tarifas.situacion='" . $situacion . "'";
        } 

        if (!empty($tipo)) {
            $sql_tasas_tarifas .= " AND tasas_tarifas.categoria_transaccion='" . $tipo . "'";
        }
    }

    #$sql_tasas_tarifas .= " GROUP BY detalle_tyt.codigo_pago,detalle_tyt.modalidad,detalle_tyt.concepto,detalle_tyt.referencia,detalle_tyt.dependencia ORDER BY detalle_tyt.dependencia, detalle_tyt.concepto ASC"; //ordena el codigo en forma ascendente
    $sql_tasas_tarifas .= " ORDER BY tasas_tarifas.dependencia, tasas_tarifas.concepto ASC"; //ordena el codigo en forma ascendente



    $query_tasas_tarifas = $pdo->prepare($sql_tasas_tarifas);
    $query_tasas_tarifas->execute();
    $tasas_tarifas_datos = $query_tasas_tarifas->fetchAll(PDO::FETCH_ASSOC);
}

if (!isset($tasas_tarifas_datos)) {
    $tasas_tarifas_datos = '';
} else {
    $row = 3;
    foreach ($tasas_tarifas_datos as $tasas_tarifas_dato) {

        if ($tasas_tarifas_dato['modalidad'] == "SELECCIONAR") {
            $tasas_tarifas_dato['modalidad'] = "";
        }

        if ($tasas_tarifas_dato['concepto'] == "SELECCIONAR") {
            $tasas_tarifas_dato['concepto'] = "";
        }

        if ($tasas_tarifas_dato['referencia'] == "SELECCIONAR") {
            $tasas_tarifas_dato['referencia'] = "";
        }

        if ($tasas_tarifas_dato['dependencia'] == "SELECCIONAR") {
            $tasas_tarifas_dato['dependencia'] = "";
        }

        if ($tasas_tarifas_dato['cta'] == "SELECCIONAR") {
            $tasas_tarifas_dato['cta'] = "";
        }

        if ($tasas_tarifas_dato['resolucion'] == "SELECCIONAR") {
            $tasas_tarifas_dato['resolucion'] = "";
        }

        if ($tasas_tarifas_dato['archivo_resolucion'] == "SELECCIONAR") {
            $tasas_tarifas_dato['archivo_resolucion'] = "";
        }

        if ($tasas_tarifas_dato['situacion'] == "SELECCIONAR") {
            $tasas_tarifas_dato['situacion'] = "";
        }

        if ($tasas_tarifas_dato['categoria_transaccion'] == "SELECCIONAR") {
            $tasas_tarifas_dato['categoria_transaccion'] = "";
        }

        if ($tasas_tarifas_dato['vigencia'] == "0000-00-00") {
            $tasas_tarifas_dato['vigencia'] = "";
        }

        if ($tasas_tarifas_dato['fyh_actualizacion_tyt'] == "0000-00-00 00:00:00") {
            $tasas_tarifas_dato['fyh_actualizacion_tyt'] = "";
        } else {
            $theDate = new DateTime($tasas_tarifas_dato['fyh_actualizacion_tyt']);
            $tasas_tarifas_dato['fyh_actualizacion_tyt'] = $theDate->format('d/m/Y H:i:s');
        }



        $spreadsheet->getActiveSheet()
            ->setCellValue('A' . $row, $contador = $contador + 1, )
            ->setCellValue('B' . $row, $tasas_tarifas_dato['codigo_pago'])
            ->setCellValue('C' . $row, $tasas_tarifas_dato['modalidad'])
            ->setCellValue('D' . $row, $tasas_tarifas_dato['concepto'])
            ->setCellValue('E' . $row, $tasas_tarifas_dato['abreviatura'])
            ->setCellValue('F' . $row, $tasas_tarifas_dato['monto'])
            ->setCellValue('G' . $row, $tasas_tarifas_dato['referencia'])
            ->setCellValue('H' . $row, $tasas_tarifas_dato['clasificador'])
            ->setCellValue('I' . $row, $tasas_tarifas_dato['codigo_facultad'])
            ->setCellValue('J' . $row, $tasas_tarifas_dato['dependencia'])
            ->setCellValue('K' . $row, $tasas_tarifas_dato['codigo_ser_banco'])
            ->setCellValue('L' . $row, $tasas_tarifas_dato['banco'])
            ->setCellValue('M' . $row, $tasas_tarifas_dato['cta'])
            ->setCellValue('N' . $row, $tasas_tarifas_dato['resolucion'])
            ->setCellValue('O' . $row, $tasas_tarifas_dato['archivo_resolucion'])
            ->setCellValue('P' . $row, $tasas_tarifas_dato['observacion_resolucion'])
            ->setCellValue('Q' . $row, $tasas_tarifas_dato['nombre_estado_resolucion'])
            ->setCellValue('R' . $row, $tasas_tarifas_dato['vigencia'])
            ->setCellValue('S' . $row, $tasas_tarifas_dato['situacion'])
            ->setCellValue('T' . $row, $tasas_tarifas_dato['categoria_transaccion'])
            ->setCellValue('U' . $row, $tasas_tarifas_dato['estado'])
            ->setCellValue('V' . $row, $tasas_tarifas_dato['observacion'])
            ->setCellValue('W' . $row, $tasas_tarifas_dato['fyh_creacion_tyt'])
            ->setCellValue('X' . $row, $tasas_tarifas_dato['fyh_actualizacion_tyt'])
            ->setCellValue('Y' . $row, $tasas_tarifas_dato['nombres'] . " " . $tasas_tarifas_dato['apaterno'] . " " . $tasas_tarifas_dato['amaterno']);

        //Convierte en formato decimal
        $currencyMask = new Currency(
            '',
            2,
            Number::WITH_THOUSANDS_SEPARATOR,
            Currency::TRAILING_SYMBOL,
            Currency::SYMBOL_WITH_SPACING
        );

        $value = $tasas_tarifas_dato['monto'];
        $spreadsheet->getActiveSheet()->setCellValue('F' . $row, $value);
        $spreadsheet->getActiveSheet()->getStyle('F' . $row)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        //Convierte en formato fecha
        $value = $tasas_tarifas_dato['vigencia'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('R' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('R' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $tasas_tarifas_dato['fyh_creacion_tyt'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('W' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('W' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY HH:mm:ss');

        $value = $tasas_tarifas_dato['fyh_actualizacion_tyt'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('X' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('X' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY HH:mm:ss');




        //set row style
        if ($row % 2 == 0) {
            //even row
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':Y' . $row)->applyFromArray($evenRow);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':Y' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':Y' . $row)->getAlignment()->setHorizontal('left');
        } else {
            //odd row
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':Y' . $row)->applyFromArray($oddRow);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':Y' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':Y' . $row)->getAlignment()->setHorizontal('left');
        }
        //increment row
        $row++;


    }

    //autofilter
    //define first row and last row
    $firstRow = 2;
    $lastRow = $row - 1;
    //set the autofilter
    $spreadsheet->getActiveSheet()->setAutoFilter("A" . $firstRow . ":Y" . $lastRow); //Establecer filtros en las columnas
}

//set the header first, so the result will be treated as an xlsx file.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//make it an attachment so we can define filename
header('Content-Disposition: attachment;filename=' . $fileName . '');

//create IOFactory object
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//save into php output
$writer->save('php://output');

