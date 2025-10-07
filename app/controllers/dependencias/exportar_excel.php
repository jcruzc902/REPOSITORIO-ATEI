<?php
/**
 
 * Date: 18/1/2023
 * Time: 15:17
 */
include ('../../config.php');
require_once ('../../librerias/PHP_EXCEL/PhpXlsxGenerator.php');

$fileName = "REPORTE DE DEPENDENCIAS " . date('d-m-Y H:i:s') . ".xlsx";
$excelData[] = array('ID', 'Nombre de Dependencia', 'Fecha de Registro', 'Fecha de Actualizacion');

$contador = 0;

$sql_dependencias = "SELECT * FROM tb_dependencias where nombre!='SELECCIONAR' and visible!=1";
$query_dependencias = $pdo->prepare($sql_dependencias);
$query_dependencias->execute();
$dependencias_datos = $query_dependencias->fetchAll(PDO::FETCH_ASSOC);

foreach ($dependencias_datos as $dependencias_dato) {
        

    $lineData = array(
        $contador = $contador + 1,
        $dependencias_dato['nombre'],
        $dependencias_dato['fyh_creacion'],
        $dependencias_dato['fyh_actualizacion']
    );

    $excelData[] = $lineData;
}

//Export data to excel and download as xlsx file
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx->downloadAs($fileName);

