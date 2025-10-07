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



$fileName = "REPORTE DE SALDO BANCARIO " . date('d-m-Y H:i:s') . ".xlsx";

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

$totalSaldo = [
    'font' => [
        'color' => [
            'rgb' => '000000'
        ],
        'bold' => false,
        'size' => 11
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => '3ead6a'
        ]
    ],
];

$banco_nacion = [
    'font' => [
        'color' => [
            'rgb' => 'ffffff'
        ],
        'bold' => true,
        'size' => 11
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'e82a2a'
        ]
    ],
];

$banco_comercio = [
    'font' => [
        'color' => [
            'rgb' => 'ffffff'
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

$banco_pichincha = [
    'font' => [
        'color' => [
            'rgb' => '000000'
        ],
        'bold' => true,
        'size' => 11
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'e3e644'
        ]
    ],
];

$banco_credito = [
    'font' => [
        'color' => [
            'rgb' => 'ffffff'
        ],
        'bold' => true,
        'size' => 11
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => '1342b7'
        ]
    ],
];

$fecha_relleno = [
    'font' => [
        'color' => [
            'rgb' => '000000'
        ],
        'bold' => false,
        'size' => 11
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'f4fa2b'
        ]
    ],
];

$cuentas_fondo = [
    'font' => [
        'color' => [
            'rgb' => '000000'
        ],
        'bold' => false,
        'size' => 11
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'ee8521'
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
$sheet->setTitle('REPORTE DE SALDO BANCARIO');



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
    ->setCellValue('B1', "REPORTE DE SALDO BANCARIO - OFICINA DE TESORERIA");

//merge heading
$spreadsheet->getActiveSheet()->mergeCells("B1:M1");

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


//header text
$spreadsheet->getActiveSheet()
    ->setCellValue('A2', "ID")
    ->setCellValue('B2', "BANCO")
    ->setCellValue('C2', "CUENTA")
    ->setCellValue('D2', "NOMBRE")
    ->setCellValue('E2', "TIPO DE CUENTA")
    ->setCellValue('F2', "SITUACION")
    ->setCellValue('G2', "FECHA SALDO")
    ->setCellValue('H2', "MONTO")
    ->setCellValue('I2', "ESTADO")
    ->setCellValue('J2', "OBSERVACION")
    ->setCellValue('K2', "FECHA REGISTRO")
    ->setCellValue('L2', "FECHA ACTUALIZACION")
    ->setCellValue('M2', "USUARIO");

//set font style and background color
$spreadsheet->getActiveSheet()->getStyle('A2:M2')->applyFromArray($tableHead); //estilo de fondo en la cabecera
$spreadsheet->getActiveSheet()->getStyle('A2:M2')->getAlignment()->setHorizontal('center'); //alineacion cental
$spreadsheet->getActiveSheet()->freezePane('A3'); //Congela la pantalla


$styleArray = [

    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],

];

$spreadsheet->getActiveSheet()->getStyle('A2:M2')->applyFromArray($styleArray);


#BASE DE DATOS
$contador = 0;
$monto_total = 0;
session_start();

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

if (isset($_SESSION['busqueda_nombre'])) {
    $nombre = $_SESSION['busqueda_nombre'];
} else {
    $nombre = "";
}

if (isset($_SESSION['busqueda_tipocuenta'])) {
    $tipo_cuenta = $_SESSION['busqueda_tipocuenta'];
} else {
    $tipo_cuenta = "";
}

if (isset($_SESSION['busqueda_situacion'])) {
    $situacion = $_SESSION['busqueda_situacion'];
} else {
    $situacion = "";
}

if (isset($_SESSION['busqueda_fecha'])) {
    $fecha = $_SESSION['busqueda_fecha'];
} else {
    $fecha = "";
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

$sql_saldo_bancario = "SELECT saldo_banco.id_saldo_banco as id_saldo_banco,
    saldo_banco.nombre_banco as nombre_banco,
    saldo_banco.numero_cuenta as numero_cuenta,
    saldo_banco.nombre_cuenta as nombre_cuenta,
    cuenta_saldo.id_cuenta_saldo as id_cuenta_saldo,
    cuenta_saldo.cuenta_saldo as cuenta_saldo,
    saldo_banco.fecha as fecha,
    saldo_banco.monto as monto_saldo,
    saldo_banco.detalle_cuenta as detalle_cuenta,
    saldo_banco.observacion as observacion,
    situacion_saldo.id_situacion_saldo as id_situacion_saldo,
    situacion_saldo.nombre_situacion as nombre_situacion,
    estado_saldo.id_estado_saldo as id_estado_saldo,
    estado_saldo.nombre_estado as nombre_estado,
    usuarios.id_usuario as id_usuario,
    usuarios.nombres as nombres,
    usuarios.apaterno as apaterno,
    usuarios.amaterno as amaterno,
    saldo_banco.fyh_creacion as fyh_creacion,
    saldo_banco.fyh_actualizacion as fyh_actualizacion
    FROM tb_saldo_banco as saldo_banco 
    LEFT JOIN tb_cuenta_saldo as cuenta_saldo ON cuenta_saldo.id_cuenta_saldo = saldo_banco.tipo_cuenta 
    LEFT JOIN tb_situacion_saldo as situacion_saldo ON situacion_saldo.id_situacion_saldo = saldo_banco.situacion 
    LEFT JOIN tb_estado_saldo as estado_saldo ON estado_saldo.id_estado_saldo = saldo_banco.estado 
    LEFT JOIN tb_usuarios as usuarios ON usuarios.id_usuario = saldo_banco.id_usuario
    WHERE saldo_banco.visible!=1 ";

if (isset($_SESSION['busqueda_boton_saldo_bancario'])) {

    /*
    if (
        !isset($banco) && !isset($cuenta) && !isset($nombre) && !isset($tipocuenta) && !isset($situacion) && !isset($fecha) && !isset($estado)
        && !isset($desde) && !isset($hasta)
    ) {
        $sql_saldo_bancario .= " ";
    } else {
        if (!empty($banco)) {
            $sql_saldo_bancario .= " AND saldo_banco.nombre_banco='" . $banco . "'";
        }

        if (!empty($cuenta)) {
            $sql_saldo_bancario .= " AND saldo_banco.numero_cuenta='" . $cuenta . "'";
        }

        if (!empty($nombre)) {
            $sql_saldo_bancario .= " AND saldo_banco.nombre_cuenta='" . $nombre . "'";
        }

        if (!empty($tipo_cuenta)) {
            $sql_saldo_bancario .= " AND saldo_banco.tipo_cuenta='" . $tipo_cuenta . "'";
        }

        if (!empty($situacion)) {
            $sql_saldo_bancario .= " AND saldo_banco.situacion='" . $situacion . "'";
        }

        if (!empty($fecha)) {
            $sql_saldo_bancario .= " AND saldo_banco.fecha='" . $fecha . "'";
        }

        if (!empty($estado)) {
            $sql_saldo_bancario .= " AND saldo_banco.estado='" . $estado . "'";
        }



        if (!empty($desde) && !empty($hasta)) {
            $sql_saldo_bancario .= " AND saldo_banco.fyh_creacion between '" . $desde . "' and '" . $hasta . "'";
        }
    }
    */

    if ($banco!="") {
        $sql_saldo_bancario .= " AND saldo_banco.nombre_banco='" . $banco . "'";
    }

    if ($banco!="" && $cuenta!="") {
        $sql_saldo_bancario .= " AND saldo_banco.numero_cuenta='" . $cuenta . "'";
    }

    if ($banco!="" && $cuenta!="" && $nombre!="") {
        $sql_saldo_bancario .= " AND saldo_banco.nombre_cuenta='" . $nombre . "'";
    }

    if ($tipo_cuenta!="") {
        $sql_saldo_bancario .= " AND cuenta_saldo.id_cuenta_saldo='" . $tipo_cuenta . "'";
    }

    if ($situacion!="") {
        $sql_saldo_bancario .= " AND situacion_saldo.id_situacion_saldo='" . $situacion . "'";
    }

    if ($fecha!="") {
        $sql_saldo_bancario .= " AND saldo_banco.fecha='" . $fecha . "'";
    }

    if ($estado!="") {
        $sql_saldo_bancario .= " AND estado_saldo.id_estado_saldo='" . $estado . "'";
    }

    if ($desde!="" && $hasta!="") {
        $sql_saldo_bancario .= " AND saldo_banco.fyh_creacion between '" . $desde . "' and '" . $hasta . "'";
    }


    $query_saldo_bancario = $pdo->prepare($sql_saldo_bancario);
    $query_saldo_bancario->execute();
    $saldo_bancario_datos = $query_saldo_bancario->fetchAll(PDO::FETCH_ASSOC);
}


if (!isset($saldo_bancario_datos)) {
    $saldo_bancario_datos = '';
} else {
    $row = 3;
    foreach ($saldo_bancario_datos as $saldo_bancario_dato) {


        if ($saldo_bancario_dato['cuenta_saldo'] == "SELECCIONAR") {
            $saldo_bancario_dato['cuenta_saldo'] = "";
        }

        if ($saldo_bancario_dato['nombre_situacion'] == "SELECCIONAR") {
            $saldo_bancario_dato['nombre_situacion'] = "";
        }

        if ($saldo_bancario_dato["numero_cuenta"] == "OTROS") {
            $saldo_bancario_dato["numero_cuenta"] = str_replace('OTROS', 'CUT', $saldo_bancario_dato["numero_cuenta"]);
        } else if ($saldo_bancario_dato["numero_cuenta"] == "0000-300152") {
            $saldo_bancario_dato["numero_cuenta"] = str_replace('0000-300152', 'CUT', $saldo_bancario_dato["numero_cuenta"]);
        }

        if (
            $saldo_bancario_dato["nombre_banco"] == "BANCO DE LA NACION" && $saldo_bancario_dato["numero_cuenta"] == "CUT"
            && $saldo_bancario_dato["nombre_cuenta"] == "CUENTA UNICA DE TESORO" && $saldo_bancario_dato["cuenta_saldo"] == "CTA. CUT"
        ) {
            $saldo_bancario_dato["cuenta_saldo"] = "CTA. CUT 300152";
        }

        $spreadsheet->getActiveSheet()
            ->setCellValue('A' . $row, $contador = $contador + 1, )
            ->setCellValue('B' . $row, $saldo_bancario_dato['nombre_banco'])
            ->setCellValue('C' . $row, $saldo_bancario_dato['numero_cuenta'])
            ->setCellValue('D' . $row, $saldo_bancario_dato['nombre_cuenta'])
            ->setCellValue('E' . $row, $saldo_bancario_dato['cuenta_saldo'])
            ->setCellValue('F' . $row, $saldo_bancario_dato['nombre_situacion'])
            ->setCellValue('G' . $row, $saldo_bancario_dato['fecha'])
            ->setCellValue('H' . $row, $saldo_bancario_dato['monto_saldo'])
            ->setCellValue('I' . $row, $saldo_bancario_dato['nombre_estado'])
            ->setCellValue('J' . $row, $saldo_bancario_dato['observacion'])
            ->setCellValue('K' . $row, $saldo_bancario_dato['fyh_creacion'])
            ->setCellValue('L' . $row, $saldo_bancario_dato['fyh_actualizacion'])
            ->setCellValue('M' . $row, $saldo_bancario_dato['nombres'] . " " . $saldo_bancario_dato['apaterno'] . " " . $saldo_bancario_dato['amaterno']);

        $monto_total = $monto_total + $saldo_bancario_dato['monto_saldo'];  //suma monto


        //Convierte en formato decimal
        $currencyMask = new Currency(
            '',
            2,
            Number::WITH_THOUSANDS_SEPARATOR,
            Currency::TRAILING_SYMBOL,
            Currency::SYMBOL_WITH_SPACING
        );

        $value = $saldo_bancario_dato['monto_saldo'];
        $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $value);
        $spreadsheet->getActiveSheet()->getStyle('H' . $row)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);


        //Convierte en formato fecha
        $value = $saldo_bancario_dato['fecha'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('G' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('G' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $saldo_bancario_dato['fyh_creacion'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('K' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('K' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY HH:mm:ss');

        $value = $saldo_bancario_dato['fyh_actualizacion'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('L' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('L' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY HH:mm:ss');




        //set row style
        if ($row % 2 == 0) {
            //even row
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':M' . $row)->applyFromArray($evenRow);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':M' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':M' . $row)->getAlignment()->setHorizontal('left');
        } else {
            //odd row
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':M' . $row)->applyFromArray($oddRow);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':M' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':M' . $row)->getAlignment()->setHorizontal('left');
        }
        //increment row
        $row++;


    }

    $currencyMask = new Currency(
        '',
        2,
        Number::WITH_THOUSANDS_SEPARATOR,
        Currency::TRAILING_SYMBOL,
        Currency::SYMBOL_WITH_SPACING
    );


    $value = $monto_total;
    $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $value);
    $spreadsheet->getActiveSheet()->getStyle('H' . $row)
        ->getNumberFormat()
        ->setFormatCode($currencyMask);

    $spreadsheet->getActiveSheet()->setCellValue('G' . $row, 'TOTAL');
    $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $monto_total);


    //autofilter
    //define first row and last row
    $firstRow = 2;
    $lastRow = $row - 1;
    //set the autofilter
    $spreadsheet->getActiveSheet()->setAutoFilter("A" . $firstRow . ":M" . $lastRow); //Establecer filtros en las columnas
}

/*
$sheet2 = $spreadsheet->createSheet();
$sheet2->setTitle('Resumen');
*/

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------
$total1 = 0;
$total2 = 0;
$total3 = 0;
$total4 = 0;
$total5 = 0;
$total6 = 0;
$total7 = 0;
$total8 = 0;
$total9 = 0;
$v1 = 0;
$v2 = 0;
$v3 = 0;
$v4 = 0;
$v5 = 0;
$v6 = 0;
$v7 = 0;
$v8 = 0;
$v9 = 0;

$sql_cta_ahorro_banco_nacion = "SELECT SUM(monto) as monto
from tb_saldo_banco 
WHERE tipo_cuenta=3 AND visible!=1 AND fecha='$fecha' AND nombre_banco='BANCO DE LA NACION'
GROUP BY nombre_banco
ORDER BY nombre_banco";
$query_cta_ahorro_banco_nacion = $pdo->prepare($sql_cta_ahorro_banco_nacion);
$query_cta_ahorro_banco_nacion->execute();
$total_cta_ahorro_banco_nacion = $query_cta_ahorro_banco_nacion->fetchAll(PDO::FETCH_ASSOC);

foreach ($total_cta_ahorro_banco_nacion as $cta_ahorro_banco_nacion) {
    $total1 = $cta_ahorro_banco_nacion["monto"];
    $v1 = $v1 + $cta_ahorro_banco_nacion["monto"];

}

if ($total1 == null) {
    $total1 = 0.00;
}



$sql_cta_ahorro_banco_credito = "SELECT SUM(monto) as monto
from tb_saldo_banco 
WHERE tipo_cuenta=3 AND visible!=1 AND fecha='$fecha' AND nombre_banco='BANCO DE CREDITO DEL PERU'
GROUP BY nombre_banco
ORDER BY nombre_banco";
$query_cta_ahorro_banco_credito = $pdo->prepare($sql_cta_ahorro_banco_credito);
$query_cta_ahorro_banco_credito->execute();
$total_cta_ahorro_banco_credito = $query_cta_ahorro_banco_credito->fetchAll(PDO::FETCH_ASSOC);

foreach ($total_cta_ahorro_banco_credito as $cta_ahorro_banco_credito) {
    $total2 = $cta_ahorro_banco_credito["monto"];
    $v2 = $v2 + $cta_ahorro_banco_credito["monto"];
}

if ($total2 == null) {
    $total2 = 0.00;
}


$sql_cta_cte_banco_nacion = "SELECT SUM(monto) as monto
from tb_saldo_banco 
WHERE tipo_cuenta=2 AND visible!=1 AND fecha='$fecha' AND nombre_banco='BANCO DE LA NACION'
GROUP BY nombre_banco 
ORDER BY nombre_banco";
$query_cta_cte_banco_nacion = $pdo->prepare($sql_cta_cte_banco_nacion);
$query_cta_cte_banco_nacion->execute();
$total_cta_cte_banco_nacion = $query_cta_cte_banco_nacion->fetchAll(PDO::FETCH_ASSOC);

foreach ($total_cta_cte_banco_nacion as $cta_cte_banco_nacion) {
    $total3 = $cta_cte_banco_nacion["monto"];
    $v3 = $v3 + $cta_cte_banco_nacion["monto"];

}

if ($total3 == null) {
    $total3 = 0.00;
}



$sql_cta_cte_banco_credito = "SELECT SUM(monto) as monto
from tb_saldo_banco 
WHERE tipo_cuenta=2 AND visible!=1 AND fecha='$fecha' AND nombre_banco='BANCO DE CREDITO DEL PERU'
GROUP BY nombre_banco 
ORDER BY nombre_banco";
$query_cta_cte_banco_credito = $pdo->prepare($sql_cta_cte_banco_credito);
$query_cta_cte_banco_credito->execute();
$total_cta_cte_banco_credito = $query_cta_cte_banco_credito->fetchAll(PDO::FETCH_ASSOC);

foreach ($total_cta_cte_banco_credito as $cta_cte_banco_credito) {
    $total4 = $cta_cte_banco_credito["monto"];
    $v4 = $v4 + $cta_cte_banco_credito["monto"];

}

if ($total4 == null) {
    $total4 = 0.00;
}



$sql_cta_cte_banco_comercio = "SELECT SUM(monto) as monto
from tb_saldo_banco 
WHERE tipo_cuenta=2 AND visible!=1 AND fecha='$fecha' AND nombre_banco='BANCO DE COMERCIO'
GROUP BY nombre_banco 
ORDER BY nombre_banco";
$query_cta_cte_banco_comercio = $pdo->prepare($sql_cta_cte_banco_comercio);
$query_cta_cte_banco_comercio->execute();
$total_cta_cte_banco_comercio = $query_cta_cte_banco_comercio->fetchAll(PDO::FETCH_ASSOC);

foreach ($total_cta_cte_banco_comercio as $cta_cte_banco_comercio) {
    $total5 = $cta_cte_banco_comercio["monto"];
    $v5 = $v5 + $cta_cte_banco_comercio["monto"];

}

if ($total5 == null) {
    $total5 = 0.00;
}



$sql_cta_cte_banco_pichincha = "SELECT SUM(monto) as monto
from tb_saldo_banco 
WHERE tipo_cuenta=2 AND visible!=1 AND fecha='$fecha' AND nombre_banco='BANCO PICHINCHA'
GROUP BY nombre_banco 
ORDER BY nombre_banco";
$query_cta_cte_banco_pichincha = $pdo->prepare($sql_cta_cte_banco_pichincha);
$query_cta_cte_banco_pichincha->execute();
$total_cta_cte_banco_pichincha = $query_cta_cte_banco_pichincha->fetchAll(PDO::FETCH_ASSOC);

foreach ($total_cta_cte_banco_pichincha as $cta_cte_banco_pichincha) {
    $total6 = $cta_cte_banco_pichincha["monto"];
    $v6 = $v6 + $cta_cte_banco_pichincha["monto"];

}

if ($total6 == null) {
    $total6 = 0.00;
}


$sql_cut_banco_nacion = "SELECT SUM(monto) as monto
from tb_saldo_banco 
WHERE tipo_cuenta=4 AND nombre_cuenta='CUENTA UNICA DE TESORO' AND visible!=1 AND fecha='$fecha' AND nombre_banco='BANCO DE LA NACION'
GROUP BY nombre_banco 
ORDER BY nombre_banco";
$query_cut_banco_nacion = $pdo->prepare($sql_cut_banco_nacion);
$query_cut_banco_nacion->execute();
$total_cut_banco_nacion = $query_cut_banco_nacion->fetchAll(PDO::FETCH_ASSOC);

foreach ($total_cut_banco_nacion as $cut_banco_nacion) {
    $total7 = $cut_banco_nacion["monto"];
    $v7 = $v7 + $cut_banco_nacion["monto"];

}

if ($total7 == null) {
    $total7 = 0.00;
}


$sql_dytrnsf_banco_nacion = "SELECT SUM(monto) as monto
from tb_saldo_banco 
WHERE nombre_cuenta LIKE '%DONACIONES Y TRANSFERENCIAS%' AND tipo_cuenta=4 AND visible!=1 AND fecha='$fecha' AND nombre_banco='BANCO DE LA NACION'
GROUP BY nombre_banco 
ORDER BY nombre_banco";
$query_dytrnsf_banco_nacion = $pdo->prepare($sql_dytrnsf_banco_nacion);
$query_dytrnsf_banco_nacion->execute();
$total_dytrnsf_banco_nacion = $query_dytrnsf_banco_nacion->fetchAll(PDO::FETCH_ASSOC);

foreach ($total_dytrnsf_banco_nacion as $dytrnsf_banco_nacion) {
    $total8 = $dytrnsf_banco_nacion["monto"];
    $v8 = $v8 + $dytrnsf_banco_nacion["monto"];

}

if ($total8 == null) {
    $total8 = 0.00;
}


$sql_canon_banco_nacion = "SELECT SUM(monto) as monto
from tb_saldo_banco 
WHERE nombre_cuenta='REGALIAS MINERAS (SUB-CTA. VIRTUAL) CANON Y SOBRECANON, REGALIAS, RENTA DE ADUANAS Y PARTICIPACIONES' AND visible!=1 AND fecha='$fecha' AND nombre_banco='BANCO DE LA NACION'
GROUP BY nombre_banco 
ORDER BY nombre_banco";
$query_canon_banco_nacion = $pdo->prepare($sql_canon_banco_nacion);
$query_canon_banco_nacion->execute();
$total_canon_banco_nacion = $query_canon_banco_nacion->fetchAll(PDO::FETCH_ASSOC);

foreach ($total_canon_banco_nacion as $canon_banco_nacion) {
    $total9 = $canon_banco_nacion["monto"];
    $v9 = $v9 + $canon_banco_nacion["monto"];

}

if ($total9 == null) {
    $total9 = 0.00;
}

$hoja2 = $spreadsheet->createSheet();

// Generale el nombre de hoja para que confirmes que tienes la hoja creada
$hoja2->setTitle('RESUMEN DE SALDO BANCARIO');

$theDate = new DateTime($fecha);
$fecha_a_consultar = $theDate->format('d-m-Y');

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('B1', "AL $fecha_a_consultar");

//CABECERA
$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('B2', "ENTIDADES FINANCIERAS");

$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('B')->setWidth(30);

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('C2', "CUENTA DE AHORRO");

$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('C')->setWidth(30);

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('D2', "CUENTA CORRIENTES");

$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('D')->setWidth(30);

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('E2', "CUT RDR");

$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('E')->setWidth(30);

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('F2', "DY TRNSF");

$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('F')->setWidth(30);

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('G2', "CANON");

$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('G')->setWidth(30);

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('H2', "TOTAL");

$spreadsheet->setActiveSheetIndex(1)->getColumnDimension('H')->setWidth(30);


//BANCO DE LA NACION
$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('B3', "BANCO DE LA NACION");



//BANCO DE CREDITO
$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('B4', "BANCO DE CREDITO DEL PERU");



//BANCO DE COMERCIO
$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('B5', "BANCO DE COMERCIO");



//BANCO PICHINCHA
$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('B6', "BANCO PICHINCHA");


//CUENTAS BANCO DE LA NACION
$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('C3', $total1);


$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('D3', $total3);


$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('E3', $total7);


$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('F3', $total8);


$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('G3', $total9);

$sh1 = $v1 + $v3 + $v7 + $v8 + $v9;

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('H3', $sh1);


//CUENTAS BANCO DE CREDITO
$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('C4', $total2);


$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('D4', $total4);


$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('E4', "0.00");


$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('F4', "0.00");


$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('G4', "0.00");

$sh2 = $v2 + $v4;

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('H4', $sh2);



//CUENTAS BANCO DE COMERCIO
$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('C5', "0.00");


$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('D5', $total5);


$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('E5', "0.00");


$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('F5', "0.00");


$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('G5', "0.00");

$sh3 = $v5;

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('H5', $sh3);


//CUENTAS BANCO PICHINCHA
$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('C6', "0.00");


$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('D6', $total6);


$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('E6', "0.00");


$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('F6', "0.00");


$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('G6', "0.00");

$sh4 = $v6;

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('H6', $sh4);


//TOTALES
$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('B7', "TOTALES");

$t1 = $v1 + $v2;

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('C7', $t1);

$t2 = $v3 + $v4 + $v5 + $v6;

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('D7', $t2);

$t3 = $v7;

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('E7', $t3);

$t4 = $v8;

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('F7', $t4);


$t5 = $v9;

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('G7', $t5);
$t6 = $t1 + $t2 + $t3 + $t4 + $t5;

$spreadsheet->setActiveSheetIndex(1)
    ->setCellValue('H7', $t6);

$spreadsheet->setActiveSheetIndex(1)->getStyle('B2:H2')->applyFromArray($styleArray);
$spreadsheet->setActiveSheetIndex(1)->getStyle('B3:H3')->applyFromArray($styleArray);
$spreadsheet->setActiveSheetIndex(1)->getStyle('B4:H4')->applyFromArray($styleArray);
$spreadsheet->setActiveSheetIndex(1)->getStyle('B5:H5')->applyFromArray($styleArray);
$spreadsheet->setActiveSheetIndex(1)->getStyle('B6:H6')->applyFromArray($styleArray);
$spreadsheet->setActiveSheetIndex(1)->getStyle('B7:H7')->applyFromArray($styleArray);

// set cell alignment
$spreadsheet->setActiveSheetIndex(1)->getStyle('B:H')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$spreadsheet->setActiveSheetIndex(1)->getStyle('B2:H2')->applyFromArray($tableHead); //estilo de fondo en la cabecera
$spreadsheet->setActiveSheetIndex(1)->getStyle('B7:H7')->applyFromArray($totalSaldo); //estilo de fondo en la cabecera
$spreadsheet->setActiveSheetIndex(1)->getStyle('H3')->applyFromArray($totalSaldo); //estilo de fondo en la cabecera
$spreadsheet->setActiveSheetIndex(1)->getStyle('H4')->applyFromArray($totalSaldo); //estilo de fondo en la cabecera
$spreadsheet->setActiveSheetIndex(1)->getStyle('H5')->applyFromArray($totalSaldo); //estilo de fondo en la cabecera
$spreadsheet->setActiveSheetIndex(1)->getStyle('H6')->applyFromArray($totalSaldo); //estilo de fondo en la cabecera
$spreadsheet->setActiveSheetIndex(1)->getStyle('H7')->applyFromArray($totalSaldo); //estilo de fondo en la cabecera

$value = $total1;
$spreadsheet->setActiveSheetIndex(1)->setCellValue('C3', $value);
$spreadsheet->setActiveSheetIndex(1)->getStyle('C3')
    ->getNumberFormat()
    ->setFormatCode($currencyMask);

$value = $total2;
$spreadsheet->setActiveSheetIndex(1)->setCellValue('C4', $value);
$spreadsheet->setActiveSheetIndex(1)->getStyle('C4')
    ->getNumberFormat()
    ->setFormatCode($currencyMask);

$value = $total3;
$spreadsheet->setActiveSheetIndex(1)->setCellValue('D3', $value);
$spreadsheet->setActiveSheetIndex(1)->getStyle('D3')
    ->getNumberFormat()
    ->setFormatCode($currencyMask);

$value = $total4;
$spreadsheet->setActiveSheetIndex(1)->setCellValue('D4', $value);
$spreadsheet->setActiveSheetIndex(1)->getStyle('D4')
    ->getNumberFormat()
    ->setFormatCode($currencyMask);

$value = $total5;
$spreadsheet->setActiveSheetIndex(1)->setCellValue('D5', $value);
$spreadsheet->setActiveSheetIndex(1)->getStyle('D5')
    ->getNumberFormat()
    ->setFormatCode($currencyMask);

$value = $total6;
$spreadsheet->setActiveSheetIndex(1)->setCellValue('D6', $value);
$spreadsheet->setActiveSheetIndex(1)->getStyle('D6')
    ->getNumberFormat()
    ->setFormatCode($currencyMask);

$value = $total7;
$spreadsheet->setActiveSheetIndex(1)->setCellValue('E3', $value);
$spreadsheet->setActiveSheetIndex(1)->getStyle('E3')
    ->getNumberFormat()
    ->setFormatCode($currencyMask);

$value = $total8;
$spreadsheet->setActiveSheetIndex(1)->setCellValue('F3', $value);
$spreadsheet->setActiveSheetIndex(1)->getStyle('F3')
    ->getNumberFormat()
    ->setFormatCode($currencyMask);

$value = $total9;
$spreadsheet->setActiveSheetIndex(1)->setCellValue('G3', $value);
$spreadsheet->setActiveSheetIndex(1)->getStyle('G3')
    ->getNumberFormat()
    ->setFormatCode($currencyMask);

$value = $t1;
$spreadsheet->setActiveSheetIndex(1)->setCellValue('C7', $value);
$spreadsheet->setActiveSheetIndex(1)->getStyle('C7')
    ->getNumberFormat()
    ->setFormatCode($currencyMask);

$value = $t2;
$spreadsheet->setActiveSheetIndex(1)->setCellValue('D7', $value);
$spreadsheet->setActiveSheetIndex(1)->getStyle('D7')
    ->getNumberFormat()
    ->setFormatCode($currencyMask);

$value = $t3;
$spreadsheet->setActiveSheetIndex(1)->setCellValue('E7', $value);
$spreadsheet->setActiveSheetIndex(1)->getStyle('E7')
    ->getNumberFormat()
    ->setFormatCode($currencyMask);

$value = $t4;
$spreadsheet->setActiveSheetIndex(1)->setCellValue('F7', $value);
$spreadsheet->setActiveSheetIndex(1)->getStyle('F7')
    ->getNumberFormat()
    ->setFormatCode($currencyMask);

$value = $t5;
$spreadsheet->setActiveSheetIndex(1)->setCellValue('G7', $value);
$spreadsheet->setActiveSheetIndex(1)->getStyle('G7')
    ->getNumberFormat()
    ->setFormatCode($currencyMask);

$value = $t6;
$spreadsheet->setActiveSheetIndex(1)->setCellValue('H7', $value);
$spreadsheet->setActiveSheetIndex(1)->getStyle('H7')
    ->getNumberFormat()
    ->setFormatCode($currencyMask);

$value = $sh1;
$spreadsheet->setActiveSheetIndex(1)->setCellValue('H3', $value);
$spreadsheet->setActiveSheetIndex(1)->getStyle('H3')
    ->getNumberFormat()
    ->setFormatCode($currencyMask);

$value = $sh2;
$spreadsheet->setActiveSheetIndex(1)->setCellValue('H4', $value);
$spreadsheet->setActiveSheetIndex(1)->getStyle('H4')
    ->getNumberFormat()
    ->setFormatCode($currencyMask);

$value = $sh3;
$spreadsheet->setActiveSheetIndex(1)->setCellValue('H5', $value);
$spreadsheet->setActiveSheetIndex(1)->getStyle('H5')
    ->getNumberFormat()
    ->setFormatCode($currencyMask);

$value = $sh4;
$spreadsheet->setActiveSheetIndex(1)->setCellValue('H6', $value);
$spreadsheet->setActiveSheetIndex(1)->getStyle('H6')
    ->getNumberFormat()
    ->setFormatCode($currencyMask);


//--------------------------------------------------------------------------------------------------------------------------------



$hoja3 = $spreadsheet->createSheet();

// Generale el nombre de hoja para que confirmes que tienes la hoja creada
$hoja3->setTitle('DIFERENCIA DIARIA');



$spreadsheet->setActiveSheetIndex(2)
    ->setCellValue('B1', "BANCO DE LA NACION");
$spreadsheet->setActiveSheetIndex(2)->getStyle('B1:D1')->applyFromArray($banco_nacion); //estilo de fondo en la cabecera
$spreadsheet->setActiveSheetIndex(2)->mergeCells("B1:D1");

$spreadsheet->setActiveSheetIndex(2)
    ->setCellValue('E1', "BANCO DE COMERCIO");
$spreadsheet->setActiveSheetIndex(2)->getStyle('E1:J1')->applyFromArray($banco_comercio); //estilo de fondo en la cabecera
$spreadsheet->setActiveSheetIndex(2)->mergeCells("E1:J1");

$spreadsheet->setActiveSheetIndex(2)
    ->setCellValue('K1', "BANCO PICHINCHA");
$spreadsheet->setActiveSheetIndex(2)->getStyle('K1')->applyFromArray($banco_pichincha); //estilo de fondo en la cabecera
$spreadsheet->setActiveSheetIndex(2)->mergeCells("K1");

$spreadsheet->setActiveSheetIndex(2)
    ->setCellValue('L1', "BANCO DE CREDITO DEL PERU");
$spreadsheet->setActiveSheetIndex(2)->getStyle('L1:P1')->applyFromArray($banco_credito); //estilo de fondo en la cabecera
$spreadsheet->setActiveSheetIndex(2)->mergeCells("L1:P1");

// set cell alignment
$spreadsheet->setActiveSheetIndex(2)->getStyle('A:Q')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$nombre_mes = "";

$theDate = new DateTime($fecha);
$mes = $theDate->format('m');

$theDate = new DateTime($fecha);
$anio = $theDate->format('Y');

switch ($mes) {
    case '01':
        $nombre_mes = "ENERO";
        break;
    case '02':
        $nombre_mes = "FEBRERO";
        break;
    case '03':
        $nombre_mes = "MARZO";
        break;
    case '04':
        $nombre_mes = "ABRIL";
        break;
    case '05':
        $nombre_mes = "MAYO";
        break;
    case '06':
        $nombre_mes = "JUNIO";
        break;
    case '07':
        $nombre_mes = "JULIO";
        break;
    case '08':
        $nombre_mes = "AGOSTO";
        break;
    case '09':
        $nombre_mes = "SETIEMBRE";
        break;
    case '10':
        $nombre_mes = "OCUTBRE";
        break;
    case '11':
        $nombre_mes = "NOVIEMBRE";
        break;
    case '12':
        $nombre_mes = "DICIEMBRE";
        break;
}

$spreadsheet->setActiveSheetIndex(2)
    ->setCellValue('A2', "FECHA SALDO($nombre_mes)");

$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('A')->setWidth(30);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('B')->setWidth(30);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('C')->setWidth(30);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('D')->setWidth(30);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('E')->setWidth(30);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('F')->setWidth(30);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('G')->setWidth(30);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('H')->setWidth(30);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('I')->setWidth(30);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('J')->setWidth(30);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('K')->setWidth(30);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('L')->setWidth(30);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('M')->setWidth(30);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('N')->setWidth(30);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('O')->setWidth(30);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('P')->setWidth(30);
$spreadsheet->setActiveSheetIndex(2)->getColumnDimension('Q')->setWidth(30);

$number = cal_days_in_month(CAL_GREGORIAN, $mes, $anio); // devuelve el numero de dias de un mes

$spreadsheet->setActiveSheetIndex(2)->getStyle('A2:Q2')->applyFromArray($cuentas_fondo); //estilo de fondo en la cabecera
$spreadsheet->setActiveSheetIndex(2)->getStyle('A2:Q2')->getAlignment()->setWrapText(true); //ajuste de texto
$spreadsheet->setActiveSheetIndex(2)->getStyle('A2:Q2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); //alineacion

$spreadsheet->setActiveSheetIndex(2)->setCellValue('B2', "CTA CTE 0000-257443 R.D.R. (RECAUDACION CAJAS PERIFERICAS) CEPREVI");
$spreadsheet->setActiveSheetIndex(2)->setCellValue('C2', "CTA CTE 0000-277207 R.D.R. (PROLICED)");
$spreadsheet->setActiveSheetIndex(2)->setCellValue('D2', "CTA AHORROS 4091114068 R.D.R. (PROCUNED)");
$spreadsheet->setActiveSheetIndex(2)->setCellValue('E2', "CTA CTE 110-01-0414438 R.D.R. (POSTGRADO) ADMISION EUPG");
$spreadsheet->setActiveSheetIndex(2)->setCellValue('F2', "CTA CTE 110-01-0416304 R.D.R. (RECAUDAC. CAJAS PERIFERICAS) Y SEGUNDA ESPECIALIDAD");
$spreadsheet->setActiveSheetIndex(2)->setCellValue('G2', "CTA CTE 110-01-0418432 R.D.R. (CEPREVI)");
$spreadsheet->setActiveSheetIndex(2)->setCellValue('H2', "CTA CTE 110-01-0444317 R.D.R. (ADMISION PRE)");
$spreadsheet->setActiveSheetIndex(2)->setCellValue('I2', "CTA CTE 110-01-0450881 R.D.R. (INSTITUTO DE IDIOMAS)");
$spreadsheet->setActiveSheetIndex(2)->setCellValue('J2', "CTA CTE 110-01-0451398 R.D.R. (MATRICULA) CUDED-PRE GRADO");
#$spreadsheet->setActiveSheetIndex(2)->setCellValue('K2', "CTA CTE 290015057 R.D.R. (RECAUDACION CAJAS PERIFERICAS)");
#$spreadsheet->setActiveSheetIndex(2)->setCellValue('L2', "L.FINBANCO 290015472 R.D.R. (RECAUDACION CAJAS PERIFERICAS)");
#$spreadsheet->setActiveSheetIndex(2)->setCellValue('M2', "CTA CTE 000368430790");
$spreadsheet->setActiveSheetIndex(2)->setCellValue('K2', "CTA CTE REMUNERADA 292100353 FACULTAD PSICOLOGIA");
#$spreadsheet->setActiveSheetIndex(2)->setCellValue('O2', "CTA CTE 293421714 R.D.R. (CENTRO DE PRODUCCION)");
#$spreadsheet->setActiveSheetIndex(2)->setCellValue('P2', "L.FINBANCO 293421692 R.D.R. (CENTRO DE PRODUCCION)");
$spreadsheet->setActiveSheetIndex(2)->setCellValue('L2', "CTA CTE 193-1161080-0-80 RESIDENTADO MEDICO");
$spreadsheet->setActiveSheetIndex(2)->setCellValue('M2', "CTA CTE 193-1179669-0-46 POST GRADO");
$spreadsheet->setActiveSheetIndex(2)->setCellValue('N2', "CTA CTE 191-9398126-0-63 UNFV-ADMISION");
$spreadsheet->setActiveSheetIndex(2)->setCellValue('O2', "CTA CTE 191-9398127-0-73 UNFV-MATRICULA Y PENSIONES");
#spreadsheet->setActiveSheetIndex(2)->setCellValue('U2', "L.AHORROS 191-045-30292-0-51 (TEC. MEDICA) * 6-6-2024-CERRO 2789.5");
#$spreadsheet->setActiveSheetIndex(2)->setCellValue('V2', "L.AHORROS 193-11200504-0-40 (PROCUNED) * 6-6-2024-CERRO 1632.95");
$spreadsheet->setActiveSheetIndex(2)->setCellValue('P2', "L.AHORROS 193-10853146-0-72 (EDUCACION A DISTANCIA ANTES) AHORA CCFV");
$spreadsheet->setActiveSheetIndex(2)->setCellValue('Q2', "TOTAL");


$spreadsheet->setActiveSheetIndex(2)->getStyle('A1:Q1')->applyFromArray($styleArray);
$spreadsheet->setActiveSheetIndex(2)->getStyle('A2:Q2')->applyFromArray($styleArray);
$spreadsheet->setActiveSheetIndex(2)->freezePane('B3'); //Congela la pantalla

$fila = 3;
$fecha_actual = "";
$fecha_anterior = "";

$fecha_dia = "";
$fecha_mes = "";
$fecha_anio = "";



//bucle para imprimir la fecha del mes y las diferencias por cuentas
for ($i = 1; $i <= $number; $i++) {
    $spreadsheet->setActiveSheetIndex(2)->getStyle('A' . $fila)->applyFromArray($fecha_relleno); //estilo de fondo en la cabecera
    $spreadsheet->setActiveSheetIndex(2)->getStyle('A' . $fila . ':Q' . $fila)->applyFromArray($styleArray);

    //-----------------------------------------------------------------------------------------------------

    $fecha_dia = strval($i); //convierte un entero a cadena 
    $fecha_mes = strval($mes);
    $fecha_anio = strval($anio);

    //reemplaza el numero de dia del 1 al 31
    switch ($fecha_dia) {
        case "1":
            $fecha_dia = "01";
            break;
        case "2":
            $fecha_dia = "02";
            break;
        case "3":
            $fecha_dia = "03";
            break;
        case "4":
            $fecha_dia = "04";
            break;
        case "5":
            $fecha_dia = "05";
            break;
        case "6":
            $fecha_dia = "06";
            break;
        case "7":
            $fecha_dia = "07";
            break;
        case "8":
            $fecha_dia = "08";
            break;
        case "9":
            $fecha_dia = "09";
            break;
        case "10":
            $fecha_dia = "10";
            break;
        case "11":
            $fecha_dia = "11";
            break;
        case "12":
            $fecha_dia = "12";
            break;
        case "13":
            $fecha_dia = "13";
            break;
        case "14":
            $fecha_dia = "14";
            break;
        case "15":
            $fecha_dia = "15";
            break;
        case "16":
            $fecha_dia = "16";
            break;
        case "17":
            $fecha_dia = "17";
            break;
        case "18":
            $fecha_dia = "18";
            break;
        case "19":
            $fecha_dia = "19";
            break;
        case "20":
            $fecha_dia = "20";
            break;
        case "21":
            $fecha_dia = "21";
            break;
        case "22":
            $fecha_dia = "22";
            break;
        case "23":
            $fecha_dia = "23";
            break;
        case "24":
            $fecha_dia = "24";
            break;
        case "25":
            $fecha_dia = "25";
            break;
        case "26":
            $fecha_dia = "26";
            break;
        case "27":
            $fecha_dia = "27";
            break;
        case "28":
            $fecha_dia = "28";
            break;
        case "29":
            $fecha_dia = "29";
            break;
        case "30":
            $fecha_dia = "30";
            break;
        case "31":
            $fecha_dia = "31";
            break;
    }

    //reemplaza el numero de dia del 1 al 12
    switch ($fecha_mes) {
        case "01":
            $fecha_mes = "01";
            break;
        case "02":
            $fecha_mes = "02";
            break;
        case "03":
            $fecha_mes = "03";
            break;
        case "04":
            $fecha_mes = "04";
            break;
        case "05":
            $fecha_mes = "05";
            break;
        case "06":
            $fecha_mes = "06";
            break;
        case "07":
            $fecha_mes = "07";
            break;
        case "08":
            $fecha_mes = "08";
            break;
        case "09":
            $fecha_mes = "09";
            break;
        case "10":
            $fecha_mes = "10";
            break;
        case "11":
            $fecha_mes = "11";
            break;
        case "12":
            $fecha_mes = "12";
            break;
    }

    $fecha_actual = $fecha_dia . '-' . $fecha_mes . '-' . $fecha_anio;
    $theDate = new DateTime($fecha_actual);
    $fecha_actual = $theDate->format('Y-m-d');

    //si el dia 1 y el mes 1 que calcule la fecha del ultimo dia del año anterior
    if ($fecha_dia == 01 && $mes == 01) {

        $number_last_days = cal_days_in_month(CAL_GREGORIAN, 12, ($anio - 1)); // devuelve el numero de dias del ultimo mes del año

        $fecha_anterior = $number_last_days . '-' . 12 . '-' . ($anio - 1);
        $theDate = new DateTime($fecha_anterior);
        $fecha_anterior = $theDate->format('Y-m-d');
    }

    //si el dia es 1 y el mes es mayor e igual a 2 y menor e igual a 12
    if ($fecha_dia == 01 && ($mes >= 02 && $mes <= 12)) {

        $number_last_days = cal_days_in_month(CAL_GREGORIAN, $mes, $anio); // devuelve el numero de dias del mes

        $fecha_anterior = $number_last_days . '-' . ($mes - 1) . '-' . $fecha_anio;
        $theDate = new DateTime($fecha_anterior);
        $fecha_anterior = $theDate->format('Y-m-d');
    }

    if ($fecha_dia >= 02) {
        $fecha_anterior = ($fecha_dia - 1) . '-' . $fecha_mes . '-' . $fecha_anio;
        $theDate = new DateTime($fecha_anterior);
        $fecha_anterior = $theDate->format('Y-m-d');
    }




    $spreadsheet->setActiveSheetIndex(2)->setCellValue('A' . $fila, $fecha_actual); //imprime la fecha


    //-----------------------------------------------------------------------------------------------------
    //CALCULO DIFERENCIA DE SALDO COLUMNA B

    $monto_bn_actual_b = 0;
    $monto_bn_anterior_b = 0;
    $diferencia_b = 0;

    //CONSULTA MONTO BN FECHA ACTUAL
    $sql_diferencia_bn_b = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_actual' 
    AND nombre_banco='BANCO DE LA NACION' AND numero_cuenta='0000-257443' AND nombre_cuenta='R.D.R. (RECAUDACION CAJAS PERIFERICAS) CEPREVI'";
    $query_diferencia_bn_b = $pdo->prepare($sql_diferencia_bn_b);
    $query_diferencia_bn_b->execute();
    $diferencia_bn_datos_b = $query_diferencia_bn_b->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_b as $diferencia_bn_dato_b) {
        if ($diferencia_bn_dato_b["fecha"] == $fecha_actual) {
            $monto_bn_actual_b = $diferencia_bn_dato_b["monto"];
        } else {
            $monto_bn_actual_b = 0;
        }

    }

    //CONSULTA MONTO BN FECHA ANTERIOR
    $sql_diferencia_bn_b = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_anterior' 
    AND nombre_banco='BANCO DE LA NACION' AND numero_cuenta='0000-257443' AND nombre_cuenta='R.D.R. (RECAUDACION CAJAS PERIFERICAS) CEPREVI'";
    $query_diferencia_bn_b = $pdo->prepare($sql_diferencia_bn_b);
    $query_diferencia_bn_b->execute();
    $diferencia_bn_datos_b = $query_diferencia_bn_b->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_b as $diferencia_bn_dato_b) {
        if ($diferencia_bn_dato_b["fecha"] == $fecha_anterior) {
            $monto_bn_anterior_b = $diferencia_bn_dato_b["monto"];
        } else {
            $monto_bn_anterior_b = 0;
        }

    }

    //si monto actual es diferente de 0
    if ($monto_bn_actual_b != 0 && $monto_bn_anterior_b != 0) {
        $diferencia_b = $monto_bn_actual_b - $monto_bn_anterior_b;
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('B' . $fila, $diferencia_b);

        $value = $diferencia_b;
        $spreadsheet->getActiveSheet()->setCellValue('B' . $fila, $value);
        $spreadsheet->getActiveSheet()->getStyle('B' . $fila)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);
    }

    //-----------------------------------------------------------------------------------------------------
    //CALCULO DIFERENCIA DE SALDO COLUMNA C

    $monto_bn_actual_c = 0;
    $monto_bn_anterior_c = 0;
    $diferencia_c = 0;

    //CONSULTA MONTO BN FECHA ACTUAL
    $sql_diferencia_bn_c = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_actual' 
    AND nombre_banco='BANCO DE LA NACION' AND numero_cuenta='0000-277207' AND nombre_cuenta='R.D.R. (PROLICED)'";
    $query_diferencia_bn_c = $pdo->prepare($sql_diferencia_bn_c);
    $query_diferencia_bn_c->execute();
    $diferencia_bn_datos_c = $query_diferencia_bn_c->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_c as $diferencia_bn_dato_c) {
        if ($diferencia_bn_dato_c["fecha"] == $fecha_actual) {
            $monto_bn_actual_c = $diferencia_bn_dato_c["monto"];
        } else {
            $monto_bn_actual_c = 0;
        }

    }

    //CONSULTA MONTO BN FECHA ANTERIOR
    $sql_diferencia_bn_c = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_anterior' 
    AND nombre_banco='BANCO DE LA NACION' AND numero_cuenta='0000-277207' AND nombre_cuenta='R.D.R. (PROLICED)'";
    $query_diferencia_bn_c = $pdo->prepare($sql_diferencia_bn_c);
    $query_diferencia_bn_c->execute();
    $diferencia_bn_datos_c = $query_diferencia_bn_c->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_c as $diferencia_bn_dato_c) {
        if ($diferencia_bn_dato_c["fecha"] == $fecha_anterior) {
            $monto_bn_anterior_c = $diferencia_bn_dato_c["monto"];
        } else {
            $monto_bn_anterior_c = 0;
        }

    }

    //si monto actual es diferente de 0
    if ($monto_bn_actual_c != 0 && $monto_bn_anterior_c != 0) {
        $diferencia_c = $monto_bn_actual_c - $monto_bn_anterior_c;
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('C' . $fila, $diferencia_c);

        $value = $diferencia_c;
        $spreadsheet->getActiveSheet()->setCellValue('C' . $fila, $value);
        $spreadsheet->getActiveSheet()->getStyle('C' . $fila)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);
    }


    //-----------------------------------------------------------------------------------------------------
    //CALCULO DIFERENCIA DE SALDO COLUMNA D

    $monto_bn_actual_d = 0;
    $monto_bn_anterior_d = 0;
    $diferencia_d = 0;

    //CONSULTA MONTO BN FECHA ACTUAL
    $sql_diferencia_bn_d = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_actual' 
    AND nombre_banco='BANCO DE LA NACION' AND numero_cuenta='4091114068' AND nombre_cuenta='R.D.R. (PROCUNED)'";
    $query_diferencia_bn_d = $pdo->prepare($sql_diferencia_bn_d);
    $query_diferencia_bn_d->execute();
    $diferencia_bn_datos_d = $query_diferencia_bn_d->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_d as $diferencia_bn_dato_d) {
        if ($diferencia_bn_dato_d["fecha"] == $fecha_actual) {
            $monto_bn_actual_d = $diferencia_bn_dato_d["monto"];
        } else {
            $monto_bn_actual_d = 0;
        }

    }

    //CONSULTA MONTO BN FECHA ANTERIOR
    $sql_diferencia_bn_d = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_anterior' 
    AND nombre_banco='BANCO DE LA NACION' AND numero_cuenta='4091114068' AND nombre_cuenta='R.D.R. (PROCUNED)'";
    $query_diferencia_bn_d = $pdo->prepare($sql_diferencia_bn_d);
    $query_diferencia_bn_d->execute();
    $diferencia_bn_datos_d = $query_diferencia_bn_d->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_d as $diferencia_bn_dato_d) {
        if ($diferencia_bn_dato_d["fecha"] == $fecha_anterior) {
            $monto_bn_anterior_d = $diferencia_bn_dato_d["monto"];
        } else {
            $monto_bn_anterior_d = 0;
        }

    }

    //si monto actual es diferente de 0
    if ($monto_bn_actual_d != 0 && $monto_bn_anterior_d != 0) {
        $diferencia_d = $monto_bn_actual_d - $monto_bn_anterior_d;
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('D' . $fila, $diferencia_d);

        $value = $diferencia_d;
        $spreadsheet->getActiveSheet()->setCellValue('D' . $fila, $value);
        $spreadsheet->getActiveSheet()->getStyle('D' . $fila)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);
    }

    //-----------------------------------------------------------------------------------------------------
    //CALCULO DIFERENCIA DE SALDO COLUMNA E

    $monto_bn_actual_e = 0;
    $monto_bn_anterior_e = 0;
    $diferencia_e = 0;

    //CONSULTA MONTO BN FECHA ACTUAL
    $sql_diferencia_bn_e = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_actual' 
    AND nombre_banco='BANCO DE COMERCIO' AND numero_cuenta='110-01-0414438' AND nombre_cuenta='R.D.R. (POSTGRADO) ADMISION EUPG'";
    $query_diferencia_bn_e = $pdo->prepare($sql_diferencia_bn_e);
    $query_diferencia_bn_e->execute();
    $diferencia_bn_datos_e = $query_diferencia_bn_e->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_e as $diferencia_bn_dato_e) {
        if ($diferencia_bn_dato_e["fecha"] == $fecha_actual) {
            $monto_bn_actual_e = $diferencia_bn_dato_e["monto"];
        } else {
            $monto_bn_actual_e = 0;
        }

    }

    //CONSULTA MONTO BN FECHA ANTERIOR
    $sql_diferencia_bn_e = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_anterior' 
    AND nombre_banco='BANCO DE COMERCIO' AND numero_cuenta='110-01-0414438' AND nombre_cuenta='R.D.R. (POSTGRADO) ADMISION EUPG'";
    $query_diferencia_bn_e = $pdo->prepare($sql_diferencia_bn_e);
    $query_diferencia_bn_e->execute();
    $diferencia_bn_datos_e = $query_diferencia_bn_e->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_e as $diferencia_bn_dato_e) {
        if ($diferencia_bn_dato_e["fecha"] == $fecha_anterior) {
            $monto_bn_anterior_e = $diferencia_bn_dato_e["monto"];
        } else {
            $monto_bn_anterior_e = 0;
        }

    }

    //si monto actual es diferente de 0
    if ($monto_bn_actual_e != 0 && $monto_bn_anterior_e != 0) {
        $diferencia_e = $monto_bn_actual_e - $monto_bn_anterior_e;
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('E' . $fila, $diferencia_e);

        $value = $diferencia_e;
        $spreadsheet->getActiveSheet()->setCellValue('E' . $fila, $value);
        $spreadsheet->getActiveSheet()->getStyle('E' . $fila)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);
    }

    //-----------------------------------------------------------------------------------------------------
    //CALCULO DIFERENCIA DE SALDO COLUMNA F

    $monto_bn_actual_f = 0;
    $monto_bn_anterior_f = 0;
    $diferencia_f = 0;

    //CONSULTA MONTO BN FECHA ACTUAL
    $sql_diferencia_bn_f = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_actual' 
    AND nombre_banco='BANCO DE COMERCIO' AND numero_cuenta='110-01-0416304' AND nombre_cuenta='R.D.R. (RECAUDAC. CAJAS PERIFERICAS) Y SEGUNDA ESPECIALIDAD'";
    $query_diferencia_bn_f = $pdo->prepare($sql_diferencia_bn_f);
    $query_diferencia_bn_f->execute();
    $diferencia_bn_datos_f = $query_diferencia_bn_f->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_f as $diferencia_bn_dato_f) {
        if ($diferencia_bn_dato_f["fecha"] == $fecha_actual) {
            $monto_bn_actual_f = $diferencia_bn_dato_f["monto"];
        } else {
            $monto_bn_actual_f = 0;
        }

    }

    //CONSULTA MONTO BN FECHA ANTERIOR
    $sql_diferencia_bn_f = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_anterior' 
    AND nombre_banco='BANCO DE COMERCIO' AND numero_cuenta='110-01-0416304' AND nombre_cuenta='R.D.R. (RECAUDAC. CAJAS PERIFERICAS) Y SEGUNDA ESPECIALIDAD'";
    $query_diferencia_bn_f = $pdo->prepare($sql_diferencia_bn_f);
    $query_diferencia_bn_f->execute();
    $diferencia_bn_datos_f = $query_diferencia_bn_f->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_f as $diferencia_bn_dato_f) {
        if ($diferencia_bn_dato_f["fecha"] == $fecha_anterior) {
            $monto_bn_anterior_f = $diferencia_bn_dato_f["monto"];
        } else {
            $monto_bn_anterior_f = 0;
        }

    }

    //si monto actual es diferente de 0
    if ($monto_bn_actual_f != 0 && $monto_bn_anterior_f != 0) {
        $diferencia_f = $monto_bn_actual_f - $monto_bn_anterior_f;
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('F' . $fila, $diferencia_f);

        $value = $diferencia_f;
        $spreadsheet->getActiveSheet()->setCellValue('F' . $fila, $value);
        $spreadsheet->getActiveSheet()->getStyle('F' . $fila)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);
    }

    //-----------------------------------------------------------------------------------------------------
    //CALCULO DIFERENCIA DE SALDO COLUMNA G

    $monto_bn_actual_g = 0;
    $monto_bn_anterior_g = 0;
    $diferencia_g = 0;

    //CONSULTA MONTO BN FECHA ACTUAL
    $sql_diferencia_bn_g = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_actual' 
    AND nombre_banco='BANCO DE COMERCIO' AND numero_cuenta='110-01-0418432' AND nombre_cuenta='R.D.R. (CEPREVI)'";
    $query_diferencia_bn_g = $pdo->prepare($sql_diferencia_bn_g);
    $query_diferencia_bn_g->execute();
    $diferencia_bn_datos_g = $query_diferencia_bn_g->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_g as $diferencia_bn_dato_g) {
        if ($diferencia_bn_dato_g["fecha"] == $fecha_actual) {
            $monto_bn_actual_g = $diferencia_bn_dato_g["monto"];
        } else {
            $monto_bn_actual_g = 0;
        }

    }

    //CONSULTA MONTO BN FECHA ANTERIOR
    $sql_diferencia_bn_g = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_anterior' 
    AND nombre_banco='BANCO DE COMERCIO' AND numero_cuenta='110-01-0418432' AND nombre_cuenta='R.D.R. (CEPREVI)'";
    $query_diferencia_bn_g = $pdo->prepare($sql_diferencia_bn_g);
    $query_diferencia_bn_g->execute();
    $diferencia_bn_datos_g = $query_diferencia_bn_g->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_g as $diferencia_bn_dato_g) {
        if ($diferencia_bn_dato_g["fecha"] == $fecha_anterior) {
            $monto_bn_anterior_g = $diferencia_bn_dato_g["monto"];
        } else {
            $monto_bn_anterior_g = 0;
        }

    }

    //si monto actual es diferente de 0
    if ($monto_bn_actual_g != 0 && $monto_bn_anterior_g != 0) {
        $diferencia_g = $monto_bn_actual_g - $monto_bn_anterior_g;
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('G' . $fila, $diferencia_g);

        $value = $diferencia_g;
        $spreadsheet->getActiveSheet()->setCellValue('G' . $fila, $value);
        $spreadsheet->getActiveSheet()->getStyle('G' . $fila)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);
    }

    //-----------------------------------------------------------------------------------------------------
    //CALCULO DIFERENCIA DE SALDO COLUMNA H

    $monto_bn_actual_h = 0;
    $monto_bn_anterior_h = 0;
    $diferencia_h = 0;

    //CONSULTA MONTO BN FECHA ACTUAL
    $sql_diferencia_bn_h = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_actual' 
    AND nombre_banco='BANCO DE COMERCIO' AND numero_cuenta='110-01-0444317' AND nombre_cuenta='R.D.R. (ADMISION PRE)'";
    $query_diferencia_bn_h = $pdo->prepare($sql_diferencia_bn_h);
    $query_diferencia_bn_h->execute();
    $diferencia_bn_datos_h = $query_diferencia_bn_h->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_h as $diferencia_bn_dato_h) {
        if ($diferencia_bn_dato_h["fecha"] == $fecha_actual) {
            $monto_bn_actual_h = $diferencia_bn_dato_h["monto"];
        } else {
            $monto_bn_actual_h = 0;
        }

    }

    //CONSULTA MONTO BN FECHA ANTERIOR
    $sql_diferencia_bn_h = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_anterior' 
    AND nombre_banco='BANCO DE COMERCIO' AND numero_cuenta='110-01-0444317' AND nombre_cuenta='R.D.R. (ADMISION PRE)'";
    $query_diferencia_bn_h = $pdo->prepare($sql_diferencia_bn_h);
    $query_diferencia_bn_h->execute();
    $diferencia_bn_datos_h = $query_diferencia_bn_h->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_h as $diferencia_bn_dato_h) {
        if ($diferencia_bn_dato_h["fecha"] == $fecha_anterior) {
            $monto_bn_anterior_h = $diferencia_bn_dato_h["monto"];
        } else {
            $monto_bn_anterior_h = 0;
        }

    }

    //si monto actual es diferente de 0
    if ($monto_bn_actual_h != 0 && $monto_bn_anterior_h != 0) {
        $diferencia_h = $monto_bn_actual_h - $monto_bn_anterior_h;
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('H' . $fila, $diferencia_h);

        $value = $diferencia_h;
        $spreadsheet->getActiveSheet()->setCellValue('H' . $fila, $value);
        $spreadsheet->getActiveSheet()->getStyle('H' . $fila)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);
    }

    //-----------------------------------------------------------------------------------------------------
    //CALCULO DIFERENCIA DE SALDO COLUMNA I

    $monto_bn_actual_i = 0;
    $monto_bn_anterior_i = 0;
    $diferencia_i = 0;

    //CONSULTA MONTO BN FECHA ACTUAL
    $sql_diferencia_bn_i = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_actual' 
    AND nombre_banco='BANCO DE COMERCIO' AND numero_cuenta='110-01-0450881' AND nombre_cuenta='R.D.R. (INSTITUTO DE IDIOMAS)'";
    $query_diferencia_bn_i = $pdo->prepare($sql_diferencia_bn_i);
    $query_diferencia_bn_i->execute();
    $diferencia_bn_datos_i = $query_diferencia_bn_i->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_i as $diferencia_bn_dato_i) {
        if ($diferencia_bn_dato_i["fecha"] == $fecha_actual) {
            $monto_bn_actual_i = $diferencia_bn_dato_i["monto"];
        } else {
            $monto_bn_actual_i = 0;
        }

    }

    //CONSULTA MONTO BN FECHA ANTERIOR
    $sql_diferencia_bn_i = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_anterior' 
    AND nombre_banco='BANCO DE COMERCIO' AND numero_cuenta='110-01-0450881' AND nombre_cuenta='R.D.R. (INSTITUTO DE IDIOMAS)'";
    $query_diferencia_bn_i = $pdo->prepare($sql_diferencia_bn_i);
    $query_diferencia_bn_i->execute();
    $diferencia_bn_datos_i = $query_diferencia_bn_i->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_i as $diferencia_bn_dato_i) {
        if ($diferencia_bn_dato_i["fecha"] == $fecha_anterior) {
            $monto_bn_anterior_i = $diferencia_bn_dato_i["monto"];
        } else {
            $monto_bn_anterior_i = 0;
        }

    }

    //si monto actual es diferente de 0
    if ($monto_bn_actual_i != 0 && $monto_bn_anterior_i != 0) {
        $diferencia_i = $monto_bn_actual_i - $monto_bn_anterior_i;
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('I' . $fila, $diferencia_i);

        $value = $diferencia_i;
        $spreadsheet->getActiveSheet()->setCellValue('I' . $fila, $value);
        $spreadsheet->getActiveSheet()->getStyle('I' . $fila)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);
    }

    //-----------------------------------------------------------------------------------------------------
    //CALCULO DIFERENCIA DE SALDO COLUMNA J

    $monto_bn_actual_j = 0;
    $monto_bn_anterior_j = 0;
    $diferencia_j = 0;

    //CONSULTA MONTO BN FECHA ACTUAL
    $sql_diferencia_bn_j = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_actual' 
    AND nombre_banco='BANCO DE COMERCIO' AND numero_cuenta='110-01-0451398' AND nombre_cuenta='R.D.R. (MATRICULA) CUDED-PRE GRADO'";
    $query_diferencia_bn_j = $pdo->prepare($sql_diferencia_bn_j);
    $query_diferencia_bn_j->execute();
    $diferencia_bn_datos_j = $query_diferencia_bn_j->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_j as $diferencia_bn_dato_j) {
        if ($diferencia_bn_dato_j["fecha"] == $fecha_actual) {
            $monto_bn_actual_j = $diferencia_bn_dato_j["monto"];
        } else {
            $monto_bn_actual_j = 0;
        }

    }

    //CONSULTA MONTO BN FECHA ANTERIOR
    $sql_diferencia_bn_j = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_anterior' 
    AND nombre_banco='BANCO DE COMERCIO' AND numero_cuenta='110-01-0451398' AND nombre_cuenta='R.D.R. (MATRICULA) CUDED-PRE GRADO'";
    $query_diferencia_bn_j = $pdo->prepare($sql_diferencia_bn_j);
    $query_diferencia_bn_j->execute();
    $diferencia_bn_datos_j = $query_diferencia_bn_j->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_j as $diferencia_bn_dato_j) {
        if ($diferencia_bn_dato_j["fecha"] == $fecha_anterior) {
            $monto_bn_anterior_j = $diferencia_bn_dato_j["monto"];
        } else {
            $monto_bn_anterior_j = 0;
        }

    }

    //si monto actual es diferente de 0
    if ($monto_bn_actual_j != 0 && $monto_bn_anterior_j != 0) {
        $diferencia_j = $monto_bn_actual_j - $monto_bn_anterior_j;
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('J' . $fila, $diferencia_j);

        $value = $diferencia_j;
        $spreadsheet->getActiveSheet()->setCellValue('J' . $fila, $value);
        $spreadsheet->getActiveSheet()->getStyle('J' . $fila)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);
    }

    //-----------------------------------------------------------------------------------------------------
    //CALCULO DIFERENCIA DE SALDO COLUMNA K
