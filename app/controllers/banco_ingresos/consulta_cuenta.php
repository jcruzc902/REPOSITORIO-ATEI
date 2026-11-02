<?php
#combobox anidado segun el cargo seleccionado que haga un listado de actividad principal
include('../../config.php');

$nombre_banco= $_POST['nombre_banco'];


$sql_cuenta = "SELECT 
cuenta.id_cta_ingresos as id_cta_ingresos,
cuenta.numero_cta as numero_cta_ingresos,
cuenta.id_banco as id_banco_ingresos,
banco_ingresos.nombre_banco as nombre_banco_ingresos 
FROM tb_cuenta_ingresos as cuenta 
INNER JOIN tb_banco_ingresos as banco_ingresos ON banco_ingresos.id_banco_ingreso= cuenta.id_cta_ingresos 
where cuenta.visible!=1 and banco_ingresos.nombre_banco='".$nombre_banco."' ORDER BY cuenta.numero_cta ASC ";
$query_cuenta = $pdo->prepare($sql_cuenta);
$query_cuenta->execute();
$cuenta_datos = $query_cuenta->fetchAll(PDO::FETCH_ASSOC);


    $html = "<option value=''>SELECCIONAR</option>";

foreach($cuenta_datos as $cuenta_dato){

    $html .= "<option value='".$cuenta_dato["numero_cta_ingresos"]."'>".$cuenta_dato["numero_cta_ingresos"]."</option>";
}

echo $html;