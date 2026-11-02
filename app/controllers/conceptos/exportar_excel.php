<?php
/**
 
 * Date: 18/1/2023
 * Time: 15:17
 */
include ('../../config.php');
require_once ('../../librerias/PHP_EXCEL/PhpXlsxGenerator.php');

$fileName = "REPORTE DE CONCEPTOS " . date('d-m-Y H:i:s') . ".xlsx";
$excelData[] = array('ID', 'Nombre de Concepto', 'Fecha de Registro', 'Fecha de Actualizacion');

$contador = 0;

$sql_conceptos = "SELECT * FROM tb_conceptos where visible!=1 and id_concepto!=1";
$query_conceptos = $pdo->prepare($sql_conceptos);
$query_conceptos->execute();
$conceptos_datos = $query_conceptos->fetchAll(PDO::FETCH_ASSOC);

foreach ($conceptos_datos as $conceptos_dato) {
        

    $lineData = array(
        $contador = $contador + 1,
        $conceptos_dato['nombre'],
        $conceptos_dato['fyh_creacion'],
        $conceptos_dato['fyh_actualizacion']
    );

    $excelData[] = $lineData;
}

//Export data to excel and download as xlsx file
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx->downloadAs($fileName);