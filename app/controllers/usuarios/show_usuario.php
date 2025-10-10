<?php


$id_usuario_get = $_GET['id'];

$sql_usuarios = "SELECT *, us.fyh_creacion as fyh_registro, rol.rol as rol, est.nombre_estado as estado 
                  FROM tb_usuarios as us 
                  INNER JOIN tb_roles as rol ON rol.id_rol = us.id_rol 
                  INNER JOIN tb_estado as est ON est.id_estado = us.id_estado
                  where id_usuario = '$id_usuario_get' ";
$query_usuarios = $pdo->prepare($sql_usuarios);
$query_usuarios->execute();
$usuarios_datos = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios_datos as $usuarios_dato){
    $nombres = $usuarios_dato['nombres'];
    $email = $usuarios_dato['email'];
    $rol = $usuarios_dato['rol'];
    $apaterno = $usuarios_dato['apaterno'];
    $amaterno = $usuarios_dato['amaterno'];
    $user = $usuarios_dato['usuario'];
    $estado = $usuarios_dato['estado'];
    $fyh_registro= $usuarios_dato['fyh_registro'];
}