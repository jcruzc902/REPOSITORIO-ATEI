<?php
/**
 
 * Date: 18/1/2023
 * Time: 15:17
 */
include ('../../config.php');
require_once ('../../librerias/PHP_EXCEL/PhpXlsxGenerator.php');

$fileName = "REPORTE DE ROLES " . date('d-m-Y H:i:s') . ".xlsx";
$excelData[] = array('ID', 'Nombre de Rol', 'Modulo Devolucion', 'Modulo Cheques', 'Modulo Tasas y Tarifas', 'Modulo Saldo Bancarios', 'Modulo Estado Cuentas', 'Modulo Usuarios', 'Modulo Roles','Fecha de Registro', 'Fecha de Actualizacion');

$sql_roles = "SELECT * FROM tb_roles where visible!=1";
$query_roles = $pdo->prepare($sql_roles);
$query_roles->execute();
$roles_datos = $query_roles->fetchAll(PDO::FETCH_ASSOC);

foreach ($roles_datos as $roles_dato) {
        
    if($roles_dato['modulo_devolucion']=='YES'){
        $roles_dato['modulo_devolucion']= str_replace('YES','SI',$roles_dato['modulo_devolucion']);
    }

    if($roles_dato['modulo_cheques']=='YES'){
        $roles_dato['modulo_cheques']= str_replace('YES','SI',$roles_dato['modulo_cheques']);
    }

    if($roles_dato['modulo_tyt']=='YES'){
        $roles_dato['modulo_tyt']= str_replace('YES','SI',$roles_dato['modulo_tyt']);
    }

    if($roles_dato['modulo_saldo']=='YES'){
        $roles_dato['modulo_saldo']= str_replace('YES','SI',$roles_dato['modulo_saldo']);
    }

    if($roles_dato['modulo_estado_cta']=='YES'){
        $roles_dato['modulo_estado_cta']= str_replace('YES','SI',$roles_dato['modulo_estado_cta']);
    }

    if($roles_dato['modulo_usuario']=='YES'){
        $roles_dato['modulo_usuario']= str_replace('YES','SI',$roles_dato['modulo_usuario']);
    }

    if($roles_dato['modulo_roles']=='YES'){
        $roles_dato['modulo_roles']= str_replace('YES','SI',$roles_dato['modulo_roles']);
    }

    $lineData = array(
        $contador = $contador + 1,
        $roles_dato['rol'],
        $roles_dato['modulo_devolucion'],
        $roles_dato['modulo_cheques'],
        $roles_dato['modulo_tyt'],
        $roles_dato['modulo_saldo'],
        $roles_dato['modulo_estado_cta'],
        $roles_dato['modulo_usuario'],
        $roles_dato['modulo_roles'],
        $roles_dato['fyh_creacion'],
        $roles_dato['fyh_actualizacion']
    );

    $excelData[] = $lineData;
}

//Export data to excel and download as xlsx file
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx->downloadAs($fileName);