/*
    $monto_bn_actual_k = 0;
    $monto_bn_anterior_k = 0;
    $diferencia_k = 0;

    //CONSULTA MONTO BN FECHA ACTUAL
    $sql_diferencia_bn_k = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_actual' 
    AND nombre_banco='BANCO PICHINCHA' AND numero_cuenta='290015057' AND nombre_cuenta='R.D.R. (RECAUDACION CAJAS PERIFERICAS)'";
    $query_diferencia_bn_k = $pdo->prepare($sql_diferencia_bn_k);
    $query_diferencia_bn_k->execute();
    $diferencia_bn_datos_k = $query_diferencia_bn_k->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_k as $diferencia_bn_dato_k) {
        if ($diferencia_bn_dato_k["fecha"] == $fecha_actual) {
            $monto_bn_actual_k = $diferencia_bn_dato_k["monto"];
        } else {
            $monto_bn_actual_k = 0;
        }

    }

    //CONSULTA MONTO BN FECHA ANTERIOR
    $sql_diferencia_bn_k = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_anterior' 
    AND nombre_banco='BANCO PICHINCHA' AND numero_cuenta='290015057' AND nombre_cuenta='R.D.R. (RECAUDACION CAJAS PERIFERICAS)'";
    $query_diferencia_bn_k = $pdo->prepare($sql_diferencia_bn_k);
    $query_diferencia_bn_k->execute();
    $diferencia_bn_datos_k = $query_diferencia_bn_k->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_k as $diferencia_bn_dato_k) {
        if ($diferencia_bn_dato_k["fecha"] == $fecha_anterior) {
            $monto_bn_anterior_k = $diferencia_bn_dato_k["monto"];
        } else {
            $monto_bn_anterior_k = 0;
        }

    }

    //si monto actual es diferente de 0
    if ($monto_bn_actual_k != 0 && $monto_bn_anterior_k != 0) {
        $diferencia_k = $monto_bn_actual_k - $monto_bn_anterior_k;
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('K' . $fila, $diferencia_k);
    }

    //-----------------------------------------------------------------------------------------------------
    //CALCULO DIFERENCIA DE SALDO COLUMNA L

    $monto_bn_actual_l = 0;
    $monto_bn_anterior_l = 0;
    $diferencia_l = 0;

    //CONSULTA MONTO BN FECHA ACTUAL
    $sql_diferencia_bn_l = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_actual' 
    AND nombre_banco='BANCO PICHINCHA' AND numero_cuenta='290015472' AND nombre_cuenta='R.D.R. (RECAUDACION CAJAS PERIFERICAS)'";
    $query_diferencia_bn_l = $pdo->prepare($sql_diferencia_bn_l);
    $query_diferencia_bn_l->execute();
    $diferencia_bn_datos_l = $query_diferencia_bn_l->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_l as $diferencia_bn_dato_l) {
        if ($diferencia_bn_dato_l["fecha"] == $fecha_actual) {
            $monto_bn_actual_l = $diferencia_bn_dato_l["monto"];
        } else {
            $monto_bn_actual_l = 0;
        }

    }

    //CONSULTA MONTO BN FECHA ANTERIOR
    $sql_diferencia_bn_l = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_anterior' 
    AND nombre_banco='BANCO PICHINCHA' AND numero_cuenta='290015472' AND nombre_cuenta='R.D.R. (RECAUDACION CAJAS PERIFERICAS)'";
    $query_diferencia_bn_l = $pdo->prepare($sql_diferencia_bn_l);
    $query_diferencia_bn_l->execute();
    $diferencia_bn_datos_l = $query_diferencia_bn_l->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_l as $diferencia_bn_dato_l) {
        if ($diferencia_bn_dato_l["fecha"] == $fecha_anterior) {
            $monto_bn_anterior_l = $diferencia_bn_dato_l["monto"];
        } else {
            $monto_bn_anterior_l = 0;
        }

    }

    //si monto actual es diferente de 0
    if ($monto_bn_actual_l != 0 && $monto_bn_anterior_l != 0) {
        $diferencia_l = $monto_bn_actual_l - $monto_bn_anterior_l;
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('L' . $fila, $diferencia_l);
    }

    //-----------------------------------------------------------------------------------------------------
    //CALCULO DIFERENCIA DE SALDO COLUMNA M

    $monto_bn_actual_m = 0;
    $monto_bn_anterior_m = 0;
    $diferencia_m = 0;

    //CONSULTA MONTO BN FECHA ACTUAL
    $sql_diferencia_bn_m = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_actual' 
    AND nombre_banco='BANCO PICHINCHA' AND numero_cuenta='000368430790' AND nombre_cuenta='OTROS'";
    $query_diferencia_bn_m = $pdo->prepare($sql_diferencia_bn_m);
    $query_diferencia_bn_m->execute();
    $diferencia_bn_datos_m = $query_diferencia_bn_m->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_m as $diferencia_bn_dato_m) {
        if ($diferencia_bn_dato_m["fecha"] == $fecha_actual) {
            $monto_bn_actual_m = $diferencia_bn_dato_m["monto"];
        } else {
            $monto_bn_actual_m = 0;
        }

    }

    //CONSULTA MONTO BN FECHA ANTERIOR
    $sql_diferencia_bn_m = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_anterior' 
    AND nombre_banco='BANCO PICHINCHA' AND numero_cuenta='000368430790' AND nombre_cuenta='OTROS'";
    $query_diferencia_bn_m = $pdo->prepare($sql_diferencia_bn_m);
    $query_diferencia_bn_m->execute();
    $diferencia_bn_datos_m = $query_diferencia_bn_m->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_m as $diferencia_bn_dato_m) {
        if ($diferencia_bn_dato_m["fecha"] == $fecha_anterior) {
            $monto_bn_anterior_m = $diferencia_bn_dato_m["monto"];
        } else {
            $monto_bn_anterior_m = 0;
        }

    }

    //si monto actual es diferente de 0
    if ($monto_bn_actual_m != 0 && $monto_bn_anterior_m != 0) {
        $diferencia_m = $monto_bn_actual_m - $monto_bn_anterior_m;
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('M' . $fila, $diferencia_m);
    }

*/
    //-----------------------------------------------------------------------------------------------------
    //CALCULO DIFERENCIA DE SALDO COLUMNA K

    $monto_bn_actual_n = 0;
    $monto_bn_anterior_n = 0;
    $diferencia_n = 0;

    //CONSULTA MONTO BN FECHA ACTUAL
    $sql_diferencia_bn_n = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_actual' 
    AND nombre_banco='BANCO PICHINCHA' AND numero_cuenta='292100353' AND nombre_cuenta='FACULTAD PSICOLOGIA'";
    $query_diferencia_bn_n = $pdo->prepare($sql_diferencia_bn_n);
    $query_diferencia_bn_n->execute();
    $diferencia_bn_datos_n = $query_diferencia_bn_n->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_n as $diferencia_bn_dato_n) {
        if ($diferencia_bn_dato_n["fecha"] == $fecha_actual) {
            $monto_bn_actual_n = $diferencia_bn_dato_n["monto"];
        } else {
            $monto_bn_actual_n = 0;
        }

    }

    //CONSULTA MONTO BN FECHA ANTERIOR
    $sql_diferencia_bn_n = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_anterior' 
    AND nombre_banco='BANCO PICHINCHA' AND numero_cuenta='292100353' AND nombre_cuenta='FACULTAD PSICOLOGIA'";
    $query_diferencia_bn_n = $pdo->prepare($sql_diferencia_bn_n);
    $query_diferencia_bn_n->execute();
    $diferencia_bn_datos_n = $query_diferencia_bn_n->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_n as $diferencia_bn_dato_n) {
        if ($diferencia_bn_dato_n["fecha"] == $fecha_anterior) {
            $monto_bn_anterior_n = $diferencia_bn_dato_n["monto"];
        } else {
            $monto_bn_anterior_n = 0;
        }

    }

    //si monto actual es diferente de 0
    if ($monto_bn_actual_n != 0 && $monto_bn_anterior_n != 0) {
        $diferencia_n = $monto_bn_actual_n - $monto_bn_anterior_n;
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('K' . $fila, $diferencia_n);

        $value = $diferencia_n;
        $spreadsheet->getActiveSheet()->setCellValue('K' . $fila, $value);
        $spreadsheet->getActiveSheet()->getStyle('K' . $fila)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);
    }


    //-----------------------------------------------------------------------------------------------------
    //CALCULO DIFERENCIA DE SALDO COLUMNA O
