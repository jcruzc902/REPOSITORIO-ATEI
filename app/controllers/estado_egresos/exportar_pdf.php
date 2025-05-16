<?php
include('../../config.php');

require('../../librerias/FPDF/fpdf.php');

session_start();

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
    WHERE egresos.visible!=1 AND detalle_egresos.visible!=1";

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
        $this->Cell(40, 10, utf8_decode(date('H:i:s'))); //texto

        $this->SetY(30);
        $this->SetFont('Arial', 'B', 12); //fuente
        $this->Cell(110); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('REPORTE DE ESTADO DE EGRESOS')); //texto

        $this->SetY(40);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(1); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Entidad:')); //texto

        $this->SetY(40);
        $this->SetFont('Arial', '', 8); //fuente
        $this->Cell(20); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('UNIVERSIDAD NACIONAL FEDERICO VILLAREAL')); //texto

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

        $this->Line(10, 65, 280, 65); //LINEA

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(1); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('N°')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(10); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Facultad')); //texto


        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(32); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('NT-Año')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(60); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Estado Giro')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(90); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Fecha Giro')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(120); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Resolución')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(160); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('SIAF')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(190); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Monto')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(220); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Egresos')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(250); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Saldo')); //texto

        $this->Line(10, 75, 280, 75); //LINEA





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
        $this->Cell(180); //mover a la derecha
        $this->Cell(40, 10, utf8_decode($this->PageNo() . '/tpagina')); //texto
    }
}

$pdf = new PDF();
$pdf->AddPage('LANDSCAPE', 'A4');
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(TRUE, 15);

$i = 1;
$importe_total = 0;

