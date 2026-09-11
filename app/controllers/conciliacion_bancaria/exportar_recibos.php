<?php
include('../../config.php');

require('../../librerias/FPDF/fpdf.php');

#BASE DE DATOS
$contador = 0;
$sumaFinal = 0;
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

if ($anio == "") {
    $anio = $anio_actual_x;
}




class PDF extends FPDF
{

    public function header()
    {

        #$this->Image('../../../public/images/logounfv.png', 15, 14, 15); //logo

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
        $this->Cell(170); //mover a la derecha
        $this->Cell(40, 10, utf8_decode(date('H:i:s a'))); //texto

        $this->SetY(30);
        $this->SetFont('Arial', 'B', 12); //fuente
        $this->Cell(78); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('RECIBO DE INGRESO')); //texto

        $this->SetY(40);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(1); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Entidad:')); //texto

        $this->SetY(40);
        $this->SetFont('Arial', '', 8); //fuente
        $this->Cell(20); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('UNIVERSIDAD NACIONAL FEDERICO VILLARREAL')); //texto

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
        $this->Cell(40, 10, utf8_decode('Órgano:')); //texto

        $this->SetY(55);
        $this->SetFont('Arial', '', 8); //fuente
        $this->Cell(20); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('DIRECCION GENERAL DE ADMINISTRACIÓN - OFICINA DE TESORERÍA')); //texto


        //CUADRO

        $this->SetY(70);
        $this->SetFont('Arial', 'B', 8);  //fuente
        $this->Cell(-5); //mover a la derecha
        $this->Cell(200, 210, "", 1, 0, 'C', 0);

        $this->SetY(90); //salto de linea
        #$this->Ln(22); //salto de linea


    }


    public function footer()
    {
        /*
        $this->SetY(-15); //salto de linea
        $this->SetFont('Arial', '', 8); //fuente
        $this->Cell(1); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Oficina de Tesorería')); //texto

        
        $this->SetY(-15); //salto de linea
        $this->AliasNbPages('tpagina');
        $this->SetFont('Arial', '', 8); //fuente
        $this->Cell(180); //mover a la derecha
        $this->Cell(40, 10, utf8_decode($this->PageNo() . ' / tpagina')); //texto
        */
    }


}

$sql_conciliacion = "SELECT CAST(siic_ingresos AS INT) AS siic_ingresos, nro_recibo, siaf_ingresos, fecha_ingresos FROM tb_conciliacion_bancaria WHERE mes_ingresos='$mes' AND anio_ingresos='$anio' AND ('$siaf' = '' OR siaf_ingresos = '$siaf') GROUP BY siaf_ingresos ORDER BY siic_ingresos ASC";
$query_conciliacion = $pdo->prepare($sql_conciliacion);
$query_conciliacion->execute();
$conciliacion_datos = $query_conciliacion->fetchAll(PDO::FETCH_ASSOC);

$pdf = new PDF();
$pdf->AddPage('Portrait', 'A4');
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(TRUE, 15);





foreach ($conciliacion_datos as $conciliacion_dato) {
    $contador++;
    $siic_ingresos= $conciliacion_dato['siic_ingresos'];
    $siafX = $conciliacion_dato['siaf_ingresos'];
    $fecha = $conciliacion_dato['fecha_ingresos'];
    $nro_recibo = $conciliacion_dato['nro_recibo'];



    $pdf->Ln(15); //salto de linea
    $pdf->SetFont('Arial', 'B', 14); //fuente
    $pdf->Cell(80); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('SIAF N° ' . $siafX)); //texto



    #$contador = str_pad($contador, 6, "0", STR_PAD_LEFT);

    $pdf->Ln(-8); //salto de linea
    $pdf->SetFont('Arial', 'B', 14); //fuente
    $pdf->Cell(135); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('N°')); //texto


    //---------------------------------------------------------------------------------------------------------------------

