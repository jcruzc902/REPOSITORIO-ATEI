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




$fileName = "REPORTE DE CARTAS FIANZA " . date('d-m-Y H:i:s') . ".xlsx";

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
$sheet->setTitle('REPORTE DE CARTAS FIANZA');

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
    ->setCellValue('B1', "REPORTE DE CARTAS FIANZA - OFICINA DE TESORERIA");

//merge heading
$spreadsheet->getActiveSheet()->mergeCells("B1:AH1");

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

//header text
$spreadsheet->getActiveSheet()
    ->setCellValue('A2', "ID")
    ->setCellValue('B2', "PERIODO")
    ->setCellValue('C2', "ENTIDAD FINANCIERA")
    ->setCellValue('D2', "NRO RUC")
    ->setCellValue('E2', "ESTADO")
    ->setCellValue('F2', "CARTA FIANZA N°")
    ->setCellValue('G2', "MONTO")
    ->setCellValue('H2', "CODIGO CARTA FIANZA N°")
    ->setCellValue('I2', "TIPO DE GARANTIA")
    ->setCellValue('J2', "AFIANZADOR")
    ->setCellValue('K2', "RUC")
    ->setCellValue('L2', "ESTADO")
    ->setCellValue('M2', "OBJETO DE CONTRATACION")
    ->setCellValue('N2', "DESCRIPCION DEL OBJETO")
    ->setCellValue('O2', "TIPO DE SELECCION")
    ->setCellValue('P2', "NUMERO DE SELECCION")
    ->setCellValue('Q2', "AÑO DE LA CONVOCATORIA")
    ->setCellValue('R2', "ORDEN DE SERVICIO")
    ->setCellValue('S2', "ORDEN DE COMPRA")
    ->setCellValue('T2', "FECHA DE INICIO")
    ->setCellValue('U2', "FECHA DE TERMINO")
    ->setCellValue('V2', "CONDICION")
    ->setCellValue('W2', "OBSERVACION")
    ->setCellValue('X2', "DOCUMENTO")
    ->setCellValue('Y2', "FECHA")
    ->setCellValue('Z2', "RECEPTOR")
    ->setCellValue('AA2', "NT N°")
    ->setCellValue('AB2', "NT AÑO")
    ->setCellValue('AC2', "DOCUMENTO NT")
    ->setCellValue('AD2', "ARCHIVO")
    ->setCellValue('AE2', "OBSERVACION")
    ->setCellValue('AF2', "FECHA REGISTRO")
    ->setCellValue('AG2', "FECHA ACTUALIZACION")
    ->setCellValue('AH2', "USUARIO");




//set font style and background color
$spreadsheet->getActiveSheet()->getStyle('A2:AH2')->applyFromArray($tableHead); //estilo de fondo en la cabecera
$spreadsheet->getActiveSheet()->getStyle('A2:AH2')->getAlignment()->setHorizontal('center'); //alineacion cental
$spreadsheet->getActiveSheet()->freezePane('A3'); //Congela la pantalla


$styleArray = [

    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],

];

$spreadsheet->getActiveSheet()->getStyle('A2:AH2')->applyFromArray($styleArray);


#BASE DE DATOS
$contador = 0;
$anio_actual_x = date('Y');

session_start();

if (isset($_SESSION['busqueda_periodo'])) {
    $periodo = $_SESSION['busqueda_periodo'];
} else {
    $periodo = "";
}

if (isset($_SESSION['busqueda_entidad_financiera'])) {
    $entidad_financiera = $_SESSION['busqueda_entidad_financiera'];
} else {
    $entidad_financiera = "";
}

if (isset($_SESSION['busqueda_cf_numero'])) {
    $cf_numero = $_SESSION['busqueda_cf_numero'];
} else {
    $cf_numero = "";
}

if (isset($_SESSION['busqueda_afianzador'])) {
    $afianzador = $_SESSION['busqueda_afianzador'];
} else {
    $afianzador = "";
}

if (isset($_SESSION['busqueda_tipo_seleccion'])) {
    $tipo_seleccion = $_SESSION['busqueda_tipo_seleccion'];
} else {
    $tipo_seleccion = "";
}

if (isset($_SESSION['busqueda_condicion'])) {
    $condicion = $_SESSION['busqueda_condicion'];
} else {
    $condicion = "";
}

