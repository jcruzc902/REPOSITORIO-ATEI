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



$fileName = "REPORTE DE RECAUDACION DE INGRESOS " . date('d-m-Y H:i:s') . ".xlsx";

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
    ->setCellValue('B1', "REPORTE DE RECAUDACION DE INGRESOS - OFICINA DE TESORERIA");

//merge heading
$spreadsheet->getActiveSheet()->mergeCells("B1:U1");

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



//header text
$spreadsheet->getActiveSheet()
    ->setCellValue('A2', "ID")
    ->setCellValue('B2', "NOMBRE DE DEPENDENCIA")
    ->setCellValue('C2', "DETALLE DE CONCEPTO")
    ->setCellValue('D2', "NOMBRE DE BANCO (CASILLEROS)")
    ->setCellValue('E2', "FECHA DE RECAUDACION")
    ->setCellValue('F2', "NOMBRE DE ENCARGADO")
    ->setCellValue('G2', "DOCUMENTO DE RECEPCION")
    ->setCellValue('H2', "MONTO RECAUDADO")
    ->setCellValue('I2', "NOMBRE DE BANCO (DEPOSITO)")
    ->setCellValue('J2', "N° DE CUENTA (DEPOSITO)")
    ->setCellValue('K2', "FECHA DEPOSITO")
    ->setCellValue('L2', "NUMERO DE DOCUMENTO")
    ->setCellValue('M2', "IMPORTE")
    ->setCellValue('N2', "NOMBRE DE DEPOSITANTE")
    ->setCellValue('O2', "N° DE DNI")
    ->setCellValue('P2', "N° DE OPERACION")
    ->setCellValue('Q2', "ESTADO")
    ->setCellValue('R2', "OBSERVACION")
    ->setCellValue('S2', "FECHA REGISTRO")
    ->setCellValue('T2', "FECHA ACTUALIZACION")
    ->setCellValue('U2', "USUARIO");

//set font style and background color
$spreadsheet->getActiveSheet()->getStyle('A2:U2')->applyFromArray($tableHead); //estilo de fondo en la cabecera
$spreadsheet->getActiveSheet()->getStyle('A2:U2')->getAlignment()->setHorizontal('center'); //alineacion cental
$spreadsheet->getActiveSheet()->freezePane('A3'); //Congela la pantalla


$styleArray = [

    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],

];

$spreadsheet->getActiveSheet()->getStyle('A2:U2')->applyFromArray($styleArray);


#BASE DE DATOS
$contador = 0;
session_start();

if (isset($_SESSION['busqueda_dependencia'])) {
    $nombre_dependencia = $_SESSION['busqueda_dependencia'];
} else {
    $nombre_dependencia = "";
}

if (isset($_SESSION['busqueda_concepto'])) {
    $concepto = $_SESSION['busqueda_concepto'];
} else {
    $concepto = "";
}

if (isset($_SESSION['busqueda_desde_fecha_recaudacion'])) {
    $desde_fecha_recaudacion = $_SESSION['busqueda_desde_fecha_recaudacion'];
} else {
    $desde_fecha_recaudacion = "";
}

if (isset($_SESSION['busqueda_hasta_fecha_recaudacion'])) {
    $hasta_fecha_recaudacion = $_SESSION['busqueda_hasta_fecha_recaudacion'];
} else {
    $hasta_fecha_recaudacion = "";
}

if (isset($_SESSION['busqueda_documento_recepcion'])) {
    $documento_recepcion = $_SESSION['busqueda_documento_recepcion'];
} else {
    $documento_recepcion = "";
}

if (isset($_SESSION['busqueda_desde_fecha_deposito'])) {
    $desde_fecha_deposito = $_SESSION['busqueda_desde_fecha_deposito'];
} else {
    $desde_fecha_deposito = "";
}

if (isset($_SESSION['busqueda_hasta_fecha_deposito'])) {
    $hasta_fecha_deposito = $_SESSION['busqueda_hasta_fecha_deposito'];
} else {
    $hasta_fecha_deposito = "";
}

if (isset($_SESSION['busqueda_codigo_operacion'])) {
    $codigo_operacion = $_SESSION['busqueda_codigo_operacion'];
} else {
    $codigo_operacion = "";
}

