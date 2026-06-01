<?php
include ('../../config.php');
require_once ('../../librerias/PHP_EXCEL/PhpXlsxGenerator.php');

$fileName = "REPORTE DE USUARIOS " . date('d-m-Y H:i:s') . ".xlsx";



$excelData[] = array('ID', 'Nombres', 'Apellido Paterno', 'Apellido Materno', 'Correo', 'Rol del usuario', 'Estado', 'Usuario', 'Fecha de Registro', 'Fecha de Actualizacion','Operador');

$contador = 0;
session_start();

if (isset($_SESSION['array_datos_usuarios'])) {
    $usuarios_datos = $_SESSION['array_datos_usuarios'];
}

if (!isset($usuarios_datos)) {
    $usuarios_datos = null;
} else {
    foreach ($usuarios_datos as $usuarios_dato) {
        

        $lineData = array(
            $contador = $contador + 1,
            $usuarios_dato['nombres'],
            $usuarios_dato['apaterno'],
            $usuarios_dato['amaterno'],
            $usuarios_dato['email'],
            $usuarios_dato['rol'],
            $usuarios_dato['nombre_estado'],
            $usuarios_dato['usuario'],
            $usuarios_dato['fyh_creacion_usuario'],
            $usuarios_dato['fyh_actualizacion_usuario'],
            $usuarios_dato['operador']
        );

        $excelData[] = $lineData;
    }
}

//Export data to excel and download as xlsx file
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx->downloadAs($fileName);
