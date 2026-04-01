<?php
/**
 
 * Date: 18/1/2023
 * Time: 15:17
 */


$sql_usuarios = "SELECT * FROM tb_usuarios as us 
                  INNER JOIN tb_roles as rol ON rol.id_rol =  us.id_rol
                  INNER JOIN tb_estado as estado ON estado.id_estado = us.id_estado where us.visible!=1";
$query_usuarios = $pdo->prepare($sql_usuarios);
$query_usuarios->execute();
$usuarios_datos = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);