if (isset($_SESSION['busqueda_estado'])) {
    $estado = $_SESSION['busqueda_estado'];
} else {
    $estado = "";
}


$sql_recaudacion_ingresos = "SELECT recaudacion.id_recaudacion as id_recaudacion, 
recaudacion.nombre_dependencia as nombre_dependencia,
recaudacion.detalle_concepto as detalle_concepto,
recaudacion.nombre_banco as nombre_banco,
recaudacion.fecha_recaudacion as fecha_recaudacion,
recaudacion.nombre_encargado as nombre_encargado,
recaudacion.documento_recepcion as documento_recepcion, 
recaudacion.monto_recaudado as monto_recaudado, 
recaudacion.nombre_banco2 as nombre_banco2, 
recaudacion.numero_cuenta2 as numero_cuenta2,
recaudacion.fecha_deposito as fecha_deposito, 
recaudacion.numero_documento as numero_documento, 
recaudacion.importe as importe, 
recaudacion.nombre_depositante as nombre_depositante,
recaudacion.dni as dni,
recaudacion.numero_operacion as numero_operacion,
recaudacion.estado as estado,
recaudacion.observacion as observacion,
recaudacion.fyh_creacion as fecha_creacion,
recaudacion.fyh_actualizacion as fecha_actualizacion,
usuarios.id_usuario as id_usuario,
usuarios.nombres as nombres,
usuarios.apaterno as apaterno,
usuarios.amaterno as amaterno 
FROM tb_recaudacion_ingresos as recaudacion 
LEFT JOIN tb_usuarios as usuarios ON usuarios.id_usuario = recaudacion.id_usuario 
WHERE recaudacion.visible!=1 ";

if (isset($_SESSION["busqueda_boton_recaudacion_ingreso"])) {


    if (
        !isset($nombre_dependencia) && !isset($concepto) && !isset($desde_fecha_recaudacion) && !isset($hasta_fecha_recaudacion) && !isset($documento_recepcion) && !isset($desde_fecha_deposito)
        && !isset($hasta_fecha_deposito) && !isset($codigo_operacion) && !isset($estado)
    ) {
        $sql_recaudacion_ingresos .= "";
    } else {

        if (!empty($nombre_dependencia)) {
            $sql_recaudacion_ingresos .= " AND nombre_dependencia='" . $nombre_dependencia . "'";
        }

        if (!empty($concepto)) {
            $sql_recaudacion_ingresos .= " AND detalle_concepto like '%" . $concepto . "%'";
        }

        if (!empty($desde_fecha_recaudacion) && !empty($hasta_fecha_recaudacion)) {
            $sql_recaudacion_ingresos .= " AND fecha_recaudacion between '" . $desde_fecha_recaudacion . " 00:00:00" . "' and '" . $hasta_fecha_recaudacion . " 23:59:59" . "'";
        }

        if (!empty($documento_recepcion)) {
            $sql_recaudacion_ingresos .= " AND documento_recepcion like '%" . $documento_recepcion . "%'";
        }

        if (!empty($desde_fecha_deposito) && !empty($hasta_fecha_deposito)) {
            $sql_recaudacion_ingresos .= " AND fecha_deposito between '" . $desde_fecha_deposito . " 00:00:00" . "' and '" . $hasta_fecha_deposito . " 23:59:59" . "'";
        }

        if (!empty($codigo_operacion)) {
            $sql_recaudacion_ingresos .= " AND numero_operacion='" . $codigo_operacion . "'";
        }

        if (!empty($estado)) {
            $sql_recaudacion_ingresos .= " AND estado='" . $estado . "'";
        }

    }

    $sql_recaudacion_ingresos .= " ORDER BY fecha_recaudacion ASC";


    $query_recaudacion_ingresos = $pdo->prepare($sql_recaudacion_ingresos);
    $query_recaudacion_ingresos->execute();
    $recaudacion_ingresos_datos = $query_recaudacion_ingresos->fetchAll(PDO::FETCH_ASSOC);

}

