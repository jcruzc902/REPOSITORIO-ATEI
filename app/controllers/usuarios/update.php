<?php
/**
 
 * Date: 20/1/2023
 * Time: 08:51
 */


include('../../config.php');

session_start();
if(isset($_SESSION['sesion_user_sistemadedevoluciondedinero'])){
    // echo "si existe sesion de ".$_SESSION['sesion_email'];
    $user_sesion = $_SESSION['sesion_user_sistemadedevoluciondedinero'];
    $sql = "SELECT us.id_usuario as id_usuario, us.nombres as nombres, us.apaterno as apaterno, us.amaterno as amaterno, us.email as email, us.usuario as usuario, rol.rol as rol 
                  FROM tb_usuarios as us INNER JOIN tb_roles as rol ON us.id_rol = rol.id_rol WHERE usuario='$user_sesion'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($usuarios as $usuario){
        $id_usuario_sesion = $usuario['id_usuario'];
        $nombres_sesion = $usuario['nombres'];
        $apaterno_sesion= $usuario['apaterno'];
        $amaterno_sesion= $usuario['amaterno'];
        $email= $usuario['email'];
        $user= $usuario['usuario'];
        $rol_sesion = $usuario['rol'];
    }
    
    
}

$operador= mb_strtoupper($nombres_sesion.' '.$apaterno_sesion.' '.$amaterno_sesion);

$nombres = mb_strtoupper($_POST['nombres']);
$apaterno = mb_strtoupper($_POST['apaterno']);
$amaterno = mb_strtoupper($_POST['amaterno']);
$email = $_POST['email'];
$user = $_POST['user'];
$estado = $_POST['estado'];
$password_user = $_POST['password_user'];
$password_repeat = $_POST['password_repeat'];
$id_usuario = $_POST['id_usuario'];
$rol = $_POST['rol'];

