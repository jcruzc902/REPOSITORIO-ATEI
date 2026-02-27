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
            $sql_saldo_bancario .= " AND saldo_banco.fyh_creacion between '" . $desde." 00:00:00" . "' and '" . $hasta." 23:59:59" . "'";
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
        $sql_saldo_bancario .= " AND saldo_banco.fyh_creacion between '" . $desde." 00:00:00" . "' and '" . $hasta." 23:59:59" . "'";
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







//set the header first, so the result will be treated as an xlsx file.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//make it an attachment so we can define filename
header('Content-Disposition: attachment;filename=' . $fileName . '');

//create IOFactory object
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//save into php output
$writer->save('php://output');

