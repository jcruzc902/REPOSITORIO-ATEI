<?php
#combobox anidado segun el cargo seleccionado que haga un listado de actividad principal
include('../../config.php');

$nombre_banco= $_POST['nombre_banco'];

$sql_cuenta = "SELECT 
cuenta.id_cuenta_tyt as id_cuenta_tyt,
cuenta.numero_cuenta_tyt as numero_cuenta_tyt,
cuenta.id_banco as id_banco,
banco_tyt.nombre_banco as nombre_banco 
FROM tb_cuenta_tyt as cuenta 
INNER JOIN tb_banco_tyt as banco_tyt ON banco_tyt.id_banco_tyt= cuenta.id_banco 
where cuenta.visible!=1 and banco_tyt.nombre_banco='".$nombre_banco."' ORDER BY cuenta.numero_cuenta_tyt ASC ";
$query_cuenta = $pdo->prepare($sql_cuenta);
$query_cuenta->execute();
$cuenta_datos = $query_cuenta->fetchAll(PDO::FETCH_ASSOC);


    $html = "<option value=''>SELECCIONAR</option>";

foreach($cuenta_datos as $cuenta_dato){

    $html .= "<option value='".$cuenta_dato["numero_cuenta_tyt"]."'>".$cuenta_dato["numero_cuenta_tyt"]."</option>";
}

echo $html;