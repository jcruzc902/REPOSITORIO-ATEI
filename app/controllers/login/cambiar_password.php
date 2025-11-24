<?php
/**
 
 * Date: 20/1/2023
 * Time: 08:51
 */


include('../../config.php');

$usuario = $_POST['usuario'];
$password = $_POST['password'];
$password_repeat = $_POST['password_repeat'];


$sql_usuarios = "SELECT id_usuario,email,usuario FROM tb_usuarios where usuario='$usuario'";
$query_usuarios = $pdo->prepare($sql_usuarios);
$query_usuarios->execute();
$usuarios_datos = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios_datos as $usuarios_dato) {
    $usuario = $usuarios_dato['usuario'];
    $email = $usuarios_dato['email'];
    $id_usuario = $usuarios_dato['id_usuario'];
}

if ($password == $password_repeat) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sentencia = $pdo->prepare("UPDATE tb_usuarios
    SET password_user=:password_user,
        fyh_actualizacion=:fyh_actualizacion 
    WHERE usuario = :usuario ");

    $sentencia->bindParam('password_user', $password);
    $sentencia->bindParam('fyh_actualizacion', $fechaHora);
    $sentencia->bindParam('usuario', $usuario);
    $sentencia->execute();
    session_start();
    $_SESSION['mensaje'] = "Se actualizo la contraseña de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/login/');

} else {
    // echo "error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Las contraseñas no son iguales. Intente nuevamente";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/login/cambiar_clave.php?id='.$id_usuario);
}



