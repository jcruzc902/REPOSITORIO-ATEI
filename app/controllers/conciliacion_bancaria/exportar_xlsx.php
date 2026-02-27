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




$fileName = "REPORTE DE INGRESOS " . date('d-m-Y H:i:s') . ".xlsx";

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
$sheet->setTitle('REPORTE DE INGRESOS');

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
    ->setCellValue('B1', "REPORTE DE INGRESOS - OFICINA DE TESORERIA");

//merge heading
$spreadsheet->getActiveSheet()->mergeCells("B1:R1");

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
#$spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(40);


//header text
$spreadsheet->getActiveSheet()
    ->setCellValue('A2', "ID")
    ->setCellValue('B2', "MES CONCILIADO")
    ->setCellValue('C2', "AÑO")
    ->setCellValue('D2', "FECHA")
    ->setCellValue('E2', "CLASIFICADOR")
    ->setCellValue('F2', "IMPORTE (S/.)")
    ->setCellValue('G2', "SIIC")
    ->setCellValue('H2', "SIAF")
    ->setCellValue('I2', "DEPENDENCIA")
    ->setCellValue('J2', "DETALLE")
    #->setCellValue('K2', "NRO. RECIBO")
    ->setCellValue('K2', "BANCO")
    ->setCellValue('L2', "CUENTA")
    ->setCellValue('M2', "NOMBRE")
    ->setCellValue('N2', "ESTADO")
    ->setCellValue('O2', "OBSERVACION")
    ->setCellValue('P2', "FECHA REGISTRO")
    ->setCellValue('Q2', "FECHA ACTUALIZACION")
    ->setCellValue('R2', "USUARIO");




//set font style and background color
$spreadsheet->getActiveSheet()->getStyle('A2:R2')->applyFromArray($tableHead); //estilo de fondo en la cabecera
$spreadsheet->getActiveSheet()->getStyle('A2:R2')->getAlignment()->setHorizontal('center'); //alineacion cental
$spreadsheet->getActiveSheet()->freezePane('A3'); //Congela la pantalla


$styleArray = [

    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],

];

$spreadsheet->getActiveSheet()->getStyle('A2:R2')->applyFromArray($styleArray);


#BASE DE DATOS
$contador = 0;
$anio_actual_x = date('Y');

session_start();

if (isset($_SESSION['busqueda_mes'])) {
    $mes = $_SESSION['busqueda_mes'];
} else {
    $mes = "";
}

if (isset($_SESSION['busqueda_anio'])) {
    $anio = $_SESSION['busqueda_anio'];
} else {
    $anio = "";
}

if (isset($_SESSION['busqueda_clasificador'])) {
    $clasificador = $_SESSION['busqueda_clasificador'];
} else {
    $clasificador = "";
}

if (isset($_SESSION['busqueda_siaf'])) {
    $siaf = $_SESSION['busqueda_siaf'];
} else {
    $siaf = "";
}

if (isset($_SESSION['busqueda_dependencia'])) {
    $dependencia = $_SESSION['busqueda_dependencia'];
} else {
    $dependencia = "";
}

if (isset($_SESSION['busqueda_banco'])) {
    $banco = $_SESSION['busqueda_banco'];
} else {
    $banco = "";
}

if (isset($_SESSION['busqueda_cuenta'])) {
    $cuenta = $_SESSION['busqueda_cuenta'];
} else {
    $cuenta = "";
}

