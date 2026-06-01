<?php


$id_cheque_get = $_GET['id'];

$sql_cheques = "SELECT cheque.id_cheque as id_cheque,
    cheque.nt as nt,
    cheque.id_anio_nt as id_anio_nt,
    anio_nt.anio_nt as nt_anio,
    cheque.proveido_diga as proveido_diga,
    cheque.fecha_diga as fecha_diga,
    cheque.proveido_conta as proveido_conta,
    cheque.fecha_conta as fecha_conta,
    cheque.informe as informe,
    cheque.fecha_informe as fecha_informe,
    cheque.id_asunto as id_asunto,
    asunto.nombre_asunto as nombre_asunto,
    cheque.siaf as siaf,
    cheque.id_tipo_gasto as id_tipo_gasto,
    tipo_gasto.nombre_tipo_gasto as nombre_tipo_gasto,
    cheque.oficio as oficio,
    cheque.fecha_oficio as fecha_oficio,
    cheque.observacion as observacion,
    usuarios.id_usuario as id_usuario,
    usuarios.nombres as nombres_usuario,
    usuarios.apaterno as apellido_paterno,
    usuarios.amaterno as apellido_materno,
    cheque.fyh_creacion as fyh_creacion_cheque
    FROM tb_cheque as cheque 
    INNER JOIN tb_anio_nt as anio_nt ON anio_nt.id_anio_nt = cheque.id_anio_nt 
    INNER JOIN tb_asunto as asunto ON asunto.id_asunto = cheque.id_asunto 
    INNER JOIN tb_tipo_gasto as tipo_gasto ON tipo_gasto.id_tipo_gasto = cheque.id_tipo_gasto 
    INNER JOIN tb_usuarios as usuarios ON usuarios.id_usuario = cheque.id_usuario
    WHERE cheque.visible!=1 AND cheque.id_cheque='$id_cheque_get'";
$query_cheques = $pdo->prepare($sql_cheques);
$query_cheques->execute();
$cheques_datos = $query_cheques->fetchAll(PDO::FETCH_ASSOC);

foreach ($cheques_datos as $cheques_dato) {
    $id_cheque = $cheques_dato["id_cheque"];
    $nt= $cheques_dato["nt"];
    $id_anio_nt= $cheques_dato["id_anio_nt"];
    $nt_anio= $cheques_dato["nt_anio"];
    $proveido_diga= $cheques_dato["proveido_diga"];
    $fecha_diga= $cheques_dato["fecha_diga"];
    $proveido_conta= $cheques_dato["proveido_conta"];
    $fecha_conta= $cheques_dato["fecha_conta"];
    $informe= $cheques_dato["informe"];
    $fecha_informe= $cheques_dato["fecha_informe"];
    $id_asunto= $cheques_dato["id_asunto"];
    $nombre_asunto= $cheques_dato["nombre_asunto"];
    $siaf= $cheques_dato["siaf"];
    $id_tipo_gasto= $cheques_dato["id_tipo_gasto"];
    $nombre_tipo_gasto= $cheques_dato["nombre_tipo_gasto"];
    $oficio= $cheques_dato["oficio"];
    $fecha_oficio= $cheques_dato["fecha_oficio"];
    $observacion= $cheques_dato["observacion"];
    $id_usuario= $cheques_dato["id_usuario"];
    $usuario= $cheques_dato["nombres_usuario"]." ".$cheques_dato["apellido_paterno"]." ".$cheques_dato["apellido_materno"];
    $fyh_creacion_cheque= $cheques_dato["fyh_creacion_cheque"];

}