/*
    $monto_bn_actual_o = 0;
    $monto_bn_anterior_o = 0;
    $diferencia_o = 0;

    //CONSULTA MONTO BN FECHA ACTUAL
    $sql_diferencia_bn_o = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_actual' 
    AND nombre_banco='BANCO PICHINCHA' AND numero_cuenta='293421714' AND nombre_cuenta='R.D.R. (CENTRO DE PRODUCCION)'";
    $query_diferencia_bn_o = $pdo->prepare($sql_diferencia_bn_o);
    $query_diferencia_bn_o->execute();
    $diferencia_bn_datos_o = $query_diferencia_bn_o->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_o as $diferencia_bn_dato_o) {
        if ($diferencia_bn_dato_o["fecha"] == $fecha_actual) {
            $monto_bn_actual_o = $diferencia_bn_dato_o["monto"];
        } else {
            $monto_bn_actual_o = 0;
        }

    }

    //CONSULTA MONTO BN FECHA ANTERIOR
    $sql_diferencia_bn_o = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_anterior' 
    AND nombre_banco='BANCO PICHINCHA' AND numero_cuenta='293421714' AND nombre_cuenta='R.D.R. (CENTRO DE PRODUCCION)'";
    $query_diferencia_bn_o = $pdo->prepare($sql_diferencia_bn_o);
    $query_diferencia_bn_o->execute();
    $diferencia_bn_datos_o = $query_diferencia_bn_o->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_o as $diferencia_bn_dato_o) {
        if ($diferencia_bn_dato_o["fecha"] == $fecha_anterior) {
            $monto_bn_anterior_o = $diferencia_bn_dato_o["monto"];
        } else {
            $monto_bn_anterior_o = 0;
        }

    }

    //si monto actual es diferente de 0
    if ($monto_bn_actual_o != 0 && $monto_bn_anterior_o != 0) {
        $diferencia_o = $monto_bn_actual_o - $monto_bn_anterior_o;
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('O' . $fila, $diferencia_o);
    }


    //-----------------------------------------------------------------------------------------------------
    //CALCULO DIFERENCIA DE SALDO COLUMNA P

    $monto_bn_actual_p = 0;
    $monto_bn_anterior_p = 0;
    $diferencia_p = 0;

    //CONSULTA MONTO BN FECHA ACTUAL
    $sql_diferencia_bn_p = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_actual' 
    AND nombre_banco='BANCO PICHINCHA' AND numero_cuenta='293421692' AND nombre_cuenta='R.D.R. (CENTRO DE PRODUCCION)'";
    $query_diferencia_bn_p = $pdo->prepare($sql_diferencia_bn_p);
    $query_diferencia_bn_p->execute();
    $diferencia_bn_datos_p = $query_diferencia_bn_p->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_p as $diferencia_bn_dato_p) {
        if ($diferencia_bn_dato_p["fecha"] == $fecha_actual) {
            $monto_bn_actual_p = $diferencia_bn_dato_p["monto"];
        } else {
            $monto_bn_actual_p = 0;
        }

    }

    //CONSULTA MONTO BN FECHA ANTERIOR
    $sql_diferencia_bn_p = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_anterior' 
    AND nombre_banco='BANCO PICHINCHA' AND numero_cuenta='293421692' AND nombre_cuenta='R.D.R. (CENTRO DE PRODUCCION)'";
    $query_diferencia_bn_p = $pdo->prepare($sql_diferencia_bn_p);
    $query_diferencia_bn_p->execute();
    $diferencia_bn_datos_p = $query_diferencia_bn_p->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_p as $diferencia_bn_dato_p) {
        if ($diferencia_bn_dato_p["fecha"] == $fecha_anterior) {
            $monto_bn_anterior_p = $diferencia_bn_dato_p["monto"];
        } else {
            $monto_bn_anterior_p = 0;
        }

    }

    //si monto actual es diferente de 0
    if ($monto_bn_actual_p != 0) {
        $diferencia_p = $monto_bn_actual_p - $monto_bn_anterior_p;
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('P' . $fila, $diferencia_p);
    }
*/
    //-----------------------------------------------------------------------------------------------------
    //CALCULO DIFERENCIA DE SALDO COLUMNA L

    $monto_bn_actual_q = 0;
    $monto_bn_anterior_q = 0;
    $diferencia_q = 0;

    //CONSULTA MONTO BN FECHA ACTUAL
    $sql_diferencia_bn_q = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_actual' 
    AND nombre_banco='BANCO DE CREDITO DEL PERU' AND numero_cuenta='193-1161080-0-80' AND nombre_cuenta='RESIDENTADO MEDICO'";
    $query_diferencia_bn_q = $pdo->prepare($sql_diferencia_bn_q);
    $query_diferencia_bn_q->execute();
    $diferencia_bn_datos_q = $query_diferencia_bn_q->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_q as $diferencia_bn_dato_q) {
        if ($diferencia_bn_dato_q["fecha"] == $fecha_actual) {
            $monto_bn_actual_q = $diferencia_bn_dato_q["monto"];
        } else {
            $monto_bn_actual_q = 0;
        }

    }

    //CONSULTA MONTO BN FECHA ANTERIOR
    $sql_diferencia_bn_q = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_anterior' 
    AND nombre_banco='BANCO DE CREDITO DEL PERU' AND numero_cuenta='193-1161080-0-80' AND nombre_cuenta='RESIDENTADO MEDICO'";
    $query_diferencia_bn_q = $pdo->prepare($sql_diferencia_bn_q);
    $query_diferencia_bn_q->execute();
    $diferencia_bn_datos_q = $query_diferencia_bn_q->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_q as $diferencia_bn_dato_q) {
        if ($diferencia_bn_dato_q["fecha"] == $fecha_anterior) {
            $monto_bn_anterior_q = $diferencia_bn_dato_q["monto"];
        } else {
            $monto_bn_anterior_q = 0;
        }

    }

    //si monto actual es diferente de 0
    if ($monto_bn_actual_q != 0 && $monto_bn_anterior_q != 0) {
        $diferencia_q = $monto_bn_actual_q - $monto_bn_anterior_q;
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('L' . $fila, $diferencia_q);

        $value = $diferencia_q;
        $spreadsheet->getActiveSheet()->setCellValue('L' . $fila, $value);
        $spreadsheet->getActiveSheet()->getStyle('L' . $fila)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);
    }

    //-----------------------------------------------------------------------------------------------------
    //CALCULO DIFERENCIA DE SALDO COLUMNA M

    $monto_bn_actual_r = 0;
    $monto_bn_anterior_r = 0;
    $diferencia_r = 0;

    //CONSULTA MONTO BN FECHA ACTUAL
    $sql_diferencia_bn_r = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_actual' 
    AND nombre_banco='BANCO DE CREDITO DEL PERU' AND numero_cuenta='193-1179669-0-46' AND nombre_cuenta='POST GRADO'";
    $query_diferencia_bn_r = $pdo->prepare($sql_diferencia_bn_r);
    $query_diferencia_bn_r->execute();
    $diferencia_bn_datos_r = $query_diferencia_bn_r->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_r as $diferencia_bn_dato_r) {
        if ($diferencia_bn_dato_r["fecha"] == $fecha_actual) {
            $monto_bn_actual_r = $diferencia_bn_dato_r["monto"];
        } else {
            $monto_bn_actual_r = 0;
        }

    }

    //CONSULTA MONTO BN FECHA ANTERIOR
    $sql_diferencia_bn_r = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_anterior' 
    AND nombre_banco='BANCO DE CREDITO DEL PERU' AND numero_cuenta='193-1179669-0-46' AND nombre_cuenta='POST GRADO'";
    $query_diferencia_bn_r = $pdo->prepare($sql_diferencia_bn_r);
    $query_diferencia_bn_r->execute();
    $diferencia_bn_datos_r = $query_diferencia_bn_r->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_r as $diferencia_bn_dato_r) {
        if ($diferencia_bn_dato_r["fecha"] == $fecha_anterior) {
            $monto_bn_anterior_r = $diferencia_bn_dato_r["monto"];
        } else {
            $monto_bn_anterior_r = 0;
        }

    }

    //si monto actual es diferente de 0
    if ($monto_bn_actual_r != 0 && $monto_bn_anterior_r != 0) {
        $diferencia_r = $monto_bn_actual_r - $monto_bn_anterior_r;
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('M' . $fila, $diferencia_r);

        $value = $diferencia_r;
        $spreadsheet->getActiveSheet()->setCellValue('M' . $fila, $value);
        $spreadsheet->getActiveSheet()->getStyle('M' . $fila)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);
    }


    //-----------------------------------------------------------------------------------------------------
    //CALCULO DIFERENCIA DE SALDO COLUMNA N

    $monto_bn_actual_s = 0;
    $monto_bn_anterior_s = 0;
    $diferencia_s = 0;

    //CONSULTA MONTO BN FECHA ACTUAL
    $sql_diferencia_bn_s = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_actual' 
    AND nombre_banco='BANCO DE CREDITO DEL PERU' AND numero_cuenta='191-9398126-0-63' AND nombre_cuenta='UNFV-ADMISION'";
    $query_diferencia_bn_s = $pdo->prepare($sql_diferencia_bn_s);
    $query_diferencia_bn_s->execute();
    $diferencia_bn_datos_s = $query_diferencia_bn_s->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_s as $diferencia_bn_dato_s) {
        if ($diferencia_bn_dato_s["fecha"] == $fecha_actual) {
            $monto_bn_actual_s = $diferencia_bn_dato_s["monto"];
        } else {
            $monto_bn_actual_s = 0;
        }

    }

    //CONSULTA MONTO BN FECHA ANTERIOR
    $sql_diferencia_bn_s = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_anterior' 
    AND nombre_banco='BANCO DE CREDITO DEL PERU' AND numero_cuenta='191-9398126-0-63' AND nombre_cuenta='UNFV-ADMISION'";
    $query_diferencia_bn_s = $pdo->prepare($sql_diferencia_bn_s);
    $query_diferencia_bn_s->execute();
    $diferencia_bn_datos_s = $query_diferencia_bn_s->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_s as $diferencia_bn_dato_s) {
        if ($diferencia_bn_dato_s["fecha"] == $fecha_anterior) {
            $monto_bn_anterior_s = $diferencia_bn_dato_s["monto"];
        } else {
            $monto_bn_anterior_s = 0;
        }

    }

    //si monto actual es diferente de 0
    if ($monto_bn_actual_s != 0 && $monto_bn_anterior_s != 0) {
        $diferencia_s = $monto_bn_actual_s - $monto_bn_anterior_s;
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('N' . $fila, $diferencia_s);

        $value = $diferencia_s;
        $spreadsheet->getActiveSheet()->setCellValue('N' . $fila, $value);
        $spreadsheet->getActiveSheet()->getStyle('N' . $fila)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);
    }

    //-----------------------------------------------------------------------------------------------------
    //CALCULO DIFERENCIA DE SALDO COLUMNA O

    $monto_bn_actual_t = 0;
    $monto_bn_anterior_t = 0;
    $diferencia_t = 0;

    //CONSULTA MONTO BN FECHA ACTUAL
    $sql_diferencia_bn_t = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_actual' 
    AND nombre_banco='BANCO DE CREDITO DEL PERU' AND numero_cuenta='191-9398127-0-73' AND nombre_cuenta='UNFV-MATRICULA Y PENSIONES'";
    $query_diferencia_bn_t = $pdo->prepare($sql_diferencia_bn_t);
    $query_diferencia_bn_t->execute();
    $diferencia_bn_datos_t = $query_diferencia_bn_t->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_t as $diferencia_bn_dato_t) {
        if ($diferencia_bn_dato_t["fecha"] == $fecha_actual) {
            $monto_bn_actual_t = $diferencia_bn_dato_t["monto"];
        } else {
            $monto_bn_actual_t = 0;
        }

    }

    //CONSULTA MONTO BN FECHA ANTERIOR
    $sql_diferencia_bn_t = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_anterior' 
    AND nombre_banco='BANCO DE CREDITO DEL PERU' AND numero_cuenta='191-9398127-0-73' AND nombre_cuenta='UNFV-MATRICULA Y PENSIONES'";
    $query_diferencia_bn_t = $pdo->prepare($sql_diferencia_bn_t);
    $query_diferencia_bn_t->execute();
    $diferencia_bn_datos_t = $query_diferencia_bn_t->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_t as $diferencia_bn_dato_t) {
        if ($diferencia_bn_dato_t["fecha"] == $fecha_anterior) {
            $monto_bn_anterior_t = $diferencia_bn_dato_t["monto"];
        } else {
            $monto_bn_anterior_t = 0;
        }

    }

    //si monto actual es diferente de 0
    if ($monto_bn_actual_t != 0 && $monto_bn_anterior_t != 0) {
        $diferencia_t = $monto_bn_actual_t - $monto_bn_anterior_t;
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('O' . $fila, $diferencia_t);

        $value = $diferencia_t;
        $spreadsheet->getActiveSheet()->setCellValue('O' . $fila, $value);
        $spreadsheet->getActiveSheet()->getStyle('O' . $fila)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);
    }




    //-----------------------------------------------------------------------------------------------------
    //CALCULO DIFERENCIA DE SALDO COLUMNA U
