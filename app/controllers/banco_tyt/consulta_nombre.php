<?php
#combobox anidado segun el cargo seleccionado que haga un listado de actividad principal
include('../../config.php');

$numero_cuenta= $_POST['numero_cuenta'];

$sql_nombre_cuenta = "SELECT 
nombre_cuenta.id_nombre_cuenta as id_nombre_cuenta,
nombre_cuenta.nombre_cuenta as nombre_cuenta,
nombre_cuenta.id_numero_cuenta as id_numero_cuenta,
cuenta_tyt.numero_cuenta_tyt as numero_cuenta_tyt 
FROM tb_nombre_cuenta as nombre_cuenta 
INNER JOIN tb_cuenta_tyt as cuenta_tyt ON cuenta_tyt.id_cuenta_tyt= nombre_cuenta.id_numero_cuenta
where nombre_cuenta.visible!=1 and cuenta_tyt.numero_cuenta_tyt='".$numero_cuenta."' ORDER BY nombre_cuenta.nombre_cuenta ASC ";
$query_nombre_cuenta = $pdo->prepare($sql_nombre_cuenta);
$query_nombre_cuenta->execute();
$nombre_cuenta_datos = $query_nombre_cuenta->fetchAll(PDO::FETCH_ASSOC);


    //$html = "<option value=''>SELECCIONAR</option>";

foreach($nombre_cuenta_datos as $nombre_cuenta_dato){

    $html .= "<option value='".$nombre_cuenta_dato["nombre_cuenta"]."'>".$nombre_cuenta_dato["nombre_cuenta"]."</option>";
}

echo $html;