if (isset($_SESSION['busqueda_estado'])) {
    $estado = $_SESSION['busqueda_estado'];
} else {
    $estado = "";
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

$sql_conciliacion = "SELECT cb.mes_ingresos as mes_ingresos,
cb.anio_ingresos as anio_ingresos,
cb.fecha_ingresos as fecha_ingresos,
cb.clasificador_ingresos as clasificador_ingresos,
cb.importe_ingresos as importe_ingresos,
cb.siic_ingresos as siic_ingresos,
cb.siaf_ingresos as siaf_ingresos,
cb.dependencia_ingresos as dependencia_ingresos,
cb.detalle_ingresos as detalle_ingresos,
cb.nro_recibo as nro_recibo,
cb.banco_ingresos as banco_ingresos,
cb.cta_ingresos as cta_ingresos,
cb.nombre_ingresos as nombre_ingresos,
cb.estado as estado_conciliacion,
cb.observacion as observacion_conciliacion,
cb.fyh_creacion as fyh_creacioncb,
cb.fyh_actualizacion as fyh_actualizacioncb, 
us.id_usuario as id_usuario,
us.nombres as nombres_usuario,
us.apaterno as apellido_paterno,
us.amaterno as apellido_materno 
FROM tb_conciliacion_bancaria as cb 
INNER JOIN tb_usuarios as us ON us.id_usuario= cb.id_usuario 
WHERE cb.visible!=1 ";

if (isset($_SESSION['busqueda_boton_conciliacion'])) {

    if (
        !isset($mes) && !isset($anio) && !isset($clasificador) && !isset($siaf) && !isset($dependencia) && !isset($banco) &&
        !isset($cuenta) && !isset($estado) && !isset($desde) && !isset($hasta)
    ) {
        $sql_conciliacion .= " ";
    } else {

        if (!empty($mes)) {
            $sql_conciliacion .= " AND cb.mes_ingresos='" . $mes . "'";
        }

        if (!empty($anio)) {
            $sql_conciliacion .= " AND cb.anio_ingresos='" . $anio . "'";
        }

        if (!empty($clasificador)) {
            $sql_conciliacion .= " AND cb.clasificador_ingresos='" . $clasificador . "'";
        }

        if (!empty($siaf)) {
            $sql_conciliacion .= " AND cb.siaf_ingresos like '%" . $siaf . "%'";
        }

        if (!empty($dependencia)) {
            $sql_conciliacion .= " AND cb.dependencia_ingresos='" . $dependencia . "'";
        }

        if (!empty($banco)) {
            $sql_conciliacion .= " AND cb.banco_ingresos='" . $banco . "'";
        }

        if (!empty($cuenta)) {
            $sql_conciliacion .= " AND cb.cta_ingresos='" . $cuenta . "'";
        }

        if (!empty($estado)) {
            $sql_conciliacion .= " AND cb.estado='" . $estado . "'";
        }

        if (!empty($desde) && !empty($hasta)) {
            $sql_conciliacion .= " AND cb.fecha_ingresos between '" . $desde . " 00:00:00" . "' and '" . $hasta . " 23:59:59" . "'";
        }




    }


    $sql_conciliacion .= " ORDER BY cb.fecha_ingresos,cb.clasificador_ingresos ASC"; //ordenar segun formato


    $query_conciliacion = $pdo->prepare($sql_conciliacion);
    $query_conciliacion->execute();
    $conciliacion_datos = $query_conciliacion->fetchAll(PDO::FETCH_ASSOC);
}

if (!isset($conciliacion_datos)) {
    $conciliacion_datos = '';
} else {
    $row = 3;
    foreach ($conciliacion_datos as $conciliacion_dato) {


        $spreadsheet->getActiveSheet()
            ->setCellValue('A' . $row, $contador = $contador + 1, )
            ->setCellValue('B' . $row, $conciliacion_dato['mes_ingresos'])
            ->setCellValue('C' . $row, $conciliacion_dato['anio_ingresos'])
            ->setCellValue('D' . $row, $conciliacion_dato['fecha_ingresos'])
            ->setCellValue('E' . $row, $conciliacion_dato['clasificador_ingresos'])
            ->setCellValue('F' . $row, $conciliacion_dato['importe_ingresos'])
            ->setCellValue('G' . $row, $conciliacion_dato['siic_ingresos'])
            ->setCellValue('H' . $row, $conciliacion_dato['siaf_ingresos'])
            ->setCellValue('I' . $row, $conciliacion_dato['dependencia_ingresos'])
            ->setCellValue('J' . $row, $conciliacion_dato['detalle_ingresos'])
            #->setCellValue('K' . $row, $conciliacion_dato['nro_recibo'])
            ->setCellValue('K' . $row, $conciliacion_dato['banco_ingresos'])
            ->setCellValue('L' . $row, $conciliacion_dato['cta_ingresos'])
            ->setCellValue('M' . $row, $conciliacion_dato['nombre_ingresos'])
            ->setCellValue('N' . $row, $conciliacion_dato['estado_conciliacion'])
            ->setCellValue('O' . $row, $conciliacion_dato['observacion_conciliacion'])
            ->setCellValue('P' . $row, $conciliacion_dato['fyh_creacioncb'])
            ->setCellValue('Q' . $row, $conciliacion_dato['fyh_actualizacioncb'])
            ->setCellValue('R' . $row, $conciliacion_dato['nombres_usuario'] . " " . $conciliacion_dato['apellido_paterno'] . " " . $conciliacion_dato['apellido_materno']);
 
        $value = $conciliacion_dato['fecha_ingresos'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('D' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('D' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');




        $value = $conciliacion_dato['fyh_creacioncb'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('P' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('P' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY HH:mm:ss');

        $value = $conciliacion_dato['fyh_actualizacioncb'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('Q' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('Q' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY HH:mm:ss');



        $currencyMask = new Currency(
            '',
            2,
            Number::WITH_THOUSANDS_SEPARATOR,
            Currency::TRAILING_SYMBOL,
            Currency::SYMBOL_WITH_SPACING
        );

        $value = $conciliacion_dato['importe_ingresos'];
        $spreadsheet->getActiveSheet()->setCellValue('F' . $row, $value);
        $spreadsheet->getActiveSheet()->getStyle('F' . $row)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);


        //set row style
        if ($row % 2 == 0) {
            //even row
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':R' . $row)->applyFromArray($evenRow);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':R' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':R' . $row)->getAlignment()->setHorizontal('left');
        } else {
            //odd row
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':R' . $row)->applyFromArray($oddRow);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':R' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':R' . $row)->getAlignment()->setHorizontal('left');
        }
        //increment row
        $row++;


    }

    //autofilter
    //define first row and last row
    $firstRow = 2;
    $lastRow = $row - 1;
    //set the autofilter
    $spreadsheet->getActiveSheet()->setAutoFilter("A" . $firstRow . ":R" . $lastRow); //Establecer filtros en las columnas
}

//--------------------------------------------------------------------------------------------------------------------------------------

if ($anio == "") {
    $anio = $anio_actual_x;
}

$hoja2 = $spreadsheet->createSheet();




// Generale el nombre de hoja para que confirmes que tienes la hoja creada
$hoja2->setTitle('FACULTADES ' . $anio);



$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('A1', "UNIVERSIDAD NACIONAL FEDERICO VILLAREAL");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('A2', "AREA DE INGRESOS Y CONCILIACIONES");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('A3', "CUADRO DE RESUMEN DE INGRESOS EJECUTADOS " . $anio);

//merge heading
$spreadsheet->setActiveSheetIndex(1)->mergeCells("A1:N1");
$spreadsheet->setActiveSheetIndex(1)->mergeCells("A2:N2");
$spreadsheet->setActiveSheetIndex(1)->mergeCells("A3:N3");

// set font style
$spreadsheet->setActiveSheetIndex(1)->getStyle('A1')->getFont()->setSize(18);
$spreadsheet->setActiveSheetIndex(1)->getStyle('A2')->getFont()->setSize(18);
$spreadsheet->setActiveSheetIndex(1)->getStyle('A3')->getFont()->setSize(18);

// set font style
$spreadsheet->setActiveSheetIndex(1)->getStyle('A1')->getFont()->setName('Cambria');
$spreadsheet->setActiveSheetIndex(1)->getStyle('A2')->getFont()->setName('Cambria');
$spreadsheet->setActiveSheetIndex(1)->getStyle('A3')->getFont()->setName('Cambria');

// set font style
$spreadsheet->setActiveSheetIndex(1)->getStyle('A1')->getFont()->setBold(true);
$spreadsheet->setActiveSheetIndex(1)->getStyle('A2')->getFont()->setBold(true);
$spreadsheet->setActiveSheetIndex(1)->getStyle('A3')->getFont()->setBold(true);

// set cell alignment
$spreadsheet->setActiveSheetIndex(1)->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$spreadsheet->setActiveSheetIndex(1)->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$spreadsheet->setActiveSheetIndex(1)->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
// set font style
#$spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(30);


$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('A4', "Facultad/Dependencia");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('B4', "Enero");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('C4', "Febrero");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('D4', "Marzo");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('E4', "Abril");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('F4', "Mayo");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('G4', "Junio");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('H4', "Julio");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('I4', "Agosto");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('J4', "Setiembre");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('K4', "Octubre");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('L4', "Noviembre");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('M4', "Diciembre");

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('N4', "Total");

$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('A')->setWidth(35);
$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('B')->setWidth(16);
$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('C')->setWidth(16);
$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('D')->setWidth(16);
$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('E')->setWidth(16);
$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('F')->setWidth(16);
$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('G')->setWidth(16);
$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('H')->setWidth(16);
$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('I')->setWidth(16);
$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('J')->setWidth(16);
$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('K')->setWidth(16);
$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('L')->setWidth(16);
$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('M')->setWidth(16);
$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('N')->setWidth(16);

$spreadsheet->getActiveSheet()->getStyle('A1:N1')->applyFromArray($tableHead); //estilo de fondo en la cabecera
$spreadsheet->getActiveSheet()->getStyle('A2:N2')->applyFromArray($tableHead); //estilo de fondo en la cabecera
$spreadsheet->getActiveSheet()->getStyle('A3:N3')->applyFromArray($tableHead); //estilo de fondo en la cabecera
$spreadsheet->getActiveSheet()->getStyle('A4:N4')->applyFromArray($tableHead); //estilo de fondo en la cabecera
$spreadsheet->setActiveSheetIndex(1)->getStyle('A4:N4')->getAlignment()->setHorizontal('center'); //alineacion cental
$spreadsheet->setActiveSheetIndex(1)->freezePane('A5'); //Congela la pantalla

$styleArray = [

    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],

];

$spreadsheet->setActiveSheetIndex(1)->getStyle('A1:N1')->applyFromArray($styleArray);
$spreadsheet->setActiveSheetIndex(1)->getStyle('A2:N2')->applyFromArray($styleArray);
$spreadsheet->setActiveSheetIndex(1)->getStyle('A3:N3')->applyFromArray($styleArray);
$spreadsheet->setActiveSheetIndex(1)->getStyle('A4:N4')->applyFromArray($styleArray);
#$spreadsheet->setActiveSheetIndex(1)->getStyle('A2:N2')->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED));
$spreadsheet->setActiveSheetIndex(1)->getStyle('A4:N4')->getFont()->setBold(true);


$totalEnero = 0;
$totalFebrero = 0;
$totalMarzo = 0;
$totalAbril = 0;
$totalMayo = 0;
$totalJunio = 0;
$totalJulio = 0;
$totalAgosto = 0;
$totalSetiembre = 0;
$totalOctubre = 0;
$totalNoviembre = 0;
$totalDiciembre = 0;
$totalSuma = 0;

#BASE DE DATOS

$sql_resumen_facultad = "SELECT 
    f.nombre_facultad AS facultad,
    COALESCE(SUM(CASE WHEN c.mes_ingresos = 'ENERO' THEN c.importe_ingresos END), 0) AS Enero,
    COALESCE(SUM(CASE WHEN c.mes_ingresos = 'FEBRERO' THEN c.importe_ingresos END), 0) AS Febrero,
    COALESCE(SUM(CASE WHEN c.mes_ingresos = 'MARZO' THEN c.importe_ingresos END), 0) AS Marzo,
    COALESCE(SUM(CASE WHEN c.mes_ingresos = 'ABRIL' THEN c.importe_ingresos END), 0) AS Abril,
    COALESCE(SUM(CASE WHEN c.mes_ingresos = 'MAYO' THEN c.importe_ingresos END), 0) AS Mayo,
    COALESCE(SUM(CASE WHEN c.mes_ingresos = 'JUNIO' THEN c.importe_ingresos END), 0) AS Junio,
    COALESCE(SUM(CASE WHEN c.mes_ingresos = 'JULIO' THEN c.importe_ingresos END), 0) AS Julio,
    COALESCE(SUM(CASE WHEN c.mes_ingresos = 'AGOSTO' THEN c.importe_ingresos END), 0) AS Agosto,
    COALESCE(SUM(CASE WHEN c.mes_ingresos = 'SETIEMBRE' THEN c.importe_ingresos END), 0) AS Setiembre,
    COALESCE(SUM(CASE WHEN c.mes_ingresos = 'OCTUBRE' THEN c.importe_ingresos END), 0) AS Octubre,
    COALESCE(SUM(CASE WHEN c.mes_ingresos = 'NOVIEMBRE' THEN c.importe_ingresos END), 0) AS Noviembre,
    COALESCE(SUM(CASE WHEN c.mes_ingresos = 'DICIEMBRE' THEN c.importe_ingresos END), 0) AS Diciembre,
    COALESCE(SUM(c.importe_ingresos), 0) AS total
FROM (
    SELECT 'ADMINISTRACION CENTRAL' AS nombre_facultad UNION ALL
    SELECT 'ADMISION' UNION ALL
    SELECT 'CENTRO CULTURAL FEDERICO VILLARREAL' UNION ALL
    SELECT 'CENTRO DE EXTENSION UNIVERSITARIA Y PROYECCION SOCIAL' UNION ALL
    SELECT 'CENTRO PRE-UNIVERSITARIO' UNION ALL
    SELECT 'ESCUELA UNIVERSITARIA DE POST GRADO' UNION ALL
    SELECT 'FACULTAD DE ADMINISTRACION' UNION ALL
    SELECT 'FACULTAD DE ARQUITECTURA Y URBANISMO' UNION ALL
    SELECT 'FACULTAD DE CIENCIAS ECONÓMICAS' UNION ALL
    SELECT 'FACULTAD DE CIENCIAS FINANCIERAS Y CONTABLES' UNION ALL
    SELECT 'FACULTAD DE CIENCIAS NATURALES Y MATEMATICAS' UNION ALL
    SELECT 'FACULTAD DE CIENCIAS SOCIALES' UNION ALL
    SELECT 'FACULTAD DE DERECHO Y CIENCIAS POLITICAS' UNION ALL
    SELECT 'FACULTAD DE EDUCACION' UNION ALL
    SELECT 'FACULTAD DE HUMANIDADES' UNION ALL
    SELECT 'FACULTAD DE INGENIERIA CIVIL' UNION ALL
    SELECT 'FACULTAD DE INGENIERIA ELECTRONICA E INFORMATICA (FIEI)' UNION ALL
    SELECT 'FACULTAD DE INGENIERIA GEOGRAFICA Y AMBIENTAL' UNION ALL
    SELECT 'FACULTAD DE INGENIERIA INDUSTRIAL Y DE SISTEMAS' UNION ALL
    SELECT 'FACULTAD DE MEDICINA HUMANA' UNION ALL
    SELECT 'FACULTAD DE OCEONOGRAFIA, PESQUERIA CIENCIAS ALIMENTARIAS Y ACUICULTURA' UNION ALL
    SELECT 'FACULTAD DE ODONTOLOGIA' UNION ALL
    SELECT 'FACULTAD DE PSICOLOGIA' UNION ALL
    SELECT 'FACULTAD DE TECNOLOGIA MEDICA' UNION ALL
    SELECT 'INSTITUTO DE IDIOMAS' UNION ALL
    SELECT 'INSTITUTO DE RECREACION EDUCACION FISICA Y DEPORTES (IRED)' UNION ALL
    SELECT 'SECRETARIA GENERAL' UNION ALL
    SELECT 'CENTRO UNIVERSITARIA DE EDUCACION A DISTANCIA' UNION ALL
    SELECT 'OFICINA CENTRAL DE REGISTROS ACADEMICOS Y CENTRO DE COMPUTO (OCRACC)' UNION ALL
    SELECT 'EDITORIAL UNIVERSITARIA' UNION ALL
    SELECT 'OFICINA CENTRAL DE BIENESTAR UNIVERSITARIO' UNION ALL
    SELECT 'VICERECTORADO ACADEMICO' UNION ALL
    SELECT 'VICERECTORADO DE INVESTIGACION' UNION ALL
    SELECT 'VARIOS' UNION ALL
    SELECT 'OFICINA DE TESORERIA'
) AS f
LEFT JOIN tb_conciliacion_bancaria c 
    ON c.dependencia_ingresos = f.nombre_facultad
   AND c.visible != 1
   AND c.anio_ingresos = '$anio'
GROUP BY f.nombre_facultad
ORDER BY f.nombre_facultad";
$query_resumen_facultad = $pdo->prepare($sql_resumen_facultad);
$query_resumen_facultad->execute();
$resumen_facultad_datos2 = $query_resumen_facultad->fetchAll(PDO::FETCH_ASSOC);

if (!isset($resumen_facultad_datos2)) {
    $resumen_facultad_datos2 = '';
} else {
    $row2 = 5;
    foreach ($resumen_facultad_datos2 as $resumen_facultad_datos) {


        $spreadsheet->setActiveSheetIndex(1)
            ->setCellValue('A' . $row2, $resumen_facultad_datos['facultad'])
            ->setCellValue('B' . $row2, $resumen_facultad_datos['Enero'])
            ->setCellValue('C' . $row2, $resumen_facultad_datos['Febrero'])
            ->setCellValue('D' . $row2, $resumen_facultad_datos['Marzo'])
            ->setCellValue('E' . $row2, $resumen_facultad_datos['Abril'])
            ->setCellValue('F' . $row2, $resumen_facultad_datos['Mayo'])
            ->setCellValue('G' . $row2, $resumen_facultad_datos['Junio'])
            ->setCellValue('H' . $row2, $resumen_facultad_datos['Julio'])
            ->setCellValue('I' . $row2, $resumen_facultad_datos['Agosto'])
            ->setCellValue('J' . $row2, $resumen_facultad_datos['Setiembre'])
            ->setCellValue('K' . $row2, $resumen_facultad_datos['Octubre'])
            ->setCellValue('L' . $row2, $resumen_facultad_datos['Noviembre'])
            ->setCellValue('M' . $row2, $resumen_facultad_datos['Diciembre'])
            ->setCellValue('N' . $row2, $resumen_facultad_datos['total']);

        //suma por columna
        $totalEnero = $totalEnero + $resumen_facultad_datos['Enero'];
        $totalFebrero = $totalFebrero + $resumen_facultad_datos['Febrero'];
        $totalMarzo = $totalMarzo + $resumen_facultad_datos['Marzo'];
        $totalAbril = $totalAbril + $resumen_facultad_datos['Abril'];
        $totalMayo = $totalMayo + $resumen_facultad_datos['Mayo'];
        $totalJunio = $totalJunio + $resumen_facultad_datos['Junio'];
        $totalJulio = $totalJulio + $resumen_facultad_datos['Julio'];
        $totalAgosto = $totalAgosto + $resumen_facultad_datos['Agosto'];
        $totalSetiembre = $totalSetiembre + $resumen_facultad_datos['Setiembre'];
        $totalOctubre = $totalOctubre + $resumen_facultad_datos['Octubre'];
        $totalNoviembre = $totalNoviembre + $resumen_facultad_datos['Noviembre'];
        $totalDiciembre = $totalDiciembre + $resumen_facultad_datos['Diciembre'];
        $totalSuma = $totalSuma + $resumen_facultad_datos['total'];



        $currencyMask = new Currency(
            '',
            2,
            Number::WITH_THOUSANDS_SEPARATOR,
            Currency::TRAILING_SYMBOL,
            Currency::SYMBOL_WITH_SPACING
        );

        $value = $resumen_facultad_datos['Enero'];
        $spreadsheet->setActiveSheetIndex(1)->setCellValue('B' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(1)->getStyle('B' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_facultad_datos['Febrero'];
        $spreadsheet->setActiveSheetIndex(1)->setCellValue('C' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(1)->getStyle('C' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_facultad_datos['Marzo'];
        $spreadsheet->setActiveSheetIndex(1)->setCellValue('D' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(1)->getStyle('D' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_facultad_datos['Abril'];
        $spreadsheet->setActiveSheetIndex(1)->setCellValue('E' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(1)->getStyle('E' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_facultad_datos['Mayo'];
        $spreadsheet->setActiveSheetIndex(1)->setCellValue('F' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(1)->getStyle('F' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_facultad_datos['Junio'];
        $spreadsheet->setActiveSheetIndex(1)->setCellValue('G' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(1)->getStyle('G' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_facultad_datos['Julio'];
        $spreadsheet->setActiveSheetIndex(1)->setCellValue('H' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(1)->getStyle('H' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_facultad_datos['Agosto'];
        $spreadsheet->setActiveSheetIndex(1)->setCellValue('I' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(1)->getStyle('I' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_facultad_datos['Setiembre'];
        $spreadsheet->setActiveSheetIndex(1)->setCellValue('J' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(1)->getStyle('J' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_facultad_datos['Octubre'];
        $spreadsheet->setActiveSheetIndex(1)->setCellValue('K' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(1)->getStyle('K' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_facultad_datos['Noviembre'];
        $spreadsheet->setActiveSheetIndex(1)->setCellValue('L' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(1)->getStyle('L' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_facultad_datos['Diciembre'];
        $spreadsheet->setActiveSheetIndex(1)->setCellValue('M' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(1)->getStyle('M' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_facultad_datos['total'];
        $spreadsheet->setActiveSheetIndex(1)->setCellValue('N' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(1)->getStyle('N' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);



        //set row style
        if ($row2 % 2 == 0) {
            //even row
            #$spreadsheet->setActiveSheetIndex(1)->getStyle('A' . $row2 . ':AH' . $row2)->applyFromArray($evenRow);
            $spreadsheet->setActiveSheetIndex(1)->getStyle('A' . $row2 . ':N' . $row2)->applyFromArray($styleArray);
            $spreadsheet->setActiveSheetIndex(1)->getStyle('B' . $row2 . ':N' . $row2)->getAlignment()->setHorizontal('right');
        } else {
            //odd row
            #$spreadsheet->setActiveSheetIndex(1)->getStyle('A' . $row2 . ':AH' . $row2)->applyFromArray($oddRow);
            $spreadsheet->setActiveSheetIndex(1)->getStyle('A' . $row2 . ':N' . $row2)->applyFromArray($styleArray);
            $spreadsheet->setActiveSheetIndex(1)->getStyle('B' . $row2 . ':N' . $row2)->getAlignment()->setHorizontal('right');
        }
        //increment row
        $row2++;


    }

    $spreadsheet->setActiveSheetIndex(1)
        ->setCellValue('A40', "Total General");

    $spreadsheet->setActiveSheetIndex(1)
        ->setCellValue('B40', $totalEnero);

    $spreadsheet->setActiveSheetIndex(1)
        ->setCellValue('C40', $totalFebrero);

    $spreadsheet->setActiveSheetIndex(1)
        ->setCellValue('D40', $totalMarzo);

    $spreadsheet->setActiveSheetIndex(1)
        ->setCellValue('E40', $totalAbril);

    $spreadsheet->setActiveSheetIndex(1)
        ->setCellValue('F40', $totalMayo);

    $spreadsheet->setActiveSheetIndex(1)
        ->setCellValue('G40', $totalJunio);

    $spreadsheet->setActiveSheetIndex(1)
        ->setCellValue('H40', $totalJulio);

    $spreadsheet->setActiveSheetIndex(worksheetIndex: 1)
        ->setCellValue('I40', $totalAgosto);

    $spreadsheet->setActiveSheetIndex(1)
        ->setCellValue('J40', $totalSetiembre);

    $spreadsheet->setActiveSheetIndex(1)
        ->setCellValue('K40', $totalOctubre);

    $spreadsheet->setActiveSheetIndex(1)
        ->setCellValue('L40', $totalNoviembre);

    $spreadsheet->setActiveSheetIndex(1)
        ->setCellValue('M40', $totalDiciembre);

    $spreadsheet->setActiveSheetIndex(1)
        ->setCellValue('N40', $totalSuma);

    $value = $totalEnero;
    $spreadsheet->setActiveSheetIndex(1)->setCellValue('B40', $value);
    $spreadsheet->setActiveSheetIndex(1)->getStyle('B40')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalFebrero;
    $spreadsheet->setActiveSheetIndex(1)->setCellValue('C40', $value);
    $spreadsheet->setActiveSheetIndex(1)->getStyle('C40')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalMarzo;
    $spreadsheet->setActiveSheetIndex(1)->setCellValue('D40', $value);
    $spreadsheet->setActiveSheetIndex(1)->getStyle('D40')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalAbril;
    $spreadsheet->setActiveSheetIndex(1)->setCellValue('E40', $value);
    $spreadsheet->setActiveSheetIndex(1)->getStyle('E40')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalMayo;
    $spreadsheet->setActiveSheetIndex(1)->setCellValue('F40', $value);
    $spreadsheet->setActiveSheetIndex(1)->getStyle('F40')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalJunio;
    $spreadsheet->setActiveSheetIndex(1)->setCellValue('G40', $value);
    $spreadsheet->setActiveSheetIndex(1)->getStyle('G40')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalJulio;
    $spreadsheet->setActiveSheetIndex(1)->setCellValue('H40', $value);
    $spreadsheet->setActiveSheetIndex(1)->getStyle('H40')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalAgosto;
    $spreadsheet->setActiveSheetIndex(1)->setCellValue('I40', $value);
    $spreadsheet->setActiveSheetIndex(1)->getStyle('I40')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalSetiembre;
    $spreadsheet->setActiveSheetIndex(1)->setCellValue('J40', $value);
    $spreadsheet->setActiveSheetIndex(1)->getStyle('J40')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalOctubre;
    $spreadsheet->setActiveSheetIndex(1)->setCellValue('K40', $value);
    $spreadsheet->setActiveSheetIndex(1)->getStyle('K40')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalNoviembre;
    $spreadsheet->setActiveSheetIndex(1)->setCellValue('L40', $value);
    $spreadsheet->setActiveSheetIndex(1)->getStyle('L40')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalDiciembre;
    $spreadsheet->setActiveSheetIndex(1)->setCellValue('M40', $value);
    $spreadsheet->setActiveSheetIndex(1)->getStyle('M40')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalSuma;
    $spreadsheet->setActiveSheetIndex(1)->setCellValue('N40', $value);
    $spreadsheet->setActiveSheetIndex(1)->getStyle('N40')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $spreadsheet->setActiveSheetIndex(1)->getStyle('A40:N40')->applyFromArray($styleArray);

    //autofilter
    //define first row and last row
    $firstRow = 4;
    $lastRow = $row2 - 1;
    //set the autofilter
    $spreadsheet->setActiveSheetIndex(1)->setAutoFilter("A" . $firstRow . ":N" . $lastRow); //Establecer filtros en las columnas
}




//--------------------------------------------------------------------------------------------------------------------------------------


$hoja3 = $spreadsheet->createSheet();




// Generale el nombre de hoja para que confirmes que tienes la hoja creada
$hoja3->setTitle('CLASIFICADORES ' . $anio);



$spreadsheet->setActiveSheetIndex(2)
    ->setCellValue('A1', "UNIVERSIDAD NACIONAL FEDERICO VILLAREAL");

$spreadsheet->setActiveSheetIndex(2)
    ->setCellValue('A2', "AREA DE INGRESOS Y CONCILIACIONES");

$spreadsheet->setActiveSheetIndex(2)
    ->setCellValue('A3', "CUADRO DE RESUMEN DE INGRESOS EJECUTADOS " . $anio);

//merge heading
$spreadsheet->setActiveSheetIndex(2)->mergeCells("A1:O1");
$spreadsheet->setActiveSheetIndex(2)->mergeCells("A2:O2");
$spreadsheet->setActiveSheetIndex(2)->mergeCells("A3:O3");

// set font style
$spreadsheet->setActiveSheetIndex(2)->getStyle('A1')->getFont()->setSize(18);
$spreadsheet->setActiveSheetIndex(2)->getStyle('A2')->getFont()->setSize(18);
$spreadsheet->setActiveSheetIndex(2)->getStyle('A3')->getFont()->setSize(18);

// set font style
$spreadsheet->setActiveSheetIndex(2)->getStyle('A1')->getFont()->setName('Cambria');
$spreadsheet->setActiveSheetIndex(2)->getStyle('A2')->getFont()->setName('Cambria');
$spreadsheet->setActiveSheetIndex(2)->getStyle('A3')->getFont()->setName('Cambria');

// set font style
$spreadsheet->setActiveSheetIndex(2)->getStyle('A1')->getFont()->setBold(true);
$spreadsheet->setActiveSheetIndex(2)->getStyle('A2')->getFont()->setBold(true);
$spreadsheet->setActiveSheetIndex(2)->getStyle('A3')->getFont()->setBold(true);

// set cell alignment
$spreadsheet->setActiveSheetIndex(2)->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$spreadsheet->setActiveSheetIndex(2)->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$spreadsheet->setActiveSheetIndex(2)->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
// set font style
#$spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(30);


$spreadsheet->setActiveSheetIndex(2)
    ->setCellValue('A4', "Clasificadores");

$spreadsheet->setActiveSheetIndex(2)
    ->setCellValue('B4', "Descripcion");

$spreadsheet->setActiveSheetIndex(2)
    ->setCellValue('C4', "Enero");

$spreadsheet->setActiveSheetIndex(2)
    ->setCellValue('D4', "Febrero");

$spreadsheet->setActiveSheetIndex(2)
    ->setCellValue('E4', "Marzo");

$spreadsheet->setActiveSheetIndex(2)
    ->setCellValue('F4', "Abril");

$spreadsheet->setActiveSheetIndex(2)
    ->setCellValue('G4', "Mayo");

$spreadsheet->setActiveSheetIndex(2)
    ->setCellValue('H4', "Junio");

$spreadsheet->setActiveSheetIndex(2)
    ->setCellValue('I4', "Julio");

$spreadsheet->setActiveSheetIndex(2)
    ->setCellValue('J4', "Agosto");

$spreadsheet->setActiveSheetIndex(2)
    ->setCellValue('K4', "Setiembre");

$spreadsheet->setActiveSheetIndex(2)
    ->setCellValue('L4', "Octubre");

$spreadsheet->setActiveSheetIndex(2)
    ->setCellValue('M4', "Noviembre");

$spreadsheet->setActiveSheetIndex(2)
    ->setCellValue('N4', "Diciembre");

$spreadsheet->setActiveSheetIndex(2)
    ->setCellValue('O4', "Total");

$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('A')->setWidth(20);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('B')->setWidth(35);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('C')->setWidth(16);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('D')->setWidth(16);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('E')->setWidth(16);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('F')->setWidth(16);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('G')->setWidth(16);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('H')->setWidth(16);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('I')->setWidth(16);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('J')->setWidth(16);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('K')->setWidth(16);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('L')->setWidth(16);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('M')->setWidth(16);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('N')->setWidth(16);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('O')->setWidth(16);

$spreadsheet->getActiveSheet()->getStyle('A1:O1')->applyFromArray($tableHead); //estilo de fondo en la cabecera
$spreadsheet->getActiveSheet()->getStyle('A2:O2')->applyFromArray($tableHead); //estilo de fondo en la cabecera
$spreadsheet->getActiveSheet()->getStyle('A3:O3')->applyFromArray($tableHead); //estilo de fondo en la cabecera
$spreadsheet->getActiveSheet()->getStyle('A4:O4')->applyFromArray($tableHead); //estilo de fondo en la cabecera
$spreadsheet->setActiveSheetIndex(2)->getStyle('A4:O4')->getAlignment()->setHorizontal('center'); //alineacion cental
$spreadsheet->setActiveSheetIndex(2)->freezePane('A5'); //Congela la pantalla

$styleArray = [

    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],

];

$spreadsheet->setActiveSheetIndex(2)->getStyle('A1:O1')->applyFromArray($styleArray);
$spreadsheet->setActiveSheetIndex(2)->getStyle('A2:O2')->applyFromArray($styleArray);
$spreadsheet->setActiveSheetIndex(2)->getStyle('A3:O3')->applyFromArray($styleArray);
$spreadsheet->setActiveSheetIndex(2)->getStyle('A4:O4')->applyFromArray($styleArray);
#$spreadsheet->setActiveSheetIndex(2)->getStyle('A2:O2')->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED));
$spreadsheet->setActiveSheetIndex(2)->getStyle('A4:O4')->getFont()->setBold(true);


$totalEnero2 = 0;
$totalFebrero2 = 0;
$totalMarzo2 = 0;
$totalAbril2 = 0;
$totalMayo2 = 0;
$totalJunio2 = 0;
$totalJulio2 = 0;
$totalAgosto2 = 0;
$totalSetiembre2 = 0;
$totalOctubre2 = 0;
$totalNoviembre2 = 0;
$totalDiciembre2 = 0;
$totalSuma2 = 0;

#BASE DE DATOS

$sql_resumen_clasificador = "SELECT 
    c.codigo_clasificador AS clasificador,
    c.descripcion,
    COALESCE(SUM(CASE WHEN t.mes_ingresos = 'ENERO' THEN t.importe_ingresos END), 0) AS Enero,
    COALESCE(SUM(CASE WHEN t.mes_ingresos = 'FEBRERO' THEN t.importe_ingresos END), 0) AS Febrero,
    COALESCE(SUM(CASE WHEN t.mes_ingresos = 'MARZO' THEN t.importe_ingresos END), 0) AS Marzo,
    COALESCE(SUM(CASE WHEN t.mes_ingresos = 'ABRIL' THEN t.importe_ingresos END), 0) AS Abril,
    COALESCE(SUM(CASE WHEN t.mes_ingresos = 'MAYO' THEN t.importe_ingresos END), 0) AS Mayo,
    COALESCE(SUM(CASE WHEN t.mes_ingresos = 'JUNIO' THEN t.importe_ingresos END), 0) AS Junio,
    COALESCE(SUM(CASE WHEN t.mes_ingresos = 'JULIO' THEN t.importe_ingresos END), 0) AS Julio,
    COALESCE(SUM(CASE WHEN t.mes_ingresos = 'AGOSTO' THEN t.importe_ingresos END), 0) AS Agosto,
    COALESCE(SUM(CASE WHEN t.mes_ingresos = 'SETIEMBRE' THEN t.importe_ingresos END), 0) AS Setiembre,
    COALESCE(SUM(CASE WHEN t.mes_ingresos = 'OCTUBRE' THEN t.importe_ingresos END), 0) AS Octubre,
    COALESCE(SUM(CASE WHEN t.mes_ingresos = 'NOVIEMBRE' THEN t.importe_ingresos END), 0) AS Noviembre,
    COALESCE(SUM(CASE WHEN t.mes_ingresos = 'DICIEMBRE' THEN t.importe_ingresos END), 0) AS Diciembre,
    COALESCE(SUM(t.importe_ingresos), 0) AS total
FROM (
    SELECT '1.3.15.11' AS codigo_clasificador, 'VENTA DE PUBLICACIONES Y LIBROS' AS descripcion UNION ALL
    SELECT '1.3.23.11', 'CARNET' UNION ALL
    SELECT '1.3.23.12', 'DERECHOS DE ADMISION' UNION ALL
    SELECT '1.3.23.13', 'GRADOS Y TITULOS' UNION ALL
    SELECT '1.3.23.14', 'CONSTANCIAS Y CERTIFICADOS' UNION ALL
    SELECT '1.3.23.16', 'PENSION DE ENSEÑANZA' UNION ALL
    SELECT '1.3.23.17', 'MATRICULAS' UNION ALL
    SELECT '1.3.23.19', 'DERECHOS UNIVERSITARIOS' UNION ALL
    SELECT '1.3.23.199', 'OTROS DERECHOS ADMINS. DE EDUCACION' UNION ALL
    SELECT '1.3.33.11', 'ENSEÑANZA EN CENTRO PREUNIVERSITARIO' UNION ALL
    SELECT '1.3.33.299', 'OTROS SERVICIOS CULTURALES Y RECREATIVOS' UNION ALL
    SELECT '1.3.34.12', 'ATENCION DENTAL' UNION ALL
    SELECT '1.3.33.15', 'SERVICIOS ACADEMICOS' UNION ALL
    SELECT '1.3.35.11', 'EDIFICIOS E INSTALACIONES' UNION ALL
    SELECT '1.3.35.32', 'EQUIPOS DE COMUNICACION PARA REDES INFORMATICAS' UNION ALL
    SELECT '1.4.14.13', 'CANON MINERO' UNION ALL
    SELECT '1.4.14.15', 'CANON HIDROENERGETICO' UNION ALL
    SELECT '1.4.14.16', 'CANON PESQUERO' UNION ALL
    SELECT '1.4.14.21', 'REGALIAS MINERAS' UNION ALL
    SELECT '1.5.11.11', 'INTERESES' UNION ALL
    SELECT '1.5.51.499', 'OTROS INGRESOS DIVERSOS' UNION ALL
    SELECT '1.5.41.11', 'TRANSFERENCIAS VOLUNTARIAS CORRIENTES DE PERSONAS JURIDICAS' UNION ALL
    SELECT 'YG-005', 'VARIOS' UNION ALL
    SELECT 'YG-104', 'VARIOS' UNION ALL
    SELECT 'YG-117', 'VARIOS' UNION ALL
    SELECT 'YC-104', 'VARIOS'
) AS c
LEFT JOIN tb_conciliacion_bancaria t 
    ON t.clasificador_ingresos = c.codigo_clasificador
   AND t.visible != 1
   AND t.anio_ingresos = '$anio' 
GROUP BY c.codigo_clasificador, c.descripcion
ORDER BY c.codigo_clasificador";
$query_resumen_clasificador = $pdo->prepare($sql_resumen_clasificador);
$query_resumen_clasificador->execute();
$resumen_clasificador_datos2 = $query_resumen_clasificador->fetchAll(PDO::FETCH_ASSOC);

if (!isset($resumen_clasificador_datos2)) {
    $resumen_clasificador_datos2 = '';
} else {
    $row2 = 5;
    foreach ($resumen_clasificador_datos2 as $resumen_clasificador_datos) {


        $spreadsheet->setActiveSheetIndex(2)
            ->setCellValue('A' . $row2, $resumen_clasificador_datos['clasificador'])
            ->setCellValue('B' . $row2, $resumen_clasificador_datos['descripcion'])
            ->setCellValue('C' . $row2, $resumen_clasificador_datos['Enero'])
            ->setCellValue('D' . $row2, $resumen_clasificador_datos['Febrero'])
            ->setCellValue('E' . $row2, $resumen_clasificador_datos['Marzo'])
            ->setCellValue('F' . $row2, $resumen_clasificador_datos['Abril'])
            ->setCellValue('G' . $row2, $resumen_clasificador_datos['Mayo'])
            ->setCellValue('H' . $row2, $resumen_clasificador_datos['Junio'])
            ->setCellValue('I' . $row2, $resumen_clasificador_datos['Julio'])
            ->setCellValue('J' . $row2, $resumen_clasificador_datos['Agosto'])
            ->setCellValue('K' . $row2, $resumen_clasificador_datos['Setiembre'])
            ->setCellValue('L' . $row2, $resumen_clasificador_datos['Octubre'])
            ->setCellValue('M' . $row2, $resumen_clasificador_datos['Noviembre'])
            ->setCellValue('N' . $row2, $resumen_clasificador_datos['Diciembre'])
            ->setCellValue('O' . $row2, $resumen_clasificador_datos['total']);

        //suma por columna
        $totalEnero2 = $totalEnero2 + $resumen_clasificador_datos['Enero'];
        $totalFebrero2 = $totalFebrero2 + $resumen_clasificador_datos['Febrero'];
        $totalMarzo2 = $totalMarzo2 + $resumen_clasificador_datos['Marzo'];
        $totalAbril2 = $totalAbril2 + $resumen_clasificador_datos['Abril'];
        $totalMayo2 = $totalMayo2 + $resumen_clasificador_datos['Mayo'];
        $totalJunio2 = $totalJunio2 + $resumen_clasificador_datos['Junio'];
        $totalJulio2 = $totalJulio2 + $resumen_clasificador_datos['Julio'];
        $totalAgosto2 = $totalAgosto2 + $resumen_clasificador_datos['Agosto'];
        $totalSetiembre2 = $totalSetiembre2 + $resumen_clasificador_datos['Setiembre'];
        $totalOctubre2 = $totalOctubre2 + $resumen_clasificador_datos['Octubre'];
        $totalNoviembre2 = $totalNoviembre2 + $resumen_clasificador_datos['Noviembre'];
        $totalDiciembre2 = $totalDiciembre2 + $resumen_clasificador_datos['Diciembre'];
        $totalSuma2 = $totalSuma2 + $resumen_clasificador_datos['total'];



        $currencyMask = new Currency(
            '',
            2,
            Number::WITH_THOUSANDS_SEPARATOR,
            Currency::TRAILING_SYMBOL,
            Currency::SYMBOL_WITH_SPACING
        );

        $value = $resumen_clasificador_datos['Enero'];
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('C' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(2)->getStyle('C' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_clasificador_datos['Febrero'];
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('D' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(2)->getStyle('D' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_clasificador_datos['Marzo'];
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('E' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(2)->getStyle('E' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_clasificador_datos['Abril'];
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('F' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(2)->getStyle('F' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_clasificador_datos['Mayo'];
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('G' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(2)->getStyle('G' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_clasificador_datos['Junio'];
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('H' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(2)->getStyle('H' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_clasificador_datos['Julio'];
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('I' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(2)->getStyle('I' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_clasificador_datos['Agosto'];
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('J' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(2)->getStyle('J' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_clasificador_datos['Setiembre'];
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('K' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(2)->getStyle('K' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_clasificador_datos['Octubre'];
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('L' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(2)->getStyle('L' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_clasificador_datos['Noviembre'];
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('M' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(2)->getStyle('M' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_clasificador_datos['Diciembre'];
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('N' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(2)->getStyle('N' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $resumen_clasificador_datos['total'];
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('O' . $row2, $value);
        $spreadsheet->setActiveSheetIndex(2)->getStyle('O' . $row2)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);



        //set row style
        if ($row2 % 2 == 0) {
            //even row
            #$spreadsheet->setActiveSheetIndex(2)->getStyle('A' . $row2 . ':AH' . $row2)->applyFromArray($evenRow);
            $spreadsheet->setActiveSheetIndex(2)->getStyle('A' . $row2 . ':O' . $row2)->applyFromArray($styleArray);
            $spreadsheet->setActiveSheetIndex(2)->getStyle('A' . $row2)->getAlignment()->setHorizontal('center');
            $spreadsheet->setActiveSheetIndex(2)->getStyle('C' . $row2 . ':O' . $row2)->getAlignment()->setHorizontal('right');
        } else {
            //odd row
            #$spreadsheet->setActiveSheetIndex(2)->getStyle('A' . $row2 . ':AH' . $row2)->applyFromArray($oddRow);
            $spreadsheet->setActiveSheetIndex(2)->getStyle('A' . $row2 . ':O' . $row2)->applyFromArray($styleArray);
            $spreadsheet->setActiveSheetIndex(2)->getStyle('A' . $row2)->getAlignment()->setHorizontal('center');
            $spreadsheet->setActiveSheetIndex(2)->getStyle('C' . $row2 . ':O' . $row2)->getAlignment()->setHorizontal('right');
        }
        //increment row
        $row2++;


    }

    $spreadsheet->setActiveSheetIndex(2)
        ->setCellValue('A31', "Total General");

    $spreadsheet->setActiveSheetIndex(2)
        ->setCellValue('C31', $totalEnero2);

    $spreadsheet->setActiveSheetIndex(2)
        ->setCellValue('D31', $totalFebrero2);

    $spreadsheet->setActiveSheetIndex(2)
        ->setCellValue('E31', $totalMarzo2);

    $spreadsheet->setActiveSheetIndex(2)
        ->setCellValue('F31', $totalAbril2);

    $spreadsheet->setActiveSheetIndex(2)
        ->setCellValue('G31', $totalMayo2);

    $spreadsheet->setActiveSheetIndex(2)
        ->setCellValue('H31', $totalJunio2);

    $spreadsheet->setActiveSheetIndex(2)
        ->setCellValue('I31', $totalJulio2);

    $spreadsheet->setActiveSheetIndex(worksheetIndex: 1)
        ->setCellValue('J31', $totalAgosto2);

    $spreadsheet->setActiveSheetIndex(2)
        ->setCellValue('K31', $totalSetiembre2);

    $spreadsheet->setActiveSheetIndex(2)
        ->setCellValue('L31', $totalOctubre2);

    $spreadsheet->setActiveSheetIndex(2)
        ->setCellValue('M31', $totalNoviembre2);

    $spreadsheet->setActiveSheetIndex(2)
        ->setCellValue('N31', $totalDiciembre2);

    $spreadsheet->setActiveSheetIndex(2)
        ->setCellValue('O31', $totalSuma2);

    $value = $totalEnero2;
    $spreadsheet->setActiveSheetIndex(2)->setCellValue('C31', $value);
    $spreadsheet->setActiveSheetIndex(2)->getStyle('C31')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalFebrero2;
    $spreadsheet->setActiveSheetIndex(2)->setCellValue('D31', $value);
    $spreadsheet->setActiveSheetIndex(2)->getStyle('D31')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalMarzo2;
    $spreadsheet->setActiveSheetIndex(2)->setCellValue('E31', $value);
    $spreadsheet->setActiveSheetIndex(2)->getStyle('E31')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalAbril2;
    $spreadsheet->setActiveSheetIndex(2)->setCellValue('F31', $value);
    $spreadsheet->setActiveSheetIndex(2)->getStyle('F31')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalMayo2;
    $spreadsheet->setActiveSheetIndex(2)->setCellValue('G31', $value);
    $spreadsheet->setActiveSheetIndex(2)->getStyle('G31')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalJunio2;
    $spreadsheet->setActiveSheetIndex(2)->setCellValue('H31', $value);
    $spreadsheet->setActiveSheetIndex(2)->getStyle('H31')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalJulio2;
    $spreadsheet->setActiveSheetIndex(2)->setCellValue('I31', $value);
    $spreadsheet->setActiveSheetIndex(2)->getStyle('I31')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalAgosto2;
    $spreadsheet->setActiveSheetIndex(2)->setCellValue('J31', $value);
    $spreadsheet->setActiveSheetIndex(2)->getStyle('J31')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalSetiembre2;
    $spreadsheet->setActiveSheetIndex(2)->setCellValue('K31', $value);
    $spreadsheet->setActiveSheetIndex(2)->getStyle('K31')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalOctubre2;
    $spreadsheet->setActiveSheetIndex(2)->setCellValue('L31', $value);
    $spreadsheet->setActiveSheetIndex(2)->getStyle('L31')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalNoviembre2;
    $spreadsheet->setActiveSheetIndex(2)->setCellValue('M31', $value);
    $spreadsheet->setActiveSheetIndex(2)->getStyle('M31')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalDiciembre2;
    $spreadsheet->setActiveSheetIndex(2)->setCellValue('N31', $value);
    $spreadsheet->setActiveSheetIndex(2)->getStyle('N31')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $value = $totalSuma2;
    $spreadsheet->setActiveSheetIndex(2)->setCellValue('O31', $value);
    $spreadsheet->setActiveSheetIndex(2)->getStyle('O31')
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $spreadsheet->setActiveSheetIndex(2)->getStyle('A31:O31')->applyFromArray($styleArray);

    //autofilter
    //define first row and last row
    $firstRow = 4;
    $lastRow = $row2 - 1;
    //set the autofilter
    $spreadsheet->setActiveSheetIndex(2)->setAutoFilter("A" . $firstRow . ":O" . $lastRow); //Establecer filtros en las columnas
}








//set the header first, so the result will be treated as an xlsx file.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//make it an attachment so we can define filename
header('Content-Disposition: attachment;filename=' . $fileName . '');

//create IOFactory object
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//save into php output
$writer->save('php://output');