if ($estado == 2 && $password_user == "" && $password_repeat == "") {
    $sentencia = $pdo->prepare("UPDATE tb_usuarios
        SET nombres=:nombres,
            apaterno=:apaterno,
            amaterno=:amaterno,
            email=:email,
            usuario=:usuario,
            id_rol=:id_rol,
            id_estado=:id_estado,
            operador=:operador,
            fyh_actualizacion=:fyh_actualizacion 
        WHERE id_usuario = :id_usuario ");

    $sentencia->bindParam('nombres', $nombres);
    $sentencia->bindParam('apaterno', $apaterno);
    $sentencia->bindParam('amaterno', $amaterno);
    $sentencia->bindParam('email', $email);
    $sentencia->bindParam('usuario', $user);
    $sentencia->bindParam('id_rol', $rol);
    $sentencia->bindParam('id_estado', $estado);
    $sentencia->bindParam('operador', $operador);
    $sentencia->bindParam('fyh_actualizacion', $fechaHora);
    $sentencia->bindParam('id_usuario', $id_usuario);
    $sentencia->execute();
    session_start();
    $_SESSION['mensaje'] = "Se actualizo al usuario de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/usuarios/');
} else if ($estado == 2 && $password_user != "" && $password_repeat != "") {
    if ($password_user == $password_repeat) {
        $password_user = password_hash($password_user, PASSWORD_DEFAULT);
        $sentencia = $pdo->prepare("UPDATE tb_usuarios
        SET nombres=:nombres,
            apaterno=:apaterno,
            amaterno=:amaterno,
            email=:email,
            usuario=:usuario,
            id_rol=:id_rol,
            id_estado=:id_estado,
            operador=:operador,
            password_user=:password_user,
            fyh_actualizacion=:fyh_actualizacion 
        WHERE id_usuario = :id_usuario ");

        $sentencia->bindParam('nombres', $nombres);
        $sentencia->bindParam('apaterno', $apaterno);
        $sentencia->bindParam('amaterno', $amaterno);
        $sentencia->bindParam('email', $email);
        $sentencia->bindParam('usuario', $user);
        $sentencia->bindParam('id_rol', $rol);
        $sentencia->bindParam('id_estado', $estado);
        $sentencia->bindParam('operador', $operador);
        $sentencia->bindParam('password_user', $password_user);
        $sentencia->bindParam('fyh_actualizacion', $fechaHora);
        $sentencia->bindParam('id_usuario', $id_usuario);
        $sentencia->execute();
        session_start();
        $_SESSION['mensaje'] = "Se actualizo al usuario de la manera correcta";
        $_SESSION['icono'] = "success";
        header('Location: ' . $URL . '/usuarios/');

    } else {
        // echo "error las contraseñas no son iguales";
        session_start();
        $_SESSION['mensaje'] = "Error las contraseñas no son iguales";
        $_SESSION['icono'] = "error";
        header('Location: ' . $URL . '/usuarios/update.php?id=' . $id_usuario);
    }
} else if ($estado == 3 && $password_user == "" && $password_repeat == "") {
    $password_user= mt_rand(100000,999999); //genera numero aleatorio
    $password_user = password_hash($password_user, PASSWORD_DEFAULT);
    $sentencia = $pdo->prepare("UPDATE tb_usuarios
        SET nombres=:nombres,
            apaterno=:apaterno,
            amaterno=:amaterno,
            email=:email,
            usuario=:usuario,
            id_rol=:id_rol,
            id_estado=:id_estado,
            operador=:operador,
            password_user=:password_user,
            fyh_actualizacion=:fyh_actualizacion 
        WHERE id_usuario = :id_usuario ");

    $sentencia->bindParam('nombres', $nombres);
    $sentencia->bindParam('apaterno', $apaterno);
    $sentencia->bindParam('amaterno', $amaterno);
    $sentencia->bindParam('email', $email);
    $sentencia->bindParam('usuario', $user);
    $sentencia->bindParam('id_rol', $rol);
    $sentencia->bindParam('id_estado', $estado);
    $sentencia->bindParam('operador', $operador);
    $sentencia->bindParam('password_user', $password_user);
    $sentencia->bindParam('fyh_actualizacion', $fechaHora);
    $sentencia->bindParam('id_usuario', $id_usuario);
    $sentencia->execute();
    session_start();
    $_SESSION['mensaje'] = "Se actualizo al usuario de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/usuarios/');
} else if($estado == 3 && $password_user != "" && $password_repeat != ""){
    if ($password_user == $password_repeat) {
        $password_user = password_hash($password_user, PASSWORD_DEFAULT);
        $sentencia = $pdo->prepare("UPDATE tb_usuarios
        SET nombres=:nombres,
            apaterno=:apaterno,
            amaterno=:amaterno,
            email=:email,
            usuario=:usuario,
            id_rol=:id_rol,
            id_estado=:id_estado,
            operador=:operador,
            password_user=:password_user,
            fyh_actualizacion=:fyh_actualizacion 
        WHERE id_usuario = :id_usuario ");

        $sentencia->bindParam('nombres', $nombres);
        $sentencia->bindParam('apaterno', $apaterno);
        $sentencia->bindParam('amaterno', $amaterno);
        $sentencia->bindParam('email', $email);
        $sentencia->bindParam('usuario', $user);
        $sentencia->bindParam('id_rol', $rol);
        $sentencia->bindParam('id_estado', $estado);
        $sentencia->bindParam('operador', $operador);
        $sentencia->bindParam('password_user', $password_user);
        $sentencia->bindParam('fyh_actualizacion', $fechaHora);
        $sentencia->bindParam('id_usuario', $id_usuario);
        $sentencia->execute();
        session_start();
        $_SESSION['mensaje'] = "Se actualizo al usuario de la manera correcta";
        $_SESSION['icono'] = "success";
        header('Location: ' . $URL . '/usuarios/');

    } else {
        // echo "error las contraseñas no son iguales";
        session_start();
        $_SESSION['mensaje'] = "Error las contraseñas no son iguales";
        $_SESSION['icono'] = "error";
        header('Location: ' . $URL . '/usuarios/update.php?id=' . $id_usuario);
    }
}






