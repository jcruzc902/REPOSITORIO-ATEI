<?php
include('../../config.php');

require('../../librerias/FPDF/fpdf.php');

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


class PDF extends FPDF
{
    public function header()
    {
        $this->Image('../../../public/images/logo2_unfv.jpg', 15, 8, 70);

        $this->SetY(10);
        $this->SetFont('Arial', 'B', 8);  //fuente
        $this->Cell(250); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Fecha:')); //texto

        $this->SetY(10);
        $this->SetFont('Arial', '', 8);  //fuente
        $this->Cell(260); //mover a la derecha
        $this->Cell(40, 10, utf8_decode(date('d/m/Y'))); //texto

        $this->SetY(15);
        $this->SetFont('Arial', 'B', 8);  //fuente
        $this->Cell(250); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Hora:')); //texto

        $this->SetY(15);
        $this->SetFont('Arial', '', 8);  //fuente
        $this->Cell(260); //mover a la derecha
        $this->Cell(40, 10, utf8_decode(date('H:i:s a'))); //texto

        $this->SetY(30);
        $this->SetFont('Arial', 'B', 12); //fuente
        $this->Cell(110); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('REPORTE DE CARTAS FIANZA')); //texto

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
        $this->Cell(40, 10, utf8_decode('Organo:')); //texto

        $this->SetY(55);
        $this->SetFont('Arial', '', 8); //fuente
        $this->Cell(20); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('DIRECCION GENERAL DE ADMINISTRACIÓN - OFICINA DE TESORERÍA')); //texto

        $this->Line(10, 65, 285, 65); //LINEA

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(1); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('N°')); //texto


        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(30); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('CONTRATISTA')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(90); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('ENTIDAD FINANCIERA')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(150); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('CARTA F. N°')); //texto

        
        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(177); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('MONTO (S/.)')); //texto
        

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(200); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('F. INICIO')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(218); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('F. TERMINO')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(250); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('CONDICION')); //texto

        

        $this->Line(10, 75, 285, 75); //LINEA





        $this->Ln(12); //salto de linea

    }

    public function footer()
    {
        $this->SetY(-15); //salto de linea
        $this->SetFont('Arial', '', 8); //fuente
        $this->Cell(1); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Oficina de Tesorería')); //texto

        $this->SetY(-15); //salto de linea
        $this->AliasNbPages('tpagina');
        $this->SetFont('Arial', '', 8); //fuente
        $this->Cell(267); //mover a la derecha
        $this->Cell(40, 10, utf8_decode($this->PageNo() . '/tpagina')); //texto
    }
}

$pdf = new PDF();
$pdf->AddPage('LANDSCAPE', 'A4');
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(TRUE, 15);

$i = 1;
$importe_total = 0;

if (!isset($carta_fianza_datos)) {
    $carta_fianza_datos = '';
} else {
    foreach ($carta_fianza_datos as $carta_fianza_dato) {


        
        $pdf->SetFont('Arial', '', 8); //fuente
        $pdf->Cell(1); //mover a la derecha
        $pdf->Cell(9, 5, utf8_decode($i));

        $carta_fianza_dato["entidad_financiera"]= substr($carta_fianza_dato["entidad_financiera"], 0, 25); //cortar cadena
        
        $pdf->Cell(45, 5, utf8_decode($carta_fianza_dato["entidad_financiera"]),null,null,'R');

        $carta_fianza_dato["afianzador"]= substr($carta_fianza_dato["afianzador"], 0, 40); //cortar cadena
        
        $pdf->Cell(75, 5, utf8_decode($carta_fianza_dato["afianzador"]),null,null,'R');

        $carta_fianza_dato["nro_carta_fianza"]= substr($carta_fianza_dato["nro_carta_fianza"], 0, 25); //cortar cadena

        $pdf->Cell(40, 5, utf8_decode($carta_fianza_dato["nro_carta_fianza"]),null,null,'R');

        $importe_total= $importe_total + $carta_fianza_dato["monto"];

        $monto= number_format($carta_fianza_dato["monto"], 2, '.', ','); //convertir int a decimal

        $pdf->Cell(25, 5, utf8_decode($monto),null,null,'R');

        if($carta_fianza_dato['fecha_inicio']=='0000-00-00'){
            $carta_fianza_dato['fecha_inicio']=" ";
        }else{
            $theDate = new DateTime($carta_fianza_dato['fecha_inicio']);
            $carta_fianza_dato['fecha_inicio'] = $theDate->format('d/m/Y');
        }

        $pdf->Cell(20, 5, utf8_decode($carta_fianza_dato["fecha_inicio"]),null,null,'R');

        if($carta_fianza_dato['fecha_termino']=='0000-00-00'){
            $carta_fianza_dato["fecha_termino"]=" ";
        }else{
            $theDate = new DateTime($carta_fianza_dato['fecha_termino']);
            $carta_fianza_dato['fecha_termino'] = $theDate->format('d/m/Y');
        }

        $pdf->Cell(20, 5, utf8_decode($carta_fianza_dato["fecha_termino"]),null,null,'R');

        $pdf->Cell(30, 5, utf8_decode($carta_fianza_dato["condicion"]),null,null,'R');
        
        $i++;
        $pdf->Ln();
        
    }



    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', 'U', 8);  //fuente
    $pdf->Cell(1); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('                                                                                                                                                                                                                                                                                                                                                           ')); //texto

    $pdf->Ln(5); //salto de linea
    $pdf->SetFont('Arial', 'B', 8);  //fuente
    $pdf->Cell(5); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('TOTAL')); //texto

    $importe_total = number_format($importe_total, 2, '.', ','); //convertir int a decimal

    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', 'B', 8);  //fuente
    $pdf->Cell(176); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('S/. ' . $importe_total)); //texto

    $pdf->Ln(2); //salto de linea
    $pdf->SetFont('Arial', 'U', 8);  //fuente
    $pdf->Cell(1); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('                                                                                                                                                                                                                                                                                                                                                           ')); //texto

}

$pdf->Output('Reporte de Devolucion de Dinero.pdf', 'I');