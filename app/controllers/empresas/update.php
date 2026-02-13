<?php

include('../../config.php');

$nombre_empresa = mb_strtoupper($_GET['nombre_empresa']);
$ruc_empresa = $_GET['ruc_empresa'];
$id_empresa = $_GET['id_empresa'];

$sentencia = $pdo->prepare("UPDATE tb_empresas SET 
razon_social=:razon_social,
ruc=:ruc,
fyh_actualizacion=:fyh_actualizacion
WHERE id_empresa=:id_empresa");

$sentencia->bindParam('razon_social', $nombre_empresa);
$sentencia->bindParam('ruc', $ruc_empresa);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_empresa', $id_empresa);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo la empresa de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/empresas";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/empresas";
    </script>
    <?php
}