if (!isset($egresos_datos)) {
    $egresos_datos = '';
} else {
    foreach ($egresos_datos as $egresos_dato) {


        $pdf->SetFont('Arial', '', 8); //fuente
        $pdf->Cell(1); //mover a la derecha
        $pdf->Cell(14, 5, utf8_decode($i));

        switch($egresos_dato["cargo_facultad"]){
            case "CENTRO PREUNIVERSITARIO DE LA UNIVERSIDAD NACIONAL FEDERICO VILLARREAL": $egresos_dato["cargo_facultad"]="CEPREVI";break;
            case "CENTRO DE GESTIÓN CULTURAL FEDERICO VILLARREAL": $egresos_dato["cargo_facultad"]="CGCFV";break;
            case "CENTRO UNIVERSITARIO DE IDIOMAS": $egresos_dato["cargo_facultad"]="CUDI";break;
            case "CENTRO DE PRODUCCIÓN DE BIENES Y SERVICIOS": $egresos_dato["cargo_facultad"]="CUPBS";break;
            case "CENTRO UNIVERSITARIO DE RESPONSABILIDAD SOCIAL": $egresos_dato["cargo_facultad"]="CURES";break;
            case "EDITORIAL UNIVERSITARIA": $egresos_dato["cargo_facultad"]="EU";break;
            case "ESCUELA UNIVERSITARIA DE EDUCACIÓN A DISTANCIA": $egresos_dato["cargo_facultad"]="EUDED";break;
            case "ESCUELA UNIVERSITARIA DE POSTGRADO": $egresos_dato["cargo_facultad"]="EUPG";break;
            case "FACULTAD DE ADMINISTRACIÓN": $egresos_dato["cargo_facultad"]="FA";break;
            case "FACULTAD DE PSICOLOGÍA": $egresos_dato["cargo_facultad"]="FAPS";break;
            case "FACULTAD DE ARQUITECTURA Y URBANISMO": $egresos_dato["cargo_facultad"]="FAU";break;
            case "FACULTAD DE CIENCIAS SOCIALES": $egresos_dato["cargo_facultad"]="FCCSS";break;
            case "FACULTAD DE CIENCIAS ECONÓMICAS": $egresos_dato["cargo_facultad"]="FCE";break;
            case "FACULTAD DE CIENCIAS FINANCIERAS Y CONTABLES": $egresos_dato["cargo_facultad"]="FCFC";break;
            case "FACULTAD DE CIENCIAS NATURALES Y MATEMÁTICA": $egresos_dato["cargo_facultad"]="FCNM";break;
            case "FACULTAD DE DERECHO Y CIENCIA POLÍTICA": $egresos_dato["cargo_facultad"]="FDCP";break;
            case "FACULTAD DE EDUCACIÓN": $egresos_dato["cargo_facultad"]="FE";break;
            case "FACULTAD DE HUMANIDADES": $egresos_dato["cargo_facultad"]="FH";break;
            case "FACULTAD DE INGENIERÍA CIVIL": $egresos_dato["cargo_facultad"]="FIC";break;
            case "FACULTAD DE INGENIERÍA ELECTRÓNICA E INFORMÁTICA": $egresos_dato["cargo_facultad"]="FIEI";break;
            case "FACULTAD DE INGENIERÍA GEOGRÁFICA, AMBIENTAL Y ECOTURISMO": $egresos_dato["cargo_facultad"]="FIGAE";break;
            case "FACULTAD DE INGENIERÍA INDUSTRIAL Y DE SISTEMAS": $egresos_dato["cargo_facultad"]="FIIS";break;
            case "FACULTAD DE MEDICINA DE HIPÓLITO UNANUE": $egresos_dato["cargo_facultad"]="FMHU";break;
            case "FACULTAD DE ODONTOLOGÍA": $egresos_dato["cargo_facultad"]="FO";break;
            case "FACULTAD DE OCEANOGRAFÍA, PESQUERÍA Y CC.AA.": $egresos_dato["cargo_facultad"]="FOPCA";break;
            case "FACULTAD DE TECNOLOGÍA MÉDICA": $egresos_dato["cargo_facultad"]="FTM";break;
            case "FACULTADES": $egresos_dato["cargo_facultad"]="FACULT.";break;
            case "INSTITUTO CENTRAL DE GESTIÓN DE LA INVESTIGACIÓN": $egresos_dato["cargo_facultad"]="ICGI";break;
            case "INSTITUTO DE RECREACIÓN, EDUCACIÓN FÍSICA Y DEPORTE": $egresos_dato["cargo_facultad"]="IRED";break;
            case "OFICINA CENTRAL DE ADMISIÓN": $egresos_dato["cargo_facultad"]="OCA";break;
            case "OFICINA CENTRAL DE BIENESTAR UNIVERSITARIO": $egresos_dato["cargo_facultad"]="OCBU";break;
            case "OFICINA CENTRAL DE REGISTROS ACADÉMICOS": $egresos_dato["cargo_facultad"]="OCRAC";break;
            case "OFICINA CENTRAL DE LOGÍSTICA Y SERVICIOS AUXILIARES": $egresos_dato["cargo_facultad"]="OCLSA";break;
            case "OFICINA DE TESORERÍA": $egresos_dato["cargo_facultad"]="OT";break;
            case "SECRETARÍA GENERAL": $egresos_dato["cargo_facultad"]="SG";break;
            case "VICERRECTORADO DE INVESTIGACIÓN": $egresos_dato["cargo_facultad"]="VRIN";break;
    
        }

        $pdf->Cell(8, 5, utf8_decode($egresos_dato["cargo_facultad"]),null,null,'R');
        $pdf->Cell(24, 5, utf8_decode($egresos_dato["nt_principal"] . '-' . $egresos_dato["anio_nt"]),null,null,'R');
        $pdf->Cell(31, 5, utf8_decode($egresos_dato["estado_giro"]),null,null,'R');


        

        if($egresos_dato["fecha_giro"]!="0000-00-00"){
            $theDate = new DateTime($egresos_dato["fecha_giro"]);
            $egresos_dato["fecha_giro"] = $theDate->format('d/m/Y');
        }else{
            $egresos_dato["fecha_giro"]= "";
        }

        $pdf->Cell(29, 5, utf8_decode($egresos_dato["fecha_giro"]),null,null,'R');
        
        if($egresos_dato["resolucion"]=="SELECCIONAR"){
            $egresos_dato["resolucion"]="";
        }

        $pdf->Cell(30, 5, utf8_decode($egresos_dato["resolucion"]),null,null,'R');
        
        $egresos_dato["siaf"]= substr($egresos_dato["siaf"], 0, 4);;
        
        $pdf->Cell(31, 5, utf8_decode($egresos_dato["siaf"]),null,null,'R');

        $egresos_monto_dato = number_format($egresos_dato["monto"], 2, '.', ','); //convertir int a decimal
        $importe_total = $importe_total + $egresos_dato["monto"];


        $pdf->Cell(33, 5, utf8_decode($egresos_monto_dato),null,null,'R');

        $egresos_dato["egresos"] = number_format($egresos_dato["egresos"], 2, '.', ','); //convertir int a decimal

        $pdf->Cell(33, 5, utf8_decode($egresos_dato["egresos"]),null,null,'R');

        $egresos_dato["ingresos"] = number_format($egresos_dato["ingresos"], 2, '.', ','); //convertir int a decimal

        $pdf->Cell(26, 5, utf8_decode($egresos_dato["ingresos"]),null,null,'R');


        $i++;
        $pdf->Ln();
    }



    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', 'U', 8);  //fuente
    $pdf->Cell(1); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('                                                                                                                                                                                                                                                                                                                                                     ')); //texto


    $pdf->Ln(5); //salto de linea
    $pdf->SetFont('Arial', 'B', 8);  //fuente
    $pdf->Cell(5); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('TOTAL')); //texto

    $importe_total = number_format($importe_total, 2, '.', ','); //convertir int a decimal

    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', 'B', 8);  //fuente
    $pdf->Cell(185); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('S/. ' . $importe_total)); //texto

    $pdf->Ln(2); //salto de linea
    $pdf->SetFont('Arial', 'U', 8);  //fuente
    $pdf->Cell(1); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('                                                                                                                                                                                                                                                                                                                                                     ')); //texto

}

$pdf->Output('Reporte de Estado de Cuenta.pdf', 'I');