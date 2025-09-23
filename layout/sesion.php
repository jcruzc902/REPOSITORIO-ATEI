<?php
/**
 
 * Date: 18/1/2023
 * Time: 15:02
 */

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
        $apaterno= $usuario['apaterno'];
        $amaterno= $usuario['amaterno'];
        $email= $usuario['email'];
        $user= $usuario['usuario'];
        $rol_sesion = $usuario['rol'];
    }
    
    
}else{
    echo "no existe sesion";
    header('Location: '.$URL.'/login');
}