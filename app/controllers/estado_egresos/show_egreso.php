<?php

#puede ser anio periodo falla
$id_egreso = $_GET['id'];

$sql_egresos = "SELECT egresos.id_egresos as id_egresos,
    egresos.cargo_facultad as cargo_facultad,
    egresos.actividad_principal as actividad_principal,
    egresos.saldo_inicial as saldo_inicial,
    egresos.anio as anio_periodo,
    egresos.fyh_creacion as fyh_creacion_egreso,
    egresos.id_estado as id_estado_egreso,
    estado_egreso.nombre_estado_egreso as estado_egreso,
    usuarios.nombres as nombres_usuario,
    usuarios.apaterno as apaterno_usuario,
    usuarios.amaterno as amaterno_usuario
    FROM tb_egresos as egresos 
    INNER JOIN tb_estado_egreso as estado_egreso ON estado_egreso.id_estado_egreso = egresos.id_estado
    INNER JOIN tb_usuarios as usuarios ON usuarios.id_usuario = egresos.id_usuario
    WHERE egresos.id_egresos='$id_egreso'";
$query_egresos = $pdo->prepare($sql_egresos);
$query_egresos->execute();
$egresos_datos = $query_egresos->fetchAll(PDO::FETCH_ASSOC);

foreach ($egresos_datos as $egresos_dato) {
    $id_egresos = $egresos_dato["id_egresos"];
    $cargo_facultad = $egresos_dato["cargo_facultad"];
    $actividad_principal = $egresos_dato["actividad_principal"];
    $saldo_inicial= $egresos_dato["saldo_inicial"];
    $anio_periodo = $egresos_dato["anio_periodo"];
    $estado_egreso = $egresos_dato["estado_egreso"];
    $fyh_creacion_egreso = $egresos_dato["fyh_creacion_egreso"];
    $usuario = $egresos_dato["nombres_usuario"].' '.$egresos_dato["apaterno_usuario"].' '.$egresos_dato["amaterno_usuario"];  

}
