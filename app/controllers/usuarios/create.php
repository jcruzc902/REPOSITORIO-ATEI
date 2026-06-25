<?php
/**
 
 * Date: 18/1/2023
 * Time: 15:39
 */

include ('../../config.php');

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
$operador= $nombres_sesion.' '.$apaterno_sesion.' '.$amaterno_sesion;

$nombres = mb_strtoupper($_POST['nombres']);
$email = $_POST['email'];
$rol = $_POST['rol'];
$password_user = $_POST['password_user'];
$password_repeat = $_POST['password_repeat'];
$apaterno= mb_strtoupper($_POST['apaterno']);
$amaterno= mb_strtoupper($_POST['amaterno']);
$usuario= $_POST['usuario'];
$estado= $_POST['estado'];

if($password_user == $password_repeat){
    $password_user = password_hash($password_user, PASSWORD_DEFAULT);
    $sentencia = $pdo->prepare("INSERT INTO tb_usuarios
       ( nombres, apaterno, amaterno, email, id_rol, id_estado, operador, usuario, password_user, fyh_creacion) 
VALUES (:nombres,:apaterno,:amaterno,:email,:id_rol, :id_estado, :operador, :usuario,:password_user,:fyh_creacion)");

    $sentencia->bindParam('nombres',$nombres);
    $sentencia->bindParam('apaterno',$apaterno);
    $sentencia->bindParam('amaterno',$amaterno);
    $sentencia->bindParam('email',$email);
    $sentencia->bindParam('id_rol',$rol);
    $sentencia->bindParam('id_estado',$estado);
    $sentencia->bindParam('operador',$operador);
    $sentencia->bindParam('usuario',$usuario);
    $sentencia->bindParam('password_user',$password_user);
    $sentencia->bindParam('fyh_creacion',$fechaHora);
    $sentencia->execute();
    session_start();
    $_SESSION['mensaje'] = "Se registro al usuario de la manera correcta";
    $_SESSION['icono'] = 'success';
    header('Location: '.$URL.'/usuarios/');

}else{
   // echo "error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error las contraseñas no son iguales";
    $_SESSION['icono'] = 'error';
    header('Location: '.$URL.'/usuarios/create');
}



