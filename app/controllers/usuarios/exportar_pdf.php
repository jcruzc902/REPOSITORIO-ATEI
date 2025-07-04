<?php
include ('../../config.php');

require ('../../librerias/FPDF/fpdf.php');

session_start();

if (isset($_SESSION['array_datos_usuarios'])) {
    $usuarios_datos = $_SESSION['array_datos_usuarios'];
}

class PDF extends FPDF
{
    public function header()
    {
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
        $this->Cell(173); //mover a la derecha
        $this->Cell(40, 10, utf8_decode(date('H:i:s'))); //texto

        $this->SetY(30);
        $this->SetFont('Arial', 'B', 12); //fuente
        $this->Cell(74); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('REPORTE DE USUARIOS')); //texto

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

        $this->Line(10, 65, 200, 65); //LINEA

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(1); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('N°')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(20); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Nombres')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(70); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Correo')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(110); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Rol')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(134); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Usuario')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(152); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Estado')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(173); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('F. Registro')); //texto

        $this->Line(10, 75, 200, 75); //LINEA





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
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(TRUE, 15);

$i = 1;
if (!isset($usuarios_datos)) {
    $usuarios_datos = null;
} else {
    foreach ($usuarios_datos as $usuarios_dato) {
        $pdf->SetFont('Arial', '', 8); //fuente
        $pdf->Cell(1); //mover a la derecha
        $pdf->Cell(4, 5, utf8_decode($i));
        $pdf->Cell(65, 5, utf8_decode($usuarios_dato["nombres"] . ' ' . $usuarios_dato["apaterno"] . ' ' . $usuarios_dato["amaterno"]));
        $pdf->Cell(37, 5, utf8_decode($usuarios_dato["email"]));
        $pdf->Cell(26, 5, utf8_decode($usuarios_dato["rol"]));

        $usuarios_dato["usuario"]= substr($usuarios_dato["usuario"],0,9);

        $pdf->Cell(16, 5, utf8_decode($usuarios_dato["usuario"]));
        $pdf->Cell(24, 5, utf8_decode($usuarios_dato["nombre_estado"]));
        $theDate = new DateTime($usuarios_dato["fyh_creacion_usuario"]);
        $fecha_registro = $theDate->format('d/m/Y');
        $pdf->Cell(10, 5, utf8_decode($fecha_registro));

        $i++;
        $pdf->Ln();
    }
}


$pdf->Output('Reporte de Usuarios.pdf', 'I');