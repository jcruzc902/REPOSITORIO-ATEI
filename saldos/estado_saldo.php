<?php

include ('../app/config.php');
include ('../layout/sesion.php');


include ('../app/controllers/saldos/show_saldo.php');


require ('../app/librerias/FPDF/fpdf.php');

$sql_saldo_bancario = "SELECT saldo_banco.id_saldo_banco as id_saldo_banco,
    saldo_banco.nombre_banco as nombre_banco,
    saldo_banco.numero_cuenta as numero_cuenta,
    saldo_banco.nombre_cuenta as nombre_cuenta,
    cuenta_saldo.id_cuenta_saldo as id_cuenta_saldo,
    cuenta_saldo.cuenta_saldo as cuenta_saldo,
    saldo_banco.fecha as fecha,
    saldo_banco.monto as monto_saldo,
    situacion_saldo.id_situacion_saldo as id_situacion_saldo,
    situacion_saldo.nombre_situacion as nombre_situacion,
    saldo_banco.detalle_cuenta as detalle_cuenta,
    estado_saldo.id_estado_saldo as id_estado_saldo,
    estado_saldo.nombre_estado as nombre_estado,
    saldo_banco.observacion as observacion,
    usuarios.id_usuario as id_usuario,
    usuarios.nombres as nombres,
    usuarios.apaterno as apaterno,
    usuarios.amaterno as amaterno,
    saldo_banco.fyh_creacion as fyh_creacion
    FROM tb_saldo_banco as saldo_banco 
    LEFT JOIN tb_cuenta_saldo as cuenta_saldo ON cuenta_saldo.id_cuenta_saldo = saldo_banco.tipo_cuenta 
    LEFT JOIN tb_situacion_saldo as situacion_saldo ON situacion_saldo.id_situacion_saldo = saldo_banco.situacion 
    LEFT JOIN tb_estado_saldo as estado_saldo ON estado_saldo.id_estado_saldo = saldo_banco.estado 
    LEFT JOIN tb_usuarios as usuarios ON usuarios.id_usuario = saldo_banco.id_usuario
    WHERE saldo_banco.id_saldo_banco='$id_saldo_bancario'";
$query_saldo_bancario = $pdo->prepare($sql_saldo_bancario);
$query_saldo_bancario->execute();
$saldo_bancario_datos = $query_saldo_bancario->fetchAll(PDO::FETCH_ASSOC);

class PDF extends FPDF
{


    public function header()
    {
        $this->Image('../public/images/logo2_unfv.jpg', 15, 8, 70);

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
        $this->Cell(60); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('ESTADO DE SALDO BANCARIO')); //texto

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


        $this->Ln(7); //salto de linea

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
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(TRUE, 15);

//CUADRO
$pdf->Ln(9); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(1); //mover a la derecha
$pdf->Cell(187, 200, "", 1, 0, 'C', 0);

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(5); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Banco:')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(18); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($nombre_banco)); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(5); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Cuenta:')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(18); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($numero_cuenta)); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(5); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Nombre:')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(18); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($nombre_cuenta)); //texto

/*
$pdf->Ln(5); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(5); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Detalle de la cuenta:')); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(5); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($detalle_cuenta)); //texto
*/






$pdf->Line(15, 95, 194, 95); //LINEA

$pdf->Ln(12); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(7); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('N°')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(20); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Tipo Cuenta')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(70); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Situacion')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(108); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Fecha Saldo')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(155); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Monto')); //texto




$pdf->Line(15, 100, 194, 100); //LINEA

$i=1;
$total_saldo= 0.00;
$pdf->Ln(10); //salto de linea

foreach ($saldo_bancario_datos as $saldo_bancario_dato) {
    
    if($saldo_bancario_dato["cuenta_saldo"]=="SELECCIONAR"){
        $saldo_bancario_dato["cuenta_saldo"]="";
    }

    if($saldo_bancario_dato["nombre_situacion"]=="SELECCIONAR"){
        $saldo_bancario_dato["nombre_situacion"]="";
    }

    


    $pdf->SetFont('Arial', '', 8); //fuente
    $pdf->Cell(7); //mover a la derecha
    $pdf->Cell(13, 5, utf8_decode($i));
    $pdf->Cell(50, 5, utf8_decode($saldo_bancario_dato["cuenta_saldo"]));
    $pdf->Cell(38, 5, utf8_decode($saldo_bancario_dato["nombre_situacion"]));
    
    if($saldo_bancario_dato["fecha"]=="0000-00-00"){
        $saldo_bancario_dato["fecha"]="";
    }else{
        $theDate = new DateTime($saldo_bancario_dato["fecha"]);
        $saldo_bancario_dato["fecha"] = $theDate->format('d/m/Y');
    }
    

    $pdf->Cell(47, 5, utf8_decode($saldo_bancario_dato["fecha"]));

    $saldo_bancario_dato["monto_saldo"]= number_format($saldo_bancario_dato["monto_saldo"],2,'.',',');

    $pdf->Cell(20, 5, utf8_decode($saldo_bancario_dato["monto_saldo"]));

    $total_saldo=$saldo_bancario_dato["monto_saldo"];
   
    

    $i++;
    $pdf->Ln();
}



$pdf->Ln(-4); //salto de linea
$pdf->SetFont('Arial', 'U', 8);  //fuente
$pdf->Cell(4); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('                                                                                                                                                                                                                                    ')); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Arial', 'B', 8);  //fuente
$pdf->Cell(140); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('TOTAL')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', '', 8);  //fuente
$pdf->Cell(155); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($total_saldo)); //texto


$pdf->Output('Estado de Saldo Bancario.pdf', 'I');