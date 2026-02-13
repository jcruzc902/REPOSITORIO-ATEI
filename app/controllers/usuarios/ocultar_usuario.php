<?php
/**
 
 * Date: 20/1/2023
 * Time: 10:19
 */

include ('../../config.php');

$id_usuario = $_POST['id_usuario'];
$visible = 1;
$password_user = mt_rand(100000, 999999); //genera numero aleatorio
$password_user = password_hash($password_user, PASSWORD_DEFAULT);

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



$sentencia = $pdo->prepare("UPDATE tb_usuarios 
SET password_user=:password_user, visible=:visible, operador=:operador,
fyh_actualizacion=:fyh_actualizacion WHERE id_usuario=:id_usuario");

$sentencia->bindParam('password_user', $password_user);
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('operador', $operador);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_usuario', $id_usuario);
$sentencia->execute();
session_start();
$_SESSION['mensaje'] = "Se elimino al usuario de la manera correcta";
$_SESSION['icono'] = "success";
header('Location: ' . $URL . '/usuarios/');