/*
    $monto_bn_actual_u = 0;
    $monto_bn_anterior_u = 0;
    $diferencia_u = 0;

    //CONSULTA MONTO BN FECHA ACTUAL
    $sql_diferencia_bn_u = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_actual' 
    AND nombre_banco='BANCO DE CREDITO DEL PERU' AND numero_cuenta='191-045-30292-0-51' AND nombre_cuenta='(TEC. MEDICA) * 6-6-2024-CERRO 2789.5'";
    $query_diferencia_bn_u = $pdo->prepare($sql_diferencia_bn_u);
    $query_diferencia_bn_u->execute();
    $diferencia_bn_datos_u = $query_diferencia_bn_u->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_u as $diferencia_bn_dato_u) {
        if ($diferencia_bn_dato_u["fecha"] == $fecha_actual) {
            $monto_bn_actual_u = $diferencia_bn_dato_u["monto"];
        } else {
            $monto_bn_actual_u = 0;
        }

    }

    //CONSULTA MONTO BN FECHA ANTERIOR
    $sql_diferencia_bn_u = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_anterior' 
    AND nombre_banco='BANCO DE CREDITO DEL PERU' AND numero_cuenta='191-045-30292-0-51' AND nombre_cuenta='(TEC. MEDICA) * 6-6-2024-CERRO 2789.5'";
    $query_diferencia_bn_u = $pdo->prepare($sql_diferencia_bn_u);
    $query_diferencia_bn_u->execute();
    $diferencia_bn_datos_u = $query_diferencia_bn_u->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_u as $diferencia_bn_dato_u) {
        if ($diferencia_bn_dato_u["fecha"] == $fecha_anterior) {
            $monto_bn_anterior_u = $diferencia_bn_dato_u["monto"];
        } else {
            $monto_bn_anterior_u = 0;
        }

    }

    //si monto actual es diferente de 0
    if ($monto_bn_actual_u != 0 && $monto_bn_anterior_u != 0) {
        $diferencia_u = $monto_bn_actual_u - $monto_bn_anterior_u;
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('U' . $fila, $diferencia_u);
    }


    //-----------------------------------------------------------------------------------------------------
    //CALCULO DIFERENCIA DE SALDO COLUMNA V

    $monto_bn_actual_v = 0;
    $monto_bn_anterior_v = 0;
    $diferencia_v = 0;

    //CONSULTA MONTO BN FECHA ACTUAL
    $sql_diferencia_bn_v = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_actual' 
    AND nombre_banco='BANCO DE CREDITO DEL PERU' AND numero_cuenta='193-11200504-0-40' AND nombre_cuenta='(PROCUNED) * 6-6-2024-CERRO 1632.95'";
    $query_diferencia_bn_v = $pdo->prepare($sql_diferencia_bn_v);
    $query_diferencia_bn_v->execute();
    $diferencia_bn_datos_v = $query_diferencia_bn_v->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_v as $diferencia_bn_dato_v) {
        if ($diferencia_bn_dato_v["fecha"] == $fecha_actual) {
            $monto_bn_actual_v = $diferencia_bn_dato_v["monto"];
        } else {
            $monto_bn_actual_v = 0;
        }

    }

    //CONSULTA MONTO BN FECHA ANTERIOR
    $sql_diferencia_bn_v = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_anterior' 
    AND nombre_banco='BANCO DE CREDITO DEL PERU' AND numero_cuenta='193-11200504-0-40' AND nombre_cuenta='(PROCUNED) * 6-6-2024-CERRO 1632.95'";
    $query_diferencia_bn_v = $pdo->prepare($sql_diferencia_bn_v);
    $query_diferencia_bn_v->execute();
    $diferencia_bn_datos_v = $query_diferencia_bn_v->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_v as $diferencia_bn_dato_v) {
        if ($diferencia_bn_dato_v["fecha"] == $fecha_anterior) {
            $monto_bn_anterior_v = $diferencia_bn_dato_v["monto"];
        } else {
            $monto_bn_anterior_v = 0;
        }

    }

    //si monto actual es diferente de 0
    if ($monto_bn_actual_v != 0 && $monto_bn_anterior_v != 0) {
        $diferencia_v = $monto_bn_actual_v - $monto_bn_anterior_v;
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('V' . $fila, $diferencia_v);
    }
*/

    //-----------------------------------------------------------------------------------------------------
    //CALCULO DIFERENCIA DE SALDO COLUMNA P

    $monto_bn_actual_w = 0;
    $monto_bn_anterior_w = 0;
    $diferencia_w = 0;

    //CONSULTA MONTO BN FECHA ACTUAL
    $sql_diferencia_bn_w = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_actual' 
    AND nombre_banco='BANCO DE CREDITO DEL PERU' AND numero_cuenta='193-10853146-0-72' AND nombre_cuenta='(EDUCACION A DISTANCIA ANTES) AHORA CCFV'";
    $query_diferencia_bn_w = $pdo->prepare($sql_diferencia_bn_w);
    $query_diferencia_bn_w->execute();
    $diferencia_bn_datos_w = $query_diferencia_bn_w->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_w as $diferencia_bn_dato_w) {
        if ($diferencia_bn_dato_w["fecha"] == $fecha_actual) {
            $monto_bn_actual_w = $diferencia_bn_dato_w["monto"];
        } else {
            $monto_bn_actual_w = 0;
        }

    }

    //CONSULTA MONTO BN FECHA ANTERIOR
    $sql_diferencia_bn_w = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha_anterior' 
    AND nombre_banco='BANCO DE CREDITO DEL PERU' AND numero_cuenta='193-10853146-0-72' AND nombre_cuenta='(EDUCACION A DISTANCIA ANTES) AHORA CCFV'";
    $query_diferencia_bn_w = $pdo->prepare($sql_diferencia_bn_w);
    $query_diferencia_bn_w->execute();
    $diferencia_bn_datos_w = $query_diferencia_bn_w->fetchAll(PDO::FETCH_ASSOC);

    foreach ($diferencia_bn_datos_w as $diferencia_bn_dato_w) {
        if ($diferencia_bn_dato_w["fecha"] == $fecha_anterior) {
            $monto_bn_anterior_w = $diferencia_bn_dato_w["monto"];
        } else {
            $monto_bn_anterior_w = 0;
        }

    }

    //si monto actual es diferente de 0
    if ($monto_bn_actual_w != 0 && $monto_bn_anterior_w != 0) {
        $diferencia_w = $monto_bn_actual_w - $monto_bn_anterior_w;
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('P' . $fila, $diferencia_w);

        $value = $diferencia_w;
        $spreadsheet->getActiveSheet()->setCellValue('P' . $fila, $value);
        $spreadsheet->getActiveSheet()->getStyle('P' . $fila)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);
    }

    $total_monto_diferencia = 0;
    $total_monto_diferencia = ($diferencia_b + $diferencia_c + $diferencia_d + $diferencia_e + $diferencia_f
        + $diferencia_g + $diferencia_h + $diferencia_i + $diferencia_j + $diferencia_n + $diferencia_q + $diferencia_r
        + $diferencia_s + $diferencia_t + $diferencia_w);


    if ($total_monto_diferencia != 0) {
        $spreadsheet->setActiveSheetIndex(2)->setCellValue('Q' . $fila, $total_monto_diferencia);



        $value = $total_monto_diferencia;
        $spreadsheet->getActiveSheet()->setCellValue('Q' . $fila, $value);
        $spreadsheet->getActiveSheet()->getStyle('Q' . $fila)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);
    }


    //-----------------------------------------------------------------------------------------------------



    //Convierte en formato fecha
    $value = $fecha_actual;
    $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
    $dateValue = str_replace('FALSO', '', $dateValue);
    $spreadsheet->setActiveSheetIndex(2)->setCellValue('A' . $fila, $dateValue);
    $spreadsheet->setActiveSheetIndex(2)->getStyle('A' . $fila)
        ->getNumberFormat()
        ->setFormatCode('dd/mm/YYYY');

    $fila++;
}





//set the header first, so the result will be treated as an xlsx file.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//make it an attachment so we can define filename
header('Content-Disposition: attachment;filename=' . $fileName . '');

//create IOFactory object
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//save into php output
$writer->save('php://output');

