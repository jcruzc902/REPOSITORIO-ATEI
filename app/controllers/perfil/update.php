<?php
/**
 
 * Date: 20/1/2023
 * Time: 08:51
 */


include('../../config.php');

$nombres = $_POST['nombres'];
$apaterno = $_POST['apaterno'];
$amaterno = $_POST['amaterno'];
$email = $_POST['email'];
$user = $_POST['user'];
$password_user = $_POST['password_user'];
$password_repeat = $_POST['password_repeat'];
$id_usuario = $_POST['id_usuario'];

if ($password_user == "") {
    if ($password_user == $password_repeat) {
        $password_user = password_hash($password_user, PASSWORD_DEFAULT);
        $sentencia = $pdo->prepare("UPDATE tb_usuarios
    SET nombres=:nombres,
        apaterno=:apaterno,
        amaterno=:amaterno,
        email=:email,
        usuario=:usuario,
        fyh_actualizacion=:fyh_actualizacion 
    WHERE id_usuario = :id_usuario ");

        $sentencia->bindParam('nombres', $nombres);
        $sentencia->bindParam('apaterno', $apaterno);
        $sentencia->bindParam('amaterno', $amaterno);
        $sentencia->bindParam('email', $email);
        $sentencia->bindParam('usuario', $user);
        $sentencia->bindParam('fyh_actualizacion', $fechaHora);
        $sentencia->bindParam('id_usuario', $id_usuario);
        $sentencia->execute();
        session_start();
        $_SESSION['mensaje'] = "Se actualizo el perfil correctamente";
        $_SESSION['icono'] = "success";
        header('Location: ' . $URL );

    } else {
        // echo "error las contraseñas no son iguales";
        session_start();
        $_SESSION['mensaje'] = "Error las contraseñas no son iguales";
        $_SESSION['icono'] = "error";
        header('Location: ' . $URL . '/perfil/update.php?id=' . $id_usuario);
    }

} else {
    if ($password_user == $password_repeat) {
        $password_user = password_hash($password_user, PASSWORD_DEFAULT);
        $sentencia = $pdo->prepare("UPDATE tb_usuarios
    SET nombres=:nombres,
        apaterno=:apaterno,
        amaterno=:amaterno,
        email=:email,
        usuario=:usuario,
        password_user=:password_user,
        fyh_actualizacion=:fyh_actualizacion 
    WHERE id_usuario = :id_usuario ");

        $sentencia->bindParam('nombres', $nombres);
        $sentencia->bindParam('apaterno', $apaterno);
        $sentencia->bindParam('amaterno', $amaterno);
        $sentencia->bindParam('email', $email);
        $sentencia->bindParam('usuario', $user);
        $sentencia->bindParam('password_user', $password_user);
        $sentencia->bindParam('fyh_actualizacion', $fechaHora);
        $sentencia->bindParam('id_usuario', $id_usuario);
        $sentencia->execute();
        session_start();
        $_SESSION['mensaje'] = "Se actualizo el perfil correctamente";
        $_SESSION['icono'] = "success";
        header('Location: ' . $URL );

    } else {
        // echo "error las contraseñas no son iguales";
        session_start();
        $_SESSION['mensaje'] = "Error las contraseñas no son iguales";
        $_SESSION['icono'] = "error";
        header('Location: ' . $URL . '/perfil/update.php?id=' . $id_usuario);
    }

}

