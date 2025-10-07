<?php
/**
 
 * Date: 18/1/2023
 * Time: 15:17
 */
include ('../../config.php');
require_once ('../../librerias/PHP_EXCEL/PhpXlsxGenerator.php');

$fileName = "REPORTE DE EMPRESAS " . date('d-m-Y H:i:s') . ".xlsx";
$excelData[] = array('ID', 'Razon Social', 'RUC', 'Fecha de Registro', 'Fecha de Actualizacion');

$contador = 0;

$sql_empresas = "SELECT * FROM tb_empresas where razon_social!='SELECCIONAR' and visible!=1";
$query_empresas = $pdo->prepare($sql_empresas);
$query_empresas->execute();
$empresas_datos = $query_empresas->fetchAll(PDO::FETCH_ASSOC);

foreach ($empresas_datos as $empresas_dato) {
        

    $lineData = array(
        $contador = $contador + 1,
        $empresas_dato['razon_social'],
        $empresas_dato['ruc'],
        $empresas_dato['fyh_creacion'],
        $empresas_dato['fyh_actualizacion']
    );

    $excelData[] = $lineData;
}

//Export data to excel and download as xlsx file
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx->downloadAs($fileName);

