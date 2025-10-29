<?php
include ('../../config.php');
session_start();

$codigo_pago= $_GET['codigo_pago'];
$modalidad= $_GET['modalidad'];
$concepto= $_GET['concepto'];
$referencia= $_GET['referencia'];
$dependencia= $_GET['dependencia'];
$id_tasas_tarifas= $_GET['id_tasas_tarifas'];

$_SESSION['codigo_pago'] = $codigo_pago;
$_SESSION['modalidad'] = $modalidad;
$_SESSION['concepto'] = $concepto;
$_SESSION['referencia'] = $referencia;
$_SESSION['dependencia'] = $dependencia;
$_SESSION['id_tasas_tarifas'] = $id_tasas_tarifas;





