<?php

include('../../config.php');

$id_rol = $_POST['id_rol'];

$nombre_rol = mb_strtoupper($_POST['nombre_rol']);


if(isset($_POST['modulo_devoluciones'])){
    $modulo_devolucion= "YES";
}else{
    $modulo_devolucion= "NO";
}

if(isset($_POST['modulo_cheques'])){
    $modulo_cheques= "YES";
}else{
    $modulo_cheques= "NO";
}

if(isset($_POST['modulo_tyt'])){
    $modulo_tyt= "YES";
}else{
    $modulo_tyt= "NO";
}

if(isset($_POST['modulo_saldos'])){
    $modulo_saldo= "YES";
}else{
    $modulo_saldo= "NO";
}

if(isset($_POST['modulo_cuentas'])){
    $modulo_cuenta= "YES";
}else{
    $modulo_cuenta= "NO";
}

if(isset($_POST['modulo_usuarios'])){
    $modulo_usuario= "YES";
}else{
    $modulo_usuario= "NO";
}

if(isset($_POST['modulo_roles'])){
    $modulo_rol= "YES";
}else{
    $modulo_rol= "NO";
}



$sentencia = $pdo->prepare("UPDATE tb_roles SET 
rol=:rol,
modulo_devolucion=:modulo_devolucion,
modulo_cheques=:modulo_cheques,
modulo_tyt=:modulo_tyt,
modulo_saldo=:modulo_saldo,
modulo_estado_cta=:modulo_estado_cta,
modulo_usuario=:modulo_usuario,
modulo_roles=:modulo_roles,
fyh_actualizacion=:fyh_actualizacion
WHERE id_rol=:id_rol");

$sentencia->bindParam('rol', $nombre_rol);
$sentencia->bindParam('modulo_devolucion', $modulo_devolucion);
$sentencia->bindParam('modulo_cheques', $modulo_cheques);
$sentencia->bindParam('modulo_tyt', $modulo_tyt);
$sentencia->bindParam('modulo_saldo', $modulo_saldo);
$sentencia->bindParam('modulo_estado_cta', $modulo_cuenta);
$sentencia->bindParam('modulo_usuario', $modulo_usuario);
$sentencia->bindParam('modulo_roles', $modulo_rol);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_rol', $id_rol);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo el rol de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/roles";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/roles";
    </script>
    <?php
}





