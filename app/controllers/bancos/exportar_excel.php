<?php
/**
 
 * Date: 18/1/2023
 * Time: 15:17
 */
include ('../../config.php');
require_once ('../../librerias/PHP_EXCEL/PhpXlsxGenerator.php');

$fileName = "REPORTE DE BANCOS " . date('d-m-Y H:i:s') . ".xlsx";
$excelData[] = array('ID', 'Nombre de Banco', 'Fecha de Registro', 'Fecha de Actualizacion');

$contador = 0;

$sql_bancos = "SELECT * FROM tb_bancos where nombre_banco!='SELECCIONAR' and visible!=1";
$query_bancos = $pdo->prepare($sql_bancos);
$query_bancos->execute();
$bancos_datos = $query_bancos->fetchAll(PDO::FETCH_ASSOC);

foreach ($bancos_datos as $bancos_dato) {
        

    $lineData = array(
        $contador = $contador + 1,
        $bancos_dato['nombre_banco'],
        $bancos_dato['fyh_creacion'],
        $bancos_dato['fyh_actualizacion']
    );

    $excelData[] = $lineData;
}

//Export data to excel and download as xlsx file
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx->downloadAs($fileName);

