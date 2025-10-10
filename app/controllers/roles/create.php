<?php

include ('../../config.php');

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


$contador = 0;
$sql_roles = "SELECT * FROM tb_roles where visible!=1";
$query_roles = $pdo->prepare($sql_roles);
$query_roles->execute();
$roles_datos = $query_roles->fetchAll(PDO::FETCH_ASSOC);

foreach ($roles_datos as $roles_dato) {
    if ($roles_dato["rol"]== $nombre_rol) {
        $contador = 1;
    }
}

if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El nombre del rol ya ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/roles";
    </script>
    <?php
} else {

    $sentencia = $pdo->prepare("INSERT INTO tb_roles (rol,modulo_devolucion,modulo_cheques,modulo_tyt,
    modulo_saldo,modulo_estado_cta,modulo_usuario,modulo_roles,fyh_creacion) 
    VALUES (:rol,:modulo_devolucion,:modulo_cheques,:modulo_tyt,:modulo_saldo,:modulo_estado_cta,
    :modulo_usuario,:modulo_roles,:fyh_creacion)");

    $sentencia->bindParam('rol', $nombre_rol);
    $sentencia->bindParam('modulo_devolucion', $modulo_devolucion);
    $sentencia->bindParam('modulo_cheques', $modulo_cheques);
    $sentencia->bindParam('modulo_tyt', $modulo_tyt);
    $sentencia->bindParam('modulo_saldo', $modulo_saldo);
    $sentencia->bindParam('modulo_estado_cta', $modulo_cuenta);
    $sentencia->bindParam('modulo_usuario', $modulo_usuario);
    $sentencia->bindParam('modulo_roles', $modulo_rol);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro el rol de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/roles";
        </script>
        <?php
    } else {
        #echo "Error las contraseñas no son iguales";
        session_start();
        $_SESSION['mensaje'] = "Error no se pudo registrar en la base de datos";
        $_SESSION['icono'] = "error";
        #header('Location: ' . $URL . '/categorias');

    }

}