if (!isset($recaudacion_ingresos_datos)) {
    $recaudacion_ingresos_datos = '';
} else {
    $row = 3;
    foreach ($recaudacion_ingresos_datos as $recaudacion_ingresos_dato) {


        $spreadsheet->getActiveSheet()
            ->setCellValue('A' . $row, $contador = $contador + 1, )
            ->setCellValue('B' . $row, $recaudacion_ingresos_dato['nombre_dependencia'])
            ->setCellValue('C' . $row, $recaudacion_ingresos_dato['detalle_concepto'])
            ->setCellValue('D' . $row, $recaudacion_ingresos_dato['nombre_banco'])
            ->setCellValue('E' . $row, $recaudacion_ingresos_dato['fecha_recaudacion'])
            ->setCellValue('F' . $row, $recaudacion_ingresos_dato['nombre_encargado'])
            ->setCellValue('G' . $row, $recaudacion_ingresos_dato['documento_recepcion'])
            ->setCellValue('H' . $row, $recaudacion_ingresos_dato['monto_recaudado'])
            ->setCellValue('I' . $row, $recaudacion_ingresos_dato['nombre_banco2'])
            ->setCellValue('J' . $row, $recaudacion_ingresos_dato['numero_cuenta2'])
            ->setCellValue('K' . $row, $recaudacion_ingresos_dato['fecha_deposito'])
            ->setCellValue('L' . $row, $recaudacion_ingresos_dato['numero_documento'])
            ->setCellValue('M' . $row, $recaudacion_ingresos_dato['importe'])
            ->setCellValue('N' . $row, $recaudacion_ingresos_dato['nombre_depositante'])
            ->setCellValue('O' . $row, $recaudacion_ingresos_dato['dni'])
            ->setCellValue('P' . $row, $recaudacion_ingresos_dato['numero_operacion'])
            ->setCellValue('Q' . $row, $recaudacion_ingresos_dato['estado'])
            ->setCellValue('R' . $row, $recaudacion_ingresos_dato['observacion'])
            ->setCellValue('S' . $row, $recaudacion_ingresos_dato['fecha_creacion'])
            ->setCellValue('T' . $row, $recaudacion_ingresos_dato['fecha_actualizacion'])
            ->setCellValue('U' . $row, $recaudacion_ingresos_dato['nombres'] . " " . $recaudacion_ingresos_dato['apaterno'] . " " . $recaudacion_ingresos_dato['amaterno']);


        //Convierte en formato decimal
        $currencyMask = new Currency(
            '',
            2,
            Number::WITH_THOUSANDS_SEPARATOR,
            Currency::TRAILING_SYMBOL,
            Currency::SYMBOL_WITH_SPACING
        );

        $value = $recaudacion_ingresos_dato['monto_recaudado'];
        $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $value);
        $spreadsheet->getActiveSheet()->getStyle('H' . $row)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $recaudacion_ingresos_dato['importe'];
        $spreadsheet->getActiveSheet()->setCellValue('M' . $row, $value);
        $spreadsheet->getActiveSheet()->getStyle('M' . $row)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);


        //Convierte en formato fecha
        $value = $recaudacion_ingresos_dato['fecha_recaudacion'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('E' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $recaudacion_ingresos_dato['fecha_deposito'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('K' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('K' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $recaudacion_ingresos_dato['fecha_creacion'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('S' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('S' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY HH:mm:ss');

        $value = $recaudacion_ingresos_dato['fecha_actualizacion'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('T' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('T' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY HH:mm:ss');



        //set row style
        if ($row % 2 == 0) {
            //even row
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':U' . $row)->applyFromArray($evenRow);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':U' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':U' . $row)->getAlignment()->setHorizontal('left');
        } else {
            //odd row
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':U' . $row)->applyFromArray($oddRow);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':U' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':U' . $row)->getAlignment()->setHorizontal('left');
        }
        //increment row
        $row++;


    }


    //autofilter
    //define first row and last row
    $firstRow = 2;
    $lastRow = $row - 1;
    //set the autofilter
    $spreadsheet->getActiveSheet()->setAutoFilter("A" . $firstRow . ":U" . $lastRow); //Establecer filtros en las columnas
}

//set the header first, so the result will be treated as an xlsx file.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//make it an attachment so we can define filename
header('Content-Disposition: attachment;filename=' . $fileName . '');

//create IOFactory object
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//save into php output
$writer->save('php://output');