/*
    // 1. Ver si el registro ya tiene número de recibo
    $sql_valida = "SELECT nro_recibo 
               FROM tb_conciliacion_bancaria
               WHERE siaf_ingresos = :siaf_ingresos
                 AND mes_ingresos = :mes_ingresos
                 AND anio_ingresos = :anio_ingresos";

    $query_valida = $pdo->prepare($sql_valida);
    $query_valida->bindParam(':siaf_ingresos', $siafX);
    $query_valida->bindParam(':mes_ingresos', $mes);
    $query_valida->bindParam(':anio_ingresos', $anio);
    $query_valida->execute();

    $dato_valida = $query_valida->fetch(PDO::FETCH_ASSOC);
    $nro_actual = $dato_valida['nro_recibo']; // puede ser NULL

    // 2. Si YA TIENE un número → usarlo y no incrementar
    if ($nro_actual !== 0) {

        $nro_recibo = $nro_actual;  // mantener el existente

    } else {

        // 3. Si está NULL → generar uno nuevo tomando el máximo numero de recibo por año
        $sql_cb = "SELECT MAX(nro_recibo) AS nro_recibo 
               FROM tb_conciliacion_bancaria 
               WHERE visible != 1 AND anio_ingresos=$anio_actual_x"; //2026 o '$anio_actual_x'
        $query_cb = $pdo->prepare($sql_cb);
        $query_cb->execute();
        $cb_dato = $query_cb->fetch(PDO::FETCH_ASSOC);

        $nro_max = $cb_dato['nro_recibo'];

    
        if ($nro_max === 0) {

                $nro_recibo = 1;

        } else {
            $nro_recibo = $nro_max + 1;
        }
    }

    // 4. Actualizar
    $sentencia = $pdo->prepare('UPDATE tb_conciliacion_bancaria 
    SET nro_recibo = :nro_recibo,
        fyh_actualizacion = :fyh_actualizacion
    WHERE siaf_ingresos = :siaf_ingresos 
      AND mes_ingresos = :mes_ingresos 
      AND anio_ingresos = :anio_ingresos');

    $sentencia->bindParam(':nro_recibo', $nro_recibo);
    $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
    $sentencia->bindParam(':siaf_ingresos', $siafX);
    $sentencia->bindParam(':mes_ingresos', $mes);
    $sentencia->bindParam(':anio_ingresos', $anio);

    $sentencia->execute();

*/




    //---------------------------------------------------------------------------------------------------------------------

    //$nro_recibo = str_pad($nro_recibo, 6, "0", STR_PAD_LEFT);

    $siic_ingresos = str_pad($siic_ingresos, 6, "0", STR_PAD_LEFT);

    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', 'B', 14); //fuente
    $pdf->Cell(145); //mover a la derecha
    $pdf->SetTextColor(255, 42, 0);  // Establece el color del texto (en este caso es blanco)
    $pdf->SetFillColor(255, 255, 255); // establece el color del fondo de la celda (en este caso es VERDE)
    $pdf->Cell(40, 10, utf8_decode($siic_ingresos), 1, null, 'C', true); //texto

    $theDate = new DateTime($fecha);
    $fecha = $theDate->format('d-m-Y');


    $pdf->Ln(15); //salto de linea
    $pdf->SetFont('Arial', 'B', 14); //fuente
    $pdf->Cell(128); //mover a la derecha
    $pdf->SetTextColor(0, 0, 0);  // Establece el color del texto (en este caso es blanco)
    $pdf->SetFillColor(255, 255, 255); // establece el color del fondo de la celda (en este caso es VERDE)
    $pdf->Cell(40, 10, utf8_decode('Fecha ')); //texto

    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', '', 14); //fuente
    $pdf->Cell(145); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode($fecha), 1, null, 'C'); //texto




    $pdf->Ln(20); //salto de linea
    $pdf->SetFont('Arial', 'B', 10); //fuente
    $pdf->Cell(5); //mover a la derecha
    $pdf->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es blanco)
    $pdf->SetFillColor(0, 0, 0); // establece el color del fondo de la celda (en este caso es VERDE)
    $pdf->Cell(30, 5, utf8_decode('CLASIFICADOR'), 1, null, 'C', true); //texto


    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', 'B', 10); //fuente
    $pdf->Cell(35); //mover a la derecha
    $pdf->Cell(60, 5, utf8_decode('BANCO'), 1, null, 'C', true); //texto


    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', 'B', 10); //fuente
    $pdf->Cell(95); //mover a la derecha
    $pdf->Cell(30, 5, utf8_decode('CUENTA'), 1, null, 'C', true); //texto


    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', 'B', 10); //fuente
    $pdf->Cell(125); //mover a la derecha
    $pdf->Cell(30, 5, utf8_decode('MES'), 1, null, 'C', true); //texto


    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', 'B', 10); //fuente
    $pdf->Cell(155); //mover a la derecha
    $pdf->Cell(30, 5, utf8_decode('TOTAL'), 1, null, 'C', true); //texto


    $pdf->SetTextColor(0, 0, 0);  // Establece el color del texto (en este caso es blanco)
    $pdf->SetFillColor(255, 255, 255); // establece el color del fondo de la celda (en este caso es VERDE)


    $sql_ingresos = "SELECT siaf_ingresos, clasificador_ingresos, banco_ingresos, cta_ingresos, mes_ingresos, SUM(importe_ingresos) as total from tb_conciliacion_bancaria WHERE siaf_ingresos='$siafX' and mes_ingresos='$mes' and anio_ingresos='$anio' GROUP BY clasificador_ingresos";
    $query_ingresos = $pdo->prepare($sql_ingresos);
    $query_ingresos->execute();
    $ingresos_datos = $query_ingresos->fetchAll(PDO::FETCH_ASSOC);

    $sumaFinal = 0;

    foreach ($ingresos_datos as $ingresos_dato) {

        $clasificadorX = $ingresos_dato['clasificador_ingresos'];
        $bancoX = $ingresos_dato['banco_ingresos'];
        $cuentaX = $ingresos_dato['cta_ingresos'];
        $mesX = $ingresos_dato['mes_ingresos'];
        $totalX = $ingresos_dato['total'];


        $pdf->Ln(5); //salto de linea
        $pdf->SetFont('Times', '', 10); //fuente
        $pdf->Cell(5); //mover a la derecha
        #$pdf->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es blanco)
        #$pdf->SetFillColor(0, 0, 0); // establece el color del fondo de la celda (en este caso es VERDE)
        $pdf->Cell(30, 5, utf8_decode($clasificadorX), 1, null, 'C', true); //texto


        $pdf->Ln(0); //salto de linea
        $pdf->SetFont('Times', '', 10); //fuente
        $pdf->Cell(35); //mover a la derecha
        $pdf->Cell(60, 5, utf8_decode($bancoX), 1, null, 'C', true); //texto


        $pdf->Ln(0); //salto de linea
        $pdf->SetFont('Times', '', 10); //fuente
        $pdf->Cell(95); //mover a la derecha
        $pdf->Cell(30, 5, utf8_decode($cuentaX), 1, null, 'C', true); //texto


        $pdf->Ln(0); //salto de linea
        $pdf->SetFont('Times', '', 10); //fuente
        $pdf->Cell(125); //mover a la derecha
        $pdf->Cell(30, 5, utf8_decode($mesX), 1, null, 'C', true); //texto

        $sumaFinal = $sumaFinal + $totalX;


        $totalX = number_format($totalX, 2, '.', ','); //convertir int a decimal

        $pdf->Ln(0); //salto de linea
        $pdf->SetFont('Times', '', 10); //fuente
        $pdf->Cell(155); //mover a la derecha
        $pdf->Cell(30, 5, utf8_decode($totalX), 1, null, 'C', true); //texto





    }

    $sumaFinal = number_format($sumaFinal, 2, '.', ','); //convertir int a decimal

    $pdf->Ln(5); //salto de linea
    $pdf->SetFont('Times', '', 10); //fuente
    $pdf->Cell(5); //mover a la derecha
    $pdf->Cell(150, 5, utf8_decode("TOTAL (S/)"), 1, null, 'R', true); //texto

    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Times', '', 10); //fuente
    $pdf->Cell(155); //mover a la derecha
    $pdf->Cell(30, 5, utf8_decode($sumaFinal), 1, null, 'C', true); //texto

    $pdf->Ln(40); //salto de linea
    $pdf->SetFont('Arial', 'B', 10); //fuente
    $pdf->Cell(15); //mover a la derecha
    $pdf->Cell(60, 5, utf8_decode('_____________________________________'), null, null, 'C', true); //texto

    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', 'B', 10); //fuente
    $pdf->Cell(115); //mover a la derecha
    $pdf->Cell(60, 5, utf8_decode('_____________________________________'), null, null, 'C', true); //texto


    $pdf->Ln(5); //salto de linea
    $pdf->SetFont('Arial', 'B', 10); //fuente
    $pdf->Cell(15); //mover a la derecha
    $pdf->Cell(60, 5, utf8_decode('JEFE DE OFICINA TESORERIA'), null, null, 'C', true); //texto

    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', 'B', 10); //fuente
    $pdf->Cell(115); //mover a la derecha
    $pdf->Cell(60, 5, utf8_decode('AREA DE INGRESO'), null, null, 'C', true); //texto

    $pdf->Ln(400); //salto de linea
    #$pdf->SetY(95); //salto de linea


}


$pdf->Output('Recibos de Ingresos ' . $mes . '-' . $anio . '.pdf', 'I');