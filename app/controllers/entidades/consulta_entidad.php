<?php
#combobox anidado segun razon social seleccionado que muestre el nro ruc
include('../../config.php');

$id_empresa= $_POST['id_empresa'];

$sql_empresas = "SELECT * FROM tb_empresas where id_empresa='".$id_empresa."'";
$query_empresas = $pdo->prepare($sql_empresas);
$query_empresas->execute();
$empresas_datos = $query_empresas->fetchAll(PDO::FETCH_ASSOC);




foreach($empresas_datos as $empresas_dato){

    $html= "<option value='".$empresas_dato["id_empresa"]."'>".$empresas_dato["ruc"]."</option>";
}

echo $html;