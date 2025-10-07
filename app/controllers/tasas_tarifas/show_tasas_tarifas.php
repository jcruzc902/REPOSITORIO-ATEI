<?php

#puede ser anio periodo falla
$id_tasas_tarifas = $_GET['id'];

$sql_tasas_tarifas = "SELECT tyt.id_tasas_tarifas as id_tasas_tarifas, 
tyt.codigo_pago as codigo_pago, 
tyt.modalidad as modalidad, 
tyt.concepto as concepto, 
#tyt.monto as monto, 
tyt.referencia as referencia, 
tyt.clasificador as clasificador, 
tyt.codigo_facultad as codigo_facultad, 
tyt.dependencia as dependencia, 
tyt.codigo_ser_banco as codigo_ser_banco, 
tyt.banco as banco, 
tyt.cta as cta, 
#tyt.resolucion as resolucion,
#tyt.archivo_resolucion as archivo_resolucion, 
tyt.vigencia as vigencia, 
tyt.situacion as situacion,
tyt.categoria_transaccion as categoria_transaccion,
tyt.observacion as observacion,
estado_tasas.id_estado_tasas as id_estado,
estado_tasas.nombre_estado_tasas as estado,
usuario.id_usuario as id_usuario,
usuario.nombres as nombres,
usuario.apaterno as apaterno, 
usuario.amaterno as amaterno, 
tyt.fyh_creacion as fyh_creacion_tyt 
FROM tb_tasas_tarifas as tyt 
INNER JOIN tb_usuarios as usuario ON usuario.id_usuario= tyt.id_usuario 
LEFT JOIN tb_estado_tasas as estado_tasas ON estado_tasas.id_estado_tasas= tyt.id_estado
WHERE tyt.id_tasas_tarifas='$id_tasas_tarifas'";
$query_tasas_tarifas = $pdo->prepare($sql_tasas_tarifas);
$query_tasas_tarifas->execute();
$tasas_tarifas_datos = $query_tasas_tarifas->fetchAll(PDO::FETCH_ASSOC);

foreach ($tasas_tarifas_datos as $tasas_tarifas_dato) {
    $id_tasas_tarifas = $tasas_tarifas_dato["id_tasas_tarifas"];
    $codigo_pago = $tasas_tarifas_dato["codigo_pago"];
    $modalidad = $tasas_tarifas_dato["modalidad"];
    $concepto = $tasas_tarifas_dato["concepto"];
    #$monto = $tasas_tarifas_dato["monto"];
    $referencia = $tasas_tarifas_dato["referencia"];
    $clasificador = $tasas_tarifas_dato["clasificador"];
    $codigo_facultad = $tasas_tarifas_dato["codigo_facultad"];
    $dependencia = $tasas_tarifas_dato["dependencia"];
    $codigo_ser_banco = $tasas_tarifas_dato["codigo_ser_banco"];
    $banco = $tasas_tarifas_dato["banco"];
    $cta = $tasas_tarifas_dato["cta"];
    #$resolucion = $tasas_tarifas_dato["resolucion"];
    #$archivo_resolucion = $tasas_tarifas_dato["archivo_resolucion"];
    $vigencia = $tasas_tarifas_dato["vigencia"];
    $situacion = $tasas_tarifas_dato["situacion"];
    $categoria_transaccion = $tasas_tarifas_dato["categoria_transaccion"];
    $observacion = $tasas_tarifas_dato["observacion"];
    $estado = $tasas_tarifas_dato["estado"];
    $fyh_creacion_tyt = $tasas_tarifas_dato["fyh_creacion_tyt"];
    $usuario = $tasas_tarifas_dato["nombres"].' '.$tasas_tarifas_dato["apaterno"].' '.$tasas_tarifas_dato["amaterno"];  

}
