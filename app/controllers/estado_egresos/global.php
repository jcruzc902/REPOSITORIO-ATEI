<?php
include('../../config.php');
session_start();

$facultad = $_GET['facultad'];
$actividad = $_GET['actividad'];
$subactividad = $_GET['subactividad'];
$saldo_inicial = $_GET['saldo_inicial'];
$periodo = $_GET['periodo'];
$id_egresos = $_GET['id_egresos'];



$_SESSION['facultad'] = $facultad;
$_SESSION['actividad'] = $actividad;
$_SESSION['subactividad'] = $subactividad;
$_SESSION['saldo_inicial'] = $saldo_inicial;
$_SESSION['periodo'] = $periodo;
$_SESSION['id_egresos'] = $id_egresos;