if (isset($_SESSION['busqueda_observacion'])) {
    $observacion = $_SESSION['busqueda_observacion'];
} else {
    $observacion = "";
}

if (isset($_SESSION['busqueda_nt_numero'])) {
    $nt_numero = $_SESSION['busqueda_nt_numero'];
} else {
    $nt_numero = "";
}

if (isset($_SESSION['busqueda_nt_anio'])) {
    $nt_anio = $_SESSION['busqueda_nt_anio'];
} else {
    $nt_anio = "";
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

$sql_carta_fianza = "SELECT *,
cf.fyh_creacion as fyh_creacioncf,
cf.fyh_actualizacion as fyh_actualizacioncf, 
us.id_usuario as id_usuario,
us.nombres as nombres_usuario,
us.apaterno as apellido_paterno,
us.amaterno as apellido_materno 
FROM tb_cartas_fianza as cf 
INNER JOIN tb_usuarios as us ON us.id_usuario= cf.id_usuario 
WHERE cf.visible>=0 ";

if (isset($_SESSION['busqueda_boton_carta_fianza'])) {

    if (
        !isset($periodo) && !isset($entidad_financiera) && !isset($cf_numero) && !isset($afianzador) && !isset($tipo_seleccion) && !isset($condicion) &&
        !isset($observacion) && !isset($nt_numero) && !isset($nt_anio) && !isset($desde) && !isset($hasta)
    ) {
        $sql_carta_fianza .= " ";
    } else {

        if (!empty($periodo)) {
            $sql_carta_fianza .= " AND cf.periodo='" . $periodo . "'";
        }

        if (!empty($entidad_financiera)) {
            $sql_carta_fianza .= " AND cf.entidad_financiera='" . $entidad_financiera . "'";
        }

        if (!empty($cf_numero)) {
            $sql_carta_fianza .= " AND cf.nro_carta_fianza like '%" . $cf_numero . "%'";
        }

        if (!empty($afianzador)) {
            $sql_carta_fianza .= " AND cf.afianzador='" . $afianzador . "'";
        }

        if (!empty($tipo_seleccion)) {
            $sql_carta_fianza .= " AND cf.tipo_seleccion='" . $tipo_seleccion . "'";
        }

        if (!empty($condicion)) {
            $sql_carta_fianza .= " AND cf.condicion='" . $condicion . "'";
        }

        if (!empty($observacion)) {
            $sql_carta_fianza .= " AND cf.observacion='" . $observacion . "'";
        }

        if (!empty($nt_numero)) {
            $sql_carta_fianza .= " AND cf.nt_nro like '%" . $nt_numero . "%'";
        }

        if (!empty($nt_anio)) {
            $sql_carta_fianza .= " AND cf.nt_anio='" . $nt_anio . "'";
        }


        if (!empty($desde) && !empty($hasta)) {
            $sql_carta_fianza .= " AND cf.fyh_creacion between '" . $desde . " 00:00:00" . "' and '" . $hasta . " 23:59:59" . "'";
        }




    }


    $query_carta_fianza = $pdo->prepare($sql_carta_fianza);
    $query_carta_fianza->execute();
    $carta_fianza_datos = $query_carta_fianza->fetchAll(PDO::FETCH_ASSOC);
}

if (!isset($carta_fianza_datos)) {
    $carta_fianza_datos = '';
} else {
    $row = 3;
    foreach ($carta_fianza_datos as $carta_fianza_dato) {


        $spreadsheet->getActiveSheet()
            ->setCellValue('A' . $row, $contador = $contador + 1, )
            ->setCellValue('B' . $row, $carta_fianza_dato['periodo'])
            ->setCellValue('C' . $row, $carta_fianza_dato['entidad_financiera'])
            ->setCellValue('D' . $row, $carta_fianza_dato['ruc_entidad'])
            ->setCellValue('E' . $row, $carta_fianza_dato['estado_entidad'])
            ->setCellValue('F' . $row, $carta_fianza_dato['nro_carta_fianza'])
            ->setCellValue('G' . $row, $carta_fianza_dato['monto'])
            ->setCellValue('H' . $row, $carta_fianza_dato['codigo'])
            ->setCellValue('I' . $row, $carta_fianza_dato['tipo_garantia'])
            ->setCellValue('J' . $row, $carta_fianza_dato['afianzador'])
            ->setCellValue('K' . $row, $carta_fianza_dato['ruc_afianzador'])
            ->setCellValue('L' . $row, $carta_fianza_dato['estado_afianzador'])
            ->setCellValue('M' . $row, $carta_fianza_dato['objeto_contratacion'])
            ->setCellValue('N' . $row, $carta_fianza_dato['descripcion_objeto'])
            ->setCellValue('O' . $row, $carta_fianza_dato['tipo_seleccion'])
            ->setCellValue('P' . $row, $carta_fianza_dato['numero_seleccion'])
            ->setCellValue('Q' . $row, $carta_fianza_dato['anio_convocatoria'])
            ->setCellValue('R' . $row, $carta_fianza_dato['orden_servicio'])
            ->setCellValue('S' . $row, $carta_fianza_dato['orden_compra'])
            ->setCellValue('T' . $row, $carta_fianza_dato['fecha_inicio'])
            ->setCellValue('U' . $row, $carta_fianza_dato['fecha_termino'])
            ->setCellValue('V' . $row, $carta_fianza_dato['condicion'])
            ->setCellValue('W' . $row, $carta_fianza_dato['observacion'])
            ->setCellValue('X' . $row, $carta_fianza_dato['documento'])
            ->setCellValue('Y' . $row, $carta_fianza_dato['fecha_documento'])
            ->setCellValue('Z' . $row, $carta_fianza_dato['receptor'])
            ->setCellValue('AA' . $row, $carta_fianza_dato['nt_nro'])
            ->setCellValue('AB' . $row, $carta_fianza_dato['nt_anio'])
            ->setCellValue('AC' . $row, $carta_fianza_dato['observacion_nt'])
            ->setCellValue('AD' . $row, $carta_fianza_dato['nombre_archivo'])
            ->setCellValue('AE' . $row, $carta_fianza_dato['observacion_cf'])
            ->setCellValue('AF' . $row, $carta_fianza_dato['fyh_creacioncf'])
            ->setCellValue('AG' . $row, $carta_fianza_dato['fyh_actualizacioncf'])
            ->setCellValue('AH' . $row, $carta_fianza_dato['nombres_usuario'] . " " . $carta_fianza_dato['apellido_paterno'] . " " . $carta_fianza_dato['apellido_materno']);

        $value = $carta_fianza_dato['fecha_inicio'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('T' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('T' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $carta_fianza_dato['fecha_termino'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('U' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('U' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $carta_fianza_dato['fecha_documento'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('Y' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('Y' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');


        $value = $carta_fianza_dato['fyh_creacioncf'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AF' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AF' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY HH:mm:ss');

        $value = $carta_fianza_dato['fyh_actualizacioncf'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AG' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AG' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY HH:mm:ss');



        $currencyMask = new Currency(
            '',
            2,
            Number::WITH_THOUSANDS_SEPARATOR,
            Currency::TRAILING_SYMBOL,
            Currency::SYMBOL_WITH_SPACING
        );

        $value = $carta_fianza_dato['monto'];
        $spreadsheet->getActiveSheet()->setCellValue('G' . $row, $value);
        $spreadsheet->getActiveSheet()->getStyle('G' . $row)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);


        //set row style
        if ($row % 2 == 0) {
            //even row
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AH' . $row)->applyFromArray($evenRow);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AH' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AH' . $row)->getAlignment()->setHorizontal('left');
        } else {
            //odd row
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AH' . $row)->applyFromArray($oddRow);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AH' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AH' . $row)->getAlignment()->setHorizontal('left');
        }
        //increment row
        $row++;


    }

    //autofilter
    //define first row and last row
    $firstRow = 2;
    $lastRow = $row - 1;
    //set the autofilter
    $spreadsheet->getActiveSheet()->setAutoFilter("A" . $firstRow . ":AH" . $lastRow); //Establecer filtros en las columnas
}

//--------------------------------------------------------------------------------------------------------------------------------------


$hoja2 = $spreadsheet->createSheet();
$anio_periodo = 0;

if ($periodo == "") {
    $anio_periodo = $anio_actual_x;
} else {
    $anio_periodo = $periodo;
}

// Generale el nombre de hoja para que confirmes que tienes la hoja creada
$hoja2->setTitle('AFG - PERIODO ' . $anio_periodo);



$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('A1', "RELACIÓN DE CARTAS FIANZA EN CUSTODIA O ENTREGADAS - PERIODO " . $anio_periodo);

//merge heading
$spreadsheet->setActiveSheetIndex(1)->mergeCells("A1:K1");

// set font style
$spreadsheet->setActiveSheetIndex(1)->getStyle('A1')->getFont()->setSize(18);

// set font style
$spreadsheet->setActiveSheetIndex(1)->getStyle('A1')->getFont()->setName('Cambria');

// set font style
$spreadsheet->setActiveSheetIndex(1)->getStyle('A1')->getFont()->setBold(true);

// set cell alignment
$spreadsheet->setActiveSheetIndex(1)->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// set font style
#$spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(30);


$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('A2', "N°");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('B2', "CONTRATISTA");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('C2', "ENTIDAD FINANCIERA");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('D2', "CARTA FIANZA N°");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('E2', "MONEDA");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('F2', "IMPORTE");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('G2', "FECHA DE INICIO");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('H2', "FECHA DE TERMINO");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('I2', "OBJETO");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('J2', "TIPO DE GARANTIA");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('K2', "CONDICION");

$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('A')->setWidth(10);
$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('B')->setWidth(50);
$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('C')->setWidth(50);
$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('D')->setWidth(25);
$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('E')->setWidth(15);
$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('F')->setWidth(25);
$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('G')->setWidth(25);
$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('H')->setWidth(25);
$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('I')->setWidth(25);
$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('J')->setWidth(25);
$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('K')->setWidth(25);

$spreadsheet->setActiveSheetIndex(1)->getStyle('A2:K2')->getAlignment()->setHorizontal('center'); //alineacion cental
$spreadsheet->setActiveSheetIndex(1)->freezePane('A3'); //Congela la pantalla

$styleArray = [

    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],

];

$spreadsheet->setActiveSheetIndex(1)->getStyle('A1:K1')->applyFromArray($styleArray);
$spreadsheet->setActiveSheetIndex(1)->getStyle('A2:K2')->applyFromArray($styleArray);
$spreadsheet->setActiveSheetIndex(1)->getStyle('A2:K2')->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED));
$spreadsheet->setActiveSheetIndex(1)->getStyle('A2:K2')->getFont()->setBold(true);



#BASE DE DATOS
$contador2 = 0;

$sql_carta_fianza2 = "SELECT *,
cf.fyh_creacion as fyh_creacioncf,
cf.fyh_actualizacion as fyh_actualizacioncf, 
us.id_usuario as id_usuario,
us.nombres as nombres_usuario,
us.apaterno as apellido_paterno,
us.amaterno as apellido_materno 
FROM tb_cartas_fianza as cf 
INNER JOIN tb_usuarios as us ON us.id_usuario= cf.id_usuario 
WHERE cf.visible=0 ";

if (isset($_SESSION['busqueda_boton_carta_fianza'])) {


    if (
        !isset($periodo) && !isset($entidad_financiera) && !isset($cf_numero) && !isset($afianzador) && !isset($tipo_seleccion) && !isset($condicion) &&
        !isset($observacion) && !isset($nt_numero) && !isset($nt_anio) && !isset($desde) && !isset($hasta)
    ) {
        $sql_carta_fianza2 .= " ";
    } else {

        if (!empty($periodo)) {
            $sql_carta_fianza2 .= " AND cf.periodo='" . $periodo . "'";
        }

        if (!empty($entidad_financiera)) {
            $sql_carta_fianza2 .= " AND cf.entidad_financiera='" . $entidad_financiera . "'";
        }

        if (!empty($cf_numero)) {
            $sql_carta_fianza2 .= " AND cf.nro_carta_fianza like '%" . $cf_numero . "%'";
        }

        if (!empty($afianzador)) {
            $sql_carta_fianza2 .= " AND cf.afianzador='" . $afianzador . "'";
        }

        if (!empty($tipo_seleccion)) {
            $sql_carta_fianza2 .= " AND cf.tipo_seleccion='" . $tipo_seleccion . "'";
        }

        if (!empty($condicion)) {
            $sql_carta_fianza2 .= " AND cf.condicion='" . $condicion . "'";
        }

        if (!empty($observacion)) {
            $sql_carta_fianza2 .= " AND cf.observacion='" . $observacion . "'";
        }

        if (!empty($nt_numero)) {
            $sql_carta_fianza2 .= " AND cf.nt_nro like '%" . $nt_numero . "%'";
        }

        if (!empty($nt_anio)) {
            $sql_carta_fianza2 .= " AND cf.nt_anio='" . $nt_anio . "'";
        }


        if (!empty($desde) && !empty($hasta)) {
            $sql_carta_fianza2 .= " AND cf.fyh_creacion between '" . $desde . " 00:00:00" . "' and '" . $hasta . " 23:59:59" . "'";
        }




    }
    $query_carta_fianza2 = $pdo->prepare($sql_carta_fianza2);
    $query_carta_fianza2->execute();
    $carta_fianza_datos2 = $query_carta_fianza2->fetchAll(PDO::FETCH_ASSOC);
}

if (!isset($carta_fianza_datos2)) {
    $carta_fianza_datos2 = '';
} else {
    $row2 = 3;
    foreach ($carta_fianza_datos2 as $carta_fianza_dato2) {


        $spreadsheet->setActiveSheetIndex(1)
            ->setCellValue('A' . $row2, $contador2 = $contador2 + 1, )
            ->setCellValue('B' . $row2, $carta_fianza_dato2['afianzador'])
            ->setCellValue('C' . $row2, $carta_fianza_dato2['entidad_financiera'])
            ->setCellValue('D' . $row2, $carta_fianza_dato2['nro_carta_fianza'])
            ->setCellValue('E' . $row2, "S/.")
            ->setCellValue('F' . $row2, $carta_fianza_dato2['monto'])
            ->setCellValue('G' . $row2, $carta_fianza_dato2['fecha_inicio'])
            ->setCellValue('H' . $row2, $carta_fianza_dato2['fecha_termino'])
            ->setCellValue('I' . $row2, $carta_fianza_dato2['descripcion_objeto'])
            ->setCellValue('J' . $row2, $carta_fianza_dato2['tipo_garantia'])
            ->setCellValue('K' . $row2, $carta_fianza_dato2['condicion']);

        $value = $carta_fianza_dato2['fecha_inicio'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->setActiveSheetIndex(1)->setCellValue('G' . $row2, $dateValue);
        $spreadsheet->setActiveSheetIndex(1)->getStyle('G' . $row2)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $carta_fianza_dato2['fecha_termino'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->setActiveSheetIndex(1)->setCellValue('H' . $row2, $dateValue);
        $spreadsheet->setActiveSheetIndex(1)->getStyle('H' . $row2)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

       



        $currencyMask = new Currency(
            '',
            2,
            Number::WITH_THOUSANDS_SEPARATOR,
            Currency::TRAILING_SYMBOL,
            Currency::SYMBOL_WITH_SPACING
        );

        $value = $carta_fianza_dato2['monto'];
        $spreadsheet->setActiveSheetIndex(1)->setCellValue('F' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(1)->getStyle('F' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);


        //set row style
        if ($row2 % 2 == 0) {
            //even row
            #$spreadsheet->setActiveSheetIndex(1)->getStyle('A' . $row2 . ':AH' . $row2)->applyFromArray($evenRow);
            $spreadsheet->setActiveSheetIndex(1)->getStyle('A' . $row2 . ':K' . $row2)->applyFromArray($styleArray);
            $spreadsheet->setActiveSheetIndex(1)->getStyle('A' . $row2 . ':K' . $row2)->getAlignment()->setHorizontal('left');
        } else {
            //odd row
            #$spreadsheet->setActiveSheetIndex(1)->getStyle('A' . $row2 . ':AH' . $row2)->applyFromArray($oddRow);
            $spreadsheet->setActiveSheetIndex(1)->getStyle('A' . $row2 . ':K' . $row2)->applyFromArray($styleArray);
            $spreadsheet->setActiveSheetIndex(1)->getStyle('A' . $row2 . ':K' . $row2)->getAlignment()->setHorizontal('left');
        }
        //increment row
        $row2++;


    }

    //autofilter
    //define first row and last row
    $firstRow = 2;
    $lastRow = $row2 - 1;
    //set the autofilter
    $spreadsheet->setActiveSheetIndex(1)->setAutoFilter("A" . $firstRow . ":K" . $lastRow); //Establecer filtros en las columnas
}

//set the header first, so the result will be treated as an xlsx file.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//make it an attachment so we can define filename
header('Content-Disposition: attachment;filename=' . $fileName . '');

//create IOFactory object
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//save into php output
$writer->save('php://output');



